@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Tambah Kendaraan</h2>
    <form method="POST" action="{{ route('kendaraan.store') }}">
        @csrf
        <div class="form-group">
            <label>No Polisi</label>
            <input type="text" name="no_polisi" value="{{ old('no_polisi') }}" required>
        </div>
        <div class="form-group">
            <label>Nama Kendaraan</label>
            <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan') }}" required>
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('kendaraan.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
