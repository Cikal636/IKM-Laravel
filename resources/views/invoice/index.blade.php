@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <h2 style="margin:0;">Daftar Invoice</h2>
        <a href="{{ route('invoice.create') }}" class="btn">+ Tambah Invoice</a>
    </div>

    @if(session('success'))
        <div style="padding:10px; background-color:#d4edda; color:#155724; margin-bottom:15px; border-radius:4px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="padding:10px; background-color:#f8d7da; color:#721c24; margin-bottom:15px; border-radius:4px;">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Tanggal</th>
                <th>No Surat Jalan</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Balance Due</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice as $item)
                <tr>
                    <td>{{ $item->no_invoice }}</td>
                    <td>{{ $item->tanggal_invoice }}</td>
                    <td>{{ $item->no_surat_jalan }}</td>
                    <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->paid, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->balance_due, 0, ',', '.') }}</td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('invoice.cetak', $item->no_invoice) }}" class="btn info" target="_blank" style="background-color: #17a2b8; color: white; text-decoration: none; padding: 5px 10px; border-radius: 4px; font-size: 13px; margin-right: 2px;">Cetak</a>

                        <a href="{{ route('invoice.edit', $item->no_invoice) }}" class="btn secondary">Edit</a>
                        
                        <form action="{{ route('invoice.destroy', $item->no_invoice) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" style="text-align: center;">Belum ada data invoice.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection