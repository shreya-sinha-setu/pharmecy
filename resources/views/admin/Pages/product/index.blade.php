@extends('admin.layouts.app')
@section('title','Products')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Products</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                            class="fa fa-plus"></i> Add Product</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_product">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /products-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addProductModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="add_product_form" enctype="multipart/form-data">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Product <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="product">
                                            @foreach ($purchases as $purchase)
                                                <option value="{{$purchase->id}}">{{$purchase->product}}</option>
                                            @endforeach
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
                                        <input class="form-control" type="text" name="price" value="{{old('price')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Discount (%)<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="discount" value="0">
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Descriptions <span class="text-danger">*</span></label>
                                        <textarea class="form-control service-desc" name="description">{{old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
                        </div>
                    </form>
                    <!-- /Add Product -->
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->

    <div id="editProductModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
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
        $(".sidebar-product_index").addClass('active');
    });
  </script>
    <script>
        $(function()
        {
            // add new product ajax request
            $("#add_product_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_product_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('product.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire(
                                    'Product Added fails!',
                                    response.message,
                                    'error'
                                )
                                }else{
                            Swal.fire(
                                'Added!',
                                'Product Added Successfully!',
                                'success'
                            )
                            fetchAllProduct();
                        }
                        
                        $("#add_product_btn").text('Add product');
                        $("#add_product_form")[0].reset();
                        $("#addProductModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Product Add fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
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
                            fetchAllProduct();
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

            // delete product ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this product",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('product.delete') }}',
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
                                fetchAllProduct();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'Product delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });
            // fetch all product ajax request
            fetchAllProduct();
            function fetchAllProduct() {
                $.ajax({
                    url: '{{ route('product.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_product").html(response);
                        $("table").DataTable();
                    }
                });
            }
        });
    </script>
@endsection
