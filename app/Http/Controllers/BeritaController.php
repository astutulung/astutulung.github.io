<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Berita';
        return view('admin.pages.berita.index', compact('title'));
    }

    public function data(Request $request)
    {
        $query = Berita::query();

        return DataTables::of($query)
            ->addColumn('action', function ($berita) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect edit-record" data-id="' . $berita->id . '" data-bs-toggle="modal" data-bs-target="#modalEditBerita" data-url="' . route('berita.edit', $berita->id) . '"><i class="ri-edit-line ri-20px"></i></a>' .
                    '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-id="' . $berita->id . '" data-url="' . route('berita.destroy', $berita->id) . '"><i class="ri-delete-bin-7-line ri-20px"></i></a>';
            })
            ->editColumn('foto', function ($berita) {
                return '<img src="' . asset('storage/' . $berita->foto) . '" width="50">';
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->isi = $request->isi;
        if ($request->hasFile('foto')) {
            $berita->foto = $request->file('foto')->store('berita', 'public');
        }
        $berita->save();

        return response()->json([
            'success' => true,
            'message' => 'Berita created successfully!'
        ]);
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return response()->json($berita);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->isi = $request->isi;
        if ($request->hasFile('foto')) {
            $berita->foto = $request->file('foto')->store('berita', 'public');
        }
        $berita->save();

        return response()->json([
            'success' => true,
            'message' => 'Berita updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting berita!',
            ], 500);
        }
    }
}
