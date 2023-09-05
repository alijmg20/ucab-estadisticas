<?php

namespace App\Http\Livewire\Graphics\Multiple;

use App\Models\Data;
use App\Models\Graphictype;
use App\Models\Register;
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
        // dd($this->unionVariables());
        $this->typeGraphic = $this->variable ? $this->variable->graphictype_id : '';
        $this->emitTo('graphics.multiple.multiple-table', 'render');
        return view('livewire.graphics.multiple.graphic');
    }

    public function emitScore($variable)
    {
        $this->emit('openModalScore', $variable);
        $this->loadGraphic();
    }

    public function loadGraphic()
    {
        if ($this->variable) {
            $variableData = $this->variable->frequencies()
                ->orderBy('position', 'asc')
                ->pluck('value', 'name')
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

    public function unionVariables()
    {

        $variable1 = Variable::find(49);
        $variable2 = Variable::find(55);

        $registers = Register::where('file_id',$this->variable->file_id)->get();

        $contingencyTable = [];

        foreach ($registers as $register) {
            $data1 = $variable1->data()->where('register_id', $register->id)->first();
            $data2 = $variable2->data()->where('register_id', $register->id)->first();

            if ($data1 && $data2) {
                $value1 = $data1->value;
                $value2 = $data2->value;
                $key = "$value2, $value1"; // Combinación de valores como clave

                // Incrementa el contador para la combinación de valores en el arreglo
                if (!isset($contingencyTable[$key])) {
                    $contingencyTable[$key] = 1;
                } else {
                    $contingencyTable[$key]++;
                }
            }
        }

        // Puedes usar dd para mostrar el arreglo resultante
        dd($contingencyTable);
    }
}
