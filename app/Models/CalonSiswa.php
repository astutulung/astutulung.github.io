<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $table = 'calon_siswa';
    
    protected $fillable = [
        'kode_pcs', 'user_id', 'jurusan_id', 'panitia_id', 'nama_siswa', 'asal_sekolah',
        'tempat_lahir', 'tanggal_lahir', 'agama', 'jk', 'tanggal_daftar', 'tahun_ajaran',
        'file_raport', 'no_tlpn', 'email', 'alamat', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public static function generateKodePcs()
    {
        $lastRecord = self::orderBy('id', 'desc')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        return 'PC' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
    }

    public function hasCompletedRegistration()
    {
        return $this->registrasiUlang()->exists();
    }

    public function registrasiUlang()
    {
        return $this->hasOne(Pendaftaran::class, 'calon_siswa_id');
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'calon_siswa_id', 'id');
    }
}
