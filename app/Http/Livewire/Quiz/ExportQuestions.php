<?php

namespace App\Http\Livewire\Quiz;

use App\Exports\ExportQuestionsToExcel;
use App\Exports\ExportQuizUsersAnswersToExcel;
use App\Models\Quiz;
use Livewire\Component;

class ExportQuestions extends Component
{

    public $quiz;

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
    }

    public function render()
    {
        return view('livewire.quiz.export-questions');
    }

    public function downloadQuestions(Quiz $quiz){
        
        $export = new ExportQuizUsersAnswersToExcel($quiz->id);
        $export->generateExcel();
    }
}
