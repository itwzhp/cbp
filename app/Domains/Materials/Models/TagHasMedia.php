<?php
namespace App\Domains\Materials\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait TagHasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('icon')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('icon')
                    ->fit(Manipulations::FIT_CROP, 80, 80);
            });

        $this
            ->addMediaCollection('thumb')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_FILL, 290, 192);
            });
    }

    public function icon(): ?string
    {
        return $this->getFirstMediaUrl('icon', 'icon');
    }

    public function thumb(): ?string
    {
        return $this->getFirstMediaUrl('thumb', 'thumb');
    }
}
