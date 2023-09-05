<?php

namespace App\Http\Livewire\Graphics\Qualitatives;

use App\Models\Variable;
use Livewire\Component;
use Livewire\WithPagination;
use Sentiment\Analyzer;


class QualitativeTable extends Component
{
    use WithPagination;
    public $variable;
    protected $words;
    public $sensibility;

    protected $listeners = ['render'];

    public function mount($variable)
    {
        $this->variable = Variable::find($variable);

    }

    public function render()
    {
        $words = $this->getWords();
        $sensibility = $this->variable->sensibilities()->latest()->first();
        $this->sensibility = $this->getPorcentageTotal($sensibility);
        return view('livewire.graphics.qualitatives.qualitative-table', compact('words'));
    }

    public function getWords()
    {
        $pagename = 'qualitativePage-'.$this->variable->id;
        return $this->words = $this->variable->frequencies()->paginate(5,['*'],$pagename);
    }

    public function getPorcentageTotal($sensibility)
    {
        $totalAnswers = $sensibility->count;
        $totals = [];
        $totals['positive'] = number_format($sensibility->positive * 100 / $totalAnswers,2);
        $totals['negative'] = number_format($sensibility->negative * 100 / $totalAnswers,2);
        $totals['neutral']  = number_format($sensibility->neutral  * 100 / $totalAnswers,2);
        return $totals;
    }


}
