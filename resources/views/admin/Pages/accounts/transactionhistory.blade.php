@extends('admin.layouts.app')
@section('title','Transaction History')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Transaction History</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                        <li class="breadcrumb-item active">Transaction History</li>
                    </ul>
                
        </div>
    </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">Account Statement Over a Specified Period</h2>
            
            <form action={{route('other.transection.ledgerdetails')}}>

                  <div class="form-group ">
                    <label for="datepicker" class="text-dark">From Date</label>
                    <input type="date" required class="form-control border border-primary" name="from" id="from">
                  </div>
                  <div class="form-group">
                    <label for="datepicker" class="text-dark">To Date</label>
                    <input type="date" required class="form-control border border-primary" name="to" id="to">
                  </div>


                  <div class="text-right">
                    <button  type="submit"  class="btn btn-dark" >Report</button>
                  </div>

            </form>
        </div>
    </div>
</div>


   


<script>
    $(document).ready(function () {
    minDate = new DateTime($('#from'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#to'), {
                format: 'YYYY-MM-DD'
            });
});
</script>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-accounts").addClass('active');
        $(".sidebar-transactionhistory").addClass('active');
    });
  </script>
@endsection
