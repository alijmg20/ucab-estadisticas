<?php

namespace App\Http\Livewire\Frequency;

use App\Models\Frequency;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;

class FrequencyController extends Component
{

    use WithPagination;
    public $searchFrequency = '';
    public $sortFrequency = 'position';
    public $directionFrequency = 'asc';
    public $entrysFrequency = [2, 5, 10, 15], $cantFrequency = '15';
    public $readyToLoad = false;

    public $variable;
    protected $frequencies = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cantFrequency' => ['except' => '15'],
        'sortFrequency'  => ['except' => 'position'],
        'directionFrequency'  => ['except' => 'asc'],
        'searchFrequency' => ['except' => '']
    ];

    function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function loadFrequencies()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantFrequency()
    {
        $this->resetPage('frequenciesPage');
    }

    public function updatingSearchFrequency()
    {
        $this->resetPage('frequenciesPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $frequencies = Frequency::where('variable_id', $this->variable->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchFrequency . '%')
                        ->orWhere('id', 'like', '%' . $this->searchFrequency . '%')
                        ->orWhere('value', 'like', '%' . $this->searchFrequency . '%');
                })
                ->orderBy($this->sortFrequency, $this->directionFrequency)
                ->paginate($this->cantFrequency, ['*'], 'frequenciesPage');
            $cantfrequencies = Frequency::where('variable_id', $this->variable->id)->count();
        } else {
            $frequencies = [];
            $cantfrequencies = 0;
        }
        $this->frequencies = $frequencies;
        return view('livewire.frequency.frequency-controller', compact('frequencies','cantfrequencies'));
    }

    public function order($sort)
    {
        if ($this->sortFrequency == $sort) {
            if ($this->directionFrequency == 'desc') {
                $this->directionFrequency = 'asc';
            } else {
                $this->directionFrequency = 'desc';
            }
        } else {
            $this->sortFrequency = $sort;
            $this->directionFrequency = 'asc';
        }
    }

    public function delete($id)
    {
        $frequencyd = Frequency::find($id);
        if ($frequencyd != null) {
            $frequencies = Frequency::where('variable_id',$frequencyd->variable_id)->get();
            foreach($frequencies as $frequency){
                if($frequencyd->position < $frequency->position){
                    $frequency->position = (int) $frequency->position - 1;
                    $frequencies_aux[] = $frequency->position;
                    $frequency->save();
                }else if($frequencyd->position == $frequency->position);
            }
            $frequencyd->delete();
        }
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

    public function upPosition($id){
        $frequencyUp = Frequency::find($id);
        $frequencyAux = Frequency::where('variable_id',$frequencyUp->variable_id)
                    ->where('position',$frequencyUp->position - 1)
                    ->get();
        $frequencyDown = $frequencyAux[0];
        $aux = $frequencyDown->position;
        $frequencyDown->position = $frequencyUp->position;
        $frequencyUp->position = $aux;
        $frequencyUp->save();
        $frequencyDown->save();
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

    public function downPosition($id){
        $frequencyDown = Frequency::find($id);
        $frequencyAux = Frequency::where('variable_id',$frequencyDown->variable_id)
                    ->where('position',$frequencyDown->position + 1)
                    ->get();
        $frequencyUp = $frequencyAux[0];
        $aux = $frequencyUp->position;
        $frequencyUp->position = $frequencyDown->position;
        $frequencyDown->position = $aux;
        $frequencyUp->save();
        $frequencyDown->save();
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

}
