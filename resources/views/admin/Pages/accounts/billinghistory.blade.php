@extends('admin.layouts.app')
@section('title','Billing History')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Billing History</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                        <li class="breadcrumb-item active">Billing History</li>
                    </ul>
                </div>
{{--                <div class="col-auto float-end ms-auto">--}}
{{--                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCategoriesModal"><i--}}
{{--                            class="fa fa-plus"></i> Add CashMemo</a>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Bills details -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <table id="datatable" class="table-striped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Customer Name</th>
                                        <th>Sale Id</th>
                                        <th>Product Name</th>
                                        <th>Sub Total</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Paid By</th>
                                        <th>Amount Paid</th>
                                        <th>Due Return</th>
                                        
                                    </tr>
                                  </thead>
                                  <tbody >
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($accounts as $item)
                                        <tr> 
                                            <td>{{ ++$i }}</td>
                                            <td class="text-wrap">{{ $item->name }}</td>
                                            <td class="text-wrap">{{ $item->sale_id }}</td>
                                            <td class="text-wrap">{{ $item->product }}</td>
                                            <td class="text-wrap">{{ $item->sub_total }}</td>
                                            <td class="text-wrap">{{ $item->discount }}</td>
                                            <td class="text-wrap">{{ $item->total_price }}</td>
                                            <td class="text-wrap">{{ $item->paid_by }}</td>
                                            <td class="text-wrap">{{ $item->amount_paid }}</td>
                                            <td class="text-wrap">{{ $item->due_return }}</td>
                        
                    
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-accounts").addClass('active');
        $(".sidebar-billinghistory").addClass('active');
    });
  </script>
    <script>
        $(document).ready(function() {
        $('#datatable').DataTable();
        $(function() {
            $('#status').change(function() {
                let status = $(this).prop('checked') == true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: '/baby',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log('Success');
                    }
                })
            })
        })
    });
    </script>
@endsection
