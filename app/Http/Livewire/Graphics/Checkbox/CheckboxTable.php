<?php

namespace App\Http\Livewire\Graphics\Checkbox;

use App\Models\File;
use App\Models\Variable;
use Livewire\Component;

class CheckboxTable extends Component
{

    public $variable;
    public $totals = [];
    protected $listeners = ['render'];
    public function mount($variable){
        $this->variable = Variable::find($variable);
    }

    public function render()
    {
        $this->totals['countResponses'] =  $this->getCountResponses();
        $this->totals['combinations'] = $this->getCheckboxCombinations();
        $this->totals['individuals'] = $this->getCheckboxIndividuals();
        return view('livewire.graphics.checkbox.checkbox-table');
    }

    public function getCountResponses(){
        $responseTotal = $this->variable->data()
        ->where(function ($query) {
            $query->whereNotNull('value')
                ->orWhere('value', '<>', '');
        })
        ->count();
        return $responseTotal;
    }

    public function getCheckboxCombinations()
    {
        $file = $this->variable->file_id;
        $file = File::find($file);
        $combinations = [];
        $maxCount = 0; // Variable para rastrear la cantidad máxima de repeticiones
        $variablesWithMaxCount = []; // Variable para rastrear las variables con la cantidad máxima de repeticiones
    
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
    
            // Verificar si esta combinación ya existe en el array de combinaciones
            if ($combinationKey) {
                if (array_key_exists($combinationKey, $combinations)) {
                    $combinations[$combinationKey]++;
                } else {
                    $combinations[$combinationKey] = 1;
                }
    
                // Actualizar el máximo recuento y las variables con el máximo recuento
                if ($combinations[$combinationKey] > $maxCount) {
                    $maxCount = $combinations[$combinationKey];
                    $variablesWithMaxCount = [$combinationKey];
                } elseif ($combinations[$combinationKey] == $maxCount) {
                    $variablesWithMaxCount[] = $combinationKey;
                }
            }
        }
    
        // Las variables con la cantidad máxima de repeticiones se encuentran en $variablesWithMaxCount
        // El valor máximo de repeticiones se encuentra en $maxCount
        return ['variablesMaxCount' =>$variablesWithMaxCount, 'maxCount' => $this->percentage($maxCount,$this->getCountResponses())];
    }

    public function getCheckboxIndividuals()
    {
        $options = $this->variable->options;
        $responseTotal = $this->getCountResponses();
        $data = [];
        $maxFrequency = 0; // Variable para rastrear la frecuencia máxima
        $optionsWithMaxFrequency = []; // Variable para rastrear las opciones con la frecuencia máxima
    
        foreach ($options as $option) {
            $responses = $option->variableResponses;
            $optionName = $option->name;
            $responseCount = count($responses);
            $responseAvg = $responseCount * 100 / $responseTotal;
            $data[] = ['name' => $optionName, 'y' => floatval($responseAvg)];
    
            // Actualizar la frecuencia máxima y las opciones con la frecuencia máxima
            if ($responseCount > $maxFrequency) {
                $maxFrequency = $responseCount;
                $optionsWithMaxFrequency = [$optionName];
            } elseif ($responseCount == $maxFrequency) {
                $optionsWithMaxFrequency[] = $optionName;
            }
        }
    
        // La frecuencia máxima se encuentra en $maxFrequency
        // Las opciones con la frecuencia máxima se encuentran en $optionsWithMaxFrequency
        return ['optionsMaxFrequencies' => $optionsWithMaxFrequency,'MaxFrequencyCount' => $this->percentage($maxFrequency,$responseTotal)];
    }
    

    public function percentage($value, $total)
    {
        return number_format(($value * 100) / $total, 2) .' %';
    }
    

}
