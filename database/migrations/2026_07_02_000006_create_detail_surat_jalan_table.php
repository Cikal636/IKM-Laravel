<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_surat_jalan', function (Blueprint $table) {
            $table->string('no_surat_jalan');
            $table->string('id_produk');
            $table->integer('banyaknya')->default(1);

            $table->primary(['no_surat_jalan', 'id_produk']);
            $table->foreign('no_surat_jalan')->references('no_surat_jalan')->on('surat_jalan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_surat_jalan');
    }
};
