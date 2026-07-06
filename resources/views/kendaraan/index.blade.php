@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Kendaraan</h2>
        <a href="{{ route('kendaraan.create') }}" class="btn">+ Tambah Kendaraan</a>
    </div>

    <form method="GET" action="{{ route('kendaraan.index') }}" class="search-row">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no polisi atau nama kendaraan">
        <button type="submit" class="btn">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No Polisi</th>
                <th>Nama Kendaraan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kendaraan as $item)
                <tr>
                    <td>{{ $item->no_polisi }}</td>
                    <td>{{ $item->nama_kendaraan }}</td>
                    <td>
                        <a href="{{ route('kendaraan.edit', $item->no_polisi) }}" class="btn secondary">Edit</a>
                        <form action="{{ route('kendaraan.destroy', $item->no_polisi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Belum ada data kendaraan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
