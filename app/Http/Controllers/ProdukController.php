<?php 

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Wajib ditambah untuk cek login

class ProdukController extends Controller
{
    // ✅ Tampilkan data (Bisa diakses semua user yang login)
    public function index()
    {
        return Produk::all();
    }

    // ✅ Tambah data (Bisa diakses semua user yang login)
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
            ], 500);
        }
    }

    // ✅ Ubah data
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return $produk;
    }

    // ✅ Hapus data (KHUSUS ADMIN)
    public function destroy($id)
    {
        // Pengecekan Otorisasi
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak! Anda bukan Admin.'
            ], 403); // Error 403 artinya Forbidden (Dilarang)
        }

        Produk::destroy($id);
        return response()->json([
            'message' => 'Data berhasil dihapus oleh Admin'
        ]);
    }
}