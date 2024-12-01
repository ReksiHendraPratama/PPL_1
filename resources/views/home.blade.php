@extends('layouts.app')

@section('content')

<!-- <style>
.row.justify-content-center {
    margin: 0;
}
</style> -->
<!-- <style>
    .carousel-item img {
        object-fit: contain;
        object-position: cente;
        width: 80%;
        height: 80&;
    }
</style> -->



    <div class="container">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ url('img/pek/slide1.png') }}" class="d-block w-100" alt="carousel-1">
                </div>
                <div class="carousel-item">
                    <img src="{{ url('img/pek/slide2.png') }}" class="d-block w-100" alt="carousel-2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 my-4 ">
                

                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <form action="/home" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Produk" name="search" value="{{request('search')}}">
                            <button class="btn btn-danger" type="submit">Cari</button>
                        </div>
                        </form>
                    </div>
                </div>

    <div class="col">
        @if(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show " >
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    </div>
    
    <strong><h2>Kategori Produk</h2></strong>
            <p>Cari barang sesuai dengan kategori</p>
@foreach ($kategoris as $kategori)
    <div class="col-md-2 p-1" >
        <a href="{{ route('home', ['kategori'=>$kategori->id]) }}" style="text-decoration: none;">
            <div class="card text-center my-auto" >
            <img src="{{ url('uploads') }}/{{ $kategori->gambar }}" class="card-img-top" style="object-fit: cover; height: 200px; width: 210px;" alt="barang">

                <div class="card-body">
                    <h5 class="card-title">{{ $kategori->kategori }}</h5>
                </div>
            </div>
        </a>
    </div>
    
@endforeach
            <p><h2>Produk Baru</h2></p>
			<p>Pilih barang terbaru dari kami</p>
        <div class="col-12">
		
			</div>
        @foreach ($barangs as $barang)
       
                <div class="col-md-2 p-">
                    <div class="card ">
                        <img src="{{ url('uploads') }}/{{ $barang->gambar }}" class="card-img-top"
                            style=" sobject-fit: cover;" alt="barang">
                        <div class="card-body ">
                           <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <p class="card-text">
                                <strong>Harga :</strong> Rp. {{ number_format($barang->harga) }} <br>
                                <strong>Stok :</strong>
                                @if($barang->stok > 0)
                                    {{ $barang->stok }}
                                    <br>
                                    <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
                                @else
                                    Stok Habis
                                    <br>
                                    <button class="btn btn-primary" disabled><i class="fa fa-shopping-cart"></i> Pesan</button>
                                @endif
                                
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection
