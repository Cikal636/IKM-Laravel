@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn">+ Tambah Produk</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $item)
                <tr>
                    <td>{{ $item->id_produk }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id_produk) }}" class="btn secondary">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada data produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
