<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Menampilkan daftar kendaraan
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $kendaraan = Kendaraan::where('no_polisi', 'like', '%' . $search . '%')
                ->orWhere('nama_kendaraan', 'like', '%' . $search . '%')
                ->orderBy('no_polisi', 'ASC')
                ->get();
        } else {
            $kendaraan = Kendaraan::orderBy('no_polisi', 'ASC')->get();
        }

        return view('kendaraan.index', compact('kendaraan'));
    }

    /**
     * Menampilkan form tambah kendaraan
     */
    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * Menyimpan data kendaraan
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_polisi' => 'required|unique:kendaraan,no_polisi',
            'nama_kendaraan' => 'required',
        ], [
            'no_polisi.required' => 'No Polisi wajib diisi.',
            'no_polisi.unique' => 'No Polisi sudah terdaftar.',
            'nama_kendaraan.required' => 'Nama Kendaraan wajib diisi.',
        ]);

        Kendaraan::create([
            'no_polisi' => $request->no_polisi,
            'nama_kendaraan' => $request->nama_kendaraan,
        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kendaraan
     */
    public function edit($id)
    {
        $kendaraan = Kendaraan::where('no_polisi', $id)->firstOrFail();

        return view('kendaraan.edit', compact('kendaraan'));
    }

    /**
     * Update data kendaraan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
        ], [
            'nama_kendaraan.required' => 'Nama Kendaraan wajib diisi.',
        ]);

        $kendaraan = Kendaraan::where('no_polisi', $id)->firstOrFail();

        $kendaraan->update([
            'nama_kendaraan' => $request->nama_kendaraan,
        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Menghapus data kendaraan
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('no_polisi', $id)->firstOrFail();

        $kendaraan->delete();

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}