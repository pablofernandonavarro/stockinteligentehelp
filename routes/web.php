<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


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


Route::get('/',[PostController::class,'index'])->name('posts.index');
Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::get('category/{category}',[PostController::class,'category'])->name('posts.category');
Route::get('etiqueta/{etiqueta}',[PostController::class,'etiqueta'])->name('posts.etiqueta');

