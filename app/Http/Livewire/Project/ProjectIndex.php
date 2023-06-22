<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $entrys = [2, 5, 10, 20, 50, 100], $cant = '3';
    public $readyToLoad = false;

    protected $projects = [];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function loadProjectIndex()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage('projectsPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $projects = Project::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->paginate($this->cant, ['*'], 'projectsPage');
        } else {
            $projects = [];
        }
        $this->projects = $projects;
        return view('livewire.project.project-index', compact('projects'));
    }
}
