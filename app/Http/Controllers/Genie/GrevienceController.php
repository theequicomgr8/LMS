<?php

namespace App\Http\Controllers\Genie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FeesBatches;
use App\FeesGreviences;
use App\FeesCourse;
use App\FeesTrainer;
use App\FeesGreviencesAttendance;
use App\FeesBatchsAttendance;
use App\CoursesHeading;
use App\CoursesContent;
use App\CoursesSubContent;
use App\CoursesLastContent;
use App\CoursesNotes;
use App\CoursesVideo;
use App\CoursesAssignment;
use App\Logactivity;
use App\CoursesComplete;
use Auth;
use DB;
use Carbon\Carbon;
use Session;
use Mail;
use App\Grevience;
use DataTables;
class GrevienceController extends Controller
{
    public function index(Request $request){
        $data=new Grevience;
        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->mobile=$request->input('mobile');
        $data->related=$request->input('related');
        $data->complain=$request->input('complain');
        $data->save();
    }
    
    public function show(){
        $mobile = Session::get('mobile');
        $role = Session::get('role');	
        if($role=='students')
        {
           $data=DB::table('greviences')->where('mobile',$mobile)->get(); 
        }else if($role=='admin'){
            $data=DB::table('greviences')->get(); 
        }
        
        return view('genie.grevience.list-grevience',compact('data'));
    }
    
    
    public function showlist__(Request $request){
        echo "sdsd";
        $columns = array( 
                    0 =>'id', 
                    1 =>'name',
                    2=> 'email',
                    3=> 'mobile',
                );
  
        $totalData = Grevience::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = Grevience::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  Grevience::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Grevience::where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->count();
        }
        
        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                // $show =  route('posts.show',$post->id);
                // $edit =  route('posts.edit',$post->id);
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['options'] = "&emsp;<a href='edit/{$post->id}' title='SHOW' >Edit</a>
                                          &emsp;<a href='delete/{$post->id}' title='EDIT' >Delete</a>";
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
	        "draw"            => intval($request->input('draw')),  
	        "recordsTotal"    => intval($totalData),  
	        "recordsFiltered" => intval($totalFiltered), 
	        "data"            => $data   
        );
            
        echo json_encode($json_data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function showlist(Request $request)
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
		if($request->ajax()){
			 
 
			$greviences = DB::table('greviences');	
			if($role=='students'){
			    $greviences=$greviences->where('mobile',$mobile);
			}
		$columns=[
            0=>"id",
            1=>"name",
            2=>"email",
            3=>"mobile"
        ];	
		$order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');
        
		if($request->input('search.value')!==''){
				$greviences = $greviences->where(function($query) use($request){
					$query->orWhere('name','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('email','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('mobile','LIKE','%'.$request->input('search.value').'%');
						  
				});
			}
			$greviences = $greviences->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $greviences->total();
			$returnLeads['recordsFiltered'] = $greviences->total();
			$returnLeads['recordCollection'] = [];
 
			foreach($greviences as $key => $grevience){
			    $action="";
                    
                    if($grevience->related=='0'){
                        $related="Counsellor";
                    }else if($grevience->related=='1'){
                        $related="Trainer";
                    }
                    
					$data[] = [						
						$key+1,						 
						$grevience->name,					 
						$grevience->mobile,		
						$related,
						'',
					];
					$returnLeads['recordCollection'][] = $batch->id;
				 
			}
			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			
			
		}
   
		
	}
}
