<?php

namespace App\Http\Livewire\Front;

use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;

class FrontControllerFiles extends Component
{
    use WithPagination;
    public $search = '';
    public $sort = 'name';
    public $direction = 'desc';
    public $entrys = [2,5,10,20,50,100], $cant = '10';
    public $readyToLoad = false;

    public $project; //Variable que viene desde el controlador

    protected $files = [];

    protected $queryString = [
        'cant' => ['except' => '10'], 
        'sort'  => ['except' => 'name'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount($project){
        $this->project = $project;
    }

    public function loadFrontFiles(){
        $this->readyToLoad = true;
    }

    public function updatingCant(){
        $this->resetPage('FilesFrontPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('FilesFrontPage');
    }

    public function render()
    {
        if($this->readyToLoad){
            $files = File::where('project_id', $this->project->id)
            ->where('status',2)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant, ['*'], 'FilesFrontPage');
        }else{
            $files = [];
        }
        $this->files = $files;
        return view('livewire.front.front-controller-files',compact('files'));
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

}
