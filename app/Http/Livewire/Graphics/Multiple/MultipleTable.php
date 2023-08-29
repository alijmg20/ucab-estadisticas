<?php

namespace App\Http\Livewire\Graphics\Multiple;

use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MultipleTable extends Component
{

    public $variable;
    public $responsed = 0;
    public $average = 0;
    public $max = 0;
    public $min = 0;

    protected $listeners = ['render','emitTable'];

    public function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function emitTable(){
        $this->render();
    }

    public function render()
    {
        $this->max = $this->calcMaxOrMin('desc');
        $this->min = $this->calcMaxOrMin('asc');
        $this->responsed = $this->calcResponsed();
        $this->average = $this->calcAverage();
        return view('livewire.graphics.multiple.multiple-table');
    }

    public function calcResponsed()
    {
        $count = $this->variable->data()
            ->where(function ($query) {
                $query->whereNotNull('value')
                    ->orWhere('value', '<>', '');
            })
            ->count();

        return $count;
    }

    public function calcAverage()
    {
        $average = $this->variable->frequencies()
        ->sum(DB::raw('score * value')) / $this->variable->frequencies()->sum('value');
        return $average;
    }

    public function calcMaxOrMin($direction)
    {
        $calc = $this->variable->frequencies()
            ->orderBy('value', $direction)
            ->pluck('value', 'name')
            ->toArray();
        $value = reset($calc);
        $total = $this->sumArray($calc);
        $percentage = $this->percentage($value, $total);
        return [key($calc) => $percentage . '%'];
    }

    public function sumArray($array)
    {
        if (!$array) {
            return 0;
        }
        $array_sum = 0;
        foreach ($array as $value) {
            $array_sum += $value;
        }
        return $array_sum;
    }

    public function percentage($value, $total)
    {
        return number_format(($value * 100) / $total, 2);
    }
}
