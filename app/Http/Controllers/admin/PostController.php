<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Etiqueta;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")
            ->get();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {

        $categories = Category::pluck('name', 'id');
        $etiquetas =  Etiqueta::all();


        return view("admin.posts.create", compact('categories', 'etiquetas',"post"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        
        $post = Post::create($request->all());
    
        // Verificar si se ha subido un archivo
        if($request->hasFile('file')) {
      
            // Subir el archivo a la carpeta 'posts' y obtener la URL
            $url = Storage::put('posts', $request->file('file'));
    
            // Crear la relación de imagen en la tabla correspondiente
            $post->image()->create([
                'url' => $url
            ]);
        }
    
        // Asociar etiquetas si existen en la solicitud
        if ($request->has('etiquetas')) {
            $post->etiquetas()->attach($request->etiquetas);
        }
    
        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('admin.posts.index')->with('success', 'Post creado exitosamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {  
        $categories = Category::pluck('name', 'id');
        $etiquetas =  Etiqueta::all();


        return view("admin.posts.edit", compact('categories', 'etiquetas','post'));
       
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
       return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
