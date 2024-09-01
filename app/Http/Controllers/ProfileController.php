<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile Siswa';
        $user = Auth::user();
        $calonSiswa = CalonSiswa::where('user_id', $user->id)->with('pendaftaran')->first();

        if (!$calonSiswa) {
            return redirect()->route('home')->with('error', 'Profil siswa tidak ditemukan.');
        }
        return view('admin.pages.profile.siswa.index', compact('calonSiswa', 'title'));
    }

    public function update(Request $request, $id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();

        $calonSiswa->update($request->only(['nama_siswa', 'asal_sekolah', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jk', 'tahun_ajaran', 'no_tlpn', 'email', 'alamat']));

        if ($pendaftaran) {
            $pendaftaran->update($request->only(['NIS', 'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'alamat_orangtua', 'nama_wali', 'alamat_wali', 'golongan_darah', 'tanggal_registrasi', 'jml_saudara_kandung']));
        }

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
