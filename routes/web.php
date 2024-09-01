<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RegistrasiUlangController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;









Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('about', [AboutController::class, 'index'])->name('about');
Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('course', [CourseController::class, 'index'])->name('course');
Route::get('teacher', [TeacherController::class, 'index'])->name('teacher');
Route::get('user', [UserController::class, 'index'])->name('user');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/data', [JurusanController::class, 'data'])->name('jurusan.data');
    Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/data', [BeritaController::class, 'data'])->name('berita.data');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::get('/pendaftaran', [CalonSiswaController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [CalonSiswaController::class, 'store'])->name('pendaftaran.store');
    Route::get('/calonsiswa', [CalonSiswaController::class, 'listCalonSiswa'])->name('calonsiswa.index');
    Route::get('/calon-siswa/data', [CalonSiswaController::class, 'getData'])->name('calon_siswa.data');
    Route::post('/calon_siswa/update_status', [CalonSiswaController::class, 'updateStatus'])->name('calon_siswa.update_status');
    Route::get('/calon_siswa/{id}', [CalonSiswaController::class, 'show'])->name('calon_siswa.show');
    Route::delete('/calon_siswa/{id}', [CalonSiswaController::class, 'destroy'])->name('calon_siswa.destroy');
    Route::get('/registrasi-ulang', [RegistrasiUlangController::class, 'index'])->name('registrasiulang');
    Route::post('/registrasi-ulang', [RegistrasiUlangController::class, 'store'])->name('registrasiulang.store');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/pengumuman/store', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('pengumuman/data', [PengumumanController::class, 'data'])->name('pengumuman.data');
    Route::post('pengumuman/update-status', [PengumumanController::class, 'updateStatus'])->name('pengumuman.update_status');
    Route::get('/siswa/search', [PengumumanController::class, 'searchSiswa'])->name('siswa.search');
    Route::get('/pengumumansiswa', [PengumumanController::class, 'showPengumuman'])->name('pengumumansiswa.show');
    Route::get('/data-registrasi', [RegistrasiController::class, 'index'])->name('data_registrasi.index');
    Route::get('/pendaftaran/data', [RegistrasiController::class, 'getData'])->name('pendaftaran.data');
    Route::delete('/pendaftaran/{id}', [RegistrasiController::class, 'destroy'])->name('pendaftaran.destroy');
    Route::get('/pendaftaran/{id_pendaftaran}/details', [RegistrasiController::class, 'show'])->name('pendaftaran.show');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});
