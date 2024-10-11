<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EtiquetaController;
use App\Http\Controllers\admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;


Route::get('',[HomeController::class,'index'])->name('admin.home');
Route::resource('categories',CategoryController::class)->names('admin.categories');
Route::resource('etiquetas',EtiquetaController::class)->names('admin.etiquetas');
Route::resource('posts',PostController::class)->names('admin.posts');

