<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostRouteTest extends TestCase
{
    use DatabaseMigrations;

    public function test_example()
    {
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
    }

    public function test_json()
    {
        Post::factory()->count(5)->create();

        $response = $this->get('/api/posts?content=TODO');

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('current_page')
                 ->has('data')
        );
    }
}
