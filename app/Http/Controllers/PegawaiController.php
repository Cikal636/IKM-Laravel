<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        if (!session()->has('id_pegawai')) {
            redirect('/login')->send();
        }
    }

    /**
     * Menampilkan daftar pegawai
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {

            $pegawai = Pegawai::where('nama_pegawai', 'like', "%$keyword%")
                ->orWhere('username', 'like', "%$keyword%")
                ->orWhere('jabatan', 'like', "%$keyword%")
                ->orderBy('id_pegawai', 'DESC')
                ->get();

        } else {

            $pegawai = Pegawai::orderBy('id_pegawai', 'DESC')->get();

        }

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Form tambah pegawai
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Simpan data pegawai
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'jabatan'      => 'required',
            'username'     => 'required|unique:pegawai,username',
            'password'     => 'required|min:4'
        ]);

        Pegawai::create([

            'nama_pegawai' => $request->nama_pegawai,
            'jabatan'      => $request->jabatan,
            'username'     => $request->username,

            // Password plaintext
            'password'     => $request->password,

            // Jika database memakai MD5 gunakan ini
            // 'password' => md5($request->password)

        ]);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
   public function edit($id)
{
    $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

    return view('pegawai.edit', compact('pegawai'));
}

    /**
     * Update pegawai
     */
   public function update(Request $request, $id)
{
   $request->validate([
    'nama_pegawai' => 'required',
    'jabatan'      => 'required',
    'username'     => 'required|unique:pegawai,username,' . $id . ',id_pegawai',
    'password'     => 'nullable|min:4'
]);

$pegawai = Pegawai::findOrFail($id);

$pegawai->nama_pegawai = $request->nama_pegawai;
$pegawai->jabatan      = $request->jabatan;
$pegawai->username     = $request->username;

if ($request->filled('password')) {
    $pegawai->password = $request->password;
}

$pegawai->save();

return redirect()->route('pegawai.index')
    ->with('success', 'Data pegawai berhasil diperbarui.');
}

    /**
     * Hapus pegawai
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        $pegawai->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}