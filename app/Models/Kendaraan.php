<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $primaryKey = 'no_polisi';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'no_polisi',
        'nama_kendaraan'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function suratJalan()
    {
        return $this->hasMany(
            SuratJalan::class,
            'no_polisi',
            'no_polisi'
        );
    }
}