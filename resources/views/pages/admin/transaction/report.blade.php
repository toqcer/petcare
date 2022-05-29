@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-pdf-without-action" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Paket</th>
                                <th>Quantity</th>
                                <th>Harga Paket</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            @if ($items)
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_date }}</td>
                                        <td>{{ $item->health_package->title }}</td>
                                        <td>{{ $item->details_count }}</td>
                                        <td>Rp. {{ number_format($item->health_package->price) }}</td>
                                        <td>Rp. {{ number_format($item->transaction_total) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Total Transaction</td>
                                    <td>{{number_format($grandTotalTransaction)}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Sales</td>
                                    <td>Rp. {{number_format($grandTotalSales)}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="/" class="text-center">
                                        Data Kosong
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@push('scripts')
    <script>
        const thTotal = $(".table-pdf-without-action th").length
        $(".table-pdf-without-action").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'pdf'
            ],
            columnDefs: [
                {
                    orderable: false, 
                    targets: [thTotal - 1]
                }
            ]
        })
    </script>
@endpush