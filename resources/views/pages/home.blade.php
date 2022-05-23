@extends('layouts.app') @section('title') Petcare @endsection
@section('content')
<!-- Header -->
<header class="header-brand">
    <div class="container">
        <a href="https://icons8.com/illustrations">
            <img
                src="{{ url('frontend/images/pet.png') }}"
                class="img-fluid float-right"
                alt="PetCare Header"
            />
        </a>
        <h1>Rawat dan Sayangi Hewan Peliharaan Anda Bersama PetCare</h1>
        <p class="mt-3">
            Atur jadwal untuk periksa kesehatan
            <br />
            atau beli kebutuhan lainnya
        </p>

        <a href="#popular" class="btn btn-get-started px-4 mt-4">
            Lebih lanjut
        </a>
    </div>
</header>

<!-- Main Content -->
<main>
    <!-- Popular -->
    <section class="section-popular" id="popular">
        <div class="container">
            <div class="row">
                <div class="col text-center section-popular-heading">
                    <h2>Paket Popular</h2>
                    <p>
                        Pesan dan beli Paket Popular yang anda inginkan pada
                        bulan ini
                    </p>
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
                    <div
                        class="card-package text-center d-flex flex-column"
                        style="background-image: url('{{ $item->galleries->count() ? $item->galleries->first()->image : '' }}')"
                    >
                        <div class="package-name">
                            {{ $item->package_name }}
                        </div>
                        <div class="package-caption">{{ $item->title }}</div>
                        <div class="div package-button mt-auto">
                            <a
                                href="{{ route('detail', $item->slug) }}"
                                class="btn btn-package-details px-4"
                            >
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
                        <br />
                        untuk hewan peliharaan kesayangan anda
                    </p>
                </div>
                <div class="col-md-8 text-center">
                    <img
                        src="{{ url('frontend/images/Brand.png') }}"
                        alt="Brnad Favorit"
                        class="img-brand"
                    />
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
