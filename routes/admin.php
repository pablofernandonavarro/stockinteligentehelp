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
use App\Livewire\Admin\Customers;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\NewsController;

Route::get('',[HomeController::class,'index'])->name('admin.home');

Route::resource('users',UserController::class)->names('admin.users')->except(['show']);;

Route::resource('roles',RoleController::class)->names('admin.roles');

Route::resource('categories',CategoryController::class)->names('admin.categories');

Route::resource('etiquetas',EtiquetaController::class)->names('admin.etiquetas');

Route::resource('posts',PostController::class)->names('admin.posts');
Route::resource('news',NewsController::class)->names('admin.news');
Route::resource('faqs',FaqController::class)->names('admin.faqs');

Route::get('search',Faqindex::class)->name('admin.faqs.search');
Route::get('customers',Customers::class)->name('admin.customers');

Route::get('customersshow/{customer}',[CustomerController::class,'show'])->name('admin.customers.show');
