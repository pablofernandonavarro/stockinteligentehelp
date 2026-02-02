<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchPosts extends Component
{
    public string $search = '';
    public bool $showResults = false;

    public function updatedSearch()
    {
        $this->showResults = strlen($this->search) >= 2;
    }

    public function selectPost($postId)
    {
        return $this->redirect(route('posts.show', $postId), navigate: true);
    }

    public function hideResults()
    {
        $this->showResults = false;
    }

    public function render()
    {
        $posts = collect();

        if (strlen($this->search) >= 2) {
            $query = Post::with(['category', 'etiquetas'])
                ->where('status', 2)
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('extract', 'like', '%' . $this->search . '%');
                });

            // Excluir Stock_interna para no admins
            if (!auth()->check() || !auth()->user()->hasRole('Admin')) {
                $query->whereHas('category', function ($q) {
                    $q->where('name', '!=', 'Stock_interna');
                });
            }

            $posts = $query->latest()->take(8)->get();
        }

        return view('livewire.search-posts', [
            'posts' => $posts
        ]);
    }
}
