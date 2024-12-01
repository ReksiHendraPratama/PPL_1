<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class A_KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori'
        ];
        return view('admin.kategori.add', $data);
    }

 
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'kategori' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // menangkap file -> merubah nama file -> menyimpan file ke folder public/uploads
        $file = $request->file('gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $nama_gambar);

        //tambah data ke tabel kategori
        $kategori = new Kategori();
        $kategori->kategori = $request->kategori;
        $kategori->gambar = $nama_gambar;
        $kategori->save();

        // sweet alert
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('admin/kategori');
    }

    public function list()
    {
        $data = [
            'title' => 'List Kategori',
        ];

        $kategoris = Kategori::all();
        return view('admin.kategori.list', compact('kategoris'), $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit kategori',
        ];

        $kategoris = Kategori::find($id);
        return view('admin.kategori.edit', compact('kategoris'), $data);
    }


    public function update($id, Request $request)
    {
        //validasi form
        $this->validate($request, [
            'kategori' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kategori = kategori::find($id);

        // cek jika ada file yang diupload | Jika tidak akan langsung mengupdate data tanpa mengubah file
        if ($request->hasFile('gambar')) {
            File::delete('uploads/' . $kategori->gambar);
            $file = $request->file('gambar');
            $nama_gambar = $kategori->gambar;
            $file->move('uploads', $nama_gambar);
        }

        // mengupdate data ke tabel kategori
        $kategori->kategori = $request->kategori;
        $kategori->gambar = $kategori->gambar;
        $kategori->save();

        // sweet alert
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('admin/kategori');
    }


    public function delete($id)
    {
        $kategori = kategori::find($id);
        File::delete('uploads/' . $kategori->gambar);
        $kategori->delete();

        // sweet alert
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('admin/kategori')->with('success', 'Data Berhasil Dihapus');
    }


}
