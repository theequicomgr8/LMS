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
			 <div class="clearfix"></div>
		  <div class="row">   
              
			<style>
			
			.dataTables_length,div.dataTables_wrapper div.dataTables_filter label{
			float: left;
			display:none;
			}
			div.dataTables_wrapper div.dataTables_filter {
			text-align: right;
			float: right;
			}
			.batches-status .batches-status-heading p {
			width: 35%;
			margin: 0;
			text-align: left;
			padding: 12px 20px !important;
			}
			
		.batches-status .batches-live-heading p {
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    color: #000;
    opacity: .87;
    margin: 0;
    text-align: left;
    padding-bottom: 13px;

}
			.batches-status .batches-status-heading .strong-heading1
			{
			width: 65%;
			}
			@media (max-width: 991px){
.table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
    top: 9px !important;
}
}
			</style>
			<style>

			.gvnMbb {
			align-items: center;
			background: #dddddd91;
			border-radius: 4px;
			display: flex;
			margin-top: 8px;
			padding-left: 12px;

			justify-content: space-between;
			margin-bottom: 20px;
			align-content: center;
			}
			.VfPpkd-Bz112c-LgbsSe {
			display: inline-block;
			position: relative;
			box-sizing: border-box;
			border: none;
			outline: none;
			background-color: transparent;
			fill: currentColor;
			color: inherit;
			text-decoration: none;
			cursor: pointer;
			-webkit-user-select: none;
			z-index: 0;
			overflow: visible;
			}
			.close{
			font-size:32px;
			}

			.okqcNc {
			font-size: 15px;
			}
			.modal-body h6{
			font-size:15px;
			}
			.VfPpkd-Bz112c-LgbsSe
			{
			margin:0px;
			padding:0px;
			}
			.fa-clone
			{
			font-size:20px;

			}
			.VfPpkd-Bz112c-LgbsSe {
			margin: 0px;
			border-radius: 50%;
			width: 36px;
			height: 36px;
			line-height: 41px;
			/* padding: 20px; */
			background-color: #ffe4c414;
			text-align: center;
			}
			.gvnMbb
			{
			margin-bottom:0px;
			padding: 0 0px 0px 8px;

			}
			.VfPpkd-Bz112c-LgbsSe:hover
			{
			background-color:#ccc;


			}
			.modal-header
			{
			padding:7px 15px;
			}
			#success .modal-dialog .modal-content .modal-body h6
			{
			margin-bottom:0px;
			}
			#success .modal-dialog .modal-content .modal-body {
			padding: 8px;
			background-color: #323232;
			color: #fff;
			box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
			-webkit-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
			-moz-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
			}
			
.join{
    
    display:none;
}
.x_title {
    border-bottom: 0px;
    
}


			</style>
              <div class="col-md-12 col-sm-12 padding-none">
                          <div class="x_content">
                      <div class="col-md-8 col-sm-6">
					     <div class="batches">
              <?php //echo "<pre>";print_r($batches); ?>
                  <div class="batches-sections">
                    <div class="batches-status">
                  
    <div class="batches-status-heading">
                            <h2><?php echo $batches->batch_name; ?></h2>
                       
                      </div>  
                          <div class="BatchDetails_Listing">
                        <div class="BatchDetails_item">
<i class="fa fa-calendar" aria-hidden="true"></i>
                        <div class="BatchDetails_item--content">
                        <p class="strong-heading">Batch Start Date</p>
                        <p class="strong-heading1"><span title="Batch Start Date <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> "><?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ( <?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?>)</span></p>
                        </div>
                      </div>  

					  <div class="BatchDetails_item">
					  <i class="fa fa-calendar-check-o" aria-hidden="true"></i>

					      <div class="BatchDetails_item--content">
                        <p class="strong-heading">Last Attendance</p>
                        <p class="strong-heading1"><?php echo (isset($batches->attenddatebatch)?date('d-M-y',strtotime($batches->attenddatebatch)):""); ?></p>
                      </div>  
                      </div>
            <div class="BatchDetails_item">
