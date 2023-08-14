<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.edit',compact('quiz'));
    }
}