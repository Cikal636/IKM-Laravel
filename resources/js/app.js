import './bootstrap';
$.ajax({
    url: '/get-surat-jalan',
    type: 'GET',
    data: { no_surat_jalan: noSuratJalanTerpilih },
    success: function(response) {
        // Cek jika ada error dari catch controller
        if (response.status === 'error_terdeteksi' || response.error) {
            alert("Gagal: " + (response.error || response.pesan_error));
            return;
        }

        // 1. Set nama pelanggan ke input otomatis
        $('#nama_pelanggan').val(response.nama_pelanggan);
        $('#total_invoice').val(response.total);

        // 2. Tampilkan daftar produk ke tabel invoice
        var tabelBarang = $('#tabel-detail-invoice tbody');
        tabelBarang.empty(); // bersihkan isi tabel lama

        response.detail_barang.forEach(function(barang) {
            var row = `<tr>
                <td><input type="text" class="form-control" value="${barang.nama_barang}" readonly></td>
                <td><input type="number" class="form-control" value="${barang.jumlah}" readonly></td>
                <td><input type="number" class="form-control" value="${barang.harga}" readonly></td>
                <td><input type="number" class="form-control" value="${barang.subtotal}" readonly></td>
            </tr>`;
            tabelBarang.append(row);
        });
    }
});