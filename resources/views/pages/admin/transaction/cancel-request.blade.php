@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-pdf-without-action" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Paket</th>
                                <th>User</th>
                                {{-- <th>Hewan Peliharaan</th> --}}
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->health_package->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->transaction_total }}</td>
                                    <td>
                                        @foreach ($item->details as $detail)
                                            <div>{{ $detail->package_date }}</div>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->transaction_status }}</td>
                                    <td>
                                        <a href="{{ route('transaction.cancel-request.show', $item->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="/" class="text-center">
                                        Data Kosong
                                    </td>
                                </tr>
                            @endforelse
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