<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Login';
        return view('login', compact('title'));
    }

    public function showRegistrationForm()
    {
        $title = 'Register';
        return view('register', compact('title'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            Alert::success('Login Berhasil', 'Selamat datang, ' . $user->name);

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard');
                case 'panitia':
                    return redirect()->route('dashboard');
                case 'siswa':
                    return redirect()->route('dashboard');
                default:
                    Auth::logout();
                    Alert::error('Login Gagal', 'Role tidak dikenal');
                    return redirect()->route('login');
            }
        }

        Alert::error('Login Gagal', 'Email atau password salah');
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jk' => 'required|string|max:255',
            'no_tlpn' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                Log::error($error);
            }
            Alert::error('Error', 'There were some issues with your input.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            User::create([
                'nama' => $request->nama,
                'jk' => $request->jk,
                'no_tlpn' => $request->no_tlpn,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            Alert::success('Success', 'Account created successfully. Please login.');
            return redirect()->route('login');

        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while creating your account. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Logout Berhasil', 'Anda telah logout');
        return redirect()->route('login');
    }
}
