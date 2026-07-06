<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('no_invoice')->primary();
            $table->date('tanggal_invoice');
            $table->string('no_surat_jalan');
            $table->string('id_pelanggan');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('paid', 12, 2)->default(0);
            $table->decimal('balance_due', 12, 2)->default(0);

            $table->foreign('no_surat_jalan')->references('no_surat_jalan')->on('surat_jalan')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
