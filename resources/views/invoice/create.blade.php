@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Tambah Invoice</h2>
    <form method="POST" action="{{ route('invoice.store') }}">
        @csrf
        
        <div class="form-group">
            <label>No Invoice</label>
            <input 
                type="text" 
                name="no_invoice" 
                value="{{ old('no_invoice', $noInvoiceOtomatis) }}" 
                readonly 
                required>
        </div>

        <div class="form-group">
            <label>Tanggal Invoice</label>
            <input type="date" name="tanggal_invoice" value="{{ old('tanggal_invoice', date('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label>No Surat Jalan</label>
            <select name="no_surat_jalan" id="no_surat_jalan" required>
                <option value="">-- Pilih Surat Jalan --</option>
                @foreach($suratJalan as $item)
                    <option value="{{ $item->no_surat_jalan }}" {{ old('no_surat_jalan') == $item->no_surat_jalan ? 'selected' : '' }}>
                        {{ $item->no_surat_jalan }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{ old('id_pelanggan') }}">

        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="{{ old('nama_pelanggan', '-') }}" readonly>
        </div>

        <div class="form-group">
            <label>Rincian Barang dari Surat Jalan</label>
            <table class="table-detail" style="width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 25px;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                        <th style="padding: 10px; text-align: left;">Nama Barang</th>
                        <th style="padding: 10px; text-align: left;">Jumlah (Qty)</th>
                        <th style="padding: 10px; text-align: left;">Harga Satuan</th>
                        <th style="padding: 10px; text-align: left;">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="tabel_barang_body">
                    <tr>
                        <td colspan="4" style="text-align: center; color: #999; padding: 15px;">Belum ada surat jalan yang dipilih</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <label>Total</label>
            <input type="number" name="total" id="total" value="{{ old('total', 0) }}" readonly required>
        </div>

        <div class="form-group">
            <label>Paid</label>
            <input type="number" name="paid" id="paid" value="{{ old('paid', 0) }}" min="0" required>
        </div>

        <div class="form-group">
            <label>Balance Due</label>
            <input type="number" name="balance_due" id="balance_due" value="{{ old('balance_due', 0) }}" readonly required>
        </div>

        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('invoice.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>

<script>
const tabelBody = document.getElementById('tabel_barang_body');

document.getElementById('no_surat_jalan').addEventListener('change', function() {
    const noSuratJalan = this.value;

    if (noSuratJalan !== '') {
        tabelBody.innerHTML = `<tr><td colspan="4" style="text-align: center; padding: 15px;">Memuat rincian produk...</td></tr>`;

        fetch("{{ route('invoice.get_surat_jalan') }}?no_surat_jalan=" + encodeURIComponent(noSuratJalan))
            .then(response => response.json())
            .then(data => {
                tabelBody.innerHTML = ''; 
                
                if (!data.detail_barang || data.detail_barang.length === 0) {
                    tabelBody.innerHTML = `<tr><td colspan="4" style="text-align: center; color: red; padding: 15px;">Surat jalan ini tidak memiliki detail barang!</td></tr>`;
                    resetForm();
                } else {
                    document.getElementById('total').value = data.total || 0;
                    
                    // Set ID Pelanggan ke input hidden
                    document.getElementById('id_pelanggan').value = data.id_pelanggan || '';

                    if (document.getElementById('nama_pelanggan')) {
                        document.getElementById('nama_pelanggan').value = data.nama_pelanggan || '-';
                    }

                    // Gambar isi data tabel sekaligus sisipkan INPUT HIDDEN ARRAY agar terbaca oleh request POST Laravel
                    data.detail_barang.forEach(item => {
                        let row = `<tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">
                                ${item.nama_barang}
                                <input type="hidden" name="nama_barang[]" value="${item.nama_barang}">
                            </td>
                            <td style="padding: 10px;">
                                ${item.jumlah}
                                <input type="hidden" name="jumlah[]" value="${item.jumlah}">
                            </td>
                            <td style="padding: 10px;">
                                Rp ${parseInt(item.harga).toLocaleString('id-ID')}
                                <input type="hidden" name="harga[]" value="${item.harga}">
                            </td>
                            <td style="padding: 10px;">
                                Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}
                                <input type="hidden" name="subtotal[]" value="${item.subtotal}">
                            </td>
                        </tr>`;
                        tabelBody.innerHTML += row;
                    });

                    hitungSisaTagihan();
                }
            })
            .catch(err => {
                console.error("Gagal memuat AJAX:", err);
                tabelBody.innerHTML = `<tr><td colspan="4" style="text-align: center; color: red; padding: 15px;">Gagal memuat rincian barang. Periksa route/routing Anda.</td></tr>`;
                resetForm();
            });
    } else {
        resetForm();
    }
});

document.getElementById('paid').addEventListener('input', hitungSisaTagihan);

function hitungSisaTagihan() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const paid = parseFloat(document.getElementById('paid').value) || 0;
    const sisa = total - paid;
    
    document.getElementById('balance_due').value = sisa >= 0 ? sisa : 0;
}

function resetForm() {
    document.getElementById('total').value = 0;
    document.getElementById('paid').value = 0;
    document.getElementById('balance_due').value = 0;
    document.getElementById('id_pelanggan').value = '';
    if (document.getElementById('nama_pelanggan')) {
        document.getElementById('nama_pelanggan').value = '-';
    }
    tabelBody.innerHTML = `<tr><td colspan="4" style="text-align: center; color: #999; padding: 15px;">Belum ada surat jalan yang dipilih</td></tr>`;
}
</script>
@endsection