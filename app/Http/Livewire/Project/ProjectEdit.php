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

class ProjectEdit extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $project; //Variable que viene de fileController

    public $lines, $searchUser = '';

    public $name, $description,
        $slug, $status = 1,$date_end = null,$ended = false,
        $line_id, $file, $users_id = [];
    public $user_id;
    protected $users;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:projects,slug',
        'status' => 'required',
        'user_id' => 'required',
        'line_id' => 'required',
        'file' => 'required',
        'date_end' => '',
        'ended' => '',
    ];

    public function mount($project)
    {
        $this->user_id = auth()->user()->id;
        $this->project = Project::find($project);
        $this->name = $this->project->name;
        $this->description = $this->project->description;
        $this->slug = $this->project->slug;
        $this->status = $this->project->status;
        $this->line_id = $this->project->line_id;
        $this->date_end = date("m/d/Y", strtotime($this->project->date_end));
        $this->ended = $this->project->ended == 2 ? true : false;
        $this->users_id = $this->project->users()
            ->pluck('user_id')
            ->all();
    }

    public function updatingSearchUser()
    {
        $this->resetPage('usersPageEdit');
    }

    public function render()
    {
        $this->lines = $lines = Line::all();
        $this->users = $users = User::where('id', 'like', '%' . $this->searchUser . '%')
            ->orwhere('name', 'like', '%' . $this->searchUser . '%')
            ->paginate(5, ['*'], 'usersPageEdit');
        return view('livewire.project.project-edit', compact('lines', 'users'));
    }

    public function save()
    {

        $this->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'slug' => 'required|unique:projects,slug,' . $this->project->id,
                'status' => 'required',
                'user_id' => 'required',
                'line_id' => 'required',
                'file' => '',
                'date_end' => '',
                'ended' => '',
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
        $this->name != $project->name ? $redirect = 1 : $redirect = 0;
        $project->name = $this->name;
        $project->description = $this->description;
        $project->slug = Str::slug($project->id.' '.$this->name);
        $project->status = $this->status;
        $project->line_id = $this->line_id;
        $project->date_end = date("Y-m-d 00:00:00", strtotime( $this->date_end));
        $project->ended = $this->ended == true ? '2' : '1';
        $project->save();
        if($redirect){
            $this->emit('projectAlert', 'terminado!', 'Proyecto actualizado exitosamente');
            return redirect()->route('admin.files.show',$project);
        }
        $this->mount($project->id);
        $this->render();
        $this->emitTo('file.file-controller', 'render');
        $this->emit('projectAlert', 'terminado!', 'Proyecto actualizado exitosamente');
        
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
}
