<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek Login
        if (!session()->has('id_pegawai')) {
            return redirect('/login');
        }

        // Statistik
        $totalPegawai = Pegawai::count();
        $totalPelanggan = Pelanggan::count();
        $totalProduk = Produk::count();
        $totalInvoice = Invoice::count();

        // Keuangan
        $totalPenjualan = Invoice::sum('total');
        $totalPiutang = Invoice::sum('balance_due');

        // Grafik
        $grafik = Invoice::selectRaw("
                DATE(tanggal_invoice) as tanggal,
                SUM(total) as total_harian
            ")
            ->groupByRaw("DATE(tanggal_invoice)")
            ->orderByRaw("DATE(tanggal_invoice)")
            ->get();

        $labels = [];
        $dataGrafik = [];

        foreach ($grafik as $g) {
            $labels[] = date('d/m/Y', strtotime($g->tanggal));
            $dataGrafik[] = $g->total_harian;
        }

        // Invoice Terbaru
        $invoiceTerbaru = Invoice::join(
                'pelanggan',
                'invoice.id_pelanggan',
                '=',
                'pelanggan.id_pelanggan'
            )
            ->select(
                'invoice.no_invoice',
                'pelanggan.nama_pelanggan',
                'invoice.total',
                'invoice.balance_due'
            )
            ->orderBy('invoice.tanggal_invoice', 'DESC')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPegawai',
            'totalPelanggan',
            'totalProduk',
            'totalInvoice',
            'totalPenjualan',
            'totalPiutang',
            'labels',
            'dataGrafik',
            'invoiceTerbaru'
        ));
    }
}