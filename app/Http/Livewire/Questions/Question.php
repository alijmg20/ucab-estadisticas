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
    protected $listeners = ['render'];
    
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
        $this->validate(['name' => 'required']);
        $this->question->name = $this->name;
        $this->question->save();
        // $this->emit('updateTextareaContent', $this->name);
    }

    public function updatedTypequestion()
    {
        $this->validate(['typequestion' => 'required']);
        $this->question->typequestion = $this->typequestion;
        if($this->question->typequestion == 1){
            $this->question->choices()->delete();
            $newChoice = new Choice(['value' => 'Nueva opción']);
            $this->question->choices()->save($newChoice);
        }
        $this->question->save();
    }

    public function updatedRequired()
    {
        $this->validate(['required' => 'required']);
        $this->question->required = $this->required == true ? 2 : 1;
        $this->question->save();
    }

    public function render()
    {
        $choices = Choice::where('question_id',$this->question->id)->get();
        return view('livewire.questions.question',compact('choices'));
    }

    public function delete($id){
        $questiond = ModelsQuestion::find($id);
        if($questiond != null){
            $questions = ModelsQuestion::where('quiz_id',$this->question->quiz_id)->get();
            foreach ($questions as $question) {
                if($questiond->position < $question->position ){
                    $question->position = (int) $question->position - 1;
                    $question->save();
                }else if($questiond->position == $question->position);
            }
        }
        $questiond->delete();
        $this->emit('questionDelete', 'success', 'pregunta eliminada ');
        $this->emitTo('questions.questions-quiz','render');
        $this->render();
    }

}
