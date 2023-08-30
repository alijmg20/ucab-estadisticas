<?php

namespace App\Http\Livewire\Stadistic;

use App\Models\User;
use Livewire\Component;

class StadisticController extends Component
{
    public $user,$projects;
    public function mount(){
        $this->user = User::find(Auth()->user()->id);
    }

    public function render()
    {
        $this->projects = $this->user->projectsMany;
        return view('livewire.stadistic.stadistic-controller')
        ->layout('layouts.admin');
    }
}
