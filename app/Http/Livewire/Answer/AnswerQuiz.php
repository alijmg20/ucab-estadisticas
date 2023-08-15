<?php

namespace App\Http\Livewire\Answer;

use App\Models\Quiz;
use Livewire\Component;

class AnswerQuiz extends Component
{
    public $quiz; //Quiz que se va a generar para el envio
    public $answers = []; //Aqui van todas las respuestas del quiz
    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }
    public function render()
    {
        return view('livewire.answer.answer-quiz');
    }

    public function submitAnswers(){
        dd($this->quiz);
    }
}
