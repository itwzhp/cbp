<?php

use App\Helpers\FilesystemsHelper;

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
            'throw'  => false,
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'url'        => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw'      => false,
        ],

        's3' => [
            'driver'                  => 's3',
            'key'                     => env('AWS_ACCESS_KEY_ID'),
            'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
            'region'                  => env('AWS_DEFAULT_REGION'),
            'bucket'                  => env('AWS_BUCKET'),
            'url'                     => env('AWS_URL'),
            'endpoint'                => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw'                   => false,
        ],

        FilesystemsHelper::LOCAL => [
            'driver'     => 'local',
            'root'       => storage_path('wp'),
            'url'        => env('APP_URL') . '/wp',
            'visibility' => 'public',
            'throw'      => false,
        ],

        FilesystemsHelper::PUBLIC => [
            'driver'            => 'azure',
            'name'              => env('AZURE_STORAGE_NAME'),
            'key'               => env('AZURE_STORAGE_KEY'),
            'container'         => env('AZURE_STORAGE_CONTAINER_PUBLIC', 'public'),
            'url'               => env('AZURE_STORAGE_URL'),
            'prefix'            => null,
            'connection_string' => env('AZURE_STORAGE_CONNECTION_STRING'),
            'options'           => [
                'CacheControl'    => 'max-age=315360000, no-transform, public',
                'ContentEncoding' => 'gzip',
            ],
        ],

        FilesystemsHelper::IMAGES => [
            'driver'            => 'azure',
            'name'              => env('AZURE_STORAGE_NAME'),
            'key'               => env('AZURE_STORAGE_KEY'),
            'container'         => env('AZURE_STORAGE_CONTAINER_IMAGES', 'images'),
            'url'               => env('AZURE_STORAGE_URL'),
            'prefix'            => null,
            'connection_string' => env('AZURE_STORAGE_CONNECTION_STRING'),
        ],

        FilesystemsHelper::PRIVATE => [
            'driver'            => 'azure',
            'name'              => env('AZURE_STORAGE_NAME'),
            'key'               => env('AZURE_STORAGE_KEY'),
            'container'         => env('AZURE_STORAGE_CONTAINER_PRIVATE', 'private'),
            'url'               => env('AZURE_STORAGE_URL'),
            'prefix'            => null,
            'connection_string' => env('AZURE_STORAGE_CONNECTION_STRING'),
        ],
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
