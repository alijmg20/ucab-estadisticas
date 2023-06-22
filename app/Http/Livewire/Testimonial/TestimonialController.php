<?php

namespace App\Http\Livewire\Testimonial;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class TestimonialController extends Component
{

    use WithPagination;

    public $search = '';
    public $sort = 'testimonials.id';
    public $direction = 'desc';
    

    public $entrys = [2,5, 10, 20, 50, 100], $cant = '10';
    public $readyToLoad = false;

    protected $testimonials = [];

    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'  => ['except' => 'testimonials.id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function loadTestimonials()
    {
        $this->readyToLoad = true;
    }

    public function updatingCant(){
        $this->resetPage('testimonialsPage');
    }

    public function updatingSearch()
    {
        $this->resetPage('testimonialsPage');
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $testimonials = Testimonial::where('testimonials.id', 'like', '%' . $this->search . '%')
                ->orWhere('testimonials.message', 'like', '%' . $this->search . '%')
                ->join('users', 'testimonials.user_id', '=', 'users.id')
                ->select('testimonials.id', 'testimonials.message', 'users.name','testimonials.created_at')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'testimonialsPage');
        } else {
            $testimonials = [];
        }

        return view('livewire.testimonial.testimonial-controller',compact('testimonials'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function delete($id)
    {
        $user = Testimonial::find($id);
        $user->delete();
    }
}
