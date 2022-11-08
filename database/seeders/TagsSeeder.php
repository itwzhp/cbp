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
    public const TYPE_NAME = 'Typ';
    public const TYPES = [
        'programy'    => 'Program',
        'poradniki'   => 'Poradnik',
        'naukowe'     => 'Praca naukowa',
        'ksztalcenie' => 'Konspekt kształceniowy',
        'program'     => 'Konspekt programowy',
        'propozycje'  => 'Propozycja programowa',
    ];

    public function run()
    {
        $this->seedMotifs();
        $this->seedTypes();
    }

    private function seedMotifs()
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

    private function seedTypes()
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = Taxonomy::firstOrCreate([
            'name' => static::TYPE_NAME,
        ]);

        foreach (static::TYPES as $key => $type) {
            $taxonomy->tags()->firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
