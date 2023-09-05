<?php

namespace App\Http\Livewire\Options;

use App\Models\VariableOption;
use Livewire\Component;

class OptionModal extends Component
{

    public $open = false;
    public $name,$variable_id,$option_id;
    public $option; //Variable para editar
    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'variable_id' =>'',
        'option_id' => '',
    ];

    public function render()
    {
        return view('livewire.options.option-modal');
    }

    public function save()
    {
        $this->validate();
        $this->option->name = $this->name;
        $this->option->save();
        $this->resetInputDefaults();

        $this->emit('optionAlert', 'terminado!', 'Opción actualizada exitosamente');
        $this->emitTo('options.option-controller', 'render');
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        
        // $this->emitTo('graphics.multiple.graphic', 'render');
        // $this->emitTo('graphics.multiple.graphic', 'loadGraphic');
        // $this->emitTo('graphics.multiple.multiple-table', 'render');

        // $this->emitTo('graphics.qualitatives.variable-qualitative', 'render');
        // $this->emitTo('graphics.qualitatives.variable-qualitative', 'loadWordCloud');
        // $this->emitTo('graphics.qualitatives.qualitative-table', 'render');

        $this->emitTo('graphics.checkbox.variable-checkbox', 'render');
        $this->emitTo('graphics.checkbox.variable-checkbox', 'loadCheckbox');
        $this->emitTo('graphics.checkbox.checkbox-table', 'render');
    }

    public function edit($id)
    {
        $this->reset(['name','variable_id','option_id']);
        $this->option = VariableOption::find($id);
        $this->option_id = $this->option->id;
        $this->variable_id = $this->option->variable_id;
        $this->name = $this->option->name;
        $this->open = true;
    }

    public function openModal()
    {
        $this->reset(['name','variable_id','option_id']);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open','name','variable_id','option_id']);
    }


}
