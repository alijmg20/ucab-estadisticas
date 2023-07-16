<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;

class GroupController extends Component
{

    use WithPagination;
    public $searchGroup = '';
    public $sortGroup = 'position';
    public $directionGroup = 'asc';
    public $entrysGroup = [2, 5, 10, 15], $cantGroup = '15';
    public $readyToLoad = false;

    public $variable;
    protected $groups = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cantGroup' => ['except' => '15'],
        'sortGroup'  => ['except' => 'position'],
        'directionGroup'  => ['except' => 'asc'],
        'searchGroup' => ['except' => '']
    ];

    function mount($variable)
    {
        $this->variable = Variable::find($variable);
    }

    public function loadGroups()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantGroup()
    {
        $this->resetPage('groupsPage');
    }

    public function updatingSearchGroup()
    {
        $this->resetPage('groupsPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $groups = Group::where('variable_id', $this->variable->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchGroup . '%')
                        ->orWhere('id', 'like', '%' . $this->searchGroup . '%')
                        ->orWhere('value', 'like', '%' . $this->searchGroup . '%');
                })
                ->orderBy($this->sortGroup, $this->directionGroup)
                ->paginate($this->cantGroup, ['*'], 'groupsPage');
            $cantgroups = Group::where('variable_id', $this->variable->id)->count() - 1;
        } else {
            $groups = [];
            $cantgroups = 0;
        }
        $this->groups = $groups;
        return view('livewire.groups.group-controller', compact('groups','cantgroups'));
    }

    public function order($sort)
    {
        if ($this->sortGroup == $sort) {
            if ($this->directionGroup == 'desc') {
                $this->directionGroup = 'asc';
            } else {
                $this->directionGroup = 'desc';
            }
        } else {
            $this->sortGroup = $sort;
            $this->directionGroup = 'asc';
        }
    }

    public function delete($id)
    {
        $groupd = Group::find($id);
        if ($groupd != null) {
            $groups = Group::where('variable_id',$groupd->variable_id)->get();
            foreach($groups as $group){
                if($groupd->position < $group->position){
                    $group->position = (int) $group->position - 1;
                    $groups_aux[] = $group->position;
                    $group->save();
                }else if($groupd->position == $group->position);
            }
            $groupd->delete();
        }
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

    public function upPosition($id){
        $groupUp = Group::find($id);
        $groupAux = Group::where('variable_id',$groupUp->variable_id)
                    ->where('position',$groupUp->position - 1)
                    ->get();
        $groupDown = $groupAux[0];
        $aux = $groupDown->position;
        $groupDown->position = $groupUp->position;
        $groupUp->position = $aux;
        $groupUp->save();
        $groupDown->save();
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

    public function downPosition($id){
        $groupDown = Group::find($id);
        $groupAux = Group::where('variable_id',$groupDown->variable_id)
                    ->where('position',$groupDown->position + 1)
                    ->get();
        $groupUp = $groupAux[0];
        $aux = $groupUp->position;
        $groupUp->position = $groupDown->position;
        $groupDown->position = $aux;
        $groupUp->save();
        $groupDown->save();
        $this->emitTo('graphics.graphic-controller', 'render');
        $this->emitTo('graphics.graphic-variables','render');
        $this->emitTo('graphics.graphic-details', 'render');
        $this->emitTo('graphics.graphic', 'render');
        $this->emitTo('graphics.graphic', 'loadGraphic');
    }

}
