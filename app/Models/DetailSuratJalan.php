<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSuratJalan extends Model
{
    protected $table = 'detail_surat_jalan';

    // Tidak ada id auto increment

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'no_surat_jalan',
        'id_produk',
        'banyaknya'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE SURAT JALAN
    |--------------------------------------------------------------------------
    */

    public function suratJalan()
    {
        return $this->belongsTo(
            SuratJalan::class,
            'no_surat_jalan',
            'no_surat_jalan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE PRODUK
    |--------------------------------------------------------------------------
    */

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'id_produk',
            'id_produk'
        );
    }
}