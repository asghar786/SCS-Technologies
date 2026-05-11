<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        if (empty($data['image'])) {
            $data['image'] = $record->image;
        } elseif (!str_ends_with($data['image'], '.webp')) {
            $data['image'] = $this->convertToWebP($data['image'], 800, 800);
        }

        if (empty($data['banner_image'])) {
            $data['banner_image'] = $record->banner_image;
        } elseif (!str_ends_with($data['banner_image'], '.webp')) {
            $data['banner_image'] = $this->convertToWebP($data['banner_image'], 1920, 400);
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
