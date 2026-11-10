<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use Session;
use Hash;
use Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id','desc')->get();
        return view('users.index', compact('users'));
    }

    public function getUsers(){
        $users = User::all();
        return response()->json(['users'=>$users]);
    }

    public function add(){
        $regions = $this->getRegion();
        return view('users.add', compact('regions'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'firstName'=> 'required',
            'lastName'=> 'nullable',
            'email' => 'required|email|unique:users,email',
            'mobileNumber' =>'string|nullable',
            'employeeID' => 'string|nullable',
            'userRole'=> 'string|nullable',
            'regionID' => 'string|nullable',
            'signature' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'pin' => 'nullable'
        ],[
            'firstName'=> 'First Name is required',
            'lastName'=> 'Last Name is required',
        ]);

        $validated['password'] = Hash::make('123456');
        $validated['isVerified'] = 1;
        $validated['pin'] = $validated['employeeID'];

        $path = 'assets/users/';
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = $validated['employeeID'].'.'. $signature->getClientOriginalExtension();
            $signature->move(public_path($path), $signatureName);
            $validated['signature'] = $path.$signatureName;
        }
        $userCreate = User::create($validated);
        if($userCreate){
            Session::flash('success', 'User added successfully');
        }else{
            Session::flash('error', 'Unable to add user');
        }
        return redirect('user');
    }

    public function edit(Request $request, $id){
        $user = User::find($id);
        $regions = $this->getRegion();
        return view('users.edit', compact('user','regions'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'firstName'=> 'required',
            'lastName'=> 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobileNumber' =>'string|nullable',
            'employeeID' => 'string|nullable',
            'userRole'=> 'nullable',
            'regionID' => 'string|nullable',
            'signature' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ],[
            'firstName'=> 'First Name is required',
            'lastName'=> 'Last Name is required',
        ]);

        $user = User::find($id);
        $path = 'assets/users/';
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = $validated['employeeID'].'.'. $signature->getClientOriginalExtension();
            $signature->move(public_path($path), $signatureName);
            $validated['signature'] = $path.$signatureName;
        }

        $userUpdate = $user->update($validated);
        if($userUpdate){
            Session::flash('success', 'User updated successfully');
        }else{
            Session::flash('success', 'Unable to update user');
        }
        return redirect('user');
    }

    public function destroy(Request $request, $id){
        $user = User::find($id);
        $userDelete = $user->delete();
        if($userDelete){
            Session::flash('success', 'User deleted successfully');
        }else{
            Session::flash('success', 'Unable to delete user');
        }
        return redirect('user');
    }


    public function testSession()
    {
        Session::put('test_key', 'test_value');
        $value = Session::get('test_key');

        return view('test' , compact('value'));
    }

    public function changePassword(){

        return view('users.changePassword');
    }

    public function updatePassword(Request $request, $id){

        try{
  
           $validated = $request->validate([
              'oldPassword' => 'required',
              'password' => 'required|confirmed',
              'password_confirmation' => 'required'
           ]);
           $validated['password'] = Hash::make($validated['password']);
  
           if (!Hash::check($validated['oldPassword'], Auth::user()->password)) {
              return redirect()->back()->with('error', 'Old Password didn\'t match');
           }
  
           $user = User::find($id);
  
           if($user){
                $updatePassword = $user->update([
                    'password' => $validated['password']
                ]);
  
                if($updatePassword){
                    return redirect()->route('index')->with('success', 'Password updated successfully');
                }else {
                    return redirect()->back()->with('error', 'Failed to update password');
                }
            }else{
                return redirect()->back()->with('error', 'User not found');
            }
        }catch (\Exception $e){
           return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
