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
    public $entrysGroup = [2, 5, 10, 15], $cantGroup = '5';
    public $readyToLoad = false;

    public $variable;
    protected $groups = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cantGroup' => ['except' => '5'],
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
        } else {
            $groups = [];
        }
        $this->groups = $groups;
        return view('livewire.groups.group-controller', compact('groups'));
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
}
