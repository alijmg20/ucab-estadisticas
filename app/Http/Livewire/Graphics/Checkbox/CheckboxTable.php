<?php

namespace App\Http\Livewire\Graphics\Checkbox;

use App\Models\Variable;
use Livewire\Component;

class CheckboxTable extends Component
{

    public $variable;
    public function mount($variable){
        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        $optionsCount =  "";
        return view('livewire.graphics.checkbox.checkbox-table',compact('optionsCount'));
    }

}
