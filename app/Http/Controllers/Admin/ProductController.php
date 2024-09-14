<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use QCod\AppSettings\Setting\AppSettings;
class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index()
    {

        $purchase = \DB::table('purchases')->get();
        $purchases ['purchases'] = $purchase;
        return view('admin.pages.product.index',$purchases);
        
    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all Product ajax request
    |--------------------------------------------------------------------------
    */
	public function fetchAll() {
		try {
            $product = Product::all();

            // $Product = DB::table('Products as p')
            //         ->leftJoin('categories as c', function($join) {
            //             $join->on('c.id', '=', 'p.category_id');
            //         })
            //         ->leftJoin('suppliers as s', function($join) {
            //             $join->on('s.id', '=', 'p.supplier_id');
            //         })->get(['p.*','c.name as category_name','s.name as as supplier_name']);

            $output = '';
            $i = 0;
            if ($product->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle">
            <thead>
              <tr>
              <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($product as $item) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->purchase->image).'" alt="product">
                <a href="profile.html"><span>' . $item->purchase->product . '</span></a>
                </h2>
                </td>
                <td>' . $item->purchase->category->name . '</td>
                <td>' . $item->price . '</td>
                <td>' . $item->discount . '</td>
                <td>' . $item->quantity . '</td>
                <td>' . date_format(date_create($item->purchase->expiry_date),'d M, Y'). '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

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
    /*
    |--------------------------------------------------------------------------
    | handle insert a new Product ajax request
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required|max:200',
            'price'=>'required|min:1',
            'discount'=>'required',
            'quantity'=>'required',
        ]);
        $sold_product = Purchase::find($request->product);
        $price = $request->price;
        if($request->discount >0){
            $price = $request->price * (1 - $request->discount / 100);
        }
        $purchased_item = Purchase::find($sold_product->id);
        $new_quantity = ($purchased_item->quantity) - ($request->quantity);

        $newQuantity = $request->quantity;

        if ($newQuantity > 0 && $newQuantity <= $purchased_item->quantity) {
            $purchased_item->update([
                        'quantity'=>$new_quantity,
                    ]);
                    Product::create([
                            'purchase_id'=>$request->product,
                            'price'=>$price,
                            'discount'=>$request->discount,
                            'quantity'=>$request->quantity,
                            'description'=>$request->description,
                        ]);
        } else {
            // Code to execute when the condition is not met
            // dd("Failed: The new quantity is invalid");
            return response()->json([
                'status'=>'error',
                'message' => 'The new quantity is invalid'
            ], 200);
        }
        
        // $notifications = notify("Product has been added");
        return response()->json([
            'status' => 200,
        ]);
    }
     /*
    |--------------------------------------------------------------------------
    | handle edit an Product ajax request
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request)
     {
       $id = $request->id;
       $Product = Product::find($id);
       return response()->json($Product);
     }
    /*
    |--------------------------------------------------------------------------
    | handle update an Product ajax request
    |--------------------------------------------------------------------------
    */
     public function update(Request $request)
     {
        $products = Product::find($request->id);
        $this->validate($request,[
            'product'=>'required|max:200',
            'price'=>'required',
            'discount'=>'nullable',
            'description'=>'nullable|max:255',
        ]);
        
        $price = $request->price;
        if($request->discount >0){
           $price = $request->discount * $request->price;
        }
        $sold_product = Purchase::find($request->product);
        $purchased_item = Purchase::find($sold_product->id);
        $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        if (!($new_quantity < 0)){
            $purchased_item->update([
                'quantity'=>$new_quantity,
            ]);}
        $product_item = Product::find($products->id);
        // dd($product_item->quantity);
        
        $newquantity = $product_item->quantity + $request->quantity;
       $products->update([
            'purchase_id'=>$request->product,
            'price'=>$price,
            'discount'=>$request->discount,
            'quantity'=>$newquantity,
            'description'=>$request->description,
        ]);
        return response()->json([
            'status' => 200,
        ]);
     }
      /*
    |--------------------------------------------------------------------------
    | handle delete an Product ajax request
    |--------------------------------------------------------------------------
    */
    public function delete(Request $request)
    {
        try {
            
            $id = $request->id;
            $product = Product::find($request->id); 
            // dd($product->purchase_id);
            $product_qty = \DB::table('purchases')->where('id', $product->purchase_id)->first(['quantity']);
            $new_quantity =(int) $product->quantity + $product_qty->quantity;

            DB::table('purchases')
            ->where('id', $product->purchase_id)
            ->update(['quantity' => $new_quantity]);
            Product::destroy($id);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }
}
