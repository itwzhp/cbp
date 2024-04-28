<?php
namespace Tests\Feature\Materials;

use App\Domains\Materials\MaterialSearcher;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

/**
 * @markTestSkipped
 */
class SearcherTest extends TestCase
{
    protected Material $material;

    protected Taxonomy $tax1;

    protected Taxonomy $tax2;

    protected Taxonomy $unusedTaxonomy;

    /** @var Tag[] */
    protected array $presentTags1;

    /** @var Tag[] */
    protected array $presentTags2;

    protected Tag $unusedTagFromTax1;

    protected Tag $unusedTagFromTax2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped();

        $this->author = $this->createAuthor();
        $this->tax1 = $this->createTaxonomy(3);
        $this->tax2 = $this->createTaxonomy(5);
        $this->unusedTaxonomy = $this->createTaxonomy(5);

        $this->presentTags1 = [
            $this->tax1->tags[0],
            $this->tax1->tags[2],
        ];
        $this->unusedTagFromTax1 = $this->tax1->tags[1];

        $this->presentTags2 = [
            $this->tax2->tags[3],
        ];
        $this->unusedTagFromTax2 = $this->tax2->tags[1];

        Material::factory(10)
            ->published()
            ->create([
                'user_id' => $this->author->id,
            ]);

        $this->material = Material::factory()
            ->published()
            ->create([
                'user_id' => $this->author->id,
            ]);

        /** @var Tag $tag */
        foreach ($this->presentTags1 as $tag) {
            $this->material->tags()->attach($tag->id);
        }
        foreach ($this->presentTags2 as $tag) {
            $this->material->tags()->attach($tag->id);
        }
    }

    /** @test */
    public function it_creates_material_correctly()
    {
        // given material

        // then
        $this->assertCount(3, $this->material->tags);
        $this->assertCount(2, $this->material->tags->groupBy('taxonomy_id'));
    }

    /** @test */
    public function it_tests_OR_scenario_on_one_tax()
    {
        // given
        $query = MaterialSearcher::make()
            ->inOrMode()
            ->withTags([
                $this->unusedTagFromTax1->id,
                $this->presentTags1[0]->id,
            ])
            ->query();

        // when
        $materials = $query->get();

        // then
        $this->assertMaterialIsPresentIn($materials);
    }

    /** @test */
    public function it_tests_OR_scenario_on_one_tax_no_results()
    {
        // given
        $query = MaterialSearcher::make()
            ->inOrMode()
            ->withTags([
                $this->unusedTagFromTax1->id,
            ])
            ->query();

        // when
        $materials = $query->get();

        // then
        $this->assertMaterialIsNotPresentIn($materials);
    }

    /** @test */
    public function it_tests_andor_mode()
    {
        // given
        $query = MaterialSearcher::make()
            ->inAndOrMode()
            ->withTags([
                $this->presentTags1[0]->id,
                $this->presentTags2[0]->id,
                $this->unusedTagFromTax1->id,
            ])
            ->query();

        // when
        $materials = $query->get();

        // then
        $this->assertMaterialIsPresentIn($materials);
    }

    /** @test */
    public function it_tests_and_mode()
    {
        // given
        $query = MaterialSearcher::make()
            ->inAndMode()
            ->withTags([
                $this->presentTags1[0]->id,
                $this->presentTags2[0]->id,
                $this->unusedTagFromTax1->id,
            ])
            ->query();

        // when
        $materials = $query->get();

        // then
        $this->assertMaterialIsNotPresentIn($materials);
    }

    protected function assertMaterialIsPresentIn(Collection $materials)
    {
        $this->assertCount(1, $materials->where('id', $this->material->id));
    }

    protected function assertMaterialIsNotPresentIn(Collection $materials)
    {
        $this->assertCount(0, $materials->where('id', $this->material->id));
    }
}
