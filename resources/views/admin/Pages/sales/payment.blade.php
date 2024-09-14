@extends('admin.layouts.app')
@section('title','Sales')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <!-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSalesModal"><i
                            class="fa fa-plus"></i> Add Sales</a> -->
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i
                            class="fa fa-plus"></i> Add Customer</a>
                    </a>
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
            <div class="col-md-5">

                <!-- products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_product">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>

                </div>
                <!-- /products-->
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <h4 class="text-center">Create Bill</h4>
                            <hr/>
                            <form action="#" method="POST" id="add_sale_form"
                                  enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group shadow-sm p-3 mb-5 bg-white rounded">
                                    <label for="custom_field1">Select customers</label>
                                    <input type="text" list="custom_field1_datalist" class="form-control"
                                           placeholder="Search customers" name="customer_id" required="true">
                                    <datalist id="custom_field1_datalist">
                                        @foreach ($customers as $item)
                                            <option value="{{$item->customer_id}}">{{$item->name}}</option>
                                        @endforeach
                                    </datalist>
                                    <span id="error" class="text-danger"></span>
                                </div> --}}

                                <div class="col-md-12">
                                    <label for="custo_id">Select Customer:</label>
                                    <input list="custo_id" name="custo_id" type="text" class="form-control w-100" id="customerInput" placeholder="Search customers" required>
                                    <datalist id="custo_id">
                                        @foreach ($customers->sortByDesc('id') as $item)
                                            <option value="{{ $item->customer_id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </datalist>
                                    <div id="customerNotFound" style="color: red; display: none;" class="mt-2">Customer not found</div>
                                </div>

                                <div class="table-responsive">
                                    <table>
                                        <table class="table">
                                            <thead class="shadow-sm p-3 mb-5 bg-white rounded">
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="input_fields_wrap" id="input_fields_wrap">
                                            <!-- dynamic fields -->
                                            </tbody>
                                        </table>

                                    </table>
                                    <div class="bill-sumary shadow-sm p-3 mb-5 bg-white rounded">
                                        <div class="row mx-3">
                                            <table class="table">
                                                <thead>

                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Sub Total :</td>
                                                    <td><input type="number" id="sub_total" name="sub_total"
                                                               class="form-control" step="0.01"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount :</td>
                                                    <td><input type="number" value="0" id="discount" name="discount"
                                                               class="form-control" step="0.01"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Total :</td>
                                                    <td><input type="number" id="total_price" name="total_price"
                                                               class="form-control" step="0.01"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Paid By</td>
                                                    <td>
                                                        <select class="form-control" name="paid_by" id="paid_by" required="true">
                                                            <option disabled selected value="">Select Type</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                            <option value="Bkash">Bkash</option>
                                                            <option value="Nogod">Nogod</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Amount Paid :</td>
                                                    <td><input type="number" value="0" id="amount_paid"
                                                               name="amount_paid" class="form-control" step="0.01"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Due/Return :</td>
                                                    <td><input type="number" id="due_return" name="due_return" readonly
                                                               class="form-control" step="0.01"/></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section" style="margin-top: 15px;margin-bottom: 20px;">
                                    <a type="submit" href="{{route('example1')}}"  id="add_sale_btn" class="btn btn-primary btn-block">Submit
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>

    </div>
    <!-- add customer modal -->
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
                            <button class="btn btn-primary submit-btn" id="add_Customer_btn" type="submit"
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
        $(".sidebar-sales").addClass('active');
        $(".sidebar-sales_index").addClass('active');
    });
  </script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <script>


        $(document).ready(function () {
            $('.select2').select2();
        });
        // tablebtn


        // dynamic add fields..........................................

        $(document).ready(function () {
            $('.select2').select2();
        });
        // tablebtn


        var i = 0;
        var product_arr = [];

        function rowAdd(id) {
            let name = $('#pro-' + id).attr('name');
            let price = $('#pro-' + id).attr('price');
            console.log("id", id)
            ++i;
            let isValid = product_arr.includes(id);
            if (!isValid) {
                $('#input_fields_wrap').prepend(`
                <tr id="tr-${id}">
                    <td>${name} <input type="hidden" name="product_id[]" id="product_id" value="${id}"></td>
                    <td>
                        <input type="text" class="form-control" name="qty[]" id="qty-${id}" onkeyup="calcPrice(${id})">
                    </td>
                    <td id="rate-${id}">${price} <input type="hidden" name="rate[]" id="rate-${id}" value="${price}"></td>
                    <td>
                        <input class="td-price form-control" type="text" name="price[]" readonly name="price-${id}" id="price-${id}">
                    </td>

                    <td><a href="javascript:void(0)" class="btn btn-danger text-white font-18 remove_field" onclick="remove(${id})"><i class="fa fa-trash"></i></a></td>
                </tr>
            `)
                product_arr.push(id);
            } else {
                Swal.fire(
                    '',
                    'This product alrady added',
                    'error'
                )
            }

        }

        function remove(id) {
            $('#tr-' + id).remove();
            totalCalc();
        }

        function calcPrice(id) {
            let qty = $('#qty-' + id).val();
            let rate = $('#rate-' + id).html();

            let lineTotal = parseFloat(qty) * parseFloat(rate);

            $('#price-' + id).val(lineTotal);

            totalCalc();

        }

        $('#discount ').on('keyup', function () {
            totalCalc();

        })

        $('#amount_paid ').on('keyup', function () {
            totalCalc();

        })

        function totalCalc() {
            var sum = 0;
            let discount = $('#discount').val();


            $('.td-price').each(function () {
                sum += parseFloat(this.value);
            });

            $('#sub_total').val(sum);

            let total_price = parseFloat(sum) - parseFloat(discount)
            $('#total_price').val(total_price)
            // $('#amount_paid').val(total)

            let amount_paid = $('#amount_paid').val();

            let due = total_price - parseFloat(amount_paid);
            $('#due_return').val(due);


        }


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
                            location.reload();
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

            // add new sales ajax request
           $("#add_sale_form").submit(function (e) {
                e.preventDefault();
               const fd = new FormData(this);
                $("#add_sale_btn").text('Adding...');
                $.ajax({
                   url: '{{ route('sales.store') }}',
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
                                'Sales Added Successfully!',
                                'success'
                            )
                            location.reload();
                        }
                        $("#add_sale_btn").text('Add Sale');
                        $("#add_sale_form")[0].reset();
                    },
                error: function (xhr, ajaxOptions, thrownError) {
                       // alert(xhr.status);--}}
                        Swal.fire(
                            'Sales Add fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);--}}
                    }
                });
            });
            

            // fetch all product ajax request
            fetchAllProduct();

            function fetchAllProduct() {
                $.ajax({
                    url: '{{ route('sales.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_product").html(response);
                        $("table").DataTable({});
                    }
                });
            }

        });
    </script>
    <script>
        document.getElementById('customerInput').addEventListener('input', function () {
            var input = this.value;
            var options = document.getElementById('custo_id').getElementsByTagName('option');
            var customerNotFound = document.getElementById('customerNotFound');
    
            for (var i = 0; i < options.length; i++) {
                if (options[i].value.startsWith(input)) {
                    customerNotFound.style.display = 'none';
                    return;
                }
            }
    
            customerNotFound.style.display = 'block';
        });
    </script>
@endsection
