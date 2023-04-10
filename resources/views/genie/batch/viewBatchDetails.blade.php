 @extends('genie.layouts.app')
 @section('title')
     Batches Details
@endsection
@section('content')	
        <div class="right_col" role="main">
        <div class="">
        <div class="page-title">
        <div class="title_left">
        <h4>Batch Details</h4>              </div>              
        </div>
        <div class="clearfix"></div><div class="row">   
        <style>
        .lms-accordian .panel ul {margin-bottom: 0px;line-height: 23px;}
        td span {line-height: 0px;}
        .paccordion input.heading .lms-accordian .paccordion:after{margin-top: 4px;}
        .course-scroll	.table td,.course-scroll .table th {padding: 4px 23px !important;}
        .course-scroll .lms-accordian .paccordion{padding: 4px 0px;}
        .course-scroll .table  tbody tr td .lms-accordian input.heading{margin-left: 20px;position: relative; top: 2px;margin-right: 10px;}
        .course-scroll .table  thead tr th{padding: 10px 23px !important;}
        .course-scroll	.table-bordered td, .table-bordered th {border: 1px solid #dee2e6 !important;}
        @media (min-width: 992px){
        #contentmodel .modal-lg {max-width: 950px !important;}
        }
        .course-scroll	.table thead th {border-bottom: 1px solid #dee2e6 !important;}
        .course-scroll{height:480px;overflow:scroll !important;}
        #data-table-student-attendance tbody tr{border: 1px solid #dee2e6 !important;text-align:center;}
        .student-border td,.student-border th {border: 1px solid #dee2e6 !important;}
        .table-bordered {border: 1px solid #dee2e6 !important;}
        .show-attendance-hover{cursor:pointer;}
        .att-btn{background: #13293e;border: 1px solid #13293e;color: #fff !important;}
        .att-btn:hover, .att-btn:focus,.att-btn:hover, .att-btn:focus,.att-btn:not(:disabled):not(.disabled):active{background: #13293e;border: 1px solid #13293e;}
        .student-status-heading{padding: 4px 20px;border-bottom: 1px solid rgb(229, 229, 229);font-size: 16px;line-height: 19px;color: rgb(0, 0, 0);}
        .check-box,.fa{margin-left:0px !important}
        #datatable-viewbatchdetails_wrapper{padding:0px 20px 4px 20px;}
        #datatable-viewbatchdetails thead th{padding-bottom: 13px !important;}
        .table thead th,.table-bordered td, .table-bordered th,.table-bordered {border:none;}
        #datatable-viewbatchdetails td, #datatable-viewbatchdetails th {padding: 7px 11px 7px 0px !important;}
        #data-table-student-attendance td,#data-table-student-attendance th{padding: 6px !important;}
        .table-striped tbody tr:nth-of-type(odd) {background-color: #fff !important;}
		#datatable-viewbatchdetails div.dataTables_length,div.dataTables_wrapper div.dataTables_filter label{float: left;display:none;}
		div.dataTables_wrapper div.dataTables_filter {text-align: right;float: right;}
        .batches-status .batches-status-heading p {width: 35%;margin: 0;text-align: left;padding: 12px 20px !important;}
		  div.dataTables_wrapper div.dataTables_length label{display:none;}
    .batches-status .batches-live-heading p {width: 100%;font-size: 16px;font-weight: 400;color: #000;opacity: .87;margin: 0;text-align: left;padding-bottom: 13px; }
    .batches-status .batches-status-heading .strong-heading1{width: 65%;}
    @media (max-width: 991px){
    .table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {top: 9px !important;}
    .BatchDetails_Listing {grid-template-columns: repeat(1,100%);}
    .course-scroll {height: 550px;overflow: scroll !important;}
    }
			</style>
        <style>.batches-status h2{width:100% !important;}
        .gvnMbb {align-items: center;background: #dddddd91;border-radius: 4px; display: flex;margin-top: 8px;padding-left: 12px;justify-content: space-between;
        margin-bottom: 20px;align-content: center;}
        .VfPpkd-Bz112c-LgbsSe {display: inline-block;position: relative;box-sizing: border-box;border: none;outline: none;background-color: transparent;fill: currentColor;color: inherit;text-decoration: none;cursor: pointer;-webkit-user-select: none;z-index: 0;overflow: visible;  }
        .close{font-size:32px;}
        .okqcNc {font-size: 15px;}
        .modal-body h6{font-size:15px;}
        .VfPpkd-Bz112c-LgbsSe{margin:0px;padding:0px;}
        .fa-clone{font-size:20px;}
        .VfPpkd-Bz112c-LgbsSe {margin: 0px;border-radius: 50%;width: 36px;height: 36px;line-height: 41px;background-color: #ffe4c414;text-align: center;}
        .gvnMbb{margin-bottom:0px;padding: 0 0px 0px 8px;}
        .VfPpkd-Bz112c-LgbsSe:hover{background-color:#ccc;}
        .modal-header{padding:7px 15px;}
        #success .modal-dialog .modal-content .modal-body h6{margin-bottom:0px;}
        #success .modal-dialog .modal-content .modal-body {padding: 8px;background-color: #323232;color: #fff;
        box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
        -webkit-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
        -moz-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
        }
        .join{display:none;}
        .x_title {border-bottom: 0px;}
        </style>
        <div class="col-md-12 col-sm-12 padding-none"><div class="x_content"><div class="col-md-8 col-sm-6"><div class="batches"><div class="batches-sections">
        <div class="batches-status"><div class="batches-status-heading"><h2><?php echo $batches->batch_name; ?></h2></div>  
        <div class="BatchDetails_Listing"><div class="BatchDetails_item"><i class="fa fa-calendar" aria-hidden="true"></i><div class="BatchDetails_item--content">
        <p class="strong-heading">Batch Start Date</p><p class="strong-heading1"><span title="Batch Start Date <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> "><?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ( <?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?>)</span></p>
        </div></div>  
        <div class="BatchDetails_item"><i class="fa fa-list-ol" aria-hidden="true"></i><div class="BatchDetails_item--content"><p class="strong-heading">Student Count</p><p class="strong-heading1"><span title="Student Count"><?php 
        $studentcount= App\FeesStudents::where('stud_batch_id',$batches->batch_id)->count();
        if(!empty($studentcount)){
        echo $studentcount.' Student';
        } 
        ?> </span></p>
        </div></div>
        <div class="BatchDetails_item"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><div class="BatchDetails_item--content">
        <p class="strong-heading">Last Attendance</p><p class="strong-heading1"><?php echo (isset($batches->attenddatebatch)?date('d-M-y',strtotime($batches->attenddatebatch)):""); ?></p>
        </div></div>
        <div class="BatchDetails_item"><i class="fa fa-book"></i><div class="BatchDetails_item--content">
        <p class="strong-heading">Course</p><p class="strong-heading1"><span title="Course : <?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?>" ><?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?> </span></p>
        </div></div>
        <?php 
                $heading = DB::table('courses_heading as heading');				 
                $heading= $heading->where('course_id',$batches->batch_course);
                $heading= $heading->where('bat_id',$batches->id);
                $heading= $heading->get();
                if(count($heading)>0){
                $heading =$heading;
                }else{
                $heading = DB::table('courses_heading as heading');				 
                $heading= $heading->where('course_id',$batches->batch_course);	 
                $heading= $heading->get();
                } 
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
					$headingcomplete += DB::table('courses_complete')->where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = DB::table('courses_content')->where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					    
					foreach($contents as $content){
					$contentcomplete += DB::table('courses_complete')->where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = DB::table('courses_subcontent')->where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){	
					  
					foreach($subcontents as $sub){
				
					$subcontentcomplete += DB::table('courses_complete')->where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = DB::table('courses_lastcontent')->where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += DB::table('courses_complete')->where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
				    $totalcousedh=$headingtotal+ $contentstotal +$subcontentstotal;
			    	$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete;		
			 
					if(!empty($completetotaldh)){
			    	$totalpercent = $completetotaldh/$totalcousedh;
					}else{
					$totalpercent=0;
						}


 					?>
					  <div class="BatchDetails_item">
					      <i class="fa fa-bullseye" aria-hidden="true"></i>

					      <div class="BatchDetails_item--content">
                        <p class="strong-heading">Course Status</p>
                          <p class="strong-heading1"><?php if(!empty($totalpercent)) { echo round(($totalpercent*100),2).'%'; }else{ echo "0 %"; } ?>  Complete</p>
                      </div> 
                      </div>
                      
                      <div class="BatchDetails_item">
                          <i class="fa fa-rss" aria-hidden="true"></i>

                          <div class="BatchDetails_item--content">
                        <p class="strong-heading">Batch Feedback</p>
							<p class="strong-heading1"><?php  if($batches->batch_feedback==1){
							$feed= '<i class="fa fa-check" aria-hidden="true" style="font-size: 25px;color:green;"></i>';
							}else{
							$feed= '<i class="fa fa-times" aria-hidden="true" style="font-size: 25px;color:red;"></i>';
							} 
							echo $feed;		
							?> </p>
                      </div>   
					  </div>
                         <div class="BatchDetails_item">
                             <i class="fa fa-star" aria-hidden="true" style="color:#73879C"></i>
                             <div class="BatchDetails_item--content">
                        <p class="strong-heading">Rating</p>
							<p class="strong-heading1">
                            
                            
                            <?php
                            $sturating = App\FeesStudents::where('stud_batch_id',$batches->batch_id)->get(); 
                            $totalrating=0;
                            if(!empty($sturating)){
                            foreach($sturating as $rating){
                            
                            $totalrating +=$rating->rating;
                            }
                            }else{
                            
                            $totalsumrating=0;
                            }
                            if(!empty($studentcount)){
                            $totalsumrating =	round($totalrating/$studentcount);
                            }else{
                            $totalsumrating =0;
                            
                            }
                            ?>
                            <style>
                            .fa-star{
                            color:#FFC300;
                            }.fa-star-half{
                            color:#FFC300;
                            }
                            </style>
                            <?php 
                            $rating=$totalsumrating;
                            switch($rating){
                            case 0:
                            $stars = '<i class="fa fa-star-half"></i>';
                            break;
                            case 1:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>';
                            break;
                            case 2:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>';
                            break;
                            case 3:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>';
                            break;
                            case 4:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>';
                            break;
                            case 4.5:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>';
                            break;
                            case 5:
                            $stars = '<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>';
                            break;
                            
                            } ?>
                            
                            <?php echo $stars; ?>
                            
                            <span><?php echo $rating;  ?> out of <?php echo $studentcount; ?> based   </span>

							</p>
                      </div>   
                      </div>
                        <div class="BatchDetails_item"><i class="fa fa-user" aria-hidden="true"></i>
                        <div class="BatchDetails_item--content show-attendance-hover" data-toggle="modal" data-target="#studetns_attendance">
                        <p class="strong-heading">Show Attendance</p>
                        <p class="strong-heading1"><a href="#0" title="" ><i class="fa fa-hand-paper-o" style="    color: green;
                        " aria-hidden="true"></i>
                        </a></p></div>
                        <div id="studetns_attendance" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Batch Attendance</h5> <button type="button" class="close"  data-dismiss="modal"> &times;</button>
							</div><div class="modal-body"><div class="panel-body"><div class="x_content"><div class="row">
							<div class="col-sm-12"><div class="table-responsive">
							<table  id="data-table-student-attendance" border="1" class="table table-striped table-bordered student-border" cellspacing="0" width="100%">
						
						<?php  
						$batchattendance = App\FeesBatchsAttendance::where('batch_id',$batches->batch_id)->get();	
						if(!empty($batchattendance)){
						    $k=0;
						foreach($batchattendance as $attendances){
						    $k++;
						   ?>
						<tr>
						    	<td><?php echo $k; ?></td>
						<td>Attendance</td>
						<td><?php  echo date('d-M-Y',strtotime($attendances->attendate));  ?></td>
						  </tr>
						<?php } } ?>
					 </table></div></div></div> </div></div></div></div></div></div></div></div>
                    </div></div></div></div> 
					  <div class="col-md-4 col-sm-6"><div class="batches"><div class="batches-sections live-batch"><div class="batches-status">
                    <div class="batches-live-heading live-batch-heading"><p class="strong-heading">Take Live Class</p></div>   
                    <div class="batches-live-heading live-batch-details"><p class="strong-heading details_live">Now you  can go live  for your students & Batch  them  any time anywhere!</p>
                    </div><div class="batches-live-heading live-batch-footer"><button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop" ><img src="{{asset('genie/build/images/live-batch-img.png')}}" />Go Live Now </button>
                    </div></div> </div></div>
                            
                    <div class="batches"><div class="batches-sections live-batch"><div class="batches-status">
                    <div class="batches-live-heading live-batch-heading"><p class="strong-heading">Course Curriculum <span class="new-icon1"></span></p></div>   
                    <div class="batches-live-heading live-batch-details"><p class="strong-heading details_live">Now you  can go live  for your students & Batch  them  any time anywhere!</p>
                    </div><div class="batches-live-heading live-batch-footer"><a class="btn btn-live" href="{{url('batch/course-contents')}}/<?php echo base64_encode($batches->id); ?>/<?php echo base64_encode($batches->batchcourse_id); ?>/<?php echo base64_encode($batches->trainer_id); ?>" title="Course Content" ><i class="fa fa-check-square-o" style="margin-right:5px; color:red; font-size:20px;" aria-hidden="true"></i>Mark Curriculum</a>
                    </div></div></div></div></div></div>
                  <div class="x_content"><div class="row"><div class="col-sm-12 padding-none2"><div class="card-box table-responsive batches"><div class="student-status-heading">
                <h2>Students (<?php echo $studentcount; ?>) </h2></div>
				<table id="datatable-viewbatchdetails" class="table table-striped dt-responsive nowrap my-table" cellspacing="0" width="100%">
                <thead><tr><th>Name</th>
						  <th>Attendance</th>
                          <th>Count</th>
                          <th>Today’s Attendance</th>
                          <th>Course</th>
						<!--  <th>Rating</th>-->
                          <th title="First Feedback">1st FB</th>
                          <th title="Second Feedback">2nd FB</th>
                          <th title="Third Feedback">3rd FB</th>
                        </tr>
                      </thead></table></div>
						<form role="form" method="POST" action="" id="submitattendance">
						<input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch_id;?>">						 
						<input type="hidden" name="first_feedd" id="first_feedd" value="1">						 
						</form>
                        <div class="row">
                        <div class="item form-group">
                        <label class="col-form-label label-align">
                        </label>
                        <div class="col-md-12 col-sm-12 ">
                        <button type="button" class="bnt btn-success form-control mb-0 att-btn" onclick="javascript:batchController.studentsAttendance()">Submit Attendance </button>
                        </div>
                        </div>
                        </div>
                </div>		
                </div>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div id="joinfromlaptop" class="modal fade" role="dialog">						
        <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Live Class Notification</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding-top:10px;padding-bottom: 12px;text-align: center; ">
             <?php  
		$contentcomplete = DB::table('courses_complete')->where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batchcourse_id)->get();
	 
		$checkdate=0;	
		if(!empty($contentcomplete)){
			foreach($contentcomplete as $complete){
		if(date('d-m-Y',strtotime($complete->heading_date))==date('d-m-Y') || date('d-m-Y',strtotime($complete->content_date))==date('d-m-Y') || date('d-m-Y',strtotime($complete->subcontent_date))==date('d-m-Y')){
			
			$checkdate=1;
			}
		} 
		}
		 if(!empty($checkdate)){
		?>
        <h6>Dear Trainer click on Join Button to take Live Class.</h6>
        <div class="join-classes text-center">	
        <a href="https://<?php if(!empty($traierdet->meetingurl)){ echo $traierdet->meetingurl; }else{ echo $batches->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
        
        <?php }else{ 
            
                  $heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$c_id);					 
					$heading= $heading->get();  
                    if(count($heading)>0){
                    $heading =$heading;
                    }else{
                    $heading = DB::table('courses_heading as heading');				 
                    $heading= $heading->where('course_id',$batches->batch_course);	 
                    $heading= $heading->get();
                    } 

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
					$headingcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = DB::table('courses_content')->where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
					  
					}}
					}
					}
										 
					$totalcousedh=$headingtotal+ $contentstotal +$subcontentstotal;
				    $completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete;	
					
					if(!empty($completetotaldh)){
					$finalcomple= $totalcousedh/$completetotaldh;
					}else{
					$finalcomple=0;
					}
					if($finalcomple<=1){
					
                ?>
                <a href="https://<?php if(!empty($traierdet->meetingurl)){ echo $traierdet->meetingurl; }else{ echo $batches->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
                
                <?php }else{ ?>
                <h6 style="color:red">Please mark the Curriculum topics for today's Session before going to take Live Class.</h6> 
                <?php }  } ?>
        
        </div></div></div></div>
        </div>
        <div id="joinfromlaptopS" class="modal fade" role="dialog">						
        <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Live Class Laptop:</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding-top:10px;    padding-bottom: 12px;">
        <h6>Are You join the Class. It is required to take the live class.</h6>
        <div class="join-classes text-center">		<a href="https://liveclass.cromacampus.com/login" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
        </div>
        </div>
        </div>
        </div>
        </div>
    
        
		<div id="joinfromandroid" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Live Class Android:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Are You join the Class. It is required to take the live class.</h6>

		<div class="join-classes text-center">		<a href="https://edumartin.page.link/JLFy" class="btn btn-success mb-0 mt-2 mr-0 " onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
</div>

		</div>
		</div>
		</div>
		</div>
				<div id="joinfromiphone" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Love Class iPhone:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Are You join the Class. It is required to take the live class.</h6>

	<div class="join-classes text-center">	

<a href="https://apps.apple.com/in/app/classplus/id1324522260" class="btn btn-success mb-0 mt-2 mr-0" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>


</div>
		</div>
		</div>
		</div>
		</div>
		
		
		<div id="success" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 200px !important;margin: 15.75rem auto;">
		<div class="modal-content">					 
		<div class="modal-body">
		<h6>Organization Code Copied</h6>				 
		</div>
		</div>
		</div>
		</div>	
        <script>
      
        
        $(document).ready(function() {
        $('#data-table-student-attendance').dataTable({
        "paging":true,
        "ordering":false});
        });
        </script>
    
     @endsection