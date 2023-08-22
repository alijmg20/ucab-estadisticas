<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Data;
use App\Models\Graphictype;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Graphic extends Component
{

    public $entrysGraphic;
    public $typeGraphic;
    public $variable;
    protected $listeners = ['render', 'loadGraphic'];
    public function mount($variable)
    {
        $this->variable = Variable::find($variable);
        $this->entrysGraphic = Graphictype::all();
    }

    public function render()
    {
        $this->typeGraphic = $this->variable ? $this->variable->graphictype_id : '';
        return view('livewire.graphics.graphic');
    }

    public function loadGraphic()
    {
        if ($this->variable) {
            $variableData = $this->variable->frequencies()
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

    public function selectGraphic()
    {
        if ($this->typeGraphic) {
            $this->variable->graphictype_id = $this->typeGraphic;
            $this->variable->save();
            $this->loadGraphic();
        }
    }
}
