<?php

namespace App\Http\Livewire\Answer\Summary;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;

class AnswerSummary extends Component
{

    public $quiz;
    public $questions;
    protected $listeners = ['render'];
    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }

    public function render()
    {
        $this->questions = Question::where('quiz_id',$this->quiz->id)
        ->get();
        $this->emitTo('answer.summary.summary-graphic','loadSummary');
        return view('livewire.answer.summary.answer-summary');
    }
}
