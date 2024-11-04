<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Faq;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', 1)->get();

        return View('faqs.index', compact('faqs'));
    }

    public function formfaqs(Faq $faqs)
    {

        return view('faqs.formfaqs', compact('faqs',));
    }

    public function process(ContactRequest $request)
    {   
       
        $createdBy = auth()->check() ? auth()->user()->id : null;
        
        Faq::create([
            'question'    => $request->input('question'),
            'answer'      => ' ',           
            'category_id' => 1,             
            'is_active'   => false,          
            'priority'    => 0,
            'created_by' => $createdBy,                
        ]);
    
        return redirect()->route('posts.index')->with('message', 'Pregunta Frecuente creada exitosamente.');
    }
}
