<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PengumumanController extends Controller
{
    public function index()
    {
        $title = 'Pengumuman';
        $siswaList = CalonSiswa::all();
        return view('admin.pages.pengumuman.panitia.index', compact('siswaList', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string|max:255',
            'broadcast' => 'required|string|in:all,specific',
            'siswa' => 'required_if:broadcast,specific|array',
            'siswa.*' => 'integer|exists:calon_siswa,id',
        ]);

        DB::beginTransaction();

        try {
            $kodePengumuman = 'PG' . str_pad(Pengumuman::max('id') + 1, 4, '0', STR_PAD_LEFT);

            if ($request->broadcast == 'all') {
                $allSiswa = CalonSiswa::all();
                foreach ($allSiswa as $siswa) {
                    Pengumuman::create([
                        'kode_pengumuman' => $kodePengumuman,
                        'calon_siswa_id' => $siswa->id,
                        'judul_pengumuman' => $request->judul_pengumuman,
                        'deskripsi' => $request->deskripsi,
                        'status' => $request->status,
                    ]);
                }
            } else {
                foreach ($request->siswa as $calonSiswaId) {
                    Pengumuman::create([
                        'kode_pengumuman' => $kodePengumuman,
                        'calon_siswa_id' => $calonSiswaId,
                        'judul_pengumuman' => $request->judul_pengumuman,
                        'deskripsi' => $request->deskripsi,
                        'status' => $request->status,
                    ]);
                }
            }

            DB::commit();
            Alert::success('Sukses', 'Pengumuman berhasil dikirimkan.');
            return redirect()->route('pengumuman.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan saat mengirimkan pengumuman.');
            return redirect()->back()->withInput();
        }
    }


    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengumuman::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-inline-block">
                        <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ri-more-2-line"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end m-0">
                            <li><a href="javascript:void(0)" class="dropdown-item edit-record">Edit</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item delete-record">Delete</a></li>
                        </ul>
                    </div>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function updateStatus(Request $request)
    {
        try {
            $pengumuman = Pengumuman::find($request->id);
            $pengumuman->status = $request->status;
            $pengumuman->save();

            return response()->json(['success' => 'Status pengumuman berhasil diupdate.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengupdate status.'], 500);
        }
    }

    public function searchSiswa(Request $request)
    {
        $search = $request->get('q');

        $siswa = CalonSiswa::where('nama_siswa', 'like', '%' . $search . '%')->get();

        return response()->json($siswa);
    }

    // Siswa Area
    public function showPengumuman()
    {
        $title = 'Pengumuman';
        $user = Auth::user();

        if ($user->role === 'siswa') {
            $pengumuman = Pengumuman::whereHas('calonSiswa', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
            return view('admin.pages.pengumuman.siswa.index', compact('pengumuman', 'title'));
        } else {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
