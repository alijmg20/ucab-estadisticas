<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;
class GraphicDetails extends Component
{
    use WithPagination;
    public $searchGraphicDetails = '';
    public $sortGraphicDetails = 'id';
    public $directionGraphicDetails = 'asc';
    public $entrysGraphicDetails = [2, 5, 10, 20, 50, 100];
    public $cantGraphicDetails = '10';
    public $readyToLoad = false;


    protected $variables = [];
    public $file;

    protected $listeners = ['render'];

    protected $queryString = [
        'cantGraphicDetails' => ['except' => '10'],
        'sortGraphicDetails'  => ['except' => 'name'],
        'directionGraphicDetails'  => ['except' => 'asc'],
        'searchGraphicDetails' => ['except' => '']
    ];

    public function mount($file)
    {
        $this->file = $file;
    }

    public function loadGraphicDetails()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantGraphicDetails()
    {
        $this->resetPage('graphicDetailPage');
    }

    public function updatingSearchGraphicDetails()
    {
        $this->resetPage('graphicDetailPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $variables = Variable::where('file_id', $this->file->id)
                ->where('status', 2)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchGraphicDetails . '%');
                })
                ->orderBy($this->sortGraphicDetails, $this->directionGraphicDetails)
                ->paginate($this->cantGraphicDetails, ['*'], 'graphicDetailPage');
        } else {
            $variables = [];
        }
        $this->variables = $variables;
        return view('livewire.graphics.graphic-details',compact('variables'));
    }
    
    public function order($sort)
    {
        if ($this->sortGraphicDetails == $sort) {
            if ($this->directionGraphicDetails == 'desc') {
                $this->directionGraphicDetails = 'asc';
            } else {
                $this->directionGraphicDetails = 'desc';
            }
        } else {
            $this->sortGraphicDetails = $sort;
            $this->directionGraphicDetails = 'asc';
        }
    }
}
