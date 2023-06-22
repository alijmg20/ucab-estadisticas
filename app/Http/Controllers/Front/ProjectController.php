<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        return view('projects.index');
    }
    public function show(Project $project)
    {
        return view('projects.show',compact('project'));
    }
}
