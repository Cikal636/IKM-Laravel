@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Laporan</h2>
    <p>Halaman laporan siap digunakan untuk menampilkan ringkasan penjualan, piutang, dan data operasional.</p>
    <a href="{{ url('/dashboard') }}" class="btn">Kembali ke Dashboard</a>
</div>
@endsection
