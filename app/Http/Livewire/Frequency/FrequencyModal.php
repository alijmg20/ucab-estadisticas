<?php

namespace App\Http\Livewire\Frequency;

use App\Models\Frequency;
use Livewire\Component;

class FrequencyModal extends Component
{

    public $open = false;
    public $name,$value,$position,$variable_id,$frequency_id,$status = 0;
    public $frequency; //Variable para editar
    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'value' => 'required',
        // 'status' => 'required',
        'variable_id' =>'',
        'frequency_id' => '',
        'position' => '',
    ];

    public function render()
    {
        return view('livewire.Frequency.frequency-modal');
    }

    public function save()
    {
        $this->validate();
        $this->frequency->name = $this->name;
        $this->frequency->value = $this->value;
        // $this->frequency->status = $this->status ? '2' : '1';
        $this->frequency->save();
        $this->resetInputDefaults();

        $this->emit('frequencyAlert', 'terminado!', 'Frecuencia actualizada exitosamente');
        $this->emitTo('frequency.frequency-controller', 'render');
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        
        $this->emitTo('graphics.multiple.graphic', 'render');
        $this->emitTo('graphics.multiple.graphic', 'loadGraphic');
        $this->emitTo('graphics.multiple.multiple-table', 'render');

        $this->emitTo('graphics.qualitatives.variable-qualitative', 'render');
        $this->emitTo('graphics.qualitatives.variable-qualitative', 'loadWordCloud');
        $this->emitTo('graphics.qualitatives.qualitative-table', 'render');
    }

    public function edit($id)
    {
        $this->reset(['name', 'value', 'position','variable_id','frequency_id','status']);
        $this->frequency = Frequency::find($id);
        $this->frequency_id = $this->frequency->id;
        $this->variable_id = $this->frequency->variable_id;
        $this->name = $this->frequency->name;
        $this->value = $this->frequency->value;
        $this->position = $this->frequency->position;
        // $this->status =  $this->frequency->status == 2 ? 1 : 0;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name', 'value', 'position','variable_id','frequency_id','status']);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open','name', 'value', 'position','variable_id','frequency_id','status']);
    }

}
