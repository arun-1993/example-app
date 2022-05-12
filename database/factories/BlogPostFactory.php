<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraphs(5, true),
        ];
    }

    public function new_post()
    {
        return $this->state(function () {
            return [
                'title' => 'New Title',
                'content' => 'Content of the blog post',
            ];
        });
    }
}
