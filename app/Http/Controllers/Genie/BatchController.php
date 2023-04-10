<?php

namespace App\Http\Controllers\genie;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
 use App\User;
 use App\FeesBatches;
 use App\FeesStudents;
 use App\FeesCourse;
 use App\FeesTrainer;
 use App\FeesStudentsAttendance;
  use App\FeesBatchsAttendance;
 use App\CoursesHeading;
use App\CoursesContent;
use App\CoursesSubContent;
use App\CoursesLastContent;
use App\CoursesNotes;
use App\CoursesVideo;
use App\CoursesAssignment;
use App\Logactivity;
use App\CoursesComplete;
 use Auth;
 use DB;
 use Carbon\Carbon;
 use Session;
 use Mail;
class BatchController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
		//protected $connection = 'mysql2';
		date_default_timezone_set('Asia/Kolkata');
    }
	
	  
	
	
	public function index(Request $request)
	{
		
		  return view('genie.batch.index');
		
	}
	
	public function runningBatches(Request $request)
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
		
		$trainers  =FeesTrainer::get();
		$courses  =FeesCourse::get();
		
				$runningbatches = DB::connection('mysql2')->table('wp_batches_details as batches');
		$runningbatches = $runningbatches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$runningbatches = $runningbatches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$runningbatches = $runningbatches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id');		
        if($role=="Admin" || $role=="Manager"){		
        
        }else{				
        $runningbatches= $runningbatches->where('trainer.trainer_phone',Session::get('mobile'));				
        }
	//	$runningbatches= $runningbatches->where('trainer.trainer_phone',Session::get('mobile'));				 
		$runningbatches= $runningbatches->where('batches.batch_visibility','1');
		$runningbatches= $runningbatches->where('batches.status','0');
		$runningbatches= $runningbatches->orderBy('batches.id','DESC')->get();
	if($role=="Admin" || $role=="Manager"){	
		  return view('genie.batch.adminrunningBatches',['search'=>$search,'trainers'=>$trainers,'courses'=>$courses,'runningbatches'=>$runningbatches]);
	}else{
	    
	     return view('genie.batch.runningBatches',['search'=>$search,'trainers'=>$trainers,'courses'=>$courses,'runningbatches'=>$runningbatches]);
 
	}
	
	}
	
	public function getRunningBatchesPagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
		 
 
		$batches = DB::connection('mysql2')->table('wp_batches_details as batches');
		$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$batches = $batches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id','batches.id as batch_id');		
		 
			if($role=="Admin" || $role=="Manager"){			
				 
			if($request->input('search.trainer')!=''){					 
				$batches = $batches->where('trainer.id',$request->input('search.trainer'));
			}
			
			if($request->input('search.course')!=''){			
				 
				$batches = $batches->where('course.id',$request->input('search.course'));
			}		
			
			}else{				
				$batches= $batches->where('trainer.trainer_phone',Session::get('mobile'));				
			}
 
			$batches= $batches->where('batches.status','0');
			$batches= $batches->orderBy('batches.id','DESC');
		 
		if($request->input('search.value')!==''){
				$batches = $batches->where(function($query) use($request){
					$query->orWhere('batches.batch_starts_on','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('trainer.name','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('course.course','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('batches.batch_name','LIKE','%'.$request->input('search.value').'%');
				});
			}
			
			
			$batches = $batches->paginate($request->input('length'));
		 
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $batches->total();
			$returnLeads['recordsFiltered'] = $batches->total();
			$returnLeads['recordCollection'] = [];

			foreach($batches as $batch){
				 $batches = DB::connection('mysql2')->table('wp_batches_details as batches');	
				 $getstudetns = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 $action="";
			 
					 
					 	if($role=="Admin" || $role=="Manager"){
						$coursesHeading = CoursesHeading::where('course_id',$batch->batchcourse_id)->where('bat_id',$batch->batch_id)->get();
						 	
						if(count($coursesHeading)>0){
						 $action .=' <a href="javascript:courseController.deleteCourseContentBatch('.$batch->batch_id.','.$batch->batchcourse_id.')" title="Delete Course Content" ><i class="fa fa-trash" aria-hidden="true"></i></a> ';	
						}else{					 	 
						$action .= '<a href="javascript:courseController.getCourseContentBatchForm('.$batch->batch_id.','.$batch->batchcourse_id.')" title="Add Course Content" class="btn-info">Add</a>'.' | ';
						}
						} 
					   $action .= '<a href="/batch/batch-details/'.base64_encode($batch->id).'" title="Course Content" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
				
			
					$getstudentsamt = FeesStudents::where('stud_batch_id',$batch->id)->get();
					if(!empty($getstudentsamt)){
					$summ=0;
					foreach($getstudentsamt as $studentamt){
					$summ +=$studentamt->next_due_amt;
					}
					}
					if(!empty($summ)){
					$feespending= "<b style='color:red;    font-size: 15px;'>Yes</b>";
					}else{

					$feespending= "<b style='color:green;    font-size: 15px;'>No</b>";
					}
						if($batch->occurrence=="WD"){
						$occurrence= "Weekday";
						}else if($batch->occurrence="WE"){
						$occurrence= "Weekend";
						}
					 
					  if($batch->batch_feedback==1){
						 $feed= "Done";
					 }else{
						 $feed= "No";
					 }
					 
					$data[] = [						
						(isset($batch->firstdate_attendance)?date('d-M-y',strtotime($batch->firstdate_attendance)):""),						 		 
							$batch->batch_name,							 
						$batch->course_name,					 
							$feespending,
						
						$occurrence,
						$batch->batch_starts_on.'-'.$batch->batch_end_on,
						$action,
						 
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	
	public function getFinishedBatchesPagination(Request $request)
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
		if($request->ajax()){
			 
 
			$batches = DB::connection('mysql2')->table('wp_batches_details as batches');	
			$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$batches = $batches->select('batches.*','trainer.name as trainer_name','course.course as course_name','batches.batch_course as batchcourse_id','batches.id as batch_id');		
		 
			if($role=="Admin" || $role=="Manager"){			
				 
			if($request->input('search.trainer')!=''){					 
				$batches = $batches->where('trainer.id',$request->input('search.trainer'));
			}
			if($request->input('search.course')!=''){	
				$batches = $batches->where('course.id',$request->input('search.course'));
			}		
			
			}else{				
				$batches= $batches->where('trainer.trainer_phone',Session::get('mobile'));				
			}
		 
			$batches= $batches->where('batches.batch_visibility','1');
			$batches= $batches->where('batches.status',2);
			$batches= $batches->orderBy('batches.id','DESC');
		 
		if($request->input('search.value')!==''){
				$batches = $batches->where(function($query) use($request){
					$query->orWhere('batches.batch_starts_on','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('trainer.name','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('course.course','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('batches.batch_name','LIKE','%'.$request->input('search.value').'%');
				});
			}
			$batches = $batches->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $batches->total();
			$returnLeads['recordsFiltered'] = $batches->total();
			$returnLeads['recordCollection'] = [];
 
			foreach($batches as $batch){
			    $action="";
				 $batches = DB::connection('mysql2')->table('wp_batches_details as batches');	
				 $getstudetns = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 
				 if(count($getstudetns)>0){ 						
						$batchId= '<a href="/batch/batch-details/'.$batch->id.'" title="Students in this Batch"> '.$batch->id.'</a>';
						}else{
						$batchId= "<span style='color:red' title='No Students in this Batch'>".$batch->id."</spans>";
						}  
					 
					$getstudentsamt = FeesStudents::where('stud_batch_id',$batch->id)->get();
					if(!empty($getstudentsamt)){
					$summ=0;
					foreach($getstudentsamt as $studentamt){
					$summ +=$studentamt->next_due_amt;
					}
					}
					if(!empty($summ)){
					$feespending= "<b style='color:red;    font-size: 15px;'>Yes</b>";
					}else{

					$feespending= "<b style='color:green;    font-size: 15px;'>No</b>";
					}
    					  
					  if($batch->batch_feedback=='1'){
						 $feed= "Done";
						 
					 }else{
						  $feed= "No";
					 }
					 
					  $action .= '<a href="/batch/batch-details/'.base64_encode($batch->batch_id).'" title="Course Content" target="_blank" ><i class="fa fa-eye" aria-hidden="true"></i></a> ';
					$data[] = [						
						'',
						(isset($batch->firstdate_attendance)?date('d-M-y',strtotime($batch->firstdate_attendance)):""),							 		 
						$batch->batch_name,						 
						$batch->course_name,					 
						$batch->trainer_name,		
						$feespending,
						$batch->occurrence,
						$batch->batch_starts_on.'-'.$batch->batch_end_on,
						$batch->attendancebatch,
						((isset($batch->batch_course_status) && $batch->batch_course_status >0)?$batch->batch_course_status.'%':""),
						$feed,
						$action,
				  
						 
						 
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	public function viewBatchDetails(Request $request , $id)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
   
        $batches = DB::connection('mysql2')->table('wp_batches_details as batches');		
        $batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
        $batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id'); 
        $batches = $batches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','batches.id as batch_id','course.course as course_name','batches.batch_course as batchcourse_id');
        $batches =$batches->where('batches.id',base64_decode($id));
        $batches =$batches->first();
        $c_id =$batches->batchcourse_id;
        $t_id =$batches->trainer_id;
        $b_id =$batches->batch_id;
        $traierdet= FeesTrainer::where('id',$batches->trainer_id)->first();
 
		$students =FeesStudents::where('stud_batch_id',base64_decode($id))->get();
		 
		$search = ['search["batch_id"]'=>base64_decode($id)];
		if($request->has('search')){
			$search = $request->input('search');
		}
		 
		  return view('genie.batch.viewBatchDetails',['search'=>$search,'students'=>$students,'batches'=>$batches,'batch_id'=>$id,'traierdet'=>$traierdet,'c_id'=>$c_id,'t_id'=>$t_id,'b_id'=>$b_id]);
		
	}
	
	public function viewBatchDetailswork(Request $request)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
       $id="Mzc3OQ==";
		$batches = DB::connection('mysql2')->table('wp_batches_details as batches');		
		$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id'); 
		$batches = $batches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','batches.id as batch_id','course.course as course_name','batches.batch_course as batchcourse_id');
		$batches =$batches->where('batches.id',base64_decode($id));
		$batches =$batches->first();

		$students =FeesStudents::where('stud_batch_id',base64_decode($id))->get();
		 
		$search = ['search["batch_id"]'=>base64_decode($id)];
		if($request->has('search')){
			$search = $request->input('search');
		}
		 
		  return view('genie.batch.viewBatchDetailswork',['search'=>$search,'students'=>$students,'batches'=>$batches,'batch_id'=>$id]);
		
	}
	
	public function getviewBatchDetailsPagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		if($request->ajax()){
			 
 
			$batches = DB::connection('mysql2')->table('wp_batches_details as batches');		
			 
			$batches = $batches->join('wp_students_details as std','batches.id','=','std.stud_batch_id','left outer');
			$batches = $batches->join('wp_courses_details as course','std.courses','=','course.id','right outer');
		$batches = $batches->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');		
		$batches = $batches->select('batches.*','std.*','std.name as std_name','trainer.name as trainer_name','course.course as course_name');		
			$batches= $batches->where('batches.id',base64_decode($request->input('search.batch_id')));
		 
		if($request->input('search.value')!==''){
				$batches = $batches->where(function($query) use($request){
					$query->orWhere('std.name','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('trainer.name','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('course.course','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('batches.batch_name','LIKE','%'.$request->input('search.value').'%');
				});
			}
			$batches = $batches->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $batches->total();
			$returnLeads['recordsFiltered'] = $batches->total();
			$returnLeads['recordCollection'] = [];

         $i=0;
			foreach($batches as $batch){
			      $i++;
			 
	    	 if($i==1){
				$rand = str_pad(dechex(rand(0x000F00, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
			$color= ('#' . $rand);
			}else if($i==2){
				$color="#3399FF";
			}else if($i==3){
				$color="#FF5E33";				
			}else if($i==4){ 
			$color="#FF33B2";
			}else if($i==5){ 
			$color="#008000";
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
			} else{
			    	$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
		    	$color= ('#' . $rand);
			}
                        $names= explode(' ',ucwords($batch->name));
                        
                        if(!empty($names)){
                        $resultname="";
                  	 				 
                        $resultname = substr(ucwords($names['0']),0,2);
                     					 				
                        }else{
                        $resultname .="&nbsp;";
                        }
					if($batch->next_due_amt>0){
					$std_name= "<span class='student_image' style='background:$color'> ".$resultname."</span>"."<span title='Fees Pending' class='feed-i' >".$batch->std_name."</span>"."  <i class='fa fa-star' aria-hidden='true' style='color:red' title='Fees Pending'></i>";
					}else{
					$std_name= "<span class='student_image' style='background:$color'> ".$resultname."</span>"." <span title='' class='feed-i' > ".$batch->std_name."</span>";
					}
				  
    					 
					$currentdate = date('Y-m-d');
					if($currentdate == date('Y-m-d',strtotime($batch->attenddate))){														
					$todayattend = "Yes".'('.date('H:i:s',strtotime($batch->attenddate)).')';	
					$disable= "disabled";
					}else{
					$disable= "";
					$todayattend="";
					}
					 
					 
					if($batch->rating>0){
					$rating= $batch->rating;
					}else{
					$rating= 0;
					}
					
					if($batch->first_feed>0){
					$first_feed= "<i class='fa fa-check-square' aria-hidden='true' style='color:green;margin-left:38px;' title='First Feed Done'></i>";
					}else{
					$first_feed= "<i class='fa fa-remove' aria-hidden='true' style='color:red;margin-left:38px;' title='First Feed Pending'></i><input type='hidden' name='first_feed' class='first_feed' value='1'>";
					}
					if($batch->second_feed>0){
					$second_feed= "<i class='fa fa-check-square' aria-hidden='true' style='color:green;margin-left: 38px;' title='Second Feed Done'></i>";
					}else{
					$second_feed= "<i class='fa fa-remove' aria-hidden='true' style='color:red;margin-left:38px;' title='Second Feed Pending'></i>";
					}
					
					if($batch->third_feed>0){
					$third_feed= "<i class='fa fa-check-square' aria-hidden='true' style='color:green;margin-left:38px;' title='Third Feed Done'></i>";
					}else{
					$third_feed= "<i class='fa fa-remove' aria-hidden='true' style='color:red;margin-left:38px;' title='Third Feed Pending'></i>";
					} 
					
					
				 
					 
					$data[] = [						
						$std_name,
						"<th><input type='checkbox' class='check-box' style='margin-left: 38px;' value='$batch->id' ".$disable ." ></th>",						 
						$batch->attendancecount,						 
						$todayattend,
						$batch->course_name,
						$first_feed,
						$second_feed,
						$third_feed,
						 
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	public function finishedBatches(Request $request)
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
		
		 $trainers  =FeesTrainer::get();
		$courses  =FeesCourse::get();
        $batchesfinish = DB::connection('mysql2')->table('wp_batches_details as batches');
        $batchesfinish = $batchesfinish->join('wp_courses_details as course','batches.batch_course','=','course.id');
        $batchesfinish = $batchesfinish->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
        $batchesfinish = $batchesfinish->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','course.course as course_name','batches.batch_course as batchcourse_id');		
            if($role=="Admin" || $role=="Manager"){	
        
            }else{
                
                $batchesfinish= $batchesfinish->where('trainer.trainer_phone',Session::get('mobile'));	
            }
        $batchesfinish= $batchesfinish->where('batches.batch_visibility','1');
        $batchesfinish= $batchesfinish->where('batches.status',2);
        $batchesfinish= $batchesfinish->orderBy('batches.id','DESC')->get();
        if($role=="Admin" || $role=="Manager"){	
        return view('genie.batch.adminfinishedBatches',['search'=>$search,'trainers'=>$trainers,'courses'=>$courses,'batchesfinish'=>$batchesfinish]);
        }else{
        return view('genie.batch.finishedBatches',['search'=>$search,'trainers'=>$trainers,'courses'=>$courses,'batchesfinish'=>$batchesfinish]);
        
        }
	}
	
	public function attendance(Request $request)
	{  
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		$ids = $request->input('ids');
		$unids = $request->input('unids');
	    
		if(!empty($ids)){
		foreach($ids as $id){
			
				$students = FeesStudents::findorFail($id);
				
				$todaydate = date('Y-m-d');	
				if($todaydate == date('Y-m-d',strtotime($students->attenddate))){
				}else if($students){	 
				 
				$attenddate = date('Y-m-d H:i:s');
				$students->attendancecount= $students->attendancecount + 1;
				$students->attenddate= date('Y-m-d H:i:s');				
			 
				if($students->save()){
				$feesstudentsattendance  = New FeesStudentsAttendance;
				$feesstudentsattendance->students_id  = $id;
				$feesstudentsattendance->attendate  =date('Y-m-d H:i:s');				 
				$feesstudentsattendance->save();				
		
				//update batch attendance count
				$batch = FeesBatches::findorFail($students->stud_batch_id);			 
				if($todaydate == date('Y-m-d',strtotime($batch->attenddatebatch))){
				}else{
				$batch->attendancebatch =$batch->attendancebatch +1;
				if($batch->attendancebatch=='1'){
				$batch->firstdate_attendance =date('Y-m-d H:i:s');				
				}
				$batch->attenddatebatch =date('Y-m-d H:i:s');
				$batch->save();
				
				$feesBatchsAttendance  = New FeesBatchsAttendance;
				$feesBatchsAttendance->trainer_id  = $batch->batch_trainer;
				$feesBatchsAttendance->batch_id  = $batch->id;
				$feesBatchsAttendance->attendate  =date('Y-m-d H:i:s');				 
				$feesBatchsAttendance->save();	
				 
				}
				}else{
						$students->$students->attendancecount= $students->attendancecount - 1;
						$students->attenddate= "";
						$students->save();
				}					


				}
				
				
				//for mail start
				
				$getstudentrecords=DB::connection('mysql2')->table('wp_students_details')->where('id',$id)->first();
				
				 //$email=$getstudentrecords->email;
				 
				// $name=$getstudentrecords[$key]->name;
				$email="suman.krgr8@gmail.com";
				$name="Suman Singh";
				$dat=["name"=>$name];
		         $user['to']=$email;
		         Mail::send('mail',$dat,function($msg) use($user){
		         	 $msg->from('leads@leadpitch.in', 'LMS Class Notification');
		             $msg->to($user['to']);
		             $msg->subject('Attendance');
		         });

				//for mail end
				
		}
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Attendance Submited Successfully!'
			]
		],200);
	}else{
		
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Please select check box.'
			]
		],200);
		
	}
		
	}
	
	

	public function studentsAttendanceGoogleMeeting(Request $request,$s_id)
	{  
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		//echo $s_id;die;
		 
	 
		if(!empty($s_id)){
		 
			
				$students = FeesStudents::findorFail($s_id);
				$course = FeesCourse::findorFail($students->courses); 
				$todaydate = date('Y-m-d');	
				if($todaydate == date('Y-m-d',strtotime($students->attenddate))){
					 
				}else if($students){
				    
				$students->std_attance_status=1;
				$students->save();
				
				$trbatch = FeesBatches::findorFail($students->stud_batch_id);
				 
				if(!empty($trbatch)){
					if($trbatch->batch_attance_status=='1'){
					    
					    
					    
				$attenddate = date('Y-m-d H:i:s');
				$students->attendancecount= $students->attendancecount + 1;
				$students->attenddate= date('Y-m-d H:i:s');	
			 
				if($students->save()){
				$feesstudentsattendance  = New FeesStudentsAttendance;
				$feesstudentsattendance->students_id  = $s_id;
				$feesstudentsattendance->attendate  =date('Y-m-d H:i:s');				 
				$feesstudentsattendance->save();				
		
		
	        	 
					date_default_timezone_set('Asia/Kolkata');	
					$todaydate =date('Y-m-d');
					$checkatd= Logactivity::where('trainer_id',$students->trainer)->where('course_id',$course->id)->where('role','Student')->where('batch_id',$students->stud_batch_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
					if($checkatd){
					$logactivity = Logactivity::findorFail($checkatd->id);
					}else{
					$logactivity = new Logactivity;
					}

					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $students->name;
					$logactivity->mobile= $students->phone;
					$logactivity->trainer_id= $students->trainer;
					$logactivity->course_id= $course->id;
					$logactivity->batch_id= $students->stud_batch_id;
					$logactivity->role= "Student";
					$logactivity->technology= $course->course;
					$logactivity->live_class= "Yes";
					$logactivity->course_marked= "No";
					$logactivity->save();
				
		
				//update batch attendance count
				$batch = FeesBatches::findorFail($students->stud_batch_id);
				if(!empty($batch)){				
				if($todaydate == date('Y-m-d',strtotime($batch->attenddatebatch))){
					
					 $trainer = FeesTrainer::findorFail($batch->batch_trainer);	
                    date_default_timezone_set('Asia/Kolkata');
                    $todaydate =date('Y-m-d');
                    $checktrainer= Logactivity::where('trainer_id',$batch->batch_trainer)->where('course_id',$course->id)->where('role','Trainer')->where('batch_id',$batch->id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
                    if(!empty($checktrainer)){ 
                    $todaydate=date('Y-m-d');
                    if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	
                    
                    $logactivitys = Logactivity::findorFail($checktrainer->id);
                    $logactivitys->live_class= "Yes";
                    }else{
                    $logactivitys = new Logactivity;
                    $logactivitys->live_class= "Yes";
                    
                    }
                    }else{
                    
                    $logactivitys = new Logactivity;
                    $logactivitys->live_class= "Yes";
                    
                    
                    }
                    
                    $logactivitys->date= date('Y-m-d H:i:s');
                    $logactivitys->name= $trainer->name;
                    $logactivitys->mobile= $trainer->trainer_phone;
                    $logactivitys->trainer_id = $batch->batch_trainer;
                    $logactivitys->batch_id  = $batch->id;
                    $logactivitys->course_id = $course->id;
                    $logactivitys->role= "Trainer";
                    $logactivitys->technology= $course->course;
                    $logactivitys->save();
					
					
					
				}else{
				    
				$batch->attendancebatch =$batch->attendancebatch +1;
				if($batch->attendancebatch=='1'){
				$batch->firstdate_attendance =date('Y-m-d H:i:s');				
				}
				$batch->attenddatebatch =date('Y-m-d H:i:s');
				if($batch->save()){					
					$feesBatchsAttendance  = New FeesBatchsAttendance;
					$feesBatchsAttendance->trainer_id  = $batch->batch_trainer;
					$feesBatchsAttendance->batch_id  = $batch->id;
					$feesBatchsAttendance->attendate  =date('Y-m-d H:i:s');				 
					$feesBatchsAttendance->save();	
					
                    $trainer = FeesTrainer::findorFail($batch->batch_trainer);	
                    date_default_timezone_set('Asia/Kolkata');
                    $todaydate =date('Y-m-d');
                    $checktrainer= Logactivity::where('trainer_id',$batch->batch_trainer)->where('course_id',$course->id)->where('role','Trainer')->where('batch_id',$batch->id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
                    if(!empty($checktrainer)){ 
                    $todaydate=date('Y-m-d');
                    if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	
                    
                    $logactivitys = Logactivity::findorFail($checktrainer->id);
                    $logactivitys->live_class= "Yes";
                    }else{
                    $logactivitys = new Logactivity;
                    $logactivitys->live_class= "Yes";
                    
                    }
                    }else{
                    
                    $logactivitys = new Logactivity;
                    $logactivitys->live_class= "Yes";
                    
                    
                    }
                    
                    $logactivitys->date= date('Y-m-d H:i:s');
                    $logactivitys->name= $trainer->name;
                    $logactivitys->mobile= $trainer->trainer_phone;
                    $logactivitys->trainer_id = $batch->batch_trainer;
                    $logactivitys->batch_id  = $batch->id;
                    $logactivitys->course_id = $course->id;
                    $logactivitys->role= "Trainer";
                    $logactivitys->technology= $course->course;
                    $logactivitys->save();
				}
				}
				}
				}else{
						$students->$students->attendancecount= $students->attendancecount - 1;
						$students->attenddate= "";
						$students->save();
				}					
				}
				}
				}
		 
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Attendance Submited Successfully!'
			]
		],200);
	}else{
		
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Please select check box.'
			]
		],200);
		
	}
		
	}
	
	
	
	public function trainerAttendanceGoogleMeeting(Request $request,$b_id,$t_id)
	{  
	
 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  

 
	 
	if(!empty($b_id)){
				$todaydate = date('Y-m-d');	
				$batch = FeesBatches::findorFail($b_id);	
 				$studentdetails = FeesStudents::where('stud_batch_id',$b_id)->first();
 					$course = FeesCourse::findorFail($batch->batch_course);	
 					 $trainer = FeesTrainer::findorFail($batch->batch_trainer);	
				if($todaydate == date('Y-m-d',strtotime($batch->attenddatebatch))){
						date_default_timezone_set('Asia/Kolkata');
						$todaydate =date('Y-m-d');
						$checktrainer= Logactivity::where('trainer_id',$batch->batch_trainer)->where('course_id',$course->id)->where('role','Trainer')->where('batch_id',$batch->id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
						 

						if(!empty($checktrainer)){ 
						$todaydate=date('Y-m-d');
						if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

						$logactivitys = Logactivity::findorFail($checktrainer->id);
						$logactivitys->live_class= "Yes";
						}else{
						$logactivitys = new Logactivity;
						$logactivitys->live_class= "Yes";
						 
						}
						}else{

						$logactivitys = new Logactivity;
						$logactivitys->live_class= "Yes";
						 

						}

						$logactivitys->date= date('Y-m-d H:i:s');
						$logactivitys->name= $trainer->name;
						$logactivitys->mobile= $trainer->trainer_phone;
						$logactivitys->trainer_id = $batch->batch_trainer;
						$logactivitys->batch_id  = $batch->id;
						$logactivitys->course_id = $course->id;
						$logactivitys->role= "Trainer";
						$logactivitys->technology= $course->course;
						$logactivitys->save();
				}else{
					
				$batch->batch_attance_status =1;				
				$batch->save();
			     $trainer = FeesTrainer::findorFail($batch->batch_trainer);					 
				$course = FeesCourse::findorFail($batch->batch_course);				
				$students = FeesStudents::where('stud_batch_id',$b_id)->get();
				
				  
				
				if(!empty($students)){
					
						$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: <leads@leadpitch.in>' . "\r\n";
				 
					$to="lms.class@cromacampus.com";
					$subjects= " LMS Class Notification || ".$batch->batch_name;
					$message='<tr>
					<td style="border:solid #cccccc 1.0pt;padding:11.25pt 11.25pt 11.25pt 11.25pt">
					<table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
					<tbody>
					<tr>
					<td style="padding:0in 0in 15.0pt 0in">
					<p class="MsoNormal"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">A class through LMS is being conducted . Here are the details:</span><u></u><u></u></p>
					</td>
					</tr>

					<tr>
					<td style="padding:0in 0in 7.5pt 0in">
					<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Date Time:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
					'.date('d-M-y H:i:s').'</span><u></u><u></u></p>
					</td>
					</tr>
					<tr>
					<td style="padding:0in 0in 7.5pt 0in">
					<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Trainer Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
					'.$trainer->name.'</span><u></u><u></u></p>
					</td>
					</tr>
					<tr>
					<td style="padding:0in 0in 7.5pt 0in">
					<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Course :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
					'.$course->course.'</span><u></u><u></u></p>
					</td>
					</tr>
					<tr>
					<td style="padding:0in 0in 7.5pt 0in">
					<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Batch Name :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
					'.$batch->batch_name.'</span><u></u><u></u></p>
					</td>
					</tr>

					<tr><td style="padding:18pt 0in 0in 0in;"></td></tr>
					<tr>
					<td style="padding:0in 0in 7.5pt 0in">
					<p class="MsoNormal" style="text-decoration:underline"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Note:</span><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> This is a system generated email. Please do not reply.</span><u></u><u></u></p>
					</td>
					</tr>
					<tr>
					<td style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 5.0pt 0in"></td>
					</tr> 			 
					</tbody>
					</table>
					</td>
					</tr>
					';	
                        //->cc('brijesh.chauhan@cromacampus.com')
					Mail::send('emails.send_trainer_class', ['msg'=>$message], function ($m) use ($message,$request,$subjects,$to) {
					$m->from('leads@leadpitch.in', 'LMS Class Notification');
					$m->to($to, "")->subject($subjects);


					});
					
				foreach($students as $student){
					
				if($student->std_attance_status=='1'){
					
				$studentdetails = FeesStudents::findorFail($student->id);
				 
				$todaydate = date('Y-m-d');	
				if($todaydate == date('Y-m-d',strtotime($studentdetails->attenddate))){
					
				}else if($studentdetails){	 
				    
				    
				$attenddate = date('Y-m-d H:i:s');
				$studentdetails->attendancecount= $studentdetails->attendancecount + 1;
				$studentdetails->attenddate= date('Y-m-d H:i:s');	
			 
				if($studentdetails->save()){
				$feesstudentsattendance  = New FeesStudentsAttendance;
				$feesstudentsattendance->students_id  = $student->id;
				$feesstudentsattendance->attendate  =date('Y-m-d H:i:s');				 
				$feesstudentsattendance->save();				
		
		  

						date_default_timezone_set('Asia/Kolkata');	
						$todaydate =date('Y-m-d');
						$checkatd= Logactivity::where('trainer_id',$t_id)->where('course_id',$course->id)->where('role','Student')->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
						if($checkatd){
						$logactivity = Logactivity::findorFail($checkatd->id);
						}else{
						$logactivity = new Logactivity;
						}

						$logactivity->date= date('Y-m-d H:i:s');
						$logactivity->name= $student->name;
						$logactivity->mobile= $student->phone;
						$logactivity->trainer_id= $t_id;
						$logactivity->course_id= $course->id;
						$logactivity->batch_id= $b_id;
						$logactivity->role= "Student";
						$logactivity->technology= $course->course;
						$logactivity->live_class= "Yes";
						$logactivity->course_marked= "No";
						$logactivity->save();
						
                
		
		
		
				//update batch attendance count
				$stdbatch = FeesBatches::findorFail($studentdetails->stud_batch_id);
				if(!empty($stdbatch)){				
				if($todaydate == date('Y-m-d',strtotime($stdbatch->attenddatebatch))){
					
				}else{
				$stdbatch->attendancebatch =$stdbatch->attendancebatch +1;
				if($stdbatch->attendancebatch=='1'){
				$stdbatch->firstdate_attendance =date('Y-m-d H:i:s');				
				}
				$stdbatch->attenddatebatch =date('Y-m-d H:i:s');
				if($stdbatch->save()){					
					$feesBatchsAttendance  = New FeesBatchsAttendance;
					$feesBatchsAttendance->trainer_id  = $stdbatch->batch_trainer;
					$feesBatchsAttendance->batch_id  = $stdbatch->id;
					$feesBatchsAttendance->attendate  =date('Y-m-d H:i:s');				 
					$feesBatchsAttendance->save();	
					
                    
						date_default_timezone_set('Asia/Kolkata');
						$todaydate =date('Y-m-d');
						$checktrainer= Logactivity::where('trainer_id',$stdbatch->batch_trainer)->where('course_id',$course->id)->where('role','Trainer')->where('batch_id',$stdbatch->id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
						 

						if(!empty($checktrainer)){ 
						$todaydate=date('Y-m-d');
						if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

						$logactivitys = Logactivity::findorFail($checktrainer->id);
						$logactivitys->live_class= "Yes";
						}else{
						$logactivitys = new Logactivity;
						$logactivitys->live_class= "Yes";
						 
						}
						}else{

						$logactivitys = new Logactivity;
						$logactivitys->live_class= "Yes";
						 

						}

						$logactivitys->date= date('Y-m-d H:i:s');
						$logactivitys->name= $trainer->name;
						$logactivitys->mobile= $trainer->trainer_phone;
						$logactivitys->trainer_id = $stdbatch->batch_trainer;
						$logactivitys->batch_id  = $stdbatch->id;
						$logactivitys->course_id = $course->id;
						$logactivitys->role= "Trainer";
						$logactivitys->technology= $course->course;
						$logactivitys->save();

					
					
					
					
				}		
				}				
				}
				
				}else{
						$students->$students->attendancecount= $students->attendancecount - 1;
						$students->attenddate= "";
						$students->save();
				}					


				}
								
				 			
				 
				}
				}
				}
				}
			
			 
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Attendance Submited Successfully!'
			]
		],200);
	}else{
		
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Please select check box.'
			]
		],200);
		
	}
		
	}
	
	
	
	public function batchCourseStatus(Request $request,$val,$b_id)
	{  
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		 
		$completecourse = $val;
		$batch_id = $b_id;
	 
		if(!empty($completecourse)){
			$batch = FeesBatches::findorFail($batch_id);	

			$batch->batch_course_status= $completecourse;
			 
			if($batch->save()){
				return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Successfully Course Status!'
			]
		],200);
				
				
			}else{
				return response()->json([
			'statusCode'=>0,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Not Successfully  Course Status!'
			]
		],200);
			}
		 
		 
	} 
		
	}
	
	
	 
	
	
	public function allUser()
	{
		
		  return view('genie.user-list');
		
	}
	
	
	public function add(Request $request)
	{
		 $this->middleware('auth');
		if($request->isMethod('post') )
		{
			$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);
		
	 
		
				$user = new user;					
				$user->name = ucfirst($request->input('name'));
				$user->email = $request->input('email');				 
				$user->password =bcrypt($request->input('password'));
					
				 	
					
					if($user->save()){
						return redirect('/users')->with('success','User successfully added!');
						
						
					}else{
						return redirect('/users/add')->with('success','User not added!');
						
					}
		}
		return view('genie.user.register');
	}
			
	public function edit(Request $request, $id)
	{  
	   $this->middleware('auth');
		
		$data['edit_data'] = User::find($id);
		
		if($request->isMethod('post') )
		{
			$this->validate($request, [
            'name' => 'required|string|max:255', 
            'email'=>'required|max:250|unique:users,email,'.$id,			
        ]);
		
				$user = User::find($id);					
				$user->name = ucfirst($request->input('name'));
				$user->email = $request->input('email');
				if(!empty($request->input('password'))){
				$user->password =bcrypt($request->input('password'));

				}
					
					if($user->save()){
						return redirect('/users')->with('success','User updated successfully !');
					}else{
						return redirect('/users/edit/'.$id)->with('success','User not updated!');
						
					}
			
		}
	
		return view('genie.editregister',$data);
		
	}
		
		/**
	* Get user
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getuser(Request $request)
    {   
	
	 $this->middleware('auth');
        if($request->ajax()){
			
			$users = User::orderBy('id','desc');
			if($request->input('search.value')!==''){
				$users = $users->where(function($query) use($request){
				$query->orWhere('name','LIKE','%'.$request->input('search.value').'%');
				$query->orWhere('email','LIKE','%'.$request->input('search.value').'%');
				$query->orWhere('mobile','LIKE','%'.$request->input('search.value').'%');
				});
			}
			$users = $users->paginate($request->input('length'));
			$recordCollection = [];
			$data = [];
			$recordCollection['draw'] = $request->input('draw');
			$recordCollection['recordsTotal'] = $users->total();
			$recordCollection['recordsFiltered'] = $users->total();
		 
			foreach($users as $user){
			 
				 
				 			
				$data[] = [
					$user->name,
					$user->email,
				 
					 			 				 
		 ' <a href="/users/edit/'.$user->id.'"><i class="fa fa-edit" aria-hidden="true"></i></a> | <a href="/users/delete/'.$user->id.'"" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>' 
				];
			}
			$recordCollection['data'] = $data;
			return response()->json($recordCollection);
			
			
		}
    }
	public function deleted(Request $request,$id){
		 
		 $this->middleware('auth');
			$users = User::findorFail($id);
			if(!empty($users)){
				if($users->delete()){	
				 
					return redirect('/users')->with('success','User deleted successfully !');
					}else{
					return redirect('/users')->with('success','User not deleted!');
						
					}
							
			 
									 
			
			}
		 
	}
	 
	 
	 
	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourseContentDetails(Request $request, $b_id,$c_id,$t_id)
    {  
		if($request->ajax()){		 
		 	 //echo $id;die;
			$heading = DB::table('courses_heading as heading');				 
		$heading= $heading->where('course_id',$c_id);
		$heading= $heading->where('bat_id',$b_id);
		$heading= $heading->get();
		if(count($heading)>0){
			$heading =$heading;
		}else{
			$heading = DB::table('courses_heading as heading');				 
			$heading= $heading->where('course_id',$c_id);	 
			$heading= $heading->get();
		}
		$feesstudentcheck  = FeesStudents::where('stud_batch_id',$b_id)->where('trainer',$t_id)->get();	
		$feesBatches  = FeesBatches::where('id',$b_id)->where('attendancebatch','>',0)->get();		
		 if(sizeof($feesstudentcheck)>0 && sizeof($feesBatches)>0){	 		 
				 $disabled= "";				 
			 }else{	
				  $disabled= 'disabled';
			 }
		
						$html ='<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<div class="card-box table-responsive course-scroll"> 
							<table id="" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
							<thead>
							<tr>                                                   
							<th>Content</th>
							<th>Video</th>
							<th>Notes</th>
							<th>Assignment</th>                           
							</tr>
							</thead>
							<tbody>';
						if($heading){
							$i=0;
							foreach($heading as $course){
							$i++;
						
						$headingcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->first();
						$html .='<tr>						
								<td>
								<div class="lms-accordian">
								<button class="paccordion" style="font-weight: 700;font-size: 13px;background-color: transparent;">
								 
								'.str_replace('?','',$course->heading).'<input type="checkbox" name="heading" class="heading" value="1" data-complete_id="'.(isset($headingcomplete->id)?$headingcomplete->id:"").'" data-heading_id="'.$course->id.'" data-b_id="'.$b_id.'" data-c_id="'.$c_id.'" data-t_id="'.$t_id.'" data-heading="'. substr(str_replace('?','',$course->heading),0,40).'" '.((isset($headingcomplete->status) && $headingcomplete->status==1)?"checked":"").' style="margin-left: 20px;" '.$disabled.'>'.((isset($headingcomplete->status) && $headingcomplete->status==1)? '<span>('.date('d-M-Y',strtotime($headingcomplete->heading_date)).')</span>':"").'</button>
								<div class="panel">
								<ul>';
								$contents = CoursesContent::where('heading_id',$course->id)->get();
								if($contents){	
								foreach($contents as $content){
								$contentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->first();
									$html .='	
									<li style="font-size: 13px;"><input type="checkbox" name="content" class="content" value="1" '.((isset($contentcomplete->status) && $contentcomplete->status==1)?"checked":"").' data-complete_id="'.(isset($contentcomplete->id)?$contentcomplete->id:"").'" data-content_id="'.$content->id.'"  data-b_id="'.$b_id.'" data-c_id="'.$c_id.'" data-t_id="'.$t_id.'" data-content="'.str_replace('?','',$content->coursescontent).'" '.$disabled.'> '.str_replace('?','',$content->coursescontent).' '.((isset($contentcomplete->status) && $contentcomplete->status==1)? '<span>('.date('d-M-Y',strtotime($contentcomplete->content_date)).')</span>':"").'</li>';

									$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
									if($subcontents){										
									foreach($subcontents as $sub){
										$subcontentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->first();
										$html .= '
										<ul><li style="font-size: 12px;"> <input type="checkbox" name="subcontent" class="subcontent" value="1" '.((isset($subcontentcomplete->status) && $subcontentcomplete->status==1)?"checked":"").' data-complete_id="'.(isset($subcontentcomplete->id)?$subcontentcomplete->id:"").'" data-b_id="'.$b_id.'" data-c_id="'.$c_id.'" data-t_id="'.$t_id.'" data-subcontent_id="'.$sub->id.'"  data-subcontent="'.str_replace('?','',$sub->subcontent).'"  '.$disabled.'> '.str_replace('?','',$sub->subcontent).' '.((isset($subcontentcomplete->status) && $subcontentcomplete->status==1)? '<span>('.date('d-M-Y',strtotime($subcontentcomplete->subcontent_date)).')</span>':"").'</li>';

										$lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
										if($lastcontents){										
										foreach($lastcontents as $last){
											$lastcontentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->first();
										$html .='
										<ul><li style="font-size: 11px;"><input type="checkbox" name="lastcontent" class="lastcontent" value="1" '.((isset($lastcontentcomplete->status) && $lastcontentcomplete->status==1)?"checked":"").' data-complete_id="'.(isset($lastcontentcomplete->id)?$lastcontentcomplete->id:"").'" data-b_id="'.$b_id.'" data-c_id="'.$c_id.'" data-t_id="'.$t_id.'" data-lastcontent_id="'.$last->id.'" data-lastcontent="'.str_replace('?','',$last->lastcontent).'"  '.$disabled.'>'.str_replace('?','',$last->lastcontent).' '.((isset($lastcontentcomplete->status) && $lastcontentcomplete->status==1)? '<span>('.date('d-M-Y',strtotime($lastcontentcomplete->lastcontent_date	)).')</span>':"").'</li></ul>';									
										} } 										
										$html .='</ul>';

									}
									}
								}
								}


						$html .=' </ul>
									</div>	
									</div>							 
									</td>
						<td><a href="javascript:void(0)" title="Add Course Content" data-toggle="modal" data-target="#getCourseVideoForm_'.(isset($course->id)?$course->id:"").'"><i class="fa fa-video-camera" aria-hidden="true"></i> </a>  ';
						
						
						$coursesVideoh = CoursesVideo::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($coursesVideoh)  && count($coursesVideoh)>0){						
							$html .='  <i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>';				
						}
						$html .='<script>$(".videoclose").click(function(){
							$("#getCourseVideoForm_'.(isset($course->id)?$course->id:"").'").modal("hide");
							});</script>';
				
						$html .='
							<div id="getCourseVideoForm_'.(isset($course->id)?$course->id:"").'" class="modal fade" role="dialog">
							<div class="modal-dialog">


							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title mb-0">Video Upload </h5> <div class="succesmessage"></div><div class="errormessage"></div>
							<button type="button" class="videoclose">&times;</button>



							</div>
							<div class="modal-body">
							<div class="panel-body">


							<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
						 $videos = CoursesVideo::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
				    	if($videos){
						foreach($videos as $video){
						$vname= unserialize($video->video); 
						$html .='<script>$(".vclose").click(function(){
						$("#myModal_'.(isset($video->id)?$video->id:"").'").modal("hide");
						$(".theVideo_'.(isset($video->id)?$video->id:"").'").get(0).pause();
						});
						
						</script>';

						$html .='<tr><td><a href="javascript:void()" class="download-icon-play" data-toggle="modal" data-target="#myModal_'.$video->id.'"><i class="fa fa-play"></i> </a>					 
						<div id="myModal_'.$video->id.'" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">					 
						<div class="modal-content">
						<div class="modal-header">						
						<h4 class="modal-title mb-0">Video</h4>
						<button type="button" class="vclose">&times;</button>
						</div>
						<div class="modal-body">							 
						<video  width="750" controls class="theVideo_'.(isset($video->id)?$video->id:"").'"><source src="'.asset($vname['video']['src']).'" type=""> <i class="fa fa-film" aria-hidden="true"></i></video>
						</div>						</div>
						</div></td><td><a href="javascript:courseController.courseVideodelete('.$video->id.')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a><td></tr>';
						}}
						$html .='</table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseVideo('.(isset($course->id)?$course->id:"").','.$b_id.','.$c_id.','.$t_id.',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group mb-0">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select Video file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="'.(isset($course->id)?$course->id:"").'">
						<input type="file" name="video" accept=".mpeg,.ogg,.mp4,.webm,.3gp,.mov,.flv,.avi,.wmv,.ts" required="required" class="form-control" style="overflow: hidden;">
						<img src="'.asset('genie/build/images/loading.gif').'" class="loading" style="display: none;">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						</td>
						<td> <a href="javascript:void(0);" data-toggle="modal" data-target="#getCourseNotesForm_'.(isset($course->id)?$course->id:"").'" title="Add Course Notes" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> </a>';
						
							$notess = CoursesNotes::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($notess)  && count($notess)>0){						
							$html .='  <i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>';						
						}
							$html .='<script>$(".notesclose").click(function(){
							$("#getCourseNotesForm_'.(isset($course->id)?$course->id:"").'").modal("hide");
							});</script>';
					
						$html .='<div id="getCourseNotesForm_'.(isset($course->id)?$course->id:"").'" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title mb-0">Notes Upload </h5> <div class="notesmessage"></div><div class="errormessage"></div>
							<button type="button" class="notesclose" >&times;</button>
							</div>
							<div class="modal-body">
							<div class="panel-body">							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
						 $notes = CoursesNotes::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
						if($notes){
						foreach($notes as $note){
							$nname= unserialize($note->notes); 
						$html .='<tr><td><a href="https://docs.google.com/viewer?url='.asset($nname['notes']['src']).'" target="_blank">  
						 
						 Download <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><td><a href="javascript:courseController.courseNotesdelete('.$note->id.')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a></td></tr>';
						} } 
						$html .='</table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseNotes('.(isset($course->id)?$course->id:"").','.$b_id.','.$c_id.','.$t_id.',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group mb-0">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select Notes file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="'.(isset($course->id)?$course->id:"").'">
						<input type="file" name="notes" accept=".pdf,.doc"  required="required" class="form-control ">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						
						
						</td>
						<td><a href="javascript:void(0)" data-toggle="modal" data-target="#getCourseAssignForm_'.(isset($course->id)?$course->id:"").'"  title="Assignment" ><i class="fa fa-question-circle-o" aria-hidden="true"></i> </a>';
						 
							$assignmentss =CoursesAssignment::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($assignmentss)  && count($assignmentss)>0){
							
							$html .='  <i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>';
						 
						}
						
						$html .='<script>$(".assignclose").click(function(){
							$("#getCourseAssignForm_'.(isset($course->id)?$course->id:"").'").modal("hide");
							});</script>';
						
						$html .='<div id="getCourseAssignForm_'.(isset($course->id)?$course->id:"").'" class="modal fade" role="dialog">
							<div class="modal-dialog">


							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title mb-0">Assignment Upload </h5> <div class="succesmessage"></div><div class="errormessage"></div>
							<button type="button" class="assignclose">&times;</button>
							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
						 $assignments = CoursesAssignment::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
						if($assignments){
						foreach($assignments as $assignment){
							$aname= unserialize($assignment->assignment); 	
						$html .='<tr><td><a href="https://docs.google.com/viewer?url='.asset($aname['assignment']['src']).'" target="_blank">  
						 Download <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><td><a href="javascript:courseController.courseAssignmentdelete('.$assignment->id.')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a></td></tr>';
						} } 
						$html .='</table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseAssignment('.(isset($course->id)?$course->id:"").','.$b_id.','.$c_id.','.$t_id.',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group mb-0">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="'.(isset($course->id)?$course->id:"").'">
						<input type="file" name="assignment" accept=".pdf,.doc,.docx"  required="required" class="form-control ">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						
						
						</td>
						</tr>';
						 } } 
					   $html .=' </tbody>
					</table>
					 
					
                  </div>
				  
                </div>
              </div>
            </div>';
				 
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	  
	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getGoogleMeetingForm(Request $request, $b_id,$c_id,$t_id)
    {  
		if($request->ajax()){		 
		 	 //echo $id;die;
		$heading = DB::table('courses_heading as heading');				 
		$heading= $heading->where('course_id',$c_id);
		$heading= $heading->get();
		
		
		$feesBatches  = FeesBatches::where('id',$b_id)->first();		
		 	
				if($feesBatches->gmailid){
				$gmailid= $feesBatches->gmailid;
				
			}else{
				$gmailid="";
			}
			
			if($feesBatches->gmailpassword){
				$gmailpassword=$feesBatches->gmailpassword;
			}else{
				$gmailpassword="";
			}
			
			if($feesBatches->meetingurl){
						$url =$feesBatches->meetingurl;					 
						$pattern = "https://";
						$newutrl=  substr($url,0,8);					 
						if($newutrl=='https://'){		 

						$url =$feesBatches->meetingurl;
						}else{
						 
						$url ="https://".$feesBatches->meetingurl;
						}
						}else{
						$url = "#";

						}
			
				$html ='<div class="x_content">
				<div class="row">
				<div class="col-sm-12">
				  	 
		    	<div class="form-group">
				<label for="batch-start">Batch Confirmation <span class="required">*</span></label>
				Are you login with Id: “'.$gmailid.'” & Password: “'.$gmailpassword.'”. on google chrome. If yes please proceed else do the needful before going to take the batch.
				 
				</div>
			<a href="'.$url.'" target="_blank" class="btn btn-success" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('.$b_id.','.$t_id.')">Yes</a> 
			<button class="btn btn-danger" data-dismiss="modal">No</button> 
			 

				 
									
				</div>
				</div>
				</div>';
				 
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	 
	 
	 /**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function courseContentsDetails(Request $request, $b_id,$c_id,$t_id)
    {  

		$b_id =base64_decode($b_id);
		$c_id =base64_decode($c_id);
		$t_id =base64_decode($t_id);
	
		 	 
		 	 $batches = DB::connection('mysql2')->table('wp_batches_details as batches');		
		$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id'); 
		$batches = $batches->select('batches.*','trainer.name as trainer_name','trainer.id as trainer_id','batches.id as batch_id','course.course as course_name','batches.batch_course as batchcourse_id');
		$batches =$batches->where('batches.id',$b_id);
		$batches =$batches->first();

		$traierdet= FeesTrainer::where('id',$batches->trainer_id)->first();
		
		
		$heading = DB::table('courses_heading as heading');				 
		$heading= $heading->where('course_id',$c_id);
		$heading= $heading->where('bat_id',$b_id);
		$heading= $heading->get();
		if(count($heading)>0){
			
			$heading =$heading;
		}else{
			$heading = DB::table('courses_heading as heading');				 
			$heading= $heading->where('course_id',$c_id);	 
			$heading= $heading->get();
		}
		
		
		$feesstudentcheck  = FeesStudents::where('stud_batch_id',$b_id)->where('trainer',$t_id)->get();	
		$feesBatches  = FeesBatches::where('id',$b_id)->where('attendancebatch','>',0)->get();		
		 if(sizeof($feesstudentcheck)>=0 && sizeof($feesBatches)>=0){	 		 
				 $disabled= "";				 
			 }else{	
				  $disabled= 'disabled';
			 }
			
		
			 return view('genie.batch.course_batch_contents',['heading'=>$heading,'disabled'=>$disabled,'b_id'=>$b_id,'c_id'=>$c_id,'t_id'=>$t_id,'traierdet'=>$traierdet,'batches'=>$batches]);
	 
			  
			
			 
		 
    }
	
	
	public function checkmail(){
	    $data=DB::connection('mysql12')->table('croma_leads')->first();
	    dd($data);
	}
	
	

		
}
