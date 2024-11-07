<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Etiqueta;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(RoleSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(CategorySeeder::class);
        // Category::factory(4)->create();
         Etiqueta::factory(8)->create();
         $this->call(PostSeeder::class);
        $this->call(FAQSeeder::class);
    }
}
