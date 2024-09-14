<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Events\PurchaseOutStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $products = Product::get();
        $customers = Customer::get();
        return view('admin.pages.sales.index',compact(
            'products','customers',
        ));
    }
   /*
    |--------------------------------------------------------------------------
    | fetchAll Product
    |--------------------------------------------------------------------------
    */
    public function fetchAll() {
		try {
            $product = Product::where('quantity', '>', '0')->get();
            // dd($product);
            $output = '';
            $i = 0;
            if ($product->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle" id="tablebtn">
            <thead>
              <tr>
              <th>S/N</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Add to cart</th>
              </tr>
            </thead>
            <tbody>';

                foreach ($product as $item) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->purchase->image).'" alt="product">
                <span>' . $item->purchase->product . '</span>
                </h2>
                </td>
                <td>' . $item->quantity . '</td>
                <td>
                <button onclick="rowAdd('.$item->id.')" price="' . $item->price . '" id="pro-'. $item->id . '" name="' . $item->purchase->product . '" class="btn btn-success text-white add_field_button"
                    title="Add"><i class="fa fa-plus"></i> Add
                    </button>
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
    /*
    |--------------------------------------------------------------------------
    | handle insert a new Sales ajax request
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
    //   dd($request->custo_id);


//     $productqty = $request->qty;
//     $productIds = $request->product_id;

//     foreach ($productIds as $productId) {
//         // Find the product by ID
//         $product = Product::find($productId);
// // dd($product->quantity);

//         // Check if the product exists and has a quantity greater than 0
//         if ($product->quantity > $productqty) {
//             // Success: Product exists, quantity is greater than 0
//             dd("Success");
//         } else {
//             // Error: Product doesn't exist or quantity is invalid
//             dd("Failed");
//         }
//     }


    $customer = DB::table('customers')->where('customer_id', $request->custo_id)->first();

    if (!$customer) {
        // Customer not found
        session()->flash('error', 'Customer not found');
    } else {
        // Customer found, proceed with the sale insertion
        $sale = DB::table('sales')->insertGetId([
            'customer_id' => $request->custo_id,
            'sub_total' => $request->sub_total,
            'discount' => $request->discount,
            'total_price' => $request->total_price,
            'paid_by' => $request->paid_by,
            'amount_paid' => $request->amount_paid,
            'due_return' => $request->due_return,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       

       $product_count = count($request->product_id);

       for ($i=0; $i < $product_count; $i++){
           DB::table('sale_details')->insert([
               'sale_id' => $sale,
               'product_id' => $request->product_id[$i],
               'quantity' => $request->qty[$i],
               'rate' => $request->rate[$i],
               'price' => $request->price[$i],
               'created_at' => now(),
               'updated_at' => now(),
           ]);

          $product_qty = DB::table('products')->where('id', $request->product_id[$i])->first(['quantity']);

          $current_qty = (int) $product_qty->quantity - $request->qty[$i];

        //   DB::table('purchases')->update([
        //       'quantity' => $current_qty,
        //   ]);
        DB::table('products')
            ->where('id', $request->product_id[$i])
            ->update(['quantity' =>  $current_qty]);
       }
      


    //    dd($sale);
    //    return redirect()->route('sales.index');
       return response()->json([
        'status' => 200,
    ]);
    }}

    /*
    |--------------------------------------------------------------------------
    | handle edit an Sales
    |--------------------------------------------------------------------------
    */
    // public function edit(Request $request)
    //  {
    //    $id = $request->id;
    //    $sale = Sale::find($id);
    //    return response()->json($sale);
    //  }
     /*
    |--------------------------------------------------------------------------
    | handle update an Sales ajax request
    |--------------------------------------------------------------------------
    */

    // public function update(Request $request ,Sale $sale)
    // {
    //     $this->validate($request,[
    //         'product'=>'required',
    //         'quantity'=>'required|integer|min:1'
    //     ]);
    //     $sold_product = Product::find($request->product);
    //     /**
    //      * update quantity of sold item from purchases
    //     **/
    //     $purchased_item = Purchase::find($sold_product->purchase->id);
    //     if(!empty($request->quantity)){
    //         $new_quantity = ($purchased_item->quantity) - ($request->quantity);
    //     }
    //     $new_quantity = $sale->quantity;
    //     if (!($new_quantity < 0)){
    //         $purchased_item->update([
    //             'quantity'=>$new_quantity,
    //         ]);
    //         /**
    //          * calcualting item's total price
    //         **/
    //         if(!empty($request->quantity)){
    //             $total_price = ($request->quantity) * ($sold_product->price);
    //         }
    //         $total_price = $sale->total_price;
    //         $sale->update([
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
    //     return redirect()->route('sales.index');
    // }

     /*
    |--------------------------------------------------------------------------
    | handle delete an Sales ajax request
    |--------------------------------------------------------------------------
    */
    // public function destroy(Request $request)
    // {
    //     return Sale::findOrFail($request->id)->delete();
    // }

 /*
    |--------------------------------------------------------------------------
    | handle get all an Sales details ajax request
    |--------------------------------------------------------------------------
    */
    public function SalesDetails()
    {
        return view('admin.pages.sales.details');
    }
      /*
    |--------------------------------------------------------------------------
    | fetchAllsales 
    |--------------------------------------------------------------------------
    */

    public function fetchAllSales(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Sale::orderBy('id', 'DESC')->get();

                return DataTables::of($data)

                    ->addIndexColumn()
                    ->addColumn('customer_id', function ($data) {
                        return $data->customer_id;
                    })
                    ->addColumn('sub_total', function ($data) {
                        return $data->sub_total;
                    })
                    ->addColumn('discount', function ($data) {
                        return $data->discount;
                    })
                    ->addColumn('total_price', function ($data) {
                        return $data->total_price;
                    })
                    ->addColumn('paid_by', function ($data) {
                        return $data->paid_by;
                    })

                    ->addColumn('amount_paid', function ($data) {
                        return $data->amount_paid;
                    })
                    ->addColumn('due_return', function ($data) {
                        return $data->due_return;
                    })

                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">' .
                            '<a id="" ' .
                            'href="' . route('cashmemo.index', ['id' => $data->customer_id, 'saleId' => $data->id]) . '" ' .
                            'class="btn btn-sm btn-success" style="cursor:pointer" title="Edit">' .
                            '<i class="fa fa-download"> Cash Memo</i>' .
                            '</a>' .
                            '</div>';
                    })
                    
                    ->rawColumns(['customer_id', 'sub_total','discount','total_price','paid_by','amount_paid','due_return', 'action'])
                    ->make(true);
            }
            return view('back-end.pages.counter.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    /*
    |--------------------------------------------------------------------------
    | handle an Sales reports view
    |--------------------------------------------------------------------------
    */
    public function reports(){
        $sales = Sale::get();
        return view('admin.pages.sales.reports',compact(
            'sales'
        ));
    }
    /*
    |--------------------------------------------------------------------------
    | handle an Sales generateReport reports view
    |--------------------------------------------------------------------------
    */
    public function generateReport(Request $request){
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $sales = Sale::whereBetween(\DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        return view('admin.pages.sales.reports',compact(
            'sales'
        ));
    }
}