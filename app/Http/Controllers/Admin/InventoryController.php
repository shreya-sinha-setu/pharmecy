<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //

    public function index()
    {
        return view('admin.Pages.inventory.index');
    }

 /*
    |--------------------------------------------------------------------------
    | handle fetch all inventory ajax request
    |--------------------------------------------------------------------------
    */
    public function fetchAll()
    {
        try {
            $inventory = Inventory::all();
            $output = '';
            $i = 0;
            if ($inventory->count() > 0) {
                $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>SN</th>
                <th>Product Name</th>
                <th>Shope Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($inventory as $item) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td>' . $item->product_name . '</td>
                <td>' . $item->shope_name . '</td>
                <td>' . $item->quantity . '</td>
                <td>' . $item->amount . '</td>
                <td>' . date_format(date_create($item->purchase_date),'d M, Y'). '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editInventoryModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
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
   | handle insert a new Inventory ajax request
   |--------------------------------------------------------------------------
   */
  public function store(Request $request)
  {
      try {
          $inventoryData = [
              'product_name'=> $request->product_name,
              'shope_name' => $request->shope_name,
              'quantity' => $request->quantity,
              'amount' => $request->amount,
              'purchase_date' => $request->purchase_date,
          ];
          Inventory::create($inventoryData);
          return response()->json([
              'status' => 200,
          ]);
      } catch (\Exception $e) {
          // Return Json Response
          return response()->json([
              'message' => $e
          ], 500);
      }
  }

   /*
   |--------------------------------------------------------------------------
   | handle edit an Inventory ajax request
   |--------------------------------------------------------------------------
   */
  public function edit(Request $request)
    {
        $id = $request->id;
        $inventory = Inventory::find($id);
        return response()->json($inventory);
    }
     /*
   |--------------------------------------------------------------------------
   | handle update an Inventory ajax request
   |--------------------------------------------------------------------------
   */

   public function update(Request $request)
   {
       try {
           $inventory = Inventory::find($request->id);
           
           $newData = [
            'product_name'=> $request->product_name,
            'shope_name' => $request->shope_name,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
            'purchase_date' => $request->purchase_date,
           ];

           $inventory->update($newData);
           return response()->json([
               'status' => 200,
           ]);
       } catch (\Exception $e) {
           // Return Json Response
           return response()->json([
               'message' => $e
           ], 500);
       }
   }
/*
   |--------------------------------------------------------------------------
   | handle delete an Inventory ajax request
   |--------------------------------------------------------------------------
   */

   public function delete(Request $request)
   {
       try {
           $id = $request->id;
           Inventory::destroy($id);
       } catch (\Exception $e) {
           // Return Json Response
           return response()->json([
               'message' => $e
           ], 500);
       }
   }


}
