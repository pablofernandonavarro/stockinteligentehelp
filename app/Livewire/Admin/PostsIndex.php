<?php

namespace App\Livewire\Admin;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
class PostsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $busqueda="uni" ;
    public function render()
    {
        $posts = Post::orderBy("created_at", "desc")
                ->where('name', 'like', '%' .$this->busqueda. '%')
                ->paginate(10);
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
