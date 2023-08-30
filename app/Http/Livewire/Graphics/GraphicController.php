<?php

namespace App\Http\Livewire\Graphics;

use App\Models\Data;
use App\Models\File;
use App\Models\Variable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use PDF;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Response;

class GraphicController extends Component
{
    use WithPagination;

    public $searchGraphic = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $readyToLoad = false;
    public $activeTabVariable = 1;
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

    public function updateTab($activeTabVariable){
        $this->activeTabVariable = $activeTabVariable;
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
        $this->emitTo('graphics.qualitatives.qualitative-controller','render');
        $this->emitTo('graphics.multiple.multiple-controller','render');
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
