<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;
class LeadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Lead';

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
        //if data interested nahi hai or wo all leads me chala jau
        
        $temp=[];
        $datas=DB::connection('mysql12')->table('croma_leads')->where('fb_lead','1')->where('fb_lead_status','!=',3)->whereNull('deleted_at')->limit(100)->get();
        if(!empty($datas)){
           foreach($datas as $data){
                $mobile=$data->mobile;
                $email=$data->email;
                $course=$data->course; 
                
                
                $sql=DB::connection('mysql12')->table('croma_leads')->where('fb_lead','0')->where('course',$course)->where('mobile',$mobile)->where('email',$email)->where('status','!=','3')->where('source','16')->delete();
                
                /*$sql=DB::table('croma_leads')->where('fb_lead','0')->where('course',$course)->where('mobile',$mobile)->where('email',$email)->where('status','!=','3')->where('source','16')->get();
                foreach($sql as $list){
                	$temp[]=$list->mobile;
                }*/
            } 
        }
        
        
        
        
        
        
        
    }
}
