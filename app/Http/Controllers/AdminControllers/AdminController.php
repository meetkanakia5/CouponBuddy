<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins'] = Admin::orderBy('first_name')->get();
        return view('admin.pages.admin_files.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.admin_files.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAdmin($request);
        $this->saveAdmin(new Admin,$request);
        Session::flash('created','Admin Added Successfully.');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view('admin.pages.admin_files.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateAdmin($request, 'update');
        $this->saveAdmin(Admin::findOrFail($id),$request, 'update');
        Session::flash('updated','Admin Updated Successfully.');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        Session('deleted', 'Admin Deleted Successfully');
        return redirect()->route('admin.admins.index');
    }

    public function validateAdmin($data, $type="add"){
        if($type == "add"){
            $data->validate([
                'firstname' => 'required|max:20',
                'lastname' => 'required|max:20',
                'email' => 'required|email:rfc,dns',
                'mobile' => 'required|digits:10',
                'password' => ['required', Password::min(8)->numbers()->mixedCase()->symbols()],
            ]);
        }else{
            $data->validate([
                'firstname' => 'required|max:20',
                'lastname' => 'required|max:20',
                'email' => 'required|email:rfc,dns',
                'mobile' => 'required|digits:10'
            ]); 
        }
        
    }

    public function saveAdmin($admin,$data, $type="add"){
            $admin->first_name  = $data->firstname;
            $admin->last_name  = $data->lastname;
            $admin->email  = $data->email;
            $admin->mobile  = $data->mobile;
            $type == "add" ? $admin->password = Hash::make($data->password) : '' ;
            $admin->save();
        
        return $admin;
    }
}
