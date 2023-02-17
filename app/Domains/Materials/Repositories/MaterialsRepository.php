<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Enums\FieldTypeEnum;
use App\Domains\Materials\Models\Enums\PresetEnum;
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

        switch ($enum) {
            case PresetEnum::CONSPECTUS:

                $this->attachIntentions($material);
                $this->attachScenario($material);

                break;
            case PresetEnum::PROGRAM:
                throw new \Exception('To be implemented');
                break;
            case PresetEnum::PROPOSITION:
                throw new \Exception('To be implemented');
        }

        return $material;
    }

    private function attachIntentions(Material $material): void
    {
        $material->fields()->create([
            'type'  => FieldTypeEnum::INTENT,
            'value' => '... co uczestnicy będą wiedzieć/umieć?',
        ]);
    }

    private function attachScenario(Material $material)
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
}
