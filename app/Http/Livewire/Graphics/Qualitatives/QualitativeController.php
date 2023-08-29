<?php

namespace App\Http\Livewire\Graphics\Qualitatives;

use App\Models\File;
use App\Models\Variable;
use Livewire\Component;

class QualitativeController extends Component
{
    public $file;
    public $variables = [];
    public $variablesActive = [];

    protected $listeners = ['render'];

    public function mount($file)
    {
        $this->file = File::find($file);
    }

    public function render()
    {
        if($this->file){
        $variables = Variable::where('file_id', $this->file->id)
        ->where('status', 2)
        ->where('variabletype_id',1)
        ->get();
        $this->variables = $variables;
        $this->showGraphics();
    }
        return view('livewire.graphics.qualitatives.qualitative-controller');
    }

    public function showGraphics()
    {
        $variables = $this->variables;
        $variablesActive = [];
        foreach($variables as $variable){
            // if($variable->frequencies){
                $variablesActive[] = $variable;
            // }
        }
        $this->variablesActive = $variablesActive;
    }

}
