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
class ProjectModal extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $open = false;
    public $lines,$searchUser = '';

    public $name, $description, 
    $slug, $status = 1,
    $line_id, $file,$users_id = [];
    public $user_id;

    protected $users;

    public $project; //variable para editar

    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:projects,slug',
        'status' => 'required',
        'user_id' => 'required',
        'line_id' => 'required',
        'file' => 'required',
    ]; 

    public function mount(){
        $this->user_id = auth()->user()->id;
    }

    public function updatingSearchUser(){
        $this->resetPage('usersPageModal');
    }

    public function render()
    {
        $this->lines = $lines = Line::all();
        $this->users = $users = User::where('id','like','%'.$this->searchUser.'%')
        ->orwhere('name','like','%'.$this->searchUser.'%')
        ->paginate(5,['*'], 'usersPageModal');
        return view('livewire.project.project-modal',compact('lines','users'));
    }

    public function edit($id)
    {
        $this->reset(['name','slug','description','status','line_id','file','users_id','project']);
        
        $this->project = $project = Project::find($id);
        $this->name = $project->name;
        $this->description = $project->description;
        $this->slug = $project->slug;
        $this->status = $project->status;
        $this->line_id = $project->line_id;
        $this->users_id = $this->project->users()
        ->pluck('user_id')
        ->all();
        $this->open = true;
    }

    public function update()
    {
        
        $this->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required|unique:projects,slug,'. $this->project->id,
                'status' => 'required',
                'user_id' => 'required',
                'line_id' => 'required',
                'file' => '',
            ]
        );

        $project = Project::find($this->project->id);
        if ($this->file) {
            Tools::DeleteStorageUrl($project->image->url);
            $project->image->url = $this->file->store('projects');
            $project->image->save();
        }

        if (is_array($this->users_id) && count($this->users_id)) {
            $project->users()->sync($this->users_id);
        }
        $project->name = $this->name;
        $project->description = $this->description;
        $project->slug = Str::slug($project->id.' '.$this->name);
        $project->status = $this->status;
        $project->line_id = $this->line_id;
        
        $project->save();

        $this->resetInputDefaults();
        $this->emitTo('project.project-controller', 'render');
        $this->emit('projectAlert', 'terminado!', 'Proyecto actualizado exitosamente');

    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function openModal(){
        $this->reset(['name','slug','description','status','line_id','file','users_id']);
        $this->open = true;
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function save(){

        $this->validate();
        
        $this->users_id[] = $this->user_id;
        $file = $this->file->store('projects');

        $project = Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'line_id' => $this->line_id,
        ]);
        $project->slug = Str::slug($project->id.' '.$this->name);
        $project->save();
        if ($this->file) {
            $project->image()->create([
                'url' => $file
            ]);
        }

        if(is_array($this->users_id) && count($this->users_id)){
            $project->users()->sync($this->users_id);
        }

        $this->resetInputDefaults();
        $this->emitTo('project.project-controller','render');
        $this->emit('projectAlert','terminado!','Proyecto creado exitosamente');
    }

    public function resetInputDefaults(){
        $this->reset(['open','name','slug','description','status','line_id','file','users_id','project']);
    }

}
