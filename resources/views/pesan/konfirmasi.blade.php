@extends('layouts.app')
@section('content')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-2">
                <a href="{{ url('check-out') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <h2>Checkout</h2>

            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td width="10">:</td>
                        <td>
                            <input type="text" name="name" value="{{ $user->name }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>
                            <input type="email" name="email" value="{{ $user->email }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>No. Hp</td>
                        <td>:</td>
                        <td>
                            <input type="tel" name="no_hp" value="{{ $user->no_hp }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <textarea name="alamat">{{ $user->alamat }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            

            
                {{-- <td>
                    <a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success"
                            onclick="return confirm('Anda yakin check out?')">
                <i class="fa fa-shopping-cart"></i> Check Out
                    </a>
                </td> --}}
            <div class="form-group">
                <label class="font-weight-bold">PROVINSI</label>
                <select class="form-control provinsi-tujuan" name="province_destination">
                    <option value="0">-- pilih provinsi --</option>
                    @foreach ($provinces as $province => $value)
                        <option value="{{ $province  }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">KOTA / KABUPATEN</label>
                <select class="form-control kota-tujuan" name="city_destination">
                    <option value="">-- pilih kota --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="courier">Pilih Kurir</label>
                <select class="form-control" name="courier_id" id="courier">
                    <option value="">-- Pilih Kurir --</option>
                     @foreach ($couriers as $courier)
                        <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                     @endforeach
                </select>
            </div>

            
            <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                <!-- CEK ONGKOS KIRIM button -->
                <div class="col-md-3">
                    <button class="btn btn-md btn-primary btn-block" id="btn-check">
                        CEK ONGKOS KIRIM
                    </button>
                </div>
                <form action="{{ url('konfirmasi-check-out') }}" method="post">
                    @csrf
                    @method("POST")
                    <input type="text" id="biayaOngkir" name="biayaOngkir" readonly>

                    <!-- Checkout button visible -->
                    <button type="submit" class="btn btn-success btn-block" id="checkoutBtn" onclick="return confirm('Anda yakin check out?')">
                        <i class="fa fa-shopping-cart"></i> Check Out
                    </button>
                </form>
                
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card d-none ongkir">
                        <div class="card-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            //active select2
            $(" .provinsi-tujuan, .kota-tujuan").select2({
                theme:'bootstrap4',width:'style',
            });
            //ajax select kota asal
            $('select[name="province_origin"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_origin"]').empty();
                            $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                }
            });
            //ajax select kota tujuan
            $('select[name="province_destination"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                }
            });
            //ajax check ongkir
            let isProcessing = false;
            $('#btn-check').click(function (e) {
                e.preventDefault();
    
                let token            = $("meta[name='csrf-token']").attr("content");
                let city_origin      = $('select[name=city_origin]').val();
                let city_destination = $('select[name=city_destination]').val();
                let courier          = $('select[name=courier]').val();
                let weight           = $('#weight').val();
    
                if(isProcessing){
                    return;
                }
    
                isProcessing = true;
                jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token:              token,
                    city_origin:         city_origin,
                    city_destination:    city_destination,
                    courier:             courier,
                    weight:              weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function (key, value) {
                            $('#biayaOngkir').val( value.cost[0].value);
                                return false; // This will break the loop after the first iteration
                        });


                    }
                }
            });
    
            });
    
        });
    </script>
    
@endsection
