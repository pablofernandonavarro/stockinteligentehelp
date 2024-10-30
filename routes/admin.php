<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EtiquetaController;
use App\Http\Controllers\admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\FaqController;
use App\Livewire\Admin\CrudFaqs;
use App\Livewire\Admin\Faqindex;

Route::get('',[HomeController::class,'index'])->name('admin.home');

Route::resource('users',UserController::class)->names('admin.users')->except(['show']);;

Route::resource('roles',RoleController::class)->names('admin.roles');

Route::resource('categories',CategoryController::class)->names('admin.categories');

Route::resource('etiquetas',EtiquetaController::class)->names('admin.etiquetas');

Route::resource('posts',PostController::class)->names('admin.posts');

Route::resource('faqs',FaqController::class)->names('admin.faqs');

Route::get('search',Faqindex::class)->name('admin.faqs.search');
