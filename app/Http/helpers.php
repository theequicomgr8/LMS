<?php
/**
 * CONTAINS HELPER FUNCTIONS
 */
 
 use App\FeesBatches;
use App\FeesStudents;
use App\FeesCourse;
use App\FeesTrainer;
use App\FeesStudentsAttendance;
use App\CoursesHeading;
use App\CoursesContent;
use App\CoursesSubContent;
use App\CoursesLastContent;
use App\CoursesNotes;
use App\CoursesVideo;
use App\CoursesAssignment;
use App\CoursesComplete;
use App\FeesInvoice;
use App\User;
// SENDING SMS AND IT'S CONFIGURATION
// **********************************



function sendSMS($sendto, $message,$tempid=null){
	$username = 't1cromacampussms';
	$password = '42308595';
	$sender = 'CCAMPS';
	$sendto = $sendto;
		$tempid = $tempid;
	//$templateId = '1707161786775524106';
	$message = str_replace(' ', '%20', $message);
//	$url = 'http://nimbusit.co.in/api/swsendSingle.asp';
	$url = 'http://nimbusit.co.in/api/swsend.asp';
//	$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&message=$message&entityID=1701160344973814570";
 
		$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&entityID=1701160344973814570&templateID=$tempid&message=$message";

	$objURL = curl_init($url);
	curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($objURL, CURLOPT_POST, 1);
	curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
	$retval = trim(curl_exec($objURL));
	curl_close($objURL);
	
	return $retval;

	
	
	
	
}

function sendSMSsss($sendto, $message){
	$username = 't1cromacampussms';
	$password = '42308595';
	$sender = 'CROMAS';
	$sendto = $sendto;
	$message = str_replace(' ', '%20', $message);
	//$url = 'http://nimbusit.co.in/api/swsendSingle.asp';
	$url = 'http://nimbusit.co.in/api/swsend.asp';
	$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&message=$message";

	$objURL = curl_init($url);
	curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($objURL, CURLOPT_POST, 1);
	curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
	$retval = trim(curl_exec($objURL));
	curl_close($objURL);
}

 
 
// FOLDER STRUCTURE GENERATOR
// **************************
function getImageFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/images/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
 
// FOLDER STRUCTURE GENERATOR
// **************************
function getPdfFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/pdf/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
 
// FOLDER STRUCTURE GENERATOR
// **************************
function getNotesFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/Notes/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
// FOLDER STRUCTURE GENERATOR
// **************************
function getAssignFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/Assign/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
 
