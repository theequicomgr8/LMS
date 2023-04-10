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
 use App\StudentsFeedbackQuestion;
 use App\FeesDetails;
  use App\Studentsinquery;
 use App\FeesUser;
 use App\JobsPortal;
 use Auth;
 use DB;
  use Mail;
 use Validator;
 use Carbon\Carbon;
 use Session;
 use Cache;
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
			$arraystudent= $request->input('search.check-columns');	
			echo "<pre>";print_r($arraystudent);die;
			$students = FeesStudents::where('stud_batch_id','1634')->orderBy('name','asc')->get();			 
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
	//	 echo "<pre>";print_r($students);die;
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
 
 	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstFeedback(Request $request)
    {
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
		/*
		$students = Cache::remember('std__', 60*60*24, function () {
            $students = DB::connection('mysql2')->table('wp_students_details as std');	 
    		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
    		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
    		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');		
    		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
    		
    		if($role=="Admin" || $role=="Manager"){				 
    			$students=$students->where('phone','=','1241241241');
    			}else{				
    				$students=$students->where('phone','=',Session::get('mobile'));		
    			}
    		
    		return $students=$students->get();
        });*/


		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){				 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();	 
		return view('genie.students.first_feedback',['students'=>$students]);
		 

	}	
	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseOffer(Request $request)
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
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();	 
		return view('genie.students.courses_offer',['students'=>$students]);
		 

	}
 	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function job(Request $request)
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
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
		
		$jobs = DB::connection('mysql4')->table('jobs')->where('show_to_stud','1')->where('status','1')->limit(12)->orderby('modificationdate','desc')->get();	 		
  
		//echo "<pre>";print_r($jobs);die;
		return view('genie.students.job',['jobs'=>$jobs,'students'=>$students]);
		 

	}
	
	
    public function jobDetail(Request $request, $jobid)
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
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
		$jobid =base64_decode($jobid);		 
		$jobsdetails = DB::connection('mysql4')->table('jobs')->where('jobid',$jobid)->first();
		
		return view('genie.students.jobDetail',['jobsdetails'=>$jobsdetails,'students'=>$students]);
		 
	
	}
	
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentAttendance(Request $request)
    {		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  	 
		
		/*$students = Cache::remember('attendence', 60*60*24, function () {
            $students = DB::connection('mysql2')->table('wp_students_details as std');	 
    		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
    		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
    		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
    		
    		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
    		
    		if($role=="Admin" || $role=="Manager"){				 
    			$students=$students->where('phone','=','1241241241');
    			}else{				
    				$students=$students->where('phone','=',Session::get('mobile'));		
    			}
    		return $students=$students->get();
        });*/


		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){				 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		$students=$students->get();
        
        
		return view('genie.students.attendance',['students'=>$students]);
		 

	}
 	
 	
	public function firstFeedbackSave(Request $request)
    {
        
       // echo "<pre>";print_r($_POST);die;
	 	$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'participation'=>'required',
				'preparation'=>'required',
				'technology'=>'required',
				'session'=>'required',
				'software'=>'required',	
				'feestructure'=>'required',	
				'batchtiming'=>'required',	
				'queries'=>'required',	
				'information'=>'required',				 
				'std_id'=>'required',				
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$participation= $request->input('participation');
			$preparation= $request->input('preparation');
			$technology= $request->input('technology');
			$session= $request->input('session');
			$software= $request->input('software');
			$feestructure= $request->input('feestructure');
			$batchtiming= $request->input('batchtiming');
			$queries= $request->input('queries');
			$information= $request->input('information');
			$rating =($participation+$preparation+$technology)/3;
			$FB_1=($participation.','.$preparation.','.$technology.','.$session.','.$software.','.$feestructure.','.$batchtiming.','.$queries.','.$information);			 
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->first_feed = 1;			 			 
			$students->std_first_remark = $request->input('std_first_remark');			 			 
			$students->FB_1 = $FB_1;			 			 
			if($students->save()){ 
					return response()->json(['status'=>1,'msg'=>'Thanks for giving the feedback for the training'],200);
				 
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
    public function secondFeedBack(Request $request)
    { 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$feedBackQuestion=  StudentsFeedbackQuestion::get();
		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){					 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();	 
		return view('genie.students.second_feedback',['students'=>$students,'feedBackQuestion'=>$feedBackQuestion]);
		 

	}
	
	public function secondFeedbackSave(Request $request)
    {
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'participation'=>'required',
				'preparation'=>'required',
				'technology'=>'required',
				'queries'=>'required',
				'material'=>'required',	
				'helpful'=>'required',	
				'organized'=>'required',	
				'practical'=>'required',	
				'curriculum'=>'required',	
				'solving'=>'required',	
				'information'=>'required',	
				'interacting'=>'required',	
				'std_id'=>'required',	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$participation= $request->input('participation');
			$preparation= $request->input('preparation');
			$technology= $request->input('technology');
			$queries= $request->input('queries');
			$material= $request->input('material');
			$helpful= $request->input('helpful');
			$organized= $request->input('organized');
			$practical= $request->input('practical');
			$curriculum= $request->input('curriculum');
			$solving= $request->input('solving');
			$information= $request->input('information');
			$interacting= $request->input('interacting');
			$rating =($participation+$preparation+$technology+$queries)/4;
			$FB_2=($participation.','.$preparation.','.$technology.','.$queries.','.$material.','.$helpful.','.$organized.','.$practical.','.$curriculum.','.$solving.','.$information.','.$interacting);
			 
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->first_feed = 2;			 			 
			$students->second_feed = 1;			 			 
			$students->FB_2 = $FB_2;		
			$students->std_second_remark = $request->input('std_second_remark');						
						
			if($students->save()){ 			 
				return response()->json(['status'=>1,'msg'=>'Second Feedback Successfully'],200);				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not Second Feed Back'],400);
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
    public function thirdFeedBack(Request $request)
    {
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$feedBackQuestion=  StudentsFeedbackQuestion::get();
		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){	 
			 	
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
		 
		return view('genie.students.third_feedback',['students'=>$students,'feedBackQuestion'=>$feedBackQuestion]);
		 

	}
	public function thirdFeedbackSave(Request $request)
    {		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'expectations'=>'required',
				'helpful'=>'required',
				'participation'=>'required',
				'queries'=>'required',
				'designing'=>'required',	
				'questions'=>'required',	
				'sufficient'=>'required',	
				'performed'=>'required',	
				'curriculum'=>'required',	
				'technical'=>'required',	
				'conducted'=>'required',	
				'interacting'=>'required',	
				'std_id'=>'required',	
				 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$expectations= $request->input('expectations');
			$helpful= $request->input('helpful');
			$participation= $request->input('participation');
			$queries= $request->input('queries');
			$designing= $request->input('designing');
			$questions= $request->input('questions');
			$sufficient= $request->input('sufficient');
			$performed= $request->input('performed');
			$curriculum= $request->input('curriculum');
			$technical= $request->input('technical');
			$conducted= $request->input('conducted');
			$interacting= $request->input('interacting');
			$rating =($expectations+$helpful+$participation+$queries)/4;
			$FB_3=($expectations.','.$helpful.','.$participation.','.$queries.','.$designing.','.$questions.','.$sufficient.','.$performed.','.$curriculum.','.$technical.','.$conducted.','.$interacting);			 
			$std_id=$request->input('std_id');
			if($std_id){
			$students = FeesStudents::findOrFail($std_id);			 
			$students->rating = $rating;
			$students->FB_3 = $FB_3;
			$students->third_feed = 1;	
			$students->first_feed = 3;		
			$students->std_third_remark = $request->input('std_third_remark');						
			if($students->save()){ 
			
			$batch = FeesBatches::findOrFail($students->stud_batch_id);	
			$batch->batch_feedback=1;
			$batch->save();	
			
			$feedstudentcheck  = FeesStudents::where('stud_batch_id',$students->stud_batch_id)->where('trainer',$students->trainer)->where('courses',$students->courses)->where('next_due_amt','<=',0)->where('third_feed','=','1')->get();	
			if(sizeof($feedstudentcheck)>0){
				$this->invoiceGeneratedHundredPercentage($students->stud_batch_id,$students->trainer,$students->courses);				
			}
					return response()->json(['status'=>1,'msg'=>'Third Feedback Successfully'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'Not Third Feedback'],400);
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
    public function courseContents(Request $request)
    {
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
	 
		/*$students=Cache::remember('student__', 60*60*24, function () {
        	$students = DB::connection('mysql2')->table('wp_students_details as std');	 
    		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
    		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
    		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
    		
    		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
    		
    		if($role=="Admin" || $role=="Manager"){			
    		 
    			$students=$students->where('phone','=','1241241241');
    			}else{				
    				$students=$students->where('phone','=',Session::get('mobile'));		
    			}
    		
    		return $students=$students->get();
        });*/
		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){			
		 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
        
		return view('genie.students.course_contents',['students'=>$students]);
	 


	}	
	public function feedBackQuestion(Request $request)
    {
	 
	
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'heading'=>'required',
				'question'=>'required',
				'ans_type'=>'required',			 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$heading= trim($request->input('heading'));
			$question= trim($request->input('question'));
			$ans_type= trim($request->input('ans_type'));
			 $studentsFeedbackQuestion = new StudentsFeedbackQuestion;
			 $studentsFeedbackQuestion->heading = $heading;
			 $studentsFeedbackQuestion->question = $question;
			 $studentsFeedbackQuestion->ans_type = $ans_type;
			 $studentsFeedbackQuestion->status = 1;
			 
		 			 			 
			if($studentsFeedbackQuestion->save()){ 
					return response()->json(['status'=>1,'msg'=>'Successfully Question'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not added Question'],400);
			}  
		}
		
		return view('genie.students.feedBack_Question');
		
    }
	
		
	/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function feesDetails(Request $request)
    {
				
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$feedBackQuestion=  StudentsFeedbackQuestion::get();
		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');
		
		if($role=="Admin" || $role=="Manager"){		
				 
			 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
		//dd($students);
		return view('genie.students.fees_details',['students'=>$students,'feedBackQuestion'=>$feedBackQuestion]);
	 


	}	
	
/**
	* list of employee
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentbatch(Request $request)
    {
		 
		$role = Session::get('role');
		
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		//$feedBackQuestion=  StudentsFeedbackQuestion::get();
		//$feedBackQuestion=cache()->remember('StudentsFeedbackQuestion__',60*60*24,function(){
		//    return StudentsFeedbackQuestion::get();
		//});
		
		$feedBackQuestion=StudentsFeedbackQuestion::get();
		
		$students = DB::connection('mysql2')->table('wp_students_details as std');	 
		$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		
		$students=$students->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name','trainer.meetingurl as trainer_meetingurl','batch.meetingurl as batch_meetingurl');
		//$students=$students->select('std.course','batch.batch_name','batch.batch_created_on','batch.occurrence','batch.batch_starts_on','batch.batch_end_on','std.attenddate','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name','trainer.meetingurl as trainer_meetingurl','batch.meetingurl as batch_meetingurl');
		
		if($role=="Admin" || $role=="Manager"){			
			 
			$students=$students->where('phone','=','1241241241');
			}else{				
				$students=$students->where('phone','=',Session::get('mobile'));		
			}
		
		$students=$students->get();
		
		return view('genie.students.student_batch',['students'=>$students,'feedBackQuestion'=>$feedBackQuestion]);
		 


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
	
 
	public function studentSlipReceipt(Request $request) { 

			if(isset($_POST['fid']))
			{

			if($request->input('action') == 'studentSlipReceipt')
			{

			$fid= $_POST['fid'];


			$students = DB::connection('mysql2')->table('wp_students_details as std');	 
			$students = $students->join('wp_courses_details as course','std.courses','=','course.id','left outer');
			$students = $students->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
			$students = $students->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
			$students = $students->join('wp_fees_details as fees','std.id','=','fees.s_id');

			$students=$students->select('std.*','course.*','batch.*','fees.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name','fees.id as fees_id');		 			
			$students=$students->where('fees.id','=',$fid);				 

			$students=$students->first();
            $collect  =FeesUser::where('ID',$students->collector_id)->first(); 
			return view('genie.students.studentSlipReceipt',['fees_details'=>$students,'collect'=>$collect]);

			}
			}
	}

	public function getAttention(Request $request,$id){

	if(isset($id))
	{ 
	$students = DB::connection('mysql2')->table('wp_students_attendance as std_a');	 		 		 			
	$students=$students->where('students_id','=',$id);				 

	$students=$students->get();

	// echo "<pre>";print_r($students);
	return response()->json($students,200);


	}
	}

	
	public function querySave(Request $request)
    { 
	
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		//echo"<pre>";print_r($_POST);die;
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
			 
				'mobile'=>'required',
				'trainer'=>'required',
				'course'=>'required',
				'email'=>'required',			 
				'message'=>'required',			 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			 
			 $studentsinquery = new Studentsinquery;
			 $studentsinquery->type = $request->input('type');
			 $studentsinquery->name = $request->input('name');
			 $studentsinquery->mobile = $request->input('mobile');
			  $studentsinquery->trainer = $request->input('trainer');
			   $studentsinquery->course = $request->input('course');
			 $studentsinquery->email = $request->input('email');
			 $studentsinquery->message = $request->input('message');
			 	//echo"<pre>";	print_r($studentsinquery);die;	 			 
			if($studentsinquery->save()){ 
			
			
			 $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		//	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			//	$headers .= 'From: enquiry@cromacampus.com' . "\r\n";
			$headers .= 'From: CromaCampus <leads@leadpitch.in>';
			//$to="cromacampusleads@gmail.com";
			$to="brijesh.chauhan@cromacampus.com";
	    	$subject="Drop and Query LMS Portal- ".$request->input('name');
	     			  
			$message =' <tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('name').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('email').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('mobile').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Trainer:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('trainer').'</span><u></u><u></u></p>
			</td>
			</tr>
			
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Course:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('course').'</span><u></u><u></u></p>
			</td>
			</tr>
			    
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Message:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('message').'</span><u></u><u></u></p>
			</td>
			</tr>
			 ';
			//$to="cromacampusleads@gmail.com";
			
			 
			  $stdemail="";
			 $codemail="";
			 $coordinator="";
			 
			// echo "<pre>";print_r($_FILES);die;
			//lms.class@cromacampus.com
		$to="brijesh.chauhan@cromacampus.com";
		Mail::send('emails.send_lead_inquiry', ['msg'=>$message], function ($m) use ($message,$request,$subject,$stdemail,$codemail) {
		$m->from('leads@leadpitch.in', $request->input('name'));
		 
		$m->to('cromacampusleads@gmail.com', "")->subject($subject);				
		});  
			 
			 
			 
			 
			
			
			
			
			
			
			
			
			
			
			
			
					return response()->json(['status'=>1,'msg'=>'Successfully query added'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not added query'],400);
			}  
		}
		
		 
		
    }
	
	public function referEarnSave(Request $request)
    { 
	
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		//echo"<pre>";print_r($_POST);die;
        if($request->ajax()){
			$validator = Validator::make($request->all(),[				 
				'refer_name'=>'required',
				'refer_mobile'=>'required',				 			 
				'message'=>'required',			 
			
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			 
			 $studentsinquery = new Studentsinquery;
			 
			 $studentsinquery->name = $request->input('name');
			 $studentsinquery->mobile = $request->input('mobile');			 
			 $studentsinquery->refer_name = $request->input('refer_name');
			 $studentsinquery->refer_mobile = $request->input('refer_mobile');
			 $studentsinquery->message = $request->input('message');
			 	//echo"<pre>";	print_r($studentsinquery);die;	 			 
			if($studentsinquery->save()){ 
			
			
			
			 $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		//	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			//	$headers .= 'From: enquiry@cromacampus.com' . "\r\n";
			$headers .= 'From: CromaCampus <enquiry@cromacampus.com>';
			$to="cromacampusleads@gmail.com";
			$to="brijesh.chauhan@cromacampus.com";
	    	$subject="Refer inquery from LMS - ".$request->input('name');
	     			  
			$message =' <tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('name').'</span><u></u><u></u></p>
			</td>
			</tr>
			
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('mobile').'</span><u></u><u></u></p>
			</td>
			</tr>
			    
				
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Refer Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('refer_name').'</span><u></u><u></u></p>
			</td>
			</tr>		
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Refer Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$request->input('refer_mobile').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Message:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('message').'</span><u></u><u></u></p>
			</td>
			</tr>
			 ';
			//$to="cromacampusleads@gmail.com";
			
			 
			  $stdemail="";
			 $codemail="";
			 $coordinator="";
			 
			// echo "<pre>";print_r($_FILES);die;lms.class@cromacampus.com
		$to="brijesh.chauhan@cromacampus.com";
		Mail::send('emails.send_lead_inquiry', ['msg'=>$message], function ($m) use ($message,$request,$subject,$stdemail,$codemail) {
		$m->from('info@learnpitch.com', $request->input('name'));
		 
		$m->to('brijesh.chauhan@cromacampus.com', "")->subject($subject);				
		});  
			 
			 
			 
			 
			
			
			
			
					return response()->json(['status'=>1,'msg'=>'Successfully Refer added'],200);
				 
			}else{
				return response()->json(['status'=>0,'msg'=>'not added Refer'],400);
			}  
		}
		
		 
		
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
				 
					$student = FeesStudents::find($id);	 
					// echo "<pre>";print_r($student);die;
					$photo = $request->file('image');
					if($photo)
					{
					$destinationPath = base_path() . '/public/uploads/image/';
					$image =$photo->getClientOriginalName();
					$image = rand(111111,999999).$image;
					$photo->move($destinationPath, $image);	
					$student->pic_image = $image;

					}	
 					
					if($student->save()){					
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
	 
		$delet_data = FeesStudents::find($id);	
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
		$del = FeesStudents::where('id',$id)->update($edit_data);		 		
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
