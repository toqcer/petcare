@extends('layouts.success')


@section('title', 'Checkout Success')


@section('content')
    <main>
        <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <a href="https://icons8.com/illustrations">
                    <img src="{{ url('frontend/images/sukses.png') }}" alt="">
                </a>
                <h1>Pembayaran Berhasil!</h1>
                <p>
                    Kami akan memberikan kamu email untuk instruksi selanjutnya, <br>
                    silahkan dibaca dengan baik ya.
                </p>
                <a href="{{ route('home') }}" class="btn btn-home-page mt-3 px-5">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </main>
@endsection