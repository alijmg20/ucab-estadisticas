<?php

namespace App\View\Components\Front;

use App\Models\Line;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class frontLines extends Component
{

    public $same;

    public function __construct($same = null)
    {
        $this->same =  $same;
    }

    public function render(): View|Closure|string
    {
        if($this->same){
            $lines = Line::where(function($query){
                $query->where('id','!=',$this->same)
                ->where('status' , 2);
            })
            ->get();
        }else{
            $lines = Line::where('status' , 2)->get();
        }
        return view('components.front.front-lines',compact('lines'));
    }
}
