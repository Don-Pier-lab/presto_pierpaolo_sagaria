<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as GoogleImage;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Image as SpatieImage;

class RemoveFaces implements ShouldQueue
{
    use Queueable;

    private $imageId;

    public function __construct($imageId)
    {
        $this->imageId = $imageId;
    }

    public function handle(): void
    {
        $image = Image::find($this->imageId);

        if (!$image) {
            return;
        }

        $srcPath = storage_path('app/public/' . $image->path);

        $imageAnnotator = new ImageAnnotatorClient();

        $imageContent = Storage::disk('public')->get($image->path);

        $googleImage = (new GoogleImage())->setContent($imageContent);

        $feature = (new Feature())->setType(Type::FACE_DETECTION);

        $request = (new AnnotateImageRequest())
            ->setImage($googleImage)
            ->setFeatures([$feature]);

        $batchRequest = (new BatchAnnotateImagesRequest())
            ->setRequests([$request]);

        $response = $imageAnnotator->batchAnnotateImages($batchRequest);
        $result = $response->getResponses()[0];
        $faces = $result->getFaceAnnotations();

        $spatieImage = SpatieImage::useImageDriver(ImageDriver::Gd)->load($srcPath);

        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();

            $bounds = [];
            foreach ($vertices as $vertex) {
                $bounds[] = ['x' => $vertex->getX(), 'y' => $vertex->getY()];
            }

            $x = $bounds[0]['x'];
            $y = $bounds[0]['y'];
            $width = $bounds[1]['x'] - $bounds[0]['x'];
            $height = $bounds[3]['y'] - $bounds[0]['y'];

            $spatieImage->watermark(
                public_path('censored.png'),
                position: AlignPosition::TopLeft,
                paddingX: $x,
                paddingY: $y,
                width: $width,
                height: $height,
                fit: Fit::Stretch
            );
        }

        $spatieImage->save($srcPath);

        $imageAnnotator->close();
    }
}