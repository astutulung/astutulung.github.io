<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Jurusan';
        return view('admin.pages.jurusan.index', compact('title'));
    }

    public function data(Request $request)
    {
        $query = Jurusan::query();

        return DataTables::of($query)
            ->addColumn('action', function ($jurusan) {
                return '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect edit-record" data-id="' . $jurusan->id . '" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditJurusan" data-url="' . route('jurusan.edit', $jurusan->id) . '"><i class="ri-edit-line ri-20px"></i></a>' .
                       '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-id="' . $jurusan->id . '" data-url="' . route('jurusan.destroy', $jurusan->id) . '"><i class="ri-delete-bin-7-line ri-20px"></i></a>';
            })
            ->make(true);
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return response()->json($jurusan);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->nama = $request->nama;
        $jurusan->tahun_ajaran = $request->tahun_ajaran;
        $jurusan->kuota = $request->kuota;
        $jurusan->save();

        return response()->json([
            'success' => true,
            'message' => 'Jurusan updated successfully!'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $jurusan = new Jurusan();
        $jurusan->nama = $request->nama;
        $jurusan->tahun_ajaran = $request->tahun_ajaran;
        $jurusan->kuota = $request->kuota;
        $jurusan->save();

        return response()->json([
            'success' => true,
            'message' => 'Jurusan created successfully!'
        ]);
    }

    public function destroy($id)
    {
        try {
            $jurusan = Jurusan::findOrFail($id);
            $jurusan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jurusan deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting jurusan!',
            ], 500);
        }
    }
}
