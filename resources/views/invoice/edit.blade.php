@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Edit Invoice</h2>
    <form method="POST" action="{{ route('invoice.update', $invoice->id ?? $invoice->no_invoice) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>No Invoice</label>
            <input type="text" value="{{ $invoice->no_invoice }}" disabled>
        </div>

        <div class="form-group">
            <label>Tanggal Invoice</label>
            <input type="date" name="tanggal_invoice" value="{{ old('tanggal_invoice', $invoice->tanggal_invoice) }}" required>
        </div>

        <div class="form-group">
            <label>No Surat Jalan</label>
            <select name="no_surat_jalan" id="no_surat_jalan" required>
                @foreach($suratJalan as $item)
                    <option value="{{ $item->no_surat_jalan }}" {{ $invoice->no_surat_jalan == $item->no_surat_jalan ? 'selected' : '' }}>
                        {{ $item->no_surat_jalan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kolom Subtotal Dihapus --}}

        <div class="form-group">
            <label>Total (Rp)</label>
            <input type="number" name="total" id="total" value="{{ old('total', $invoice->total) }}" readonly class="form-control-readonly">
        </div>

        <div class="form-group">
            <label>Paid / Dibayar (Rp)</label>
            <input type="number" name="paid" id="paid" value="{{ old('paid', $invoice->paid) }}" required>
        </div>

        <div class="form-group">
            <label>Balance Due / Piutang (Rp)</label>
            <input type="number" name="balance_due" id="balance_due" value="{{ old('balance_due', $invoice->balance_due) }}" readonly class="form-control-readonly">
        </div>

        <button type="submit" class="btn">Update</button>
        <a href="{{ route('invoice.index') }}" class="btn secondary">Kembali</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputTotal = document.getElementById('total');
        const inputPaid = document.getElementById('paid');
        const inputBalanceDue = document.getElementById('balance_due');

        function hitungSisaPiutang() {
            const total = parseFloat(inputTotal.value) || 0;
            const paid = parseFloat(inputPaid.value) || 0;
            
            // Hitung selisihnya
            let sisa = total - paid;
            
            // Mencegah hasil minus jika user salah ketik paid lebih besar dari total
            if (sisa < 0) sisa = 0; 
            
            inputBalanceDue.value = sisa;
        }

        // Jalankan fungsi setiap kali user mengetik sesuatu di kolom paid
        inputPaid.addEventListener('input', hitungSisaPiutang);
    });
</script>

<style>
    /* Styling opsional untuk menandakan inputan tersebut terkunci */
    .form-control-readonly {
        background-color: #f4f4f4;
        cursor: not-allowed;
        color: #555;
    }
</style>
@endsection