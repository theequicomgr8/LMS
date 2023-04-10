<?php

namespace App\Http\Controllers\genie;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use DB;
use Validator;
class UserController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
	
	  
	
	
	public function index()
	{

		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
		
		  return view('genie.user.index');
		
	}
	
	
	public function getUserPagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
			 
		$users= 	User::orderBy('id','DESC');
		      
			 
		 
		if($request->input('search.value')!==''){
				$users = $users->where(function($query) use($request){
					$query->orWhere('name','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('email','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('mobile','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('role','LIKE','%'.$request->input('search.value').'%');
				});
			}
			$users = $users->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $users->total();
			$returnLeads['recordsFiltered'] = $users->total();
			$returnLeads['recordCollection'] = [];
 //echo "<pre>";print_r($users);die;
			foreach($users as $user){
				 
				  
					 
					 
					$data[] = [		 		 		 
						$user->name,							 
						$user->mobile,					 
						$user->email,					 
						$user->role,	
						'<a href="/users/edit/'.$user->id.'"><i class="fa fa-edit" aria-hidden="true"></i></a> | <a href="javascript:userController.delete('.$user->id.')"" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>',						
					 						
						  
						 
					];
					$returnLeads['recordCollection'][] = $user->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	
	
	public function allUser()
	{
		
		  return view('genie.user-list');
		
	}
	
	
	public function add(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		 
		return view('genie.user.register');
	}
	public function store(Request $request)
	{
		//echo "<pre>";print_r($_POST);die;
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
		
			 

			$validator = Validator::make($request->all(),[
			'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
			]);
			if($validator->fails()){
			$errorsBag = $validator->getMessageBag()->toArray();
			return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
		
				$user = new user;					
				$user->name = ucfirst($request->input('name'));
				$user->mobile = $request->input('mobile');	 
				$user->email = $request->input('email');	 
				$user->role = $request->input('role');	 
				
				if($user->save()){
					return response()->json(['status'=>1,'msg'=>'Successfully Addred'],200);						
					
				}else{
					return response()->json(['status'=>0,'msg'=>'Not Added'],200);
					
				}
		}
		return view('genie.user.register');
	}
			
	public function edit(Request $request, $id)
	{  
	   $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$edit_data = User::find($id);

		if($request->ajax()){		
				//echo "<pre>";print_r($_POST);die;
			$validator = Validator::make($request->all(),[
			'name' => 'required|string|max:255',
			'email'=>'required|max:50|unique:users,email,'.$id,				
			'mobile'=>'required|unique:users,mobile,'.$id,
            'role' => 'required',
			]);
			if($validator->fails()){
			$errorsBag = $validator->getMessageBag()->toArray();
			return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
				$user = User::find($id);					
				$user->name = ucfirst($request->input('name'));
				$user->email = $request->input('email');
				$user->mobile = $request->input('mobile');
				$user->role = $request->input('role');					
				if($user->save()){
				return response()->json(['status'=>1,'msg'=>'Successfully updated'],200);						

				}else{
				return response()->json(['status'=>0,'msg'=>'Not updated'],200);

				}
			
		}
		 
		return view('genie.user.editregister',['edit_data'=>$edit_data]);
		
	}
		
	 
	public function deleted(Request $request,$id){
		 
		  $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			$users = User::findorFail($id);
			 
			if(!empty($users)){
				if($users->delete()){					 
				 
				return response()->json(['status'=>1,'msg'=>'Successfully Deleted'],200);						

				}else{
				return response()->json(['status'=>0,'msg'=>'Not Deleted'],200);

				}
							
			 
									 
			
			}
		 
	}
	 
		
}
