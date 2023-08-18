<?php

namespace App\Http\Livewire\Answer;

use App\Models\Quiz;
use Livewire\Component;

class Answered extends Component
{
    public $quiz;
    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }
    public function render()
    {
        return view('livewire.answer.answered');
    }
}
