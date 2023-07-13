<?php

namespace App\Http\Livewire\Variable;

use App\Models\Register;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;

class VariableController extends Component
{

    use WithPagination;
    public $searchVariable = '';
    public $sortVariable = 'id';
    public $directionVariable = 'asc';
    public $entrysVariable = [2, 5, 10, 20, 50, 100], $cantVariable = '10';
    public $readyToLoad = false;

    public $file; //Variable que viene de fileController

    protected $variables = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cantVariable' => ['except' => '10'],
        'sortVariable'  => ['except' => 'id'],
        'directionVariable'  => ['except' => 'asc'],
        'searchVariable' => ['except' => '']
    ];

    public function mount($file)
    {
        $this->file = $file;
    }

    public function loadVariables()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantVariable()
    {
        $this->resetPage('variablesPage');
    }

    public function updatingSearchVariable()
    {
        $this->resetPage('variablesPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $variables = Variable::where('file_id', $this->file->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchVariable . '%')
                        ->orWhere('id', 'like', '%' . $this->searchVariable . '%')
                        ;
                })
                ->orderBy($this->sortVariable, $this->directionVariable)
                ->paginate($this->cantVariable, ['*'], 'variablesPage');
        } else {
            $variables = [];
        }
        $this->variables = $variables;
        return view('livewire.variable.variable-controller',compact('variables'));
    }

    public function order($sort)
    {
        if ($this->sortVariable == $sort) {
            if ($this->directionVariable == 'desc') {
                $this->directionVariable = 'asc';
            } else {
                $this->directionVariable = 'desc';
            }
        } else {
            $this->sortVariable = $sort;
            $this->directionVariable = 'asc';
        }
    }

    public function delete($id){
        $variable = Variable::find($id);
        $data = Register::where('file_id',$variable->file_id)->get();
        foreach ($data as $dat) {
            $data_aux = [];
            foreach ($dat->datos as $key => $da) {
                if($key !== $variable->id){
                    $data_aux[$key] = $da;
                }
            }
            $dat->datos = $data_aux;
            $dat->save();
        }
        
        $variable->delete();
        
        $this->emitTo('graphics.graphic-controller','render');
        $this->emitTo('graphics.graphic-variables','render');
    }

}
