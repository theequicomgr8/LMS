<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
 
use App\User;
use Session;
use Auth;
use Hash;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		 $data['button']="Savepassword";
		//echo Auth::user()->id; echo"<pre>"; print_r(Auth::user());
		 
		if($request->isMethod('post') && $request->input('submit')=="Savepassword")
		{
			
			
		$this->validate($request, [
		'oldpassword'=>'required', 
		'password'=>'required', 
		'cpassword' => 'required_with:password|same:password|min:8'

		]); 

 		 
			$users = User::find(Auth::user()->id); 
			 
			 
			if(Hash::check(trim($request->input('oldpassword')), $users->password))
			{	 
				$users->password = Hash::make($request['password']);
				if($users->save()){
				return redirect('/admin/changepassword')->with('success','Password Changed Successfully!');

				}	
			}else{
				return redirect('/admin/changepassword')->with('failed','Old Password Not Matched!');					 
				}	  
			

		}
        return view('admin.changepassword',$data);
    } 


	/**
     * Show the application home slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeslider()
    {	 
		 
        return view('admin.homeslider');
    }
}
