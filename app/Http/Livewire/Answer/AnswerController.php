<?php

namespace App\Http\Livewire\Answer;

use App\Models\Quiz;
use App\Models\QuizUser;
use Livewire\Component;

class AnswerController extends Component
{
    public $quiz;
    public $answers;
    public $content = 1;
    protected $listeners = ['render'];

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }

    public function updateTab($content){
        $this->content = $content;
        if($content == 1){
            $this->emitTo('answer.summary.answer-summary','render');
        }else if($content == 2){
            $this->emitTo('answer.question.answer-question','render');
        }else if($content == 3){
            $this->emitTo('answer.individual.answer-individual','render');
        }
    }

    public function updateQuestion($content){

    }

    public function render()
    {
        $this->answers = QuizUser::where('quiz_id',$this->quiz->id)->get();
        return view('livewire.answer.answer-controller');
    }
}
