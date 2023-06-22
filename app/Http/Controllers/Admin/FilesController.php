<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Project;

class FilesController extends Controller
{
    public function show(Project $project)
    {
        return view('admin.files.show',compact('project'));
    }

    public function showfile(File $file)
    {
        return view('admin.files.showfile',compact('file'));
    }
}
