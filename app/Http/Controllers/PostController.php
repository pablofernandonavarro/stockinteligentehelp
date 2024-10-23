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
        if (request()->page) {
            $key = 'posts' . request()->page;
        } else {
            $key = 'posts';
        }
    
        if (Cache::has($key)) {
            $posts = Cache::get($key); // Aquí corregimos $post por $posts
        } else {
            // Asegúrate de cargar la relación 'categories'
            $posts = Post::with('categories')->where('status', 2)->latest('id')->paginate(8);
            Cache::put($key, $posts);
        }
    
        return view('posts.index', compact('posts'));
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
            ->paginate(4);
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
