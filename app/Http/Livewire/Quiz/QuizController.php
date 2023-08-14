<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Project;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;
class QuizController extends Component
{
    use WithPagination;
    public $project; //Proyecto que tiene encuestas
    
    public $searchQuiz = '';
    public $sortQuiz = 'id';
    public $directionQuiz = 'asc';
    public $entrysQuiz = [2, 5, 10, 20, 50, 100], $cantQuiz = '10';
    public $readyToLoad = false;

    protected $listeners = ['render', 'delete'];

    protected $quizzes = [];

    protected $queryString = [
        'cantQuiz' => ['except' => '10'],
        'sortQuiz'  => ['except' => 'id'],
        'directionQuiz'  => ['except' => 'asc'],
        'searchQuiz' => ['except' => '']
    ];

    public function mount($project){

        $this->project = Project::find($project);
    }

    public function loadQuizzes()
    {
        $this->readyToLoad = true;
    }

    public function updatingCantQuiz()
    {
        $this->resetPage('quizPage');
    }

    public function updatingSearchQuiz()
    {
        $this->resetPage('quizPage');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $quizzes = Quiz::where('project_id', $this->project->id)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchQuiz . '%')
                        ->orWhere('id', 'like', '%' . $this->searchQuiz . '%')
                        ->orWhere('created_at', 'like', '%' . $this->searchQuiz . '%')
                        ;
                })
                ->orderBy($this->sortQuiz, $this->directionQuiz)
                ->paginate($this->cantQuiz, ['*'], 'quizzesPage');
        } else {
            $quizzes = [];
        }
        $this->quizzes = $quizzes;
        return view('livewire.quiz.quiz-controller',compact('quizzes'));
    }


    public function order($sort)
    {
        if ($this->sortQuiz == $sort) {
            if ($this->directionQuiz == 'desc') {
                $this->directionQuiz = 'asc';
            } else {
                $this->directionQuiz = 'desc';
            }
        } else {
            $this->sortQuiz = $sort;
            $this->directionQuiz = 'asc';
        }
    }
    public function delete($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
    }

}
