@extends('admin.layouts.app')
@section('title','Inventory')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Inventory</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addInventoryModal"><i
                            class="fa fa-plus"></i> Add Inventory</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Inventorys -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_Inventory">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /Inventorys-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addInventoryModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Inventory</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" id="add_Inventory_form" enctype="multipart/form-data">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">	
                        <div class="form-group">
                        <label>Product Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="product_name" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                            <div class="form-group">
								<label>Shope Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="shope_name" required="true">
							</div>
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
                        <div class="form-group">
                            <label>Quantity<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" value=0 name="quantity" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
                                <label>Amount<span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control" value=0 required="true">
                            </div>
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
                    <div class="row">
                
                        <div class="col-lg-6">
                        <div class="form-group">
                                        <label>Purchase Date<span class="text-danger">*</span><span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="purchase_date">
                                    </div>
                        </div>
                    </div>
				</div>

				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_Inventory_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->

    <div id="editInventoryModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Inventory</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_Inventory_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Product Name</label>
								<input class="form-control" type="text" name="product_name" id="product_name" required="true">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Shope Name</label>
							<input class="form-control" type="text" name="shope_name" id="shope_name" required="true">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Quantity</label>
								<input class="form-control" type="number" name="quantity" id="quantity" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Amount</label>
								<input type="number" name="amount" class="form-control" id="amount" required="true">
							</div>
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-6">
                        <div class="form-group">
                                        <label>Purchase Date<span class="text-danger">*</span></label>
                                        <input class="form-control" value="" id="purchase_date" type="date"
                                               name="purchase_date">
                                    </div>
					</div>
				</div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_Inventory_btn" type="submit"
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
     $(".sidebar-inventory").addClass('active');
  });    
</script>
    <script>
        $(function () {
            // add new Inventory ajax request
            $("#add_Inventory_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_Inventory_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('inventory.store') }}',
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
                                'Inventory Added Successfully!',
                                'success'
                            )
                            fetchAllInventory();
                        }
                        $("#add_Inventory_btn").text('Add Inventory');
                        $("#add_Inventory_form")[0].reset();
                        $("#addInventoryModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Add Inventory fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });


            // edit Inventory ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('inventory.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#id").val(response.id);
                        $("#product_name").val(response.product_name);
                        $("#shope_name").val(response.shope_name);
                        $("#quantity").val(response.quantity);
                        $("#amount").val(response.amount);
                        $("#purchase_date").val(response.purchase_date);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Edit Inventory fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // update Inventory ajax request
            $("#edit_Inventory_form").submit(function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_Inventory_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('inventory.update') }}',
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
                                'Inventory Updated Successfully!',
                                'success'
                            )
                            fetchAllInventory();
                        }
                        $("#edit_Inventory_btn").text('Update Inventory');
                        $("#edit_Inventory_form")[0].reset();
                        $("#editInventoryModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Update Inventory fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // delete Inventory ajax request
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
                            url: '{{ route('inventory.delete') }}',
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
                                fetchAllInventory();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'Inventory delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });

            // fetch all Inventory ajax request
            fetchAllInventory();

            function fetchAllInventory() {
                $.ajax({
                    url: '{{ route('inventory.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_Inventory").html(response);
                        $("table").DataTable();
                    }
                });
            }
        });
    </script>
@endsection
