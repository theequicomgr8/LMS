<?php

namespace App\Http\Controllers\genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
 
use Auth;
use Hash;
use Validator;
use DB;
use Session;
use Carbon\Carbon;
 use App\FeesBatches;
 use App\FeesStudents;
 use App\FeesCourse;
 use App\CoursesComplete;
 use App\CoursesContent;
 use App\CoursesSubContent;
 use App\CoursesLastContent;
 use App\CoursesVideo;
 use App\CoursesNotes;
 use App\CoursesAssignment;
 use App\FeesTrainer;
 
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        
	   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$sid=null)
    {		 
        
       // echo "dashboard";die;
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
	 	//echo $role;die;
		if($request->wantsJson()){	
		 				
		if($role=="students"){		
  
			if(!is_null($sid) || !empty($sid)){		 
				 
			$std_id_c= explode(',',$sid);
			$studID = $std_id_c[0];
			$studCourse = $std_id_c[1];
				
			}else{
				$feesStudents=	FeesStudents::where('phone',Session::get('mobile'))->orderby('id','asc')->first();
				$studID = $feesStudents->id;
				$studCourse = $feesStudents->courses;

			} 
			
		 
			// FIND TOTAL LEADS OF A COUNSELLOR
			 $response= []; 
	
		//$std_id_c= explode(',',$sid);
		//$studID = $std_id_c[0];
		//$studCourse = $std_id_c[1];
	//	echo "<pre>";print_r($feesStudents);die;
	 
		$getstudent = DB::connection('mysql2')->table('wp_students_details as std');	 
		$getstudent = $getstudent->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$getstudent = $getstudent->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$getstudent = $getstudent->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		$getstudent=$getstudent->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name','std.stud_batch_id as batch_id');	 				
	 	
 		
		$getstudent=$getstudent->where('std.id','=',$studID);		 
		$getstudent=$getstudent->where('std.courses','=',$studCourse);	
		$getstudent=$getstudent->first();	 
	//	echo "<pre>";print_r($getstudent);die;
		if($getstudent){		
		$response['stud_id'] = $studID;
		$response['stud_name'] = $getstudent->name;
		$response['stud_email'] = $getstudent->email;
		$response['stud_phone'] = $getstudent->phone;
		$response['stud_course'] = $getstudent->course;
		$response['stud_to_be_paid'] = $getstudent->to_be_paid;
		 $response['stud_course_short'] =(strlen($getstudent->course) > 16 ? substr($getstudent->course,0,16).'..' : $getstudent->course);
	//	$response['stud_course_short'] = (strlen($getstudent->course) > 10 ? $getstudent->course : $getstudent->course);
		$response['stud_attendace'] = $getstudent->attendancecount;
		$response['stud_batch_attendance'] = $getstudent->attendancebatch;
	 
	    $response['stud_batch_name'] = $getstudent->batchname;
	        $response['stud_batch_short'] = (($getstudent->batchname) ? ($getstudent->batchname) : $getstudent->batchname);
		$response['stud_trainer_name'] = $getstudent->trainer_name; 
		$response['stud_batch_start'] = date('d M Y',strtotime($getstudent->batch_created_on));
	//	$response['stud_attendancebatch'] = $getstudent->attendancebatch;
	//	$response['stud_occurrence'] = $getstudent->occurrence;
		
	/*	if(!empty($getstudent->batch_id)){
		$stundent =FeesStudents::where('stud_batch_id', $getstudent->batch_id)->get();
		}else{
			$stundent=0;
		}
			 
	
		
		$studlist="";	
		  $i=0; if(!empty($stundent)){ 
		       $countstudent =count($stundent);
		  foreach($stundent as $stud){ 
			    $i++;
			 
	    	 if($i==1){
				$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
			$color= ('#' . $rand);
			}else if($i==2){
				$color="#3399FF";
			}else if($i==3){
				$color="#FF5E33";				
			}else if($i==4){ 
			$color="#33FFF9";
			}else if($i==5){ 
			$color="#FCFF33";
			}else if($i==6){ 
			$color="#FF4C33";
			}else if($i==7){ 
			$color="#FF33B2";
			}else if($i==8){ 
			$color="#AFFF33";
			}else if($i==9){ 
			$color="#161814";
			}else if($i==10){ 
			$color="#F51C1C";
			} 			    
			$names= explode(' ',ucwords($stud->name));
			if(!empty($names)){
			$resultname="";		 	 				 
			$resultname = substr(ucwords($names['0']),0,2);		 					 				
			}else{
			$resultname .="&nbsp;";
			}
		    $studlist .= '<a href="" class="student-name" style="background:'.$color.';margin-left:-9.6px" target="_blank" title="'.ucwords($stud->name).'">
			'.ucwords($resultname).'</a>';  
			} }else{
			$studlist="";
			$countstudent=0;
			}				   
			 	$response['stud_image_list']=$studlist.' '.$countstudent.' Student';
		
		*/
		
		
		if($getstudent->attendancebatch){
			$response['stud_count_attendance'] =round(($getstudent->attendancecount*100)/$getstudent->attendancebatch);
			$response['stud_take_attendance'] ="".$getstudent->attendancecount."/".$getstudent->attendancebatch;
			
		}else{
			$response['stud_count_attendance']=0;
			$response['stud_take_attendance']="0/0";
		}
		
	//	echo $response['stud_count_attendance'];
	 
					$headinghed = DB::table('courses_heading as heading');				 
					$headinghed= $headinghed->where('course_id',$getstudent->courses);					 
					$headinghed= $headinghed->get();  		 
					$headingtotalhed =$headinghed->count();					 
					if(!empty($headinghed)){	
					$headingcompletehed=0;
					$contentstotalhed=0;
					$contentcompletehed=0;
					$subcontentstotalhed=0;
					$subcontentcompletehed=0;
					$lastcontentstotalhed=0;
					$lastcontentcompletehed=0;
					foreach($headinghed as $course){						 
					$headingcompletehed += CoursesComplete::where('batch_id',$getstudent->stud_batch_id)->where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->where('heading_id',$course->id)->where('status',1)->count();	
					 
					 
					$contentshed = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotalhed += $contentshed->count();

					if($contentshed){	
					foreach($contentshed as $content){
					$contentcompletehed += CoursesComplete::where('batch_id',$getstudent->stud_batch_id)->where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontentshed = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotalhed +=$subcontentshed->count();
					if($subcontentshed){										
					foreach($subcontentshed as $sub){
					$subcontentcompletehed += CoursesComplete::where('batch_id',$getstudent->stud_batch_id)->where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->where('subcontent_id',$sub->id)->where('status',1)->count(); 

					 $lastcontentshed = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotalhed +=$lastcontentshed->count();
					if($lastcontentshed){										
					foreach($lastcontentshed as $last){
					$lastcontentcompletehed += CoursesComplete::where('batch_id',$getstudent->stud_batch_id)->where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
						//echo $headingcompletehed;				 
					$totalcousehed= $headingtotalhed+$contentstotalhed +$subcontentstotalhed +$lastcontentstotalhed;
					$completetotalhed= $headingcompletehed+$contentcompletehed +$subcontentcompletehed +$lastcontentcompletehed;
					//echo $completetotalhed;
					 if($totalcousehed){						 
						 $response['stud_c_per']=intval(($completetotalhed*100)/$totalcousehed);
						 $response['stud_course_compete']= $completetotalhed.'/'.$totalcousehed;
						 
					 }else{
						 $response['stud_c_per']=0;
						 $response['stud_course_compete']="0/0";
					 }
					 
		
		
		 
				if($getstudent->first_feed=='1'){ 				
				 $response['std_feedback']= intval(1/3*100);
				}else if($getstudent->first_feed=='2'){
				$response['std_feedback']= intval(2/3*100);
				}else if($getstudent->first_feed=="3"){
				$response['std_feedback']= intval(3/3*100); 				
				}else{
					$response['std_feedback']=0;
				}
				$feespending = DB::connection('mysql2')->table('wp_fees_details as fees')->where('s_id',$getstudent->std_id)->sum('paid_amt');
				if($feespending){ 				
				$response['std_feespending']= $getstudent->to_be_paid-$feespending; 
				
				}else{
					$response['std_feespending']=0;
				}
				
		
		 
			  if(isset($getstudent->next_due_date) && $getstudent->next_due_date=='0000-00-00 00:00:00' ){  			  
			  $response['std_due_date']= "N/A"; 			  
			  }else{ 			  
			  $response['std_due_date']= date('d-M-y',strtotime($getstudent->next_due_date)); 
			  
			  } 
		
				$coursesVideos= CoursesVideo::where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->get()->count();
				if($coursesVideos){
				$response['std_total_c_video'] ="0/".$coursesVideos;
				}else{
				$response['std_total_c_video'] ="0/0";
				}

				$coursesNotess= CoursesNotes::where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->get()->count();
				if($coursesNotess){
				$response['std_total_c_notes'] ="0/".$coursesNotess;
				}else{
				$response['std_total_c_notes'] ="0/0";
				}


				$coursesAssignments= CoursesAssignment::where('trainer_id',$getstudent->trainer)->where('course_id',$getstudent->courses)->get()->count();
				if($coursesAssignments){			
				$response['std_total_c_assign'] ="0/".$coursesAssignments;
				}else{
				$response['std_total_c_assign'] ="0/0";
				} 

				if($getstudent->first_feed=='1'){
				$response['std_total_feedback'] =1;			
				}else if($getstudent->first_feed=='2'){ 
				$response['std_total_feedback'] =2;			
				}else if($getstudent->first_feed=="3"){			
				$response['std_total_feedback'] =3;	 

				} 

 
		
		
		
		
		
		
		
		//echo $response['stud_count_attendance'];
		
		//echo $response['stud_count_attendance'];
	//	$response['stud_name'] = $getstudent->name;
		//$response['stud_name'] = $getstudent->name;
		
		//echo $getstudent->attendancebatch;
			}
		
		//echo "<pre>";print_r($studentdash);die;
			return response()->json(compact('response'),200); 
			
		}
		 
		}
	//	$total_students = FeesStudents::get()->count();
	//	$total_batch = FeesBatches::get()->count();
	//	$total_course = FeesCourse::get()->count();
	//	$total_trainer = FeesTrainer::get()->count();
	//	$compete_students = FeesStudents::where('stud_decided_fees','<=','1000')->get()->count();
	//	$placement_students = FeesStudents::where('stud_decided_fees','<=','0')->get()->count();
		
		if($role=="students"){
		
		$studentdash = DB::connection('mysql2')->table('wp_students_details as std');	 
		$studentdash = $studentdash->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$studentdash = $studentdash->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$studentdash = $studentdash->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		$studentdash=$studentdash->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name','trainer.meetingurl as trainer_meetingurl','batch.meetingurl as batch_meetingurl');	 				
		$studentdash=$studentdash->where('phone','=',Session::get('mobile'));		
		$studentdash=$studentdash->orderby('std.id','desc');		
		$studentdash=$studentdash->get();	 
		
	//	echo "<pre>";print_r($studentdash);die;
		if(!empty($studentdash)){
					$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$studentdash[0]->courses);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('heading_id',$course->id)->count();	
					 
					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('content_id',$content->id)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('subcontent_id',$sub->id)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('lastcontent_id',$last->id)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;
					 
					 if(!empty($totalcousedh)){
						 $coursecompetion= intval(($completetotaldh*100)/$totalcousedh);
					 }else{
						 $coursecompetion=0;
					 }
					 
					 
		}else{
			 $coursecompetion=0;
		}
					 
					 
				/*	$coursesVideo= CoursesVideo::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();					 
					 $coursesNotes= CoursesNotes::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();
					 $coursesAssignment= CoursesAssignment::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();*/
					 
					 
					//$blogs = DB::connection('mysql5')->table('cc_posts as post')->where('post_type', '=', 'blogs')->where('post_status','publish')->limit(3)->orderby('id','desc')->get();	
					$blogs=[];
					
			// echo "<pre>";print_r($studentdash);die;
			
		    $basicdetail=DB::connection('mysql2')->table('wp_students_details')->where('phone',$mobile)->first();
		
			
        return view('genie.dashboard.students',['studentdash'=>$studentdash,'totalcousedh'=>$totalcousedh,'coursecompetion'=>$coursecompetion,'blogs'=>$blogs,'completetotaldh'=>$completetotaldh,'basicdetail'=>$basicdetail]);
		
		}else if($role=="trainer"){
			
			$runningbatches = DB::connection('mysql2')->table('wp_batches_details as batches');
			$runningbatches = $runningbatches->join('wp_courses_details as course','batches.batch_course','=','course.id');
			$runningbatches = $runningbatches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
			$runningbatches = $runningbatches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id');		
			$runningbatches= $runningbatches->where('trainer.trainer_phone',Session::get('mobile'));				 
			$runningbatches= $runningbatches->where('batches.batch_visibility','1');
			$runningbatches= $runningbatches->where('batches.status','0');
			$runningbatches= $runningbatches->orderBy('batches.id','DESC')->get();
			
			$batches = DB::connection('mysql2')->table('wp_batches_details as batches');
			$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
			$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
			$batches = $batches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id');		
			$batches= $batches->where('trainer.trainer_phone',Session::get('mobile'));				 
			$batches= $batches->where('batches.batch_visibility','1');
			$batches= $batches->where('batches.status','0');
			$batches= $batches->orderBy('batches.id','DESC')->count();
				
			$batchesfinish = DB::connection('mysql2')->table('wp_batches_details as batches');
			$batchesfinish = $batchesfinish->join('wp_courses_details as course','batches.batch_course','=','course.id');
			$batchesfinish = $batchesfinish->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
			$batchesfinish = $batchesfinish->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id');		
			$batchesfinish= $batchesfinish->where('trainer.trainer_phone',Session::get('mobile'));				 
			$batchesfinish= $batchesfinish->where('batches.batch_visibility','1');
			$batchesfinish= $batchesfinish->where('batches.status',2);
			$batchesfinish= $batchesfinish->orderBy('batches.id','DESC')->count();
			
		
			
		$paidinvoice = DB::connection('mysql2')->table('wp_generate_invoice as invoice');		 
		$paidinvoice = $paidinvoice->join('wp_batches_details as batches','invoice.batch_id','=','batches.id');
		$paidinvoice = $paidinvoice->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$paidinvoice = $paidinvoice->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$paidinvoice = $paidinvoice->select('invoice.*','batches.*','invoice.id as invoice_id','trainer.name as trainer_name','course.course as course_name');				 
		$paidinvoice= $paidinvoice->where('trainer.trainer_phone',Session::get('mobile'));
		$paidinvoice= $paidinvoice->where('invoice.pay_status','1');		 
		$paidinvoice= $paidinvoice->orderBy('invoice.id','DESC')->count();	
		
		
		$paidamount = DB::connection('mysql2')->table('wp_generate_invoice as invoice');		 
		$paidamount = $paidamount->join('wp_batches_details as batches','invoice.batch_id','=','batches.id');
		$paidamount = $paidamount->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$paidamount = $paidamount->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$paidamount = $paidamount->select('invoice.*','batches.*','invoice.id as invoice_id','trainer.name as trainer_name','course.course as course_name', DB::raw("SUM(invoice.pay_amount) as total_pay_amount"),
                DB::raw("SUM(invoice.temp_advance) as total_advance"));				 
		$paidamount= $paidamount->where('trainer.trainer_phone',Session::get('mobile'));
		$paidamount= $paidamount->where('invoice.pay_status','1');		 
		$paidamount= $paidamount->groupBy('invoice.trainer_pay_id');		 
		$paidamount= $paidamount->orderBy('invoice.id','DESC')->first();
		
			return view('genie.dashboard.trainer',['batches'=>$batches,'batchesfinish'=>$batchesfinish,'paidinvoice'=>$paidinvoice,'paidamount'=>$paidamount,'runningbatches'=>$runningbatches]);
			
		}else if($role=="Admin"){
			
			
				//	$total_students = FeesStudents::get()->count();
	//	$total_batch = FeesBatches::get()->count();
	//	$total_course = FeesCourse::get()->count();
	//	$total_trainer = FeesTrainer::get()->count();
	//	$compete_students = FeesStudents::where('stud_decided_fees','<=','1000')->get()->count();
	//	$placement_students = FeesStudents::where('stud_decided_fees','<=','0')->get()->count();
				return view('genie.dashboard.trainer',['total_students'=>$total_students,'total_batch'=>$total_batch,'total_course'=>$total_course,'total_trainer'=>$total_trainer,'compete_students'=>$compete_students,'placement_students'=>$placement_students]);
			
		}
    } 
	
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentDashboard(Request $request, $sid)
    {		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		 
		//echo $sid;die;
		$std_id_c= explode(',',$sid);
		$studID = $std_id_c[0];
		$studCourse = $std_id_c[1];
		//echo "<pre>";print_r($std_id_c);die;
	 
		$getstudent = DB::connection('mysql2')->table('wp_students_details as std');	 
		$getstudent = $getstudent->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$getstudent = $getstudent->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$getstudent = $getstudent->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		$getstudent=$getstudent->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');	 				
		//$studentdash=$studentdash->where('phone','=',Session::get('mobile'));	
 		
		$getstudent=$getstudent->where('std.id','=',$studID);		
 
		$getstudent=$getstudent->where('std.courses','=',$studCourse);		
		//$studentdash=$studentdash->orderby('std.std_id','desc');		
		$getstudent=$getstudent->first();	 		
		$response['stud_name'] = $getstudent->name;
	//	$response['stud_name'] = $getstudent->name;
		//$response['stud_name'] = $getstudent->name;
		
		
		//echo "<pre>";print_r($studentdash);die;
			return response()->json(compact('response'),200);
		/* $total_students = FeesStudents::get()->count();
		$total_batch = FeesBatches::get()->count();
		$total_course = FeesCourse::get()->count();
		$total_trainer = FeesTrainer::get()->count();
		$compete_students = FeesStudents::where('stud_decided_fees','<=','1000')->get()->count();
		$placement_students = FeesStudents::where('stud_decided_fees','<=','0')->get()->count();
		
		if($role=="students"){
		
		$studentdash = DB::connection('mysql2')->table('wp_students_details as std');	 
		$studentdash = $studentdash->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$studentdash = $studentdash->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$studentdash = $studentdash->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		$studentdash=$studentdash->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name');	 				
		$studentdash=$studentdash->where('phone','=',Session::get('mobile'));		
		$studentdash=$studentdash->orderby('std.id','desc');		
		$studentdash=$studentdash->get();	 
		
		//echo "<pre>";print_r($studentdash);die;
		if(!empty($studentdash)){
					$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$studentdash[0]->courses);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('heading_id',$course->id)->count();	
					 
					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('content_id',$content->id)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('subcontent_id',$sub->id)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('lastcontent_id',$last->id)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;
					 
					 if(!empty($totalcousedh)){
						 $coursecompetion= intval(($completetotaldh*100)/$totalcousedh);
					 }else{
						 $coursecompetion=0;
					 }
					 
					 
		}else{
			 $coursecompetion=0;
		}
					 
					 
					$coursesVideo= CoursesVideo::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();					 
					 $coursesNotes= CoursesNotes::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();
					 $coursesAssignment= CoursesAssignment::where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->get();
					$blogs = DB::connection('mysql5')->table('cc_posts as post')->where('post_type', '=', 'blogs')->limit(5)->orderby('id','desc')->get();	
					
		 
			
        return view('genie.dashboard.students',['total_students'=>$total_students,'total_batch'=>$total_batch,'total_course'=>$total_course,'total_trainer'=>$total_trainer,'compete_students'=>$compete_students,'placement_students'=>$placement_students,'studentdash'=>$studentdash,'totalcousedh'=>$totalcousedh,'coursecompetion'=>$coursecompetion,'blogs'=>$blogs,'coursesVideo'=>$coursesVideo,'coursesNotes'=>$coursesNotes,'coursesAssignment'=>$coursesAssignment,'completetotaldh'=>$completetotaldh]);
		
		}else if($role=="trainer"){
			
			return view('genie.dashboard.trainer',['total_students'=>$total_students,'total_batch'=>$total_batch,'total_course'=>$total_course,'total_trainer'=>$total_trainer,'compete_students'=>$compete_students,'placement_students'=>$placement_students]);
			
		}else if($role=="Admin"){
			
				return view('genie.dashboard.trainer',['total_students'=>$total_students,'total_batch'=>$total_batch,'total_course'=>$total_course,'total_trainer'=>$total_trainer,'compete_students'=>$compete_students,'placement_students'=>$placement_students]);
			
		}
		 */
		
		
		
    } 
	
 
  
	 
  
 
 
 
 
 
 
}
