<?php
namespace App\Domains\Migration\Helpers;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Database\Seeders\TagsSeeder;
use Illuminate\Support\Arr;

class TypesHelper
{
    public static function getTag(?string $type): ?Tag
    {
        if (empty($type)) {
            return null;
        }

        $name = Arr::get(TagsSeeder::TYPES, $type);
        if (empty($name)) {
            return null;
        }

        /** @var Taxonomy $typesTax */
        $typesTax = Taxonomy::where('name', TagsSeeder::TYPE_NAME)->first();

        return $typesTax->tags()->where('name', $name)->first();
    }
}
