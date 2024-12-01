<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isMember');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        if($request->has('search') || $request->has('kategori') ){
            $query = Barang::query();
            if($request->has('search')){
                $query->where('nama_barang', 'like', '%'. $request->search . '%');
            }

            if($request->has('kategori')){
                $query->where('kategori_id',  $request->kategori );
            }

            $barangs = $query->paginate(100);
            $cek = $query->count();

            // $barangs = Barang::where('nama_barang', 'like', '%'. $request->search . '%')->paginate(20);
            // $cek = Barang::where('nama_barang', 'like', '%'. $request->search . '%')->paginate(20)->count();
        if($cek==0){
            return back()->with('failed', 'Barang Kosong!');
        }

        }else{
            
            $barangs = Barang::paginate(100);
        }

        $data =
            [
                'title' => 'Home',
                'kategoris' => Kategori::orderBy('kategori', 'ASC')->get(),
            ];
      
        return view('home', compact('barangs'), $data);
    }
}
