<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('id_pegawai')->primary();
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->string('username')->unique();
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
