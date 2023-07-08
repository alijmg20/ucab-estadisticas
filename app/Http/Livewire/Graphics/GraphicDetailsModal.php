<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Data;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraphicDetailsModal extends Component
{
    public $open = false;
    public $variable; //variable recibida
    protected $listeners = ['openModal'];
    public $max = [],$min = [];
    public function render()
    {
        return view('livewire.graphics.graphic-details-modal');
    }

    public function openModal($variable)
    {
        $this->reset(['variable']);
        $this->variable = Variable::find($variable);
        $this->max = $this->calcMaxOrMin($this->variable->id);
        $this->min = $this->calcMaxOrMin($this->variable->id,'asc');
        $this->open = true;
    }

    public function calcMaxOrMin($variable,$direction = 'desc'){
        $calc = Data::select('value', DB::raw('count(*) as y'))
        ->where('variable_id', $variable)
        ->groupBy('value')
        ->orderBy('y',$direction)
        ->pluck('y','value')
        ->toArray();
        return [key($calc) => reset($calc)];
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
