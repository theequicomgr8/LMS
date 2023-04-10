<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use DB;
class LeadAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Lead:Assign';

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
        Log::info('Lead Assign start');
       /* $temp=[];
	    $leads=DB::table('croma_enquiries')->where('source_id',16)->where('source','FaceBook')->where('assigned_to','!=','0')->orderBy('id','desc')->limit(300)->get();
	    foreach($leads as $lead){
	        $ary=[
        	   "mobile"=>$lead->mobile,
        	   "code"=>'91',
        	   "name"=>$lead->name,
        	   "email"=>$lead->email,
        	   "source"=>16,
        	   "source_name"=>'FaceBook',
        	   "course"=>$lead->course_id,
        	   "course_name"=>$lead->course,
        	   "status"=>1,
        	   "type"=>1,
        	   "status_name"=>'New Lead',
        	   "app_status"=>0,
        	   "demo_attended"=>0,
        	   "move_not_interested"=>0,
        	   "deleted_by"=>0,
        	   "created_by"=>$lead->assigned_to,
        	   "forward_by"=>0,
        	   "croma_id"=>$lead->id,
        	   ]; 
        	   
        	   
        	   $croma_id=$lead->id;
        	   $checks=DB::table('croma_leads')->where('croma_id',$croma_id)->first();
                
        	   
        	   if(empty($checks)){
        	       
        	       $leadsaveid=DB::table('croma_leads')->insertGetId($ary);
        	       date_default_timezone_set("Asia/Calcutta");
        	       $dat= date('Y-m-d H:i:s');
        	       DB::table('croma_lead_follow_ups')->insert([
        	        "status" =>1,
        	        "follow_status"=>0,
        	        "expected_date_time"=>$lead->created_at,
        	        "lead_id"=>$leadsaveid,
        	        "followby"=>$lead->assigned_to,
        	        "created_at"=>$lead->created_at,
        	        "updated_at"=>$lead->created_at
        	        ]);
        	       
        	       
        	   
        	   }
        DB::table('croma_leads')->where('fb_lead','0')->where('created_by','0')->get();
	    } */
	    
	    $temp=[];
	    $leads=DB::connection('mysql12')->table('croma_enquiries')->where('source_id',16)->where('source','FaceBook')->where('assigned_to','!=','0')->where('reason','!=','Bucket Full')->where('sub_category','FaceBook')->where('form','FaceBook')->where('fb_status','1')->orderBy('id','desc')->limit(50)->get();
	    
	    foreach($leads as $lead){
	        $ary=[
        	   "mobile"=>$lead->mobile,
        	   "code"=>'91',
        	   "name"=>$lead->name,
        	   "email"=>$lead->email,
        	   "source"=>16,
        	   "source_name"=>'FaceBook',
        	   "course"=>$lead->course_id,
        	   "course_name"=>$lead->course,
        	   "status"=>1,
        	   "type"=>1,
        	   "status_name"=>'New Lead',
        	   "app_status"=>0,
        	   "demo_attended"=>0,
        	   "move_not_interested"=>0,
        	   "deleted_by"=>0,
        	   "created_by"=>$lead->assigned_to,
        	   "forward_by"=>0,
        	   "croma_id"=>$lead->id,
        	   ]; 
        	   
        	   
        	   $croma_id=$lead->id;
        	   //$temp[]=$lead->mobile;
        	   $data=DB::connection('mysql12')->table('croma_leads')->where('mobile',$lead->mobile)->where('fb_lead','0')->first();
        	   if(empty($data) && count($data) == '0'){
            	   $checks=DB::connection('mysql12')->table('croma_leads')->where('croma_id',$croma_id)->first();
                    
            	  
            	   if(empty($checks) && count($checks) == '0'){
            	       
            	       
            	       //$temp[]="<span style='color:green;'>empty</span>".$lead->mobile;
            	       $leadsaveid=DB::connection('mysql12')->table('croma_leads')->insertGetId($ary);
            	       date_default_timezone_set("Asia/Calcutta");
            	       $dat= date('Y-m-d H:i:s');
            	       DB::connection('mysql12')->table('croma_lead_follow_ups')->insert([
            	        "status" =>1,
            	        "follow_status"=>0,
            	        "expected_date_time"=>$lead->created_at,
            	        "lead_id"=>$leadsaveid,
            	        "followby"=>$lead->assigned_to,
            	        "created_at"=>$lead->created_at,
            	        "updated_at"=>$lead->created_at
            	        ]);
            	       
            	       
            	   
            	   }
            	   
        	   }
        	   
       
        
        //DB::table('croma_leads')->where('fb_lead','0')->where('created_by','0')->get();
	    }
	    
	    DB::connection('mysql12')->table('croma_leads')->where("fb_lead",1)->where("facbook_unassign",1)->where('fb_lead_status','!=','3')->update(["facbook_unassign"=>0,"facbook_to_lead"=>1,"created_by"=>0]);
		DB::connection('mysql12')->table('croma_leads')->where("fb_lead",1)->where('fb_lead_status','!=','3')->update(["facbook_unassign"=>0,"facbook_to_lead"=>1,"created_by"=>0]);
		
		
	    Log::info('Lead Assign End');
    }
}
