<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
 
use App\User;
use Session;
use Auth;
use Hash;

class ProfileController extends Controller
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
		 $data['edit_data'] = User::find(Auth::user()->id); 
		if($request->isMethod('post') && $request->input('submit')=="Savepassword")
		{
			
			
			$this->validate($request, [
			'name'=>'required', 
			'email'=>'required', 
			'mobile' => 'required'
			]);  		 
			$users = User::find(Auth::user()->id); 			 
			 $users->name= $request->input('name');
			 $users->email= $request->input('email');
			 $users->mobile= $request->input('mobile');
			 $users->address= $request->input('address');
			 $photo= $request->file('image');
		  
			if(!empty($photo))
			{
			$destinationPath = base_path() . '/public/upload/';
			$image =$photo->getClientOriginalName();
			$image = time().$image;
			$photo->move($destinationPath, $image);	
			$users->image = $image;

			}	
				 
			if($users->save()){
			return redirect('/admin/profile')->with('success','Profile Successfully updated!');
				 
			}else{
				return redirect('/admin/profile')->with('failed','Profile Not updated!');					 
				}	  
				 
        
		} 
		return view('admin.profile',$data);
	 
	}

	public function imageDeleted(Request $request,$id)
	{
		$delet_data = User::find($id);		 
		if($delet_data->image!='')
		{		
			if (file_exists(base_path('/public/upload/'. $delet_data->image)))
				{
                 unlink(base_path('/public/upload/'. $delet_data->image));
				}
		 
		}
 
		$edit_data = array('image'  =>"",);	 
		$del = User::where('id',Auth::user()->id)->update($edit_data);		 		
		return redirect('admin/profile')->with("success","Profile image deleted successfully.");
		
		
		
	}








}