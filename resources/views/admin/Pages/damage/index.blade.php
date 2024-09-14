@extends('admin.layouts.app')
@section('title','Damages')
@section('content')
<div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Damages</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Damages</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSalesModal"><i
                                    class="fa fa-plus"></i> Add Damages</a>
                        </div>
                    </div>
                </div>
                @if(!empty($notification))
                                      @foreach ($notification as $item)
                                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{item}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                      @endforeach
                                    @endif
                        <div class="row">
                            <div class="col-md-12">

                              <!--  damage -->
                             
                            <div class="card">
                                <div class="table-responsive">
                                    <div class="card-body" id="show_all_Damage">
                                        <h3 class="text-center text-secondary my-5">Loading...</h3>
                                    </div>
                                </div>
                               
                            </div>

		                      <!-- / damage -->
                    </div>
                </div>
				</div>
            </div>

            </div>
            <div id="addSalesModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Damage</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
						 <!-- Create Damage -->
             <form method="POST" action="{{route('damage.store')}}">
					@csrf
					<div class="row form-row">
						<div class="col-12">
							<div class="form-group">
								<label>Product <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="product">
                <option disabled selected > Select Product</option>
									@foreach ($products as $product)
										@if (!empty($product->purchase))
											@if (!($product->quantity <= 0))
												<option value="{{$product->id}}">{{$product->purchase->product}}</option>
											@endif
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" value="1" class="form-control" name="quantity">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Save Damage Product</button>
				</form>
                <!--/ Create damage -->
				       </div>
                    </div>
                </div>
            </div>

            <!-- add end -->

            <!-- <div id="editDamageModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Damage</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                              
                              <form method="post" enctype="multipart/form-data" id="edit_sales_form" autocomplete="off">
                          @csrf
                          @method("POST")
                          <input type="hidden" name="id" id="id" value="id">
                            <div class="row form-row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Product <span class="text-danger">*</span></label>
                                  <select class="select2 form-select form-control" id="product_id"  name="product">
                                      @foreach ($products as $product)
                                        @if (!empty($product->purchase))
                                          @if (!($product->purchase->quantity <= 0))
                                            <option value="{{$product->id}}">{{$product->purchase->product}}</option>
                                          @endif
                                        @endif
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" class="form-control" id="quantity" name="quantity">
                                </div>
                              </div>
                            </div>
                            <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_sales_btn" type="submit" >Submit</button>
                          </div>
                          </form>
                                
                        </div>
                    </div>
                </div>
            </div> -->

@endsection
@section('script')
<script>
    $(document).ready(function () {
     $(".sidebar-damage").addClass('active');
  });    
</script>
   <script>
    	$(function()
	{
    $(document).ready(function() {
        var table = $('#outstock-product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('damage.index')}}",
            columns: [
                {data: 'S/N', name: 'S/N'},
                {data: 'product', name: 'product'},
                {data: 'quantity', name: 'quantity'},
                {data: 'total_price', name: 'total_price'},
				{data: 'date', name: 'date'},
                {data: 'action', name: 'action',  orderable: false, searchable: false},
            ]
        });

    });

    // edit sales ajax request
    // $(document).on('click', '.editIcon', function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('id');
    //     $.ajax({
    //       url: '{{ route('damage.edit') }}',
    //       method: 'get',
    //       data: {
    //         id: id,
    //         _token: '{{ csrf_token() }}'
    //       },
    //       success: function(response) {
    //         $("#id").val(response.id);
    //         $("#product_id").val(response.product_id).change();
    //         $("#quantity").val(response.quantity);
    //       },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             // alert(xhr.status);
    //             Swal.fire(
    //                 'Damage edit fails!',
    //                 thrownError,
    //                 'error'
    //             )
    //             // alert(thrownError);
    //         }
    //     });
    //   });

      // update sales ajax request
    //   $("#edit_sales_form").submit(function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('id');
    //     const fd = new FormData(this);
    //     $("#edit_Purchase_btn").text('Updating...');
    //     $.ajax({
    //       url: '{{ route('damage.update') }}',
    //       method: 'post',
    //       data: fd,
    //       cache: false,
    //       contentType: false,
    //       processData: false,
    //       dataType: 'json',
    //       success: function(response) {
    //         if (response.status == 200) {
    //           Swal.fire(
    //             'Updated!',
    //             'Damage Product Updated Successfully!',
    //             'success'
    //           )
    //           window.location.reload();
    //         }
    //         $("#edit_sales_btn").text('Update sales');
    //         $("#edit_sales_form")[0].reset();
    //         $("#editSalesModal").modal('hide');
    //       },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             // alert(xhr.status);
    //             Swal.fire(
    //                 'Damage Product update fails!',
    //                 thrownError,
    //                 'error'
    //             )
    //             // alert(thrownError);
    //         }
    //     });
    //   });

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
                            url: '{{ route('damage.delete') }}',
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
                                fetchAllDamage();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'Damage delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });
      // fetch all damage ajax request
      fetchAllDamage();

      function fetchAllDamage() {
          $.ajax({
              url: '{{ route('damage.fetchAll') }}',
              method: 'get',
              success: function (response) {
                  $("#show_all_Damage").html(response);
                  $("table").DataTable();
              }
          });
      }
	});
    </script>
@endsection
