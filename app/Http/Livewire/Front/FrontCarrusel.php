<?php

namespace App\Http\Livewire\Front;

use App\Models\Carrusel;
use Livewire\Component;

class FrontCarrusel extends Component
{
    public $carrusel;
    public function render()
    {
        $this->carrusel = Carrusel::all();
        return view('livewire.front.front-carrusel');
    }
}
