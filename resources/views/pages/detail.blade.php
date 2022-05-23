@extends('layouts.app') @section('title', 'Detail Paket') @section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Paket Sehat</li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        <h1>{{ $item->title }}</h1>
                        <p>
                            {{ $item->caption }}
                        </p>

                        @if ($item->galleries->count())
                        <div class="gallery">
                            <div class="xzoom-container">
                                <img
                                    src="{{ $item->galleries->first()->image }}"
                                    class="xzoom"
                                    id="xzoom-default"
                                    xoriginal="{{ $item->galleries->first()->image }}"
                                />
                            </div>
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries as $gallery)
                                <a href="{{ $gallery->image }}">
                                    <img
                                        src="{{ $gallery->image }}"
                                        class="xzoom-gallery"
                                        width="128"
                                        xpreview="{{ $gallery->image }}"
                                    />
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <h2>Tentang Mandi dan Grooming</h2>
                        <p>{!! $item->about !!}</p>
                        <div class="features row">
                            <div class="col-md-4">
                                <div class="description">
                                    <img
                                        src="{{
                                            url('frontend/images/ic-spray.png')
                                        }}"
                                        alt=""
                                        class="features-image"
                                    />
                                    <div class="description">
                                        <h3>Parfum Hewan</h3>
                                        <p>{{ $item->perfume }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                    <img
                                        src="{{
                                            url('frontend/images/ic-vit.png')
                                        }}"
                                        alt=""
                                        class="features-image"
                                    />
                                    <div class="description">
                                        <h3>Vitamin</h3>
                                        <p>{{ $item->vitamin }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                    <img
                                        src="{{
                                            url('frontend/images/ic-food.png')
                                        }}"
                                        alt=""
                                        class="features-image"
                                    />
                                    <div class="description">
                                        <h3>Snack Sehat</h3>
                                        <p>{{ $item->snack }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-details card-right">
                        
                        <h2>Informasi Paket</h2>
                        <table class="package-information">
                            <tr>
                                <th width="50%">Tgl Tersedia</th>
                                <td width="50%" class="text-right">
                                    {{ Carbon\Carbon::create($item->available_date)->format('F n, Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Durasi</th>
                                <td width="50%" class="text-right">
                                    {{ $item->duration }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Nama Paket</th>
                                <td width="50%" class="text-right">
                                    {{ $item->package_name }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Harga</th>
                                <td width="50%" class="text-right">
                                    Rp{{ $item->price }} /Hewan
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="join-container">
                        @auth
                        <form
                            action="{{ route('checkout_process', $item->id) }}"
                            method="post"
                        >
                            @csrf
                            <button
                                class="btn btn-block btn-join-now mt-3 py-2"
                                type="submit"
                            >
                                Pesan sekarang
                            </button>
                        </form>
                        @endauth @guest
                        <a
                            href="{{ route('login') }}"
                            class="btn btn-block btn-join-now mt-3 py-2"
                        >
                            Masuk atau Buat Akun untuk pesan
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection @push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush @push('addon-script')
<script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".xzoom, .xzoom-gallery").xzoom({
            zoomWidth: 500,
            title: false,
            tint: "#333",
            xoffset: 15,
        });
    });
</script>
@endpush
