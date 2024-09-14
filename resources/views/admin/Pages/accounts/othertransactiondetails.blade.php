@extends('admin.layouts.app')
@section('title','Other Transaction')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Other Transaction Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                        <li class="breadcrumb-item active">Other Transaction Details</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn btn-primary" type="button" value="Print 1st Div" onclick="javascript:printDiv('printablediv')"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                </div>
            </div>
        </div>

        <div class="card">
            </form>
            <div class="card-body" id="printablediv">
                <h2 class="text-center text-decoration-underline">Account Statement</h2>
                <div class="col-sm-10">
                <!-- <input type="button" value="Print this page" onClick="window.print()"> -->
                </div>
                <table class="datatable table table-hover table-center mb-0" id="OtherTransaction-table">
                    <thead class="thead-dark">
                        <th>No</th>
                        <th>Date</th>
                        <th>Account Head</th>
                        <th>Income</th>
                        <th>Expense</th>
                        <th>Balance</th>
                    </thead>
                    @php
                        $i=1;
                        $balance=0;
                        $originalDate=$data1;
                        $newDate = date("d/m/Y", strtotime($originalDate));
                    @endphp
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $newDate }}</td>
                            <td>Opening Balance</td>
                            <td>{{ number_format($data8,2) }}</td>
                            <td>0.00</td>
                            <td>
                                @php
                                $balance = $balance + $data8
                                @endphp
                                {{ number_format($balance,2) }}</td>
                        </tr>
    
    
                        @foreach ($data3 as $item)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$item->created_at->format('d/m/Y')}}</td>
                            <td>{{$item->account_head}}</td>
                            <td>
                                @if ($item->type == 'Income')
                                    <span class="text-success">
                                        {{ number_format($item->amount,2)}}
                                    </span>
                                @else
                                    0.00
                                @endif
                            </td>
                            <td>
                                @if ($item->type == 'Expense')
                                    <span class=" text-danger">
                                        {{ number_format($item->amount,2)}}
                                    </span>
                                    @else
                                    0.00
                                    @endif
    
                            </td>
                            <td>
                                @if ($item->type == 'Income')
                                <span class="text-success">
                                    {{-- {{  $balance  + $data3->amount}} --}}
                                    @php
                                    $balance = $balance + $item->amount
                                    @endphp
                                    {{ number_format($balance,2) }}
                                </span>
                                @elseif ($item->type == 'Expense')
                                <span class="text-danger">
                                    {{-- {{ $balance  - $data3->amount }} --}}
                                    @php
                                    $balance = $balance - $item->amount
                                    @endphp
                                    {{ number_format($balance,2) }}
                                </span>
                                @endif</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right h4">{{ number_format(($data4 + $data8),2)}}</td>
                            <td class="text-right h4">{{ number_format($data5 ,2) }}</td>
                            <td class="text-right h4"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <td colspan="3" class="h4">Gross Total/Loss</td> --}}
                            {{-- <td class="text-right h4">{{ number_format(($data4 + $data8),2)}}</td>
                            <td class="text-right h4">{{ number_format($data5 ,2) }}</td> --}}
                            <td class="text-right h4" colspan="6"> Gross Total/Loss :&emsp;&emsp;&emsp;{{ number_format($balance,2)}}</td>
                            {{-- <td class="text-right h4" colspan="6"> Gross Total/Loss :&emsp;&emsp;&emsp;{{ number_format((($data4 + $data8) - $data5),2)}} Tk</td> --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

 </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-accounts").addClass('active');
        $(".sidebar-transactionhistory").addClass('active');
    });
  </script>
    <script>
        function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;
        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }   
    </script>
@endsection