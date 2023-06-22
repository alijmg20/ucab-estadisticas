<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\Project;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function index()
    {
        return view('lines.index');
    }
    public function show(Line $line)
    {
        return view('lines.show',compact('line'));
    }

}
