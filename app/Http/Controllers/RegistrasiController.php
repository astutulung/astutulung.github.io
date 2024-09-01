<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class RegistrasiController extends Controller
{
    public function index()
    {
        $title = 'Registrasi';
        return view('admin.pages.registrasi.index', compact('title'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Pendaftaran::with('calonSiswa')->get();

            return DataTables::of($data)
                ->addColumn('nama_siswa', function ($row) {
                    return $row->calonSiswa->nama_siswa ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-icon btn-sm btn-primary view-details" title="Details">
                                <i class="ri-eye-line"></i>
                            </a>';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-icon btn-sm btn-danger delete-record" data-url="' . route('pendaftaran.destroy', $row->id) . '" title="Delete">
                                <i class="ri-delete-bin-line"></i>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::with('calonSiswa')->where('id', $id_pendaftaran)->first();

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($pendaftaran);
    }
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data not found']);
        }

        $pendaftaran->delete();

        return response()->json(['success' => true, 'message' => 'Data has been deleted']);
    }
}
