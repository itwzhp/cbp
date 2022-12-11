<?php
namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Users\Roles\RoleHelper;
use Tests\TestCase;

class ExampleTest extends TestCase
{
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

        $this->assertTrue($author->hasRole(RoleHelper::AUTHOR));
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
