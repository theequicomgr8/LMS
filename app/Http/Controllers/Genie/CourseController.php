<?php

namespace App\Http\Controllers\genie;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\FeesBatches;
use App\FeesStudents;
use App\FeesCourse;
use App\FeesTrainer;
use App\FeesStudentsAttendance;
use App\CoursesHeading;
use App\CoursesContent;
use App\CoursesSubContent;
use App\CoursesLastContent;
use App\CoursesNotes;
use App\CoursesVideo;
use App\CoursesAssignment;
use App\CoursesComplete;
use App\FeesInvoice;
use App\Logactivity;
use App\User;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Image;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;  
class CourseController extends Controller
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
	
	  
	   /**
     * Get leads excel.
     *
     * @param  Request $request
     * @return ExcelSheet
     */  	
	
	public function index()
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
			return redirect('/');
		} 
		$courses= 	FeesCourse::orderBy('id','DESC')->get();
		return view('genie.course.index',['courses'=>$courses]);
		
	}
	
	 
	
	public function add(Request $request)
	{  
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		$feescourses = FeesCourse::orderBy('course','ASC')->get();	
		$coursesheadinglist = CoursesHeading::orderBy('course_id','ASC')->groupby('course_id')->get();	
		
		if($request->isMethod('post') )
		{			
			$this->validate($request, [
						'course'=>'required|unique:courses_heading,course_id',						 
						'file'=>'required',	 
					]); 
			$allowedFileType = [
			'application/vnd.ms-excel',
			'text/xls',
			'text/xlsx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			];
		 
			 if (in_array($_FILES["file"]["type"], $allowedFileType)) {				 
				$targetPath = $_FILES["file"]["tmp_name"];				 
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);		 
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();
			$highestColumn =$sheet->getHighestRow();
		 
			for($row=2; $row<=$highestColumn; $row++)
			{			 
				$heading = $sheet->getCell('A'.$row)->getValue();		 
				if($heading !=""){
				 
				$coursesHeading  = New CoursesHeading;
				$coursesHeading->course_id = $request->input('course');
				//$coursesHeading->heading = str_replace('?','',$heading);
				$coursesHeading->heading = $heading;
				$coursesHeading->save();
				 $add= 1;
				}else if($heading==""){
					$level1 = $sheet->getCell('B'.$row)->getValue(); 
					if($level1 !=""){
				 
						$coursescontent  = New CoursesContent;	 
						$coursescontent->heading_id = $coursesHeading->id;
						//$coursescontent->coursescontent = str_replace('?','',$level1);
						$coursescontent->coursescontent = $level1;
						$coursescontent->save();
						$add= 1;	
					}else if($level1==""){
					$level2 = $sheet->getCell('C'. $row)->getValue();
					if($level2 !=""){				
						$coursesSubContent  = New CoursesSubContent;	 
						$coursesSubContent->content_id = $coursescontent->id;
						//$coursesSubContent->subcontent = str_replace('?','',$level2);
							$coursesSubContent->subcontent = $level2;
						$coursesSubContent->save();
						$add= 1;
					
					}else if($level2==""){
					$level3 = $sheet->getCell('D'.$row)->getValue();
					if($level3 !=""){					
						$coursesLastcontent  = New CoursesLastContent;	 
						$coursesLastcontent->subcontent_id = $coursesSubContent->id;
						//$coursesLastcontent->lastcontent = str_replace('?','',$level3);
						$coursesLastcontent->lastcontent = $level3;	
						if($coursesLastcontent->save()){
							$add= 1;
						}				 
					
					}
					}  
				}
			}		 
			} 			 
		}  		
			if(!empty($add)){
			return redirect('/course/add')->with('success','Course successfully !');
			}else{
			return redirect('/course/add')->with('failed','Course not Added!');						
			}
		}	 
		
		return view('genie.course.addcourse',['feescourses'=>$feescourses,'coursesheadinglist'=>$coursesheadinglist]);
	}
	public function coursesCompletes(Request $request)
	{	
			$coursesComplete =New CoursesComplete;
			 $coursesComplete= $coursesComplete->orderby('id','desc');
			//$coursesComplete= $coursesComplete->where('status','!=','3');
			//$coursesComplete= $coursesComplete->groupby('course_id');
			//$coursesComplete= $coursesComplete->groupby('batch_id');
			//$coursesComplete= $coursesComplete->groupby('trainer_id');
			$current =date('Y-m-d');
		//	$newcurrent= date('Y-m-d', strtotime($current. ' - 1 day'));			 
			$coursesComplete = $coursesComplete->whereDate('created_at','=',date_format(date_create($current),'Y-m-d'));
			$coursesComplete= $coursesComplete->get();
			
			 if(!empty($coursesComplete)){
				
				foreach($coursesComplete as $complete){
					
					/* $feesStudents= FeesStudents::where('stud_batch_id',$complete->batch_id)->where('courses',$complete->course_id)->where('trainer',$complete->trainer_id)->get()
									
					$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$complete->course_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$complete->batch_id)->where('trainer_id',$complete->trainer_id)->where('course_id',$complete->course_id)->where('heading_id',$course->id)->count();	
					 
					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('content_id',$content->id)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('subcontent_id',$sub->id)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$studentdash[0]->stud_batch_id)->where('trainer_id',$studentdash[0]->trainer)->where('course_id',$studentdash[0]->courses)->where('lastcontent_id',$last->id)->count();  
					}}
					 
					}} 
					}}
					}} */
				}
				
			} 
			 
		}	 
	 
	// GET  Course pagination
	public function getCoursePagination(Request $request)
	{
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){			 
		$courses= 	FeesCourse::orderBy('course','ASC');		 
		if($request->input('search.value')!==''){
				$courses = $courses->where(function($query) use($request){
					$query->orWhere('course','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('trainers','LIKE','%'.$request->input('search.value').'%')						   
						  ->orWhere('course_abbr','LIKE','%'.$request->input('search.value').'%');
				});
			}
			$courses = $courses->paginate($request->input('length'));
			
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $courses->total();
			$returnLeads['recordsFiltered'] = $courses->total();
			$returnLeads['recordCollection'] = [];
 
			foreach($courses as $course){				 
				$action="";
				$seperate="";
				 $coursesHeading = CoursesHeading::where('course_id',$course->id)->get();	
				 if(count($coursesHeading)>0){
					$getcourse= "Yes"; 
				 }else{
					 	$getcourse= "No"; 
						 $action .= '<a href="javascript:courseController.getCourseContentForm('.$course->id.')" title="Add Course Content" class="btn-info">Add</a>'.' | ';
				 }
				$action .='<a href="course/course-view/'.$course->id.'" title="View Course Content" ><i class="fa fa-eye" aria-hidden="true"></i></a> | ';					 
				$action .='<a href="javascript:courseController.delete('.$course->id.')" title="Delete Course Content" ><i class="fa fa-trash" aria-hidden="true"></i></a>';					 
					$data[] = [		 		 		 
						$course->course,					 	
						$getcourse,						
						$action,					  
						 
					];
					$returnLeads['recordCollection'][] = $course->id;				 
			}			
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);			
			
		}  
		
	}
	
	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourseContentForm(Request $request, $id)
    {  
		if($request->ajax()){		 
			$course = FeesCourse::where('id',$id)->first();		 
				 	$html=	'<div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                             <form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseContent('.$id.',this)"  enctype="multipart/form-data">	
										<div class="item form-group mt-3">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Xlsx file <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8">
											<input type="hidden"  name="course_id" value="'.$id.'" ">
												<input type="file" id="first-name" name="file" accept=".xls,.xlsx" required="required" class="form-control ">
											</div>
										</div>						 
										 
										<div class="ln_solid"></div>
										<div class="item form-group mb-0">
											<div class="col-md-7 col-sm-7 offset-md-4">
												 									 
												<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
											</div>
										</div>

									</form>
							 </div></div></div>';
			
				 
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	
	public function saveCourseContent(Request $request,$id)
	{
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){ 
		 
			
			$allowedFileType = [
			'application/vnd.ms-excel',
			'text/xls',
			'text/xlsx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			];
		 
			 if (in_array($_FILES["image"]["type"], $allowedFileType)) {
				 
				$targetPath = $_FILES["image"]["tmp_name"];				 
		 
			 
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);		 
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();
			$highestColumn =$sheet->getHighestRow();		 
			for($row=2; $row<=$highestColumn; $row++)
			{
			 
			$heading = $sheet->getCell('A'.$row)->getValue();			 
			if($heading !=""){				 
				$coursesHeading  = New CoursesHeading;
				$coursesHeading->course_id = $id;
				$coursesHeading->heading = $heading;
				$coursesHeading->save();
				 
				}else if($heading==""){
					$level1 = $sheet->getCell('B'.$row)->getValue(); 
					if($level1 !=""){
				 
						$coursescontent  = New CoursesContent;	 
						$coursescontent->heading_id = $coursesHeading->id;
						$coursescontent->coursescontent = $level1;
						$coursescontent->save();
						$status=1;							 
						$msg="Course Content Upload Successfully!";		
					}else if($level1==""){
					$level2 = $sheet->getCell('C'. $row)->getValue();
					if($level2 !=""){
				 
						$coursessubContent  = New CoursesSubContent;	 
						$coursessubContent->content_id = $coursescontent->id;
						$coursessubContent->subcontent = $level2;
						$coursessubContent->save();
						$status=1;							 
						$msg="Course Content Upload Successfully!";
					 
					}else if($level2==""){
					$level3 = $sheet->getCell('D'.$row)->getValue();
					if($level3 !=""){
					 					
						$coursesLastcontent  = New CoursesLastContent;	 
						$coursesLastcontent->subcontent_id = $coursessubContent->id;
						$coursesLastcontent->lastcontent = $level3;
						if($coursesLastcontent->save()){							 
							$status=1;							 
							$msg="Course Content Upload Successfully!";
						}				
					}
					}  
				}
			}	 
			} 				 
		}else{
			$status=0;							 
			$msg="Course Content Upload Xlsx!";
		}	
			return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}	
	
	
	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourseContentBatchForm(Request $request, $bid,$cid)
    {  
		if($request->ajax()){		 
		 	 	$html=	'<div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                             <form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseBatchContent('.$bid.','.$cid.',this)"  enctype="multipart/form-data">	
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Xlsx file <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8">
											<input type="hidden"  name="course_id" value="'.$cid.'" ">
											<input type="hidden"  name="bat_id" value="'.$bid.'" ">
												<input type="file" id="first-name" name="file" accept=".xls,.xlsx" required="required" class="form-control ">
											</div>
										</div>						 
										 
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-7 col-sm-7 offset-md-4">
												 									 
												<button type="submit" class="btn btn-success" name="submit">Submit</button>
											</div>
										</div>

									</form>
							 </div></div></div>';
			
				 
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	
	public function saveCourseBatchContent(Request $request,$bid,$cid)
	{
		
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		
		 //echo "<pre>";print_r($_FILES); echo $id;die;
		if($request->ajax()){ 
		 
			
			$allowedFileType = [
			'application/vnd.ms-excel',
			'text/xls',
			'text/xlsx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			];
		 
			 if (in_array($_FILES["image"]["type"], $allowedFileType)) {
				 
				$targetPath = $_FILES["image"]["tmp_name"];				 
		 
			 
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);		 
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();
			$highestColumn =$sheet->getHighestRow();		 
			for($row=2; $row<=$highestColumn; $row++)
			{
			 
			$heading = $sheet->getCell('A'.$row)->getValue();			 
			if($heading !=""){				 
				$coursesHeading  = New CoursesHeading;
				$coursesHeading->course_id = $cid;
				$coursesHeading->bat_id = $bid;
				$coursesHeading->heading = $heading;
				$coursesHeading->save();
				// echo "<pre>";print_r($coursesHeading);die;
				}else if($heading==""){
					$level1 = $sheet->getCell('B'.$row)->getValue(); 
					if($level1 !=""){
				 
						$coursescontent  = New CoursesContent;	 
						$coursescontent->heading_id = $coursesHeading->id;
						$coursescontent->coursescontent = $level1;
						$coursescontent->save();
						$status=1;							 
						$msg="Course Content Upload Successfully!";		
					}else if($level1==""){
					$level2 = $sheet->getCell('C'. $row)->getValue();
					if($level2 !=""){
				 
						$coursessubContent  = New CoursesSubContent;	 
						$coursessubContent->content_id = $coursescontent->id;
						$coursessubContent->subcontent = $level2;
						$coursessubContent->save();
						$status=1;							 
						$msg="Course Content Upload Successfully!";
					 
					}else if($level2==""){
					$level3 = $sheet->getCell('D'.$row)->getValue();
					if($level3 !=""){
					 					
						$coursesLastcontent  = New CoursesLastContent;	 
						$coursesLastcontent->subcontent_id = $coursessubContent->id;
						$coursesLastcontent->lastcontent = $level3;
						if($coursesLastcontent->save()){							 
							$status=1;							 
							$msg="Course Content Upload Successfully!";
						}				
					}
					}  
				}
			}	 
			} 				 
		}else{
			$status=0;							 
			$msg="Course Content Upload Xlsx!";
		}	
			return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}	

	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourseVideoForm(Request $request, $id)
    {  
		if($request->ajax()){		 
			$videos = CoursesVideo::where('heading_id',$id)->get();		
			if($videos){
				foreach($videos as $video){
			$name .= '				
				<tr><td>'.$vname= unserialize($video->video); $image = $vname['video']['name'].'</td><td>video</td>
				</tr>
				';
			}
			}
				
				$html ='<div class="x_content">
				<div class="row">
				<div class="col-sm-12">
				<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
				'.$name.'
				</table>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseVideo('.$id.',this)"  enctype="multipart/form-data"> 
				<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Video file <span class="required">*</span>
				</label>
				<div class="col-md-8 col-sm-8">
				<input type="hidden"  name="course_id" value="'.$id.'" ">
				<input type="file" id="first-name" name="file" accept=".mpeg,.ogg,.mp4,.webm,.3gp,.mov,.flv,.avi,.wmv,.ts" required="required" class="form-control ">
				</div>
				</div>


				<div class="ln_solid"></div>
				<div class="item form-group">
				<div class="col-md-7 col-sm-7 offset-md-4">
				<button type="submit" class="btn btn-success" name="submit">Submit</button>
				</div>
				</div>

				</form>
				</div></div></div>';			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	
	public function saveCourseVideo(Request $request,$h_id,$b_id,$c_id,$t_id)
	{
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){ 
			$allowedFileType = [
			'video/x-ms-wmv',	 
			'video/mp4',		 
			];
		 
		if (in_array($_FILES["video"]["type"], $allowedFileType)){
				
			 if ($request->hasFile('video')) {
					$image = [];
					$filePath = getVideoFolderStructure();
					$file = Input::file('video');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);				 
					 $image['video'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);			
					
					$coursesVideo = New CoursesVideo;
					$coursesVideo->heading_id = $h_id;
					$coursesVideo->batch_id = $b_id;
					$coursesVideo->trainer_id =$t_id;
					$coursesVideo->course_id = $c_id;
					$coursesVideo->video = serialize($image);	

//echo "<pre>";print_r($coursesVideo);die;					
					if($coursesVideo->save()){
						$status=1;							 
						$msg="Course Video Successfully !";						
					}					 
				}
				 
		}else{
				$status=0;							 
				$msg="Please upload Video !";
		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
	
	public function adminSaveCourseVideo(Request $request,$h_id,$c_id)
	{
		 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){ 
			$allowedFileType = [
			'video/x-ms-wmv',	 
			'video/mp4',		 
			];
		 //echo $h_id.'=='.$c_id;die;
		if (in_array($_FILES["video"]["type"], $allowedFileType)){
				
			 if ($request->hasFile('video')) {
					$image = [];
					$filePath = getVideoFolderStructure();
					$file = Input::file('video');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);				 
					 $image['video'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);			
					
					$coursesVideo = New CoursesVideo;
					$coursesVideo->heading_id = $h_id;					 
					$coursesVideo->course_id = $c_id;
					$coursesVideo->video = serialize($image);	

//echo "<pre>";print_r($coursesVideo);die;					
					if($coursesVideo->save()){
						$status=1;							 
						$msg="Course Video Successfully !";						
					}					 
				}
				 
		}else{
				$status=0;							 
				$msg="Please upload Video !";
		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
 	
	/**
     * Update the Incentive resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourseNotesForm(Request $request, $id)
    {  
		if($request->ajax()){		 
			$course = FeesCourse::where('id',$id)->first();		 
				$html=	'<div class="x_content">
				<div class="row">
				<div class="col-sm-12">
				<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseNotes('.$id.',this)"  enctype="multipart/form-data"> 
				<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select PDF, Doc file <span class="required">*</span>
				</label>
				<div class="col-md-8 col-sm-8">
				<input type="hidden"  name="course_id" value="'.$id.'" ">
				<input type="file" id="first-name" name="file" accept=".pdf,.doc,.docx" required="required" class="form-control ">
				</div>
				</div>


				<div class="ln_solid"></div>
				<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
				 

				<button type="submit" class="btn btn-success" name="submit">Submit</button>
				</div>
				</div>

				</form>
				</div></div></div>';
			
				 
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
	
	public function saveCourseNotes(Request $request,$h_id,$b_id,$c_id,$t_id)
	{
			 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){ 
		// echo "<pre>";print_r($_FILES);die;
			
			$allowedFileType = [
			'application/doc',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/msword',
			'application/pdf',			 
			];
		 
		 
		 
			 if (in_array($_FILES["notes"]["type"], $allowedFileType)) {				 		 
		 
			 if ($request->hasFile('notes')) {
					$image = [];
					$filePath = getNotesFolderStructure();
					$file = Input::file('notes');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename); 					 
					 $image['notes'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);
										
					$coursesNotes = New CoursesNotes;
					$coursesNotes->heading_id = $h_id;
					$coursesNotes->batch_id = $b_id;
					$coursesNotes->trainer_id = $t_id;
					$coursesNotes->course_id = $c_id;
					$coursesNotes->notes = serialize($image);
					//echo "<pre>";print_r($coursesNotes);die;
					if($coursesNotes->save()){
						$status=1;							 
						$msg="Course Notes Successfully !";
						
					}
					 
				}
 
				 
		}else{
				$status=0;							 
				$msg="Please Upload PDF OR Doc!";


		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
	
	public function adminSaveCourseNotes(Request $request,$h_id,$c_id)
	{
			 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){ 
		// echo "<pre>";print_r($_FILES);die;
			
			$allowedFileType = [
			'application/doc',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/msword',
			'application/pdf',			 
			];
		 
		 
		 
			 if (in_array($_FILES["notes"]["type"], $allowedFileType)) {				 		 
		 
			 if ($request->hasFile('notes')) {
					$image = [];
					$filePath = getNotesFolderStructure();
					$file = Input::file('notes');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename); 					 
					 $image['notes'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);
										
					$coursesNotes = New CoursesNotes;
					$coursesNotes->heading_id = $h_id;					 
					$coursesNotes->course_id = $c_id;
					$coursesNotes->notes = serialize($image);
					//echo "<pre>";print_r($coursesNotes);die;
					if($coursesNotes->save()){
						$status=1;							 
						$msg="Course Notes Successfully !";
						
					}
					 
				}
 
				 
		}else{
				$status=0;							 
				$msg="Please Upload PDF OR Doc!";


		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
	public function saveCourseAssignment(Request $request,$h_id,$b_id,$c_id,$t_id)
	{
			 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){			
			$allowedFileType = [
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/pdf',			 
			];
		 
		 
		 
			 if (in_array($_FILES["assignment"]["type"], $allowedFileType)) { 
			 if ($request->hasFile('assignment')) {
					$image = [];
					$filePath = getAssignFolderStructure();
					$file = Input::file('assignment');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename); 
					 $image['assignment'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);				
					
					$coursesAssignment = New CoursesAssignment;
					$coursesAssignment->heading_id = $h_id;
					$coursesAssignment->batch_id = $b_id;
					$coursesAssignment->trainer_id = $t_id;
					$coursesAssignment->course_id = $c_id;
					$coursesAssignment->assignment = serialize($image);
					if($coursesAssignment->save()){
						$status=1;							 
						$msg="Course Assignment Successfully !";
						
					}
					 
				}
 
				 
		}else{
				$status=0;							 
				$msg="Please Upload PDF OR Doc , Docx!";


		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
	public function adminSaveCourseAssignment(Request $request,$h_id,$c_id)
	{
			 
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
		if($request->ajax()){			
			$allowedFileType = [
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/pdf',			 
			];
		 
		 
		 
			 if (in_array($_FILES["assignment"]["type"], $allowedFileType)) { 
			 if ($request->hasFile('assignment')) {
					$image = [];
					$filePath = getAssignFolderStructure();
					$file = Input::file('assignment');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());			 
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename); 
					 $image['assignment'] = array(
						'name'=>$filename,
						'alt'=>$filename,						
						'src'=>$filePath."/".$filename
					);				
					
					$coursesAssignment = New CoursesAssignment;
					$coursesAssignment->heading_id = $h_id;					 
					$coursesAssignment->course_id = $c_id;
					$coursesAssignment->assignment = serialize($image);
					if($coursesAssignment->save()){
						$status=1;							 
						$msg="Course Assignment Successfully !";
						
					}
					 
				}
 
				 
		}else{
				$status=0;							 
				$msg="Please Upload PDF OR Doc , Docx!";
		}			
		
		
			 return response()->json(['status'=>$status,'msg'=>$msg],200);
			
		
		}
		
		
	}
	
	
	 public function courseView(Request $request,$id){
		 $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
		 
		 $heading = DB::table('courses_heading as heading');				 
		$heading= $heading->where('course_id',$id);
		$heading= $heading->get();
			
			 
		  return view('genie.course.courseView',['heading'=>$heading]);
		 
	}
	
	
	 public function deleted(Request $request,$id){
		  $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
 
			$coursesHeading = CoursesHeading::where('course_id',$id)->get();	
 		
			if(count($coursesHeading)>0){
				 
				foreach($coursesHeading as $heading){					 
						$coursesContent = CoursesContent::where('heading_id',$heading->id)->get();
						if(count($coursesContent)>0){
							foreach($coursesContent as $content){
								$coursesSubContent = CoursesSubContent::where('content_id',$content->id)->get();
								if(count($coursesSubContent)>0){
									foreach($coursesSubContent as $subcontent){										
										$coursesLastContent = CoursesLastContent::where('subcontent_id',$subcontent->id)->get();
										if(count($coursesLastContent)>0){
											foreach($coursesLastContent as $lastContent){
												$deleteLastContent = CoursesLastContent::where('id',$lastContent->id)->delete();
												$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
												$delcontent  =CoursesContent::where('id',$content->id)->delete();
												$delheading  =CoursesHeading::where('id',$heading->id)->delete();
												$status=1;
												$error=200;
												$msg="Course Content Successfully Deleted!";
											}
										}else{											
											$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
											$delcontent  =CoursesContent::where('id',$content->id)->delete();
											$delheading  =CoursesHeading::where('id',$heading->id)->delete();
											$status=1;
											$error=200;
											$msg="Course Content Successfully Deleted!";											
										}										
									}									
								}else{
									$delcontent  =CoursesContent::where('id',$content->id)->delete();
									$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
									$status=1;
									$error=200;
									$msg="Course Content Successfully Deleted!";
								}								
							}							
						}else{
							$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
							$status=1;
							$error=200;
							$msg="Course Content Successfully Deleted!";
						}							
				}
				
									 
			
			}else{	 		
				$error=404;
				$status=0;
				$msg="Not Record found!";				
			}
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	 
	 public function courseVideodelete(Request $request,$id){
		  $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			$coursesVideo = CoursesVideo::findOrFail($id);		  
			if($coursesVideo->video!='')
			{
				$image = unserialize($coursesVideo->video);
			 
				$large = $image['video']['src'];
				 
				if(!empty($image['video']['src'])){
				$thumbnail = $image['video']['src'];
				if (file_exists($thumbnail))
				{
				unlink($thumbnail);
				}  
				}
				 
			}
			if($coursesVideo->delete()){				
			$status=1;				 
			$msg="Course Video Successfully Deleted!";			
			}else{			 
				$status=0;
				$msg="Not Record found!";	
			}
			
			 
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	 
	 public function courseNotesdelete(Request $request,$id){
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			$coursesNotes = CoursesNotes::findOrFail($id);		  
			 
			if($coursesNotes->notes!='')
			{
				$image = unserialize($coursesNotes->notes);
			 
				$large = $image['notes']['src'];
				 
				if(!empty($image['notes']['src'])){
				$thumbnail = $image['notes']['src'];
				if (file_exists($thumbnail))
				{
				unlink($thumbnail);
				}  
				}
				 
			}
			if($coursesNotes->delete()){				
			$status=1;				 
			$msg="Course notes Successfully Deleted!";			
			}else{			 
				$status=0;
				$msg="Not Record found!";	
			}
			
			 
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	 
	 public function courseAssignmentdelete(Request $request,$id){
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			$coursesAssignment = CoursesAssignment::findOrFail($id);		  
			 
			if($coursesAssignment->assignment!='')
			{
				$image = unserialize($coursesAssignment->assignment);
			 
				$large = $image['assignment']['src'];
				 
				if(!empty($image['assignment']['src'])){
				$thumbnail = $image['assignment']['src'];
				if (file_exists($thumbnail))
				{
				unlink($thumbnail);
				}  
				}
				 
			}
			if($coursesAssignment->delete()){				
			$status=1;				 
			$msg="Course assignment Successfully Deleted!";			
			}else{			 
				$status=0;
				$msg="Not Deleted Assignment!";	
			}
			
			 
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	 
		 		
		// Course heading status complete	
	public function courseHeadingStatus(Request $request){
	 
	if(isset($_POST['hid']))
	{

	if($request->input('action') == 'updateHeadingstatus')
	{
			$complete_id = $request->input('complete_id');	
			$hid = $request->input('hid');	
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');	
			$status = $request->input('status');
			// echo "<pre>";print_r($_POST);die;
			/* $coursesHeading  =CoursesHeading::findOrFail($hid);
			$coursesHeading->status= $status; */			
			$headingcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$hid)->get();
			if(!empty($headingcomplete) && !empty($complete_id)){
				$coursesComplete =CoursesComplete::findOrFail($complete_id);				
			}else{
				$coursesComplete = new CoursesComplete;
			}			 
			 
			$coursesComplete->batch_id = $b_id;
			$coursesComplete->trainer_id = $t_id;
			$coursesComplete->course_id = $c_id;
			$coursesComplete->heading_id = $hid;
			$coursesComplete->status = $status;
			$coursesComplete->heading_date = date('Y-m-d H:i:s');
			//echo "<pre>";print_r($coursesComplete);echo "end";die;
			if($coursesComplete->save()){			
				
					$todaydate=date('Y-m-d');
				
			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;
                    $logactivity = new Logactivity;
                    $logactivity->date= date('Y-m-d H:i:s');
                    $logactivity->name= $trainers->name;
                    $logactivity->mobile= $trainers->trainer_phone;
                    $logactivity->trainer_id= $t_id;
                    $logactivity->course_id= $c_id;
                    $logactivity->batch_id= $b_id;
                    $logactivity->role= "Trainer";
                    $logactivity->technology= $coursename;
                    $logactivity->course_marked= "Yes";
                    $logactivity->remark= "Course Remark Header";				 
                    $logactivity->save();
                
                

					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Header";				 
					$logactivity->save();
                
					}
					}

				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $contentstotal +$subcontentstotal ;
					$completetotaldh= $contentcomplete +$subcontentcomplete;					
				//echo $completetotaldh.'--'.$totalcousedh;die;
					if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){		

						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}
					
					$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}				
						//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
			$status=1;							 
			$msg="Course Content Successfully !";
			$completeid =$coursesComplete->id;
			}else{
			$status=0;							 
			$msg="Some Error!";

			} 
 
	}
	 return response()->json(['status'=>$status,'msg'=>$msg,'completeid'=>$completeid],200);
	}
	}	
	
	
	// Course Content status complete	
	public function courseContentStatus(Request $request){
 
        if(isset($_POST['hcid']))
        {
        
        if($request->input('action') == 'updateContentstatus')
        {
        
        $hcid = $request->input('hcid');	
        $b_id = $request->input('b_id');	
        $c_id = $request->input('c_id');	
        $t_id = $request->input('t_id');	
        if(!empty($hcid)){
        
        foreach($hcid as $hid){
        
        $currentdate =date('Y-m-d');
        $checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','>=',date_format(date_create($currentdate),'Y-m-d'))->first(); 
        
        
        $headingcompletefist = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$hid)->first();
        if(!empty($headingcompletefist) && !empty($headingcompletefist->id)){
        $coursesCompletes =CoursesComplete::findOrFail($headingcompletefist->id);				
        }else{
        $coursesCompletes = new CoursesComplete;
        }			 
        
        $coursesCompletes->batch_id = $b_id;
        $coursesCompletes->trainer_id = $t_id;
        $coursesCompletes->course_id = $c_id;
        $coursesCompletes->heading_id = $hid;
        $coursesCompletes->status = 1;
        $coursesCompletes->heading_date = date('Y-m-d H:i:s');
        
        if($coursesCompletes->save()){	
        $todaydate=date('Y-m-d');
        $checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','>=',date_format(date_create($currentdate),'Y-m-d'))->first(); 
        
        
        if(!empty($checktrainer)){ 
        
        if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	
        
        }else{
        $trainers = FeesTrainer::where('id',$t_id)->first();				 
        
        if(!empty($trainers)){
        
        $trainer_courses = unserialize($trainers->courses); 				 
        $course = FeesCourse::findorFail($trainer_courses[0]);
        if(!empty($course)){
        $coursename=$course->course;
        }else{
        $coursename= "";
        }
        
        
        $user = $trainers;
        $email = $trainers->trainer_email;
        
        $logactivity = new Logactivity;
        $logactivity->date= date('Y-m-d H:i:s');
        $logactivity->name= $trainers->name;
        $logactivity->mobile= $trainers->trainer_phone;
        $logactivity->trainer_id= $t_id;
        $logactivity->course_id= $c_id;
        $logactivity->batch_id= $b_id;
        $logactivity->role= "Trainer";
        $logactivity->technology= $coursename;
        $logactivity->course_marked= "Yes";
        $logactivity->remark= "Course Remark Header";				 
        $logactivity->save();
        
        
        } 
        }
        }else{
        
        
        
        $trainers = FeesTrainer::where('id',$t_id)->first();
        
        
        if(!empty($trainers)){
        
        $trainer_courses = unserialize($trainers->courses); 				 
        $course = FeesCourse::findorFail($trainer_courses[0]);
        if(!empty($course)){
        $coursename=$course->course;
        }else{
        $coursename= "";
        }
        
        $user = $trainers;
        $email = $trainers->trainer_email;
        
        $logactivity = new Logactivity;
        $logactivity->date= date('Y-m-d H:i:s');
        $logactivity->name= $trainers->name;
        $logactivity->mobile= $trainers->trainer_phone;
        $logactivity->trainer_id= $t_id;
        $logactivity->course_id= $c_id;
        $logactivity->batch_id= $b_id;
        $logactivity->role= "Trainer";
        $logactivity->technology= $coursename;
        $logactivity->course_marked= "Yes";
        $logactivity->remark= "Course Remark Header";				 
        $logactivity->save();
        }
        }
        
        
        $heading = DB::table('courses_heading as heading');				 
        $heading= $heading->where('course_id',$c_id);					 
        $heading= $heading->get();  		 
        $headingtotal =$heading->count();					 
        if(!empty($heading)){	
        $headingcomplete=0;
        $contentstotal=0;
        $contentcomplete=0;
        $subcontentstotal=0;
        $subcontentcomplete=0;
        $lastcontentstotal=0;
        $lastcontentcomplete=0;
        foreach($heading as $course){						 
        $headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
        $contents = CoursesContent::where('heading_id',$course->id)->get();
        $contentstotal += $contents->count();
        
        if($contents){	
        foreach($contents as $content){
        $contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
        
        $subcontents = CoursesSubContent::where('content_id',$content->id)->get();
        $subcontentstotal +=$subcontents->count();
        if($subcontents){										
        foreach($subcontents as $sub){
        $subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   
        
        $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
        $lastcontentstotal +=$lastcontents->count();
        if($lastcontents){										
        foreach($lastcontents as $last){
        $lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
        }}
        
        }} 
        }}
        }}
        
        $totalcousedh= $headingtotal+$contentstotal +$subcontentstotal;
        $completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete;					
        
        if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){		
        
        $feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
        if($feesstudentbatch){	
        foreach($feesstudentbatch as $stud){
        $feedback =FeesStudents::findOrFail($stud->id);
        $feedback->first_feed=1;
        $feedback->save();
        }
        }
        
        //$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
        }else if(($completetotaldh+1)>=$totalcousedh){	
        $feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
        if($feesstudentbatch){	
        foreach($feesstudentbatch as $stud){
        $feedback =FeesStudents::findOrFail($stud->id);
        $feedback->first_feed=2;
        $feedback->save();
        }
        }				
        //$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
        }
        
        
        
        $status=1;	
        $msg="Course Content marked successfully. Click on ``GO LIVE NOW`` button to take live class.";
        }else{
        $status=0;							 
        $msg="Does not successfully course content !";
        
        } 
        
        
        
        } 
        
        }
        
        }
        
        }
 
	if(isset($_POST['cid']))
	{

	if($request->input('action') == 'updateContentstatus')
	{
		 
			$cid = $request->input('cid');	
			$ids = $request->input('cid');	
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');	
		 
			 	 
	 	if(!empty($ids)){
		foreach($ids as $id){
	  
			$contentcompletesecond = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$id)->first();
			
			if(!empty($contentcompletesecond) && !empty($contentcompletesecond->id)){
				$coursesComplete =CoursesComplete::findOrFail($contentcompletesecond->id);
				
			}else{
				$coursesComplete = new CoursesComplete;
			}	
			 
			 
			 
			$coursesComplete->batch_id = $b_id;
			$coursesComplete->trainer_id = $t_id;
			$coursesComplete->course_id = $c_id;
			$coursesComplete->content_id = $id;
			$coursesComplete->status = 1;
			$coursesComplete->content_date = date('Y-m-d H:i:s');
	 
			if($coursesComplete->save()){
				
				$currentdate=date('Y-m-d');

			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($currentdate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;

					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();


					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;

					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();
					}
					}

				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
				//	$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
				 	$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}}  
					
					
					}}
					}
					}
										 
				//	$totalcousedh= $contentstotal +$subcontentstotal +$lastcontentstotal;
				//	$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;					
				//	$totalcousedh= $contentstotal ;
				//	$completetotaldh= $contentcomplete;					
			 
					$totalcousedh= $contentstotal +$subcontentstotal;
					$completetotaldh= $contentcomplete +$subcontentcomplete;	
			
				if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}				
					//$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}				
				//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
				
				
		 $status=1;	
        $msg="Course Content marked successfully. Click on ``GO LIVE NOW`` button to take live class.";
        }else{
        $status=0;							 
        $msg="Does not successfully course content !";
        
        } 
			
			
		}
		
		}
		
		
	}
	 
	}
	
	if(isset($_POST['subcid']))
	{

	if($request->input('action') == 'updateContentstatus')
	{
			 	//echo "<pre>";print_r($_POST);die;
			$subcid = $request->input('subcid');
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');	
			 
			 if(!empty($subcid)){

			foreach($subcid as $scid){

			$subcontentcompletethird = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$scid)->get();			
		
			if(!empty($subcontentcompletethird) && !empty($subcontentcompletethird->id)){
			$coursesSubComplete =CoursesComplete::findOrFail($subcontentcompletethird->id);
			
			}else{
			$coursesSubComplete = new CoursesComplete;
			}						 
			$coursesSubComplete->batch_id = $b_id;
			$coursesSubComplete->trainer_id = $t_id;
			$coursesSubComplete->course_id = $c_id;
			$coursesSubComplete->subcontent_id = $scid;
			$coursesSubComplete->status= 1;
			$coursesSubComplete->subcontent_date = date('Y-m-d H:i:s');
			if($coursesSubComplete->save()){

				$currentdate=date('Y-m-d');


			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','>=',date_format(date_create($currentdate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;

					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();


					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;

					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();
					}
					}
				
				
				
				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete;					
				//echo $completetotaldh.'--'.$totalcousedh;die;
					if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}						
				//	$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}					
				//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
			
            $status=1;	
            $msg="Course Content marked successfully. Click on ``GO LIVE NOW`` button to take live class.";
            }else{
            $status=0;							 
            $msg="Does not successfully course content !";
            
            } 



}
}



 
	}
	  
	}

	
	return response()->json(['status'=>$status,'msg'=>$msg],200);
	
	
	}

	
	// Course Content status complete	
	public function courseContentStatus_old(Request $request) {
	 
	if(isset($_POST['cid']))
	{

	if($request->input('action') == 'updateContentstatus')
	{
			$complete_id = $request->input('complete_id');	
			$cid = $request->input('cid');	
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');	
			$status = $request->input('status');
			 
	  //echo "<pre>";print_r($_POST);die;
	  
			$contentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$cid)->get();
			if(!empty($contentcomplete) && !empty($complete_id)){
				$coursesComplete =CoursesComplete::findOrFail($complete_id);
				
			}else{
				$coursesComplete = new CoursesComplete;
			}	
			 
			$coursesComplete->batch_id = $b_id;
			$coursesComplete->trainer_id = $t_id;
			$coursesComplete->course_id = $c_id;
			$coursesComplete->content_id = $cid;
			$coursesComplete->status = $status;
			$coursesComplete->content_date = date('Y-m-d H:i:s');
			//echo "<pre>";print_r($coursesComplete);die;
			if($coursesComplete->save()){
				
				
					$todaydate=date('Y-m-d');
			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();
                

					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Content";				 
					$logactivity->save();
                 
                
					}
					}

				
				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;					
			 
				
			
				if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}				
					$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}				
				//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
				
				
			$status=1;							 
			$msg="Course Content Successfully !";
			}else{
			$status=0;							 
			$msg="Some Error!";

			} 
 
	}
	 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	}

	// Course Sub Content status complete	
	public function courseSubContentStatus(Request $request) {
	 
	if(isset($_POST['scid']))
	{

	if($request->input('action') == 'updateSubContentstatus')
	{
			$complete_id = $request->input('complete_id');	
			$scid = $request->input('scid');	
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');	
			$status = $request->input('status');
			 
			$subcontentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$scid)->get();
			if(!empty($subcontentcomplete) && !empty($complete_id)){
				$coursesComplete =CoursesComplete::findOrFail($complete_id);
				
			}else{
				$coursesComplete = new CoursesComplete;
			}			 
			 
			$coursesComplete->batch_id = $b_id;
			$coursesComplete->trainer_id = $t_id;
			$coursesComplete->course_id = $c_id;
			$coursesComplete->subcontent_id = $scid;
			$coursesComplete->status= $status;
			$coursesComplete->subcontent_date = date('Y-m-d H:i:s');
			if($coursesComplete->save()){
				
				$todaydate=date('Y-m-d');
			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;

                 
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Header";				 
					$logactivity->save();

                 
                
					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;
                
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Header";				 
					$logactivity->save();
					
				 
					}
					}

				
				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;					
				//echo $completetotaldh.'--'.$totalcousedh;die;
					if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}						
					$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}					
				//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
			$status=1;							 
			$msg="Course Content Successfully !";
			}else{
			$status=0;							 
			$msg="Some Error!";

			} 
 
	}
	 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	}

	// Course Sub Content status complete	
	public function courseLastContentStatus(Request $request) {
	 
	if(isset($_POST['lcid']))
	{

	if($request->input('action') == 'updateLastContentstatus')
	{
			$complete_id = $request->input('complete_id');	
			$lcid = $request->input('lcid');	
			$b_id = $request->input('b_id');	
			$c_id = $request->input('c_id');	
			$t_id = $request->input('t_id');
			$status = $request->input('status');
			 $lastcontentcomplete = CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$lcid)->get();			 
			if(!empty($lastcontentcomplete) && !empty($complete_id)){
				$coursesComplete =CoursesComplete::findOrFail($complete_id);
				
			}else{
				$coursesComplete = new CoursesComplete;
			}	
			 
			$coursesComplete->batch_id = $b_id;
			$coursesComplete->trainer_id = $t_id;
			$coursesComplete->course_id = $c_id;
			$coursesComplete->lastcontent_id = $lcid;
			$coursesComplete->status= $status;
			$coursesComplete->lastcontent_date = date('Y-m-d H:i:s');
			if($coursesComplete->save()){
				
					$todaydate=date('Y-m-d');
			$checktrainer= Logactivity::where('trainer_id',$t_id)->where('course_id',$c_id)->where('batch_id',$b_id)->whereDate('created_at','=',date_format(date_create($todaydate),'Y-m-d'))->first(); 
			if(!empty($checktrainer)){ 
			$todaydate=date('Y-m-d');
			if($todaydate == date('Y-m-d',strtotime($checktrainer->created_at))){	

			}else{
					$trainers = FeesTrainer::where('id',$t_id)->first();				 

					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}


					$user = $trainers;
					$email = $trainers->trainer_email;

                 
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Header";				 
					$logactivity->save();
                    

					} 
					}
					}else{



					$trainers = FeesTrainer::where('id',$t_id)->first();

 
					if(!empty($trainers)){

					$trainer_courses = unserialize($trainers->courses); 				 
					$course = FeesCourse::findorFail($trainer_courses[0]);
					if(!empty($course)){
					$coursename=$course->course;
					}else{
					$coursename= "";
					}

					$user = $trainers;
					$email = $trainers->trainer_email;
                  
					$logactivity = new Logactivity;
					$logactivity->date= date('Y-m-d H:i:s');
					$logactivity->name= $trainers->name;
					$logactivity->mobile= $trainers->trainer_phone;
					$logactivity->trainer_id= $t_id;
					$logactivity->course_id= $c_id;
					$logactivity->batch_id= $b_id;
					$logactivity->role= "Trainer";
					$logactivity->technology= $coursename;
					$logactivity->course_marked= "Yes";
					$logactivity->remark= "Course Remark Header";				 
					$logactivity->save();
                     
					}
					}

				
				$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  		 
					$headingtotal =$heading->count();					 
					if(!empty($heading)){	
					$headingcomplete=0;
					$contentstotal=0;
					$contentcomplete=0;
					$subcontentstotal=0;
					$subcontentcomplete=0;
					$lastcontentstotal=0;
					$lastcontentcomplete=0;
					foreach($heading as $course){						 
					$headingcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;					
				//echo $completetotaldh.'--'.$totalcousedh;die;
					if(($completetotaldh >= ($totalcousedh/2)) && ($completetotaldh <= (($totalcousedh/2)+5))){		
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=1;
						$feedback->save();
						}
						}						
					$this->invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id);
				}else if(($completetotaldh+1)>=$totalcousedh){	
						$feesstudentbatch  = FeesStudents::where('stud_batch_id',$b_id)->get();	
						if($feesstudentbatch){	
						foreach($feesstudentbatch as $stud){
						$feedback =FeesStudents::findOrFail($stud->id);
						$feedback->first_feed=2;
						$feedback->save();
						}
						}					
				//$this->invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id);
				}
			$status=1;							 
			$msg="Course Content Successfully !";
			}else{
			$status=0;							 
			$msg="Some Error!";

			} 
 
	}
	 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	}


	public function invoiceGeneratedFiftyTrainer($b_id,$t_id,$c_id)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			//echo "FiftyTrainer";die;
		// echo $b_id;die;
		if($b_id){
	
		 
		$batch =FeesBatches::where('id',$b_id)->where('batch_visibility','1')->where('invoice_status','0')->orderBy('id','desc')->first();		 
		 if($batch->invoice_status =='0' ){		 
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();			
		//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();
		 		 // echo "<pre>";print_r($checkinvoices);die;
		 
				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();		
			
				if($feestrainer->share_release=="50" && $feestrainer->type="external"){	 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;					
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 $batchInvoiceStatus=1;
					 
					 
					 
					}
					
					/* else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount;
					$batchInvoiceStatus=2;
					} */
					
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
						
					$batchInvoiceStatus=1;	
					 
					}
					/* else if($feestrainer->share_release=='100'){
						
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
						
					$batchInvoiceStatus=2;	
					} */
					
				} else if(!empty($feesstudent) && ($feestrainer->payout_share=='per_student')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 $batchInvoiceStatus=1;
					}
					
					/* else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
							$batchInvoiceStatus=2;
						
					} */
					
				}
				
			 
				if($invoiceamount){
				//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();			 
				 
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
				$feesInvoice->pay_status=0;
				$feesInvoice->lms_status=1;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				//echo "<pre>";print_r($feesInvoice);die;
				
				/*if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=1;					
					$feesbatch->status=0;					
					$feesbatch->save(); 
					 
					
					
					
				}else{
				$feesInvoice->delete();	
				} */
				 
				
				} 					
					
				}
				
				/* else if($feestrainer->share_release=="100"){
						
						if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
						$std_amount=0;					
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 $batchInvoiceStatus=1;
					}else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount;
					$batchInvoiceStatus=2;
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
						
						$batchInvoiceStatus=1;
					 
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
					$batchInvoiceStatus=2;
						
					}
					
				} else if(!empty($feesstudent) && ($feestrainer->payout_share=='per_student')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 $batchInvoiceStatus=1;
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						$batchInvoiceStatus=2;
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();				
				 
				if(count($checkinvoices)>0){					  
					 
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
				$feesInvoice->pay_status=0;
				$feesInvoice->lms_status=1;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				 
				if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=$batchInvoiceStatus;	
					$feesbatch->status=2;							
					$feesbatch->save();						
				} 
				}
				
				} 			
						
					} */ 
				
		 
		 
		 
		 
		}
		/* else if($batch->invoice_status=='1'){
 
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first(); 
		$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();
		 		
		 if(count($checkinvoices)>0){
			 
		 }else{				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 
				 
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
					 $batchInvoiceStatus=1;
					}else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
							 $batchInvoiceStatus=2;
						
					}
					
				}
				
			 
				if($invoiceamount){
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();
				
				 
				if(count($checkinvoices)>0){					 
					 
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
				$feesInvoice->pay_status=0;
				$feesInvoice->lms_status=1;
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
					$feesbatch->save(); 
					
				}else{
				$feesInvoice->delete();					 
				}
				}
				
				} 
				
		
		 }

		} */ 			
			 
	}
	}
		

	public function invoiceGeneratedHundredTrainer($b_id,$t_id,$c_id)
	{
		$role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		}  
			//echo "hundreedtrainer";die; 
		// echo $b_id;die;
		if($b_id){
		 
		$batch =FeesBatches::where('id',$b_id)->where('batch_visibility','1')->orderBy('id','desc')->first();		
//echo "<pre>";print_r($batch);die;		
		 if($batch->invoice_status=='0' ){		 
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();			
		//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','0')->where('pay_status','0')->get();
		 		 // echo "<pre>";print_r($checkinvoices);die;
		 				
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();				
				/* if($feestrainer->share_release=="50"){	 
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
				$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();				 
				if(count($checkinvoices)>0){					 
					 
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
				$feesInvoice->pay_status=0;
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
					$feesbatch->save(); 
					
				}else{
				$feesInvoice->delete();	
				}
				}
				
				} 					
					
				}else  */
					
				
				if($feestrainer->share_release=="100"  && $feestrainer->type="external"){
						
					if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					/* if($feestrainer->share_release=='50'){						
						$std_amount=0;					
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}else  */
						
					if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount;						
					}
					
				}else if(!empty($feesstudent) && ($feestrainer->payout_share=='fluctuating_share')){
					 
					$stdcount = count($feesstudent);
					/* if($feestrainer->share_release=='50'){
						
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
						
						
					 
					}else  */
						
					if($feestrainer->share_release=='100'){
						
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
					/* if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}else  */
						
					
					if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					}
					
				}
				
			 
				if($invoiceamount){
				//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();				
				 
				 
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
				$feesInvoice->pay_status=0;
				$feesInvoice->batch_id=$batch->id;			 
				$feesInvoice->generate_status=$status;
				$feesInvoice->batch_status=$status;
				$feesInvoice->lms_status=1;
				$feesInvoice->invoice_date=date('Y-m-d');
				$feesInvoice->technology=$courses;
				//echo "<pre>";print_r($feesInvoice);die;
				/*if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;	
					$feesbatch->status=2;							
					$feesbatch->save();						
				} 
				 */
				
				} 			
						
					} 
				
		 	 
		 
		}else if($batch->invoice_status=='1'){ 
	//	echo "status 1";die;
		$feestrainer  = FeesTrainer::where('id',$batch->batch_trainer)->first();
			//echo "<pre>";print_r($feestrainer);die;
		//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get();	 		
	//	echo "<pre>";print_r($checkinvoices);die;
		 			
				$feesstudent  = FeesStudents::where('stud_batch_id',$batch->id)->get();
				 
					if($feestrainer->share_release=='50' &&  $feestrainer->type=="external"){	 
				if(!empty($feesstudent) && ($feestrainer->payout_share=='fix_share')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){
						
					$std_amount=0;						
					foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;						
					}					
					$amount = ($std_amount*$feestrainer->fix_share)/100;					
					$invoiceamount =$amount/2;
					 
					}
					/* else if($feestrainer->share_release=='100'){
						$std_amount=0;
						foreach($feesstudent as $std){
						$std_amount +=$std->stud_decided_fees;
						
					}
					$amount = ($std_amount*$feestrainer->fix_share)/100;
					
					$invoiceamount =$amount;
						
					} */
					
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
						
						
					 
					}
					
					/* else if($feestrainer->share_release=='100'){
						
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
						
						
					} */
					
				} else if(!empty($feesstudent) && ($feestrainer->payout_share=='per_student')){
					 
					$stdcount = count($feesstudent);
					if($feestrainer->share_release=='50'){				 
					
					$amount = ($stdcount*$feestrainer->per_student);					
					$invoiceamount =$amount/2;
					 
					}
					
					/* else if($feestrainer->share_release=='100'){						
							$amount = ($stdcount*$feestrainer->per_student);					
							$invoiceamount =$amount;
						
					} */
					
				}
				
			 
				if($invoiceamount){
				//$checkinvoices = FeesInvoice::where('trainer_pay_id',$feestrainer->trainer_id)->where('lms_status','1')->where('pay_status','0')->get(); 
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
					$feesInvoice->pay_status=0;
					$feesInvoice->batch_id=$batch->id;			 
					$feesInvoice->generate_status=$status;
					$feesInvoice->batch_status=$status;				 
					$feesInvoice->lms_status=$status;				 
					$feesInvoice->invoice_date=date('Y-m-d');
					$feesInvoice->technology=$courses;
					//echo "<pre>";print_r($feesInvoice);die;
					/*if($feesInvoice->save()){
					$feesbatch= FeesBatches::findorFail($batch->id);
					$feesbatch->invoice_status=2;					
					$feesbatch->status=2;					
					$feesbatch->save(); 					
					}else{
					$feesInvoice->delete();					 
					} */
				 				
				} 
				
		 } 
		 

		} 			
			 
	}
	}
	
	
	 public function tempCourseContentdelete(Request $request,$bid,$cid){
		  $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
 
			$coursesHeading = CoursesHeading::where('course_id',$cid)->where('bat_id',$bid)->get();	
 		//echo "<pre>";print_r($coursesHeading);die;
			if(count($coursesHeading)>0){
				 
				foreach($coursesHeading as $heading){					 
						$coursesContent = CoursesContent::where('heading_id',$heading->id)->get();
						if(count($coursesContent)>0){
							foreach($coursesContent as $content){
								$coursesSubContent = CoursesSubContent::where('content_id',$content->id)->get();
								if(count($coursesSubContent)>0){
									foreach($coursesSubContent as $subcontent){										
										$coursesLastContent = CoursesLastContent::where('subcontent_id',$subcontent->id)->get();
										if(count($coursesLastContent)>0){
											foreach($coursesLastContent as $lastContent){
												$deleteLastContent = CoursesLastContent::where('id',$lastContent->id)->delete();
												$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
												$delcontent  =CoursesContent::where('id',$content->id)->delete();
												$delheading  =CoursesHeading::where('id',$heading->id)->delete();
												$status=1;
												$error=200;
												$msg="Course Content Successfully Deleted!";
											}
										}else{											
											$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
											$delcontent  =CoursesContent::where('id',$content->id)->delete();
											$delheading  =CoursesHeading::where('id',$heading->id)->delete();
											$status=1;
											$error=200;
											$msg="Course Content Successfully Deleted!";											
										}										
									}									
								}else{
									$delcontent  =CoursesContent::where('id',$content->id)->delete();
									$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
									$status=1;
									$error=200;
									$msg="Course Content Successfully Deleted!";
								}								
							}							
						}else{
							$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
							$status=1;
							$error=200;
							$msg="Course Content Successfully Deleted!";
						}							
				}
				
									 
			
			}else{	 		
				$error=404;
				$status=0;
				$msg="Not Record found!";				
			}
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	
	 

 public function deleteCourseContentBatch(Request $request,$bid,$cid){
		  $role = Session::get('role');	
		$mobile = Session::get('mobile');	
		if($mobile !="" && ($role != '') )
		{		}else{
		return redirect('/');
		} 
 
			$coursesHeading = CoursesHeading::where('course_id',$cid)->where('bat_id',$bid)->get();	
  
			if(count($coursesHeading)>0){
				 
				foreach($coursesHeading as $heading){					 
						$coursesContent = CoursesContent::where('heading_id',$heading->id)->get();
						if(count($coursesContent)>0){
							foreach($coursesContent as $content){
								$coursesSubContent = CoursesSubContent::where('content_id',$content->id)->get();
								if(count($coursesSubContent)>0){
									foreach($coursesSubContent as $subcontent){										
										$coursesLastContent = CoursesLastContent::where('subcontent_id',$subcontent->id)->get();
										if(count($coursesLastContent)>0){
											foreach($coursesLastContent as $lastContent){
												$deleteLastContent = CoursesLastContent::where('id',$lastContent->id)->delete();
												$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
												$delcontent  =CoursesContent::where('id',$content->id)->delete();
												$delheading  =CoursesHeading::where('id',$heading->id)->delete();
												$status=1;
												$error=200;
												$msg="Course Content Successfully Deleted!";
											}
										}else{											
											$delsubcontent  =CoursesSubContent::where('id',$subcontent->id)->delete();
											$delcontent  =CoursesContent::where('id',$content->id)->delete();
											$delheading  =CoursesHeading::where('id',$heading->id)->delete();
											$status=1;
											$error=200;
											$msg="Course Content Successfully Deleted!";											
										}										
									}									
								}else{
									$delcontent  =CoursesContent::where('id',$content->id)->delete();
									$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
									$status=1;
									$error=200;
									$msg="Course Content Successfully Deleted!";
								}								
							}							
						}else{
							$delheading  =CoursesHeading::where('id',$heading->id)->delete();	
							$status=1;
							$error=200;
							$msg="Course Content Successfully Deleted!";
						}							
				}
				
									 
			
			}else{	 		
				$error=404;
				$status=0;
				$msg="Not Record found!";				
			}
		 return response()->json(['status'=>$status,'msg'=>$msg],200);
	}
	


	
		
}
