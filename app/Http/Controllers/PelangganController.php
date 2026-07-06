<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Tampilkan semua data pelanggan + search
     */
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        // Live search (nama pelanggan)
        if ($request->filled('search')) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->orderBy('id_pelanggan', 'ASC')->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Form tambah pelanggan
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Simpan data pelanggan baru
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'alamat' => 'required',
    ]);

    Pelanggan::create([
        // id_pelanggan tidak perlu ditulis di sini
        'nama_pelanggan' => $request->nama_pelanggan,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambah!');
}

    /**
     * Form edit pelanggan
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->firstOrFail();

        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update data pelanggan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
        ]);

        $pelanggan = Pelanggan::where('id_pelanggan', $id)->firstOrFail();

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat'         => $request->alamat,
        ]);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diupdate');
    }

    /**
     * Hapus data pelanggan
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->firstOrFail();
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus');
    }
}