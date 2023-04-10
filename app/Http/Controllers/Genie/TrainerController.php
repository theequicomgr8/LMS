<?php

namespace App\Http\Controllers\genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use App\User;
use App\FeesTrainer;
 
use Auth;
use Validator;
use Mail;
use Session;
use DB;
class TrainerController extends Controller
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

    /**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
	 
	
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.trainer.index',['search'=>$search]);
    } 
	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendance(Request $request)
    {  
	
	
	 
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.trainer.attendance',['search'=>$search]);
    }  
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     
	public function roomallotment(Request $request)
    {  
	
	
 
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.trainer.roomallotment',['search'=>$search]);
    }
	
	 
	
	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$trainers = DB::connection('mysql2')->table('wp_trainers_details as std');	 		 
		$trainers=$trainers->where('trainer_phone',Session::get('mobile'));
		$trainers=$trainers->first();
		// echo"<pre>";print_r($trainers);die;
		return view('genie.trainer.profile',['trainers'=>$trainers]);


	}	
	
	
	
	/**
	* add pic image
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function picimage(Request $request,$id)
    {   
	 
		if($request->isMethod('post') )
		{
			//echo $id;  echo "<pre>";print_r($_FILES);die;
				 
					$trainer = FeesTrainer::find($id);	 
					// echo "<pre>";print_r($student);die;
					$photo = $request->file('image');
					if($photo)
					{
					$destinationPath = base_path() . '/public/uploads/image/';
					$image =$photo->getClientOriginalName();
					$image = rand(111111,999999).$image;
					$photo->move($destinationPath, $image);	
					$trainer->pic_image = $image;

					}	
 					
					if($trainer->save()){					
						$data['status']= 1;
						$data['msg']= "Successfully Update Photo";				

							} else{ 
							$data['status']= 0;
						$data['msg']= "Not Update Photo Successfully ";
							 				

							}
							
	echo json_encode($data);
									 
			
		}
         
    }
	
	
	public function delpicimage(Request $request,$id)
	{
	 
		$delet_data = FeesTrainer::find($id);	
		//echo "<pre>";print_r($delet_data);die;
		if(!empty($delet_data)){		
		if($delet_data->pic_image!='')
		{		
			if (file_exists(base_path('/public/uploads/image/'. $delet_data->pic_image)))
				{
                 unlink(base_path('/public/uploads/image/'. $delet_data->pic_image));
				}
		 
		}
 
		$edit_data = array('pic_image'  =>"",);	 
		$del = FeesTrainer::where('id',$id)->update($edit_data);		 		
			if($del){
			$data['status']= 1;
			$data['msg']= "Successfully Deleted Photo";


			} else{ 
			$data['status']= 0;
			$data['msg']= "Not Deleted Photo Successfully ";


			}
							
	echo json_encode($data);
}
		
		
	}
	
	
	
	
	
	
	
	
	
}
