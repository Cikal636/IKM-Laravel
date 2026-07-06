@extends('layouts.app')

@section('content')
<div class="grid">
    <div class="stat">
        <small>Total Pegawai</small>
        <strong>{{ $totalPegawai }}</strong>
    </div>
    <div class="stat">
        <small>Total Pelanggan</small>
        <strong>{{ $totalPelanggan }}</strong>
    </div>
    <div class="stat">
        <small>Total Produk</small>
        <strong>{{ $totalProduk }}</strong>
    </div>
    <div class="stat">
        <small>Total Invoice</small>
        <strong>{{ $totalInvoice }}</strong>
    </div>
</div>

<div class="card">
    <h3 style="margin-top:0;">Ringkasan Keuangan</h3>
    <p><strong>Total Penjualan:</strong> Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
    <p><strong>Total Piutang:</strong> Rp {{ number_format($totalPiutang, 0, ',', '.') }}</p>
</div>

<div class="card">
    <h3 style="margin-top:0;">Invoice Terbaru</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Piutang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoiceTerbaru as $invoice)
                <tr>
                    <td>{{ $invoice->no_invoice }}</td>
                    <td>{{ $invoice->nama_pelanggan }}</td>
                    <td>Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($invoice->balance_due, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada invoice.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
