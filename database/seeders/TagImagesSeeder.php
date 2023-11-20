<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagImagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHSW();
        $this->seedTypes();
        //        $this->seedTagIcons();
    }

    protected function attachImg(Tag $tag, string $image, string $collection = 'thumb'): void
    {
        $tag->addMedia(public_path('/images/' . $image))
            ->preservingOriginal()
            ->toMediaCollection($collection);
    }

    protected function seedHSW()
    {
        /** @var Taxonomy $hswTax */
        $hswTax = Taxonomy::where('slug', 'harcerski-system-wychowawczy')->first();

        foreach ($hswTax->tags as $tag) {
            if (Str::endsWith($tag->slug, 'planowanie-w-druzynie')) {
                $this->attachImg($tag, 'planowanie.jpg');
            }

            if (Str::endsWith($tag->slug, 'zasady-harcerskiego-wychowania')) {
                $this->attachImg($tag, 'zasady.jpg');
            }

            if (Str::endsWith($tag->slug, 'system-malych-grup')) {
                $this->attachImg($tag, 'system.jpg');
            }

            if (Str::endsWith($tag->slug, 'obrzedowosc-i-symbolika')) {
                $this->attachImg($tag, 'obrzedowosc.jpg');
            }

            if (Str::endsWith($tag->slug, 'sluzba')) {
                $this->attachImg($tag, 'sluzba.jpg');
            }

            if (Str::endsWith($tag->slug, 'uczenie-w-dzialaniu')) {
                $this->attachImg($tag, 'uczenie.jpg');
            }

            if (Str::endsWith($tag->slug, 'prawa-przyrzeczenie-i-obietnica')) {
                $this->attachImg($tag, 'prawa.jpg');
            }

            if (Str::endsWith($tag->slug, 'system-instrumentow-metodycznych')) {
                $this->attachImg($tag, 'system.jpg');
            }

            if (Str::endsWith($tag->slug, 'praca-z-metodykami')) {
                $this->attachImg($tag, 'grupy.jpg');
            }

            if (Str::endsWith($tag->slug, 'cechy-metody-harcerskiej')) {
                $this->attachImg($tag, 'cechy.jpg');
            }

            if (Str::endsWith($tag->slug, 'osobisty-przyklad-instruktora')) {
                $this->attachImg($tag, 'osobisty.jpg');
            }

            if (Str::endsWith($tag->slug, 'harcerski-system-wychowawczy')) {
                $this->attachImg($tag, 'hsw.jpg');
            }
        }
    }

    protected function seedTypes()
    {
        /** @var Taxonomy $typesTax */
        $typesTax = Taxonomy::where('slug', 'typ-materialu')->first();

        foreach ($typesTax->tags as $tag) {

            if (Str::endsWith($tag->slug, 'gra-ksztalceniowa')) {
                $this->attachImg($tag, 'graksztalceniowa.jpg');
            }

            if (Str::endsWith($tag->slug, 'element-zajec')) {
                $this->attachImg($tag, 'element.jpg');
            }

            if (Str::endsWith($tag->slug, 'poradnik')) {
                $this->attachImg($tag, 'poradnik.jpg');
            }

            if (Str::endsWith($tag->slug, 'propozycja-programowa')) {
                $this->attachImg($tag, 'propozycjaprogramowa.jpg');
            }

            if (Str::endsWith($tag->slug, 'konspekt-programowy')) {
                $this->attachImg($tag, 'konspektprogramowy.jpg');
            }

            if (Str::endsWith($tag->slug, 'artykul')) {
                $this->attachImg($tag, 'artykul.jpg');
                $this->attachImg($tag, 'artykul_big.jpg', 'featured');
            }

            if (Str::endsWith($tag->slug, 'konspekt-ksztalceniowy')) {
                $this->attachImg($tag, 'konspektksztalceniowy.jpg');
            }

            if (Str::endsWith($tag->slug, 'gra-programowa')) {
                $this->attachImg($tag, 'graprogramowa.jpg');
            }

            if (Str::endsWith($tag->slug, 'recenzja')) {
                $this->attachImg($tag, 'recenzja.jpg');
            }
        }
    }

    protected function seedTagIcons(): void
    {
        //        $zuchyTag = Tag::where('slug', 'like', '%zuchy')->first();
        //        $this->attachImg($zuchyTag, 'ikony/materialy_zuchowe.png', 'icon');
        //
        //        $harcerzeTag = Tag::where('slug', 'like', '%harcerze')->first();
        //        $this->attachImg($harcerzeTag, 'ikony/materialy_harcerskie.png', 'icon');
        //
        //        $harcerzeStarsiTag = Tag::where('slug', 'like', '%harcerze-starsi')->first();
        //        $this->attachImg($harcerzeStarsiTag, 'ikony/materialy_starszoharcerskie.png', 'icon');
        //
        //        $wedrownicyTag = Tag::where('slug', 'like', '%wedrownicy')->first();
        //        $this->attachImg($wedrownicyTag, 'ikony/materialy_wedrownicze.png', 'icon');
        //
        //        $konspektKsztalceniowyTag = Tag::where('slug', 'like', '%konspekt-ksztalceniowy')->first();
        //        $this->attachImg($konspektKsztalceniowyTag, 'ikony/konspekty_ksztalceniowe.png', 'icon');
        //
        //        $graKsztalceniowaTag = Tag::where('slug', 'like', '%gra-ksztalceniowa')->first();
        //        $this->attachImg($graKsztalceniowaTag, 'ikony/gry_ksztalceniowe.png', 'icon');
        //
        //        $graProgramowaTag = Tag::where('slug', 'like', '%gra-programowa')->first();
        //        $this->attachImg($graProgramowaTag, 'ikony/gry_programowe.png', 'icon');
        //
        //        $propozycjeTag = Tag::where('slug', 'like', '%propozycja-programowa')->first();
        //        $this->attachImg($propozycjeTag, 'ikony/propozycje_programowe.png', 'icon');
        //
        //        $poradnikiTag = Tag::where('slug', 'like', '%poradnik')->first();
        //        $this->attachImg($poradnikiTag, 'ikony/poradniki.png', 'icon');
        //
        //        $czasopismaTag = Tag::where('slug', 'like', '%czasopisma')->first();
        //        $this->attachImg($czasopismaTag, 'ikony/czasopisma.png', 'icon');
        //
        //        $artykulyTag = Tag::where('slug', 'like', '%artykul')->first();
        //        $this->attachImg($artykulyTag, 'ikony/artykuly.png', 'icon');
    }
}
