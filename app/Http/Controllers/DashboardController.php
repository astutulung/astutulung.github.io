<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $title = '';

    switch ($user->role) {
        case 'admin':
            $title = 'Admin Dashboard';
            return view('admin.pages.dashboard.admin', compact('title'));
            break;

        case 'panitia':
            $title = 'Panitia Dashboard';
            return view('admin.pages.dashboard.panitia', compact('title'));
            break;

        case 'siswa':
            $title = 'Siswa Dashboard';
            return view('admin.pages.dashboard.siswa', compact('title'));
            break;

        default:
            return abort(403, 'Unauthorized.');
    }
}

}
