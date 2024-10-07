<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etiqueta>
 */
class EtiquetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  
        $name = $this->faker->unique()->word();
        return [

            'name'=> $name,
            'slug'=> Str::slug($name),
            'color'=> $this->faker->randomElement(['red','yellow','green','blue','indigo','purple','pink'])

        ];
    }
}
