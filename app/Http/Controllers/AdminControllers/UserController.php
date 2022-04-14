<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('first_name')->get();
        return view("admin.pages.users.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateUser($request);
        $this->saveUser(new User,$request);
        Session::flash('created','User Added Successfully.');
        return redirect()->route('admin.users.index');
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
        $data['user'] = User::findOrFail($id);
        return view('admin.pages.users.edit',$data);
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
        $this->validateUser($request, 'update');
        $this->saveUser(User::findOrFail($id),$request, 'update');
        Session::flash('updated','User Updated Successfully.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session('deleted', 'User Deleted Successfully');
        return redirect()->route('admin.users.index');
    }

    public function validateUser($data, $type="add"){
            $data->validate([
                'firstname' => 'required|max:50',
                'lastname' => 'required|max:50',
                'email' => 'required|email:rfc,dns|unique:users',
                'mobile' => 'required|digits:10',
                'password' => $type == "add" ? ['required', Password::min(8)->numbers()->mixedCase()->symbols()] : '',
                'zipcode' => 'required | regex:/^(?<full>(?<part1>[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1})(?:[ ](?=\d))?(?<part2>\d{1}[A-Z]{1}\d{1}))$/'
            ]);
    }

    public function saveUser($user,$data, $type="add"){
            $user->first_name = $data->firstname;
            $user->last_name = $data->lastname;
            $user->email = $data->email;
            $type == 'add' ? $user->password = Hash::make($data->password) : '';
            $user->mobile = $data->mobile;
            $user->address = $data->address;
            $user->zip_code = $data->zipcode;
            $user->latitude = $data->latitude;
            $user->longitude = $data->longitude;
            $user->save();

        
        return $user;
    }
}
