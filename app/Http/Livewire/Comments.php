<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $articel_id;

    public function mount($article)
    {
        $this->articel_id = $article->id;
    }


    public function render()
    {
        $comments = Comment::where('article_id', '=', $this->articel_id)->orderBy('id', 'desc')->get();
        $article_id = $this->articel_id;
        return view('livewire.comments', compact('comments', 'article_id'));
    }
}