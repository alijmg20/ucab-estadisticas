<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarruselController extends Controller
{
    public function index(){
        return view('admin.carrusel.index');
    }
}
