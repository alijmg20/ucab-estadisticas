<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleModal extends Component
{

    use WithPagination;

    public $open = false;
    public $searchPermission = '';
    public $name, $permissions_id = [];
    public $role; //Variable para update

    protected $permissions = [];
    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
    ];

    public function render()
    {

        $this->permissions = $permissions = Permission::where('id','like','%'.$this->searchPermission.'%')
        ->orwhere('description','like','%'.$this->searchPermission.'%')
        ->paginate(5,['*'], 'permissionsPageModal');
        return view('livewire.role.role-modal',compact('permissions'));
    }

    public function updatingSearchPermission()
    {
        $this->resetPage('permissionsPageModal');
    }

    public function openModal(){
        $this->reset(['name','permissions_id','role']);
        $this->open = true;
    }

    public function save(){
        $this->validate();
        $role = Role::updateOrCreate([
            'id' => $this->role ? $this->role->id : '',
        ],[
            'name' => $this->name,
        ]);
        if($this->permissions_id && count($this->permissions_id)){
            $role->permissions()->sync($this->permissions_id);
        }
        $this->resetInputDefaults();
        $this->emitTo('role.role-controller','render');
        $this->emit('roleAlert','terminado!',$this->role ? 'Rol de usuario actualizado exitosamente' :
         'Rol de usuario creado exitosamente');
    }

    public function edit($id){
        $this->reset(['name','permissions_id']);
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        $this->permissions_id = $this->role->permissions->pluck('id')
        ->all();
        $this->open = true;
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function resetInputDefaults(){
        $this->reset(['open','name','permissions_id']);
    }

}
