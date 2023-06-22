<?php

namespace App\Http\Livewire\Emails;

use App\Models\Email;
use Livewire\Component;
use Illuminate\Support\Str;
class EmailIndex extends Component
{

    public $name,$mail,$subject,$message,$code,$cod;

    public function mount(){
        $this->cod=strtoupper(Str::random(6));
    }

    public function render()
    {
        return view('livewire.emails.email-index');
    }

    public function save(){
        $this->validate(['name'=>'required',
                            'mail'=>'required',
                            'subject'=>'required',
                            'message'=>'required',
                            'code'=>'required',
                        ]);
        if($this->code==$this->cod){
            Email::create([
                'name'=>$this->name,
                'email'=>$this->mail,
                'subject'=>$this->subject,
                'message'=>$this->message,
            ]);
            $this->emit('success');
            $this->clear();
        }else{
            $this->emit('error');
        }
    }

    public function clear(){
        $this->reset('name','mail','subject','message','code');
        $this->cod=strtoupper(Str::random(6));
    }

    public function change(){
        $this->cod=strtoupper(Str::random(6));
        $this->emit('change');
    }
}
