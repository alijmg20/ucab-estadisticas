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
    public $max = [], $min = [];
    public function render()
    {
        return view('livewire.graphics.graphic-details-modal');
    }

    public function openModal($variable)
    {
        $this->reset(['variable']);
        $this->variable = Variable::find($variable);
        $this->max = $this->calcMaxOrMin($this->variable->id,'desc');
        $this->min = $this->calcMaxOrMin($this->variable->id, 'asc');
        $this->open = true;
    }

    public function calcMaxOrMin($variable, $direction)
    {
        $calc = $this->variable->groups()
            ->orderBy('value', $direction)
            ->pluck('value','name')
            ->toArray();
        $value = reset($calc);
        $total = $this->sumArray($calc);
        $percentage = $this->percentage($value,$total);
        return [key($calc) => $percentage.'%'];
    }

    public function sumArray($array)
    {
        if (!$array){
            return 0;
        }
        $array_sum = 0;
        foreach ($array as $value) {
            $array_sum += $value;
        }
        return $array_sum;
    }

    public function percentage($value,$total){
        return number_format(($value * 100) / $total, 2);
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
