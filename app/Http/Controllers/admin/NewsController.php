<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Str;


use Illuminate\Http\Request;


class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->get();

        return view('admin.news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::with(['author', 'category'])->findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    public function create(News $news )
    {
        $authors = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('admin.news.create', compact('authors', 'categories'));
    }


    public function store(Request $request)
    {  
       
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date', // Validar como fecha
        ]);
    
        $news = new News();
        $news->title = $request->title;
        $news->slug = $request->slug ?? \Str::slug($request->title);
        $news->content = $request->content;
        $news->author_id = $request->author_id;
        $news->category_id = $request->category_id;
        $news->status = $request->status;
    
        // Guardar la fecha de publicación si se envió, de lo contrario, dejarla nula
        $news->published_at = $request->published_at;
    
        if ($request->hasFile('image')) {
            $news->image = $request->file('image')->store('news_images', 'public');
        }
    
        $news->save();
    
        return redirect()->route('admin.news.index')->with('success', 'Novedad creada correctamente.');
    }
    
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $authors = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('admin.news.edit', compact('news', 'authors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug,' . $id,
            'content' => 'required',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date', // Validar como fecha
        ]);
    
        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->slug = $request->slug ?? \Str::slug($request->title);
        $news->content = $request->content;
        $news->author_id = $request->author_id;
        $news->category_id = $request->category_id;
        $news->status = $request->status;
    
        // Verificar y actualizar el campo published_at solo si es válido
        if ($request->filled('published_at')) {
            $newPublishedAt = \Carbon\Carbon::parse($request->published_at);
            $now = now();
    
            // Verifica si la fecha es futura o actual
            if ($newPublishedAt->gte($now)) {
                $news->published_at = $newPublishedAt;
            } else {
                return redirect()->back()->withErrors([
                    'published_at' => 'La fecha de publicación debe ser igual o posterior a la fecha actual.',
                ]);
            }
        }
    
        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si existe
            if ($news->image) {
                \Storage::disk('public')->delete($news->image);
            }
    
            // Sube la nueva imagen
            $news->image = $request->file('image')->store('news_images', 'public');
        }
    
        $news->save();
    
        return redirect()->route('admin.news.index')->with('success', 'Novedad actualizada correctamente.');
    }
    


    public function destroy($id)
    {
        $news = News::findOrFail($id);


        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }


        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Novedad eliminada correctamente.');
    }
}
