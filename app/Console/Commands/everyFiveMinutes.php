<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Allemployeepayment;
class everyFiveMinutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:monthly';

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
		 
		$users =New User;
			 $users= $users->orderby('emp_code','asc');
			$users= $users->where('status','!=','3');
			$users= $users->where('status','!=','2');
			$users= $users->where('id','!=','1');
			$users= $users->get();
			 
			if(!empty($users)){	
			foreach($users as $user)	{
				$allemployeepayment = New Allemployeepayment;
				if($user->temp_advance<0){
				$balance= $user->fixed_salary-$user->leaves-$user->temp_advance+($user->incentive+$user->extra_work) - $user->paid_amount;
				$payableamt= $user->fixed_salary-$user->leaves-$user->temp_advance+($user->incentive+$user->extra_work);	
				}else{
						$balance= $user->fixed_salary-$user->leaves-$user->temp_advance+($user->incentive+$user->extra_work) - $user->paid_amount;
						$payableamt= $user->fixed_salary-$user->leaves-$user->temp_advance+($user->incentive+$user->extra_work);	
				}
				$paidamt = $user->paid_amount;
				if($payableamt<$paidamt){
					$currentamt = $paidamt - $payableamt;					
				}else{
					
					$currentamt=0;
				}
				$allemployeepayment->employee_id = $user->id;
				$allemployeepayment->emp_code = $user->emp_code;
				$allemployeepayment->name = $user->first_name.' '.$user->last_name;
				$allemployeepayment->department = $user->department;
				$allemployeepayment->designation = $user->designation;
				$allemployeepayment->fixed_salary = $user->fixed_salary;
				$allemployeepayment->leaves = $user->leaves;
				$allemployeepayment->leaves_day = $user->leaves_day;
				$allemployeepayment->incentive = $user->incentive;
				$allemployeepayment->extra_work = $user->extra_work;
				$allemployeepayment->temp_advance = $user->temp_advance;
				$allemployeepayment->payable = $payableamt;
				$allemployeepayment->paid_amount = $user->paid_amount;			 
				$allemployeepayment->balance = $balance;
				$allemployeepayment->current_advance = $currentamt;
				$allemployeepayment->save();
				
				if($user->temp_advance<0){
					$payable= $user->fixed_salary-$user->leaves +$user->temp_advance+($user->incentive+$user->extra_work);	
					
					
				}else{
				$payable= $user->fixed_salary-$user->leaves -$user->temp_advance+($user->incentive+$user->extra_work);	
				}	
				
				$paid = $user->paid_amount;				 
				if(!empty($paid)){
				if($payable==$paid){

				$curr_advance=0;
				}else if($payable<$paid){
				 					 
				$curr_advance = $paid-$payable;
			 
				}else{					
				 
				$curr_advance=$paid-$payable;
				}
				
				}else{
					$curr_advance=0;
					
				}
				
				
			$user->temp_advance = $curr_advance;	 
			$user->paid_amount = 0;	 
			$user->leaves=0;
			$user->leaves_day=0;
			$user->incentive=0;
			$user->extra_work=0;				 
			$user->payable=0;
			$user->current_advance=0;
			 	
		$user->save();
			
			}
			}	
			
			 
    }
}
