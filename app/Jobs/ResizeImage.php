<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;

class ResizeImage implements ShouldQueue
{
    use Queueable;

    private $w;
    private $h;
    private $fileName;
    private $path;

    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;

        $srcPath = storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;
        $destPath = storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}_" . $this->fileName;

        Image::useImageDriver(ImageDriver::Gd)
            ->load($srcPath)
            ->fit(Fit::Fill, $w, $h)
            ->watermark(
                public_path('logo.png'),
                width: 140,
                paddingX: 15,
                paddingY: 15
            )
            ->save($destPath);
    }
}