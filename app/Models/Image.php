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

    public static function getSemaphoreColor($value)
    {
        if (is_null($value)) {
            return '#6c757d';
        }

        $value = (int) $value;

        if ($value >= 4) {
            return '#dc3545';
        }

        if ($value === 3) {
            return '#ffc107';
        }

        return '#198754';
    }

    public function getSemaphores()
    {
        return [
            ['label' => 'Adulti', 'color' => self::getSemaphoreColor($this->adult)],
            ['label' => 'Violenza', 'color' => self::getSemaphoreColor($this->violence)],
            ['label' => 'Provocante', 'color' => self::getSemaphoreColor($this->racy)],
            ['label' => 'Contraffatto', 'color' => self::getSemaphoreColor($this->spoof)],
            ['label' => 'Medico', 'color' => self::getSemaphoreColor($this->medical)],
        ];
    }
}