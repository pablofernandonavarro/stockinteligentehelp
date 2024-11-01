<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', 1)->get();

        return View('faqs.index', compact('faqs'));
    }
    public function formfaqs()
    {
        return view('faqs.formfaqs');


    }
}
