<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function editProfile($id){
        $data = User::where('id',$id)->first();
        return view('dashboard.edit_profile',compact('data'));
    }
    public function updateProfile(Request $request,$id){
        $data = DB::table('users')
        ->where('id',$id)
        ->update([
          'name'=>$request->input('name'),
          'email'=>$request->input('email'),
          'phone'=>$request->input('phone'),
          'staff'=>$request->input('staff'),
          'date_of_birth'=>$request->input('date')
        ]);
        if ($data) {
        	return back()->with('Success','Data has Updated!');
         return Response()->json(
                ['status' => true, 'msg' => 'Data updated!','type'=>'success','title'=>'Success!!']
            );  
        }	
    }
    public function changePassword($id){
    	$change = User::find($id);
    	return view('dashboard.change_password',compact('$change'));
    }
    public function changePasswordUpdate(Request $request,$id){
    	$user = User::findOrFail($id);
    	if (Hash::check($request->oldpassword, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->newpassword)
            ])->save();
           // return Response()->json(
           //      ['status' => true, 'msg' => 'Password Changed !','type'=>'success','title'=>'Success!!']
           //  );  
            return back()->with('Success','Password Changed !');
        } else {
        	// return Response()->json(
                // ['status' => false, 'msg' => 'Password doed not match !','type'=>'warning','title'=>'Ops!!']
            // );  
            return back()->with('Warning','Password doed not match !');
        }
    }
}
