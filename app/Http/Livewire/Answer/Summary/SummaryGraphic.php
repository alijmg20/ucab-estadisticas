<?php

namespace App\Http\Livewire\Answer\Summary;

use App\Models\Answer;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SummaryGraphic extends Component
{
    public $question;
    public $answers = [];
    protected $listeners = ['render','loadSummary'];
    public function mount($question){
        $this->question = Question::find($question);
    }

    public function render()
    {
        return view('livewire.answer.summary.summary-graphic');
    }

    public function loadSummary(){
        switch ($this->question->typequestion) {
            case 1:
                $this->answers = Answer::where('question_id',$this->question->id)
                ->get();
                break;
            case 2:
                $frequencies = Answer::select('answer', DB::raw('count(*) as y'))
                ->where('question_id',$this->question->id)
                ->groupBy('answer')
                ->havingRaw('COUNT(*) IS NOT NULL AND answer IS NOT NULL')
                ->orderBy('answer', 'asc')
                ->pluck('y','answer')
                ->toArray();
                $frequencies_aux = [];
            foreach ($frequencies as $key => $value) {
                $frequencies_aux[] = ['name' => $key, 'y' => floatval($value)];
            }
            $data = json_encode($frequencies_aux);
            $question = $this->question;
            $this->emit('summaryGraphicShow', $question, $data);
                break;
        }
    }
}
