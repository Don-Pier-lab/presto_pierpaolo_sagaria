<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path', 'article_id', 'adult', 'violence', 'racy', 'spoof', 'medical', 'labels'];

    protected function casts(): array
    {
        return [
            'labels' => 'array',
        ];
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        if (!$w && !$h) {
            return Storage::url($filePath);
        }

        $filePathInfo = pathinfo($filePath);
        $dirname = $filePathInfo['dirname'];
        $basename = $filePathInfo['basename'];

        $file = $dirname . "/crop_{$w}x{$h}_" . $basename;

        return Storage::url($file);
    }

    public function getUrl($w = null, $h = null)
    {
        return self::getUrlByFilePath($this->path, $w, $h);
    }

   public function isSafe()
    {
        return $this->adult < 3
            && $this->violence < 3
            && $this->racy < 3
            && $this->spoof < 3
            && $this->medical < 3;
    }
}