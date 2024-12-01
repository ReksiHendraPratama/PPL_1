@extends('layouts.admin')
@section('content')

    <div class="text-left mb-4">
        <a href="{{ url('admin/kategori') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
            Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ url('admin/kategori') }}/{{ $kategoris->id }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-2">
                    <label for="kategori" class="col-md-2 col-form-label text-md-end">{{ __('Kategori') }}</label>

                    <div class="col-md-5">
                        <input id="kategori" type="text"
                            class="form-control @error('kategori') is-invalid @enderror" name="kategori" required
                            autocomplete="nama_kategori" autofocus value="{{ $kategoris->kategori }}">

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
                            name="gambar" autocomplete="gambar" autofocus>
                        @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="keterangan"
                        class="col-md-2 col-form-label text-md-end">{{ __('Preview Gambar') }}</label>
                    <div class="col-md-5">
                        <img src="{{ url('uploads') }}/{{ $kategoris->gambar }}" height="250px">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
