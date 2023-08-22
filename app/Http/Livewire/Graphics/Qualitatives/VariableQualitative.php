<?php

namespace App\Http\Livewire\Graphics\Qualitatives;

use App\Models\Variable;
use Livewire\Component;

class VariableQualitative extends Component
{
    public $variable;

    public function mount($variable){
        $this->variable = Variable::find($variable);
    }


    public function render()
    {
        return view('livewire.graphics.qualitatives.variable-qualitative');
    }
}
