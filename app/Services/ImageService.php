<?php

namespace App\Services;

use App\Support\Flash;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class ImageService
{
    public static function saveFromUrl(
        string $url,
        string $folder = 'images',
        ?string $fileName = null,
        bool $override = true
    ): ?string {
        $response = self::download($url);

        if (! $response) {
            Flash::error('Image download failed.');

            return null;
        }

        $extension = self::getExtension($response->header('Content-Type'));
        $finalFileName = self::makeFilename($extension, $fileName, $override);
        $path = self::buildPath($folder, $finalFileName);

        if (! self::store($path, $response->body())) {
            Flash::error('Image failed to save.');

            return null;
        }

        return Storage::url($path);
    }

    protected static function download(string $url): ?Response
    {
        try {
            $response = Http::get($url);
        } catch (ConnectionException $e) {
            Log::error('Image download failed', compact('url', 'e'));
        }

        if (! $response->successful()) {
            Log::error('Image download failed', compact('url'));

            return null;
        }

        if (! str_starts_with($response->header('Content-Type'), 'image/')) {
            Log::error('Invalid image content type', [
                'url' => $url,
                'contentType' => $response->header('Content-Type'),
            ]);

            return null;
        }

        return $response;
    }

    protected static function getExtension(string $contentType): string
    {
        return Str::after($contentType, '/'); // jpeg, png, webp
    }

    protected static function makeFilename(string $ext, ?string $fileName, bool $override): string
    {
        $fileName = Str::slug($fileName ?? Str::random(8));

        return $override
            ? "$fileName.$ext"
            : "$fileName".'_'.time().".$ext";
    }

    protected static function buildPath(string $folder, string $fileName): string
    {
        return trim($folder, '/').'/'.$fileName;
    }

    protected static function store(string $path, string $contents): bool
    {
        if (! Storage::disk('public')->put($path, $contents)) {
            Log::error('Image write failed', compact('path'));

            return false;
        }

        Log::info('Image saved', ['path' => $path]);

        return true;
    }

    public static function deleteFromUrl(string $url, string $path = '/'): void
    {
        Storage::disk('public')->delete(str_replace(asset($path), '', $url));
    }
}
