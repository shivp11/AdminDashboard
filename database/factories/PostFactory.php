<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_title' => $this->faker->post_title(),
            'post_content' => $this->faker->post_content(),
            'post_author' => 'Shiv Patel',
            'post_image' => 'default-post.jpg',
            'post_status' => 'Pending',
        ];
    }
}
