<?php

namespace App\Http\Livewire\Front;

use App\Models\Line;
use Livewire\Component;

class FrontLines extends Component
{
    public $same;
    public $lines;
    public $title,$needButton,$titleButton;

    public function mount($same = null,$title,$needButton = null,$titleButton = null){
        $this->same = $same;
        $this->title = $title;
        $this->needButton = $needButton;
        $this->titleButton = $titleButton;
    }

    public function render()
    {
        if($this->same){
            $this->lines = Line::where(function($query){
                $query->where('id','!=',$this->same)
                ->where('status' , 2);
            })
            ->get();
        }else{
            $this->lines = Line::where('status' , 2)->get();
        }
        return view('livewire.front.front-lines');
    }
}
