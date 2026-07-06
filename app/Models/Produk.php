<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'harga_satuan',
        'satuan'
    ];

    public function detailSuratJalan()
{
    return $this->hasMany(
        DetailSuratJalan::class,
        'id_produk',
        'id_produk'
    );
}
}