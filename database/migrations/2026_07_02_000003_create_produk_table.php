<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('nama_produk');
            $table->decimal('harga_satuan', 12, 2)->default(0);
            $table->string('satuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
