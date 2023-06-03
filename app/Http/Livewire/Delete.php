<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Delete extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $orderBy = 'id';
    public $sortBy = 'asc';
    public $sortBy_id = 'asc';
    public $sortBy_name = 'asc';
    public $sortBy_role = 'asc';
    public $sortBy_email = 'asc';

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
            case 'role_id':
                $this->sortBy_role = $this->SortingBy($this->sortBy_role);
                $this->sortBy = $this->sortBy_role;
                break;
            case 'email':
                $this->sortBy_email = $this->SortingBy($this->sortBy_email);
                $this->sortBy = $this->sortBy_email;
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
        $users = User::onlyTrashed()->orderBy($this->orderBy,$this->sortBy)->paginate(5);
        return view('livewire.delete',compact('users'));
    }
}