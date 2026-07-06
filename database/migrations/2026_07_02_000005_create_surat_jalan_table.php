<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->string('no_surat_jalan')->primary();
            $table->date('tanggal_surat_jalan');
            $table->string('status_konfirmasi');
            $table->string('id_pegawai');
            $table->string('id_pelanggan');
            $table->string('no_polisi');

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_jalan');
    }
};
