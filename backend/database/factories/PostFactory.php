<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class PostFactory extends Factory
{
    public function definition(): array
{
    $title = $this->faker->unique()->sentence();

    return [
        'title' => $title,
        // insert slug based on the generated title
        'slug' => Str::slug(
            title: $title,
        ),
        'body' => $this->faker->paragraph(),
        // insert boolean to published and the chance of the value being true
        'published_at' => $this->faker->boolean(
            chanceOfGettingTrue: 85,
        ),

        // insert category_id with Category Factory, but we will replace this later
        'category_id' => Category::factory(),
    ];
    
}

}