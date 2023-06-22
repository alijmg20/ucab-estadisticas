<?php

namespace App\Http\Livewire\Testimonial;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialModal extends Component
{

    public $open = false;
    public $status = 0,$message,$user_id;
    public $testimonial; //Variable de update

    protected $listeners = ['edit'];

    protected $rules = [
        'status' => 'required',
        'message' => 'required|max:700',
        'user_id' => 'required',
    ];

    public function mount(){
        $this->user_id = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.testimonial.testimonial-modal');
    }

    public function openModal(){
        $this->reset(['status','message','testimonial']);
        $this->open = true;
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function save(){

        $this->validate();        
        $testimonial = Testimonial::updateOrCreate([
            'id' => $this->testimonial ? $this->testimonial->id : '' ,
        ],[
            'message' => $this->message,
            'status' => $this->status ? '2' : '1',
            'user_id' => $this->testimonial ? $this->testimonial->user_id : $this->user_id,
        ]);
        $this->emitTo('testimonial.testimonial-controller','render');
        $this->emit('testimonialAlert','terminado!',$this->testimonial ? 'Experiencia actualizada exitosamente' :
            'Experiencia creada y enviada exitosamente');
        $this->resetInputDefaults();
    
    }

    public function edit($id){
        $this->reset(['status','message','testimonial']);
        $this->testimonial = $testimonial = Testimonial::find($id);
        $this->status = $testimonial->status == 2 ? 1 : 0;
        $this->message = $testimonial->message;
        $this->open = true;
    }

    public function resetInputDefaults(){
        $this->reset(['open','status','message','testimonial']);
    }

}
