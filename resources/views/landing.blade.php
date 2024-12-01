@extends('layouts.landing')
@section('container')
    <header class="home">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Keunikan Bengkulu, Kualitas Nasional!</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Sekarang anda dapat membeli oleh-oleh khas bengkulu tanpa harus pergi ke toko secara offline </p>
                    <a class="btn btn-primary btn-xl" href="#about">Tentang Kami</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-dark mt-0">Tentang Kami</h2>
                    <hr class="divider" />
                    <p class="text-dark-75 mb-4">
                       B-Craft toko yang menyediakan oleh-oleh khas dari Bengkulu
                   <br><br> <a class="btn btn-primary btn-xl" href="/login">Masuk</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact-->
    <section class="page-section bg-primary" id="contact">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center text-white mt-0">Hubungi Kami</h2>
        <hr class="divider divider-light" />
        <p class="text-white-75 mb-4 text-center">
            Punya pertanyaan atau masalah? Hubungi kami dengan salah satu kontak di bawah ini.
        </p>
        <div class="row gx-4 gx-lg-5 bg-white pb-5 rounded">
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi bi-pin-map-fill fs-1" style="color: rgba(0, 105, 148, 1);"></i></div>
                    <h3 class="h4 mb-2">Alamat</h3>
                    <p class="text-muted mb-0">Bengkulu, Indonesia</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi bi-envelope-fill fs-1" style="color: rgba(0, 105, 148, 1);"></i></div>
                    <h3 class="h4 mb-2">Email</h3>
                    <p class="text-muted mb-0">b_craft@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi bi-telephone-fill fs-1" style="color: rgba(0, 105, 148, 1);"></i></div>
                    <h3 class="h4 mb-2">Whatsapp</h3>
                    <p class="text-muted mb-0">0896 2916 9438</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
