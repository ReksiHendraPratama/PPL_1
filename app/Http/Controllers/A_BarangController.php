<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class A_BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Barang',
            'kategoris' => Kategori::orderBy('kategori', 'ASC')->get(),
        ];
        return view('admin.barang.add', $data);
    }


    public function store(Request $request)
    {
        // Menangkap file -> merubah nama file -> menyimpan file ke folder public/uploads
        $file = $request->file('gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $nama_gambar);
        // Tambah data ke tabel barang
        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_id = $request->kategori_id; // Use the correct field name
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->keterangan = $request->keterangan;
        $barang->gambar = $nama_gambar;
        $barang->save();
    
        // Validasi setelah menyimpan data
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
        ]);
    
        // Sweet alert
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('admin/barang');
    }
    

    public function list()
    {
        $data = [
            'title' => 'List Barang',
            'kategoris' => Kategori::orderBy('kategori', 'ASC')->get(),
        ];

        $barangs = Barang::all();
        return view('admin.barang.list', compact('barangs'), $data);
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Barang',
            'kategoris' => Kategori::orderBy('kategori', 'ASC')->get(),
        ];

        $barangs = Barang::find($id);
        return view('admin.barang.edit', compact('barangs'), $data);
    }


    public function update($id, Request $request)
    {
        //validasi form
        $this->validate($request, [
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:999999',
        ]);

        $barang = Barang::find($id);

        // cek jika ada file yang diupload | Jika tidak akan langsung mengupdate data tanpa mengubah file
        if ($request->hasFile('gambar')) {
            File::delete('uploads/' . $barang->gambar);
            $file = $request->file('gambar');
            $nama_gambar = $barang->gambar;
            $file->move('uploads', $nama_gambar);
        }

        // mengupdate data ke tabel barang
        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->keterangan = $request->keterangan;
        $barang->gambar = $barang->gambar;
        $barang->save();

        // sweet alert
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('admin/barang');
    }


    public function delete($id)
    {
        $barang = Barang::find($id);
        File::delete('uploads/' . $barang->gambar);
        $barang->delete();

        // sweet alert
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('admin/barang')->with('success', 'Data Berhasil Dihapus');
    }
}
