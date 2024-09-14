@extends('admin.layouts.app')
@section('title','Invoice')
@section('content')
<div class="content container-fluid">

    <div class="card">
  <div class="card-body" id="printableContent">
    <div class="mb-5 mt-3">
      <div class="px-4">
        <div class="col-md-12">
          <div class="text-center">
          <h2>Pharmacy Medicine Corner,Uttara</h2>
            <p>Road-2, Sector-3, Uttara, Dhaka</p>
            <p>Mob No : 0172XXXXXXXX</p>
            <h2>Cash Memo</h2>
          </div>

        </div>

        
        <div class="row">
            <div class="d-flex justify-content-between">
          <div>
            <ul class="list-unstyled">
              <li class="fw-bold">Bill No: # {{$sales->saleId}}</li>
              <li class="fw-bold">Customer No: {{$sales->customer_id}}</li>
              {{-- <li class="fw-bold">Name : </li> --}}
              <li class="fw-bold">Date/Time: {{ \Carbon\Carbon::parse($sales->created_at)->format('Y-m-d h:i:s A') }}</li>             
            </ul>
          </div>
          {{-- <div>
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#123-456</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Creation Date: </span>Jun 23,2021</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  Unpaid</span></li>
            </ul>
          </div> --}}
        </div>
        </div>

        <div class="row my-2 justify-content-center">
            <div class="table-responsive">
                <table class="table align-middle">
                <thead>
                <tr>
                <th style="width: 70px;">No.</th>
                <th>Item</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th class="text-end" style="width: 120px;">Total</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($saledetails as $item)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{$item->rate}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                  </tr>
                @endforeach
                
    
                <tr>
                <th scope="row" colspan="4" class="text-end">Sub Total :</th>
                <td class="text-end">{{$sales->sub_total}}</td>
                </tr>
                <hr>
                <tr>
                <th scope="row" colspan="4" class="border-0 text-end">
                Discount :</th>
                <td class="border-0 text-end">- {{$sales->discount}}</td>
                </tr>
                <th scope="row" colspan="4" class="border-0 text-end">
                  Paid By :</th>
                  <td class="border-0 text-end"> {{$sales->paid_by}}</td>
                  </tr>
                <tr>
                <th scope="row" colspan="4" class="border-0 text-end">Total :</th>
                <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{$sales->total_price}}</h4></td>
                </tr>
                <tr>
                  <th scope="row" colspan="4" class="border-0 text-end">Amount Paid :</th>
                  <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{$sales->amount_paid}}</h4></td>
                  </tr>
                
                <tr>
                  <th scope="row" colspan="4" class="border-0 text-end">Amount Due/Return :</th>
                  <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{$sales->due_return}}</h4></td>
                  </tr>
                
                </tbody>
                </table>
                </div>
                <div>
                  <p> <span><u>{{ Auth::user()->name }}</u></span> <br> Received By</p>
                </div>
                <hr>
                <div>
                  <p>Thank you for your purchase</p>
                </div>
                
                <div class="d-print-none mt-4">
                <div class="float-end">
                <a href="javascript:window.print()" onclick="printContent()" class="btn btn-success me-1" id="print"><i class="fa fa-print"></i> Print</a>
                <button id="download-pdf" class="btn btn-success me-1"><i class="fa fa-download"></i> Download PDF</button>
                </div>
                </div>
                </div>
                
        </div>
      </div>
    </div>
  </div>
</div>         

</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
  function printContent() {
      var contentToPrint = document.getElementById('printableContent').innerHTML;
      var originalContent = document.body.innerHTML;

      document.body.innerHTML = contentToPrint;

      window.print();

      // Restore the original content
      document.body.innerHTML = originalContent;
  }
</script>
<script>
  window.onload = function () {
    document.getElementById("download-pdf")
        .addEventListener("click", () => {
            const printableContent = this.document.getElementById("printableContent");
            console.log(printableContent);
            console.log(window);
            var opt = {
                margin: 0.2,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            // html2pdf().from(printableContent).set(opt).save();

            html2pdf().from(printableContent).set(opt).outputPdf().then(function(pdf) {
              html2pdf().from(printableContent).set(opt).save();
          // Hide the button after the PDF is generated and saved
          document.getElementById("download-pdf").style.display = "none";
          document.getElementById("print").style.display = "none";
          setTimeout(function () {
            location.reload();
      }, 500);
        });
        
        })
}
</script>
@endsection

