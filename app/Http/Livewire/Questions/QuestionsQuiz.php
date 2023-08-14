<?php

namespace App\Http\Livewire\Questions;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;

class QuestionsQuiz extends Component
{
    public $quiz ; //Variable que viene de quiz-edit
    protected $questions = [];
    public $readyToLoad = false;

    protected $listeners = ['render'];

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }

    public function loadQuestionsQuizzes()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $questions = Question::where('quizzes_id', $this->quiz->id)
            ->get();
        } else {
            $questions = [];
        }
        $this->questions = $questions;
        return view('livewire.questions.questions-quiz',compact('questions'));
    }

    public function add(){
        $question = Question::create([
            'name' => 'Pregunta sin titulo',
            'quizzes_id' => $this->quiz->id,
            'position' => 1,
        ]);
        Choice::create([
            'value' => 'Nueva opción',
            'question_id' => $question->id,
            'position' => 1,
        ]);
        $this->emit('questionAlert', 'success', 'pregunta añadida');
    }
}
