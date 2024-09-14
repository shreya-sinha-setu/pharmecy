<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     //
     public function index()
     {
        // $user = \DB::table('users')->get();
        // $users ['users'] = $user;
        // return view('admin.pages.users.index',$users);
        return view('admin.pages.users.index');
     }
     /*
     |--------------------------------------------------------------------------
     | handle fetch all User ajax request
     |--------------------------------------------------------------------------
     */
     public function fetchAll()
     {
         try {
             $users = User::all();
             $output = '';
             $i = 0;
             if ($users->count() > 0) {
                 $output .= '<table class="table table-striped table-sm text-center align-middle">
             <thead>
               <tr>
                 <th>SN</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Phone</th>
                 <th>Avatar</th>
                 <th>Role</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>';
                 foreach ($users as $item) {
                     $output .= '<tr>
                     <td>' . ++$i. '</td>
                 <td>' . $item->name . '</td>
                 <td>' . $item->email . '</td>
                 <td>' . $item->phone . '</td>
                 <td><img class="avatar" src="'.asset("storage/users/".$item->avatar).'" alt="product"></td>
                 <td>' . $item->role_id . '</td>
                 <td>
                 <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editUserModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
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
    | handle insert a new User ajax request
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:200',
            'phone'=>'required',
            'email'=>'required|min:1',
            'password'=>'required|min:1',
            'role'=>'required',
        ]);
        $imageName = null;
        if ($request->hasFile('avatar')) {
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role,
            'avatar'=>$imageName,
        ]);
        // $notifications = notify("Purchase has been added");
        return response()->json([
            'status' => 200,
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | handle edit an User ajax request
    |--------------------------------------------------------------------------
    */
     public function edit(Request $request)
     {
         $id = $request->id;
         $users = User::find($id);
         return response()->json($users);
     }
 
     /*
    |--------------------------------------------------------------------------
    | handle update an User ajax request
    |--------------------------------------------------------------------------
    */
 
     public function update(Request $request)
     {
        // dd($request->role);
        $users = User::find($request->id);
        $this->validate($request,[
            'name'=>'required|max:200',
            'phone'=>'required',
            'email'=>'required|min:1',
            'role'=>'required',
        ]);
        $imageName = $users->image;
        if ($request->hasFile('avatar')) {
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $users->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'role'=>$request->role,
            'avatar'=>$imageName,
        ]);
       return response()->json([
           'status' => 200,
       ]);
     }
 
    /*
    |--------------------------------------------------------------------------
    | handle delete an User ajax request
    |--------------------------------------------------------------------------
    */
 
     public function delete(Request $request)
     {
         try {
             $id = $request->id;
             User::destroy($id);
         } catch (\Exception $e) {
             // Return Json Response
             return response()->json([
                 'message' => $e
             ], 500);
         }
     }


      /*
    |--------------------------------------------------------------------------
    | handle profile an User ajax request
    |--------------------------------------------------------------------------
    */
 
    public function profile(Request $request)
    {
        return view('admin.pages.users.profile');
    }
}
