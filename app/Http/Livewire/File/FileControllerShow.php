<?php

namespace App\Http\Livewire\File;

use App\Models\Project;
use App\Models\Register;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;

class FileControllerShow extends Component
{
    use WithPagination;

    public $searchFileShow = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $entrys = [2,5,10,20,50,100];
    public $cantFileShow = '10';
    public $readyToLoad = false;

    public $file;
    public $project;
    public $content = 1;
    protected $variables = [];

    protected $queryString = [
        'cantFileShow' => ['except' => '10'], 
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'searchFileShow' => ['except' => ''],
    ];

    public function mount($file)
    {
        $this->file = $file;
        $this->project = Project::find($file->project_id);
    }

    public function loadfileshow()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantFileShow()
    {
        $this->resetPage('FilesShowPage');
    }

    public function updatingSearchFileShow()
    {
        $this->resetPage('FilesShowPage');
    }

    public function render()
    {
        $file = $this->file;
        $variables = Variable::where('file_id', $this->file->id)
        ->get();

        $this->variables  = $variables;
        return view('livewire.file.file-controller-show', compact('file', 'variables'));
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

    public function back(){
        $project = $this->project;
        return redirect()->route('admin.files.show',compact('project'));
    }

}
