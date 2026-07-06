@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Detail Surat Jalan</h2>
    <p><strong>No Surat Jalan:</strong> {{ $suratJalan->no_surat_jalan }}</p>
    <p><strong>Tanggal:</strong> {{ $suratJalan->tanggal_surat_jalan }}</p>
    <p><strong>Status:</strong> {{ $suratJalan->status_konfirmasi }}</p>
    <p><strong>Supir:</strong> {{ $suratJalan->pegawai->nama_pegawai ?? '-' }}</p>
    <p><strong>Pelanggan:</strong> {{ $suratJalan->pelanggan->nama_pelanggan ?? '-' }}</p>
    <p><strong>Kendaraan:</strong> {{ $suratJalan->kendaraan->nama_kendaraan ?? '-' }}</p>
    <a href="{{ route('surat_jalan.index') }}" class="btn secondary">Kembali</a>
</div>
@endsection
