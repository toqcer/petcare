@extends('layouts.success')


@section('title', 'Checkout Success')


@section('content')
    <main>
        <div class="section-success d-flex align-items-center justify-content-center">
            <div class="col-12 col-lg-6 text-center">
                <a href="https://icons8.com/illustrations" class="text-center d-block">
                    <img src="{{ asset('frontend/images/sukses.png') }}" alt="">
                </a>
                <h1 class="">Pembayaran Berhasil!</h1>
                <h5>Screenshot Halaman Ini Sebagai Bukti Pemesanan!</h5>
                <article class="text-black">
                    @foreach ($transaction->details as $detail)
                    <div class="mb-3">
                        <p class="mb-0">Nama hewan: {{ $detail->pet_name }}</p>
                        <p class="mb-0">Nomor antrian : {{ $detail->queue }}</p>
                        <p class="mb-0 border-bottom pb-3">
                            Estimasi waktu datang : 
                            <time datetime="{{ $detail->estimation_time }}">
                                {{ $detail->estimation_time->format('d M Y H:i') }}
                            </time>
                        </p>
                    </div>
                    @endforeach
                </article>
                <a href="{{ route('home') }}" class="btn btn-home-page mt-3 px-5">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </main>
@endsection