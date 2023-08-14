<?php

namespace App\Http\Livewire\Front;

use App\Models\Variable;
use Livewire\Component;

class FrontGraphics extends Component
{
    
    public $file;
    public $variables = [];
    public $variablesActive = [];
    public $readyToLoad = false;
    protected $listeners = ['render'];
    public function mount($file){
        $this->file = $file;
    }

    public function loadgraphic(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        $variables = Variable::where('file_id', $this->file->id)
        ->where('status', 2)
        ->get();
        $this->variables = $variables;
        $this->showGraphics();
        return view('livewire.front.front-graphics');
    }
    public function showGraphics()
    {
        $variables = $this->variables;
        $variablesActive = [];
        foreach($variables as $variable){
            if($variable->frequencies){
                $variablesActive[] = $variable;
            }
        }
        $this->variablesActive = $variablesActive;
    }
}
