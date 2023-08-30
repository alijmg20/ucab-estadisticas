<?php

namespace App\Http\Livewire\Project;

use App\Helpers\Tools;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProjectController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $open_edit = false;
    public $lines = [];

    public $project, $file, $users_id = [];
    public $user_id, $searchUserEdit;
    public $entrys = [2, 5, 10, 20, 50, 100], $cant = '10';
    public $readyToLoad = false;
    public $totalProjects = [];
    protected $projects = [];
    protected $users = [];

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->project = new Project();
        $this->users = [];
    }

    public function loadProject()
    {
        $this->readyToLoad = true;
    }

    public function updatingCant()
    {
        $this->resetPage('projectsPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('projectsPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $projects = Project::whereHas('users', function ($query) {
                $query->where('users.id', $this->user_id);
            })
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('id', 'like', '%' . $this->search . '%')
                        ->orWhere('created_at', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'projectsPage');
        } else {
            $projects = [];
        }
        $this->projects = $projects;
        $this->getTotals();
        return view('livewire.project.project-controller', compact('projects'));
    }

    public function getTotals(){
        $this->totalProjects['totalProjects'] = Project::whereHas('users', function ($query) {
            $query->where('users.id', $this->user_id);
        })->count();

        $this->totalProjects['totalProjectsProgress'] = Project::where('ended','1')
        ->whereHas('users', function ($query) {
            $query->where('users.id', $this->user_id);
        })->count();

        $this->totalProjects['totalProjectsEnd'] = Project::where('ended','2')
        ->whereHas('users', function ($query) {
            $query->where('users.id', $this->user_id);
        })->count();

        $this->totalProjects['totalProjectsPublished'] = Project::where('status',2)
        ->whereHas('users', function ($query) {
            $query->where('users.id', $this->user_id);
        })->count();
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function delete($id)
    {
        $project = Project::find($id);
        Tools::DeleteStorageUrl($project->image->url);
        $project->delete();
    }

    public function goFiles($id)
    {
        $project = Project::find($id);
        return redirect()->route('admin.files.show', compact('project'));
    }


    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open_edit', 'file', 'users_id']);
    }
}
