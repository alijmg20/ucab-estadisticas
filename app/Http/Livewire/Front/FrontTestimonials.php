<?php

namespace App\Http\Livewire\Front;

use App\Models\Testimonial;
use Livewire\Component;

class FrontTestimonials extends Component
{
    public function render()
    {
        $testimonials = Testimonial::where('status','2')->get();
        return view('livewire.front.front-testimonials',compact('testimonials'));
    }
}
