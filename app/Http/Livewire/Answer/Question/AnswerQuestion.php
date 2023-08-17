<?php

namespace App\Http\Livewire\Answer\Question;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class AnswerQuestion extends Component
{
    use WithPagination;

    public $quiz;
    public $readyToLoad = false;
    protected $questions = [];
    public $answerQuestionPage = 1;
    public $pageAux = 1;
    protected $listeners = ['render'];
    public function mount($quiz)
    {
        $this->quiz = Quiz::find($quiz);
    }

    public function updatedAnswerQuestionPage(){
        $this->pageAux = $this->answerQuestionPage;
    }

    public function gotoAnswer(){
        $this->gotoPage($this->pageAux,'answerQuestionPage');
        $this->pageAux = $this->answerQuestionPage;
    }

    public function resetAnswerPage(){
        $this->pageAux = 1;
        $this->resetPage('answerQuestionPage');
    }

    public function loadAnswerQuestion()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $questions = Question::where('quiz_id', $this->quiz->id)
                ->paginate(1, ['*'], 'answerQuestionPage');
        } else {
            $questions = [];
        }
        $this->questions = $questions;
        return view('livewire.answer.question.answer-question', compact('questions'));
    }
}
