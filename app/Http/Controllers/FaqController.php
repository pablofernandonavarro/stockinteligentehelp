<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Faq;
use App\Mail\faqmail;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', 1)->get();

        return View('faqs.index', compact('faqs'));
    }

    public function formfaqs(Faq $faqs)
    {

        return view('faqs.formfaqs', compact('faqs', ));
    }

    public function process(ContactRequest $request)
    {

        $createdBy = auth()->check() ? auth()->user()->id : null;

        $faq = Faq::create([
            'company' => $request->input('company'),
            'question' => $request->input('question'),
            'answer' => ' ',
            'category_id' => 1,
            'is_active' => false,
            'priority' => 0,
            'created_by' => $createdBy,
        ]);
        Mail::to('pablo@stockinteligente.com')
            ->cc(['info@stockinteligente.com', 'pablofernandonavarro@gmail.com'])
            ->send(new faqmail($faq));

        return redirect()->route('posts.index')->with('message', 'La consulta fue enviada exitosamente.');
    }
}
