  @extends('genie.layouts.app')
 @section('title')
    Student Dashborad
@endsection
@section('content')	
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
<style>
.tile_count{margin-bottom:10px;}.mycircle-table tbody{    height:38px;}
.student-batch-name-home a:hover{color:#5A738E;}
.block .block_content .excerpt a i {top: 13px;}
.download-icon-pdf{white-space: nowrap;width: 392px;display: block;
    overflow: hidden;text-overflow: ellipsis;}
.table td, .table th {padding: 9px 13px !important;}
.download-icon-pdf i {background: #c00303;color: #fff;padding: 9px;border-radius: 50%;margin-right: 0px;position: absolute;top: 4px;right: 20px;}
.download-icon-edit i,.download-icon-play i{ position: absolute;top: 4px;right: 20px; }.student-batch-name-home a span,.x_content h4 {font-size: 17px;}
.timeline.widget {margin-bottom:0px;}
.fc-unthemed td.fc-today {background: #fcf8e300;}
.x_title {border-bottom: 1px solid #dddddd; padding: 1px 5px 6px;margin-bottom: 10px;}
ul.quick-list {padding-left: 0; margin-bottom: 30px;display: inline-block;}
.x_panel {border: none !important;min-height: 417px;position: relative; box-shadow: rgb(0 0 0 / 25%) 0px 1px 4px;border-radius: 2px;padding: 8px 15px 16px; display: block;margin-bottom: 20px;}
@media (min-width: 360px) and (max-width: 812px)
{.x_panel {min-height: 0px;}
.download-icon-pdf{white-space: nowrap;width: 180px;display: block;overflow: hidden;text-overflow: ellipsis;}
.student_batch-heading h4{width: 198px;overflow: hidden;text-overflow: ellipsis;}
.x_title h2 {font-size: 20px;}
.tile,.graph {zoom: 100%;height: inherit;}
}
.fc-title{color: #fff;text-align: center;margin-left: 8px;}
tr:first-child>td>.fc-day-grid-event {margin-top: -28px;z-index: -9;}
.fc-day-number > .fc-event-container{color:#fff !important;}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number{float:none;}
.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td {text-align: center;}
.pop-heading{background-image: linear-gradient(92deg,#347CEA,#0245AC);
    align-items: center;
    justify-content: center;
    text-align: center;    border-top-left-radius: 8px;

    position: relative;
    padding: 30px 20px 0px;
    border-bottom: 4px solid #FFD16E;}
.pop-body {
    padding: 25px 33px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    background-color:#fff;
}
.pe-0 {
    padding-right: 0!important;
}
.form-spacing {
    margin-top: 18px;
}
/*{*/
/*    color: #8f8f8f;*/
/*}*/
::placeholder,.my-from-control {
    color: #5e5e5e !important;
    opacity: 1;
}
textarea {
    min-height: 70px;
}
.my-from-control {
    border-radius: 4px;
    vertical-align: middle;
    width: 100%;
    padding: 7px 15px;
    font-weight: 400;
    background-color: #fff;
    text-transform: inherit;
    border: 1px solid rgba(119,119,119,0.2);
    font-size: 13px;
    outline: 0;
    text-transform: capitalize;
}
.pop-heading > h5 {
    font-size: 22px;
    text-transform:uppercase;
    margin-top: 8px;font-weight:600;    margin-bottom: 0px;

    color: #fff;
}
.pop-heading span {
    font-size: 26px;
}
select {
    background-image: url(data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20256%20448%22%20enable-background%3D%22new%200%200%20256%20448%22%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E.arrow%7Bfill%3A%23424242%3B%7D%3C%2Fstyle%3E%3Cpath%20class%3D%22arrow%22%20d%3D%22M255.9%20168c0-4.2-1.6-7.9-4.8-11.2-3.2-3.2-6.9-4.8-11.2-4.8H16c-4.2%200-7.9%201.6-11.2%204.8S0%20163.8%200%20168c0%204.4%201.6%208.2%204.8%2011.4l112%20112c3.1%203.1%206.8%204.6%2011.2%204.6%204.4%200%208.2-1.5%2011.4-4.6l112-112c3-3.2%204.5-7%204.5-11.4z%22%2F%3E%3C%2Fsvg%3E%0A);
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: auto 44%;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
}
.pop-body .col-form-label {
    font-size: 14px;
    font-weight: 500;
    color: #000;
}
.btn-red {
    color: #fff;
    background: #FD5D5D;
    padding: 8px 30px;
        width: 87%;
display:flex;
align-items:center;
justify-content:center;
}
.btn-red:hover
{
    background-image: linear-gradient(92deg,#347CEA,#0245AC);
}
.btn-site {
    font-weight: 450;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    transform: 0.5s;
    position: relative;
}
.btn-red::after
{
    font-family: 'Font Awesome 6 Pro';
    content: "\f061";
    font-weight: 900;
    
}
.submit-form
{
    position:relative;
}
.long-arrow-right, .long-arrow-left {
    display: block;
 width: 7px;
    height: 7px;
    border-top: 1.5px solid #fff;
    border-left: 1.5px solid #fff;
}
.long-arrow-right {
    transform: rotate(135deg);
    position: absolute;
    top: 16px;
    right: 141px;
}
.long-arrow-right::after, .long-arrow-left::after {
       content: "";
    display: block;
    width: 1px;
    height: 13px;
    background-color: white;
    transform: rotate(-45deg) translate(4px, 0px);
}
.modal-backdrop{
    /*position: inherit;*/
}

.pop-heading p{font-size:13px;font-weight:500;    color: #fff;    margin-bottom: 10px;

}
.pop-heading button {position: absolute;top: 0px;right: 0;background-color: #fff;opacity: 1;z-index: 9;
color: #0245AC;border: 0px;margin: 0px;border-radius: 0px 0px 0px 10px;
    width: 30px;height: 32px;line-height: 30px;font-size: 13px;
}
#grievance-popup .modal-content {
    border-radius: 8px;
    border:none;
        background-color: transparent;

}
@media (min-width: 576px){
#grievance-popup .modal-dialog {
    max-width: 440px;
}
}
</style>
 <div class="right_col" role="main"> <br /><div class="row">
          <div class="col-md-8"  >
            <div class="x_panel tile batch-home">
            <div class="x_title mb-3">
            <h2>Batch Details</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <h4 class="student-batch-name-home"><a href="{{url('student/student-batch')}}" target="_blank" title="<%stud_batch_name%>"><span ng-bind="stud_batch_short" style="font-size:18px; color:#333;"></span></a></h4>
            <div class="x_content">
              <div class="row">
                <style>
                  .student-status-heading{display: flex; align-items:center; margin:20px 10px;}
                  .student-status-heading .strong-heading2{margin:0px}
                  .student-status-heading .student-status-details {padding:0px 16px;}
                </style>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Start Date</p><p class="strong-heading2" title="Student Batch Start Date"><span ng-bind="stud_batch_start"></span></p></div></div></div>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-book" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Course Name</p><div class="count" ng-bind="stud_course_short" title="<%stud_course%>"> </div></div></div></div>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-user" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Trainer Name</p><p class="strong-heading2" title="Student Trainer Name"><span ng-bind="stud_trainer_name"></span></p></div></div></div>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-user" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Topic Covered</p><div class="count green" ng-bind="stud_course_compete"></div></div></div></div>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-money" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Fees Pending</p><div class="count red" ng-bind="std_feespending"></div></div></div></div>
                <div class="col-md-4"><div class="student-status-heading"><i class="fa fa-calendar" aria-hidden="true"></i><div class="student-status-details"><p class="strong-heading">Due Date</p><div class="count" ng-bind="std_due_date"></div></div></div></div></div>
               <div class="live-class-section" style="padding:0 10px 10px;"><div class="batches mb-0 mt-3"><div class="batches-sections live-batch"><div class="batches-status"><div class="batches-live-heading live-batch-heading"> <p class="strong-heading"> <strong> Take Live Class </strong></p> </div>   
                <div class="batches-live-heading live-batch-details"> </div> 
                <div class="batches-live-heading live-batch-footer"><button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop_<?php echo $studentdash[0]->std_id; ?>" ><img src="{{asset('genie/build/images/live-batch-img.png')}}" />Join Live Class </button> 
                </div></div></div></div></div>
                    <style>
                    .live-batch-heading p{    font-size: 16px;
                    font-weight: 400;
                    color: #000;
                    opacity: .87;
                    margin: 0;
                    text-align: left;
                    padding-bottom: 13px;}
                    </style><div id="joinfromlaptop_<?php echo $studentdash[0]->std_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
								<div class="modal-content"><div class="modal-header"><h5 class="modal-title">Live Class :</h5><div class="succesmessage"></div><div class="errormessage"></div><button type="button" class="close" data-dismiss="modal">&times;</button></div>
								<div class="modal-body" style="padding-top:10px;padding-bottom: 12px;"><h6>Dear Student click on Join Button to take live class </h6><div class="join-classes text-center">
										<a href="https://<?php if(!empty($studentdash[0]->trainer_meetingurl)){ echo $studentdash[0]->trainer_meetingurl; }else{ echo $studentdash[0]->batch_meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $studentdash[0]->std_id; ?>)" target="_blank">Yes</a>
									</div></div></div></div></div></div></div></div>
                        
            <div class="col-md-4"><div class="x_panel tile"><div class="x_title mb-3"><h2>Attendance </h2>
                  <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li></ul><div class="clearfix"></div></div>
        <style>
        .excerpt{margin-bottom:0px;}
        .fc-widget-header .fc-sun{color:red;}
        .fc-row.fc-week.fc-widget-content .fc-bg .fc-sun{background:#ddd;color:#2A3F54;}	
        .fc-widget-header .fc-sat{color:red;}
        .fc-row.fc-week.fc-widget-content .fc-bg .fc-sat{background:#ddd;}		 
        .fc-basic-view .fc-body .fc-row {min-height: 1em !important;}
        .fc-widget-content .fc-scroller.fc-day-grid-container{overflow: hidden !important;}
        .fc-time{display:none;}
        .fc-other-month .fc-day-number {display:none;}
        </style>
			 
        <div class="x_content"><div id='calendar' data-stud_cal_id="<%stud_id%>"></div></div>
        <br><div style="text-align:center; margin:12px;"><a target="_blank" href="https://learnpitch.com/student/student-attendance" style="background: linear-gradient(45deg, #3876F1, #1C19B0); padding: 9px 15px; color: #ddd; border-radius: 5px; text-decoration: none;">View Attendance</a></div>
        </div></div></div>
			<div class="row"><div class="col-md-4 col-sm-4 "><div class="x_panel tile overflow_hidden" style="min-height: 690px;"><div class="x_title">
                  <h2>News/Events</h2><div class="clearfix"></div></div>
                <div class="x_content"><div class="dashboard-widget-content"><div class="twitpost">		
				<a class="twitter-timeline" data-height="600" data-theme="light" data-link-color="#3b94d9" data-border-color="#f5f5f5" href="https://twitter.com/cromacampus">Tweets by @Croma Campus</a>
				</div></div> </div></div></div>  
			<div class="col-md-4 col-sm-4 "><div class="x_panel tile overflow_hidden" style="min-height: 690px;">
                <div class="x_title"><h2>News/Events</h2>              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <div class="dashboard-widget-content">
				<div class="field field--name-body field--type-text-with-summary field--label-hidden field__item"><div id="fb-root"> </div>
						<script async="" defer="defer" crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&amp;version=v9.0" nonce="ALD5Oa2v"></script>
						<div class="fb-page" data-adapt-container-width="true" data-height="" data-hide-cover="false" data-href="https://www.facebook.com/CromaCampusNoidaOfficial" data-show-facepile="true" data-small-header="true" data-tabs="timeline" data-width="500">
							<blockquote cite="https://www.facebook.com/CromaCampusNoidaOfficial" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CromaCampusNoidaOfficial">Croma Campus </a></blockquote>
						</div></div></div></div></div>	
            </div> 
            <div class="col-md-4 col-sm-4 col-xs-12"><div class="x_panel" style="min-height: 690px;"><div class="x_title"><h2>Activities  Blog</h2>
                  <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li></ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="list-unstyled timeline widget">
                    @if(!empty($blogs))
						@foreach($blogs as $blog)
					  <li><div class="block"><div class="block_content"><h2 class="title"><a href="https://www.cromacampus.com/blogs/<?php echo $blog->post_name; ?>" target="_blank">{{$blog->post_title}}</a>
                            </h2><div class="byline"><span><?php echo date('',strtotime($blog->post_modified)); ?></span> by <a>Croma Campus</a>
                            </div><p class="excerpt"><?php echo substr($blog->post_content, 0,200)." ..."; ?> <a>Read&nbsp;More</a>
                            </p>
                          </div></div></li>
					  @endforeach
					  @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
        </div>
        
        
        <!--grievance-popup popup form-->
        
<div class="modal fade" id="grievance-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
          <div class="modal-content">
            <div class="pop-heading">
                <img src="genie/build/images/icons.png" alt="grievance-icon" class="img-fluid">
                <h5>Grievance</h5>
                <p>Are you facing any issue/problem</p>
                <button type="button" class="" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>               

            </div>
            <div class="pop-body">
                <form action="" id="grievance-form">
                    <div class="row align-items-center">
                        <div class="col-2">
                          <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-2 pe-0">
                            <select class="my-from-control minimal" style="padding:7px;">
                                <option>Mr</option>
                                <option>Ms</option>
                            </select>
                          </div>
                        <div class="col-8">
                          <input type="text" class="my-from-control" name="name" placeholder="Enter Your Name" value="{{$basicdetail->name}}" readonly>
                        </div>
                      </div>
                      <div class="row align-items-center form-spacing">
                        <div class="col-2">
                            <label class="col-form-label">Email</label>
                        </div>
                        <div class="col-10">
                          <input type="email" class="my-from-control" name="email" placeholder="Enter Your Email" value="{{$basicdetail->email}}" readonly>
                        </div>
                      </div>
                      <div class="row align-items-center form-spacing">
                        <div class="col-2">
                            <label class="col-form-label">Mobile</label>
                        </div>
                        <div class="col-10">
                          <input type="text" class="my-from-control" name="mobile" placeholder="Enter Your Mobile" value="{{$basicdetail->phone}}" readonly>
                        </div>
                      </div>
                      <div class="row align-items-center form-spacing">
                        <div class="col-2">
                            <label class="col-form-label">Related</label>
                        </div>
                        <div class="col-10">
                            <select class="my-from-control" name="related" required>
                                <option value="">Select Any</option>
                                <option value="0">Counsellor</option>
                                <option value="1">Trainer</option>
                              </select>
                        </div>
                      </div>
                      <div class="row form-spacing">
                        <div class="col-12">
                            <textarea class="my-from-control" name="complain" placeholder="Please Enter Message Here..." required></textarea>
                        </div>
                      </div>
                                         
                      <div class="submit-form text-center form-spacing d-flex justify-content-center">
                        <!--<button class="btn-site btn-red">Submit <img src="genie/build/images/arrow-symbol.png"/>-->
                        <input type="submit" class="btn-site btn-red" value="Submit"/>
                        <div class="long-arrow-right"></div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        </div>
        
       
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
		 <script src="{{asset('genie/build/twitter/widgets.js')}}"></script>
		 
		 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		  <script>
 $ (window).ready (function () {
	setTimeout (function () {
		$ ('#grievance-popup').modal ("show")
	}, 3000)
})


        $("#grievance-form").submit(function(e){
            e.preventDefault();
            $.ajax({
        		url : '/grev',
        		type: 'POST',
        		data: new FormData(this),
        		processData:false,
        		contentType:false,
        		/*beforeSend:function()
        		{
        			$(document).find('.error').text('');
        		},*/
        		success:function(data)
        		{
        			console.log(data.status);
        			/*if(data.status=='0'){
        				$.each(data.error,function(key,value){
        					$("."+key+"_err").text(value[0]);
        				});
        
        			}else{
        				alert(data.message);
        			}*/
        			$("#grievance-popup").hide();
        			$(".modal-backdrop").css("position", "inherit");
        			swal("Saved!", "Saved Successfully!", "success");
        
        
        		}
        	});
            
        });

        </script>
       @endsection