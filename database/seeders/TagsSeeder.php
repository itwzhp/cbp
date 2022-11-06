<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    public const MOTIF_NAME = 'Motyw';
    public const MOTIFS = [
        'Zbiórka okolicznościowa',
        'Technika harcerska',
        'Wartości harcerskie',
        'Hobby i zainteresowania',
        'Zawody i profesje',
        'Specjalności',
    ];

    public function run()
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = Taxonomy::firstOrCreate([
            'name' => static::MOTIF_NAME,
        ]);

        foreach (static::MOTIFS as $theme) {
            $taxonomy->tags()->firstOrCreate([
                'name' => $theme,
            ]);
        }

    }
}
