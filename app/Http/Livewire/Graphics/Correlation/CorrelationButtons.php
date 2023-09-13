<?php

namespace App\Http\Livewire\Graphics\Correlation;

use App\Models\Correlation;
use Livewire\Component;

class CorrelationButtons extends Component
{
    public $correlation;
    protected $listeners = ['delete', 'edit', ];

    public function mount($correlation){
        $this->correlation = Correlation::find($correlation);
    }

    public function delete()
    {
        $this->emit('correlationDelete', $this->correlation->id);
    }

    public function edit()
    {
        $this->emitTo('graphics.correlation.correlation-modal', 'correlationEdit', $this->correlation->id);
    }

    public function render()
    {
        return view('livewire.graphics.correlation.correlation-buttons');
    }
}
