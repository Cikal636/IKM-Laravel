@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Tambah Surat Jalan</h2>
    <form method="POST" action="{{ route('surat_jalan.store') }}">
        @csrf
        <div class="form-group">
    <label>No Surat Jalan</label>
    <input 
        type="text" 
        name="no_surat_jalan" 
        value="{{ old('no_surat_jalan', $noSuratJalanOtomatis) }}" 
        readonly 
        required>
</div>
        <div class="form-group">
            <label>Tanggal Surat Jalan</label>
            <input type="date" name="tanggal_surat_jalan" value="{{ old('tanggal_surat_jalan') }}" required>
        </div>
        <div class="form-group">
            <label>Status Konfirmasi</label>
            <select name="status_konfirmasi" required>
                <option value="Pending">Pending</option>
                <option value="Diterima">Diterima</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>
        <div class="form-group">
            <label>Supir</label>
            <select name="id_pegawai" required>
                <option value="">-- Pilih Supir --</option>
                @foreach($supir as $item)
                    <option value="{{ $item->id_pegawai }}">{{ $item->nama_pegawai }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Pelanggan</label>
            <select name="id_pelanggan" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $item)
                    <option value="{{ $item->id_pelanggan }}">{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kendaraan</label>
            <select name="no_polisi" required>
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($kendaraan as $item)
                    <option value="{{ $item->no_polisi }}">{{ $item->nama_kendaraan }} ({{ $item->no_polisi }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('surat_jalan.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
