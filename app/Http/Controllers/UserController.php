<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
   public function index()
   {
      $title = 'User Manajemen';
      return view('admin.pages.user.index', compact('title'));
   }

   public function data(Request $request)
   {
      $userRole = auth()->user()->role;

      $query = User::query();

      if ($userRole === 'admin') {
         $query->whereIn('role', ['admin', 'panitia']);
      } elseif ($userRole === 'panitia') {
         $query->whereIn('role', ['panitia', 'siswa']);
      }

      if (!empty($request->role)) {
         $query->where('role', $request->role);
      }

      if (!empty($request->gender)) {
         $query->where('jk', $request->gender);
      }

      return DataTables::of($query)
         ->addColumn('action', function ($user) {
            return '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect edit-record" data-id="' . $user->id . '" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditUser" data-url="' . route('user.edit', $user->id) . '"><i class="ri-edit-line ri-20px"></i></a>' .
               '<a href="javascript:void(0);" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-id="' . $user->id . '" data-url="' . route('user.destroy', $user->id) . '"><i class="ri-delete-bin-7-line ri-20px"></i></a>';
         })
         ->make(true);
   }

   public function edit($id)
   {
      $user = User::findOrFail($id);

      return response()->json($user);
   }

   public function update(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'nama' => 'required|string|max:255',
         'jk' => 'required|string|max:255',
         'no_tlpn' => 'required|string|max:20',
         'email' => 'required|email|unique:users,email,' . $id,
         'password' => 'nullable|string|min:8',
         'role' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'errors' => $validator->errors()->all()
         ], 422);
      }
      $user = User::findOrFail($id);
      $user->nama = $request->nama;
      $user->jk = $request->jk;
      $user->no_tlpn = $request->no_tlpn;
      $user->email = $request->email;
      if ($request->filled('password')) {
         $user->password = Hash::make($request->password);
      }
      $user->role = $request->role;
      $user->save();

      return response()->json([
         'success' => true,
         'message' => 'User updated successfully!'
      ]);
   }

   public function store(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'nama' => 'required|string|max:255',
         'jk' => 'required|string|max:255',
         'no_tlpn' => 'required|string|max:20',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|string|min:8',
         'role' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'errors' => $validator->errors()->all()
         ], 422);
      }

      $user = new User();
      $user->nama = $request->nama;
      $user->jk = $request->jk;
      $user->no_tlpn = $request->no_tlpn;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->role = $request->role;
      $user->save();

      return response()->json([
         'success' => true,
         'message' => 'User created successfully!'
      ]);
   }

   public function destroy($id)
   {
      try {
         $user = User::findOrFail($id);
         $user->delete();

         return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!',
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Error deleting user!',
         ], 500);
      }
   }
}
