<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostRouteTest extends TestCase
{
    use DatabaseMigrations;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_todo()
    {
        $response = $this->get('/api/posts?content=TODO');

        $response->assertStatus(200);
    }

    public function test_page()
    {
        $response = $this->get('/api/posts?page=3&limit=5');

        $response->assertStatus(200);
    }

    public function test_user()
    {
        $response = $this->get('/api/posts?user=2&page=3&limit=5');

        $response->assertStatus(200);
    }
}
