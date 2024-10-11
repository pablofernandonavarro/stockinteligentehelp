<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search = "";

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $posts = Post::orderBy("created_at", "desc")
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
