<?php

namespace App\Http\Livewire\Stadistic\Pdf;

use App\Models\Line;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class StadisticsPdf extends Component
{
    public $user, $projects;
    public $totalsProject = [];
    public $lines;
    public $date_ini = null;
    public $date_end = null;
    public $line_id = 0;
    protected $rules = [
        'date_end' => '',
        'date_ini' => '',
    ];

    public function mount($date_ini = null, $date_end = null,$line_id = 0)
    {
        $this->user = User::find(auth()->user()->id);
        $this->date_ini = $date_ini;
        $this->date_end = $date_end;
        $this->line_id = $line_id;
    }
     

    public function render()
    {
        $this->lines = Line::all();
        $this->stadisticsTotals();
        return view('livewire.stadistic.pdf.stadistics-pdf')
            ->layout('layouts.pdf');
    }

    public function goBack()
    {
        return redirect()->route('admin.stadistics');
    }

    public function stadisticsTotals()
    {
        $this->projects = $this->user->projectsMany()
            ->whereBetween('created_at', [
                date("Y-m-d 00:00:00", strtotime($this->date_ini)),
                date("Y-m-d 00:00:00", strtotime($this->date_end))
            ])
            ->where(function ($query) {
                if ($this->line_id != 0) {
                    $query->where('line_id', $this->line_id);
                } else {
                    $query->where('line_id', '<>', 0);
                }
            })
            ->get();

        $this->totalsProject['ProjectsEnded'] = $this->projects->where('ended', 2);

        $this->totalsProject['ProjectsProgress'] = $this->projects->where('ended', 1);
    }
}
