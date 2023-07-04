@extends('layouts.app')
@section('content')
    <h1>Home: {{ Auth::user()->name }}</h1>
    <hr>
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <a href="{{route('adduser')}}" class="btn btn-primary float-right">Add User</a>
        </div>
    </div>

    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

        <div class="row">
            <div class="col-sm-12">
                <table id="example" class="table table-striped table-bordered dataTable" style="width:100%"
                    aria-describedby="example_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-sort="ascending" aria-label="Image: activate to sort column descending"
                                style="width: 131.688px;">Image</th>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 131.688px;">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Email: activate to sort column ascending" style="width: 217.5px;">Email
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Password: activate to sort column ascending" style="width: 97.9625px;">Password
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Created At: activate to sort column ascending" style="width: 79.6875px;">Created
                                At</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Action: activate to sort column ascending" style="width: 74.6375px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allusers as $users)
                            <tr class="odd">
                                <td class="sorting_1">image</td>
                                <td>name</td>
                                <td>email</td>
                                <td>password</td>
                                <td>created_at</td>
                                <td><a href="{{ route('edit_user') }}"></a> <a href="{{ route('delete_user') }}"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#example').DataTable({
            pageLength: 5,
        });
    </script>
@endsection
