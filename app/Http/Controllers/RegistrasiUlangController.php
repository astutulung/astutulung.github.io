<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\RegistrasiUlang;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrasiUlangController extends Controller
{
    public function index()
    {
        $title = 'Registrasi Ulang';
        return view('admin.pages.pendaftaran.registrasiulang', compact('title'));
    }

    public function store(Request $request)
    {
        Log::info('Masuk ke metode store.');
        Debugbar::info('Masuk ke metode store.');

        try {
            Log::info('Memulai validasi.');
            $validatedData = $request->validate([
                'NIS' => 'required|string|max:255',
                'no_seri_ijazah' => 'required|integer',
                'file_SKHUN' => 'required|file|mimes:pdf,jpg,png',
                'nama_ayah' => 'required|string|max:255',
                'pekerjaan_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'pekerjaan_ibu' => 'required|string|max:255',
                'alamat_orangtua' => 'required|string|max:255',
                'nama_wali' => 'nullable|string|max:255',
                'alamat_wali' => 'nullable|string|max:255',
                'tinggal_bersama' => 'required|string|max:255',
                'asal_prov' => 'required|string|max:255',
                'asal_kab' => 'required|string|max:255',
                'asal_kec' => 'required|string|max:255',
                'asal_kel' => 'required|string|max:255',
                'RT' => 'required|integer',
                'RW' => 'required|integer',
                'golongan_darah' => 'required|string|max:255',
                'tanggal_registrasi' => 'required|date',
                'jml_saudara_kandung' => 'required|integer',
            ]);

            Log::info('Validasi berhasil.');
            Debugbar::info('Validasi berhasil.', $validatedData);

            $file = $request->file('file_SKHUN');
            if ($file) {
                Log::info('File ditemukan.', ['file_name' => $file->getClientOriginalName()]);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('skhun', $fileName, 'public');
                Log::info('File diunggah.', ['file_path' => $filePath]);
            } else {
                Log::info('File tidak ditemukan.');
            }

            $userId = Auth::id();
            Log::info('User ID: ' . $userId);
            $calonSiswa = CalonSiswa::where('user_id', $userId)->firstOrFail();
            Log::info('Calon siswa ditemukan.', ['calon_siswa_id' => $calonSiswa->id]);
            Debugbar::info('Calon siswa ditemukan.', ['calon_siswa_id' => $calonSiswa->id]);

            Pendaftaran::create([
                'kode_rus' => 'RU' . str_pad(Pendaftaran::max('id') + 1, 4, '0', STR_PAD_LEFT),
                'calon_siswa_id' => $calonSiswa->id,
                'NIS' => $request->NIS,
                'no_seri_ijazah' => $request->no_seri_ijazah,
                'file_SKHUN' => isset($filePath) ? $filePath : null,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat_orangtua' => $request->alamat_orangtua,
                'nama_wali' => $request->nama_wali,
                'alamat_wali' => $request->alamat_wali,
                'tinggal_bersama' => $request->tinggal_bersama,
                'asal_prov' => $request->asal_prov,
                'asal_kab' => $request->asal_kab,
                'asal_kec' => $request->asal_kec,
                'asal_kel' => $request->asal_kel,
                'RT' => $request->RT,
                'RW' => $request->RW,
                'golongan_darah' => $request->golongan_darah,
                'tanggal_registrasi' => $request->tanggal_registrasi,
                'jml_saudara_kandung' => $request->jml_saudara_kandung,
            ]);

            Log::info('Registrasi ulang berhasil ditambahkan.');
            Debugbar::info('Registrasi ulang berhasil ditambahkan.');

            Alert::success('Sukses', 'Registrasi ulang berhasil ditambahkan');
            return redirect()->route('pendaftaran.index')->with('success', 'Registrasi ulang berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal.', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            Debugbar::error('Terjadi kesalahan.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            Alert::error('Error', 'Terjadi kesalahan saat menambahkan registrasi ulang');
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan registrasi ulang');
        }
    }
}
