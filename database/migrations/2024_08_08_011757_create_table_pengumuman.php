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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengumuman', 255);
            $table->unsignedBigInteger('calon_siswa_id');
            $table->string('judul_pengumuman', 255);
            $table->string('deskripsi', 255);
            $table->string('status', 255);
            $table->timestamps();
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pengumuman');
    }
};
