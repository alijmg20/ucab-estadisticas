<?php

namespace App\Http\Livewire\Graphics\Multiple;

use App\Models\Frequency;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;

class ScoreModal extends Component
{
    use WithPagination;
    public $openScore = false;
    public $variable;
    public $frequenciesValues = [];
    protected $frequencies;
    public $listeners = ['openModalScore'];

    public $searchFrequencies = '';
    public $sortFrequencies = 'id';
    public $directionFrequencies = 'asc';
    public $entrysFrequencies = [2, 5, 10, 20, 50, 100], $cantFrequencies = '10';
    public $readyToLoad = false;
    protected $queryString = [
        'cantFrequencies' => ['except' => '10'],
        'sortFrequencies'  => ['except' => 'id'],
        'directionFrequencies'  => ['except' => 'asc'],
        'searchFrequencies' => ['except' => '']
    ];

    protected $rules = [
        'frequenciesValues' => 'required|filled|array',
        'frequenciesValues.*' => 'required',
    ];

    public function updatingCantFrequencies()
    {
        $this->resetPage('frequenciesPage');
    }

    public function updatingSearchFrequencies()
    {
        $this->resetPage('frequenciesPage');
    }

    public function render()
    {
        $frequencies = [];
        if ($this->variable) {
            $frequencies = Frequency::where('variable_id' ,$this->variable->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchFrequencies . '%')
                        ->orWhere('id', 'like', '%' . $this->searchFrequencies . '%');
                })
                ->orderBy($this->sortFrequencies, $this->directionFrequencies)
                ->paginate($this->cantFrequencies, ['*'], 'frequenciesPage');
        } else {
            $frequencies = [];
        }
        $this->frequencies = $frequencies;
        return view('livewire.graphics.multiple.score-modal',compact('frequencies'));
    }

    public function update(){
        $this->validate();
        $freqs = Frequency::where('variable_id',$this->variable->id)->get(); 
        if (empty($this->frequenciesValues) || count($this->frequenciesValues) < $freqs->count()) {
            $this->addError('VariablesEmpty', 'Faltan variables por seleccionar su tipo, verifica todas las páginas');
        }else{
            foreach ($this->frequenciesValues as $key => $value) {
                $frequenciesTemp = Frequency::find($key);
                $frequenciesTemp->score = $value;
                $frequenciesTemp->save();
            }
            $this->reset(['frequenciesValues','openScore']);
            $this->emit('emitTable');
            $this->emit('scoreAlert', 'terminado!','Puntaje actualizado exitosamente');
        }
    }

    public function openModalScore($variable)
    {
        $this->resetInputDefaults();
        $this->variable = Variable::find($variable);
        // $this->frequencies = Frequency::where('variable_id',$this->variable->id)->get();
        $this->frequenciesValues = Frequency::where('variable_id', $this->variable->id)
        ->pluck('score', 'id')->toArray();
        $this->readyToLoad = true;
        $this->openScore = true;
    }

    public function order($sort)
    {
        if ($this->sortFrequencies == $sort) {
            if ($this->directionFrequencies == 'desc') {
                $this->directionFrequencies = 'asc';
            } else {
                $this->directionFrequencies = 'desc';
            }
        } else {
            $this->sortFrequencies = $sort;
            $this->directionFrequencies = 'asc';
        }
    }

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['variable','frequenciesValues','frequencies']);
        $this->openScore = false;
    }

}
