<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etiqueta;
use Illuminate\Support\Str;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = Etiqueta::all();
        return view('admin.etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Etiqueta $etiqueta)
    {
        $coloresTailwind = [
            'gray' => 'Color gris',
            'red' => 'Color rojo',
            'yellow' => 'Color amarillo',
            'green' => 'Color verde',
            'blue' => 'Color azul',
            'indigo' => 'Color indigo',
            'purple' => 'Color Purpura',
            'pink' => 'Color rosa',
        ];
        return view('admin.etiquetas.create', compact('etiqueta','coloresTailwind'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Etiqueta $etiqueta)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
        $slug = Str::slug($validatedData['name'], '-');
        $etiqueta->create([
            'name' => $validatedData['name'],
            'color' => $validatedData['color'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.etiquetas.index', compact('etiqueta'))
            ->with('mesagge', 'La Etiqueta se creo con exíto');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etiqueta $etiqueta)
    {
        return view('admin.etiquetas.show', compact('etiqueta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etiqueta $etiqueta)
    {
        $coloresTailwind = [
            'gray' => 'Color gris',
            'red' => 'Color rojo',
            'yellow' => 'Color amarillo',
            'green' => 'Color verde',
            'blue' => 'Color azul',
            'indigo' => 'Color indigo',
            'purple' => 'Color Purpura',
            'pink' => 'Color rosa',
        ];
        return view('admin.etiquetas.edit', compact('etiqueta','coloresTailwind'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Etiqueta $etiqueta)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
        $slug = Str::slug($validatedData['name'], '-');
        $etiqueta->update([
            'name' => $validatedData['name'],
            'color' => $validatedData['color'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.etiquetas.index', compact('etiqueta'))
            ->with('mesagge', 'La Etiqueta se actualizó con exíto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();
        return redirect()->route('admin.etiquetas.index')->with('mesagge', 'La Etiqueta se eliminó con exíto');;
    }
}
