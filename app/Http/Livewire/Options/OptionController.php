<?php

namespace App\Http\Livewire\Options;

use App\Models\Variable;
use App\Models\VariableOption;
use Livewire\Component;
use Livewire\WithPagination;
class OptionController extends Component
{
    use WithPagination;
    public $searchVariableOption = '';
    public $sortVariableOption = 'id';
    public $directionVariableOption = 'asc';
    public $entrysVariableOption = [2, 5, 10, 15], $cantVariableOption = '15';
    public $readyToLoad = false;

    public $variable;
    protected $options = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cantVariableOption' => ['except' => '15'],
        'sortVariableOption'  => ['except' => 'id'],
        'directionVariableOption'  => ['except' => 'asc'],
        'searchVariableOption' => ['except' => '']
    ];


    function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function loadOptions()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantVariableOption()
    {
        $this->resetPage('optionsPage');
    }

    public function updatingSearchVariableOption()
    {
        $this->resetPage('optionsPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $options = VariableOption::where('variable_id', $this->variable->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchVariableOption . '%');
                })
                ->orderBy($this->sortVariableOption, $this->directionVariableOption)
                ->paginate($this->cantVariableOption, ['*'], 'optionsPage');
            $cantoptions = VariableOption::where('variable_id', $this->variable->id)->count();
        } else {
            $options = [];
            $cantoptions = 0;
        }
        $this->options = $options;
        return view('livewire.options.option-controller',compact('options'));
    }

    public function order($sort)
    {
        if ($this->sortVariableOption == $sort) {
            if ($this->directionVariableOption == 'desc') {
                $this->directionVariableOption = 'asc';
            } else {
                $this->directionVariableOption = 'desc';
            }
        } else {
            $this->sortVariableOption = $sort;
            $this->directionVariableOption = 'asc';
        }
    }

    public function delete($id)
    {
        $optiond = VariableOption::find($id);
        if ($optiond != null) {
            $optiond->delete();
        }
        $this->emitTo('graphics.multiple.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');

        $this->emitTo('graphics.checkbox.variable-checkbox', 'render');
        $this->emitTo('graphics.checkbox.variable-checkbox', 'loadCheckbox');
    }

}
