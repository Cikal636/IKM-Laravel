@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Tambah Produk</h2>
    <form method="POST" action="{{ route('produk.store') }}">
        @csrf
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required>
        </div>
        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" name="harga_satuan" value="{{ old('harga_satuan') }}" required>
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan') }}" required placeholder="Contoh: KG, PCS, PACK">
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
