<?php

namespace App\Http\Livewire\Graphics\Qualitatives;

use App\Models\Variable;
use Livewire\Component;
use voku\helper\StopWords;
use Illuminate\Support\Str;

class VariableQualitative extends Component
{
    public $variable;

    protected $listeners = ['render','loadWordCloud'];

    public function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        return view('livewire.graphics.qualitatives.variable-qualitative');
    }

    public function loadWordCloud()
    {
        if ($this->variable) {
            $frequencies = $this->variable->frequencies;
            $dataQualitative = [];
            foreach ($frequencies as $word) {
                $dataQualitative[] = [$word->name,rand(5, 15)];
            }

            $this->emit('cloudShow',$dataQualitative,$this->variable);
        }
    }  

}
