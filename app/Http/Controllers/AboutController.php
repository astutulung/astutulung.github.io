<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $title = 'About';
        return view('frontend.pages.about', compact('title'));
    }
}
