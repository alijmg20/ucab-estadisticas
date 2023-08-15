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
            $questions = Question::where('quiz_id', $this->quiz->id)
            ->orderBy('position', 'asc')
            ->get();
        } else {
            $questions = [];
        }
        $this->questions = $questions;
        return view('livewire.questions.questions-quiz',compact('questions'));
    }

    public function add(){ 
        $this->quiz->questions->count() ? 
        $position = Question::where('quiz_id', $this->quiz->id)
        ->orderBy('position', 'desc')->first()->position + 1
        :$position = 1;
        $question = Question::create([
            'name' => 'Pregunta sin titulo',
            'quiz_id' => $this->quiz->id,
            'position' => $position,
        ]);
        Choice::create([
            'value' => 'Nueva opción',
            'question_id' => $question->id,
        ]);
        $this->emit('questionAlert', 'success', 'pregunta añadida');
    }
    
}
