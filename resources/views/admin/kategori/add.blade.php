@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('admin/tambah-kategori') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-2">
                    <label for="kategori" class="col-md-2 col-form-label text-md-end">{{ __('Kategori') }}</label>

                    <div class="col-md-5">
                        <input id="nama_kategori" type="text"
                            class="form-control @error('nama_kategori') is-invalid @enderror" name="kategori" required
                            autocomplete="kategori" autofocus>

                        @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="gambar" class="col-md-2 col-form-label text-md-end">{{ __('Gambar') }}</label>

                    <div class="col-md-5">
                        <input id="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror"
                            name="gambar" required autocomplete="gambar" autofocus>
                        @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Tambah kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
