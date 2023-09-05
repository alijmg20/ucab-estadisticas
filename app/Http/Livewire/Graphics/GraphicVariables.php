<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Variable;
use Livewire\Component;

class GraphicVariables extends Component
{
    public $variables;
    public $file;
    public $readyToLoad = false;
    protected $listeners = ['render'];
    public function mount($file)
    {
        $this->file = $file;
    }

    public function loadgraphicvariables()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $variables = Variable::where('file_id', $this->file->id)
        ->get();
        $this->variables = $variables;
        return view('livewire.graphics.graphic-variables');
    }

    public function status($id){
        $variable = Variable::find($id);
        $variable->status = $variable->status == 2 ? 1 : 2;
        $variable->save();
        $this->emitTo('graphics.graphic-controller','render');
    }

}
