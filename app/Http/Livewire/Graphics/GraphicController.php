<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Data;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
class GraphicController extends Component
{
    use WithPagination;

    public $searchGraphic = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $readyToLoad = false;

    protected $queryString = [
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'searchGraphic' => ['except' => ''],
    ];

    public $file;
    public $variables = [];
    public $variablesActive = [];

    protected $listeners = ['render'];

    public function loadgraphic(){
        $this->readyToLoad = true;
    }

    public function mount($file)
    {
        $this->file = $file;
    }

    public function render()
    {
        $variables = Variable::where('file_id', $this->file->id)
        ->where('status', 2)
        ->get();
        $this->variables = $variables;
        $this->showGraphics();
        return view('livewire.graphics.graphic-controller');
    }

    public function showGraphics()
    {
        $variables = $this->variables;
        $variablesActive = [];
        foreach($variables as $variable){
            // if($variable->frequencies){
                $variablesActive[] = $variable;
            // }
        }
        $this->variablesActive = $variablesActive;
    }
}
