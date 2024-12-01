<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    // Fungsi untuk menampilkan daftar kurir
    public function index()
    {
        // Mengambil semua data kurir dari database
        $couriers = Courier::all();
        return view('couriers.index', compact('couriers'));
    }

    // Fungsi untuk menampilkan form pembuatan kurir baru
    public function create()
    {
        return view('couriers.create');
    }

    // Fungsi untuk menyimpan kurir baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Menyimpan data kurir ke dalam tabel couriers
        $courier = new Courier();
        $courier->name = $request->name;
        $courier->save();

        // Redirect ke halaman daftar kurir dengan pesan sukses
        return redirect()->route('couriers.index')->with('success', 'Kurir berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan form edit data kurir
    public function edit($id)
    {
        $courier = Courier::findOrFail($id);
        return view('couriers.edit', compact('courier'));
    }

    // Fungsi untuk memperbarui data kurir
    public function update(Request $request, $id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $courier = Courier::findOrFail($id);
        $courier->name = $request->name;
        $courier->save();

        // Redirect ke halaman daftar kurir dengan pesan sukses
        return redirect()->route('couriers.index')->with('success', 'Kurir berhasil diperbarui');
    }

    // Fungsi untuk menghapus kurir
    public function destroy($id)
    {
        $courier = Courier::findOrFail($id);
        $courier->delete();

        return redirect()->route('couriers.index')->with('success', 'Kurir berhasil dihapus');
    }

    // Fungsi untuk mengarahkan ke halaman konfirmasi
    public function konfirmasiPesan(Request $request)
    {
        // Misalnya, Anda ingin mengambil data pesanan yang belum selesai
        $pesanan = Pesanan::where('user_id', auth()->id())
                          ->where('status', 0)
                          ->first();

        // Cek apakah pesanan ada
        if (!$pesanan) {
            return redirect()->route('home')->with('error', 'Tidak ada pesanan yang dapat dikonfirmasi.');
        }

        // Jika pesanan ada, tampilkan halaman konfirmasi dengan data pesanan
        return view('pesan.konfirmasi', compact('pesanan'));
    }
}
