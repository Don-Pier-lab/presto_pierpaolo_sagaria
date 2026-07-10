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

class GoogleVisionLabelImage implements ShouldQueue
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

        $imageAnnotator = new ImageAnnotatorClient();

        $imageContent = Storage::disk('public')->get($image->path);

        $googleImage = (new GoogleImage())->setContent($imageContent);

        $feature = (new Feature())->setType(Type::LABEL_DETECTION);

        $request = (new AnnotateImageRequest())
            ->setImage($googleImage)
            ->setFeatures([$feature]);

        $batchRequest = (new BatchAnnotateImagesRequest())
            ->setRequests([$request]);

        $response = $imageAnnotator->batchAnnotateImages($batchRequest);
        $result = $response->getResponses()[0];
        $labels = $result->getLabelAnnotations();

        if ($labels) {
            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $image->labels = $result;
            $image->save();
        }

        $imageAnnotator->close();
    }
}