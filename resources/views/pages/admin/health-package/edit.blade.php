@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Paket Sehat {{ $item->title }}</h1>
            
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('health-package.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" name="caption" placeholder="Caption" value="{{ $item->caption }}">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" rows="10" class="d-block w-100 form-control">{{ $item->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="perfume">Perfume</label>
                        <input type="text" class="form-control" name="perfume" placeholder="Perfume" value="{{ $item->perfume }}">
                    </div>
                    <div class="form-group">
                        <label for="vitamin">Vitamin</label>
                        <input type="text" class="form-control" name="vitamin" placeholder="Vitamin" value="{{ $item->vitamin }}">
                    </div>
                    <div class="form-group">
                        <label for="snack">Snack</label>
                        <input type="text" class="form-control" name="snack" placeholder="Snack" value="{{ $item->snack }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $item->duration }}">
                    </div>
                    <div class="form-group">
                        <label for="package_name">Package Name</label>
                        <input type="text" class="form-control" name="package_name" placeholder="Package Name" value="{{ $item->package_name }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $item->price }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
        

    </div>
    <!-- /.container-fluid -->
@endsection