<?php

namespace App\Http\Livewire\Answer\Individual;


use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizUser;
use Livewire\Component;
use Livewire\WithPagination;

class AnswerIndividual extends Component
{

    use WithPagination;

    public $quiz;
    public $AnswerQuiz;
    public $readyToLoad = false;
    protected $quizUsers = [];
    public $answerIndividualPage = 1;
    public $pageAux = 1;
    protected $listeners = ['render'];

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }

    public function updatedAnswerIndividualPage(){
        $this->pageAux = $this->answerIndividualPage;
    }

    public function gotoAnswerIndividual(){
        $this->gotoPage($this->pageAux,'answerIndividualPage');
        $this->pageAux = $this->answerIndividualPage;
    }

    public function resetAnswerIndividualPage(){
        $this->pageAux = 1;
        $this->resetPage('answerIndividualPage');
    }

    public function loadAnswerIndividual(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $quizUsers = QuizUser::where('quiz_id', $this->quiz->id)
                ->paginate(1, ['*'], 'answerIndividualPage');
        } else {
            $quizUsers = [];
        }
        $this->quizUsers = $quizUsers;
        return view('livewire.answer.individual.answer-individual',compact('quizUsers'));
    }
}
