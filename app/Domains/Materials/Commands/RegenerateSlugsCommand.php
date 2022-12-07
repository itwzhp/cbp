<?php
namespace App\Domains\Materials\Commands;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;

class RegenerateSlugsCommand extends Command
{
    protected $signature = 'slugs:generate';

    public function __invoke()
    {
        $models = [
            Tag::query(),
            Taxonomy::query(),
        ];

        /** @var Builder $model */
        foreach ($models as $model) {
            /** @var HasSlug $item */
            foreach ($model->get() as $item) {
                $item->generateSlug();
                $item->save();
            }
        }
    }
}
