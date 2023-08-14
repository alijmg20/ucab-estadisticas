<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Project;
use App\Models\Quiz;
use Livewire\Component;
use Illuminate\Support\Str;
class QuizEdit extends Component
{

    public $quiz;
    public $name,$description,$status = 0;
    
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'status' => 'required',
    ];

    public function mount($quiz){
        $this->quiz = Quiz::find($quiz);
        $this->name = $this->quiz->name;
        $this->description = $this->quiz->description;
        $this->status = $this->quiz->status;
    }

    public function render()
    {
        return view('livewire.quiz.quiz-edit');
    }

    public function updatedDescription()
    {
        $this->dispatchBrowserEvent('updateTextareaHeight');
    }

    public function save(){
        $this->validate();
        $this->name != $this->quiz->name ? $redirect = 1 : $redirect = 0;
        $this->quiz->name = $this->name;
        $this->quiz->description = $this->description;
        $this->quiz->status = $this->status;
        $this->quiz->slug = Str::slug($this->quiz->id.' '.$this->quiz->name);
        $this->quiz->save();
        $this->emit('quizEditAlert', 'terminado!', 'Encuesta actualizada exitosamente');
        if($redirect){
            return redirect()->route('admin.quiz.edit',$this->quiz);
        }
        
    }

    public function back(){
        $project = Project::find($this->quiz->project_id);
        return redirect()->route('admin.files.show',compact('project'));
    }
    
}
