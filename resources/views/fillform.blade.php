@extends('layouts.app')
@section('content')
    <div class="container">
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
            <div class="col-md-8 offset-md-2">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1 class="text-center">Fill out the form</h1>
                        <form class="form-horizontal" action="{{ route('fillformdata') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="address" name="address" id="address" placeholder="address"
                                    class="form-control" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="pan_no">PAN No.</label>
                                <input type="pan_no" name="pan_no" id="pan_no" placeholder="PAN No."
                                    class="form-control" value="{{ old('pan_no') }}">
                                @if ($errors->has('pan_no'))
                                    <p class="text-danger">{{ $errors->first('pan_no') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="adhaar_no">ADHAAR No.</label>
                                <input type="adhaar_no" name="adhaar_no" id="adhaar_no" placeholder="ADHAAR No."
                                    class="form-control" value="{{ old('adhaar_no') }}">
                                @if ($errors->has('adhaar_no'))
                                    <p class="text-danger">{{ $errors->first('adhaar_no') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">User Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-8 text-left">
                                </div>
                                <div class="col-4 text-right">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('.text-success').hide();
        }, 30000); // <-- time in milliseconds
    </script>
@endsection
