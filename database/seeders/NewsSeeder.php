<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $news = new News();

       $news->title = "Esta es mi segunda novedad";
       $news->slug = "esta-es-mi-segunda-novedad"; // Genera un slug único
       $news->content = "Contenido detallado de la segunda novedad.";
       $news->image = "news_images/segunda_novedad.jpg"; // Ruta de ejemplo para la imagen
       $news->published_at = now(); // Fecha y hora actual
       $news->author_id = 1; // ID del autor (asegúrate de que exista este usuario en la tabla users)
       $news->is_featured = true; // Marca como destacada
       $news->category_id = 1; // ID de la categoría (asegúrate de que exista en la tabla categories)
       $news->status = "draft"; // Opciones: draft, published, archived
       $news->created_at = '2024-01-10 00:00:00';
       $news->updated_at = '2024-01-10 00:00:00';
       $news->deleted_at = null;


      $news->save();
    }
}
