@extends('layouts.home')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Profile Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
        <hr>
        <div class="row">
            @if (Session::has('success'))
                <div class="alert alert-success alert-block mt-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-block mt-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('error') }}</strong>
                </div>
            @endif
        </div>
        <form id="formAccountSettings" method="POST" action="{{ route('profile.update', auth()->id()) }}"
            enctype="multipart/form-data" class="needs-validation" role="form" novalidate>
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ auth()->user()->name }}" autofocus="" required>
                        @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" id="email" name="email"
                            value="{{ auth()->user()->email }}" placeholder="john.doe@example.com">
                        @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
