<?php

namespace App\Http\Controllers\genie;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
 use App\User;
 use App\FeesBatches;
 use App\FeesStudents;
 use App\FeesCourse;
 use App\FeesTrainer;
 use App\FeesPayTrainer;
 use App\FeesInvoice;
 use App\FeesPayInvoice;
 use App\FeesMode;
 use Auth;
 use Session;
  use DB;
class InvoiceController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
	
	  
	
	
	public function index()
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		  return view('genie.batch.index');
		
	}
	
	public function payinvoice(Request $request)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
	 
		/* 
			$trainer =FeesTrainer::where('trainer_phone',Session::get('mobile'))->where('status','0')->first();
		 
		$batches =FeesBatches::where('batch_trainer',$trainer->id)->where('batch_visibility','1')->where('status','2')->where('invoice_status','0')->orderBy('id','desc')->get();
		
		
		 if($batches){
		 
			foreach($batches as $batch){
				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();

				$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();
						 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;
					 
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){
						
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;
					
					$invoiceamount =$amount;
						
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
						
						
					 
					}else if($feestrainer->share_release=='100'){
						
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
					 
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount/2;
						
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('pay_status','0')->get();
				
				 
				if(count($checkinvoices)>0){
					 
					 
				}else{
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);
					 
					$approval_status=0;
					$pay_status=0;
				$feesInvoice  = New FeesInvoice;
				$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
				$feesInvoice->amount=round($invoiceamount);
				$feesInvoice->balance=round($invoiceamount);
				$feesInvoice->approval_status=$approval_status;
				$feesInvoice->batch_id=$batch->id;
			 
				$feesInvoice->pay_status=$pay_status;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
			 
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=1;					
					$feesbatch->save();
					
				}
				}
				
				}
			}
		}  
			 
			$invoices = FeesInvoice::where('trainer_pay_id',$trainer->id)->where('pay_status','0')->get(); */
				
		 	$trainers  =FeesTrainer::get();
		$courses  =FeesCourse::get();
		 $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
		 
		  return view('genie.invoice.payinvoice',['search'=>$search,'trainers'=>$trainers,'courses'=>$courses]);
		
	}
	
	public function getPayInvoicePagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		 
		if($request->ajax()){
	
		$batches = DB::connection('mysql2')->table('wp_generate_invoice as invoice');	  
			$batches = $batches->join('wp_batches_details as batches','invoice.batch_id','=','batches.id');
			$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$batches = $batches->select('invoice.*','batches.*','invoice.id as invoice_id','trainer.name as trainer_name','course.course as course_name');		
			//$batches= $batches->where('batches.id',$request->input('search.batch_id'));
			
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
			//$batches= $batches->where('trainer.trainer_phone',Session::get('mobile'));
			$batches= $batches->where('invoice.pay_status','0');		 
			$batches= $batches->orderBy('invoice.id','DESC');
		 
		if($request->input('search.value')!==''){
				$batches = $batches->where(function($query) use($request){
					$query->orWhere('invoice.amount','LIKE','%'.$request->input('search.value').'%')
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
 //echo "<pre>";print_r($batches);die;
			foreach($batches as $batch){
				 
				 $getstudetns = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 
				 if(count($getstudetns)>0){
					$countstd ='['.count($getstudetns).']';		 				
						$batchId= $batch->id;
						}else{
							$countstd ="";	 
						
						$batchId= "<span style='color:red' title='No Students in this Batch' style='margin-left: 33%;'>".$batch->id." </spans>";
						}  
					 $balance_amm= (($batch->amount) - ($batch->temp_advance+$batch->pay_amount));
					 									 
					 										

					$pdf ='<a href="javascript:void(0);" id="invoicePrintPdfSlip" title="Trainer Invoice Slip" data-gid="'.$batch->invoice_id.'" data-bid="'.$batch->batch_id.'"  ><i class="fa fa-print" aria-hidden="true"></i></a><br>';
					 
					 
					 
					$data[] = [						
					 
						(isset($batch->created_at)?date('d-M-y',strtotime($batch->created_at)):""),						 		 
						$batch->batch_name.''.$countstd,							 
						$batch->course_name,					 
						$batch->amount,					 
						$batch->pay_amount,					 
						$batch->temp_advance,					 
						$balance_amm,							 
						$pdf,							 
					'<a href="javascript:invoiceController.getInvoicePay('.$batch->invoice_id.')" title="pay invoice list"><i class="fa fa-list" aria-hidden="true"></i></a>',						
						  
						 
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	
	public function paidinvoice(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
	 /*	if($role=="Admin" || $role=="Manager"){			
	 $trainer =FeesTrainer::where('trainer_phone',Session::get('mobile'))->first();
	 	}else{
	 	    
	 	    $trainer =FeesTrainer::where('trainer_phone',Session::get('mobile'))->first();
	 	}*/
	// echo "<pre>";print_r($trainer);die;
	//	$invoices = FeesInvoice::where('trainer_pay_id',$trainer->trainer_id)->where('pay_status','1')->orderBy('id','desc')->get();
				
		 //return view('genie.invoice.paidinvoice',['invoices'=>$invoices]);
		 
		  return view('genie.invoice.paidinvoice');
		
	}
	
	 
	public function invoiceGenerated(Request $request)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
		
		$b_id = $_POST['ids'];
		 
		$batch =FeesBatches::where('id',$b_id)->where('batch_visibility','1')->orderBy('id','desc')->first();		 
		 if($batch->invoice_status=='0'){
		 
			$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();
		 $checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('generate_status','1')->where('pay_status','2')->get();
		 		 // echo "<pre>";print_r($checkinvoices);die;
		 if(count($checkinvoices)>0){
			  return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All Ready Invoice Generated!'
							]
							],200);
		 }else{
				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();				
				if($feestrainer->share_release=="50"){	 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;					
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;
					
					$invoiceamount =$amount;
						
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
						
						
					 
					}else if($feestrainer->share_release=='100'){
						
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
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('generate_status','1')->where('pay_status','2')->get();
				
				 
				if(count($checkinvoices)>0){
					 return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All Ready Invoice Generated!'
							]
							],200);
					 
				}else{
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);
					 //echo "<pre>";print_r($courses);die;
					$status=1;					 
					$approval_status=0;					 
				$feesInvoice  = New FeesInvoice;
				$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
				$feesInvoice->amount=round($invoiceamount);
				$feesInvoice->balance=round($invoiceamount);
				$feesInvoice->approval_status=$approval_status;
				$feesInvoice->pay_status=2;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				//echo "<pre>";print_r($feesInvoice);die;
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=1;					
					if($feesbatch->save()){
							return response()->json([
							'statusCode'=>1,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Generated Successfully!'
							]
							],200);
					}else{
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
						
					}
					
				}else{
				$feesInvoice->delete();				
				return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
				}
				}
				
				}else{
					
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please Update Trainer Payout Share!'
							]
							],200);
					
				}
					
					
				}else if($feestrainer->share_release=="100"){
						
						if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;					
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;
					
					$invoiceamount =$amount;
						
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
						
						
					 
					}else if($feestrainer->share_release=='100'){
						
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
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('generate_status','1')->where('pay_status','2')->get();
				
				 
				if(count($checkinvoices)>0){
					 return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All Ready Invoice Generated!'
							]
							],200);
					 
				}else{
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);
					 //echo "<pre>";print_r($courses);die;
					$status=1;					 
					$approval_status=0;					 
				$feesInvoice  = New FeesInvoice;
				$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
				$feesInvoice->amount=round($invoiceamount);
				$feesInvoice->balance=round($invoiceamount);
				$feesInvoice->approval_status=$approval_status;
				$feesInvoice->pay_status=2;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				//echo "<pre>";print_r($feesInvoice);die;
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;	
					$feesbatch->status=2;							
					if($feesbatch->save()){
							return response()->json([
							'statusCode'=>1,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Generated Successfully!'
							]
							],200);
					}else{
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
						
					}
					
				}else{
				$feesInvoice->delete();				
				return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
				}
				}
				
				}else{
					
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please Update Trainer Payout Share!'
							]
							],200);
					
				}
						
						
					}else{
						
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please Update Trainer Payout Share!'
							]
							],200);
						
					}
				
		 }
		 
		 
		 
		}else if($batch->invoice_status=='1'){
 
	$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();
	
 
		 $checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('generate_status','1')->where('pay_status','2')->get();
		 		
		 if(count($checkinvoices)>0){
			  return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All Ready Invoice Generated!'
							]
							],200);
		 }else{
				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();

				 
					if($feestrainer->share_release=='50'){	 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;						
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;
					
					$invoiceamount =$amount;
						
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
						
						
					 
					}else if($feestrainer->share_release=='100'){
						
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
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('generate_status','1')->where('pay_status','2')->get();
				
				 
				if(count($checkinvoices)>0){
					 return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All Ready Invoice Generated!'
							]
							],200);
					 
				}else{
					$courses[]= $feesstudent[0]->courses;				
					$courses = serialize($courses);
					 //echo "<pre>";print_r($courses);die;
					$approval_status=0;
					$status=1;
				$feesInvoice  = New FeesInvoice;
				$feesInvoice->trainer_pay_id=$feestrainer->trainer_id;
				$feesInvoice->amount=round($invoiceamount);
				$feesInvoice->balance=round($invoiceamount);
				$feesInvoice->approval_status=$approval_status;
				$feesInvoice->pay_status=2;
				$feesInvoice->batch_id=$batch->id;
			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;				 
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				//echo "<pre>";print_r($feesInvoice);die;
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;					
					$feesbatch->status=2;					
					if($feesbatch->save()){
							return response()->json([
							'statusCode'=>1,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Generated Successfully!'
							]
							],200);
					}else{
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
						
					}
					
				}else{
				$feesInvoice->delete();				
				return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invoice Not Generated Successfully!'
							]
							],200);
				}
				}
				
				}else{
						return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please Update Trainer Payout Share!'
							]
							],200);
					
					
				}
				
		 }else{
			 return response()->json([
							'statusCode'=>0,
							'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'All ready invoice generated!'
							]
							],200);
					
			 
		 }
		 }

		}else{

			return response()->json([
			'statusCode'=>0,
			'data'=>[
			'responseCode'=>200,
			'payload'=>'',
			'message'=>'No permission Generated Invoice!'
			]
			],200);

		}			
			 
			 
		 
		 
		 
	}
	}
	
	
	public function getPaidInvoicePagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
			 
 
			$batches = DB::connection('mysql2')->table('wp_generate_invoice as invoice');		
		 	
			 
	 
			$batches = $batches->join('wp_batches_details as batches','invoice.batch_id','=','batches.id');
			$batches = $batches->join('wp_courses_details as course','batches.batch_course','=','course.id');
		$batches = $batches->join('wp_trainers_details as trainer','batches.batch_trainer','=','trainer.id');		
		$batches = $batches->select('invoice.*','batches.*','invoice.id as invoice_id','trainer.name as trainer_name','course.course as course_name');		
			//$batches= $batches->where('batches.id',$request->input('search.batch_id'));
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
			$batches= $batches->where('invoice.pay_status','1');		 
			$batches= $batches->orderBy('invoice.id','DESC');
		 
		if($request->input('search.value')!==''){
				$batches = $batches->where(function($query) use($request){
					$query->orWhere('invoice.amount','LIKE','%'.$request->input('search.value').'%')
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
 //echo "<pre>";print_r($batches);die;
			foreach($batches as $batch){
				 
				 $getstudetns = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 
				 if(count($getstudetns)>0){
					$countstd ='['.count($getstudetns).']';		 				
						$batchId= $batch->id;
						}else{
							$countstd ="";	 
						
						$batchId= "<span style='color:red' title='No Students in this Batch' style='margin-left: 33%;'>".$batch->id." </spans>";
						}  
					 $balance_amm= (($batch->amount) - ($batch->temp_advance+$batch->pay_amount));
					  $pdf ='<a href="javascript:void(0);" id="invoicePrintPdfSlip" title="Trainer Invoice Slip" data-gid="'.$batch->invoice_id.'" data-bid="'.$batch->batch_id.'"  ><i class="fa fa-print" aria-hidden="true"></i></a><br>';
					 
					$data[] = [						
					 
						(isset($batch->created_at)?date('d-M-y',strtotime($batch->created_at)):""),						 		 
						$batch->batch_name.''.$countstd,							 
						$batch->course_name,					 
						$batch->amount,					 
						$batch->pay_amount,					 
						$batch->temp_advance,				 
						 	
						$pdf,
					'<a href="javascript:invoiceController.getInvoicePay('.$batch->invoice_id.')" title="pay invoice list"><i class="fa fa-list" aria-hidden="true"></i></a>',						
						  
						 
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	 public function getInvoicePay(Request $request, $id)
    {  //echo $id;die;
		if($request->ajax()){
			 
			$invoice = FeesPayInvoice::where('invoice_id',$id)->first(); 
					 
				 
			$html=	'<div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">		 
						<table id="datatable-invoice-paylist" class="table table-striped table-bordered dt-responsive nowrap">
							<thead>
								<tr>
									<th>Pay Date</th>
									<th>Paid Mode</th>
									<th>Paid Amount</th>									 
								</tr>
							</thead>
						</table>
					</div></div></div></div>';
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInvoicePaymentList(Request $request, $id)
    {   
		if($request->ajax()){
		//	echo "<pre>";print_r($id);die;
		 
			$invoices = DB::connection('mysql2')->table('wp_allpayinvoice_details as invoice');				
			$invoices = $invoices->join('wp_modes_details as mode','mode.id','=','invoice.pay_mode','left');	
			$invoices = $invoices->select('invoice.*','mode.*');			
			$invoices = $invoices->where('invoice.invoice_id','=',$id);	
			
			//$invoices = $invoices->orderBy('invoice.id','desc');
			//$invoices = $invoices->get(); 
			$invoices = $invoices->paginate($request->input('length')); 
		//	 echo "<pre>";print_r($invoices);die;
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $invoices->total();
			$returnLeads['recordsFiltered'] = $invoices->total();
			$returnLeads['recordCollection'] = [];
			foreach($invoices as $invoice){
				
				 
				$data[] = [
					(isset($invoice->created_at)?date('d-M-y',strtotime($invoice->created_at)):""),					
					$invoice->mode,
					$invoice->pay_amount,
					 
				];
				$returnLeads['recordCollection'][] = $invoice->id;
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		}		
	} 
	
	
public function getBatchinvoicePrintPdf(Request $request) {
 
if(isset($_POST['bid']))
{
    if($request->input('action') == 'getBatchinvoicePrintPdf')
    {
    $batch_id = $_POST['bid'];		
  
    $batches =FeesBatches::where('id',$batch_id)->first();
    $trainer = FeesTrainer::where('id',$batches->batch_trainer)->first();	
    $feesstudents  = FeesStudents::where('stud_batch_id',$batches->id)->get();
    $invoice  = FeesInvoice::where('batch_id',$batch_id)->first();
     
    //echo "<pre>";print_r($invoice);die;
    return response()->view("genie.invoice.getBatchInvoicePrintPdfSlip",['batches'=>$batches,'trainer'=>$trainer,'feesstudents'=>$feesstudents,'invoice'=>$invoice]);
    
    die;
    }
}


}
	
public function getinvoicePrintPdf(Request $request) {
 
 //echo "<pre>";print_r($_POST);die;
if(isset($_POST['bid']))
{

if($request->input('action') == 'getInvoicePrintPdf')
{
		$batch_id = $_POST['bid'];		
		$gi_id = $_POST['gid'];		
		$batches = DB::connection('mysql2')->table('wp_batches_details as batch');				
		$batches = $batches->join('wp_courses_details  as course','course.id','=','batch.batch_course','left');	
		$batches = $batches->select('batch.*','course.course as course_name');			
		$batches = $batches->where('batch.id','=',$batch_id)->first();			 

		$trainer = FeesTrainer::where('id',$batches->batch_trainer)->first();	
		$feesstudents  = FeesStudents::where('stud_batch_id',$batches->id)->get();
		$invoice  = FeesInvoice::where('id',$gi_id)->first();


		return response()->view("genie.invoice.getInvoicePrintPdfSlip",['batches'=>$batches,'trainer'=>$trainer,'feesstudents'=>$feesstudents,'invoice'=>$invoice]);

		
	}
}


}
	 
	 
	  
	public function payHistory(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  	 
		 		 
		return view('genie.invoice.pay-trainer-history');
		
	}
	
	 
	 public function getPayHistoryPagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){
	
			$trainers = FeesTrainer::where('trainer_phone','=',Session::get('mobile'))->first();
//echo "<pre>";print_r($trainers);
			$payhistory = DB::connection('mysql2')->table('wp_allpayinvoice_details as invoice');				
			$payhistory = $payhistory->join('wp_modes_details as mode','mode.id','=','invoice.pay_mode','left');	
			$payhistory = $payhistory->select('invoice.*','mode.*');			
			$payhistory = $payhistory->where('invoice.trainer_id','=',$trainers->trainer_id);			 
			 
			 
		if($request->input('search.value')!==''){
				$payhistory = $payhistory->where(function($query) use($request){
					$query->orWhere('invoice.pay_amount','LIKE','%'.$request->input('search.value').'%')					     
						  ->orWhere('mode.mode','LIKE','%'.$request->input('search.value').'%');
				});
			}
				$payhistory = $payhistory->orderBy('invoice.id','desc');	
			$payhistory = $payhistory->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $payhistory->total();
			$returnLeads['recordsFiltered'] = $payhistory->total();
			$returnLeads['recordCollection'] = [];
 //echo "<pre>";print_r($payhistory);die;
			foreach($payhistory as $pay){
				 
				 
					 
					$data[] = [						
					 
						(isset($pay->created_at)?date('d-M-Y',strtotime($pay->created_at)):""),						 		 
						$pay->pay_amount,							 
						$pay->mode,					 
						$pay->amount_type,					 
					 
						 
					];
					$returnLeads['recordCollection'][] = $pay->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
	
	
	 
	 
		
}
