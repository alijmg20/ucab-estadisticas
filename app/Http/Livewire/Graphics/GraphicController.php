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
    public $entrysGraphic = [2,5,10,20,50,100];
    public $cantGraphic = '10';
    public $readyToLoad = false;

    protected $queryString = [
        'cantGraphic' => ['except' => '10'], 
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'searchGraphic' => ['except' => ''],
    ];

    public $file;
    public $variables = [];
    public $registers = [];
    public $stadistics = [];

    protected $listeners = ['render','showGraphics'];

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
        return view('livewire.graphics.graphic-controller', compact('variables'));
    }

    public function loadgraphic()
    {
        $this->readyToLoad = true;
    }

    public function showGraphics()
    {
        
        $variables = $this->variables;
        $variablesActive = [];
        $data = [];
        foreach($variables as $variable){
            $variables_get = Data::select('value', DB::raw('count(*) as y'))
            ->where('variable_id', $variable->id)
            ->groupBy('value')
            ->pluck('y','value')
            ->toArray();
            if(count($variables_get) < 15){
                $data_aux =[];
                foreach ($variables_get as $key => $value) {
                    $data_aux[] = ['name' => $key , 'y' => floatval($value) ];
                }
                $data[] = json_encode($data_aux);
                $variablesActive[] = $variable;
            }
            
        }
        // dd($variablesActive);
        $this->emit('ghaphicList',$variablesActive,$data);
    }
}
