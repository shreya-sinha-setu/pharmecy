@extends('admin.layouts.app')
@section('title','Products Outstock')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Products Outstock</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Outstock</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Outstock Products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <table id="outstock-product" class=" table table-hover table-center mb-0">
                                <thead>
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expire</th>
                                    <th class="action-btn">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Outstock Products-->
            </div>
        </div>
    </div>
    </div>
    </div>
        <div id="editProductModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Outstock</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_product_form" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Product <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" id="purchase_id" name="product">
                                            @if(!empty($purchases))
                                                @foreach ($purchases as $item)
                                                    <option value="{{$item->id}}">{{$item->product}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Quantity<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Selling Price<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="price" name="price">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Discount (%)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="discount" name="discount">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Descriptions <span class="text-danger">*</span></label>
                                        <textarea class="form-control service-desc" id="description" name="description"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_product_btn" type="submit" name="form_submit" value="submit">Submit</button>
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
        $(".sidebar-product").addClass('active');
        $(".sidebar-product_outstock").addClass('active');
    });
  </script>
    <script>
        $(document).ready(function () {
            var table = $('#outstock-product').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('product.outstock')}}",
                columns: [
                    {data: 'product', name: 'product'},
                    {data: 'category', name: 'category'},
                    {data: 'cost_price', name: 'cost_price'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'expiry_date', name: 'expiry_date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
       // edit product ajax request
       $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('product.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#id").val(response.id);
                        $("#description").val(response.description);
                        $("#discount").val(response.discount);
                        $("#price").val(response.price);
                        $("#purchase_id").val(response.purchase_id).change();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Product edit fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                });
            });

            // update product ajax request
            $("#edit_product_form").submit(function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_product_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('product.update') }}',
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
                                'Product Updated Successfully!',
                                'success'
                            )
                            location.reload();
                        }
                        $("#edit_product_btn").text('Update product');
                        $("#edit_product_form")[0].reset();
                        $("#editProductModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Product update fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                });
            });

        
    </script>
@endsection
