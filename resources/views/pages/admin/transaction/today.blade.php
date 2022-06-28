@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaksi Hari Ini</h1>
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
                                <th>Hewan Peliharaan</th>
                                <th>Nama Hewan</th>
                                <th>Waktu Mulai</th>
                                <th>Petugas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->transaction->health_package->title }}</td>
                                    <td>{{ $item->transaction->user->name }}</td>
                                    <td>{{ $item->pet }}</td>
                                    <td>{{ $item->pet_name }}</td>
                                    <td>{{ $item->estimation_time }}</td>
                                    <td>{{ $item->worker->name ?? 'Belum pilih Petugas' }}</td>
                                    <td>
                                        <a href="{{ route('transaction.assign-worker', $item->id) }}" class="btn btn-primary">
                                            Pilih Petugas
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