<?php

namespace App\Http\Livewire\VariableType;

use App\Models\Data;
use App\Models\File;
use App\Models\Frequency;
use App\Models\Variable;
use App\Models\Variabletype;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class VariableTypeModal extends Component
{
    use WithPagination;
    public $file;
    protected $variables;
    public $openVariableTypeModal = false;

    public $searchVariableType = '';
    public $sortVariableType = 'id';
    public $directionVariableType = 'asc';
    public $entrysVariableType = [2, 5, 10, 20, 50, 100], $cantVariableType = '10';
    public $TypesVariable;
    public $variablesTypeCollect = [];
    public $readyToLoad = false;

    protected  $listeners = ['edit'];

    protected $queryString = [
        'cantVariableType' => ['except' => '10'],
        'sortVariableType'  => ['except' => 'id'],
        'directionVariableType'  => ['except' => 'asc'],
        'searchVariableType' => ['except' => '']
    ];

    protected $rules = [
        'variablesTypeCollect' => 'required|filled|array',
        'variablesTypeCollect.*' => 'required',
    ];


    public function updatingCantVariableType()
    {
        $this->resetPage('variablesTypePage');
    }

    public function updatingSearchVariableType()
    {
        $this->resetPage('variablesTypePage');
    }


    public function render()
    {
        $variables = [];
        $this->TypesVariable = Variabletype::all();
        if ($this->file) {
            $variables = Variable::where('file_id', $this->file->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchVariableType . '%')
                        ->orWhere('id', 'like', '%' . $this->searchVariableType . '%');
                })
                ->orderBy($this->sortVariableType, $this->directionVariableType)
                ->paginate($this->cantVariableType, ['*'], 'variablesTypePage');
        } else {
            $variables = [];
        }
        $this->variables = $variables;
        return view('livewire.variable-type.variable-type-modal', compact('variables'));
    }

    public function edit($file)
    {
        $this->file = File::find($file);
        $this->readyToLoad = true;
        $this->openVariableTypeModal = true;
    }


    public function order($sort)
    {
        if ($this->sortVariableType == $sort) {
            if ($this->directionVariableType == 'desc') {
                $this->directionVariableType = 'asc';
            } else {
                $this->directionVariableType = 'desc';
            }
        } else {
            $this->sortVariableType = $sort;
            $this->directionVariableType = 'asc';
        }
    }

    public function save()
    {
        $this->validate();
        $vars = Variable::where('file_id',$this->file->id)->get(); 
        if (empty($this->variablesTypeCollect) || count($this->variablesTypeCollect) < $vars->count()) {
            $this->addError('VariablesEmpty', 'Faltan variables por seleccionar su tipo, verifica todas las páginas');
        }else{
            foreach ($this->variablesTypeCollect as $key => $value) {
                $variableTemp = Variable::find($key);
                $variableTemp->variabletype_id = $value;
                $variableTemp->save();
                switch($variableTemp->variabletype_id){
                    case 2: 
                        $this->addFrequencies($variableTemp);
                        break;
                }
            }
            $this->reset(['variablesTypeCollect','openVariableTypeModal']);
            $this->emitTo('file.file-controller', 'render','file');
            $this->emit('fileAlert', 'terminado!','Archivo creado exitosamente');
        }
    }

    /**
     * Añade las frecuencias individuales a la variable a analizar
     * En este caso aplica para las preguntas de los tipos
     * Tipo: Opción multiple
     * Tipo: Casilla de verificación
     */

    private function addFrequencies($variable)
    {
            $variable_get = Data::select('value', DB::raw('count(*) as y'))
                ->where('variable_id', $variable->id)
                ->groupBy('value')
                ->havingRaw('COUNT(*) IS NOT NULL AND value IS NOT NULL')
                ->orderBy('value', 'asc')
                ->get();
            // if (count($variable_get) < 15 /*15 corresponde a un numero maximo para mostrar en el grafico*/) {
                $i = 0;
                foreach ($variable_get as $group) {
                    Frequency::create([
                        'name'  => $group->value,
                        'value' => $group->y,
                        'position' => $i+1,
                        'variable_id' => $variable->id,
                    ]);
                    $i++;
                }
            // }
    }

}
