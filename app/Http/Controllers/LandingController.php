<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        $jurusans = Jurusan::all();

        return view('frontend.landing.index', compact('beritas', 'jurusans'));
    }
}
