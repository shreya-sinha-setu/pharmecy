@extends('admin.layouts.app')
@section('title','Supplier')
@section('content')
<div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Supplier</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Supplier</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSupplierModal"><i
                                    class="fa fa-plus"></i> Add Supplier</a>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">

                    <!-- Suppliers -->
                    <div class="card">
					<div class="table-responsive">
					<div class="card-body" id="show_all_supplier">
           		 <h3 class="text-center text-secondary my-5">Loading...</h3>
          		</div>
                    </div>
                    <!-- /Suppliers-->
                    </div>
                </div>
				</div>
            </div>

            </div>
            <div id="addSupplierModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Supplier</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
						<form action="#" method="POST" id="add_supplier_form" enctype="multipart/form-data">
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
							<label>Email<span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="email" id="email" required="true">
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
							<label>Company<span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="company" required="true">
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Address <span class="text-danger">*</span></label>
								<input type="text" name="address" class="form-control" required="true">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Product <span class="text-danger">*</span></label></label>
							<input type="text" name="product" class="form-control" required="true">
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
							<label>Comment</label>
							<textarea name="comment" class="form-control" cols="30" rows="10"></textarea>
						</div>
					</div>
				</div>

				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_supplier_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add end -->

            <div id="editSupplierModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Supplier</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
						<form action="#" method="POST" id="edit_supplier_form" enctype="multipart/form-data">
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
							<input class="form-control" type="text" name="email" id="Email" >
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Phone</label>
								<input class="form-control" name="phone" type="text" id="phone">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Company</label>
							<input class="form-control" name="company" type="text" id="company">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Address</label>
								<input type="text" id="address" name="address" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Product</label>
							<input type="text" id="product" name="product" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
							<label>Comment</label>
							<textarea id="comment" name="comment" class="form-control" cols="30" rows="10"></textarea>
						</div>
					</div>
				</div>

				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="edit_supplier_btn" type="submit" name="form_submit" value="submit">Submit</button>
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
       $(".sidebar-supplier").addClass('active');
    });    
</script>
<script>
	$(function()
	{
		// add new supplier ajax request
		$("#add_supplier_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_supplier_btn").text('Adding...');
        $.ajax({
          url: '{{ route('supplier.store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Supplier Added Successfully!',
                'success'
              )
              fetchAllSupplier();
            }
            $("#add_supplier_btn").text('Add Supplier');
            $("#add_supplier_form")[0].reset();
            $("#addSupplierModal").modal('hide');
          },
        })
      });


	  // edit supplier ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('supplier.edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#product").val(response.product);
            $("#name").val(response.name);
            $("#Email").val(response.email);
            $("#phone").val(response.phone);
            $("#address").val(response.address);
            $("#id").val(response.id);
            $("#company").val(response.company);
			      $("#comment").val(response.comment);
          }
        });
      });

      // update supplier ajax request
      $("#edit_supplier_form").submit(function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        const fd = new FormData(this);
        $("#edit_supplier_btn").text('Updating...');
        $.ajax({
          url: '{{ route('supplier.update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Supplier Updated Successfully!',
                'success'
              )
              fetchAllSupplier();
            }
            $("#edit_supplier_btn").text('Update Supplier');
            $("#edit_supplier_form")[0].reset();
            $("#editSupplierModal").modal('hide');
          }
        });
      });

	   // delete supplier ajax request
	   $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('supplier.delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllSupplier();
              }
            });
          }
        })
      });

		 // fetch all supplier ajax request
		 fetchAllSupplier();

		function fetchAllSupplier() {
		$.ajax({
			url: '{{ route('supplier.fetchAll') }}',
			method: 'get',
			success: function(response) {
			$("#show_all_supplier").html(response);
			$("table").DataTable({
				// order: [0, 'desc']
			});
			}
		});
		}
	});
</script>
@endsection
