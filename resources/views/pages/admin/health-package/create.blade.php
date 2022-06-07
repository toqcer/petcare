@extends('layouts.admin')


@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Paket Sehat</h1>
            
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
                <form action="{{ route('health-package.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" name="caption" placeholder="Caption" value="{{ old('caption') }}">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" rows="10" class="d-block w-100 form-control">{{ old('about') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="perfume">Perfume</label>
                        <input type="text" class="form-control" name="perfume" placeholder="Perfume" value="{{ old('perfume') }}">
                    </div>
                    <div class="form-group">
                        <label for="vitamin">Vitamin</label>
                        <input type="text" class="form-control" name="vitamin" placeholder="Vitamin" value="{{ old('vitamin') }}">
                    </div>
                    <div class="form-group">
                        <label for="snack">Snack</label>
                        <input type="text" class="form-control" name="snack" placeholder="Snack" value="{{ old('snack') }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ old('duration') }}">
                    </div>
                    <div class="form-group">
                        <label for="package_name">Package Name</label>
                        <input type="text" class="form-control" name="package_name" placeholder="Package Name" value="{{ old('package_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
        

    </div>
    <!-- /.container-fluid -->
@endsection