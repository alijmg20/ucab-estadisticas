<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function answer(Quiz $quiz){
        return view('answer.index',compact('quiz'));
    }
    public function answered(Quiz $quiz){
        return view('answer.answered',compact('quiz'));
    }
}
