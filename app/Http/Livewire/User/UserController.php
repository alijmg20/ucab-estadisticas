<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserController extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    

    public $entrys = [5, 10, 20, 50, 100], $cant = '5';
    public $readyToLoad = false;

    protected $users = [];

    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function updatingCant(){
        $this->resetPage('usersPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('usersPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $users = $this->users = User::where('id', 'like', '%' . $this->search . '%')
                ->orwhere('name', 'like', '%' . $this->search . '%')
                ->orwhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'usersPage');
        } else {
            $users = [];
        }
        return view('livewire.user.user-controller', compact('users'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
