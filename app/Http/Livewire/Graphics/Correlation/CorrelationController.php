<?php

namespace App\Http\Livewire\Graphics\Correlation;

use App\Models\Correlation;
use App\Models\File;
use Livewire\Component;

class CorrelationController extends Component
{

    public $file;
    protected $listeners = ['render','delete'];
    public function mount($file){
        $this->file = File::find($file);
    }

    public function render()
    {
        $correlations = $this->getCorrelations();
        return view('livewire.graphics.correlation.correlation-controller',compact('correlations'));
    }

    public function getCorrelations(){
        return Correlation::where('file_id',$this->file->id)->get();
    }

    public function delete($correlation){
        $correlationD = Correlation::find($correlation);
        $correlationD->delete();
    }

}
