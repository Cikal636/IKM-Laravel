@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Kendaraan</h2>
    <form method="POST" action="{{ route('kendaraan.update', $kendaraan->no_polisi) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>No Polisi</label>
            <input type="text" value="{{ $kendaraan->no_polisi }}" disabled>
        </div>
        <div class="form-group">
            <label>Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan', $kendaraan->nama_kendaraan) }}" required>
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('kendaraan.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
