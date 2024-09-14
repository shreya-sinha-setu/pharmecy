<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\DataTables;

class SuppliersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('admin.pages.supplier.index');
    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all supplier ajax request
    |--------------------------------------------------------------------------
    */
    public function fetchAll()
    {
        try {
            $suppliers = Supplier::all();
            $output = '';
            if ($suppliers->count() > 0) {
                $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Company</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($suppliers as $supplier) {
                    $output .= '<tr>
                <td>' . $supplier->id . '</td>
                <td>' . $supplier->product . '</td>
                <td>' . $supplier->name . '</td>
                <td>' . $supplier->email . '</td>
                <td>' . $supplier->phone . '</td>
                <td>' . $supplier->address . '</td>
                <td>' . $supplier->company . '</td>
                <td>
                  <a href="#" id="' . $supplier->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSupplierModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

                  <a href="#" id="' . $supplier->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
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
    | handle insert a new Supplier ajax request
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        try {
            $this->validate(request(), [
                'product' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'company' => 'required',
            ]);
            $supplierData = [
                'product' => $request->product,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company' => $request->company,
                'comment' => $request->comment
            ];
            Supplier::create($supplierData);
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
    | handle edit an Supplier ajax request
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request)
    {
        $id = $request->id;
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    /*
    |--------------------------------------------------------------------------
    | handle update an Supplier ajax request
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        try {
            $supplier = Supplier::find($request->id);
            $this->validate($request, [
                'product' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'company' => 'required',
                'comment' => 'required'
            ]);

            $newData = [
                'product' => $request->product,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company' => $request->company,
                'comment' => $request->comment
            ];

            $supplier->update($newData);
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
    | handle delete an Supplier ajax request
    |--------------------------------------------------------------------------
    */
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            Supplier::destroy($id);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }
}