<?php

namespace App\Http\Controllers\genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use App\User;
 use App\FeesBatches;
 use App\FeesStudents;
 use App\FeesCourse;
 use App\FeesTrainer;
 use App\FeesStudentsAttendance;
 use Auth;
 use DB;
 use Validator;
 use Carbon\Carbon;
 use Session;
class StudentsController extends Controller
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
	 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
 
        return view('genie.trainer.index');
    } 
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function student(Request $request)
    {  
	 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$arraystudent =array('Id','Name','Email','Phone');
	$students = FeesStudents::where('stud_batch_id','1634')->orderBy('name','asc')->get();
	  //echo "<pre>";print_r($arraystudent);die;
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.students.index',['search'=>$search,'students'=>$students,'arraystudent'=>$arraystudent]);
    }   
	
	
	public function getstudentspagination(Request $request)
    {  
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		
	 
		//$arraystudent =array('Id','Name','Email','Phone');
		//$arraystudent =array('Id','Name','Email','Phone');
		$arraystudent= $request->input('search.check-columns');	
		echo "<pre>";print_r($arraystudent);die;
	$students = FeesStudents::where('stud_batch_id','1634')->orderBy('name','asc')->get();
	  //echo "<pre>";print_r($arraystudent);die;
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.students.index',['search'=>$search,'students'=>$students,'arraystudent'=>$arraystudent]);
    }  
	
	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
		//$students =FeesStudents::where('phone','9981737422');
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id');
		$students=$students->where('std.phone',Session::get('mobile'));
		$students=$students->select('std.*','course.*','std.id as std_id');
		$students=$students->first();
		//echo "<pre>";print_r($students);die;
		return view('genie.students.profile',['students'=>$students]);


	}	


	public function profileUpdate(Request $request)
    {
		
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		//echo "<pre>";print_r($_POST);die;
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'name'=>'required',
				'email'=>'required'	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			$std_id= $request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);
			 
			$students->name = $request->input('name');
			$students->email = $request->input('email');			 			 
			if($students->save()){ 
					return response()->json(['status'=>1,'msg'=>'Successfully Updated'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not Updated'],400);
			}
		}
		}
    }

	public function firstFeedBack(Request $request)
    {
	//echo "<pre>";print_r($_POST);
	
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'rating1'=>'required',
				'rating2'=>'required',
				'rating3'=>'required',
				'rating4'=>'required',
				'rating5'=>'required',	
				'courserating1'=>'required',	
				'courserating2'=>'required',	
				'courserating3'=>'required',	
				'activities1'=>'required',	
				'activities2'=>'required',	
				'std_id'=>'required',	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$traingrating1= $request->input('rating1');
			$traingrating2= $request->input('rating2');
			$traingrating3= $request->input('rating3');
			$traingrating4= $request->input('rating4');
			$traingrating5= $request->input('rating5');
			$rating =($traingrating1+$traingrating2+$traingrating3+$traingrating4+$traingrating5)/5;
			//echo $rating;die;
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->first_feed = 1;			 			 
			if($students->save()){ 
					return response()->json(['status'=>1,'msg'=>'Successfully Updated'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not Updated'],400);
			}
		}
		}
    }
	
	public function secondFeedBack(Request $request)
    {
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'rating1'=>'required',
				'rating2'=>'required',
				'rating3'=>'required',
				'rating4'=>'required',
				'rating5'=>'required',	
				'courserating1'=>'required',	
				'courserating2'=>'required',	
				'courserating3'=>'required',	
				'activities1'=>'required',	
				'activities2'=>'required',	
				'std_id'=>'required',	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$traingrating1= $request->input('rating1');
			$traingrating2= $request->input('rating2');
			$traingrating3= $request->input('rating3');
			$traingrating4= $request->input('rating4');
			$traingrating5= $request->input('rating5');
			$rating =($traingrating1+$traingrating2+$traingrating3+$traingrating4+$traingrating5)/5;
			//echo $rating;die;
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->second_feed = 1;			 			 
			if($students->save()){ 
			
			
				/* if(!empty($result->first_remark)){	

				}else{
				$first="Notcomplated";

				}
				if(!empty($result->second_remark)){	

				}else{
				$second="Notcomplated";

				} */
					return response()->json(['status'=>1,'msg'=>'Successfully Updated'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not Updated'],400);
			}
		}
		}
    }
	
	public function thirdFeedBack(Request $request)
    {
			$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'rating1'=>'required',
				'rating2'=>'required',
				'rating3'=>'required',
				'rating4'=>'required',
				'rating5'=>'required',	
				'courserating1'=>'required',	
				'courserating2'=>'required',	
				'courserating3'=>'required',	
				'activities1'=>'required',	
				'activities2'=>'required',	
				'std_id'=>'required',	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$traingrating1= $request->input('rating1');
			$traingrating2= $request->input('rating2');
			$traingrating3= $request->input('rating3');
			$traingrating4= $request->input('rating4');
			$traingrating5= $request->input('rating5');
			$rating =($traingrating1+$traingrating2+$traingrating3+$traingrating4+$traingrating5)/5;
			//echo $rating;die;
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->third_feed = 1;			 			 
			if($students->save()){ 
					return response()->json(['status'=>1,'msg'=>'Successfully Updated'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not Updated'],400);
			}
		}
		}
    }


	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function feedBack(Request $request)
    {
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
 
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
	    if($role=="Admin" || $role=="Manager"){			
				 
			/* if($request->input('search.trainer')!=''){					 
				$batches = $batches->where('trainer.id',$request->input('search.trainer'));
			}
			
			if($request->input('search.course')!=''){			
				 
				$batches = $batches->where('course.id',$request->input('search.course'));
			}	 */	
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		$students=$students->first();
		 
		return view('genie.students.feedback',['students'=>$students]);


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
	 
	
	public function roomallotment(Request $request)
    {  
			$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
	 
	$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
 
        return view('genie.trainer.roomallotment',['search'=>$search]);
    }
	
 
	
	
	
	
	
	
}
