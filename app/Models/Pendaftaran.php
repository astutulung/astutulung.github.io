<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    
    protected $table = 'pendaftaran';
    protected $fillable = [
        'kode_rus', 'calon_siswa_id', 'NIS', 'no_seri_ijazah', 'file_SKHUN', 'nama_ayah',
        'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'alamat_orangtua', 'nama_wali',
        'alamat_wali', 'tinggal_bersama', 'asal_prov', 'asal_kab', 'asal_kec', 'asal_kel',
        'RT', 'RW', 'golongan_darah', 'tanggal_registrasi', 'jml_saudara_kandung'
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }
}
