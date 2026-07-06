<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    public $timestamps = false;

    protected $fillable = [
        'nama_pegawai',
        'jabatan',
        'username',
        'password'
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
            'id_pegawai',
            'id_pegawai'
        );
    }
}