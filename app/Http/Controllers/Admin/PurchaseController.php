<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PurchaseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $category = DB::table('categories')->get();
        $supplier = DB::table('suppliers')->get();
        $categories ['categories'] = $category;
        $suppliers ['suppliers'] = $supplier;
        return view('admin.pages.purchase.index',$categories,$suppliers);

    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all Purchase ajax request
    |--------------------------------------------------------------------------
    */
	public function fetchAll() {
		try {
            $purchase = Purchase::all();

            // $purchase = DB::table('purchases as p')
            //         ->leftJoin('categories as c', function($join) {
            //             $join->on('c.id', '=', 'p.category_id');
            //         })
            //         ->leftJoin('suppliers as s', function($join) {
            //             $join->on('s.id', '=', 'p.supplier_id');
            //         })->get(['p.*','c.name as category_name','s.name as as supplier_name']);

            $output = '';
            $i = 0;
            if ($purchase->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle">
            <thead>
              <tr>
              <th>S/N</th>
                <th>Medicine Name</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Purchase Cost</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($purchase as $item) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->image).'" alt="product">
                <a href=""><span>' . $item->product . '</span></a>
                </h2>
                </td>
                <td>' . $item->category->name . '</td>
                <td>' . $item->supplier->name . '</td>
                <td>' . $item->cost_price . '</td>
                <td>' . $item->quantity . '</td>
                <td>' . date_format(date_create($item->expiry_date),'d M, Y'). '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPurchaseModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

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
    | handle insert a new Purchase ajax request
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required|max:200',
            'category'=>'required',
            'cost_price'=>'required|min:1',
            'quantity'=>'required|min:1',
            'expiry_date'=>'required',
            'supplier'=>'required',
        ]);
        $imageName = null;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/purchases'), $imageName);
        }
        Purchase::create([
            'product'=>$request->product,
            'category_id'=>$request->category,
            'supplier_id'=>$request->supplier,
            'cost_price'=>$request->cost_price,
            'quantity'=>$request->quantity,
            'expiry_date'=>$request->expiry_date,
            'image'=>$imageName,
        ]);
        // $notifications = notify("Purchase has been added");
        return response()->json([
            'status' => 200,
        ]);
    }
     /*
    |--------------------------------------------------------------------------
    | handle edit an Purchase ajax request
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request)
     {
       $id = $request->id;
       $purchase = Purchase::find($id);
       return response()->json($purchase);
     }
    /*
    |--------------------------------------------------------------------------
    | handle update an Purchase ajax request
    |--------------------------------------------------------------------------
    */
     //
     public function update(Request $request)
     {
        $purchase = Purchase::find($request->id);
         $this->validate($request,[
             'product'=>'required|max:200',
             'category'=>'required',
             'cost_price'=>'required|min:1',
             'quantity'=>'required|min:1',
             'expiry_date'=>'required',
             'supplier'=>'required',
            //  'image'=>'file|image|mimes:jpg,jpeg,png,gif',
         ]);
         $imageName = $purchase->image;
         if($request->hasFile('image')){
             $imageName = time().'.'.$request->image->extension();
             $request->image->move(public_path('storage/purchases'), $imageName);
         }
         $purchase->update([
             'product'=>$request->product,
             'category_id'=>$request->category,
             'supplier_id'=>$request->supplier,
             'cost_price'=>$request->cost_price,
             'quantity'=>$request->quantity,
             'expiry_date'=>$request->expiry_date,
             'image'=>$imageName,
         ]);
        return response()->json([
            'status' => 200,
        ]);
     }
    /*
    |--------------------------------------------------------------------------
    | handle delete an Purchase ajax request
    |--------------------------------------------------------------------------
    */
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            Purchase::destroy($id);
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
        $purchases = Purchase::all();
        return view('admin.pages.purchase.reports',compact(
            'purchases'
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
        $purchases = Purchase::whereBetween(\DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        // dd($purchases);
        return view('admin.pages.purchase.reports',compact(
            'purchases'
        ));
    }

}
