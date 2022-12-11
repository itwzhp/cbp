<?php
namespace App\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class FilesystemsHelper
{
    const LOCAL = 'wp_local';
    const PUBLIC = 'azure_public';
    const PRIVATE = 'azure_private';

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
}
