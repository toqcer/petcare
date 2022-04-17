@extends('layouts.app')


@section('title')
    Petcare
@endsection


@section('content')
    <!-- Header -->
    <header class="header-brand">
        <div class="container">
            <a href="https://icons8.com/illustrations">
                <img src="{{ url('frontend/images/pet.png') }}" class="img-fluid float-right" alt="PetCare Header">
            </a>
        <h1>
            Rawat dan Sayangi Hewan Peliharaan 
            Anda Bersama PetCare
        </h1>
        <p class="mt-3">
            Atur jadwal untuk periksa kesehatan 
            <br>
            atau beli kebutuhan lainnya
        </p>

        <a href="#popular" class="btn btn-get-started px-4 mt-4">
            Lebih lanjut
        </a>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">

            <!-- Statistics -->
            <section class="section-stats row justify-content-center" id="stats">
                <div class="col-3 col-md-2 stats-detail">
                    <h2>100</h2>
                    <p>Members</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>5</h2>
                    <p>Dokter</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>10</h2>
                    <p>Partners</p>
                </div>
            </section>
        </div>

        <!-- Popular -->
        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>Paket Popular</h2>
                        <p>Pesan dan beli Paket Popular yang anda inginkan pada bulan ini</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Package -->
        <section class="section-popular-content" id="popularContent">
            <div class="container">
                <div class="section-popular-package row justify-content-center">
                    
                    @foreach ($items as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-package text-center d-flex flex-column" style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}')">
                            <div class="package-name">{{ $item->package_name }}</div>
                            <div class="package-caption">{{ $item->title }}</div>
                            <div class="div package-button mt-auto">
                                <a href="{{ route('detail', $item->slug) }}" class="btn btn-package-details px-4">
                                    Lihat detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </section>

        <!-- Brands -->
        <section class="section-brands">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Brand Favorit PetCare</h2>
                        <p>
                            Brand dengan kualitas terbaik
                            <br> 
                            untuk hewan peliharaan kesayangan anda
                        </p>
                    </div>
                    <div class="col-md-8 text-center">
                        <img src="{{ url('frontend/images/Brand.png') }}" alt="Brnad Favorit" class="img-brand">
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="section-testimonial-heading" id="testimonialHeading">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>Testimonial dari Para Member</h2>
                        <p>
                            Alasan mereka percaya kami untuk memberikan
                            <br> 
                            yang terbaik bagi hewan peliharaannya
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-testimonial-content" id="testimonialContent">
            <div class="container">
                <div class="section-popular-package row justify-content-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testi1.jpg" alt="User" class="mb-4 rounded-circle">
                                <h3 class="mb-4">James Alexander</h3>
                                <p class="testimonial">
                                    "Kucing saya Oreo dan Bubu terlihat lebih bersih dan 
                                    lebih sehat saat melakukan mandi dan juga cek kesehatan di toko PetCare, thanks PetCare!"
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testi2.jpg" alt="User" class="mb-4 rounded-circle">
                                <h3 class="mb-4">Marissa K. Elba</h3>
                                <p class="testimonial">
                                    "Anjing saya sangat menyukai makanan disini, brand yang berkualitas 
                                    dan terjamin membuat saya percaya dengan PetCare dalam memenuhi kebutuhan Timmy"
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testi3.jpg" alt="User" class="mb-4 rounded-circle">
                                <h3 class="mb-4">Katrina Salim</h3>
                                <p class="testimonial">
                                    "Terima kasih PetCare, hewan peliharaan saya menjadi terawat dengan baik, 
                                    dari kualitas makanan, dokter, sampai aksesoris semua saya percayakan kepada PetCare"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="#" class="btn btn-need-help px-4 mt-4 mx-1">
                            Butuh bantuan
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-get-started px-4 mt-4 mx-1">
                            Cari kebutuhan
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection