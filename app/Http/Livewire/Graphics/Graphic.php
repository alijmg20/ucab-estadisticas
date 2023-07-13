<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Data;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Graphic extends Component
{

    public $entrysGraphic = ['circulo','barra'];
    public $typeGraphic;
    public $variable;
    protected $listeners = ['render','loadGraphic'];
    public function mount($variable)
    {

        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        $this->typeGraphic = $this->variable->graphic_type;
        return view('livewire.graphics.graphic');
    }

    public function loadGraphic()
    {
        $variableData = Data::select('value', DB::raw('count(*) as y'))
            ->where('variable_id', $this->variable->id)
            ->groupBy('value')
            ->havingRaw('COUNT(*) IS NOT NULL AND value IS NOT NULL')
            ->orderBy('value', 'asc')
            ->pluck('y', 'value')
            ->toArray();
        if (count($variableData) < 15) {
            $data_aux = [];
            foreach ($variableData as $key => $value) {
                $data_aux[] = ['name' => $key, 'y' => floatval($value)];
            }
            $data = json_encode($data_aux);
        }
        $variable = $this->variable;
        $this->emit('graphicShow',$variable,$data);
    }

    public function selectGraphic()
    {
        if ($this->typeGraphic) {
            $this->variable->graphic_type = $this->typeGraphic;
            $this->variable->save();
            $this->render();
            $this->loadGraphic();
        }
    }
}
