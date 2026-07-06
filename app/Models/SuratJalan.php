<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    protected $table = 'surat_jalan';

    protected $primaryKey = 'no_surat_jalan';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'no_surat_jalan',
        'tanggal_surat_jalan',
        'status_konfirmasi',
        'id_pegawai',
        'id_pelanggan',
        'no_polisi',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE PEGAWAI
    |--------------------------------------------------------------------------
    */

    public function pegawai()
    {
        return $this->belongsTo(
            Pegawai::class,
            'id_pegawai',
            'id_pegawai'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE PELANGGAN
    |--------------------------------------------------------------------------
    */

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE KENDARAAN
    |--------------------------------------------------------------------------
    */

    public function kendaraan()
    {
        return $this->belongsTo(
            Kendaraan::class,
            'no_polisi',
            'no_polisi'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE DETAIL SURAT JALAN
    |--------------------------------------------------------------------------
    */

    public function detailSuratJalan()
    {
        return $this->hasMany(
            DetailSuratJalan::class,
            'no_surat_jalan',
            'no_surat_jalan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE INVOICE
    |--------------------------------------------------------------------------
    */

   public function invoice()
    {
        return $this->hasMany(
            Invoice::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }
}