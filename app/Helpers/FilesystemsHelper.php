<?php
namespace App\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class FilesystemsHelper
{
    const LOCAL = 'wp_local';
    const PUBLIC = 'azure_public';
    const PRIVATE = 'azure_private';
    const IMAGES = 'azure_images';

    public static function getDisk(string $disk): Filesystem
    {
        return match ($disk) {
            self::LOCAL   => self::getLocal(),
            self::PUBLIC  => self::getPublic(),
            self::PRIVATE => self::getPrivate(),
            self::IMAGES  => self::getImages(),
            default       => throw new InvalidArgumentException('Unknown disk')
        };
    }

    public static function getPublic(): Filesystem
    {
        return Storage::disk(static::PUBLIC);
    }

    public static function getPrivate(): Filesystem
    {
        return Storage::disk(static::PRIVATE);
    }

    public static function getLocal(): Filesystem
    {
        return Storage::disk(static::LOCAL);
    }

    public static function getImages(): Filesystem
    {
        return Storage::disk(static::IMAGES);
    }
}
