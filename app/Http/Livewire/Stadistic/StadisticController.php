<?php

namespace App\Http\Livewire\Stadistic;

use App\Models\Line;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class StadisticController extends Component
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

    protected $queryString = [
        'date_ini' => ['except' => ''],
        'date_end' => ['except' => ''],
    ];

    public function mount()
    {
        $this->user = User::find(Auth()->user()->id);
        $date_ini = date('Y-m-d');
        $fechaActual = Carbon::now();
        $this->date_ini = $date_ini;
        $this->date_end = $fechaActual->format('Y-m-d');
    }

    public function render()
    {
        $this->lines = Line::all();
        $this->stadisticsTotals();
        return view('livewire.stadistic.stadistic-controller')
            ->layout('layouts.admin');
    }

    public function goBack(){
        return redirect()->route('admin.home');
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
