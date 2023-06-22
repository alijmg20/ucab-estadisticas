<?php

namespace App\Http\Livewire\Line;

use App\Helpers\Tools;
use Livewire\Component;
use App\Models\Line;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class LineModal extends Component
{
    use WithFileUploads;
    public $open = false,$open_edit = false;

    public $name, $description, $slug,$file,$status = 1;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required|unique:projects',
        'file' => 'required',
        'status' => 'required'
    ]; 

    public function render()
    {
        return view('livewire.line.line-modal');
    }

    public function updatingOpen(){
        if(!$this->open){
            $this->reset(['name','slug','description','file','status']);
            $this->emit('resetCKeditor');
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function openModal(){
        $this->open = true;
        
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function save(){

        $this->validate();
        $file = $this->file->store('lines');

        $line = Line::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status,
        ]);

        if ($this->file) {
            $line->image()->create([
                'url' => $file
            ]);
        }

        $this->resetInputDefaults();
        $this->emitTo('line.line-controller','render');
        $this->emit('lineAlert','terminado!','Linea creada exitosamente');
    }

    public function resetInputDefaults(){
        $this->reset(['open','name','slug','description','file','status']);
    }

}
