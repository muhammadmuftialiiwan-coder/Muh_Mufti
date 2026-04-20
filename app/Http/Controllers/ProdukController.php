<?php 

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Tambahkan ini

class ProdukController extends Controller
{
    // ✅ Tampilkan data
    public function index()
    {
        return Produk::all();
    }

    // ✅ Tambah data + validasi + error handling
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable'
        ]);

        try {
            return Produk::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal tambah data'
            ]);
        }
    }

    // ✅ Ubah data
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return $produk;
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        Produk::destroy($id);
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}