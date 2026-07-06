@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Surat Jalan</h2>
        <a href="{{ route('surat_jalan.create') }}" class="btn">+ Tambah Surat Jalan</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No Surat Jalan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Pegawai</th>
                <th>Pelanggan</th>
                <th>Kendaraan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratJalan as $item)
                <tr>
                    <td>{{ $item->no_surat_jalan }}</td>
                    <td>{{ $item->tanggal_surat_jalan }}</td>
                    <td>{{ $item->status_konfirmasi }}</td>
                    <td>{{ $item->pegawai->nama_pegawai ?? '-' }}</td>
                    <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $item->kendaraan->nama_kendaraan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('detailsuratjalan.index', $item->no_surat_jalan) }}" class="btn">Detail</a>
                        <a href="{{ route('surat_jalan.edit', $item->no_surat_jalan) }}" class="btn secondary">Edit</a>
                        
                        
                        <form action="{{ route('surat_jalan.destroy', $item->no_surat_jalan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align: center;">Belum ada data surat jalan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection