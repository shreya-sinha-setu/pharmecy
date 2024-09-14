@extends('admin.layouts.app')
@section('title','Sales Details')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Details</li>
                    </ul>
                </div>
                <!-- <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#generateDetails"><i
                            class="fa fa-plus"></i>Generate Details</a>
                </div> -->
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
                <!-- products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                <tr class="" style="text-align:center; ">
                                    <th style="width: 7%">SL</th>
                                    <th style="width: 25%">Customer Id</th>
                                    <th style="width: 35%">Sub Total</th>
                                    <th style="width: 35%">Discount</th>
                                    <th style="width: 35%">Total Price</th>
                                    <th style="width: 35%">Paid by</th>
                                    <th style="width: 35%">Amount Paid</th>
                                    <th style="width: 35%">Due Return</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /products-->
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- Generate Modal -->

    
    <!-- /Generate Modal -->
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-sales").addClass('active');
        $(".sidebar-sales_details").addClass('active');
    });
  </script>
<script>
    var datatable = $('.data-table').DataTable({
        order: [],
        lengthMenu: [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
        processing: true,
        responsive: true,
        serverSide: true,
        language: {
            processing: '<i class="ace-icon fa fa-spinner fa-spin bigger-500" style="font-size:60px;"></i>'
        },
        scroller: {
            loadingIndicator: false
        },
        pagingType: "full_numbers",

        ajax: {
            url: "{{route('sales.fetchAllSales')}}",
            type: "get",
        },

        columns: [
            {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false,},
            {data: 'customer_id', name: 'customer_id', orderable: true,},
            {data: 'sub_total', name: 'sub_total', orderable: true},

            {data: 'discount', name: 'discount', orderable: true,},
            {data: 'total_price', name: 'total_price', orderable: true},

            {data: 'paid_by', name: 'paid_by', orderable: true,},
            {data: 'amount_paid', name: 'amount_paid', orderable: true},
            {data: 'due_return', name: 'due_return', orderable: true},

            {data: 'action', searchable: false, orderable: false}

            //only those have manage_user permission will get access
        ],
    });
</script>
@endsection