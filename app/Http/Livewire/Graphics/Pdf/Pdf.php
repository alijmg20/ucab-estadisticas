<?php

namespace App\Http\Livewire\Graphics\Pdf;

use App\Models\File;
use App\Models\Variable;
use Livewire\Component;
use Illuminate\Support\Str;
class Pdf extends Component
{
    public $file;
    public $variables = [];
    public $variablesActive = [];
    public $title;
    public function mount($file){
        $this->file = File::find($file);
    }

    public function render()
    {
        $this->displayVariables();
        $correlations = $this->displayCorrelations();

        $this->title = Str::Slug($this->file->id.' '.$this->file->name);
        return view('livewire.graphics.pdf.pdf',compact('correlations'))
        ->layout('layouts.pdf');
    }

    public function displayVariables(){
        $variables = $this->variables = Variable::where('file_id',$this->file->id)
        ->where('status',2)
        ->get();
        $variablesActive = [];
        foreach($variables as $variable){
                $variablesActive[] = $variable;
        }
        $this->variablesActive = $variablesActive;
    }

    public function displayCorrelations(){
        return $this->file->correlations;

    }

}
