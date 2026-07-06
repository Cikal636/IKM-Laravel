@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Pelanggan</h2>
        <a href="{{ route('pelanggan.create') }}" class="btn">+ Tambah Pelanggan</a>
    </div>

    <form method="GET" action="{{ route('pelanggan.index') }}" class="search-row">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan">
        <button type="submit" class="btn">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggan as $item)
                <tr>
                    <td>{{ $item->id_pelanggan }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $item->id_pelanggan) }}" class="btn secondary">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $item->id_pelanggan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada data pelanggan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
