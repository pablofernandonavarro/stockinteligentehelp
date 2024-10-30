<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => '¿Qué es Laravel?',
            'answer' => 'Laravel es un framework de PHP para el desarrollo de aplicaciones web.',
            'category_id' => 1,
            'is_active' => true,
            'priority' => 1,
        ]);

        Faq::create([
            'question' => '¿Cómo instalar Laravel?',
            'answer' => 'Puedes instalar Laravel usando Composer con el comando "composer create-project laravel/laravel nombre_proyecto".',
            'category_id' => 2,
            'is_active' => true,
            'priority' => 2,
        ]);
    }
}