<i class="fa fa-book"></i>
                          <div class="BatchDetails_item--content">
                        <p class="strong-heading">Course</p>
                        <p class="strong-heading1"><span title="Course : <?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?>" ><?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?> </span></p>
                      </div> 
                      </div>
                      <?php 

 


					 $heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$batches->batch_course);					 
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
					$headingcomplete += App\CoursesComplete::where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = App\CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += App\CoursesComplete::where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += App\CoursesComplete::where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += App\CoursesComplete::where('batch_id',$batches->batch_id)->where('trainer_id',$batches->trainer_id)->where('course_id',$batches->batch_course)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					 
					}} 
					}}
					}}
										 
					$totalcousedh= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaldh= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;	
					
					 
					if(!empty($completetotaldh)){
			    	$totalpercent = $completetotaldh/$totalcousedh;
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
<i class="fa fa-file" aria-hidden="true"></i>

<div class="BatchDetails_item--content">
                        <p class="strong-heading">Course Content</p>
                        <p class="strong-heading1"><a href="javascript:batchController.getCourseContentDetails('<?php echo $batches->id; ?>','<?php echo $batches->batchcourse_id; ?>','<?php echo $batches->trainer_id; ?>')" title="Course Content" ><button class="btn btn-success">Course Content</button></a> &nbsp; <?php 
						 $role = Session::get('role');	
						if($role=="Admin" || $role=="Manager"){
						$coursesHeading = App\CoursesHeading::where('course_id',$batches->batchcourse_id)->where('bat_id',$batches->id)->get();
						 	
						if(count($coursesHeading)>0){
						$action ='<a href="javascript:courseController.tempCourseContentdelete('.$batches->id.','.$batches->batchcourse_id.')" title="Delete Temp Course Content"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size: 25px;"></i></a>';
						}else{					 	 
						$action = '<a href="javascript:courseController.getCourseContentBatchForm('.$batches->id.','.$batches->batchcourse_id.')" title="Add Course Content" class="btn-info"> Add</a>'.'  ';
						}
						}else{
						$action ="";
						} 
						echo $action;
						?> </p>
                      </div> 
                      </div>
                      <div class="BatchDetails_item">
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
                             <div class="BatchDetails_item--content">
                        <p class="strong-heading">Rating</p>
							<p class="strong-heading1"><?php  if($batches->batch_feedback==1){
					    	$rating= '<i class="fa fa-check" aria-hidden="true" style="font-size: 25px;color:green;"></i>';
							}else{
							$rating= '<i class="fa fa-times" aria-hidden="true" style="font-size: 25px;color:red;"></i>';
							} 
							echo $rating;		
							?> </p>
                      </div>   
                      </div>
                        
					 
                      </div>
                    </div>
                  </div>
                </div>
			</div> 


					  <div class="col-md-4 col-sm-6">
            					     <div class="batches">
                              
                              <div class="batches-sections live-batch">
                                <div class="batches-status">
                                     
                                 
                                  <div class="batches-live-heading live-batch-heading">
                                    <p class="strong-heading">Live Class <span class="new-icon">New </span></p>
                                   
                                     
                                  </div>   
                                   
            					  <div class="batches-live-heading live-batch-details">
                                    <p class="strong-heading">Now you  can go live  for your students & Batch  them  any time anywhere!</p>
                                     
                                     
                                  </div> 
                                   <div class="batches-live-heading live-batch-footer">
                                 <button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop" ><img src="{{asset('genie/build/images/live-batch-img.png')}}" />Go Live Now </button>
                                  
                                  </div> 
                                     
            					  
                                       
                                    
            					 
                                  
                                </div>
                              </div>
                            </div>
					  
					  </div>
					  
					  
					  </div>
					  <!--<div class="row">-->
					  <!--    <div class="col-lg-12 padding-none2">-->
					  <!--    	<div class="batches">-->
       <!--            <div class="batches-sections">-->
       <!--             <div class="batches-status student_batch-heading">-->
                  
       <!--              <div class="batches-status-heading">-->
       <!--                     <h2>Students (9) </h2>-->
                       
       <!--               </div>  -->
       <!--                 <div class="student_batch_listing">-->
       <!--                     <div class="student_list-item">-->
       <!--                     <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Name</p>-->
       <!--                     </div>-->
       <!--                   </div>  -->
       <!--                   <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Count</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                   <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Today’s Attendance</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                       <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Course</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                     <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">First Feedback</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                     <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Second Feedback	</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                      <div class="student_list-item">-->
       <!--                       <div class="BatchDetails_item--content">-->
       <!--                     <p class="strong-heading1">Third Feedback</p>-->
       <!--                   </div> -->
       <!--                   </div>-->
       <!--                 </div>-->
       <!--                 <div class="student-list-row">-->
       <!--                     <ul>-->
       <!--                         <li>Brijsh TEST </li>-->
       <!--                         <li>9</li>-->
       <!--                         <li>15/11/2021</li>-->
       <!--                         <li>Android</li>-->
       <!--                         <li>A</li>-->
       <!--                         <li>B</li>-->
       <!--                         <li>B</li>-->

       <!--                     </ul>-->
                            
       <!--                 </div>-->
       <!--             </div>-->
       <!--           </div>-->
       <!--           </div>-->
                  
       <!--         </div>-->
					      
					  <!--</div>-->
                 
                  <div class="x_content batches">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-viewbatchdetails" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                           
                         
                          <th>Name</th>
						  <th>Attendance</th>
                          <th>Count</th>
                          <th>Today’s Attendance</th>
                          <th>Course</th>
						<!--  <th>Rating</th>-->
                          <th>First Feedback</th>
                          <th>Second Feedback</th>
                          <th>Third Feedback</th>
                          
                         
                        
                        </tr>
                      </thead>
					              
					  </table>
					
					
                  </div>
						<form role="form" method="POST" action="" id="submitattendance">
						<input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch_id;?>">						 
						<input type="hidden" name="first_feedd" id="first_feedd" value="1">						 
						</form>
					
						
							<div class="row">
								<div class="item form-group">
								<label class="col-form-label label-align" style="margin-left: 16px;">
								</label>
								<div class="col-md-12 col-sm-12 ">
								<button type="button" class="bnt btn-success form-control" onclick="javascript:batchController.studentsAttendance()">Submit Attendance </button>
								</div>
								</div>
							<?php

								if($batches->invoice_status =='0' || $batches->invoice_status =='1'){ ?>
								<!--<div class="item form-group">
								<label class="col-form-label label-align" style="margin-left: 16px;">
								</label>
								<div class="col-md-12 col-sm-12 ">							 
							<button type="button" class="bnt btn-success form-control" onclick="javascript:batchController.invoiceGenerated(<?php echo $batch_id; ?>)"  data-sid="<?php echo $batch_id; ?>" >Invoice </button> <?php if($batches->invoice_status=='1'){ echo " 50% Pay amount invoice generated"; }?>
								</div>
								</div>-->
								<?php } ?>
								
										<?php if($batches->attendancebatch>=3){?>
								<!--<div class="item form-group">
								<label class="col-form-label col-md-8 col-sm-8 label-align" for="first-name">Course Status
								</label>
								<div class="col-md-12 col-sm-12 ">
								<select class="form-control" name="completecourse" id="completecourse">
								<option value="">Select</option>					 
								<option value="50">50%</option>					 
								<option value="100">100%</option>					 
								</select>
								</div>
								</div>-->
										<?php } ?>		 
							 
						
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
        <h5 class="modal-title">Live Class Laptop:</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
        <h6>Are You join the Class. It is required to take the live class.</h6>
       <!-- <div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>-->
        <div class="join-classes text-center">		<a href="https://<?php if(!empty($batches->meetingurl)){ echo $batches->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div id="joinfromlaptopS" class="modal fade" role="dialog">						
        <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Live Class Laptop:</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
        <h6>Are You join the Class. It is required to take the live class.</h6>
       <!-- <div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>-->
        <div class="join-classes text-center">		<a href="https://liveclass.cromacampus.com/login" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        
        <!--<div id="joinfromlaptop" class="modal fade" role="dialog">						
        <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
        <h6>Please copy the organization code. It is required to take the live class.</h6>
        
        <div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
        <div class="join-classes text-center">		<a href="https://liveclass.cromacampus.com/login" class="btn btn-success mb-0 mt-2 mr-0 join" style="display:none" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
        </div>
        </div>
        </div>
        </div>
        </div>-->
        
		<div id="joinfromandroid" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Live Class Android:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Are You join the Class. It is required to take the live class.</h6>

		<!--<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextandroid" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextandroid')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>-->
		<div class="join-classes text-center">		<a href="https://edumartin.page.link/JLFy" class="btn btn-success mb-0 mt-2 mr-0 " onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
</div>

		</div>
		</div>
		</div>
		</div>
		
			<!--<div id="joinfromandroid" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Please copy the organization code. It is required to take the live class.</h6>

		<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextandroid" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextandroid')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
		<div class="join-classes text-center">		<a href="https://edumartin.page.link/JLFy" class="btn btn-success mb-0 mt-2 mr-0 join" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
</div>

		</div>
		</div>
		</div>
		</div>-->
		
		<div id="joinfromiphone" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Love Class iPhone:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Are You join the Class. It is required to take the live class.</h6>

		<!--<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextiphone" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextiphone')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>-->
<div class="join-classes text-center">		<a href="https://apps.apple.com/in/app/classplus/id1324522260" class="btn btn-success mb-0 mt-2 mr-0" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
</div>
		</div>
		</div>
		</div>
		</div>
		
			<!--<div id="joinfromiphone" class="modal fade" role="dialog">						
		<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
		<h6>Please copy the organization code. It is required to take the live class.</h6>

		<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextiphone" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextiphone')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
<div class="join-classes text-center">		<a href="https://apps.apple.com/in/app/classplus/id1324522260" class="btn btn-success mb-0 mt-2 mr-0 join" onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
</div>
		</div>
		</div>
		</div>
		</div>-->
		
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
        	$('.join').hide();
        function copyToClipboard(element) {
        
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
          $('.join').show().css('display', 'inline-block');
        $("#success").modal();
        setTimeout(function(){
        
        $('#success').modal("hide");
            
        }, 3000);
        
     /*   setTimeout(function(){
        $('.join').hide();
		}, 9000);

        */
        }
        </script>
    
     @endsection