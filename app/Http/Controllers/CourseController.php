<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index ()
    {
        $title = "Jurusan";
        $jurusans = Jurusan::all();
        return view('frontend.pages.course', compact('jurusans', 'title'));
    }
}
