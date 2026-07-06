<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Invoice - {{ $dataHeader['no_invoice'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 30px; color: #333; }
        .header { display: flex; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-section { margin-top: 20px; float: right; width: 300px; }
        .total-section table { width: 100%; }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <h2>INVOICE</h2>
            <p><strong>No Invoice:</strong> {{ $dataHeader['no_invoice'] }}</p>
            <p><strong>Tanggal:</strong> {{ $dataHeader['tanggal_invoice'] }}</p>
        </div>
        <div style="text-align: right;">
            <p style="margin-top: 20px;"><strong>Pelanggan:</strong> {{ $dataHeader['nama_pelanggan'] }}</p>
            <p><strong>No Surat Jalan:</strong> {{ $dataHeader['no_surat_jalan'] }}</p>
        </div>
    </div>

    <h3>Rincian Barang</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th class="text-right">QTY</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detailBarang as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk ?? 'Produk Tidak Diketahui' }}</td>
                    <td class="text-right">{{ $item->banyaknya ?? 0 }}</td>
                    <td class="text-right">Rp {{ number_format($item->produk->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format(($item->banyaknya ?? 0) * ($item->produk->harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada detail barang dari surat jalan terkait.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-section">
        <table>
            <tr>
                <td><strong>Total Tagihan:</strong></td>
                <td class="text-right">Rp {{ number_format($dataHeader['total'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Paid (Dibayar):</strong></td>
                <td class="text-right" style="color: green;">Rp {{ number_format($dataHeader['paid'], 0, ',', '.') }}</td>
            </tr>
            <tr style="border-top: 1px dashed #333;">
                <td><strong>Balance Due (Sisa):</strong></td>
                <td class="text-right" style="color: red; font-weight: bold;">Rp {{ number_format($dataHeader['balance_due'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>