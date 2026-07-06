<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// HAPUS BARIS USE APP\MODELS\... DI SINI KARENA SUDAH SATU FOLDER/NAMESPACE

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'alamat',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE SURAT JALAN
    |--------------------------------------------------------------------------
    */

    public function suratJalan()
    {
        return $this->hasMany(
            SuratJalan::class,
            'id_pelanggan',
            'id_pelanggan'
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