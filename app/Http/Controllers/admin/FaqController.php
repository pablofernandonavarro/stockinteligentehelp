<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::paginate(10);
        return view("admin.faqs.index", compact('faqs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.faqs.create", compact('categories'));
    }

    public function store(FaqRequest $request)
    {
        Faq::create($request->only(['question', 'answer', 'category_id', 'is_active', 'priority']));
        return redirect()->route('admin.faqs.index')->with('success', 'Pregunta Frecuente creada exitosamente.');
    }

    public function show(Faq $faq)
    {
        $faq->load('category'); // Asegúrate de tener la relación correcta
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        $categories = Category::all();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->only(['question', 'answer', 'category_id', 'is_active', 'priority']));
        return to_route('admin.faqs.index')->with('success', 'Pregunta Frecuente actualizada exitosamente.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return to_route('admin.faqs.index')->with('success', 'La pregunta frecuente fue eliminada con éxito.');
    }
}
