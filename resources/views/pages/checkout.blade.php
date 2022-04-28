@extends('layouts.checkout') @section('title', 'Checkout') @section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Paket Sehat</li>
                            <li class="breadcrumb-item">Details</li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <h1>Antrian Saat Ini</h1>
                        <p>
                            {{ $item->health_package->Caption }}
                        </p>
                        <div class="attendee">
                            <table
                                class="table table-responsive-sm text-center"
                            >
                                <thead>
                                    <tr>
                                        <td>Foto</td>
                                        <td>Nama Hewan</td>
                                        <td>Antrian ke</td>
                                        <td>Hewan</td>
                                        <td>Status</td>
                                        <td>Estimasi Waktu</td>
                                        <td>Estimasi Selesai</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->details as $detail)
                                    <tr>
                                        <td>
                                            <img
                                                src="https://ui-avatars.com/api/?name={{ $detail->pet_name }}"
                                                height="50"
                                                class="rounded-circle"
                                            />
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->pet_name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->queue }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->pet }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->estimation_time < now() ? $detail->finished_at < now() ? 
                                            'Selesai' : 'In Progress' : 'Menunggu' }}
                                        </td>
                                        <td class="align-middle font-weight-bold">
                                            {{ $detail->estimation_time->format('d M Y H:i') }}
                                        </td>
                                        <td class="align-middle font-weight-bold">
                                            {{ $detail->finished_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="align-middle">
                                            <a
                                                href="{{ route('checkout-remove', $detail->id) }}"
                                            >
                                                <img
                                                    src="{{
                                                        url(
                                                            'frontend/images/Ic_remove.png'
                                                        )
                                                    }}"
                                                    height="30"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Tidak ada antrian
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="member mt-3">
                            <h2>Tambah Antrian</h2>
                            <form
                                class="form-inline"
                                method="post"
                                action="{{ route('checkout-create', $item->id) }}"
                            >
                                @csrf
                                <label for="pet_name" class="sr-only">Nama Hewan</label>
                                <input
                                    type="text"
                                    class="form-control mb-2 mr-sm-2"
                                    name="pet_name"
                                    id="pet_name"
                                    required
                                    placeholder="Nama Hewan"
                                />

                                <label for="pet" class="sr-only">Hewan</label>
                                <select
                                    name="pet"
                                    id="pet"
                                    class="custom-select mb-2 mr-sm-2"
                                    required
                                >
                                    <option value="" selected disabled>
                                        Jenis Hewan
                                    </option>
                                    <option value="kucing">Kucing</option>
                                    <option value="anjing">Anjing</option>
                                </select>

                                <label for="package_date" class="sr-only"
                                    >DD/MM/YYYY</label
                                >
                                <div class="input-group mb-2 mr-sm-2">
                                    <input
                                        type="text"
                                        class="form-control datepicker"
                                        name="package_date"
                                        id="dateBooking"
                                        placeholder="DD/MM/YYYY"
                                        required
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-add-now mb-2 px-4"
                                >
                                    Tambah
                                </button>
                            </form>
                            <h3 class="mt-2 mb-0">Note</h3>
                            <p class="disclaimer mb-0">
                                Harga paket CERIA sudah termasuk dengan tambahan
                                snack, spray, dan vitamin.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-details card-right">
                        <h2>Informasi Checkout</h2>
                        <table class="package-information">
                            <tr>
                                <th width="50%">Tgl Tersedia</th>
                                <td width="50%" class="text-right">
                                    {{ $item->health_package->available_date }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Durasi</th>
                                <td width="50%" class="text-right">
                                    {{ $item->health_package->duration . ' menit' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Total Hewan</th>
                                <td width="50%" class="text-right">
                                    {{ $item->details->count() }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Total</th>
                                <td width="50%" class="text-right text-total">
                                    <span class="text-blue"
                                        >Rp {{ $item->transaction_total }}</span
                                    >
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <h2>Instruksi Pembayaran</h2>
                        <p class="payment-instructions">
                            Silahkan lakukan pembayaran sebelum jam 00.00 WIB.
                        </p>
                        <div class="bank">
                            <div class="bank-item pb-3">
                                <img
                                    src="{{ url('frontend/images/bca.png') }}"
                                    alt=""
                                    class="bank-image"
                                />
                                <div class="description">
                                    <h3>Mora Petshop</h3>
                                    <p>
                                        0456 7892 3101 <br />
                                        BCA (Dicek Otomatis)
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bank-item pb-3">
                                <img
                                    src="{{ url('frontend/images/bni.png') }}"
                                    alt=""
                                    class="bank-image"
                                />
                                <div class="description">
                                    <h3>Mora Petshop</h3>
                                    <p>
                                        0857 9923 1121 <br />
                                        BNI (Dicek Otomatis)
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bank-item pb-3">
                                <img
                                    src="{{ url('frontend/images/ovo.png') }}"
                                    alt=""
                                    class="bank-image"
                                />
                                <div class="description">
                                    <h3>Mora Petshop</h3>
                                    <p>
                                        0821 5678 7890 <br />
                                        OVO (Dicek Otomatis)
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="join-container">
                        <form action="{{ route('checkout-success', $item->id) }}" method="post">
                            @csrf
                            <button type="submit"
                                class="btn btn-block btn-join-now mt-3 py-2"
                            @if ($item->details->count() == 0) disabled @endif >
                                Saya sudah membayar
                            </button>
                        </form>
                    </div>
                    <div class="text-center mt-3">
                        <a
                            href="{{ route('detail', $item->health_package->slug) }}"
                            class="text-muted"
                        >
                            Cancel Pemesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection @push('prepend-style')
<link
    rel="stylesheet"
    href="{{ url('frontend/libraries/combined/css/gijgo.min.css') }}"
/>
@endpush @push('addon-script')
<script src="{{ url('frontend/libraries/combined/js/gijgo.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
            uiLibrary : 'bootstrap4',
            icons : {
                rightIcon : '<img src="{{ url('frontend/images/Ic_calender.png') }}">'
            }
        })
    });
</script>
@endpush
