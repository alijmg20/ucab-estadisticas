<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Variable;
use Livewire\Component;

class Graphic extends Component
{
    public $file;
    public $content;
    public function mount($file)
    {
        $this->file = $file;
    }
    public function render()
    {
        $variables = Variable::where('file_id', $this->file->id)->where('status',2)
        ->get();
        return view('livewire.graphics.graphic',compact('variables'));
    }
}
