<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI agar VS Code tidak menganggap DB error

class SuratJalanController extends Controller
{
    public function index()
    {
        $suratJalan = SuratJalan::with([
            'pegawai',
            'pelanggan',
            'kendaraan'
        ])
        ->orderBy('tanggal_surat_jalan', 'asc')
        ->get();

        return view('suratjalan.index', compact('suratJalan'));
    }

    public function create()
    {
        // 1. LOGIKA GENERATE ID OTOMATIS (SJ-1, SJ-2, dst)
        $terakhir = SuratJalan::latest('no_surat_jalan')->first();

        if (!$terakhir) {
            $nomorUrut = 1;
        } else {
            // Mengambil angka setelah teks 'SJ-' (misal dari SJ-12 diambil angka 12)
            $nomorUrut = (int) substr($terakhir->no_surat_jalan, 3) + 1;
        }

        $noSuratJalanOtomatis = 'SJ-' . $nomorUrut;

        // 2. AMBIL DATA DROPDOWN
        $supir = Pegawai::where('jabatan', 'Supir')->get();
        $pelanggan = Pelanggan::all();
        $kendaraan = Kendaraan::all();

        // 3. KIRIM VARIABEL KE VIEW
        return view('suratjalan.create', compact(
            'noSuratJalanOtomatis',
            'supir',
            'pelanggan',
            'kendaraan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat_jalan'      => 'required|unique:surat_jalan,no_surat_jalan',
            'tanggal_surat_jalan' => 'required|date',
            'status_konfirmasi'   => 'required',
            'id_pegawai'          => 'required',
            'id_pelanggan'        => 'required',
            'no_polisi'           => 'required',
        ]);

        SuratJalan::create($request->all());

        return redirect()
            ->route('surat_jalan.index')
            ->with('success', 'Data surat jalan berhasil ditambahkan.');
    }

    public function show($no_surat_jalan)
    {
        $suratJalan = SuratJalan::with([
            'pegawai',
            'pelanggan',
            'kendaraan'
        ])->where('no_surat_jalan', $no_surat_jalan)->firstOrFail();

        return view('suratjalan.show', compact('suratJalan'));
    }

    public function edit($no_surat_jalan)
    {
        $suratjalan = SuratJalan::where('no_surat_jalan', $no_surat_jalan)->firstOrFail();

        $supir = Pegawai::where('jabatan', 'Supir')->get();
        $pelanggan = Pelanggan::all();
        $kendaraan = Kendaraan::all();

        return view('suratjalan.edit', compact(
            'suratjalan',
            'supir',
            'pelanggan',
            'kendaraan'
        ));
    }

    public function update(Request $request, $no_surat_jalan)
    {
        $request->validate([
            'tanggal_surat_jalan' => 'required|date',
            'status_konfirmasi'   => 'required|in:Pending,Ditolak,Diterima',
            'id_pegawai'          => 'required',
            'id_pelanggan'        => 'required',
            'no_polisi'           => 'required',
        ]);

        $suratjalan = SuratJalan::where('no_surat_jalan', $no_surat_jalan)->firstOrFail();
        $suratjalan->update($request->all());

        return redirect()
            ->route('surat_jalan.index')
            ->with('success','Data surat jalan berhasil diupdate.');
    }

    public function destroy($no_surat_jalan)
    {
        $suratJalan = SuratJalan::where('no_surat_jalan', $no_surat_jalan)->firstOrFail();
        
        // Menggunakan DB:: setelah di-import di atas (menghapus backslash '\')
        DB::table('detail_surat_jalan')->where('no_surat_jalan', $no_surat_jalan)->delete();

        $suratJalan->delete();

        return redirect()
            ->route('surat_jalan.index')
            ->with('success', 'Data surat jalan berhasil dihapus.');
    }
}