<?php
namespace App\Exports;
//namespace App\Http\Controllers\genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Employee;
 
use App\Assets;
use App\Assetsmodel;
use App\Employeeinvoice;
use App\Modeemployee;
use App\Paymenthistory;
use App\Paymentmode;
use App\User;
use App\Department;
use App\Allemployeepayment;
use Auth;
use Hash;
use Validator;
use DB;
use Carbon\Carbon;
use Excel;
 
use Maatwebsite\Excel\Concerns\FromCollection;
  use Maatwebsite\Excel\Concerns\FromQuery;
  use Maatwebsite\Excel\Concerns\WithMultipleSheets;
  use Maatwebsite\Excel\Concerns\FromArray;
  use Maatwebsite\Excel\Concerns\Exportable;
  use Maatwebsite\Excel\Concerns\WithMapping;
  use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
class UsersExport implements FromCollection, WithHeadings
{
	 
	 public function headings(): array
    {
        return [
            'Emp Code', 'Name', 'Email', 'Mobile', 'Department','Fixed Salary','Leaves','Incentive','Extra Work','Pre Advance','Payable','Paid Amt','Balance','Current Advance'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
 //   public function sheets(): array
    { 
	 
 
	 
			 $employee = New User;
		 
			$employee= $employee->orderby('emp_code','asc');
			$employee= $employee->where('role','!=','admin');
			$employee = $employee->get();
			$recordCollection = [];
			$data = [];
	 		  
	 
			$returnLeads['recordCollection'] = [];
			 
			$totremarks='';
			
			 
			foreach($employee as $employe){
			 
							$name= $employe->first_name.' '.$employe->last_name;	
			 if($employe->emp_code){
					 $empcode= $employe->emp_code;
					 
				 }else{
					 $empcode = "";
					 
				 }	

				 if($employe->department){
					 $department= Department::where('id',$employe->department)->first();
					 if($department){
						 $departmentname = $department->department;
					 }
				 }else{
					 $departmentname = "";
					 
				 }	
					if($employe->temp_advance<0){
						
					$payable= $employe->fixed_salary-$employe->leaves-$employe->temp_advance+($employe->incentive+$employe->extra_work);					
					$paid = $employe->paid_amount;
					 			
					if($payable==$paid){
						$balance=0.00;			 
						$currAdvance=0;
					}else if($payable<$paid){
						$balance=0;							 
						 $cad = $paid-$payable;
						$currAdvance = '<span style="color:red">'.$cad.'</span>';
					}else{						
						$balance= $employe->fixed_salary-$employe->leaves-$employe->temp_advance+($employe->incentive+$employe->extra_work) - $employe->paid_amount;
						$currAdvance=0;
					}
					
					}else{
							$payable= $employe->fixed_salary-$employe->leaves-$employe->temp_advance+($employe->incentive+$employe->extra_work);					
					$paid = $employe->paid_amount;
					 			
					if($payable==$paid){
						$balance=0.00;			 
						$currAdvance=0;
					}else if($payable<$paid){
						$balance=0;							 
						 $cad = $paid-$payable;
						$currAdvance = '<span style="color:red">'.$cad.'</span>';
					}else{						
						$balance= $employe->fixed_salary-$employe->leaves-$employe->temp_advance+($employe->incentive+$employe->extra_work) - $employe->paid_amount;
						$currAdvance=0;
					}
						
					}	
								
					$arr[] = [
						$empcode,
						$name,
						$employe->email,
						$employe->mobile,
						$departmentname,
						$employe->fixed_salary,
						$employe->leaves, 
						$employe->incentive,
						$employe->extra_work,
						$employe->temp_advance, 
						$payable, 
						$employe->paid_amount,	 
						$balance,						 
						$currAdvance,
						 
						 
					];
					$returnLeads['recordCollection'][] = $employe->id;
				 
			}
	 
		
		
		//echo "<pre>";print_r($arr); 
		
		
        return  collect($arr);
      //  return  $arr;    
		
		
		
    }
}
 
 
 
 
 
 
 
 
