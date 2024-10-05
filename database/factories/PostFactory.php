<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\user;
use App\Models\Category;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model =Post::class;
    public function definition(): array
    {   
        $name = $this->faker->unique()->sentence();
        return [
            'name'=> $name,
            'slug'=> Str::slug($name),
            'extract'=> $this->faker->text(250),
            'body'=> $this->faker->text(2000),
            'status'=> $this->faker->randomElement([1,2]),
            'category_id'=> Category::all()->random()->id,
            'user_id'=> user::all()->random()->id
            
        ];
    }
}
