<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Jurusan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;


class CalonSiswaController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Calon Siswa';
        $userId = Auth::id();
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        $jurusan = Jurusan::all();
        if ($calonSiswa) {
            $hasCompletedRegistration = $calonSiswa->hasCompletedRegistration();
        }

        return view('admin.pages.pendaftaran.index', compact('jurusan', 'calonSiswa', 'title'));
    }

    public function listCalonSiswa()
    {
        $title = 'List Calon Siswa';
        return view('admin.pages.pendaftaran.panitia.index', compact('title'));
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'jurusan_id' => 'required|integer',
        'nama_siswa' => 'required|string|max:255',
        'asal_sekolah' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'agama' => 'required|string|max:255',
        'jk' => 'required|string|max:255',
        'tanggal_daftar' => 'required|date',
        'tahun_ajaran' => 'required|string|max:255',
        'file_raport' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'no_tlpn' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'alamat' => 'required|string|max:255',
    ]);

    // Cek kuota jurusan
    $jurusan = Jurusan::findOrFail($request->jurusan_id);

    if ($jurusan->kuota <= 0) {
        // Jika kuota sudah penuh, tampilkan Sweet Alert error dan batalkan proses pendaftaran
        Alert::error('Kuota Sudah Terpenuhi');
        return redirect()->back()->withInput();
    }

    try {
        // Upload file raport jika ada
        if ($request->hasFile('file_raport')) {
            $file = $request->file('file_raport');
            $userId = Auth::id();
            $timestamp = Carbon::now()->format('Ymd');
            $fileName = $userId . '_' . $timestamp . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('raports', $fileName, 'public');
        } else {
            $filePath = null;
        }

        // Buat entri calon siswa baru
        CalonSiswa::create([
            'kode_pcs' => CalonSiswa::generateKodePcs(),
            'user_id' => Auth::id(),
            'jurusan_id' => $request->jurusan_id,
            'nama_siswa' => $request->nama_siswa,
            'asal_sekolah' => $request->asal_sekolah,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'tanggal_daftar' => $request->tanggal_daftar,
            'tahun_ajaran' => $request->tahun_ajaran,
            'file_raport' => $filePath,
            'no_tlpn' => $request->no_tlpn,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'status' => 'pending',
        ]);

        // Tampilkan Sweet Alert untuk keberhasilan
        Alert::success('Sukses', 'Calon siswa berhasil ditambahkan');
        return redirect()->route('pendaftaran.index')->with('success', 'Calon siswa berhasil ditambahkan');
    } catch (\Exception $e) {
        // Log error dan tampilkan Sweet Alert untuk kesalahan
        Log::error('Error while adding calon siswa: ' . $e->getMessage(), [
            'exception' => $e,
            'input' => $request->all()
        ]);
        Alert::error('Error', 'Terjadi kesalahan saat menambahkan calon siswa');
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan calon siswa');
    }
}


    public function updateStatus(Request $request)
    {
    $request->validate([
        'id' => 'required|integer|exists:calon_siswa,id',
        'status' => 'required|string|in:pending,accept,reject',
    ]);
    $calonSiswa = CalonSiswa::findOrFail($request->id);
    $jurusan = $calonSiswa->jurusan;
    $currentStatus = $calonSiswa->status;
    $newStatus = $request->status;
    if ($currentStatus !== 'accept' && $newStatus === 'accept') {

        if ($jurusan->kuota > 0) {
            $jurusan->decrement('kuota');
        } else {
            return response()->json(['success' => false, 'message' => 'Kuota jurusan ini sudah penuh.'], 400);
        }
    } elseif ($currentStatus === 'accept' && $newStatus !== 'accept') {
        $jurusan->increment('kuota');
    }
    $calonSiswa->status = $newStatus;
    $calonSiswa->save();

    return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }



    public function getData()
    {
        $calonSiswa = CalonSiswa::with('jurusan')->get();
        return DataTables::of($calonSiswa)
            ->addColumn('action', function ($row) {
                return '
                    <div class="d-inline-block">
                        <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end m-0">
                            <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                            <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                        </ul>
                    </div>
                    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="ri-edit-box-line"></i></a>
                ';
            })
            ->make(true);
    }

    public function show($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        $fileRaportPath = asset('storage/raports/' . $calonSiswa->file_raport);
        $fileRaportName = $calonSiswa->file_raport;

        return response()->json([
            'nama_siswa' => $calonSiswa->nama_siswa,
            'email' => $calonSiswa->email,
            'tanggal_daftar' => $calonSiswa->tanggal_daftar,
            'no_tlpn' => $calonSiswa->no_tlpn,
            'asal_sekolah' => $calonSiswa->asal_sekolah,
            'status' => $calonSiswa->status,
            'file_raport' => $fileRaportPath,
            'file_name' => $fileRaportName
        ]);
    }

    public function destroy($id)
    {
        try {
            $calonSiswa = CalonSiswa::findOrFail($id);
            $calonSiswa->delete();
            return response()->json(['success' => true, 'message' => 'Calon siswa berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus calon siswa.']);
        }
    }
}
