@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Gambar </th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('uploads/' . $kategori->gambar) }}"
                                            alt="{{ $kategori->kategori }}" width="100px"></td>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td>
                                        <a href="{{ url('admin/kategori') }}/{{ $kategori->id }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ url('admin/kategori', $kategori->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Anda yakin ingin menghapus data?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        {{-- sweet alert --}}
        @include('sweetalert::alert')
    @endsection
