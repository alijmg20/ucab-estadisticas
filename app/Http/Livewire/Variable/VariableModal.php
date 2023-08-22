<?php

namespace App\Http\Livewire\Variable;

use App\Models\Graphictype;
use App\Models\Variable;
use Livewire\Component;

class VariableModal extends Component
{
    public $open = false;
    public $name,$project_id,$variable_id,$file_id,$status = 0,$graphic_type;
    public $graphicList;
    public $variable; //Variable para editar
    protected $listeners = ['edit'];


    protected $rules = [
        'name' => 'required',
        'status' => 'required',
        'variable_id' =>'',
        'graphic_type' => 'required',
    ];

    public function mount(){
        $this->graphicList = Graphictype::all();
    }

    public function render()
    {
        $graphicList = $this->graphicList;
        return view('livewire.variable.variable-modal');
    }

        public function save()
    {
        $this->validate();
        $this->variable->name = $this->name;
        $this->variable->status = $this->status ? '2' : '1';
        $this->variable->graphictype_id = $this->graphic_type;
        $this->variable->save();
        $this->resetInputDefaults();

        $this->emitTo('variable.variable-controller', 'render');
        $this->emitTo('graphics.graphic-controller','render');
        $this->emitTo('graphics.graphic-details','render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic','render');
        $this->emitTo('graphics.graphic','loadGraphic');
        
        
        $this->emit('variableAlert', 'terminado!', 'Variable actualizada exitosamente');
    }

    public function edit($id)
    {
        $this->reset(['name', 'project_id', 'file_id','status', 'variable','variable_id']);
        $this->variable = Variable::find($id);
        $this->variable_id = $this->variable->id;
        $this->name = $this->variable->name;
        $this->status =  $this->variable->status == 2 ? 1 : 0;
        $this->file_id = $this->variable->file_id;
        $this->project_id = $this->variable->project_id;
        $this->graphic_type = $this->variable->graphictype_id;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name', 'project_id', 'file_id','status', 'variable','variable_id','graphic_type']);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open', 'name', 'project_id', 'file_id','status', 'variable','variable_id','graphic_type']);
    }

}
