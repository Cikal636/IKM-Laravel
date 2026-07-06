<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Invoice;
use App\Models\SuratJalan;
use App\Models\Pelanggan;
use App\Models\Produk; 

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = collect();

        if (Schema::hasTable('invoice')) {
            $invoice = Invoice::with([
                'suratJalan',
                'pelanggan'
            ])
            ->orderBy('tanggal_invoice','desc')
            ->get();
        }

        return view('invoice.index', compact('invoice'));
    }

    public function create()
    {
        $terakhir = Invoice::latest('no_invoice')->first();

        if (!$terakhir) {
            $nomorUrut = 1;
        } else {
            $nomorUrut = (int) substr($terakhir->no_invoice, 6) + 1;
        }

        $noInvoiceOtomatis = 'INVCE-' . $nomorUrut;
        $suratJalan = SuratJalan::all(); 

        return view('invoice.create', compact('noInvoiceOtomatis', 'suratJalan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_invoice'      => 'required|unique:invoice,no_invoice',
            'tanggal_invoice' => 'required|date',
            'no_surat_jalan'  => 'required',
            'total'           => 'required|numeric',
            'paid'            => 'required|numeric'
        ]);

        $suratJalan = SuratJalan::where('no_surat_jalan', $request->no_surat_jalan)->firstOrFail();

        $totalInput = $request->total;
        $paidInput  = $request->paid;
        $balanceDue = $totalInput - $paidInput;

        Invoice::create([
            'no_invoice'      => $request->no_invoice,
            'tanggal_invoice' => $request->tanggal_invoice,
            'no_surat_jalan'  => $request->no_surat_jalan,
            'id_pelanggan'    => $suratJalan->id_pelanggan, 
            'subtotal'        => $request->total, 
            'total'           => $totalInput,
            'paid'            => $paidInput,
            'balance_due'     => $balanceDue >= 0 ? $balanceDue : 0
        ]);

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FUNGSI EDIT & UPDATE (FIXED)
    |--------------------------------------------------------------------------
    */
    // Coba ganti fungsi edit kamu sementara menjadi seperti ini:
public function edit($id)
{
    // Cari data berdasarkan Primary Key string (no_invoice) yang sudah diatur di model
    $invoice = Invoice::find($id);

    // MENCEGAH EROR: Jika data tidak ada di DB, langsung tendang balik ke index dengan pesan jelas
    if (!$invoice) {
        return redirect()->route('invoice.index')
            ->with('error', 'Gagal membuka halaman edit! Invoice dengan nomor "' . $id . '" tidak ditemukan di database.');
    }

    $suratJalan = SuratJalan::all();

    // Pastikan variabel 'invoice' dikirim ke view
    return view('invoice.edit', compact('invoice', 'suratJalan'));
}

public function update(Request $request, $id)
{
    $invoice = Invoice::find($id);

    if (!$invoice) {
        return redirect()->route('invoice.index')
            ->with('error', 'Gagal memperbarui! Data Invoice tidak ditemukan.');
    }

    $request->validate([
        'tanggal_invoice' => 'required|date',
        'total'           => 'required|numeric',
        'paid'            => 'required|numeric'
    ]);

    $totalInput = $request->total;
    $paidInput  = $request->paid;
    
    // Hitung balance due (piutang)
    $balanceDue = $totalInput - $paidInput;

    $invoice->update([
        'tanggal_invoice' => $request->tanggal_invoice,
        'total'           => $totalInput,
        'paid'            => $paidInput,
        'balance_due'     => $balanceDue >= 0 ? $balanceDue : 0,
        'subtotal'        => $totalInput // disamakan karena input subtotal sudah dihapus dari form
    ]);

    return redirect()
        ->route('invoice.index')
        ->with('success', 'Invoice berhasil diperbarui');
}
    /*
    |--------------------------------------------------------------------------
    | AJAX GET SURAT JALAN
    |--------------------------------------------------------------------------
    */
    public function getSuratJalan(Request $request)
    {
        try {
            $no = $request->query('no_surat_jalan');

            if (!$no) {
                return response()->json(['error' => 'No Surat Jalan kosong']);
            }

            $suratJalan = SuratJalan::with(['pelanggan', 'detailSuratJalan.produk'])
                ->where('no_surat_jalan', $no)
                ->first();

            if (!$suratJalan) {
                return response()->json(['error' => 'Data Surat Jalan ' . $no . ' tidak ditemukan di database']);
            }

            $barang = [];
            $total = 0;

            foreach ($suratJalan->detailSuratJalan as $detail) {
                $qty = $detail->banyaknya ?? 0;
                $produk = $detail->produk;
                $harga = $produk ? ($produk->harga_satuan ?? 0) : 0;
                $subtotal = $qty * $harga;
                $total += $subtotal;

                $barang[] = [
                    'nama_barang' => $produk ? ($produk->nama_produk ?? 'Produk Tidak Diketahui') : 'Produk Tidak Diketahui',
                    'jumlah'      => $qty,
                    'harga'       => $harga,
                    'subtotal'    => $subtotal
                ];
            }

            return response()->json([
                'id_pelanggan'   => $suratJalan->id_pelanggan,
                'nama_pelanggan' => $suratJalan->pelanggan ? ($suratJalan->pelanggan->nama_pelanggan ?? '-') : '-',
                'total'          => $total,
                'detail_barang'  => $barang
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error_terdeteksi',
                'pesan_error' => $e->getMessage(),
                'file_error' => $e->getFile(),
                'baris_error' => $e->getLine()
            ], 200); 
        }
    }

    public function destroy($id)
{
    // Laravel otomatis mencari ke kolom 'no_invoice' berkat primaryKey di model
    $invoice = Invoice::find($id);

    if (!$invoice) {
        return redirect()->route('invoice.index')
            ->with('error', 'Gagal menghapus! Data Invoice tidak ditemukan.');
    }

    $invoice->delete();

    return redirect()->route('invoice.index')
        ->with('success', 'Invoice berhasil dihapus');
}
public function cetak($id)
    {
        // 1. Ambil data Invoice berdasarkan nomor invoice (Primary Key String)
        // Kita ikut sertakan (eager load) relasi pelanggan dan suratJalan beserta detail barangnya
        $invoice = Invoice::with([
            'pelanggan',
            'suratJalan.detailSuratJalan.produk'
        ])->find($id);

        if (!$invoice) {
            return redirect()->route('invoice.index')
                ->with('error', 'Gagal mencetak! Data Invoice tidak ditemukan.');
        }

        // 2. Ambil data Surat Jalan terkait untuk mempermudah pemanggilan di file Blade cetak
        $suratJalan = $invoice->suratJalan;
        
        // 3. Ambil detail barang bawaan dari Surat Jalan tersebut
        $detailBarang = $suratJalan ? $suratJalan->detailSuratJalan : collect();

        // 4. Buat susunan data header cetak khusus Invoice
        $dataHeader = [
            'no_invoice'       => $invoice->no_invoice,
            'tanggal_invoice'  => $invoice->tanggal_invoice,
            'no_surat_jalan'   => $invoice->no_surat_jalan,
            'nama_pelanggan'   => $invoice->pelanggan->nama_pelanggan ?? '-',
            'total'            => $invoice->total,
            'paid'             => $invoice->paid,
            'balance_due'      => $invoice->balance_due,
        ];

        // 5. Arahkan ke file view cetak khusus invoice (misal: resources/views/invoice/cetak.blade.php)
        return view('invoice.cetak', compact('invoice', 'suratJalan', 'detailBarang', 'dataHeader'));
    }
}