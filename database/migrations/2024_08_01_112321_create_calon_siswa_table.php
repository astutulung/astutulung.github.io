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
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pcs', 255);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->integer('panitia_id');
            $table->string('nama_siswa', 255);
            $table->string('asal_sekolah', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('agama', 255);
            $table->string('jk', 255);
            $table->date('tanggal_daftar');
            $table->string('tahun_ajaran', 255);
            $table->text('file_raport');
            $table->string('no_tlpn', 255);
            $table->string('email', 255);
            $table->string('alamat', 255);
            $table->string('status', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
