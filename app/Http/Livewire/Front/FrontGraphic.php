<?php

namespace App\Http\Livewire\Front;

use App\Models\Variable;
use Livewire\Component;

class FrontGraphic extends Component
{
    public $variable,$selection;
    protected $listeners = ['render', 'loadGraphic'];
    public function mount($variable,$selection)
    {
        $this->selection = $selection;
        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        return view('livewire.front.front-graphic');
    }

    public function loadGraphic()
    {
        if ($this->variable) {
            $variableData = $this->variable->groups()
            ->orderBy('position', 'asc')
            ->pluck('value','name')
            ->toArray();
            $data_aux = [];
            foreach ($variableData as $key => $value) {
                $data_aux[] = ['name' => $key, 'y' => floatval($value)];
            }
            $data = json_encode($data_aux);
            $variable = $this->variable;
            $this->emit('graphicShow', $variable, $data);
        }
    }
}
