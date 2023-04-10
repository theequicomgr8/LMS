@extends('genie.layouts.app')
@section('title')
   Course Content
@endsection
@section('content')	
<style> .ml-10{margin-left:11px;}
        .lms-accordian .panel ul {margin-bottom: 0px;padding-left: 17px;padding-top: 6px;}
input:disabled{	color:red ;	background-color: red;	 pointer-events: none;}
 .side-batches{	  position: -webkit-sticky;position: sticky; top: 0;}
  input[type=checkbox][disabled]::before{content: "✅";margin: -1px -3px 0px;
}
</style>
           <div class="right_col" role="main">
          <div class=""><div class="clearfix"></div><div class="row"><div class="col-md-12 col-sm-12">
					<div class="col-md-12 col-sm-12"><div class="col-md-6 col-sm-6"><div class="title_left "><h4 class="mt-3">Course Curriculum</h4></div></div></div>
@if(!empty($heading))
<div class="x_content"><div class="row"><div class="col-sm-8"><div class="card-box table-responsive"><table id="" class="table table-striped table-bordered dt-responsive nowrap course-content-section" cellspacing="0" width="100%">
<thead><tr><th>Content</th></tr></thead><tbody><?php 	if($heading){
    $i=0;
    foreach($heading as $course){
    $i++;
    $headingcomplete = DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->first(); ?>
    <tr><td><div class="lms-accordian"><button class="paccordion" style="font-weight: 700;font-size: 13px;background-color: transparent;"><input type="checkbox" name="heading" class="headings" value="<?php echo $course->id; ?>" data-complete_id="<?php echo (isset($headingcomplete->id)?$headingcomplete->id:""); ?>" data-heading_id="<?php echo $course->id; ?>" data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id; ?>" data-heading="<?php echo substr(str_replace('?','',$course->heading),0,40); ?>" <?php echo ((isset($headingcomplete->status) && $headingcomplete->status==1)?"disabled":""); ?> <?php echo $disabled ?>> <?php echo str_replace('?','',$course->heading); ?><?php if(!empty($headingcomplete->heading_date)){ echo ' ('.date('d-M-Y',strtotime($headingcomplete->heading_date)).')'; } ?> 
    </button><div class="panel"><ul>
    <?php $contents = DB::table('courses_content')->where('heading_id',$course->id)->get();
    if($contents){	
    foreach($contents as $content){
    $contentcomplete = DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->first();
    ?>
    <li style="font-size: 13px;"><input type="checkbox" name="content" class="content" value="<?php echo $content->id; ?>" <?php echo ((isset($contentcomplete->status) && $contentcomplete->status==1)?" disabled":"");  ?> data-complete_id="<?php echo (isset($contentcomplete->id)?$contentcomplete->id:""); ?>" data-content_id="<?php echo $content->id; ?>"  data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id ?>" data-content="<?php echo str_replace('?','',$content->coursescontent); ?>" <?php echo $disabled; ?>> 
    <?php echo str_replace('?','',$content->coursescontent); ?><?php if(!empty($contentcomplete->created_at)){ echo ' ('.date('d-M-Y',strtotime($contentcomplete->created_at)).')'; } ?></li>									
    <?php 
    $subcontents = DB::table('courses_subcontent')->where('content_id',$content->id)->get();
    if($subcontents){										
    foreach($subcontents as $sub){
    $subcontentcomplete = DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->first();
    ?>
    <ul><li style="font-size: 12px;">   <input type="checkbox" name="subcontent" class="subcontents" value="<?php echo $sub->id; ?>" <?php echo ((isset($subcontentcomplete->status) && $subcontentcomplete->status==1)?"disabled":""); ?> data-complete_id="<?php echo (isset($subcontentcomplete->id)?$subcontentcomplete->id:""); ?>" data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id; ?>" data-subcontent_id="<?php echo $sub->id; ?>"  data-subcontent="<?php echo str_replace('?','',$sub->subcontent); ?>"  <?php echo $disabled; ?>> <?php echo str_replace('?','',$sub->subcontent); ?> <?php if(!empty($subcontentcomplete->subcontent_date)){ echo ' ('.date('d-M-Y',strtotime($subcontentcomplete->subcontent_date)).')'; } ?></li>
    <?php 
    $lastcontents = DB::table('courses_lastcontent')->where('subcontent_id',$sub->id)->get();
    if($lastcontents){										
    foreach($lastcontents as $last){
    $lastcontentcomplete = DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->first(); ?>
    
    <ul><li style="font-size: 11px;"> <?php echo str_replace('?','',$last->lastcontent); ?> <?php echo str_replace('?','',$last->lastcontent); ?><?php if(!empty($lastcontentcomplete->lastcontent_date)){ echo '('.date('d-M-Y',strtotime($lastcontentcomplete->lastcontent_date)).')'; } ?> </li></ul> 								
    <?php	} } 		 ?>								
    </ul>
    <?php  } }    }    } ?>
    </ul></div></div> </td></tr>
    <?php  } } ?>
    </tbody></table></div></div><div class="col-sm-4"><div class="side-batches"><div class="batches"><div class="batches-sections live-batch"><div class="batches-status"><div class="batches-live-heading live-batch-heading">
				<p class="strong-heading">Submit Curriculum</p></div><div class="batches-live-heading live-batch-details"><p class="strong-heading details_live">Please select the topics you are covering today before going to take live class.</p></div> 
				<div class="batches-live-heading live-batch-footer"><form method="post" action="" onsubmit="return batchController.curriculumContentSubmit()"><input type="hidden" name="b_id" id="b_id" value="<?php echo $b_id; ?>" ><input type="hidden" name="t_id" id="t_id"  value="<?php echo $t_id; ?>" ><input type="hidden" name="c_id" id="c_id" value="<?php echo $c_id; ?>" ><button type="submit" name="submit" class="btn btn-live btn btn-success"  style="color: #fff;">Submit</button>
				</form></div></div></div></div><div class="batches"><div class="batches-sections live-batch"><div class="batches-status"><div class="batches-live-heading live-batch-heading"><p class="strong-heading">Take Live Class</p></div><div class="batches-live-heading live-batch-details"><p class="strong-heading details_live">Now you  can go live  for your students from anywhere & anytime.</p></div> <div class="batches-live-heading live-batch-footer"><button class="btn btn-live" data-toggle="modal" data-target="#joinfromlaptop" ><img src="{{asset('genie/build/images/live-batch-img.png')}}" />Go Live Now </button></div> 
				</div></div></div></div></div></div></div>
            
            
          <div id="joinfromlaptop" class="modal fade" role="dialog"><div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content"><div class="modal-header"><h5 class="modal-title">Live Class</h5><div class="succesmessage"></div><div class="errormessage"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div><div class="modal-body" style="padding-top:10px;    padding-bottom: 12px;">
        <div class="join-classes text-center">	
		<?php  
		$currentdate =date('Y-m-d');
		$contentcomplete = DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->whereDate('created_at','>=',date_format(date_create($currentdate),'Y-m-d'))->get();
	 
		$checkdate=0;
		if(!empty($contentcomplete)){
			foreach($contentcomplete as $complete){
		if(date('d-m-Y',strtotime($complete->heading_date))==date('d-m-Y') || date('d-m-Y',strtotime($complete->created_at))==date('d-m-Y')){
			
			$checkdate=1;
			}
		} 
		}
		if($checkdate){
		
		?>
          <h6>Dear Trainer click on Join Button to take live class</h6>
		 <a href="https://<?php if(!empty($traierdet->meetingurl)){ echo $traierdet->meetingurl; }else{ echo $batches->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>
		<?php }else{ 
		
		
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
					$headingcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->where('status',1)->count();				 					 
					$contents = DB::table('courses_content')->where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

				if($contents){	
					foreach($contents as $content){
					$contentcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->where('status',1)->count();
					 
				 	$subcontents = DB::table('courses_subcontent')->where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					$lastcontents = DB::table('courses_lastcontent')->where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += DB::table('courses_complete')->where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					}}  
					}}
					}
					}
			    	$totalcousedh= $contentstotal +$subcontentstotal;
					$completetotaldh= $contentcomplete +$subcontentcomplete;
					if(!empty($completetotaldh)){
					$finalcomple= $totalcousedh/$completetotaldh;
					}else{
					$finalcomple=0;
					}
					if($finalcomple<=1){			
						
					
		?>

 <a href="https://<?php if(!empty($traierdet->meetingurl)){ echo $traierdet->meetingurl; }else{ echo $batches->meetingurl; } ?>" class="btn btn-success mb-0 mt-2 mr-0"  onclick="javascript:batchController.trainerAttendanceGoogleMeeting('<?php echo $batches->batch_id; ?>','<?php echo $batches->trainer_id; ?>')" target="_blank">Join</a>


					<?php }else{ ?>

		<h6 style="color:red;">Please mark the Curriculum topics for today's Session before going to take Live Class.</h6>

		<?php }		}	 ?>
		
        </div></div></div></div></div>
        <div id="successmessage" class="modal fade" role="dialog">						
        <div class="modal-dialog" style="max-width: 440px !important;margin: 1.75rem auto;">
        <div class="modal-content"><div class="modal-header"><h5 class="modal-title">Message</h5>
        <button type="button" class="close" data-dismiss="modal"></button>
        </div><div class="modal-body" style="padding-top:10px;    padding-bottom: 12px;"><div class="join-classes text-center">	
        <h6>Now you can go live for your students from anywhere & anytime.</h6><a href="jovascript:void()" class="btn btn-success mb-0 mt-2 mr-0" data-dismiss="modal" onclick="location.reload();" >ok</a>
        </div></div></div></div></div></div></div></div>
        @endif
      </div>
    				  <style>
							.acc-panel-pan{
								position:relative;
							}
							.download-icon{
								position:absolute;
								right:15px;
								top:15px;
							}
							.download-icon .modal-header{
								padding:0.1em 1.7em;
							}
						</style>
				  
			 </div>
			
          </div>
        </div>
         
           <script>
     var acc = document.getElementsByClassName("paccordion");
				var i;

				for (i = 0; i < acc.length; i++) {
				acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
				} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
				} 
				});
				}
    </script>
 

    
	@endsection