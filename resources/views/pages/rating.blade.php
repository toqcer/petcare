@extends('layouts.app')

@section('title', 'Rating Order')

@section('content')
    <main>
        <section class="section-booking-content">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-12 pl-lg-0">
                        <form action="{{ route('my-order.rate', $transaction->id) }}" method="POST">
                            @csrf
                            <h3 class="mb-2">Input Rating Transaction #{{$transaction->id}}</h3>
                            <h5 class="mb-5">Package Name : {{ $transaction->health_package->title }}</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="value" id="inlineRadio1"
                                    value="1">
                                <label class="form-check-label mr-4" for="inlineRadio1">1</label>
                                <input class="form-check-input" type="radio" name="value" id="inlineRadio2"
                                    value="2">
                                <label class="form-check-label mr-4" for="inlineRadio2">2</label>
                                <input class="form-check-input" type="radio" name="value" id="inlineRadio3"
                                    value="3">
                                <label class="form-check-label mr-4" for="inlineRadio3">3</label>
                                <input class="form-check-input" type="radio" name="value" id="inlineRadio4"
                                    value="4">
                                <label class="form-check-label mr-4" for="inlineRadio4">4</label>
                                <input class="form-check-input" type="radio" name="value" id="inlineRadio5"
                                    value="5" checked>
                                <label class="form-check-label mr-4" for="inlineRadio5">5</label>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Submit Rating</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
