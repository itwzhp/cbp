<?php
namespace Tests\Feature;

use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Users\Roles\RolesEnum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(TagsRepository::class)->createWithTax('Inne', 'Wyróżnione');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_creates_test_users()
    {
        // when
        $user = $this->createUser();
        $author = $this->createAuthor();

        // then
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $author->id,
        ]);

        $this->assertTrue($author->hasRole(RolesEnum::AUTHOR));
    }

    /** @test */
    public function it_creates_test_taxonomy()
    {
        // when
        $taxonomy = $this->createTaxonomy(3);

        // then
        $this->assertCount(3, $taxonomy->tags);
    }
}
