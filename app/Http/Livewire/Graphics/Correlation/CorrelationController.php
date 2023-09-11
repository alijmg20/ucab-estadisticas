<?php

namespace App\Http\Livewire\Graphics\Correlation;

use App\Models\Correlation;
use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;
class CorrelationController extends Component
{
    use WithPagination;
    public $file;
    public $searchCorrelation = '';
    public $entrysCorrelation = [2, 5, 10], $cantCorrelation = '5';
    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cantCorrelation' => ['except' => '10'],
        'searchCorrelation' => ['except' => ''],
    ];

    public function mount($file){
        $this->file = File::find($file);
    }

    public function render()
    {
        $correlations = $this->getCorrelations();
        return view('livewire.graphics.correlation.correlation-controller',compact('correlations'));
    }

    public function getCorrelations(){
        return Correlation::where('file_id',$this->file->id)
        ->where(function ($query) {
            $query->where('name', 'like', '%' . $this->searchCorrelation . '%');
        })
        ->paginate($this->cantCorrelation, ['*'], 'CorrelationsPage');
    }

    public function delete($correlation){
        $correlationD = Correlation::find($correlation);
        $correlationD->delete();
    }

}
