@extends('admin.layouts.app')
@section('title','Customer')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Customer</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i
                            class="fa fa-plus"></i> Add Customer</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Customers -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_Customer">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /Customers-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addCustomerModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" id="add_Customer_form" enctype="multipart/form-data">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Customer ID<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="customer_id" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                            <label>Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" required="true">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Phone<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="phone" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" id="email" required="true">
							</div>
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Due</label>
                                <input type="text" name="due" class="form-control" required="true">
                            </div>
                        </div>
                    </div>
				</div>

				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_Customer_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->

    <div id="editCustomerModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Customer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_Customer_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Customer ID<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="customer_id" id="customer_id" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="name" id="name" required="true">
							</div>
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
                        <label>Email</label>
							<input class="form-control" type="email" name="email" id="Email" required="true">
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Phone<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="phone" id="phone" required="true">
							</div>
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-6">
                        <div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class="form-control" id="address" required="true">
							</div>
						</div>
                        <div class="col-6">
                        <div class="form-group">
								<label>Due</label>
								<input type="text" name="due" class="form-control" id="due" required="true">
							</div>
						</div>
					</div>
				</div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_Customer_btn" type="submit"
                                    name="form_submit" value="submit">Submit
                            </button>
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
     $(".sidebar-customer").addClass('active');
  });    
</script>
    <script>
        $(function () {
            // add new Customer ajax request
            $("#add_Customer_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_Customer_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('customer.store') }}',
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
                                'Customer Added Successfully!',
                                'success'
                            )
                            fetchAllCustomer();
                        }
                        $("#add_Customer_btn").text('Add Customer');
                        $("#add_Customer_form")[0].reset();
                        $("#addCustomerModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Add Customer fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });


            // edit Customer ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('customer.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#id").val(response.id);
                        $("#customer_id").val(response.customer_id);
                        $("#name").val(response.name);
                        $("#phone").val(response.phone);
                        $("#Email").val(response.email);
                        $("#address").val(response.address);
                        $("#due").val(response.due);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Edit Customer fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // update Customer ajax request
            $("#edit_Customer_form").submit(function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_Customer_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('customer.update') }}',
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
                                'Customer Updated Successfully!',
                                'success'
                            )
                            fetchAllCustomer();
                        }
                        $("#edit_Customer_btn").text('Update Customer');
                        $("#edit_Customer_form")[0].reset();
                        $("#editCustomerModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Update Customer fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // delete Customer ajax request
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
                            url: '{{ route('customer.delete') }}',
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
                                fetchAllCustomer();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'Customer delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });

            // fetch all Customer ajax request
            fetchAllCustomer();

            function fetchAllCustomer() {
                $.ajax({
                    url: '{{ route('customer.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_Customer").html(response);
                        $("table").DataTable();
                    }
                });
            }
        });
    </script>
@endsection
