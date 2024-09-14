<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use Illuminate\Support\Carbon;
use App\Models\Payment;
class AccountsController extends Controller
{

    //index view.........................
    public function index()
    {
        $accounts = Payment::get();
        return view('admin.pages.accounts.index',compact('accounts'));
    }
    // BillingHistoryindex index view.........................
    public function BillingHistoryindex()
    {
        // $accounts = Sale::all();
       $accounts = DB::table('sales')
       ->join('sale_details','sales.id','=','sale_details.sale_id')
       ->join('customers','sales.customer_id','customers.customer_id')
       ->join('purchases','sale_details.product_id','purchases.id')
       ->get();

        return view('admin.Pages.accounts.billinghistory',compact('accounts'));
       // return $accounts;
    
    }


    // OtherTransactionIndex index view.........................
    public function OtherTransactionIndex()
    {
        return view('admin.pages.accounts.othertransaction');
    }

    // TransactionHistoryIndex index view.........................
    public function TransactionHistoryIndex()
    {
        return view('admin.pages.accounts.transactionhistory');
    }


    // BarcodeScanning index view...........................................
    public function BarcodeScanning()
    {
        return view('admin.pages.accounts.barcodescanning');
    }
    // CashMemo index view...........................................
    public function CashMemo()
    {
        return view('admin.pages.accounts.cashmemo');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'account_head' => 'required',
            'amount' => 'required|integer',
            ]);
        $payments = new Payment;
        $payments->type = $request->type;
        $payments->account_head = $request->account_head;
        $payments->amount = $request->amount;
        $payments->date = date('y-m-d');

        $maincompany = Sale::where('id', 1)->first();
        if($request->type == 'Income'){
            $maincompany->total_price = $maincompany->total_price + $request->amount;
        }
        elseif($request->type == 'Expense'){
            $maincompany->total_price = $maincompany->total_price - $request->amount;
        }

        $maincompany->update();
        $payments->save();
        return response()->json($payments);
    }

   
    public function ledgerdetails(Request $request)
    {
        $data1 = $request->input('from');
        $data2 = $request->input('to');

        $data3 = Payment::whereBetween('date', [$data1, $data2])
            ->orderBy('date')->get();

        $data4 = Payment::where('type', 'Income')
            ->whereBetween('date', [$data1, $data2])
            ->orderBy('date')
            ->get()
            ->sum('amount');

        $data5 = Payment::where('type', 'Expense')
            ->whereBetween('date', [$data1, $data2])
            ->orderBy('date')
            ->get()
            ->sum('amount');

        $previousdate = Carbon::createFromDate($request->input('from'))->subDays();
        $data6 = Payment::where('type','Income')
        ->whereBetween('date',['2000-01-01',$previousdate])
        ->get()
        ->sum('amount');

        $data7 = Payment::where('type','Expense')
        ->whereBetween('date',['2000-01-01',$previousdate])
        ->orderBy('date')
        ->get()
        ->sum('amount');

        $data8 = $data6 - $data7;

        return view('admin.Pages.accounts.othertransactiondetails', compact('data1','data3','data8','data4','data5' ));
    }

    

}
