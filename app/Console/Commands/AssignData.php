<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Leadpitch\Lead;
use App\Leadpitch\Source;
use App\Leadpitch\Course;
use App\Leadpitch\Inquiry;

use App\Leadpitch\Courseassignment;
use App\Leadpitch\LeadFollowUp;
use App\Leadpitch\Status;
use App\Leadpitch\BucketCourseAssignment;
use App\Leadpitch\AbsentCourseassignment;
use DB;
use Log;

class AssignData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Assign:Data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Main start');
        date_default_timezone_set("Asia/Calcutta");   
            $dat= date('Y-m-d H:i:s');
            //->where('assign','1')
            $result=DB::connection('mysql12')->table('croma_leads')->where('fb_lead','1')->where('fb_lead_status','3')->whereNull('deleted_at')->where('facbook_unassign','0')->orderBy('id','desc')->get();
            foreach($result as $resu){
                $leadID=$resu->id;
        		$foll=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->orderBy('id','desc')->first();
        		$remark=$foll->remark;
        		
        		//assign code start
        		$data=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->orderBy('id','desc')->first();
		    $mobile=$data->mobile;
		    $course=$data->course;
		    $participant="offline";
		    $code="91";
		    $name=$data->name;
		    $email=$data->email;
		    $message="";
		    $source=$data->source;//$data->source_name;//FaceBook
		    $from="";
		    $from_name="";
		    $from_title="";
		    $fb_status="1";
		    
		    
		    //new start
		    $mobile= ltrim($mobile, '0');	
			$mobile= trim($mobile);	
			$newmobile=  preg_replace('/\s+/', '', $mobile);
			
			$currentdate = date('Y-m-d');

		        
		        
            $code ='91';
            if($code=='91'){
            $type_lead= "Domestic";
            
            }else{
            $type_lead= "International";
            }
				
			if($name){
			   $name= $name;
			}else{
			     $name="TBD";
			    
			}
				
			$inquiry = New Inquiry;	

			$inquiry->name=$name;
			$inquiry->email= $email;
			$inquiry->participant= $participant; //offline
			if($message){
				$inquiry->comment= $message;
			}
	    	$inquiry->source_id= $source;  //FaceBook id
	    	$inquiry->fb_status=$fb_status;
			$soursename= Source::findOrFail($source)->name;
			
			$inquiry->source= $soursename; 
			
		 	
			$inquiry->code= "91"; //91			
			$mobile= ltrim($mobile, '0');	
			$mobile= trim($mobile);	
			$newmobile=  preg_replace('/\s+/', '', $mobile);
			$inquiry->mobile =$newmobile;
				
				
				if(is_numeric($course)){
					$coursename=    Course::findOrFail($course);	
					if(!empty($coursename)){
						$course_name =$coursename->name;
						$lead_course_id =$coursename->id;		
						$inquiry->course_id= $lead_course_id;	
						$inquiry->course= $course_name;	
					}else{
						$inquiry->course_id= 0;;	
						$inquiry->course= $course;	
				
					}
					
				}else{
					
					$coursename= Course::where('name', 'like', '%' .$course . '%')->first();
					if(!empty($coursename)){
						
						$lead_course_id =$coursename->id;					
						$inquiry->course_id= $lead_course_id;			
						$course_name= $coursename->name;	
						$inquiry->course= $course_name;	
					}else{
						$inquiry->course_id= 0;	
						$lead_course_id=0;
						$inquiry->course= $course;	
						$course_name =$course;
					}
				 		
				}
				
				$inquiry->form= "FaceBook";	
				 		 
				$inquiry->category="send_enquiry_lead";	
				$inquiry->from_name="NA";//Auth::user()->name;//$request->input('from_name');	28 feb suman
				$inquiry->sub_category="FaceBook";//$request->input('from_title');	28 feb
			 
				 
		        $currentdate = date('Y-m-d');
		        $checklead = Inquiry::where('course_id',$lead_course_id)->where('mobile',$newmobile)->whereDate('created_at','=',date_format(date_create($currentdate),'Y-m-d'))->get()->count();
		       
		        $currentdate = date('Y-m-d');
		        $lastdate= date('Y-m-d', strtotime($currentdate. ' - 4 day'));		
		        $checkleadday = Inquiry::where('mobile',$newmobile)->where('course_id',$lead_course_id)->whereDate('created_at','>',date_format(date_create($lastdate),'Y-m-d'))->get()->count();
		        
		        $lastdate= date('Y-m-d', strtotime($currentdate. ' - 4 day'));		
		         
		        $checkleadcourse = Inquiry::where('mobile',$newmobile)->where('course_id','!=',$lead_course_id)->whereDate('created_at','>',date_format(date_create($lastdate),'Y-m-d'))->get()->count();
		        

		        
		        if(!empty($checkleadcourse) && $checkleadcourse>0){ 
		            //dd('1');
					$leadcheck = Lead::where('mobile',$newmobile)->where('course',$lead_course_id)->orderBy('id','desc')->get();	 
				 
						if(!empty($leadcheck) && count($leadcheck)>0)
						{				 
							foreach($leadcheck as $checkv)
							{					  
								if($checkv->status !=4 && $checkv->deleted_at =='')
								{				  
									$var =1;	 			  
								}
								else
								{
									$var =0;
								}
								if($var==1)
								{				  
									$check=1;											  
									break;
								}
								else
								{						  
									$check=0;	
								}
							}
							
							if(!empty($check) && $check>0){
								$inquiry->duplicate=2;				
								$inquiry->save();					 
								
								
								//my code add start  ,"croma_id"=>$enq
								$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

    							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);
    
    				            
    							Log::info('Main End');
    							return back()->with('msg','Lead move to unsigned');
    							//my code add end
    							
							}else{						
							 $inquiry->save();					
							$this->leadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark);				
							//return response()->json(['status'=>1,],200);
							//my code add start  ,"croma_id"=>$enq
								$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

    							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);
    
    				            Log::info('Main End');
    							return back()->with('msg','Lead move to unsigned');
    							//my code add end
							}
						
						
						}
						else{
					     	$inquiry->duplicate=2;		
							$inquiry->save();
							//return response()->json(['status'=>1,],200);
							//my code add start  ,"croma_id"=>$enq
								$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

    							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);
                
    			                Log::info('Main End');	            
    							return back()->with('msg','Lead move to unsigned');
    							//my code add end
						}			 
					
					
					}
					else if(!empty($checkleadday) && $checkleadday>0)
					{
						//dd('2');
						$leadchecks = Lead::where('mobile',trim($newmobile))->where('course',$lead_course_id)->orderBy('id','desc')->get();					 
						if(!empty($leadchecks) && count($leadchecks)>0)
						{				 
							foreach($leadchecks as $checkv){					  
								if($checkv->status !=4 && $checkv->deleted_at =='')
								{				  
									$var =1;	 			  
								}
								else
								{
									$var =0;
								}
								if($var==1)
								{				  
									$check=1;											  
									break;
								}
								else
								{						  
									$check=0;	
								}
							}


						}
						if(!empty($check) && $check>0)
						{
								$inquiry->duplicate=1;				
								$inquiry->save();					 
								//return response()->json(['status'=>1,],200);
								//my code add start  ,"croma_id"=>$enq
								$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

    							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);
    
    				            Log::info('Main End');
    							return back()->with('msg','Lead move to unsigned');
    							//my code add end
						}
						else
						{
							 $inquiry->save();					
							 $this->leadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark);				
							 //return response()->json(['status'=>1,],200);	
							 //my code add start  "croma_id"=>$enq,
								$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

    							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);
    
    				           Log::info('Main End'); 
    							return back()->with('msg','Lead move to unsigned');
    							//my code add end
						}
					}
					else
					{
						if($inquiry->save())
						{	
							 $this->leadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark);
							 //my start ,"croma_id"=>$enq
							$lead=DB::connection('mysql12')->table('croma_leads')->where('id',$leadID)->update(["facbook_unassign"=>1,'created_by'=>$user,"facbook_to_lead"=>1,"status_name"=>"New Lead","created_at"=>$dat]); //facbook_to_lead"=>0

							$follup=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadID)->update(["status"=>1,"created_at"=>$dat,"expected_date_time"=>$dat]);

				            Log::info('Main End');
							return back()->with('msg','Lead move to unsigned');
							//my end
								 // return response()->json(['status'=>1,],200);
						
						}

		            }
        		
        		//assign cord end
        		
            }
            
		    Log::info('Main end');
		            return back()->with('msg','Lead move to unsigned');
		    //new end
		    
    }
    
    
    
    
    
    
    
    
    
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
  function leadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark=''){
	
	 if(is_numeric($lead_course_id) && !empty($lead_course_id)){
				
		$assigncourse = Courseassignment::where('status',1)->get();	
		 if($assigncourse->count()>0){
			if($type_lead=='Domestic'){				
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucket;

			$max = $mCount = 15;
			$i=0;
			$totalClients = count($assigncourse);
			$buckets = [];
			$newbucket = [];
			$newbucketmerger = [];
			foreach($assigncourse as $counsellor){
			
			if($mCount == 0){
			$j = $i;
			$buckets[++$j] = $buckets[$i++];
			$buckets[$j]['assign_dom_course'] = [];
			$mCount = $max-(count($buckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($counsellor->assign_dup_dom_course))){
			$buckets[$i]['assign_dup_dom_course'][] = $counsellor->counsellors;
			}  
			if(in_array($lead_course_id,unserialize($counsellor->assign_dom_course))){
			$buckets[$i]['assign_dom_course'][] = $counsellor->counsellors;
			}
			--$mCount;
			}
			$j=0;
			foreach($buckets as $bucket){
				foreach($bucket as $position=>$counsellors){
						foreach($counsellors as $assign){			 
						array_push($newbucket, $assign);
						}
				}
			}
			
			$i = 0;
			$bucketCount = count($newbucket);
			if(!empty($bucketCount)){
			foreach($newbucket as $key=>$val){
			    
			    $user= 	Courseassignment::where('counsellors',$val)->where('status',1)->first();			
			if($user->leadassign+1<=$user->leadcount){
			    
			if($bucketCount<=$bucketIndex || $bucketIndex==0){
			$bucketIndex = 0;
			}
			if($bucketIndex==$i){
			
			$mobile= ltrim($inquiry->mobile, '0');	
	    	$mobile= trim($mobile);	
			$newmobile=  preg_replace('/\s+/', '', $mobile);
			 $leadcheck = Lead::where('mobile',$inquiry->mobile)->where('course',$inquiry->course_id)->orderBy('id','desc')->get();	
			 if(!empty($leadcheck) && count($leadcheck)>0){				 
				 foreach($leadcheck as $checkv){					  
					  if($checkv->status !=4 && $checkv->deleted_at ==''){				  
					  $var =1;	 			  
					  }else{
						  $var =0;
					  }
					  if($var==1){				  
						  $check=1;											  
						     break;
					  }else{						  
						   $check=0;	
						   
					  }
					  
				 }
				 
			
			 }else{
			     
			      $check=0;	
			 }
			
			
		 
		     
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $val;
			$lead->croma_id = $inquiry->id;
			$lead->status=1;	
			 
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$val;
			$inquiry->save(); 
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; //add facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 
			$usercunsl= Courseassignment::where('counsellors',$val)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			}			
			$kw = Course::find($lead_course_id);
			$kw->bucket = $i+1;
			$kw->save();
			 

			}
			
			
			$i++;
			}else{
		   $this->bucketLeadCounsellor($val,$lead_course_id,$type_lead,$inquiry,$remark='');
		   
		    $inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->reason="Bucket Full";
			$inquiry->save();
			    
			}
            }
            }else{
              $this->absentleadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark='');
            $inquiry= Inquiry::findOrFail($inquiry->id);
            $inquiry->reason="Counsellor-NF";
            $inquiry->save(); 
            
            }
		 
			 }else{
				 
				 
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucketinter;				

			$max = $mCount = 15;
			$i=0;
			$totalClients = count($assigncourse);
			$buckets = [];
			$newbucket = [];
			$newbucketmerger = [];
			foreach($assigncourse as $counsellor){
		 	
			if($mCount == 0){
			$j = $i;
			$buckets[++$j] = $buckets[$i++];
			//$buckets[$j]['assign_dom_course'] = [];
			$mCount = $max-(count($buckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($counsellor->assign_int_course))){
			$buckets[$i]['assign_int_course'][] = $counsellor->counsellors;
			}  
			if(in_array($lead_course_id,unserialize($counsellor->assign_dup_int_course))){
			$buckets[$i]['assign_dup_int_course'][] = $counsellor->counsellors;
			}

			--$mCount;
			 
			}
			$j=0;
			foreach($buckets as $bucket){
				foreach($bucket as $position=>$counsellors){
						foreach($counsellors as $assign){			 
						array_push($newbucket, $assign);
						}
				}
			}
			
			$i = 0;
			$bucketCount = count($newbucket);
			if($bucketCount){
			foreach($newbucket as $key=>$val){
			$user= 	Courseassignment::where('counsellors',$val)->where('status',1)->first();			
			if($user->leadassign+1<=$user->leadcount){
			    
			if($bucketCount<=$bucketIndex || $bucketIndex==0){
			$bucketIndex = 0;
			}
			if($bucketIndex==$i){
			$mobile= ltrim($inquiry->mobile, '0');	
	    	$mobile= trim($mobile);	
			$newmobile=  preg_replace('/\s+/', '', $mobile);
			 $leadcheck = Lead::where('mobile',$inquiry->mobile)->where('course',$inquiry->course_id)->orderBy('id','desc')->get();	
			 if(!empty($leadcheck) && count($leadcheck)>0){				 
				 foreach($leadcheck as $checkv){					  
					  if($checkv->status !=4 && $checkv->deleted_at ==''){				  
					  $var =1;	 			  
					  }else{
						  $var =0;
					  }
					  if($var==1){				  
						  $check=1;											  
						     break;
					  }else{						  
						   $check=0;	
						   
					  }
				 }
				  
			 }else{
			     
			      $check=0;	
			 }
			
			
		  
 
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $val;
			$lead->croma_id = $inquiry->id;
			$lead->status=1;	
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$val;	
			$inquiry->save();
			
			$usercunsl= Courseassignment::where('counsellors',$val)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; //add facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 

			}  
			 
			
			$kw = Course::find($lead_course_id);
			$kw->bucketinter = $i+1;
			$kw->save();
			 
			}
			$i++;
			}else{
			    
			    $this->bucketLeadCounsellor($val,$lead_course_id,$type_lead,$inquiry,$remark='');
			    $inquiry= Inquiry::findOrFail($inquiry->id);
		    	$inquiry->reason="Bucket Full";
		    	$inquiry->save(); 
			    
			    
			}
			
			
        }

			 }else{
			      $this->absentleadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark='');
                    $inquiry= Inquiry::findOrFail($inquiry->id);
                    $inquiry->reason="Counsellor-NF";
                    $inquiry->save();  
			 }
				 
				 
			 }
			 
			 
		 }else{
		     
		    $this->absentleadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark='');
            $inquiry= Inquiry::findOrFail($inquiry->id);
            $inquiry->reason="Counsellor-NF";
            $inquiry->save();  
		     
		 }
		 
		   
		 
		 
			 }
	
	
} 
   
   
   
   
   
   
 
 
 
 
 
 function bucketLeadCounsellor($val,$lead_course_id,$type_lead,$inquiry,$remark=''){
	
			$absentassigncourse = BucketCourseAssignment::where('counsellors',$val)->get();	
			
		//	echo "<pre>";print_r($absentassigncourse);die;
			if($absentassigncourse->count()>0){
			if($type_lead=='Domestic'){				
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucket;

			$max = $mCount = 15;
			$i=0;
			$totalClients = count($absentassigncourse);
			$absentbuckets = [];
			$newbucket = [];
			$newbucketmerger = [];
			foreach($absentassigncourse as $counsellor){
			$absentcounsellors= BucketCourseAssignment::where('counsellors',$counsellor->counsellors)->get();
			foreach($absentcounsellors as $absentcounsellor){
			if($mCount == 0){
			$j = $i;
			$absentbuckets[++$j] = $absentbuckets[$i++];
			$absentbuckets[$j]['bucket_assign_dom_course'] = [];
			$mCount = $max-(count($absentbuckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($absentcounsellor->bucket_assign_dom_course))){
			$absentbuckets[$i]['bucket_assign_dom_course'][] = $absentcounsellor->tocounsellor;
			}   
		
			--$mCount;
			}
			
			}
			$j=0;
			
			 if(count($absentbuckets)>0){
				foreach($absentbuckets as $bucket){
				foreach($bucket as $position=>$counsellors){
				foreach($counsellors as $assign){			 
				array_push($newbucket, $assign);
				}
				}
				}
			 } 
			
		 
			$bucketCount = count($newbucket);
				if(!empty($bucketCount)){
			foreach($newbucket as $key=>$valc){
			    
			    $user= 	Courseassignment::where('status',1)->where('counsellors',$valc)->first();			
			if($user->leadassign+1<=$user->leadcount){
			 
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $valc;
			$lead->croma_id = $inquiry->id;
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$valc;
			$inquiry->save(); 
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; for facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 
			$usercunsl= Courseassignment::where('status',1)->where('counsellors',$valc)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			}			
		//	$kw = Course::find($lead_course_id);
		//	$kw->bucket = $i+1;
		//	$kw->save();
			

		
			
			
			 
			}else{
			   $inquiry= Inquiry::findOrFail($inquiry->id);
			    $inquiry->reason="Bucket Full";
					$inquiry->save(); 
			    
			}
            }
                }else{
                
                $inquiry= Inquiry::findOrFail($inquiry->id);
                $inquiry->reason="Counsellor-NF";
                $inquiry->save();
                }
		 
			 }else{
				 
				 
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucketinter;				

			$max = $mCount = 15;
			$i=0;
			$totalClients = count($absentassigncourse);
			$absentbuckets = [];
			$newbucket = [];
			$newbucketmerger = [];
			foreach($absentassigncourse as $counsellor){
		 	$absentcounsellors= BucketCourseAssignment::where('counsellors',$counsellor->counsellors)->get();
			foreach($absentcounsellors as $absentcounsellor){
			if($mCount == 0){
			$j = $i;
			$absentbuckets[++$j] = $absentbuckets[$i++];
			$buckets[$j]['bucket_assign_int_course'] = [];
			$mCount = $max-(count($absentbuckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($absentcounsellor->bucket_assign_int_course))){
			$absentbuckets[$i]['bucket_assign_int_course'][] = $absentcounsellor->tocounsellor;
			}

			--$mCount;
			}
			}
			$j=0;
			if(count($absentbuckets)>0){
			foreach($absentbuckets as $bucket){
				foreach($bucket as $position=>$counsellors){
						foreach($counsellors as $assign){			 
						array_push($newbucket, $assign);
						}
				}
				}
			 } 
			
		 
			$bucketCount = count($newbucket);
			if(!empty($bucketCount)){
			foreach($newbucket as $key=>$valc){
			 	
		 $user= 	Courseassignment::where('counsellors',$valc)->first();			
			if($user->leadassign+1<=$user->leadcount){
 
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $valc;
			$lead->croma_id = $inquiry->id;
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$valc;	
			$inquiry->save();
			
			$usercunsl= Courseassignment::where('counsellors',$valc)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; for facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 

			}  
			  
			
		 
		 
			}else{
			    
			    $inquiry= Inquiry::findOrFail($inquiry->id);
		    	$inquiry->reason="Bucket Full";
		    	$inquiry->save();
			}
        }  
        
			 }else{
			    $inquiry= Inquiry::findOrFail($inquiry->id);
				$inquiry->reason="Counsellor-NF";
				$inquiry->save();
			 }
			 } 
		 }
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 function absentleadassignCounsellor($lead_course_id,$type_lead,$inquiry,$remark=''){
		$absentassigncourse = Courseassignment::where('status',0)->get();	
			if($absentassigncourse->count()>0){
				
			if($type_lead=='Domestic'){				
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucket;
			$max = $mCount = 15;
			$i=0;
			$assignbuckets = [];	
			$newconsellor = [];	
			$newbucket = [];  
			
			foreach($absentassigncourse as $counsellor){
			    
			if($mCount == 0){			
			$j = $i;
			$assignbuckets[++$j] = $assignbuckets[$i++];
			$assignbuckets[$j]['assign_dom_course'] = [];
			$mCount = $max-(count($assignbuckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($counsellor->assign_dom_course))){
			$assignbuckets[$i]['assign_dom_course'][] = $counsellor->counsellors;
			}   

			--$mCount;
			 

			}
			
	 
			foreach($assignbuckets as $bucket){
			foreach($bucket as $position=>$counsellors){
			foreach($counsellors as $assign){			 
			array_push($newconsellor, $assign);
			}
			}
			}

			$bucketCount = count($newconsellor);
				$maxn = $mCountn = 15;
				$in=0;
			foreach($newconsellor as $key=>$val){
			$absentcounsellors= AbsentCourseassignment::where('counsellors',$val)->get();
			foreach($absentcounsellors as $absentcounsellor){
			 if($mCount == 0){			
			$jn = $in;
			$absentbuckets[++$jn] = $absentbuckets[$in++];
			$absentbuckets[$jn]['absent_assign_dom_course'] = [];
			$mCountn = $maxn-(count($absentbuckets[$jn],1)-1);
			 }
			if(in_array($lead_course_id,unserialize($absentcounsellor->absent_assign_dom_course))){
			$absentbuckets[$in]['absent_assign_dom_course'][] = $absentcounsellor->tocounsellor;
			}   
		
			--$mCountn;
			}

			}
		 
			 
			
			 if(count($absentbuckets)>0){
				foreach($absentbuckets as $bucket){
				foreach($bucket as $position=>$counsellors){
				foreach($counsellors as $assign){			 
				array_push($newbucket, $assign);
				}
				}
				}
				
				
			 }else{			 
				 
			$maxnot = $mCountnot = 15;
			$ino=0;
				   $notabsentassigncourse= 	Courseassignment::where('status',0)->get();						  
					foreach($notabsentassigncourse as $notcounsellor){					 				 
					 if($mCountnot == 0){		
					$jno = $ino;
					$notabsentbuckets[++$jno] = $notabsentbuckets[$ino++];
					$notabsentbuckets[$jno]['assign_dom_course'] = [];
					$mCountnot = $maxnot-(count($notabsentbuckets[$jno],1)-1);
					 }
					if(in_array($lead_course_id,unserialize($notcounsellor->assign_dom_course))){
					$notabsentbuckets[$ino]['assign_dom_course'][] = $notcounsellor->counsellors;
					}  
				
					--$mCountnot;	 

					}
					foreach($notabsentbuckets as $notbucket){
					foreach($notbucket as $position=>$notcounsellors){
					foreach($notcounsellors as $notassign){			 
					array_push($newbucket, $notassign);
					}
					}
					}
				 
			 }
			
			
		 
			 
			$bucketCount = count($newbucket);
			if(!empty($bucketCount)){
			foreach($newbucket as $key=>$val){			    
			$user= 	Courseassignment::where('counsellors',$val)->first();			
			if($user->leadassign+1<=$user->leadcount){
			 
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $val;
			$lead->croma_id = $inquiry->id; 
			 
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$val;
			$inquiry->save(); 
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; //For facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 
			$usercunsl= Courseassignment::where('counsellors',$val)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			}			
						
			 
			}else{
				
				$this->bucketLeadCounsellor($val,$lead_course_id,$type_lead,$inquiry,$remark='');
                $inquiry= Inquiry::findOrFail($inquiry->id);
                $inquiry->reason="Bucket Full";
                $inquiry->save();
			}
            }
			
			}else{
			      
		     $inquiry= Inquiry::findOrFail($inquiry->id);
             $inquiry->reason="Counsellor-NF";
             $inquiry->save();
			}
			 
		 
			 }else{
				 
				 //inernational
				 				
			$catCourse = Course::findOrFail($lead_course_id);	
			$bucketIndex = $catCourse->bucket;
			$max = $mCount = 15;
			$i=0;
			$assignbuckets = [];	
			$newconsellor = [];		
			$newbucket = [];		
			foreach($absentassigncourse as $counsellor){
			if($mCount == 0){					
				$j = $i;
				$assignbuckets[++$j] = $assignbuckets[$i++];
				$assignbuckets[$j]['assign_int_course'] = [];
				$mCount = $max-(count($assignbuckets[$j],1)-1);
			}
			if(in_array($lead_course_id,unserialize($counsellor->assign_int_course))){
			$assignbuckets[$i]['assign_int_course'][] = $counsellor->counsellors;
			}   

			--$mCount;
			 

			}
			
			
			foreach($assignbuckets as $bucket){
			foreach($bucket as $position=>$counsellors){
			foreach($counsellors as $assign){			 
			array_push($newconsellor, $assign);
			}
			}
			}
			$maxn = $mCountn = 15;
			$in=0;
			$bucketCount = count($newconsellor);
			foreach($newconsellor as $key=>$val){
			$absentcounsellors= AbsentCourseassignment::where('counsellors',$val)->get();
			foreach($absentcounsellors as $absentcounsellor){
			 if($mCountn == 0){	
			$jn = $in;
			$absentbuckets[++$jn] = $absentbuckets[$in++];
			$absentbuckets[$jn]['absent_assign_int_course'] = [];
			$mCountn = $maxn-(count($absentbuckets[$jn],1)-1);
			 }
			if(in_array($lead_course_id,unserialize($absentcounsellor->absent_assign_int_course))){
			$absentbuckets[$in]['absent_assign_int_course'][] = $absentcounsellor->tocounsellor;
			}  
			--$mCountn;
			}

			}

			 
			
			 if(count($absentbuckets)>0){
				foreach($absentbuckets as $bucket){
				foreach($bucket as $position=>$counsellors){
				foreach($counsellors as $assign){			 
				array_push($newbucket, $assign);
				}
				}
				}
			 }else{			 
					$maxnot = $mCountnot = 15;
					$inot=0;
					$notabsentassigncourse= 	Courseassignment::where('status',0)->get();						  
					foreach($notabsentassigncourse as $notcounsellor){					 				 
					if($mCountnot == 0){	
					$jnot = $inot;
					$notabsentbuckets[++$jnot] = $notabsentbuckets[$inot++];
					$notabsentbuckets[$jnot]['assign_int_course'] = [];
					$mCountnot = $maxnot-(count($notabsentbuckets[$jnot],1)-1);
					}
					if(in_array($lead_course_id,unserialize($notcounsellor->assign_int_course))){
					$notabsentbuckets[$inot]['assign_int_course'][] = $notcounsellor->counsellors;
					}  
				
					--$mCountnot;	 

					}
					foreach($notabsentbuckets as $notbucket){
					foreach($notbucket as $position=>$notcounsellors){
					foreach($notcounsellors as $notassign){			 
					array_push($newbucket, $notassign);
					}
					}
					}
				 
			 }
			
			 
			$bucketCount = count($newbucket);
			if(!empty($bucketCount)){
			foreach($newbucket as $key=>$val){			    
			    $user= 	Courseassignment::where('counsellors',$val)->first();			
			if($user->leadassign+1<=$user->leadcount){
			    
			if($bucketCount<=$bucketIndex || $bucketIndex==0){
			$bucketIndex = 0;
			}
			 
			 
		 	$lead =  new Lead;			
			$lead->name = $inquiry->name;
			$lead->email = $inquiry->email;		
			$lead->code = $inquiry->code;			
			$lead->mobile =$inquiry->mobile;			
			$lead->type =1;			
			$lead->source = $inquiry->source_id;
			$lead->source_name = $inquiry->source;
			$lead->course = $inquiry->course_id;
			$lead->course_name = $inquiry->course;
			$lead->status = 1;
			$lead->status_name = "New Lead";			 
			$lead->created_by = $val;
			$lead->croma_id = $inquiry->id;
			 
			 
			$inquiry= Inquiry::findOrFail($inquiry->id);
			$inquiry->assigned_to=	$val;
			$inquiry->save(); 
			if($lead->save()){
			$followUp = new LeadFollowUp;
			$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;							
			$followUp->followby = $lead->created_by;
			if(!empty($inquiry->comment)){
			$followUp->remark = $inquiry->comment; 
			}else{
			    $followUp->remark=$remark;//""; for facebook remark
			}
			$followUp->expected_date_time = date('Y-m-d H:i:s');
			$followUp->lead_id = $lead->id;				 
			$followUp->save(); 
			$usercunsl= Courseassignment::where('counsellors',$val)->first();	
			$usercunsl->leadassign = $usercunsl->leadassign+1;
			$usercunsl->save();
			}	
			 
			}else{
				$this->bucketLeadCounsellor($val,$lead_course_id,$type_lead,$inquiry,$remark='');
                $inquiry= Inquiry::findOrFail($inquiry->id);
                $inquiry->reason="Bucket Full";
                $inquiry->save();
			}
            }

			 }else{
					$inquiry= Inquiry::findOrFail($inquiry->id);
					$inquiry->reason="Counsellor-NF";
					$inquiry->save(); 
			 }
   	


		
			 } 
		 }
		 
	
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    
    
    
    
    
    
    
    
}
