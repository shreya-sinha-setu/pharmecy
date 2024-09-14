<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Damage;
use App\Models\Product;
use App\Models\Purchase;
use App\Events\PurchaseOutStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DamageController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.damage.index',compact(
                    'products'
                ));
    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all Customer ajax request
    |--------------------------------------------------------------------------
    */
    public function fetchAll()
    {
        try {
            $damage = Damage::all();
            $output = '';
            $i = 0;
            if ($damage->count() > 0) {
                $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
              <th>S/N</th>
              <th>Medicine Name</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Date</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($damage as $item) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->product->purchase->image).'" alt="product">
                <a href=""><span>' . $item->product->purchase->product . '</span></a>
                </h2>
                </td>
                <td>' . $item->quantity . '</td>
                <td>' . $item->total_price . '</td>
                <td>' . date_format(date_create($item->created_at),'d M, Y') . '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                </td>
              </tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
            } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            }
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $sold_product = Product::find($request->product);
        /**update quantity of
            damag item from
         purchases
        **/
        // dd("quantity id",$sold_product->purchase_id);
        $product_item = Product::find($sold_product->id);
        // dd("quantity",$product_item->quantity);
        // dd("quantity id",$sold_product->quantity);
        $new_quantity = ($sold_product->quantity) - ($request->quantity);
        // dd("new_quantity",$product_item->quantity);
        if (!($new_quantity < 0)){
            $product_item->update([
                'quantity'=>$new_quantity,
            ]);

            /**
             * calcualting item's total price
            **/
            $total_price = ($request->quantity) * ($sold_product->price);
            Damage::create([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);
            session()->flash('success','Damaged Product Added Successfully!');
        }
        if($new_quantity <=1 && $new_quantity !=0){
            // send notification
            $product = Purchase::where('quantity', '<=', 1)->first();
            event(new PurchaseOutStock($product));
            // end of notification
            session()->flash('error','Product is running out of stock!!!');
        }
        return redirect()->route('damage.index');
    }
    /*
    |--------------------------------------------------------------------------
    | handle edit an damage ajax request
    |--------------------------------------------------------------------------
    */

    // public function edit(Request $request)
    //  {
    //    $id = $request->id;
    //    $damage = Damage::find($id);
    //    return response()->json($damage);
    //  }

 /*
    |--------------------------------------------------------------------------
    | handle update an Damage ajax request
    |--------------------------------------------------------------------------
    */

    // public function update(Request $request ,Damage $damage)
    // {
    //     $this->validate($request,[
    //         'product'=>'required',
    //         'quantity'=>'required|integer|min:1'
    //     ]);
    //     $damage_product = Product::find($request->product);
    //     /**
    //      * update quantity of sold item from purchases
    //     **/
    //     $purchased_item = Purchase::find($damage_product->purchase->id);
    //     if(!empty($request->quantity)){
    //         $new_quantity = ($purchased_item->quantity) - ($request->quantity);
    //     }
    //     $new_quantity = $damage->quantity;
    //     if (!($new_quantity < 0)){
    //         $purchased_item->update([
    //             'quantity'=>$new_quantity,
    //         ]);
    //         /**
    //          * calcualting item's total price
    //         **/
    //         if(!empty($request->quantity)){
    //             // $total_price = ($request->quantity) * ($sold_product->price);
    //         }
    //         $total_price = $damage->total_price;
    //         $damage->update([
    //             'product_id'=>$request->product,
    //             'quantity'=>$request->quantity,
    //             'total_price'=>$total_price,
    //         ]);

    //         session()->flash('success','Product has been updated');
    //     }
    //     if($new_quantity <=1 && $new_quantity !=0){
    //         // send notification
    //         $product = Purchase::where('quantity', '<=', 1)->first();
    //         event(new PurchaseOutStock($product));
    //         // end of notification
    //         session()->flash('error','Product is running out of stock!!!');

    //     }
    //     return redirect()->route('damage.index');
    // }



    
     /*
    |--------------------------------------------------------------------------
    | handle delete an Damage ajax request
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $damage_product = Damage::find($request->id); 
            // dd($damage_product->product_id);
            $product_qty = \DB::table('products')->where('id', $damage_product->product_id)->first(['quantity']);
            // dd("quantity",$damage_product->quantity);
            // dd("product_qty",$product_qty);
            // $product_id = \DB::table('purchases')->where('id', $damage_product->product_id);
            $new_quantity =(int) $damage_product->quantity + $product_qty->quantity;
            // dd($new_quantity);
            DB::table('products')
            ->where('id', $damage_product->product_id)
            ->update(['quantity' => $new_quantity]);

            // DB::table('purchases')->update([
            //     'quantity' => $new_quantity,
            // ]);
            Damage::destroy($id);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }
    
/*
    |--------------------------------------------------------------------------
    | handle an Sales reports view
    |--------------------------------------------------------------------------
    */
    public function reports(){
        $damage = Damage::get();
        return view('admin.pages.damage.reports',compact(
            'damage'
        ));
    }
    /*
    |--------------------------------------------------------------------------
    | handle an Sales generateReport reports view
    |--------------------------------------------------------------------------
    */
    public function generateReport(Request $request){
        // dd($request);
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $damage = Damage::whereBetween(\DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        // dd($damage);
        return view('admin.pages.damage.reports',compact(
            'damage'
        ));
    }
     
    
}

