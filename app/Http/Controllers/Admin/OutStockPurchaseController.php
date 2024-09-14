<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OutStockPurchaseController extends Controller
{
      /*
    |--------------------------------------------------------------------------
    | handle get an outstocked Products ajax request
    |--------------------------------------------------------------------------
    */

    public function outstock(Request $request){
        $category = DB::table('categories')->get();
        $supplier = DB::table('suppliers')->get();
        $categories ['categories'] = $category;
        $suppliers ['suppliers'] = $supplier;
        if($request->ajax()){
            $products = Purchase::where('quantity', '<=', 0)->get();
            return DataTables::of($products)
                ->addColumn('product',function($product){
                    $image = '';
                    if(!empty($product->image)){
                        $image = null;
                        if(!empty($product->image)){
                            $image = '<span class="avatar avatar-sm mr-2">
                            <img class="avatar-img" src="'.asset("storage/purchases/".$product->image).'" alt="image">
                            </span>';
                        }
                        return $image .' ' . $product->product;
                    }                 
                })
                
                ->addColumn('category',function($product){
                    $category = null;
                    if(!empty($product->category)){
                        $category = $product->category->name;
                    }
                    return $category;
                })
                ->addColumn('cost_price',function($product){
                    $cost_price = null;
                    if(!empty($product->cost_price)){
                        $cost_price = $product->cost_price;
                    }
                    return $cost_price;                 
                })
                ->addColumn('quantity',function($product){
                    if(!empty($product)){
                        return $product->quantity;
                    }
                })
                ->addColumn('expiry_date',function($product){
                    if(!empty($product->expiry_date)){
                        return date_format(date_create($product->expiry_date),'d M, Y');
                    }
                })
                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPurchaseModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a href="#" id="' . $row->id . '" name="' . $row->product   .'" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['product','action'])
                ->make(true);
        }      
        return view('admin.pages.purchase.outstock', $categories,$suppliers);
    }
}
