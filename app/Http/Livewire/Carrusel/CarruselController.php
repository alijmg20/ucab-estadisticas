<?php

namespace App\Http\Livewire\Carrusel;

use App\Helpers\Tools;
use App\Models\Carrusel;
use Livewire\Component;
use Livewire\WithPagination;
class CarruselController extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $entrys = [5, 10, 20, 50, 100], $cant = '5';
    public $readyToLoad = false;

    protected $carrusel = [];
    protected $listeners = ['render','delete'];

    public function loadCarrusel()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage('usersPage');
    }

    public function updatingCant(){
        $this->resetPage('usersPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $carrusel = $this->carrusel = Carrusel::where('id', 'like', '%' . $this->search . '%')
                ->orwhere('created_at', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant, ['*'], 'usersPage');
        } else {
            $carrusel = [];
        }
        return view('livewire.carrusel.carrusel-controller',compact('carrusel'));
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
        $carrusel = Carrusel::find($id);
        Tools::DeleteStorageUrl($carrusel->url);
        $carrusel->delete();
    }

}
