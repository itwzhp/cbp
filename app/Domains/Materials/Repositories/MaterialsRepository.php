<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Enums\FieldTypeEnum;
use App\Domains\Materials\Models\Enums\PresetEnum;
use App\Domains\Materials\Models\Licence;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\States\Draft;
use App\Domains\Users\Models\User;

class MaterialsRepository
{
    public function create(User $owner, string $title = null): Material
    {
        return Material::create([
            'user_id'    => $owner->id,
            'title'      => $title ?? fake()->sentence(),
            'licence_id' => 1,
            'state'      => Draft::class,
        ]);
    }

    public function createWithPreset(User $owner, PresetEnum $enum = null): Material
    {
        $material = $this->create($owner);

        $this->attachLicence($material);

        switch ($enum) {
            case PresetEnum::TRAINING_GAME:
            case PresetEnum::PROGRAM_GAME:
            case PresetEnum::CONSPECTUS_TRAINING:

                $this->attachAuthors($material);
                $this->attachSetups($material);
                $this->attachScenario($material);
                $this->attachIntentions($material);
                break;

            case PresetEnum::CONSPECTUS_PROGRAM:

                $this->attachAuthors($material);
                $this->attachSetups($material);
                $this->attachScenario($material);
                $this->attachRequirements($material);
                $this->attachIntentions($material);
                break;

            case PresetEnum::HANDBOOK:
            case PresetEnum::PROPOSITION:
            case PresetEnum::REVIEW:
            case PresetEnum::MAGAZINE:
            case PresetEnum::ARTICLE:

                $this->attachAuthors($material);
                break;

            default:
                throw new \InvalidArgumentException('Unknown type');
        }

        return $material;
    }

    protected function attachIntentions(Material $material): void
    {
        $material->fields()->create([
            'type'  => FieldTypeEnum::INTENT,
            'value' => '... co uczestnicy będą wiedzieć/umieć?',
        ]);
    }

    protected function attachScenario(Material $material): void
    {
        $material->scenarios()->create([
            'order'       => 1,
            'title'       => 'Nazwa elementu zajęć',
            'form'        => 'Forma zajęć',
            'duration'    => 10,
            'responsible' => 'odpowiedzialna osoba',
            'description' => 'Opis elementu',
            'materials'   => 'Potrzebne materiały',
        ]);
    }

    protected function attachAuthors(Material $material, bool $isWithTranslators = true): void
    {
        $material->fields()->create([
            'type'  => FieldTypeEnum::AUTHOR,
            'value' => 'podaj autora',
        ]);
        $material->fields()->create([
            'type'  => FieldTypeEnum::PROOFREADER,
            'value' => 'podaj koretkora',
        ]);
        $material->fields()->create([
            'type'  => FieldTypeEnum::TYPESETTER,
            'value' => 'podaj osobę dokonującą składu',
        ]);

        if ($isWithTranslators === true) {
            $material->fields()->create([
                'type'  => FieldTypeEnum::TRANSLATOR,
                'value' => 'podaj tłumacza',
            ]);
        }
    }

    protected function attachLicence(Material $material): void
    {
        $licence = Licence::where('name', 'like', '%ZHP%')->first();
        $material->licence()->associate($licence);
    }

    protected function attachSetups(Material $material): void
    {
        $material->setups()->create([
        ]);
    }

    protected function attachRequirements(Material $material): void
    {
        $material->fields()->create([
            'type'  => FieldTypeEnum::REQUIREMENT,
            'value' => 'realizowane wymagania z instrumentów metodycznych',
        ]);
    }
}
