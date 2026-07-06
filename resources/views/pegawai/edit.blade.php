@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Pegawai</h2>
    <form method="POST" action="{{ route('pegawai.update', $pegawai->id_pegawai) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', $pegawai->username) }}" required>
        </div>
        <div class="form-group">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password">
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
