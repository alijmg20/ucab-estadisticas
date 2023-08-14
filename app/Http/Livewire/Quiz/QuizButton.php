<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Project;
use App\Models\Quiz;
use Livewire\Component;
use Illuminate\Support\Str;
class QuizButton extends Component
{

    public $project;

    public function mount($project){
        $this->project = Project::find($project);
    }

    public function render()
    {
        return view('livewire.quiz.quiz-button');
    }
    public function save(){
        $quiz = Quiz::create([
            'name' => 'Encuesta sin titulo',
            'project_id' => $this->project->id,
            'slug' => Str::slug(''),
        ]);
        $quiz->slug = Str::slug($quiz->id.' '.$quiz->name);
        $quiz->save();
        $this->emitTo('quiz.quiz-controller', 'render');
        $this->emit('quizAlert', 'terminado!', 'Encuesta creada exitosamente');
    }

    
    
}
