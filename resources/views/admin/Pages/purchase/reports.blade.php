
@extends('admin.layouts.app')
@section('title','Purchase Report')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Purchase Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase Report</li>
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

                <!--  Purchase Report -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="purchase-table"  class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                    <th>S/N</th>
                                        <th>Medicine Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Purchase Cost</th>
                                        <th>Quantity</th>
                                        <th>Expire Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($purchases as $index=>$item)
                                        @if (!(empty($item)))
                                            <tr>
                                            <td>{{$index+1}}</td>
                                                <td>
                                                    @if (!empty($item->image))
                                                        <span class="avatar avatar-sm mr-2">
                                                    <img class="avatar-img" src="{{asset("storage/purchases/".$item->image)}}" alt="image">
                                                    </span>
                                                    @endif
                                                    {{$item->product}}
                                                </td>
                                                <td>{{$item->category->name}}</td>
                                                <td>{{$item->supplier->name}}</td>
                                                <td>{{$item->cost_price}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{date_format(date_create($item->expiry_date),"d M, Y")}}</td>

                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <!-- / Purchase Report -->
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
                    <h5 class="modal-title">Purchase Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- generateReport Sale -->
                    <form method="POST" action="{{route('purchase.generateReport')}}">
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
        $(".sidebar-purchase_reports").addClass('active');
    });
  </script>
    <script>
        var table = $('#purchase-table').DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#purchase-table_wrapper .col-md-6:eq(0)');   
    </script>
@endsection
