<?php

namespace App\View\Components\Front;

use App\Models\Testimonial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class frontTestimonials extends Component
{

    public function render(): View|Closure|string
    {
        $testimonials = Testimonial::where('status','2')->get();
        return view('components.front.front-testimonials',compact('testimonials'));
    }
}
