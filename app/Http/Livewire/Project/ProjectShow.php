<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
class ProjectShow extends Component
{


    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $entrys = [2, 5, 10, 20, 50, 100], $cant = '3';
    public $readyToLoad = false;

    public $project;
    protected $similars = [];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    
    public function loadProjectShow()
    {
        $this->readyToLoad = true;
    }

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $similars = Project::where('line_id',$this->project->line_id)
            ->where('status','2')
            ->where('id','!=',$this->project->id)
            ->paginate($this->cant);
        } else {
            $similars = [];
        }
        return view('livewire.project.project-show',compact('similars'));
    }
}
