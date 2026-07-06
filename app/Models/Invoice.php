<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $primaryKey = 'no_invoice';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'no_invoice',
        'tanggal_invoice',
        'no_surat_jalan',
        'id_pelanggan',
        'subtotal',
        'total',
        'paid',
        'balance_due'
    ];

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class, 'no_surat_jalan', 'no_surat_jalan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
