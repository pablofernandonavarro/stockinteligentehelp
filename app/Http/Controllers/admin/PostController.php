<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Etiqueta;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

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


        return view("admin.posts.create", compact('categories', 'etiquetas', "post"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $post = Post::create($request->all());
        if ($request->hasFile('file')) {
            $url = Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->has('etiquetas')) {
            $post->etiquetas()->attach($request->etiquetas);
        }

        return redirect()->route('admin.posts.index')->with('message', 'Post creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {   

        $categories = $post->categories;
        $etiquetas =  $post->etiquetas;

        return view("admin.posts.show",compact ('categories','etiquetas','post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id');
        $etiquetas =  Etiqueta::all();


        return view("admin.posts.edit", compact('categories', 'etiquetas', 'post'))->with('mesagge', 'Post actualizado exitosamente!!!!.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->update($request->all());
        if ($request->hasFile('file')) {
            $url = Storage::put('posts', $request->file('file'));
            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->has('etiquetas')) {
            $post->etiquetas()->sync($request->etiquetas);
        }

        return redirect()->route('admin.posts.index')->with('mesagge', 'Post actualizado exitosamente!!!!.');
    }


    public function destroy(Post $post)
    {
        
        if ($post->image) {
            Storage::delete($post->image->url);
            $post->image->delete();
        }
        $post->etiquetas()->detach();
        $post->delete();
    
        return redirect()->route('admin.posts.index')->with('mesagge', 'Post eliminado exitosamente!!!!!.');
    }
}