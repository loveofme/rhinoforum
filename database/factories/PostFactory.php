<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Tech', 'Financial', 'Startup', 'Design'];

        return [
            'content' => $this->faker->realText(),
            'category' => $this->faker->randomElement($categories),
            'published_at' => now(),
        ];
    }
}
