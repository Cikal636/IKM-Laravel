@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Detail Surat Jalan</h2>
    <p><strong>No Surat Jalan:</strong> {{ $dataHeader['no_surat_jalan'] }}</p>
    <p><strong>Tanggal:</strong> {{ $dataHeader['tanggal_surat_jalan'] }}</p>
    <p><strong>Status:</strong> {{ $dataHeader['status_konfirmasi'] }}</p>
    <p><strong>Supir:</strong> {{ $dataHeader['nama_pegawai'] }}</p>
    <p><strong>Pelanggan:</strong> {{ $dataHeader['nama_pelanggan'] }}</p>
    <p><strong>Kendaraan:</strong> {{ $dataHeader['nama_kendaraan'] }}</p>

    <form method="POST" action="{{ route('detailsuratjalan.store', $suratJalan->no_surat_jalan) }}" class="search-row" style="margin-top: 16px;">
        @csrf
        <select name="id_produk" required>
            <option value="">-- Pilih Produk --</option>
            @foreach($list_produk as $produk)
                <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
            @endforeach
        </select>
        <input type="number" name="banyaknya" value="1" min="1" required>
        <button type="submit" class="btn">Tambah</button>
    </form>

    <table class="table" style="margin-top: 12px;">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Banyaknya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detail as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->banyaknya }}</td>
                    <td>
                        <form action="{{ route('detailsuratjalan.destroy', [$suratJalan->no_surat_jalan, $item->id_produk]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('surat_jalan.index') }}" class="btn secondary">Kembali</a>
    <a href="{{ route('detailsuratjalan.cetak', $suratJalan->no_surat_jalan) }}" class="btn">Cetak</a>
</div>
@endsection
