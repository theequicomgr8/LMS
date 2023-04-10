@extends('genie.layouts.app')
@section('title')
   Course Content
@endsection
@section('content')	
<style>
    .ml-10{
        margin-left:11px;
    }
        .lms-accordian .panel ul {
    margin-bottom: 0px;
    padding-left: 17px;
    padding-top: 6px;
}
</style>
           <div class="right_col" role="main">
          <div class="">


            <div class="clearfix"></div>

            <div class="row">

                  <div class="col-md-12 col-sm-12">
                                    <div class="title_left ">
<h4 class="mt-3">Course Curriculum

</h4>              
</div>
			  		 <?php //echo "<pre>";print_r($students); ?>
					@if(!empty($heading))
<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<div class="card-box table-responsive"> 
							<table id="" class="table table-striped table-bordered dt-responsive nowrap course-content-section" cellspacing="0" width="100%">
							<thead>
							<tr>                                                   
							<th>Content</th>
							<th>Video</th>
							<th>Notes</th>
							<th>Assignment</th>                           
							</tr>
							</thead>
							<tbody>
					<?php 	if($heading){
							$i=0;
							foreach($heading as $course){
							$i++;
						
						$headingcomplete = App\CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('heading_id',$course->id)->first(); ?>
						 <tr>						
								<td>
								<div class="lms-accordian">
								<button class="paccordion" style="font-weight: 700;font-size: 13px;background-color: transparent;">
								 
								<?php echo str_replace('?','',$course->heading); ?><input type="checkbox" name="heading" class="heading" value="1" data-complete_id="<?php echo (isset($headingcomplete->id)?$headingcomplete->id:""); ?>" data-heading_id="<?php echo $course->id; ?>" data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id; ?>" data-heading="<?php echo substr(str_replace('?','',$course->heading),0,40); ?>" <?php echo ((isset($headingcomplete->status) && $headingcomplete->status==1)?"checked":""); ?> style="margin-left: 20px;margin-right:10px;" <?php echo $disabled ?>><?php if(!empty($headingcomplete->heading_date)){ echo ' ('.date('d-M-Y',strtotime($headingcomplete->heading_date)).')'; } ?></button>
								<div class="panel">
								<ul>
								<?php $contents = App\CoursesContent::where('heading_id',$course->id)->get();
								if($contents){	
								foreach($contents as $content){
								$contentcomplete = App\CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('content_id',$content->id)->first();
									?>
									<li style="font-size: 13px;"><input type="checkbox" name="content" class="content" value="1" <?php echo ((isset($contentcomplete->status) && $contentcomplete->status==1)?"checked":"");  ?> data-complete_id="<?php echo (isset($contentcomplete->id)?$contentcomplete->id:""); ?>" data-content_id="<?php echo $content->id; ?>"  data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id ?>" data-content="<?php echo str_replace('?','',$content->coursescontent); ?>" <?php echo $disabled; ?>> <?php echo str_replace('?','',$content->coursescontent); ?><?php if(!empty($contentcomplete->content_date)){ echo ' ('.date('d-M-Y',strtotime($contentcomplete->content_date)).')'; } ?></li> 
									<?php 
									$subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
									if($subcontents){										
									foreach($subcontents as $sub){
										$subcontentcomplete = App\CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('subcontent_id',$sub->id)->first();
										 ?>
										<ul><li style="font-size: 12px;"> <input type="checkbox" name="subcontent" class="subcontent" value="1" <?php echo ((isset($subcontentcomplete->status) && $subcontentcomplete->status==1)?"checked":""); ?> data-complete_id="<?php echo (isset($subcontentcomplete->id)?$subcontentcomplete->id:""); ?>" data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id; ?>" data-subcontent_id="<?php echo $sub->id; ?>"  data-subcontent="<?php echo str_replace('?','',$sub->subcontent); ?>"  <?php echo $disabled; ?>> <?php echo str_replace('?','',$sub->subcontent); ?> <?php if(!empty($subcontentcomplete->subcontent_date)){ echo ' ('.date('d-M-Y',strtotime($subcontentcomplete->subcontent_date)).')'; } ?></li>
									<?php 
										$lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
										if($lastcontents){										
										foreach($lastcontents as $last){
											$lastcontentcomplete = App\CoursesComplete::where('batch_id',$b_id)->where('trainer_id',$t_id)->where('course_id',$c_id)->where('lastcontent_id',$last->id)->first(); ?>
									 
										<ul><li style="font-size: 11px;"><input type="checkbox" name="lastcontent" class="lastcontent" value="1" <?php echo ((isset($lastcontentcomplete->status) && $lastcontentcomplete->status==1)?"checked":""); ?> data-complete_id="<?php echo (isset($lastcontentcomplete->id)?$lastcontentcomplete->id:""); ?>'" data-b_id="<?php echo $b_id; ?>" data-c_id="<?php echo $c_id; ?>" data-t_id="<?php echo $t_id;  ?>" data-lastcontent_id="<?php echo $last->id; ?>" data-lastcontent="<?php echo str_replace('?','',$last->lastcontent); ?>"  <?php echo $disabled; ?>><?php echo str_replace('?','',$last->lastcontent); ?> <?php echo str_replace('?','',$last->lastcontent); ?><?php if(!empty($lastcontentcomplete->lastcontent_date)){ echo '('.date('d-M-Y',strtotime($lastcontentcomplete->lastcontent_date)).')'; } ?> </li></ul> 								
									<?php	} } 		 ?>								
										</ul>
								<?php 
									}
									}
								}
								} ?>


						 </ul>
									</div>	
									</div>							 
									</td>
						<td><a href="javascript:void(0)" title="Add Course Content" data-toggle="modal" data-target="#getCourseVideoForm_<?php echo (isset($course->id)?$course->id:""); ?>"><i class="fa fa-video-camera ml-10" aria-hidden="true"></i> </a> 
						<?php 				
						$coursesVideoh = App\CoursesVideo::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($coursesVideoh)  && count($coursesVideoh)>0){				 ?>		
							   <i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>			
						<?php } ?>
						  
				
					 
							<div id="getCourseVideoForm_<?php echo (isset($course->id)?$course->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Video Upload </h5> <div class="succesmessage"></div><div class="errormessage"></div>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
							<div class="panel-body">
							<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php  $videos = App\CoursesVideo::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
				    	if($videos){
						foreach($videos as $video){
						$vname= unserialize($video->video);  ?>

						 <tr><td><a href="javascript:void()" class="download-icon-play" data-toggle="modal" data-target="#myModal_<?php  echo $video->id; ?>"><i class="fa fa-play"></i> </a>					 
						<div id="myModal_<?php  echo $video->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">					 
						<div class="modal-content">
						<div class="modal-header">						
						<h4 class="modal-title">Video</h4>
						<button type="button"  class="vclose" data-closeid="<?php echo (isset($video->id)?$video->id:""); ?>">&times;</button>
						</div>
						<div class="modal-body">							 
						<video  width="750" controls class="theVideo_<?php echo (isset($video->id)?$video->id:"") ?>"><source src="<?php echo asset($vname['video']['src']); ?>" type=""> <i class="fa fa-film" aria-hidden="true"></i></video>
						</div>						</div>
						</div></td><td><a href="javascript:courseController.courseVideodelete('<?php echo $video->id; ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>
						</td></tr>
					<?php 	} } ?>
					 </table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseVideo('<?php echo (isset($course->id)?$course->id:""); ?>','<?php echo $b_id; ?>','<?php echo $c_id; ?>','<?php echo $t_id; ?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select Video file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="'.(isset($course->id)?$course->id:"").'">
						<input type="file" name="video" accept=".mpeg,.ogg,.mp4,.webm,.3gp,.mov,.flv,.avi,.wmv,.ts" required="required" class="form-control" style="overflow: hidden;">
						<img src="{{asset('genie/build/images/loading.gif')}}" class="loading" style="display: none;">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						</td>
						<td> <a href="javascript:void(0);" data-toggle="modal" data-target="#getCourseNotesForm_<?php echo (isset($course->id)?$course->id:""); ?>" title="Add Course Notes" ><i class="fa fa-file-pdf-o ml-10" aria-hidden="true"></i> </a>
						<?php 
							$notess = App\CoursesNotes::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($notess)  && count($notess)>0){						
							?><i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>				
					<?php 	} ?>
						 
					
						 <div id="getCourseNotesForm_<?php echo (isset($course->id)?$course->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Notes Upload </h5> <div class="notesmessage"></div><div class="errormessage"></div>
							<button type="button" class="close" data-dismiss="modal" >&times;</button>
							</div>
							<div class="modal-body">
							<div class="panel-body">							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php  $notes = App\CoursesNotes::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
						if($notes){
						foreach($notes as $note){
							$nname= unserialize($note->notes);  ?>
						<tr><td><a href="https://docs.google.com/viewer?url=<?php echo asset($nname['notes']['src']) ?>" target="_blank">  
						 
						 Download <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><td><a href="javascript:courseController.courseNotesdelete('<?php echo $note->id; ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a></td></tr>
						<?php } }  	?></table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseNotes('<?php echo (isset($course->id)?$course->id:""); ?>','<?php echo $b_id; ?>','<?php echo $c_id; ?>','<?php echo $t_id; ?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select Notes file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="<?php echo (isset($course->id)?$course->id:""); ?>">
						<input type="file" name="notes" accept=".pdf,.doc"  required="required" class="form-control ">
						<img src="{{asset('genie/build/images/loading.gif')}}" class="loading" style="display: none;">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						
						
						</td>
						<td><a href="javascript:void(0)" data-toggle="modal" data-target="#getCourseAssignForm_<?php echo (isset($course->id)?$course->id:"") ?>"  title="Assignment" ><i class="fa fa-question-circle-o ml-10" aria-hidden="true"></i> </a>
						 <?php 
							$assignmentss = App\CoursesAssignment::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();
						if(!empty($assignmentss)  && count($assignmentss)>0){ ?>
							
							  <i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>
						 
					<?php 	}  	?>
						
							 
						
						<div id="getCourseAssignForm_<?php echo (isset($course->id)?$course->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">


							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Assignment Upload </h5> <div class="succesmessage"></div><div class="errormessage"></div>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<?php	$assignments = App\CoursesAssignment::where('heading_id',$course->id)->where('trainer_id',$t_id)->where('course_id',$c_id)->get();		
						if($assignments){
						foreach($assignments as $assignment){
							$aname= unserialize($assignment->assignment); 	 ?>
						 <tr><td><a href="https://docs.google.com/viewer?url=<?php echo asset($aname['assignment']['src']); ?>" target="_blank">  
						 Download <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><td><a href="javascript:courseController.courseAssignmentdelete('<?php echo $assignment->id ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a></td></tr>
						<?php } } 
						?></table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 pr-0 pl-0">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.saveCourseAssignment('<?php echo (isset($course->id)?$course->id:""); ?>','<?php echo $b_id; ?>','<?php echo $c_id; ?>','<?php echo $t_id; ?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-4 col-sm-4" for="first-name">Select file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="<?php echo (isset($course->id)?$course->id:""); ?>">
						<input type="file" name="assignment" accept=".pdf,.doc,.docx"  required="required" class="form-control ">
						<img src="{{asset('genie/build/images/loading.gif')}}" class="loading" style="display: none;">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group mb-0">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success mb-0" name="submit">Submit</button>
						</div>
						</div>

						</form>
						</div></div></div>
							</div>
							</div>

							</div>

							</div>
							</div> 
						
						
						
						</td>
						</tr>
						 <?php  } } ?>
					    </tbody>
					</table>
					 
					
                  </div>
				  
                </div>
              </div>
            </div>

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
      /*  function hideA(x) {
         if (x.checked) {
           document.getElementById("A").style.display = "none";
           document.getElementById("B").style.display = "block";
         }
       }

       function hideB(x) {
         if (x.checked) {
           document.getElementById("B").style.display = "none";
           document.getElementById("A").style.display = "block";
         }
       }

      var acc = document.getElementsByClassName("accordion-lms");
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
      } */
     
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