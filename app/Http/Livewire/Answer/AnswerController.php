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

    public function render()
    {
        $this->answers = QuizUser::where('quiz_id',$this->quiz->id)->get();
        $this->emitTo('answer.summary.answer-summary','render');
        $this->emitTo('answer.question.answer-question','render');
        $this->emitTo('answer.individual.answer-individual','render');
        return view('livewire.answer.answer-controller');
    }
}
