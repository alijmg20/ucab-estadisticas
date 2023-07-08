<?php

namespace App\Http\Livewire\Project;

use App\Helpers\Tools;
use App\Models\Line;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
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
    
    public $project, $file,$users_id = [];
    public $user_id,$searchUserEdit;
    public $entrys = [2,5,10,20,50,100], $cant = '10';
    public $readyToLoad = false;

    protected $projects = [];
    protected $users = [];

    protected $listeners = ['render','delete'];

    protected $rules = [
        'project.name' => 'required',
        'project.description' => 'required',
        'project.status' => 'required',
        'project.slug' => 'required||unique:projects,slug',
        'user_id' => 'required',
        'project.line_id' => 'required',
        'project.image' => 'required',
        'project.image.url' => 'required',
    ];

    protected $queryString = [
        'cant' => ['except' => '10'], 
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount(){
        $this->user_id = auth()->user()->id;
        $this->project = new Project();
        $this->users = [];
    }

    public function loadProject(){
        $this->readyToLoad = true;
    }

    public function updatingCant(){
        $this->resetPage('projectsPage');
    }

    public function updatingSearch(){
        $this->resetPage('projectsPage');
    }

    public function updatingSearchUserEdit(){
        $this->resetPage('usersPage');
    }

    public function render()
    {
        if($this->readyToLoad){
            $projects = Project::whereHas('users', function ($query) {
                $query->where('users.id', $this->user_id);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant, ['*'], 'projectsPage');
        }else{
            $projects = [];
        }
        $users = $this->users = User::where('id','like','%'.$this->searchUserEdit.'%')
            ->orwhere('name','like','%'.$this->searchUserEdit.'%')
            ->paginate(5, ['*'], 'usersPage');
        $this->lines = Line::all();
        $this->projects = $projects;
        return view('livewire.project.project-controller', compact('projects','users'));
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

    public function edit($id)
    {
        $this->project = Project::find($id);
        $this->users_id = $this->project->users()
        ->pluck('user_id')
        ->all();
        $this->open_edit = true;
    }

    public function update()
    {
        
        $this->validate();

        if ($this->file) {
            Tools::DeleteStorageUrl($this->project->image->url);
            $this->project->image->url = $this->file->store('projects');
            $this->project->image->save();
        }

        if (is_array($this->users_id) && count($this->users_id)) {
            $this->project->users()->sync($this->users_id);
        }

        $this->project->save();

        $this->resetInputDefaults();
        $this->emit('projectAlert', 'terminado!', 'Proyecto actualizado exitosamente');

    }

    public function delete($id){
        $project = Project::find($id);
        Tools::DeleteStorageUrl($project->image->url);
        $project->delete();
    }

    public function generateSlug()
    {
        $this->project->slug = Str::slug($this->project->name);
    }

    public function goFiles($id){
        $project = Project::find($id);
        return redirect()->route('admin.files.show',compact('project'));
    }
    

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open_edit', 'file','users_id']);
    }
}
