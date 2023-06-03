<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Articles extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $orderBy = 'id';
    public $sortBy = 'asc';
    public $sortBy_id = 'asc';
    public $sortBy_name = 'asc';
    public $sortBy_title = 'asc';
    public $sortBy_price = 'asc';
    public $sortBy_views = 'asc';

    public function filter($order)
    {
        $this->orderBy = $order;
        switch ($order) {
            case 'id':
                $this->sortBy_id = $this->SortingBy($this->sortBy_id);
                $this->sortBy = $this->sortBy_id;
                break;
            case 'name':
                $this->sortBy_name = $this->SortingBy($this->sortBy_name);
                $this->sortBy = $this->sortBy_name;
                break;
            case 'title':
                $this->sortBy_title = $this->SortingBy($this->sortBy_title);
                $this->sortBy = $this->sortBy_title;
                break;
            case 'price':
                $this->sortBy_price = $this->SortingBy($this->sortBy_price);
                $this->sortBy = $this->sortBy_price;
                break;
            case 'views':
                $this->sortBy_views = $this->SortingBy($this->sortBy_views);
                $this->sortBy = $this->sortBy_views;
                break;
        }
        
    
    }

    public function SortingBy($by) {
        if($by == 'asc') {
            return 'desc';
        }
        else {
            return'asc';
        }
    }

    public function render()
    {
        return view('livewire.articles',['articles'=>Article::orderBy($this->orderBy,$this->sortBy)->paginate(5),]);
    }
}