// FOLDER STRUCTURE GENERATOR
// **************************
function getVideoFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/video/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
 
 
// this function use all students course
// **************************
function getStudentsCourse(){
	 $studentdash = DB::connection('mysql2')->table('wp_students_details as std');	 
		$studentdash = $studentdash->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$studentdash = $studentdash->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		//$studentdash = $studentdash->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		//$studentdash=$studentdash->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name'); 				
		$studentdash=$studentdash->select('course.id as courseid','course.course','std.id as std_id','std.name','trainer.name as trainer_name'); 				
		$studentdash=$studentdash->where('phone','=',Session::get('mobile'));		
	//	$studentdash=$studentdash->where('deleted','=',0);		
		$studentdash=$studentdash->orderby('std.id','desc');	
	 
		
		$studentdash=$studentdash->get();
		return $studentdash;
		
}
 
 
// this function use to total course topic
// **************************
function getTotalCourseTopic(){
		$studenttopic = DB::connection('mysql2')->table('wp_students_details as std');	 
		$studenttopic = $studenttopic->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$studenttopic = $studenttopic->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$studenttopic = $studenttopic->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		//$studentdash=$studentdash->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name'); 				
		$studenttopic=$studenttopic->select('course.id as courseid','course.course','std.id as std_id','std.name','batch.id as batchid','trainer.id as trainerid','trainer.name as trainer_name'); 				
		$studenttopic=$studenttopic->where('phone','=',Session::get('mobile'));		
		$studenttopic=$studenttopic->orderby('std.id','desc');			
		$studenttopic=$studenttopic->first();
		//return $studenttopic;
		if(!empty($studenttopic)){
			
					$headinghed = DB::table('courses_heading as heading');				 
					$headinghed= $headinghed->where('course_id',$studenttopic->courseid);					 
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
					$headingcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('heading_id',$course->id)->where('status',1)->count();	
					 
					 
					$contentshed = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotalhed += $contentshed->count();

					if($contentshed){	
					foreach($contentshed as $content){
					$contentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontentshed = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotalhed +=$subcontentshed->count();
					if($subcontentshed){										
					foreach($subcontentshed as $sub){
					$subcontentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('subcontent_id',$sub->id)->where('status',1)->count(); 

					 $lastcontentshed = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotalhed +=$lastcontentshed->count();
					if($lastcontentshed){										
					foreach($lastcontentshed as $last){
					$lastcontentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousehed= $headingtotalhed+$contentstotalhed +$subcontentstotalhed +$lastcontentstotalhed;
				//	$completetotalhed= $headingcompletehed+$contentcompletehed +$subcontentcompletehed +$lastcontentcompletehed;
					 //return $totalcousehed;
			
		}else{
			$totalcousehed=0;
		}
		return $totalcousehed;
		
} 
// this function use to total course Complete
// **************************
function getTotalCourseComplete(){
	$studenttopic = DB::connection('mysql2')->table('wp_students_details as std');	 
		$studenttopic = $studenttopic->join('wp_courses_details as course','std.courses','=','course.id','left outer');
		$studenttopic = $studenttopic->join('wp_trainers_details as trainer','std.trainer','=','trainer.id','left outer');
		$studenttopic = $studenttopic->join('wp_batches_details as batch','std.stud_batch_id','=','batch.id','left outer');
		//$studentdash=$studentdash->select('std.*','course.*','batch.*','batch.batch_name as batchname','std.id as std_id','trainer.name as trainer_name'); 				
		$studenttopic=$studenttopic->select('course.id as courseid','course.course','std.id as std_id','std.name','batch.id as batchid','trainer.id as trainerid','trainer.name as trainer_name'); 				
		$studenttopic=$studenttopic->where('phone','=',Session::get('mobile'));		
		$studenttopic=$studenttopic->orderby('std.id','desc');			
		$studenttopic=$studenttopic->first();
		//return $studenttopic;
		if(!empty($studenttopic)){
			
					$headinghed = DB::table('courses_heading as heading');				 
					$headinghed= $headinghed->where('course_id',$studenttopic->courseid);					 
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
					$headingcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('heading_id',$course->id)->where('status',1)->count();	
					 
					 
					$contentshed = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotalhed += $contentshed->count();

					if($contentshed){	
					foreach($contentshed as $content){
					$contentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontentshed = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotalhed +=$subcontentshed->count();
					if($subcontentshed){										
					foreach($subcontentshed as $sub){
					$subcontentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('subcontent_id',$sub->id)->where('status',1)->count(); 

					 $lastcontentshed = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotalhed +=$lastcontentshed->count();
					if($lastcontentshed){										
					foreach($lastcontentshed as $last){
					$lastcontentcompletehed += CoursesComplete::where('batch_id',$studenttopic->batchid)->where('trainer_id',$studenttopic->trainerid)->where('course_id',$studenttopic->courseid)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					//$totalcousehed= $headingtotalhed+$contentstotalhed +$subcontentstotalhed +$lastcontentstotalhed;
				$completetotalhed= $headingcompletehed+$contentcompletehed +$subcontentcompletehed +$lastcontentcompletehed;
					 //return $totalcousehed;
			
		}else{
			$completetotalhed=0;
		}
		return $completetotalhed;
}
 
 
	 function invoiceGeneratedHundredPercentage($b_id,$t_id,$c_id)
	{
		
			//echo "hundreedtrainer";die; 
		// echo $b_id;die;
		if($b_id){
		 
		$batch =FeesBatches::where('id',$b_id)->where('batch_visibility','1')->orderBy('id','desc')->first();		
//echo "<pre>";print_r($batch);die;		
		 if($batch->invoice_status=='0' ){		 
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();		 				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();					
				if($feestrainer->share_release=="100"  && $feestrainer->type="external"){
						
					if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
						
					if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount;						
					}
					
				}else if(!empty($feesstudent) && ($feestrainer->payout_share=='fluctuating_share')){
					 
					$stdcount = count($feesstudent); 
					if($feestrainer->share_release=='100'){
						
					if($feestrainer->FL_Share1){
						$first_share = explode('-',$feestrainer->FL_Share1); 
						if(($first_share[0])<=$stdcount && $stdcount<=$first_share[1]){
						$std_amount=0;						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						}
						$amount = ($std_amount*$first_share[2])/100;					
						$invoiceamount =$amount;
						
						} 				
						
					}
					if($feestrainer->FL_Share2){
						$second_share = explode('-',$feestrainer->FL_Share2); 
						if(($second_share[0])<=$stdcount && $stdcount<=$second_share[1]){
						$std_amount=0;						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;

						}

						$amount = ($std_amount*$second_share[2])/100;					
						$invoiceamount =$amount;
						
						} 				
						
					}if($feestrainer->FL_Share3){
						$third_share = explode('-',$feestrainer->FL_Share3); 
						if(($third_share[0])<=$stdcount && $stdcount<=$third_share[1]){
						$std_amount=0;						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						}
						$amount = ($std_amount*$third_share[2])/100;					
						$invoiceamount =$amount;						
						} 				
						
					}
						
						
					}
					
				} else if(!empty($feesstudent) && ($feestrainer->payout_share=='per_student')){
					 
					$stdcount = count($feesstudent);			 					
					
					if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					}
					
				}
				
			 
				if($invoiceamount){			
				 
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);					
					$status=1;					 
					$approval_status=0;					 
				$feesInvoice  = New FeesInvoice;
				$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
				$feesInvoice->amount=round($invoiceamount);
				$feesInvoice->balance=round($invoiceamount);
				$feesInvoice->approval_status=$approval_status;
				$feesInvoice->pay_status=0;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->lms_status=1;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
			
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;	
					$feesbatch->status=2;							
					$feesbatch->save();						
				} 
				 
				
				} 			
						
					} 
				
		 	 
		 
		}else if($batch->invoice_status=='1'){ 
	
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();
				 			
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();				 
					if($feestrainer->share_release=='50' &&  $feestrainer->type=="external"){	 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
					$std_amount=0;						
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;						
					}					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}					
					
				}else if(!empty($feesstudent) && ($feestrainer->payout_share=='fluctuating_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
					if($feestrainer->FL_Share1){
						$first_share = explode('-',$feestrainer->FL_Share1); 
						if(($first_share[0])<=$stdcount && $stdcount<=$first_share[1]){
						$std_amount=0;
						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;

						}

						$amount = ($std_amount*$first_share[2])/100;					
						$invoiceamount =$amount/2;
						
						} 				
						
					}
					if($feestrainer->FL_Share2){
						$second_share = explode('-',$feestrainer->FL_Share2); 
						if(($second_share[0])<=$stdcount && $stdcount<=$second_share[1]){
						$std_amount=0;
						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;

						}

						$amount = ($std_amount*$second_share[2])/100;					
						$invoiceamount =$amount/2;
						
						} 				
						
					}if($feestrainer->FL_Share3){
						$third_share = explode('-',$feestrainer->FL_Share3); 
						if(($third_share[0])<=$stdcount && $stdcount<=$third_share[1]){
						$std_amount=0;
						 
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;

						}

						$amount = ($std_amount*$third_share[2])/100;					
						$invoiceamount =$amount/2;
						
						} 				
						
					}
						
						
					 
					}
					 
					
				} else if(!empty($feesstudent) && ($feestrainer->payout_share=='per_student')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}
					
					 
					
				}
				
			 
				if($invoiceamount){
				 
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);
					 
					$approval_status=0;
					$status=1;
					$feesInvoice  = New FeesInvoice;
					$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
					$feesInvoice->amount=round($invoiceamount);
					$feesInvoice->balance=round($invoiceamount);
					$feesInvoice->approval_status=$approval_status;
					$feesInvoice->pay_status=0;
					$feesInvoice->batch_id=$batch->id;			 
					$feesInvoice->generate_status=$status;
					$feesInvoice->batch_status=$status;				 
					$feesInvoice->lms_status=$status;				 
					$feesInvoice->invoice_date=date('Y-m-d');
					$feesInvoice->technology=$courses;
					 
					if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;					
					$feesbatch->status=2;					
					$feesbatch->save(); 					
					}else{
					$feesInvoice->delete();					 
					}
				 				
				} 
				
		 } 
		 

		} 			
			 
	}
	}
	
 