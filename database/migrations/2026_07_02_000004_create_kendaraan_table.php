<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->string('no_polisi')->primary();
            $table->string('nama_kendaraan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
