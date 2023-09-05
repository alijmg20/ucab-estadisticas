<?php

namespace App\Http\Livewire\Graphics\Checkbox;

use App\Models\File;
use App\Models\Register;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VariableCheckbox extends Component
{
    public $variable;

    protected $listeners = ['render', 'loadCheckbox'];

    public function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        return view('livewire.graphics.checkbox.variable-checkbox');
    }

    public function loadCheckbox()
    {
        if ($this->variable) {
            $data = [];
            $dataTotals = [];
            $options = $this->variable->options;
            $responseTotal = $this->variable->data()
                ->where(function ($query) {
                    $query->whereNotNull('value')
                        ->orWhere('value', '<>', '');
                })
                ->count();
            foreach ($options as $option) {
                $responses = $option->variableResponses;
                $optionName = $option->name;
                $responseAvg = count($responses) * 100 / $responseTotal;
                $data[] = ['name' => $optionName, 'y' => floatVal($responseAvg)];
            }

            foreach($this->getCheckboxCombinations() as $key => $combination){
                $combinationAvg = $combination * 100 /  $responseTotal;
                $dataTotals[] = ['name' => $key,'y' => floatVal($combinationAvg)];
            }
        $this->emit('checkboxShow', $this->variable, $data,$dataTotals);
        }
    }

    public function getCheckboxCombinations()
    {
        $file = $this->variable->file_id;
        $file = File::find($file);
        $combinations = [];

        // Obtener todos los registros del archivo
        $registers = $file->registers;

        // Recorrer cada registro
        foreach ($registers as $register) {
            // Obtener las variableResponses de cada registro
            $variableResponses = $register->variableResponses;

            // Crear una clave única para representar la combinación de variableResponses en este registro
            $combinationKey = '';

            foreach ($variableResponses as $response) {
                // Concatenar el nombre de la variableOption a la clave
                $combinationKey .= $response->variableOption->name . ',';
            }
            // Eliminar el último guión (-) de la clave
            $combinationKey = rtrim($combinationKey, ',');
            if ($combinationKey) {
                // Verificar si esta combinación ya existe en el array de combinaciones
                if (array_key_exists($combinationKey, $combinations)) {
                    // Si existe, aumentar el contador
                    $combinations[$combinationKey]++;
                } else {
                    // Si no existe, crear la clave y establecer el contador en 1
                    $combinations[$combinationKey] = 1;
                }
            }
        }

        // El array $combinations ahora contendrá las combinaciones y sus recuentos
        return ($combinations);
    }
}
