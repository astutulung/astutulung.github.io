<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $title = 'Berita';
        $beritas = Berita::all();
        return view('frontend.pages.blog', compact('beritas', 'title'));
    }
}
