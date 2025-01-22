<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NewsController;
use App\Mail\faqmail;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
Use App\Http\Controllers\ContactController;
use App\Models\News;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




// !---------------------------------------------- Rutas Aplicacion -------------------------------------------------------------------------------

Route::get('/',[NewsController::class,'index'])->name('news.index');
Route::get('/news/{news}',[NewsController::class,'show'])->name('news.show');
Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::get('category/{category}',[PostController::class,'category'])->name('posts.category');
Route::get('etiqueta/{etiqueta}',[PostController::class,'etiqueta'])->name('posts.etiqueta');
Route::get('/posts',[PostController::class,'index'])->name('posts.index');



Route::get('/faqs',[FaqController::class,'index'])->name('faqs');
Route::get('/faqs/formfaqs',[FaqController::class,'formfaqs'])->name('faqs.formfaqs');
Route::post('/faqs/formfaqs',[FaqController::class,'process'])->name('faqs.process');



