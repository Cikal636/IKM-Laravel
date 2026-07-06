@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Pelanggan</h2>
    <form method="POST" action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('pelanggan.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
