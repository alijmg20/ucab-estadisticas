<?php

namespace App\Http\Livewire\Choice;

use App\Models\Choice;
use Livewire\Component;

class ChoiceRadio extends Component
{
    public $choice;
    public $value;
    public function mount($choice){
        $this->choice = Choice::find($choice);
        $this->value = $this->choice->value;
    }
    public function render()
    {
        return view('livewire.choice.choice-radio');
    }
}
