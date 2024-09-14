<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleDetails;
use DB;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($id,$saleId)
    {
        // $sales = DB::table('sales')
        // ->where('customer_id', $id)
        // ->where('id',$saleId)
        // ->first();


    $sales = DB::table('sales as s')
    ->where('s.customer_id', $id)
    ->where('s.id', $saleId)
    ->leftjoin('sale_details as d', 's.id', '=', 'd.sale_id')
    ->first([
        's.*',
        'd.sale_id as saleId',
    ]);

// dd($sales);

        $saleId = $sales->id;

        $purchase = Purchase::all();

        $saledetails = DB::table('sale_details as s')
            ->where('sale_id', $saleId)
            ->leftjoin('purchases as p', 's.product_id', '=', 'p.id')
            ->get(['s.*', 'p.product as product_name']);

        // dd($saledetails);
         
        return view('admin.pages.invoice.index',compact('sales','saledetails'));

    }
}
