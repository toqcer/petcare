@extends('layouts.app')

@section('title', 'My Order')

@section('content')
    <main>
        <section class="section-booking-content">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-12 pl-lg-0">
                        @forelse ($items as $transaction)
                            <div class="card card-booking">
                                <div class="container px-4 pt-3">
                                    <div class="row align-items-center">
                                        <div class="col text-left">
                                            Transaksi #<b>{{ $transaction->id }}</b> -
                                            {{ $transaction->created_at->format('dmY') }}
                                        </div>
                                        <div class="col-auto badge bg-success text-white text-right font-weight-bold mr-3">
                                            {{ $transaction->transaction_status }}
                                        </div>
                                    </div>
                                    <div class="font-weight-bold">
                                        Package : {{ $transaction->health_package->title }}
                                    </div>
                                    <div class="font-weight-bold">
                                        Grand Total : Rp. {{ number_format($transaction->transaction_total) }}
                                    </div>
                                    @if (! is_null($transaction->rating))
                                        <div class="font-weight-bold">
                                            Rating : {{ $transaction->rating->value }}/5
                                        </div>
                                    @endif
                                    <div class="mt-3">
                                        Transaction Items :
                                    </div>
                                    @foreach ($transaction->details as $item)
                                        <ul class="px-2 py-3 bg-light mt-2 mx-4 mb-3">
                                            <li class="d-flex align-items-center px-3">
                                                Nama Hewan : {{ $item->pet_name }} ({{ $item->pet }})
                                            </li>
                                            <li class="d-flex align-items-center px-3">
                                                Waktu : {{ $item->estimation_time->format('d-m-Y') }} [
                                                {{ $item->estimation_time->format('h:i') }} -
                                                {{ $item->finished_at->format('h:i') }} ]
                                            </li>
                                        </ul>
                                    @endforeach
                                    <div class="row my-2 py-2 px-3">
                                        @if ($transaction->transaction_status == 'IN_CART')
                                            <a href="{{ route('checkout', $transaction->id) }}"
                                                class="btn btn-primary mr-3">
                                                Bayar Sekarang
                                            </a>
                                        @endif
                                        @if (in_array($transaction->transaction_status, ['IN_CART', 'SUCCESS']))
                                            <a href="{{ route('checkout.cancel', $transaction->id) }}"
                                                class="btn btn-danger mr-3">
                                                Batalkan Pesanan
                                            </a>
                                        @endif
                                        @if ($transaction->transaction_status == 'FINISHED' and is_null($transaction->rating))
                                            <a href="{{ route('my-order.rate', $transaction->id) }}"
                                                class="btn btn-primary mr-3">
                                                Berikan Rating
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card card-booking">
                                <div class="container text-center">
                                    Anda Belum memiliki order apapun.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
