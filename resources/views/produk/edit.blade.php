@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Produk</h2>
    <form method="POST" action="{{ route('produk.update', $produk->id_produk) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
        </div>
        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" name="harga_satuan" value="{{ old('harga_satuan', $produk->harga_satuan) }}" required>
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan', $produk->satuan) }}" required>
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('produk.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>
@endsection
