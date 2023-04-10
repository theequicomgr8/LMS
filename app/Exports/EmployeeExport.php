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
use App\Designation;
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
class EmployeeExport implements FromCollection, WithHeadings
{
	 
	 public function headings(): array
    {
        return [
            'Emp Code', 'Name','Father’s/Husband’s Name', 'Email', 'Mobile', 'Role','Department','Designation','Adhar No','Reference NO','Current Addres','Permanent Address','Date of Joining','DOB'
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
				if($employe->designation){
					 $designation= Designation::where('id',$employe->designation)->first();
					 if($designation){
						 $designationname = $designation->designation;
					 }
				 }else{
					 $designationname = "";
					 
				 }	
					 	
								
					$arr[] = [
						$empcode,
						$name,
						$employe->father_name,
						$employe->email,
						$employe->mobile,
						$employe->role,
						$departmentname,
						$designationname,
						$employe->aadhar_no,
						$employe->refrence_mobile, 
						$employe->current_address,
						$employe->permanent_address,
						(date('d-M-Y',strtotime($employe->dateofjoining))),				 
						(date('d-M-Y',strtotime($employe->dob))),					 
						 
						 
					];
					$returnLeads['recordCollection'][] = $employe->id;
				 
			}
	 
		
		
		//echo "<pre>";print_r($arr); 
		
		
        return  collect($arr);
      //  return  $arr;    
		
		
		
    }
}
 
 
 
 
 
 
 
 
