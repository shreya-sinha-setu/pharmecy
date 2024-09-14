<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class OutStockProductController extends Controller
{
      /*
    |--------------------------------------------------------------------------
    | handle get an outstocked Products ajax request
    |--------------------------------------------------------------------------
    */

    public function outstock(Request $request){

        $purchase = DB::table('purchases')->get();
        $purchases ['purchases'] = $purchase;
        if($request->ajax()){
            $products = Product::where('quantity', '<=', 0)->get();
            return DataTables::of($products)
                ->addColumn('product',function($product){
                    $image = '';
                    if(!empty($product->purchase)){
                        $image = null;
                        if(!empty($product->purchase->image)){
                            $image = '<span class="avatar avatar-sm mr-2">
                            <img class="avatar-img" src="'.asset("storage/purchases/".$product->purchase->image).'" alt="image">
                            </span>';
                        }
                        return $image .' ' . $product->purchase->product;
                    }                 
                })
                
                ->addColumn('category',function($product){
                    $category = null;
                    if(!empty($product->purchase->category->name)){
                        $category = $product->purchase->category->name;
                    }
                    return $category;
                })
                ->addColumn('cost_price',function($product){
                    $cost_price = null;
                    if(!empty($product->price)){
                        $cost_price = $product->price;
                    }
                    return $cost_price;                 
                })
                ->addColumn('quantity',function($product){
                    if(!empty($product)){
                        return $product->quantity;
                    }
                })
                ->addColumn('expiry_date',function($product){
                    if(!empty($product->purchase)){
                        return date_format(date_create($product->purchase->expiry_date),'d M, Y');
                    }
                })
                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $btn = $editbtn;
                    return $btn;
                })
                ->rawColumns(['product','action'])
                ->make(true);
        }      
        return view('admin.pages.product.outstock',$purchases);
    }
}
