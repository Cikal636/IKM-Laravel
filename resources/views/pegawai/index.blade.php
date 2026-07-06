@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Pegawai</h2>
        <a href="{{ route('pegawai.create') }}" class="btn">+ Tambah Pegawai</a>
    </div>

    <form method="GET" action="{{ route('pegawai.index') }}" class="search-row">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari pegawai, username, jabatan">
        <button type="submit" class="btn">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pegawai as $item)
                <tr>
                    <td>{{ $item->id_pegawai }}</td>
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        <a href="{{ route('pegawai.edit', $item->id_pegawai) }}" class="btn secondary">Edit</a>
                        <form action="{{ route('pegawai.destroy', $item->id_pegawai) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada data pegawai.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
