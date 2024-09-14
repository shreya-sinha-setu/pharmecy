@extends('admin.layouts.app')
@section('title','Sales Report')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#generateReport"><i
                            class="fa fa-plus"></i>Generate Report</a>
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

                <!--  sales Report -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sales-table"  class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                    <th>S/N</th>
                                    <th>Customer ID</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Total Price</th>
                                    <th>Paid By</th>
                                    <th>Amount Paid</th>
                                    <th>Due/Return</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sales as $index=>$item)
                                        @if (!(empty($item)))
                                            <tr>
                                            <td>{{$index+1}}</td>
                                                <td>{{$item->customer_id}}</td>
                                                <td>{{$item->sub_total}}</td>
                                                <td>{{$item->discount}}</td>
                                                <td>{{$item->total_price}}</td>
                                                <td>{{$item->paid_by}}</td>
                                                <td>{{$item->amount_paid}}</td>
                                                <td>{{$item->due_return}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <!-- / sales Report -->
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- Generate Modal -->

    <div id="generateReport" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sales Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- generateReport Sale -->
                    <form method="POST" action="{{route('sales.generateReport')}}">
                        @csrf
                        @method("POST")
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="date" name="from_date" class="form-control from_date">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="date" name="to_date" class="form-control to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block submit_report">Submit</button>
                    </form>
                    <!--/generateReport  Sale -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Generate Modal -->
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-reports").addClass('active');
        $(".sidebar-sales_reports").addClass('active');
    });
  </script>
    <script>
        var table = $('#sales-table').DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#sales-table_wrapper .col-md-6:eq(0)');   
    </script>
@endsection