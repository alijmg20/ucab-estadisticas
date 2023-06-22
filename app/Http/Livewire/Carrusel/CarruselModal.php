<?php

namespace App\Http\Livewire\Carrusel;

use App\Helpers\Tools;
use App\Models\Carrusel;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarruselModal extends Component
{

    use WithFileUploads;
    public $carrusel; //Variable de update
    public $open = false;
    public $file, $alt = '';

    protected $listeners = ['edit'];
    protected $rules = [
        'alt' => '',
        'file' => 'required',
    ];

    public function render()
    {
        return view('livewire.carrusel.carrusel-modal');
    }

    public function openModal()
    {
        $this->reset(['file', 'alt', 'carrusel']);
        $this->open = true;
    }

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open', 'file', 'alt', 'carrusel']);
    }

    public function edit($id)
    {
        $this->reset(['file', 'alt', 'carrusel']);
        $this->carrusel = Carrusel::find($id);
        $this->alt = $this->carrusel->alt;
        $this->open = true;
    }

    public function save(){
        
        $this->validate($this->carrusel && $this->carrusel->url ? [
            'alt' => '',
            'file' => '',
        ] : $this->rules );
        if($this->carrusel && $this->carrusel->url && $this->file){
            Tools::DeleteStorageUrl($this->carrusel->url);    
            $file = $this->file->store('carrusel');
        }else if($this->carrusel && $this->carrusel->url){
            $file = $this->carrusel->url;
        }else{
            $file = $this->file->store('carrusel');
        }
        
        Carrusel::UpdateOrCreate([
            'id' => $this->carrusel ? $this->carrusel->id : '',
        ],[
            'alt' => $this->alt,
            'url' => $file,
        ]);
        $this->emitTo('carrusel.carrusel-controller','render');
        $this->emit('carruselAlert','terminado!',$this->carrusel ? 'Slider actualizado exitosamente' :
         'Slider creado exitosamente');
        $this->resetInputDefaults();
    }

}
