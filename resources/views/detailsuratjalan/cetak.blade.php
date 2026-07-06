<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Jalan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Surat Jalan</h2>
    <p><strong>No Surat Jalan:</strong> {{ $dataHeader['no_surat_jalan'] }}</p>
    <p><strong>Tanggal:</strong> {{ $dataHeader['tanggal_surat_jalan'] }}</p>
    <p><strong>Status:</strong> {{ $dataHeader['status_konfirmasi'] }}</p>
    <p><strong>Supir:</strong> {{ $dataHeader['nama_pegawai'] }}</p>
    <p><strong>Pelanggan:</strong> {{ $dataHeader['nama_pelanggan'] }}</p>
    <p><strong>Kendaraan:</strong> {{ $dataHeader['nama_kendaraan'] }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Banyaknya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->banyaknya }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
