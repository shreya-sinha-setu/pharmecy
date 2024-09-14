@extends('admin.layouts.app')
@section('title','All Users')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                            class="fa fa-plus"></i> Add User</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Users -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_User">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /Users-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addUserModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" id="add_User_form" enctype="multipart/form-data">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="name" required="true">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Email</label>
							<input class="form-control" type="text" name="email">
						</div>
					</div>
				</div>

				<div class="service-fields mb-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <div class="form-group">
                                            <select class="select2 form-select form-control" name="role">
                                                <option selected>Select Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" id="password">
                                    <span class="fa fa-eye-slash mt-2" id="toggle-password" style="cursor: pointer;"> <span class="ml-2">Show Password</span></span>
                                    </div>
                                    </div>
                      
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Picture</label>
                                        <input type="file" name="avatar" class="form-control">
                                 </div>
                                </div>
                            </div>
                        </div>
				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_User_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->
    <div id="editUserModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_User_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="name" id="name">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Email</label>
							<input class="form-control" type="text" name="email" id="Email">
						</div>
					</div>
				</div>

				<div class="service-fields mb-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" type="text" name="phone" id="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <div class="form-group">
                                            <select class="select2 form-select form-control" name="role" id="role">
                                                <option selected>Select Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields">
                            <div class="row">
                           
                                    
                                <!-- <div class="form-group">
                                <input class="form-control" type="password" name="password" id="myInput" required="true">
                                    <span class="fa fa-eye-slash mt-2" onclick="myFunction()" style="cursor: pointer;"> <span class="ml-2">Show Password</span></span>
                                    </div>
                                    </div> -->
                      
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Picture</label>
                                        <input type="file" name="avatar" class="form-control" id="avatar">
                                 </div>
                                </div>
                            </div>
                        </div>
				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_User_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-users").addClass('active');
    });
  </script>
    <script>
        function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
        $(function () {
            // add new User ajax request
            $("#add_User_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_User_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('users.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'User Added Successfully!',
                                'success'
                            )
                            fetchAllUser();
                        }
                        $("#add_User_btn").text('Add User');
                        $("#add_User_form")[0].reset();
                        $("#addUserModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Add User fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });


            // edit User ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('users.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#id").val(response.id);
                        $("#name").val(response.name);
                        $("#phone").val(response.phone);
                        $("#Email").val(response.email);
                        $("#role").val(response.role).change();
                        $("#avatar").val(response.avatar);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Edit User fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // update User ajax request
            $("#edit_User_form").submit(function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_User_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('users.update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'User Updated Successfully!',
                                'success'
                            )
                            fetchAllUser();
                            location.reload();
                        }
                        $("#edit_User_btn").text('Update User');
                        $("#edit_User_form")[0].reset();
                        $("#editUserModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Update User fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // delete User ajax request
            $(document).on('click', '.deleteIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this category?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('users.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function (response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                location.reload();
                                fetchAllUser();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'User delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });

            // fetch all User ajax request
            fetchAllUser();

            function fetchAllUser() {
                $.ajax({
                    url: '{{ route('users.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_User").html(response);
                        $("table").DataTable();
                    }
                });
            }
        });
    </script>
@endsection
