@extends('genie.layouts.app')
@section('title')
   Course Content
@endsection
@section('content')	
           <div class="right_col" role="main">
          <div class="">
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

			</style>
            <div class="clearfix"></div>
 
            <div class="row">
              <div class="col-md-9">
			  @if(!empty($students))
				  @foreach($students as $student)
                <div class="batches">
                  <div class="batches-heading">
                    <h4><?php  if($student->batch_name){ echo $student->batch_name; } ?></h4>
                  </div>
                  <div class="batches-sections">
                    <div class="batches-status">
                         <div class="batches-status-heading">
                        <p class="strong-heading">Student Name</p>
                        <span>:</span>
                        <p><?php  if($student->name){ echo $student->name; } ?></p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p><?php  if($student->course){ echo $student->course; } ?></p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Trainer Name</p>
                        <span>:</span>
                        <p><?php  if($student->trainer_name){ echo $student->trainer_name; } ?></p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Start Date</p>
                        <span>:</span>
                        <p><?php  if($student->firstdate_attendance){ echo date('d-M-Y',strtotime($student->firstdate_attendance)); } ?> </p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Slot</p>
                        <span>:</span>
                        <p><?php  if($student->occurrence){ echo $student->occurrence; } ?></p>
                      </div> 
                      <div class="batches-status-heading">
                        <p class="strong-heading">Batch Timing</p>
                        <span>:</span>
                        <p><?php  if($student->batch_starts_on){ echo $student->batch_starts_on.' - '.$student->batch_end_on; } ?></p>
                      </div>   
                      <div class="batches-status-heading">
                        <p class="strong-heading">Duration</p>
                        <span>:</span>
                        <p>03 Months</p>
                      </div>
					  <div class="batches-status-heading">
                        <p class="strong-heading">Taken Class</p>
                        <span>:</span>
                        <p>Total : <?php  if($student->attendancecount){ echo $student->attendancecount; } ?></p>
                      </div>  

					  <div class="batches-status-heading">
                        <p class="strong-heading">Last Attence Date</p>
                        <span>:</span>
                        <p><?php  if($student->attenddate){ echo date('d, M Y',strtotime($student->attenddate)); } ?></p>
                      </div>  
                      <!-- <div class="batches-status-heading">
                        <p class="strong-heading">Google meeting URl</p>
                        <span>:</span> 
						<p><a href="#" data-toggle="modal" data-target="#joinfromlaptop_<?php echo $student->std_id; ?>"> <img src="{{asset('logo/google-meet.png')}}" width="50"></a> </p>		 
						<div id="joinfromlaptop_<?php echo $student->std_id; ?>" class="modal fade" role="dialog">						
						<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">Live Class :</h5><div class="succesmessage"></div><div class="errormessage"></div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body" style="padding-top:10px;padding-bottom: 20px;">
						<h6>Are You join the Class. It is required to take the live class.</h6>

				<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
						<div class="join-classes text-center">
						<a href="https://<?php if(!empty($student->meetingurl)){ echo $student->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Yes</a>
                            </div>
						</div>
						</div>
						</div>
						</div>
					 
                    </div>  -->
                      
					  <!-- <div class="batches-status-heading">
                        <p class="strong-heading">Join form Laptop</p>
                        <span>:</span> 
						<p><a href="#" data-toggle="modal" data-target="#joinfromlaptop_<?php echo $student->std_id; ?>"> <i class="fa fa-laptop" aria-hidden="true" style="font-size: 25px;color:#22CFF7;"></i></a> </p>		 
						<div id="joinfromlaptop_<?php echo $student->std_id; ?>" class="modal fade" role="dialog">						
						<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
						<h6>Please copy the organization code. It is required to take the live class.</h6>

						<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
						<a href="https://liveclass.cromacampus.com/login" class="btn btn-success" onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Join</a>

						</div>
						</div>
						</div>
						</div>
					 
					
					 
                    </div>  
					
					
					<div class="batches-status-heading">
                        <p class="strong-heading">Join from Android</p>
                        <span>:</span>
						<p class="strong-heading1"><a href="#" data-toggle="modal" data-target="#joinfromandroid_<?php echo $student->std_id; ?>"><i class="fa fa-android" aria-hidden="true" style="font-size: 25px;color:#85C808;"></i></a> </p>
                         <div id="joinfromandroid_<?php echo $student->std_id; ?>" class="modal fade" role="dialog">						
						<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
						<h6>Please copy the organization code. It is required to take the live class.</h6>

						<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextandroid" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextandroid')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
						<a href="https://apps.apple.com/in/app/classplus/id1324522260" class="btn btn-success" onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Join</a>

						</div>
						</div>
						</div>
						</div>
                        
                      </div> 
					<div class="batches-status-heading">
                        <p class="strong-heading">Join from Iphone</p>
                        <span>:</span>
						<p class="strong-heading1"><a href="#" data-toggle="modal" data-target="#joinfromiphone_<?php echo $student->std_id; ?>"><i class="fa fa-apple" aria-hidden="true" style="font-size: 25px;"></i></a> </p>
						
						<div id="joinfromiphone_<?php echo $student->std_id; ?>" class="modal fade" role="dialog">						
						<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">Organization  Code:</h5><div class="succesmessage"></div><div class="errormessage"></div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body" style="padding-top:10px;    padding-bottom: 20px;">
						<h6>Please copy the organization code. It is required to take the live class.</h6>

						<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettextiphone" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettextiphone')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>
						<a href="https://edumartin.page.link/JLFy" class="btn btn-success" onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Join</a>

						</div>
						</div>
						</div>
						</div>
						
						
                        
                      </div> -->
				
					
                      
					  
					  
					  
					   
						<div class="batches">

						<div class="batches-sections live-batch">
						<div class="batches-status">


						<div class="batches-live-heading live-batch-heading">
						<p class="strong-heading">Live Class <span class="new-icon">New </span></p>


						</div>   

						<div class="batches-live-heading live-batch-details">
						<p class="strong-heading">Now you  can go live  for your students &amp; Batch  them  any time anywhere!</p>


						</div> 
						<div class="batches-live-heading live-batch-footer">
						<button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop"><img src="https://learnpitch.com/genie/build/images/live-batch-img.png">Go Live Now </button>

						</div>  
						</div>
						</div>
						</div>
					  
					 
					  
					  <div id="joinfromlaptop" class="modal fade" role="dialog">						
						<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">Live Class :</h5><div class="succesmessage"></div><div class="errormessage"></div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body" style="padding-top:10px;padding-bottom: 20px;">
						<h6>Are You join the Class. It is required to take the live class.</h6>

					<!--<div class="gvnMbb"><div class="okqcNc" jsname="DkF5Cf">Organization Code: <strong class="gettext" title="Copy Code">wxnnj</strong></div><button class="VfPpkd-Bz112c-LgbsSe" onclick="copyToClipboard('.gettext')"><i class="fa fa-clone" aria-hidden="true"></i></button></div>-->
						<div class="join-classes text-center">
						<a href="https://<?php if(!empty($student->meetingurl)){ echo $student->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Yes</a>
                            </div>
						</div>
						</div>
						</div>
						</div>
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
                    </div>
                  </div>
                </div>
				
				@endforeach
				@endif
                 
              </div>
                  <div class="col-md-3">
                    <div class="query">
                      <div class="query-heading">
                        <h4>Adviser is just a call away</h4>
                        
                      </div>
                      
                      <div class="form-selection1">
                        <p><i class="fa fa-phone mr-2" aria-hidden="true"></i> +91 99999 99999, <span class="ml-1"> 0120-4455-455</span></p>

                      </div>
                      <div class="form-selection">
                        <h5>Drop us a Query</h5>                     
                        
                        <div class="form-trainer-management" id="A">
                          <form class="form-horizontal" autocomplete="off" onsubmit="return studentsController.querySave(this)">
							<div class="radio radio-selection">
							<label>
							<input type="radio" name="type"  value="To Your Trainer" checked> To Trainer
							</label>
							<label>
							<input type="radio" name="type" value="To Management"> To Management
							</label>
							</div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="name" value="<?php echo $students[0]->name; ?>" placeholder="Mobile No*" >                               
							  <input type="tel" name="mobile" class="form-control" maxlength="16" onkeypress="return isNumberKey(event);" placeholder="Enter Phone no ">
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" placeholder="E-mail Address*" >
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" name="message" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
							<input type="reset" class="resetform">
                              <button type="submit" class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                        <div class="form-trainer-management" id="B" style="display: none;">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Phone No.*" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" placeholder="E-mail Address*" required>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" placeholder="Type your query here" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary form-submit">SUBMIT YOUR QUERY</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="refer-earn">
                      <div class="refer-earn-heading">
                        <img src="{{asset('genie/build/images/referandearn.png')}}">
                        <h4>Refer and Earn</h4>
                      </div>
                      <div class="refer-earn-data">
                        <div class="refer-earn-data-subheading">
                          <p class="blue">Refer A Friend, Get ₹ <span class="yellow">1000!</span></p>
                        </div>
                        <div class="refer-earn-img">
                          <img src="{{asset('genie/build/images/refer-earn.png')}}">
                        </div>
                      <div class="refer-earn-process">
                        <p>
                          <span>Invite Your <br><strong class="blue">Friend</strong></span>
                          <span class="blue">+</span>
                          <span>Your Friends <br><strong class="blue">Make A Admission</strong></span>
                          <span class="blue">=</span>
                          <span>You Earn <br><strong><span class="blue">₹</span><span class="yellow">1000</span></strong></span>
                        </p>
                      </div>
                      <button class="btn btn-primary form-submit" data-toggle="modal" data-target="#referand_earn">GET REFER NOW</button>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        
        <div id="referand_earn" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		    		                            <img src="{{asset('genie/build/images/referandearn.png')}}">

		<h4 class="modal-title">Refer and Earn </h4> <button type="button" class="close"  data-dismiss="modal"> &times;</button>
		</div>
		<div class="modal-body">
		<div class="">				 

		<form class="form-horizontal" autocomplete="off" onsubmit="return studentsController.referEarnSave(this)">

		<div class="form-group">
		
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $students[0]->name; ?>" placeholder="Enter Name*" readonly>
		</div>
		<div class="form-group">		 
		<label>Mobile</label>
		<input type="text" class="form-control" name="mobile" value="<?php echo $students[0]->phone; ?>" placeholder="Enter Name*" readonly>
		</div>
		
		<div class="form-group">
		  
		<input type="hidden" class="form-control" name="mobile" value="<?php echo $students[0]->phone; ?>" placeholder="Mobile No*" >
		<label>Refer Name</label>
		<input type="text" class="form-control" name="refer_name" placeholder="Enter Refer Name*" >
		</div>
		<div class="form-group">
		<label>Refer Mobile</label>
		<input type="tel" class="form-control" name="refer_mobile" maxlength="16" onkeypress="return isNumberKey(event);" placeholder="Enter Refer Mobile*" >
		</div>
		<div class="form-group">
		<label>Message</label>
		<textarea class="form-control" name="message" placeholder="Type your query here" rows="3"></textarea>
		</div>
		<div class="form-group mb-0">
		<input type="reset" class="resetform">
		<button type="submit" class="btn btn-primary form-submit">GET REFER NOW</button>
		</div>
		</form>



		</div>
		</div>

		</div>

		</div>
		</div> 
	
	
	<script>
		function copyToClipboard(element) {

		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();

		$(".success").modal();
		setTimeout(function(){

		$('.success').modal("hide");

		}, 3000);

		}
		</script>
	@endsection