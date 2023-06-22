<?php

namespace App\Http\Livewire\Line;

use App\Helpers\Tools;
use App\Models\Line;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class LineController extends Component
{

    use WithFileUploads;
    use WithPagination;
    protected  $lines;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $line, $open_edit = false, $file;
    public $entrys = [2,5,10,20,50,100], $cant = '5';
    public $readyToLoad = false ;

    protected $queryString = [
        'cant' => ['except' => '5'], 
        'sort'  => ['except' => 'id'],
        'direction'  => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $rules = [
        'line.name' => 'required',
        'line.description' => 'required',
        'line.slug' => 'required',
        'line.status' => 'required',
    ];

    protected $listeners = ['render','delete'];

    public function mount()
    {
        $this->line = new Line();
    }

    public function updatingCant(){
        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->readyToLoad){
            $lines = Line::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        }else{
            $lines = [];
        }
        
        $this->lines = $lines;
        return view('livewire.line.line-controller', compact('lines'));
    }

    public function loadLine(){
        $this->readyToLoad = true;
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

    public function edit($line)
    {
        $this->line = Line::find($line);
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->file) {
            Tools::DeleteStorageUrl($this->line->image->url);
            $this->line->image->url = $this->file->store('lines');
            $this->line->image->save();
        }
        $this->line->save();
        $this->resetInputDefaults();
        $this->emit('lineAlert', 'terminado!', 'Linea actualizada exitosamente');
    }

    public function delete($id){
        $line = Line::find($id);
        Tools::DeleteStorageUrl($line->image->url);
        $line->delete();
    }

    public function generateSlug()
    {
        $this->line->slug = Str::slug($this->line->name);
    }

    public function closeModal()
    {
        $this->resetInputDefaults();
    }

    public function resetInputDefaults()
    {
        $this->reset(['open_edit', 'file']);
    }
}
