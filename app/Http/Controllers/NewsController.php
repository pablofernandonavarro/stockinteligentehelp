<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;

class NewsController extends Controller
{
    public function index(){
        $news= News::where('status', 'published')->orderBy('created_at', 'desc')->get();

        return view('news.index',compact('news'));
    }
    public function show(News $news){
        $user = User::where('id', $news->author_id)->first();
        
        return view('news.show', compact('news','user'));

    }
}
