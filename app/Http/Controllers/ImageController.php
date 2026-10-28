<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show(Request $request, $path)
    {
        $sourcePath = $this->resolveSourcePath($path);

        if (! $sourcePath || ! is_file($sourcePath)) {
            abort(404);
        }

        $width = (int) $request->query('w', 0);
        $height = (int) $request->query('h', 0);
        $fit = $request->query('fit', 'contain');

        // If no resize dimensions requested or SVG, serve original file directly
        $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
        if (($width <= 0 && $height <= 0) || $ext === 'svg' || ! function_exists('imagecreatetruecolor')) {
            return response()->file($sourcePath, [
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        // Check cached resized image
        $cacheHash = md5($sourcePath . '|' . filemtime($sourcePath) . "|w={$width}|h={$height}|fit={$fit}");
        $cacheDir = public_path('images/.cache/' . trim(dirname($path), '/\\.'));
        $cacheFile = $cacheDir . '/' . pathinfo($sourcePath, PATHINFO_FILENAME) . '_' . $cacheHash . '.' . $ext;

        if (is_file($cacheFile)) {
            return response()->file($cacheFile, [
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        if ($this->resizeImage($sourcePath, $cacheFile, $width, $height, $fit)) {
            return response()->file($cacheFile, [
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        return response()->file($sourcePath, [
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    protected function resolveSourcePath(string $path): ?string
    {
        $cleanPath = ltrim(str_replace(['..', '\\'], ['', '/'], $path), '/');

        $candidates = [
            public_path('images/' . $cleanPath),
            public_path('resize/' . $cleanPath),
        ];

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        // Fallback: try alternative extensions (e.g. .png when .jpg was requested)
        $pathWithoutExt = pathinfo($cleanPath, PATHINFO_DIRNAME) . '/' . pathinfo($cleanPath, PATHINFO_FILENAME);
        $pathWithoutExt = ltrim($pathWithoutExt, './');
        foreach (['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'] as $ext) {
            foreach (['images', 'resize'] as $folder) {
                $alt = public_path("{$folder}/{$pathWithoutExt}.{$ext}");
                if (is_file($alt)) {
                    return $alt;
                }
            }
        }

        return null;
    }

    protected function resizeImage(string $sourcePath, string $destPath, int $targetW, int $targetH, string $fit): bool
    {
        $info = @getimagesize($sourcePath);
        if (! $info) {
            return false;
        }

        [$srcW, $srcH, $type] = $info;
        if ($srcW <= 0 || $srcH <= 0) {
            return false;
        }

        $srcImg = match ($type) {
            IMAGETYPE_JPEG => function_exists('imagecreatefromjpeg') ? @\imagecreatefromjpeg($sourcePath) : false,
            IMAGETYPE_PNG => function_exists('imagecreatefrompng') ? @\imagecreatefrompng($sourcePath) : false,
            IMAGETYPE_GIF => function_exists('imagecreatefromgif') ? @\imagecreatefromgif($sourcePath) : false,
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @\imagecreatefromwebp($sourcePath) : false,
            default => false,
        };

        if (! $srcImg) {
            return false;
        }

        if ($targetW <= 0) {
            $targetW = (int) round($srcW * ($targetH / $srcH));
        } elseif ($targetH <= 0) {
            $targetH = (int) round($srcH * ($targetW / $srcW));
        }

        $srcX = 0;
        $srcY = 0;
        $cropW = $srcW;
        $cropH = $srcH;

        if ($fit === 'crop') {
            $srcRatio = $srcW / $srcH;
            $targetRatio = $targetW / $targetH;

            if ($srcRatio > $targetRatio) {
                $cropW = (int) round($srcH * $targetRatio);
                $srcX = (int) round(($srcW - $cropW) / 2);
            } else {
                $cropH = (int) round($srcW / $targetRatio);
                $srcY = (int) round(($srcH - $cropH) / 2);
            }
        }

        $dstImg = imagecreatetruecolor($targetW, $targetH);

        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_GIF || $type === IMAGETYPE_WEBP) {
            imagealphablending($dstImg, false);
            imagesavealpha($dstImg, true);
            $transparent = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
            imagefilledrectangle($dstImg, 0, 0, $targetW, $targetH, $transparent);
        }

        imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $targetW, $targetH, $cropW, $cropH);

        $dir = dirname($destPath);
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $saved = match ($type) {
            IMAGETYPE_JPEG => function_exists('imagejpeg') ? @\imagejpeg($dstImg, $destPath, 85) : false,
            IMAGETYPE_PNG => function_exists('imagepng') ? @\imagepng($dstImg, $destPath, 6) : false,
            IMAGETYPE_GIF => function_exists('imagegif') ? @\imagegif($dstImg, $destPath) : false,
            IMAGETYPE_WEBP => function_exists('imagewebp') ? @\imagewebp($dstImg, $destPath, 85) : false,
            default => false,
        };

        imagedestroy($srcImg);
        imagedestroy($dstImg);

        return (bool) $saved;
    }
}
