@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Tambah Pegawai</h2>
    <form method="POST" action="{{ route('pegawai.store') }}">
        @csrf
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('pegawai.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
