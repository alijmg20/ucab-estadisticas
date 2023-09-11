<?php

namespace App\Http\Livewire\Graphics\Correlation;

use App\Models\Correlation;
use App\Models\File;
use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;
class CorrelationModal extends Component
{
    use WithPagination;
    public $file;
    public $openCorrelation = false;
    public $name, $correlation;
    public $variables = [];

    protected $variablesList = [];
    protected $listeners = ['correlationEdit'];
    protected $rules = [
        'name' => 'required',
        'variables' => 'required|array|size:2',
        'variables.0' => 'required',
        'variables.1' => 'required',
    ];

    public function mount($file){
        $this->file = File::find($file);
    }

    public function render()
    {
        $variablesList = Variable::where('file_id', $this->file->id)
        ->whereIn('variabletype_id', [2, 3])
        ->get();
    
        return view('livewire.graphics.correlation.correlation-modal',compact('variablesList'));
    }

    public function openModal(){
        $this->reset(['name', 'variables', 'correlation']);
        $this->openCorrelation = true;
    }

    public function save(){
        $this->validate();
        $correlation = new Correlation();
        $correlation->name = $this->name;
        $correlation->file_id = $this->file->id;
        $correlation->save();
        $correlation->variables()->sync($this->variables);
        $this->emitTo('graphics.correlation.correlation-controller', 'render');
        $this->emit('correlationAlert', 'terminado!','Correlación creada exitosamente');
        $this->resetInputDefaults();
    
    }

    public function correlationEdit($correlation_id){
        $this->reset(['name', 'variables', 'correlation']);
        $correlation = Correlation::find($correlation_id);
        $this->correlation = $correlation;
        $this->name = $correlation->name;
        $this->variables = $correlation->variables->pluck('id')->toArray();
        $this->openCorrelation = true;
    }

    public function update(){
        $this->validate();
        $this->correlation->name = $this->name;
        $this->correlation->variables()->sync($this->variables);
        $this->correlation->save();
        $this->emitTo('graphics.correlation.correlation-controller', 'render');
        $this->emitTo('graphics.correlation.variable-correlation', 'render');
        $this->emit('correlationAlert', 'terminado!','Correlación actualizada exitosamente');
        $this->resetInputDefaults();
    }

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['openCorrelation', 'name', 'variables', 'correlation']);
    }
}
