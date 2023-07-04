@extends('layouts.home')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Users List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
        </ol>
        <hr>
        <div class="row">
            <div class="col-12 mt-2 mb-2">

                <a class="btn btn-info float-right" href="javascript:void(0)" id="createNewPost"> Add User</a>
            </div>
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
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List
            </div>
            <div class="card-body">
                <table class="table table-bordered data-table" id="datatablesSimple">
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
                                aria-label="PAN No.: activate to sort column ascending" style="width: 97.9625px;">PAN No.
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="ADHAAR No.: activate to sort column ascending" style="width: 97.9625px;">ADHAAR
                                No.
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
                            <tr class="odd data-user-id-{{ $users->id }}">
                                <td><img src="{{ asset('userimages/' . $users->image) }}" alt="User Image" width="100px">
                                </td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->pan_no }}</td>
                                <td>{{ $users->adhaar_no }}</td>
                                <td>{{ $users->created_at }}</td>
                                <td><a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $users->id }}"
                                        data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a> <a
                                        href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $users->id }}"
                                        data-original-title="Delete" data-user-id="{{ $users->id }}"
                                        class="btn btn-danger btn-sm deletePost">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" class="form-horizontal" enctype="multipart/form-data">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="old_image" id="old_image">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-12">
                                <textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pan_no" class="col-sm-4 control-label">PAN No. <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="pan_no" name="pan_no"
                                    placeholder="Enter PAN Number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adhaar_no" class="col-sm-4 control-label">ADHAAR No. <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="adhaar_no" name="adhaar_no"
                                    placeholder="Enter ADHAAR Number" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-4 control-label">User Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-right" id="savedata" value="create">Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('.data-table').DataTable();

            $('#createNewPost').click(function() {
                $('#savedata').val("create-post");
                $('#id').val('');
                $('#postForm').trigger("reset");
                $('#modelHeading').html("Create New Post");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('ajaxposts.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Post");
                    $('#savedata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                    $('#pan_no').val(data.pan_no);
                    $('#adhaar_no').val(data.adhaar_no);
                    $('#old_image').val(data.image);
                })
            });

            $('#savedata').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var formData = $('#postForm')[0];
                var data = new FormData(formData);

                $.ajax({
                    data: data,
                    url: "{{ route('ajaxposts.store') }}",
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#postForm').trigger("reset");
                            $('#ajaxModelexa').modal('hide');
                            // table.draw();
                            location.reload();
                        } else {
                            $(this).html('Save User');
                            printErrorMsg(data.error);

                        }

                    },
                    error: function(data) {
                        // console.log('Error:', data);
                        $(this).html('Save User');
                        $('#savedata').html('Save Changes');
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }

            $('body').on('click', '.deletePost', function() {
                const userId = $(this).attr('data-user-id');
                var id = $(this).data("id");
                confirm("Are You sure want to delete this Post!");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('ajaxposts.store') }}" + '/' + id,
                    success: function(data) {
                        $(".data-user-id-" + userId).remove();
                        // table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection
