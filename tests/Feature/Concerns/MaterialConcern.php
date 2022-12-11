<?php
namespace Tests\Feature\Concerns;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Users\Models\User;

trait MaterialConcern
{
    use UserConcerns;

    public function createMaterial(array $params = []): Material
    {
        $user = User::first() ?? $this->createUser();

        return Material::factory()->create([
            'user_id' => $user->id,
        ]);
    }

    public function createTaxonomy(int $tagsCount = 1, array $params = []): Taxonomy
    {

        /** @var Taxonomy $taxonomy */
        $taxonomy = Taxonomy::factory()->create();

        Tag::factory($tagsCount)->create([
            'taxonomy_id' => $taxonomy->id,
        ]);

        return $taxonomy;
    }
}
