<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $beritas = Berita::all();
        $jurusans = Jurusan::all();
        return view('frontend.landing.landing', compact('beritas', 'jurusans', 'title'));
    }
}
