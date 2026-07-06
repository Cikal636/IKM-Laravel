<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan semua data produk
     */
    public function index()
    {
        $produk = Produk::orderBy('id_produk', 'ASC')->get();

        return view('produk.index', compact('produk'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Simpan produk
     */
   public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required',
        'harga_satuan' => 'required|numeric',
        'satuan' => 'required',
    ]);

    Produk::create([
        // id_produk dilewati karena otomatis diisi INT oleh database
        'nama_produk' => $request->nama_produk,
        'harga_satuan' => $request->harga_satuan,
        'satuan' => $request->satuan,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}
    /**
     * Form edit produk
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('produk.edit', compact('produk'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk'   => 'required',
            'harga_satuan'  => 'required|numeric',
            'satuan'        => 'required'
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk'   => $request->nama_produk,
            'harga_satuan'  => $request->harga_satuan,
            'satuan'        => $request->satuan
        ]);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil diupdate.');
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil dihapus.');
    }
}