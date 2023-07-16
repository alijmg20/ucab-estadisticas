<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Livewire\Component;

class GroupModal extends Component
{

    public $open = false;
    public $name,$value,$position,$variable_id,$group_id,$status = 0;
    public $group; //Variable para editar
    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'value' => 'required',
        'status' => 'required',
        'variable_id' =>'',
        'group_id' => '',
        'position' => '',
    ];

    public function render()
    {
        return view('livewire.groups.group-modal');
    }

    public function save()
    {
        $this->validate();
        $this->group->name = $this->name;
        $this->group->value = $this->value;
        $this->group->status = $this->status ? '2' : '1';
        $this->group->save();
        $this->resetInputDefaults();

        $this->emit('groupAlert', 'terminado!', 'Grupo actualizado exitosamente');
        $this->emitTo('groups.group-controller', 'render');
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

    public function edit($id)
    {
        $this->reset(['name', 'value', 'position','variable_id','group_id','status']);
        $this->group = Group::find($id);
        $this->group_id = $this->group->id;
        $this->variable_id = $this->group->variable_id;
        $this->name = $this->group->name;
        $this->value = $this->group->value;
        $this->position = $this->group->position;
        $this->status =  $this->group->status == 2 ? 1 : 0;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name', 'value', 'position','variable_id','group_id','status']);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open','name', 'value', 'position','variable_id','group_id','status']);
    }

}
