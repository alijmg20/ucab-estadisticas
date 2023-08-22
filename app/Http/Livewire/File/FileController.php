<?php

namespace App\Http\Livewire\File;

use App\Helpers\Tools;
use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;

class FileController extends Component
{
    use WithPagination;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $content = 1;
    public $entrys = [2,5,10,20,50,100], $cant = '10';
    public $readyToLoad = false;

    public $project; //Variable que viene desde el controlador

    protected $files = [];

    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cant' => ['except' => '10'], 
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount($project){
        $this->project = $project;
    }

    public function loadProjectFiles(){
        $this->readyToLoad = true;
    }

    public function updatingCant(){
        $this->resetPage('FilesPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('FilesPage');
    }

    public function render()
    {
        if($this->readyToLoad){
            $files = File::where('project_id', $this->project->id)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant, ['*'], 'FilesPage');
        }else{
            $files = [];
        }
        $this->files = $files;
        return view('livewire.file.file-controller',compact('files'));
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

    public function showDataFile($id){
        $file = File::find($id);
        return redirect()->route('admin.files.showfile',compact('file'));
    }

    public function delete($id){
        $file = File::find($id);
        Tools::DeleteStorageUrl($file->url); 
        $file->delete();
    }

}
