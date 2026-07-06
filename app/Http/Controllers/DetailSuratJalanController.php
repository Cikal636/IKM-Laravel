<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratJalan;
use App\Models\DetailSuratJalan;
use App\Models\Produk;

class DetailSuratJalanController extends Controller
{
    public function index($id)
    {
        $suratJalan = SuratJalan::with([
            'pegawai',
            'pelanggan',
            'kendaraan'
        ])->findOrFail($id);

        $detail = DetailSuratJalan::with('produk')
            ->where('no_surat_jalan', $id)
            ->get();

        $list_produk = Produk::all();

        // 🔥 INI PENTING: samakan dengan blade kamu
        $dataHeader = [
            'no_surat_jalan'     => $suratJalan->no_surat_jalan,
            'tanggal_surat_jalan'=> $suratJalan->tanggal_surat_jalan,
            'status_konfirmasi'  => $suratJalan->status_konfirmasi,
            'nama_pegawai'       => $suratJalan->pegawai->nama_pegawai ?? '-',
            'nama_pelanggan'     => $suratJalan->pelanggan->nama_pelanggan ?? '-',
            'no_polisi'          => $suratJalan->kendaraan->no_polisi ?? '-',
            'nama_kendaraan'     => $suratJalan->kendaraan->nama_kendaraan ?? '-',
        ];

        return view('detailsuratjalan.index', compact(
            'dataHeader',
            'detail',
            'list_produk',
            'suratJalan'
        ));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'id_produk' => 'required',
            'banyaknya' => 'required|integer|min:1'
        ]);

        $cek = DetailSuratJalan::where('no_surat_jalan', $id)
            ->where('id_produk', $request->id_produk)
            ->first();

        if ($cek) {
            $cek->banyaknya += $request->banyaknya;
            $cek->save();
        } else {
            DetailSuratJalan::create([
                'no_surat_jalan' => $id,
                'id_produk'      => $request->id_produk,
                'banyaknya'      => $request->banyaknya
            ]);
        }

        return redirect()
            ->route('detailsuratjalan.index', $id)
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id, $produk)
    {
        $request->validate([
            'id_produk' => 'required',
            'banyaknya' => 'required|integer|min:1'
        ]);

        $detail = DetailSuratJalan::where('no_surat_jalan', $id)
            ->where('id_produk', $produk)
            ->firstOrFail();

        $detail->update([
            'id_produk' => $request->id_produk,
            'banyaknya' => $request->banyaknya
        ]);

        return redirect()
            ->route('detailsuratjalan.index', $id)
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id, $produk)
    {
        DetailSuratJalan::where('no_surat_jalan', $id)
            ->where('id_produk', $produk)
            ->delete();

        return redirect()
            ->route('detailsuratjalan.index', $id)
            ->with('success', 'Produk berhasil dihapus');
    }

    public function cetak($id)
    {
        $suratJalan = SuratJalan::with([
            'pegawai',
            'pelanggan',
            'kendaraan'
        ])->findOrFail($id);

        $detail = DetailSuratJalan::with('produk')
            ->where('no_surat_jalan', $id)
            ->get();

        $dataHeader = [
            'no_surat_jalan'     => $suratJalan->no_surat_jalan,
            'tanggal_surat_jalan'=> $suratJalan->tanggal_surat_jalan,
            'status_konfirmasi'  => $suratJalan->status_konfirmasi,
            'nama_pegawai'       => $suratJalan->pegawai->nama_pegawai ?? '-',
            'nama_pelanggan'     => $suratJalan->pelanggan->nama_pelanggan ?? '-',
            'no_polisi'          => $suratJalan->kendaraan->no_polisi ?? '-',
            'nama_kendaraan'     => $suratJalan->kendaraan->nama_kendaraan ?? '-',
        ];

        return view('detailsuratjalan.cetak', compact(
            'suratJalan',
            'detail',
            'dataHeader'
        ));
    }
}