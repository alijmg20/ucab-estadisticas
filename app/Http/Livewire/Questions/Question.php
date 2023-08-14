<?php

namespace App\Http\Livewire\Questions;

use App\Models\Choice;
use App\Models\Question as ModelsQuestion;
use Livewire\Component;

class Question extends Component
{

    public $question; //variable que viene de questions-quiz
    public $name,$typequestion,$required = false;
    public $entrysTypeQuestions = [
        ['id' => 1,'type' => 'Texto'],
        ['id' => 2,'type' => 'Opción multiple']
    ];
    protected $choices = [];

    
    protected $rules = [
        'name' => 'required',
        'typequestion' => 'required',
        'required' => 'required',
    ];

    public function mount($question){
        $this->question = ModelsQuestion::find($question);
        $this->name = $this->question->name;
        $this->typequestion = $this->question->typequestion;
        $this->required = $this->question->required == 1 ? false : true;
    }

    public function updatedName()
    {
        $this->dispatchBrowserEvent('updateTextareaHeight');
    }

    public function render()
    {
        $choices = Choice::where('question_id',$this->question->id)->get();
        return view('livewire.questions.question',compact('choices'));
    }

    public function save($id){
        $this->validate();
        $question = ModelsQuestion::find($id);
        $question->name = $this->name;
        $question->required = $this->required == true ? 2 : 1;
        $question->typequestion = $this->typequestion;
        $question->save();
        $this->emit('questionAlert', 'success', 'pregunta actualizada ');
    }

    public function delete($id){
        $question = ModelsQuestion::find($id);
        $question->delete();
        $this->emit('questionDelete', 'success', 'pregunta eliminada ');
        $this->emitTo('questions.questions-quiz','render');
        $this->render();
    }

}
