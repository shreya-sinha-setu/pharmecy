@extends('admin.layouts.app')
@section('title','Purchase')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Purchase</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addPurchaseModal"><i
                            class="fa fa-plus"></i> Add Purchase</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Purchases -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_Purchase">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /Purchases-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addPurchaseModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Purchase</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="add_Purchase_form" autocomplete="off">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Medicine Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="product">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="category">
                                            <option value="" selected>Select Category</option>
                                            @if(!empty($categories))
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{$item->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Supplier <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="supplier"
                                                id="show_get_Purchase">
                                            <option value="" selected>Select Supplier</option>
                                            @if(!empty($suppliers))
                                                @foreach ($suppliers as $item)

                                                    <option value="{{ $item->id }}"> {{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Cost Price<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="cost_price">
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
                                        <label>Expire Date<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="expiry_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Medicine Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="add_Purchase_btn" type="submit">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->

    <div id="editPurchaseModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Purchase</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="edit_Purchase_form" autocomplete="off">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Medicine Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="product" name="product">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" id="category_id"
                                                name="category">
                                            <option value="">Select</option>
                                            @if(!empty($categories))
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Supplier <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" id="supplier_id"
                                                name="supplier">
                                            @if(!empty($suppliers))
                                                @foreach ($suppliers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Cost Price<span class="text-danger">*</span></label>
                                        <input class="form-control" id="cost_price" type="text" name="cost_price">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Quantity<span class="text-danger">*</span></label>
                                        <input class="form-control" id="quantity" type="text" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Expire Date<span class="text-danger">*</span></label>
                                        <input class="form-control" value="" id="expiry_date" type="date"
                                               name="expiry_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Medicine Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_Purchase_btn" type="submit">Submit
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
        $(".sidebar-purchase").addClass('active');
        $(".sidebar-purchase_index").addClass('active');
    });
  </script>
    <script>
        $(function () {
// add new Purchase ajax request
            $("#add_Purchase_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_Purchase_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('purchase.store') }}',
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
                                'Purchase Added Successfully!',
                                'success'
                            )
                            fetchAllPurchase();
                        }
                        $("#add_Purchase_btn").text('Add Purchase');
                        $("#add_Purchase_form")[0].reset();
                        $("#addPurchaseModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Purchase add fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });

            // edit Purchase ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('purchase.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#id").val(response.id);
                        $("#product").val(response.product);
                        $("#category_id").val(response.category_id).change();
                        $("#supplier_id").val(response.supplier_id).change();
                        $("#cost_price").val(response.cost_price);
                        $("#quantity").val(response.quantity);
                        $("#expiry_date").val(response.expiry_date);
                        $("#image").val(response.image);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Purchase edit fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                });
            });

            // update Purchase ajax request
            $("#edit_Purchase_form").submit(function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_Purchase_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('purchase.update') }}',
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
                                'Purchase Updated Successfully!',
                                'success'
                            )
                            fetchAllPurchase();
                        }
                        $("#edit_Purchase_btn").text('Update Purchase');
                        $("#edit_Purchase_form")[0].reset();
                        $("#editPurchaseModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Purchase update fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                });
            });

            // delete Purchase ajax request
            $(document).on('click', '.deleteIcon', function (e) {
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
                            url: '{{ route('purchase.delete') }}',
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
                                fetchAllPurchase();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // alert(xhr.status);
                                Swal.fire(
                                    'Purchase delete fails!',
                                    thrownError,
                                    'error'
                                )
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });

            // fetch all Purchase ajax request
            fetchAllPurchase();

            function fetchAllPurchase() {
                $.ajax({
                    url: '{{ route('purchase.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_Purchase").html(response);
                        $("table").DataTable();
                    }
                });
            }
        });
    </script>
@endsection
