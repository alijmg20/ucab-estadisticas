<?php

namespace App\View\Components\Front;

use App\Models\Carrusel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class frontCarrusel extends Component
{
    public function render(): View|Closure|string
    {
        $carrusel = Carrusel::all();
        return view('components.front.front-carrusel',compact('carrusel'));
    }
}
