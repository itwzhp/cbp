<?php
namespace App\Domains\Visuals\Models;

use App\Domains\Visuals\Models\Factories\SlideFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
class Slide extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];

    protected $with = [
        'media',
    ];

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

    protected static function newFactory(): SlideFactory
    {
        return SlideFactory::new();
    }

    public function slide(): string
    {
        return $this->getFirstMediaUrl('slide', 'cover');
    }
}
