<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{

    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $entrys = [2, 5, 10, 20, 50, 100], $cant = '5';
    public $readyToLoad = false;

    protected $roles = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '5'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage('RolesPage');
    }

    public function updatingCant()
    {
        $this->resetPage('RolesPage');
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $roles = Role::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'RolesPage');
        } else {
            $roles = [];
        }
        $this->roles = $roles;
        return view('livewire.role.role-controller', compact('roles'));
    }

    public function loadRoles()
    {
        $this->readyToLoad = true;
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
        $role = Role::find($id);
        $role->delete();
    }
}
