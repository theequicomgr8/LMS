<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;
class StatusChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:change';

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
        
        Log::info('status Start');
        $leads=DB::connection('mysql12')->table('croma_leads')->where('fb_lead','1')->where('facbook_unassign','0')->where('fb_lead_status','!=','3')->whereNull('deleted_at')->orderBy('id','desc')->limit(500)->get();
        $temp2=[];
        foreach($leads as $lead)
        {
        	$leadid=$lead->id;
        	$fb_lead_status=$lead->fb_lead_status;
            
        	$follow=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('lead_id',$leadid)->orderBy('id','desc')->first();
        	$followid=$follow->id;
            //$temp2[]=$followid;
        	$followupdate=DB::connection('mysql12')->table('croma_lead_follow_ups')->where('id',$followid)->update(["status"=>$fb_lead_status]);
        }
        Log::info('status End');
        
    }
}
