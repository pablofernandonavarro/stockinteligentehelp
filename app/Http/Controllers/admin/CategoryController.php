<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'))->with('mesagge', 'La Categoría se actualizó con exíto');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $slug = Str::slug($validatedData['name'], '-');
        $category = Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['name'],
        ]);

        return redirect()->route('admin.categories.index', compact('category'))->with('mesagge', 'La Categoría se creo con exíto');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category  $category)
    {
        return view('admin.categories.show', compact('category'))->with('mesagge', 'La Categoría se actualizó con exíto');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category  $category)
    {

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $slug = Str::slug($validatedData['name'], '-');
        $category->update([
            'name' => $validatedData['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categories.index', compact('category'))
            ->with('mesagge', 'La Categoría se actualizó con exíto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('mesagge', 'La Categoría se eliminó con exíto');
    }
}
