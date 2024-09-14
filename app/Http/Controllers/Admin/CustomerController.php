<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.customer.index');
    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all Customer ajax request
    |--------------------------------------------------------------------------
    */
    public function fetchAll()
    {
        try {
            $customers = Customer::orderBy('id', 'DESC')->get();
            $output = '';
            $i = 0;
            if ($customers->count() > 0) {
                $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>S/N</th>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Due</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($customers as $customers) {
                    $output .= '<tr>
                <td>' . ++$i . '</td>
                <td>' . $customers->customer_id . '</td>
                <td>' . $customers->name . '</td>
                <td>' . $customers->email . '</td>
                <td>' . $customers->phone . '</td>
                <td>' . $customers->address . '</td>
                <td>' . $customers->due . '</td>
                <td>
                  <a href="#" id="' . $customers->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCustomerModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

                  <a href="#" id="' . $customers->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
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
   | handle insert a new customer ajax request
   |--------------------------------------------------------------------------
   */
    public function store(Request $request)
    {
        try {
            $this->validate(request(), [
                'customer_id'=>'required',
                'name' => 'required',
                'phone'=>'required'
            ]);
            $customerData = [
                'customer_id'=> $request->customer_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'due' => $request->due
            ];
            Customer::create($customerData);
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
   | handle edit an Customer ajax request
   |--------------------------------------------------------------------------
   */
    public function edit(Request $request)
    {
        $id = $request->id;
        $customers = Customer::find($id);
        return response()->json($customers);
    }

    /*
   |--------------------------------------------------------------------------
   | handle update an Customer ajax request
   |--------------------------------------------------------------------------
   */

    public function update(Request $request)
    {
        try {
            $customers = Customer::find($request->id);
            $this->validate(request(), [
                'customer_id'=>'required',
                'name' => 'required',
                'phone'=>'required'
            ]);
            $newData = [
                'customer_id'=> $request->customer_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'due' => $request->due
            ];

            $customers->update($newData);
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
   | handle delete an Customer ajax request
   |--------------------------------------------------------------------------
   */

    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            Customer::destroy($id);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }
}
