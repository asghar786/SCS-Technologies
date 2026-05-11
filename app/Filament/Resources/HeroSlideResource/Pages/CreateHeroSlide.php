<?php

namespace App\Filament\Resources\HeroSlideResource\Pages;

use App\Filament\Resources\HeroSlideResource;
use App\Models\HeroSlide;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroSlide extends CreateRecord
{
    protected static string $resource = HeroSlideResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        foreach (['desktop_image', 'mobile_image'] as $field) {
            if (!empty($data[$field])) {
                $width  = $field === 'desktop_image' ? 1920 : 768;
                $height = $field === 'desktop_image' ? 900  : 1024;
                $data[$field] = $this->convertToWebP($data[$field], $width, $height);
            }
        }
        return $data;
    }

    private function convertToWebP(string $path, int $w, int $h): string
    {
        $full = storage_path('app/public/' . $path);
        if (!file_exists($full)) return $path;
        $info = @getimagesize($full);
        if (!$info) return $path;
        $src = match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($full),
            'image/png'  => imagecreatefrompng($full),
            'image/gif'  => imagecreatefromgif($full),
            default      => null,
        };
        if (!$src) return $path;
        $sw = imagesx($src); $sh = imagesy($src);
        $sr = $sw / $sh; $tr = $w / $h;
        if ($sr > $tr) { $cw = (int)round($sh * $tr); $ch = $sh; $cx = (int)round(($sw - $cw) / 2); $cy = 0; }
        else           { $cw = $sw; $ch = (int)round($sw / $tr); $cx = 0; $cy = (int)round(($sh - $ch) / 2); }
        $out = imagecreatetruecolor($w, $h);
        imagecopyresampled($out, $src, 0, 0, $cx, $cy, $w, $h, $cw, $ch);
        imagedestroy($src);
        $webp = preg_replace('/\.[^.]+$/', '.webp', $path);
        imagewebp($out, storage_path('app/public/' . $webp), 85);
        imagedestroy($out);
        if ($path !== $webp) @unlink($full);
        return $webp;
    }
}
