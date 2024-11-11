<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Etiqueta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        // Obtener el término de búsqueda y la página actual
        $search = request()->input('search', '');
        $page = request()->input('page', 1);

        // Generar una clave única para el caché
        $cacheKey = 'posts_' . $search . '_page_' . $page;

        // Verificar si los resultados están en caché
        if (Cache::has($cacheKey)) {
            $posts = Cache::get($cacheKey);
        } else {
            // Crear la consulta inicial con la relación de categoría y filtro de estado
            $query = Post::with('category')->where('status', 2);

            // Si el usuario no es administrador, excluir la categoría "Stock_interna"
            if (!auth()->user()->hasRole('Admin')) {
                $query->whereHas('category', function ($q) {
                    $q->where('name', '!=', 'Stock_interna');
                });
            }

            // Si hay un término de búsqueda, aplicar filtro en el título y el contenido
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('extract', 'like', '%' . $search . '%');
                });
            }

            // Ejecutar la consulta con paginación
            $posts = $query->paginate(8);

            // Guardar los resultados en caché
            Cache::put($cacheKey, $posts, now()->addMinutes(10)); // Personaliza el tiempo de caché según tu necesidad
        }

        // Devolver la vista con los posts y el término de búsqueda
        return view('posts.index', compact('posts', 'search'));
    }


    public function show(Post $post)
    {

        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->take(8)
            ->get();
        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category)
    {

        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(8);
        return view('posts.category', compact('posts', 'category'));
    }

    public function etiqueta(Etiqueta $etiqueta)
    {

        $posts = $etiqueta->posts()
            ->where('status', 2)
            ->latest('id')
            ->paginate(4);

        return view('posts.etiqueta', compact('posts', 'etiqueta'));
    }
}
