@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Surat Jalan</h2>
    <form method="POST" action="{{ route('surat_jalan.update', $suratjalan->no_surat_jalan) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>No Surat Jalan</label>
            <input type="text" value="{{ $suratjalan->no_surat_jalan }}" disabled>
        </div>
        <div class="form-group">
            <label>Tanggal Surat Jalan</label>
            <input type="date" name="tanggal_surat_jalan" value="{{ old('tanggal_surat_jalan', $suratjalan->tanggal_surat_jalan) }}" required>
        </div>
        <div class="form-group">
            <label>Status Konfirmasi</label>
            <select name="status_konfirmasi" required>
                <option value="Pending" {{ $suratjalan->status_konfirmasi == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Diterima" {{ $suratjalan->status_konfirmasi == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Ditolak" {{ $suratjalan->status_konfirmasi == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="form-group">
            <label>Supir</label>
            <select name="id_pegawai" required>
                @foreach($supir as $item)
                    <option value="{{ $item->id_pegawai }}" {{ $suratjalan->id_pegawai == $item->id_pegawai ? 'selected' : '' }}>{{ $item->nama_pegawai }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Pelanggan</label>
            <select name="id_pelanggan" required>
                @foreach($pelanggan as $item)
                    <option value="{{ $item->id_pelanggan }}" {{ $suratjalan->id_pelanggan == $item->id_pelanggan ? 'selected' : '' }}>{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kendaraan</label>
            <select name="no_polisi" required>
                @foreach($kendaraan as $item)
                    <option value="{{ $item->no_polisi }}" {{ $suratjalan->no_polisi == $item->no_polisi ? 'selected' : '' }}>{{ $item->nama_kendaraan }} ({{ $item->no_polisi }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('surat_jalan.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
