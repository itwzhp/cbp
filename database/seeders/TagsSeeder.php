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
    public const FORM_NAME = 'Forma';
    public const FORMS = [
        1  => 'Program obozu',
        2  => 'Program biwaku',
        3  => 'Program innej imprezy',
        4  => 'Poradnik',
        5  => 'Propozycja programowa',
        6  => 'Broszura/praca naukowa/tłumaczenie/materiał pokonferencyjny',
        7  => 'Artykuł',
        8  => 'Multimedia',
        9  => 'Konspekt zbiórki w harcówce złożonej z różnorodnych form',
        10 => 'Konspekt zbiórki w terenie złożonej z różnorodnych form',
        11 => 'Konspekt zbiórki w harcówce w jednej formie',
        12 => 'Konspekt zbiórki w terenie w jednej formie',
        13 => 'Pojedynczy element programowy (np. piosenka, gra)',
    ];

    public function run()
    {
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

        foreach (static::TYPES as $type) {
            $taxonomy->tags()->firstOrCreate([
                'name' => $type,
            ]);
        }
    }

    private function seedForms()
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = Taxonomy::firstOrCreate([
            'name' => static::FORM_NAME,
        ]);

        foreach (static::FORMS as $type) {
            $taxonomy->tags()->firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
