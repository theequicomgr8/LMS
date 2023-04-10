@extends('genie.layouts.app')
@section('title')
   Batch
@endsection
@section('content')	
<div class="right_col padding-student-top" role="main"><div class="">
<style>.btn-primary{background-color: #13293e;border-color: #13293e;}
.btn-primary:hover {color: #fff;background-color: #13293e;border-color: #13293e;}
.student_batch-status{display: grid;grid-template-columns: repeat(3,33.33%);width: 100%;padding: 0px 21px;}
.announcement_body{padding: 19px 0px 0px;}
.live-batch-heading p{font-size: 16px;font-weight: 400;color: #000;opacity: .87;margin: 0;text-align: left;padding-bottom: 13px;}
.student-status-heading{margin: 16px 0;display: flex;align-items: center;}
.student-status-details{padding: 0 0 0 24px;font-size: 14px;width:100%;font-weight: 400 !important;color: #727272;}
.strong-heading{font-weight: 400;font-size: 14px;color: rgba(0,0,0,.6); margin: 0 0 8px;}
.student-status-details .strong-heading2,.student-status-details .strong-headin2{font-weight: 500;font-size: 15px;line-height: 22px;margin: 0;display: flex;align-items: center;white-space: nowrap;overflow: hidden;display: block;color: rgb(0 0 0 / 71%);}
.gvnMbb {align-items: center;background: #dddddd52;border-radius: 4px;display: flex;margin-top: 8px;padding-left: 12px;justify-content: space-between;margin-bottom: 20px;align-content: center;}
.VfPpkd-Bz112c-LgbsSe {display: inline-block;position: relative;box-sizing: border-box;border: none;outline: none;background-color: transparent;fill: currentColor;color: inherit;text-decoration: none;cursor: pointer;-webkit-user-select: none;z-index: 0;overflow: visible;}
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
#success .modal-dialog .modal-content .modal-body {padding: 8px;background-color: #323232;color: #fff;box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
-webkit-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
-moz-box-shadow:0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
}
.modal-content{border:none !important;}
.join{display:none;}
#referand_earn .modal-header .close {padding: 1rem 1rem;margin: -1rem -1rem -1rem auto;position: absolute;right: 20px;font-weight: 200;top: 4px;color: #fff;box-shadow: none;opacity: 1;}
	.setbutton button{	padding: 10px; 	background:#172D44; border: none; 	outline: none; border-radius: 5px; 	color: #fff;	}
	.setprimaycolor{background-color:#169F85 !important;}
			</style>
    <div class="clearfix"></div><div class="row"><div class="col-md-8">
    @if(!empty($students))
    <?php $i=0; ?>
    @foreach($students as $student)
    <?php $i++; ?>
    <div class="batches"><div style="display:flex; justify-content: space-between; align-items: center;"><div class="student_batch-heading"><h4><?php if($student->batch_name){ echo $student->batch_name; } ?></h4></div></div>
    <div class="batches-sections"><div class="batches-status student_batch-status"><div class="student-status-heading"><i class="fa fa-book"></i><div class="student-status-details"><p class="strong-heading">Course</p><p class="strong-headin2" title="<?php  if($student->course){ echo $student->course; } ?>"><?php  echo (strlen($student->course) > 20 ? substr($student->course,0,20).'..' : $student->course);  ?></p>
    </div></div><div class="student-status-heading"><i class="fa fa-user"></i><div class="student-status-details"><p class="strong-heading">Trainer Name</p>
    <p class="strong-headin2" title="<?php  if($student->trainer_name){ echo $student->trainer_name; } ?>"><?php  echo (strlen($student->trainer_name) > 16 ? substr($student->trainer_name,0,16).'..' : $student->trainer_name); ?></p>
    </div></div><div class="student-status-heading"><i class="fa fa-calendar"></i><div class="student-status-details"><p class="strong-heading">Start Date</p>
    <p class="strong-headin2"><?php if($student->batch_created_on){ echo date('d-M-Y',strtotime($student->batch_created_on)); } ?> </p></div></div><div class="student-status-heading">
    <i class="fa fa-calendar"></i><div class="student-status-details"><p class="strong-heading">Slot</p><p class="strong-headin2"><?php  if($student->occurrence=='WD'){ echo 'Weekday'; } else{ echo 'Weekend'; }?></p>
    </div></div><div class="student-status-heading"><i class="fa fa-clock-o" aria-hidden="true"></i>
    <div class="student-status-details"><p class="strong-heading">Batch Timing</p><p class="strong-headin2"><?php  if($student->batch_starts_on){ echo $student->batch_starts_on.' - '.$student->batch_end_on; } ?></p>
    </div></div>
    <div class="student-status-heading"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><div class="student-status-details">
    <p class="strong-heading">Last Class Date</p> <p class="strong-headin2"><?php  if($student->attenddate){ echo date('d, M Y',strtotime($student->attenddate)); } ?></p>
    </div></div>
    </div><div class="live-class-section padding-60"><div class="batches mb-0 mt-3"><div class="batches-sections live-batch">
    <div class="batches-status"><div class="batches-live-heading live-batch-heading"><p class="strong-heading"> <strong> Take Live Class </strong></p></div>   
        <div class="batches-live-heading live-batch-details"><p class="strong-heading details_live">Now you  can go live  for your students & Batch  them  any time anywhere!</p>
    </div><div class="batches-live-heading live-batch-footer"><button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop_<?php echo $student->id; ?>" ><img src="{{asset('genie/build/images/live-batch-img.png')}}" />Join Live Class </button> 
    </div></div></div></div></div>
    <div id="joinfromlaptop_<?php echo $student->id; ?>" class="modal fade" role="dialog">						
    <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
    <div class="modal-content"><div class="modal-header"><h5 class="modal-title">Live Class :</h5><div class="succesmessage"></div><div class="errormessage"></div>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div><div class="modal-body" style="padding-top:10px;padding-bottom: 12px;"><h6>Dear Student click on Join Button to take live class </h6>
    <div class="join-classes text-center"><a href="https://<?php if(!empty($student->trainer_meetingurl)){ echo $student->trainer_meetingurl; }else{ echo $student->batch_meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.studentsAttendanceGoogleMeeting(<?php echo $student->std_id; ?>)" target="_blank">Yes</a>
    </div></div></div></div></div></div></div>
    @endforeach
    @endif
    </div>
    @include('genie.layouts.sidebar_form')
    </div></div></div>
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
		}
		</script>
	@endsection