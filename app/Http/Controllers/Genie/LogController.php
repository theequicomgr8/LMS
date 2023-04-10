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
use App\Logactivity;
use Auth;
use Session;
use DB;
class LogController extends Controller
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
	
	
	public function daylog(Request $request)
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
			return view('genie.log.dayLog',['search'=>$search]);	
	}
	
	public function getDayLogPagination(Request $request)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') ){
		}else{
			return redirect('/');
		}  
		if($request->ajax()){
			
			//echo "sdfsd";die;
			//echo "<pre>";print_r($request->input('search.date_from'));die;
			//echo "<pre>"; print_r($request->input('search'));  
		$daylog= new Logactivity;
			
			$daylog= $daylog->orderBy('id','DESC');
			
			
			if($request->input('search.date_from')!=''){
				$daylog= $daylog->whereDate('created_at','>=',$request->input('search.date_from'));
			}
			if($request->input('search.date_to')!=''){
				$daylog= $daylog->whereDate('created_at','<=',$request->input('search.date_to'));
			} 
			if($request->input('search.role')!='all'){	
				$daylog = $daylog->where('role',$request->input('search.role'));
			} 
			if($request->input('search.live')!='all'){					 
				$daylog = $daylog->where('live_class',$request->input('search.live'));
			} 
			if($request->input('search.course_mark')!='all'){					 
				$daylog = $daylog->where('course_marked',$request->input('search.course_mark'));
			} 
			 
			if($request->input('search.value')!==''){
			$daylog = $daylog->where(function($query) use($request){
					$query->orWhere('name','LIKE','%'.$request->input('search.value').'%')
					->orWhere('technology','LIKE','%'.$request->input('search.value').'%');
				});
			}
			
			
		//	$daylog = $daylog->get());
			$daylog = $daylog->paginate($request->input('length'));
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $daylog->total();
			$returnLeads['recordsFiltered'] = $daylog->total();
			$returnLeads['recordCollection'] = [];
			//echo "<pre>";print_r($daylog);die;
			foreach($daylog as $log){
			    
			    
			    $technology = 	'<span title="'.$log->technology.'">'.substr($log->technology,0,12).'</span>';
			     $name = 	'<span title="'.$log->name.'">'.substr($log->name,0,12).'</span>';
			    $feesBatches =FeesBatches::where('id',$log->batch_id)->first()->batch_name;
				$data[] = [						
					(isset($log->created_at)?date('d-m-y H:i:s',strtotime($log->created_at)):""),						 		 
					$name,	
					$log->mobile,	
					$log->role,					 
					$technology,
					$feesBatches,
					$log->live_class,					 
					$log->course_marked,
				 
				];
				$returnLeads['recordCollection'][] = $log->id;
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		}
	}
	
	
	
	
	 
	 
		
}
