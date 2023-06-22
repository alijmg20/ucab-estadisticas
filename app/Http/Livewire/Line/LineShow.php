<?php

namespace App\Http\Livewire\Line;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class LineShow extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $entrys = [2, 5, 10, 20, 50, 100], $cant = '3';

    public $line;
    protected $projects = [];

    public function mount($line)
    {
        $this->line = $line;
    }

    public function render()
    {
        $this->projects = $projects = Project::where(function ($query) {
            $query->where('line_id', $this->line->id)
                ->where('status', 2);
        })
            ->paginate($this->cant);
        return view('livewire.line.line-show', compact('projects'));
    }
}
