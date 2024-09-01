<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rus', 255);
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa')->onDelete('cascade');
            $table->string('NIS', 255);
            $table->integer('no_seri_ijazah');
            $table->text('file_SKHUN');
            $table->string('nama_ayah', 255);
            $table->string('pekerjaan_ayah', 255);
            $table->string('nama_ibu', 255);
            $table->string('pekerjaan_ibu', 255);
            $table->string('alamat_orangtua', 255);
            $table->string('nama_wali', 255);
            $table->string('alamat_wali', 255);
            $table->string('tinggal_bersama', 255);
            $table->string('asal_prov', 255);
            $table->string('asal_kab', 255);
            $table->string('asal_kec', 255);
            $table->string('asal_kel', 255);
            $table->integer('RT');
            $table->integer('RW');
            $table->string('golongan_darah', 255);
            $table->date('tanggal_registrasi');
            $table->integer('jml_saudara_kandung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
