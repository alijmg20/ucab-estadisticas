<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class QuizShareModal extends Component
{

    public $open = false;
    public $share = '';
    public $quiz;

    protected $listeners = ['viewquiz'];

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
        $this->share = route('answer.index',$this->quiz);
    }

    public function render()
    {
        return view('livewire.quiz.quiz-share-modal');
    }

    public function viewquiz(){
        $this->open = true;
    }

    public function closeModal(){
        $this->open = false;
    }
}
