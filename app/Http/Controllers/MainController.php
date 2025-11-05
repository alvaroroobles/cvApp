<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Curriculum;

class MainController extends Controller
{
    function main(): View{
        $curriculums = Curriculum::all();
        return view('main.main',['curriculums'=> $curriculums]);
    }
}
