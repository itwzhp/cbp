<?php
namespace App\Domains\Visuals\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int    id
 * @property string url
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Slider extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('cover')
            ->fit(Manipulations::FIT_CROP, 1000, 600)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slide')
            ->singleFile();
    }

    public function slide(): string
    {
        return $this->getFirstMediaUrl('slide', 'cover');
    }
}
