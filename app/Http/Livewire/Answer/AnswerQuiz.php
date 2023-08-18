<?php

namespace App\Http\Livewire\Answer;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizUser;
use Livewire\Component;

class AnswerQuiz extends Component
{
    public $quiz; //Quiz que se va a generar para el envio
    public $answers = []; //Aqui van todas las respuestas del quiz
    public function mount($quiz)
    {
        $this->quiz = Quiz::find($quiz);
    }
    public function render()
    {
        return view('livewire.answer.answer-quiz');
    }

    public function submitAnswers()
    {
        $user_id = auth()->user() ? auth()->user()->id : 0;
        $requireds = $this->verifyRequireds();
        if (!$this->requireds($requireds)) {
            $quizUser = QuizUser::create([
                'user_id' => $user_id,
                'quiz_id' => $this->quiz->id,
                'respond' => 2,
            ]);
            foreach ($this->quiz->questions as $question) {
                $answer = !empty($this->answers[$question->id]) ? $this->answers[$question->id] : 'Sin respuesta';
                Answer::create([
                    'answer' => $answer,
                    'question_id' => $question->id,
                    'quiz_user_id' => $quizUser->id,
                ]);
            }
            $this->resetInputsDefault();
            return redirect()->route('answer.answered',$this->quiz);
            // $this->emit('answerQuizAlert', 'terminado!', 'Encuesta enviada exitosamente');
        }
    }

    public function verifyRequireds()
    {
        $requireds = [];
        foreach ($this->quiz->questions as $question) {
            if (empty($this->answers[$question->id])) {
                $question->required == 2 ? $requireds[] = $question->id  : ''; //obtener preguntas requeridas
            }
        }
        return $requireds;
    }

    public function requireds($requireds)
    {
        if (count($requireds)) {
            foreach ($requireds as $required) {
                $this->addError('answers.' . $required, 'respuesta obligatoria');
            }
            return true;
        }
        return false;
    }

    public function resetInputsDefault(){
        $this->reset('answers');
    }
}
