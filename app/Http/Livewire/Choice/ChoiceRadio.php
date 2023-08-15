<?php

namespace App\Http\Livewire\Choice;

use App\Models\Choice;
use Livewire\Component;

class ChoiceRadio extends Component
{
    public $choice;
    public $value;

    protected $listeners = ['render'];

    protected $rules = [
        'value' => 'required',
    ];

    public function mount($choice)
    {
        $this->choice = Choice::find($choice);
        $this->value = $this->choice->value;
    }

    public function render()
    {
        $lastChoice = Choice::
        where('question_id',$this->choice->question_id)
        ->latest()
        ->first();
        $countChoices = Choice::where('question_id',$this->choice->question_id)->count();
        return view('livewire.choice.choice-radio', compact('lastChoice','countChoices'));
    }

    public function updatedValue(){
        $this->validate(['value' => 'required']);
        $this->choice->value = $this->value;
        $this->choice->save();
    }

    public function addChoice()
    {
        Choice::create([
            'value' => 'Nueva opción',
            'question_id' => $this->choice->question_id,
        ]);
        $this->render();
        $this->emitTo('questions.question','render');
    }

    public function deleteChoice(){
        $this->choice->delete();
        $this->emitTo('choice.choice-radio','render');
        $this->emitTo('questions.question','render');
    }

}
