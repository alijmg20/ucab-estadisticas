<?php

namespace App\Http\Livewire\Emails;

use App\Models\Email;
use Livewire\Component;

class EmailModal extends Component
{

    public $open = false;

    public $name,$email,$subject,$message,$status = false;
    public $mail; //La variable para edit

    protected $listeners = ['edit'];

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'subject' => '',
        'message' => 'required',
        'status' => 'required',
    ];

    public function render()
    {
        return view('livewire.emails.email-modal');
    }

    public function openModal(){
        $this->reset(['name','email','subject','message','mail']);
        $this->open = true;
    }

    public function edit($id){
        $this->reset(['name','email','subject','message','mail']);
        $this->mail = $mail = Email::find($id);
        $this->name = $mail->name;
        $this->email = $mail->email;
        $this->subject = $mail->subject;
        $this->message = $mail->message;
        $this->status = $mail->status == '2' ? true : false;
        $this->open = true;
    }

    public function save(){
        $this->validate();
        $mail = Email::updateOrCreate([
            'id' => $this->mail ? $this->mail->id : '' ,
        ],[
            'status' => $this->status ? '2' : '1',
        ]);
        $this->emitTo('emails.email-controller','render');
        $this->emit('emailAlert','terminado!','estado de mensaje actualizado exitosamente');
        $this->resetInputDefaults();
    }

    public function closeModal(){
        $this->resetInputDefaults();
    }

    public function resetInputDefaults(){
        $this->reset(['open','name','email','subject','message','mail']);
    }

}
