<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Variable;
use Livewire\Component;

class GraphicDetailsModal extends Component
{
    public $open = false;
    public $variable; //variable recibida
    protected $listeners = ['openModal'];
    public function render()
    {
        return view('livewire.graphics.graphic-details-modal');
    }

    public function openModal($variable)
    {
        $this->reset(['variable']);
        $this->variable = Variable::find($variable);
        $this->open = true;
    }
    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['variable']);
        $this->open = false;
    }

}
