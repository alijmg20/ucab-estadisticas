<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role as ModelsRole;

class UserModal extends Component
{
    use WithPagination;


    public $open = false;
    public $searchRole = '';

    public $name,$email,$password,$password_confirmation,$user;
    protected $roles = [];

    public $roles_id = [];

    protected $listeners = ['edit'];


    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required',
        'password_confirmation' => 'required',
    ];

    public function updatingSearchRole()
    {
        $this->resetPage('rolesPageModal');
    }

    public function render()
    {
        $this->roles = $roles = ModelsRole::where('id','like','%'.$this->searchRole.'%')
        ->orwhere('name','like','%'.$this->searchRole.'%')
        ->paginate(5,['*'], 'rolesPageModal');
        return view('livewire.user.user-modal',compact('roles'));
    }

    public function openModal(){
        $this->reset(['name','email','password','password_confirmation','roles_id','user']);
        $this->open = true;
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function save(){
        $this->rules['email'] = $this->user ? 'required' : 'required|unique:users,email';
        $this->validate();

        if($this->password === $this->password_confirmation){
            $user = User::updateOrCreate([
                'id' => $this->user ? $this->user->id : '' ,
            ],[
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            if($this->roles_id && count($this->roles_id)){
                $user->roles()->sync($this->roles_id);
            }
            $this->emitTo('user.user-controller','render');
            $this->emit('userAlert','terminado!',$this->user ? 'Usuario actualizado exitosamente' :
             'Usuario creado exitosamente');
            $this->resetInputDefaults();
        }else{
            $this->addError('password', 'Las contraseñas no coinciden');
            $this->addError('password_confirmation', 'Las contraseñas no coinciden');
        }
    }

    public function edit($id){
        $this->reset(['name','email','password','password_confirmation','roles_id','user']);
        $this->user = $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles_id = $user->roles->pluck('id')
        ->all();
        $this->open = true;
    }

    public function resetInputDefaults(){
        $this->reset(['open','name','email','password','password_confirmation','roles_id','user']);
    }

}
