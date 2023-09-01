<?php

namespace App\Http\Livewire\Graphics\Checkbox;

use App\Models\Variable;
use Livewire\Component;

class VariableCheckbox extends Component
{
    public $variable;

    protected $listeners = ['render','loadCheckbox'];

    public function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }
    
    public function render()
    {
        return view('livewire.graphics.checkbox.variable-checkbox');
    }

    public function loadCheckbox()
    {
        if ($this->variable) {
            $frequencies = $this->variable->frequencies;
            // $dataQualitative = [];
            // foreach ($frequencies as $word) {
            //     $dataQualitative[] = [$word->name,rand(5, 15)];
            // }
            // $this->emit('cloudShow',$dataQualitative,$this->variable);
        }
    }  
}
