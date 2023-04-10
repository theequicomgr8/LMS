 @extends('genie.layouts.app')
 @section('title')
    Courses View
 @endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
			 <div class="clearfix"></div>
		  <div class="row">
				<style>
				.dataTables_length{
				float: left;
				}
				div.dataTables_wrapper div.dataTables_filter {
				text-align: right;
				float: right;
				}
				</style>
              <div class="col-md-12 col-sm-12" style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Course List</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>                                                   
							<th>Content</th>
							<th>Video</th>
							<th>Notes</th>
							<th>Assignment</th>                           
                        </tr>
                      </thead>
					    <tbody>
						<?php 
						if($heading){
							$i=0;
							foreach($heading as $course){
							$i++;
							?>
						<tr>
						<td>
						 
						<div class="lms-accordian">
						<button class="paccordion" style="font-weight: 700;font-size: 13px;">
						 
						<?php echo substr(str_replace('?','',$course->heading),0,100); ?></button>
						<div class="panel">
						<ul>						 
						 <?php 
						$contents = App\CoursesContent::where('heading_id',$course->id)->get();
						 if($contents){						 
							 
							 foreach($contents as $content){ ?>
								<li style="font-size: 13px;"> <?php echo str_replace('?','',$content->coursescontent); ?></li>
								 <?php 
									$subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
									if($subcontents){
										
										foreach($subcontents as $sub){ ?>
										<ul><li style="font-size: 12px;">  <?php echo str_replace('?','',$sub->subcontent); ?></li>
										
									 <?php 
									$lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
									if($lastcontents){										
										foreach($lastcontents as $last){
										?><ul><li style="font-size: 11px;"><?php echo str_replace('?','',$last->lastcontent); ?></li></ul><?php } } ?></ul>	
								<?php 			
										}
									}
								?> 
								
								 
								
						 <?php }
						 }
 
						 ?>
						 </ul>
						</div>			
					
					</div>				 
							 
						</td>
						<td><a href="javascript:void(0)" title="Add Course Content" data-toggle="modal" data-target="#getCourseVideoForm_<?php echo (isset($course->id)?$course->id:"")?>"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
						<?php 
							$heading = App\CoursesVideo::where('heading_id',$course->id)->get();
						if(!empty($heading)  && count($heading)>0){
							?>
							<i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>
						<?php 
						}
						?>
						
						<div id="getCourseVideoForm_<?php echo (isset($course->id)?$course->id:"")?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
							<h4 class="modal-title">Video Upload<div class="succesmessage"></div><div class="errormessage"></div> </h4> 
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						 
						
						<div class="col-sm-12">
							<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php  $videos = App\CoursesVideo::where('heading_id',$course->id)->where('course_id',$course->course_id)->get();		
				    	if($videos){
						foreach($videos as $video){
						$vname= unserialize($video->video);  ?>
						 <tr><td><a href="javascript:void()" class="download-icon-play" data-toggle="modal" data-target="#myModal_<?php  echo $video->id; ?>"><?php $vname= unserialize($video->video); 						
						echo substr($vname['video']['name'],0,10);
						
						?><i class="fa fa-play"></i> </a>					 
						<div id="myModal_<?php  echo $video->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">					 
						<div class="modal-content">
						<div class="modal-header">						
						<h4 class="modal-title">Video</h4>
						<button type="button"  class="vclose" data-closeid="<?php echo (isset($video->id)?$video->id:""); ?>" >&times;</button>
						</div>
						<div class="modal-body">							 
						<video  width="750" controls class="theVideo_<?php echo (isset($video->id)?$video->id:"") ?>"><source src="<?php echo asset($vname['video']['src']); ?>" type=""> <i class="fa fa-film" aria-hidden="true"></i></video>
						</div>						</div>
						</div></td><td><a href="javascript:courseController.courseVideodelete('<?php echo $video->id; ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>
						</td></tr>
					<?php 	}} ?>
					 </table>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.adminSaveCourseVideo('<?php echo (isset($course->id)?$course->id:"")?>','<?php echo (isset($course->course_id)?$course->course_id:"")?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Video file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="<?php echo (isset($course->id)?$course->id:"")?>">
						<input type="file" name="video" accept=".mpeg,.ogg,.mp4,.webm,.3gp,.mov,.flv,.avi,.wmv,.ts" required="required" class="form-control ">
						<img src="{{asset('genie/build/images/loading.gif')}}" class="loading" style="display: none;">
						</div>
						</div>
						<div class="ln_solid preview"></div>
						<div class="item form-group">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success" name="submit">Submit</button>
						</div>
						</div>
						</form>
						</div></div></div>
							</div></div></div></div></div> 
						
						</td>
						<td> <a href="javascript:void(0);" data-toggle="modal" data-target="#getCourseNotesForm_<?php echo (isset($course->id)?$course->id:"")?>" title="Add Course Notes" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
						<?php 
							$notess = App\CoursesNotes::where('heading_id',$course->id)->get();
						if(!empty($notess)  && count($notess)>0){
							?>
							<i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>
						<?php 
						}
						
						?>
						<div id="getCourseNotesForm_<?php echo (isset($course->id)?$course->id:"")?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">


							<div class="modal-content">
							<div class="modal-header">
							<h4 class="modal-title">Notes Upload<div class="notesmessage"></div><div class="noteerrormessage"></div> </h4> 
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php $notes = App\CoursesNotes::where('heading_id',$course->id)->get();		
						if($notes){
						foreach($notes as $note){ ?>
						<tr><td><?php $nname= unserialize($note->notes); 						
						echo $nname['notes']['name'];
					 
						?></td><td>
						<a href="https://docs.google.com/viewer?url=<?php echo asset($nname['notes']['src']); ?>" target="_blank">  
						 
						 <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><td><a href="javascript:courseController.courseNotesdelete('<?php echo $note->id; ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a></td></tr>
						<?php  } } ?>
						</table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.adminSaveCourseNotes('<?php echo (isset($course->id)?$course->id:"")?>','<?php echo (isset($course->course_id)?$course->course_id:"")?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Notes file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="<?php echo (isset($course->id)?$course->id:"")?>">
						<input type="file" name="notes" accept=".pdf,.doc"  required="required" class="form-control ">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success" name="submit">Submit</button>
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
						<td><a href="javascript:void(0)" data-toggle="modal" data-target="#getCourseAssignForm_<?php echo (isset($course->id)?$course->id:"")?>"  title="Assignment" ><i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
						<?php 
							$Assignments = App\CoursesAssignment::where('heading_id',$course->id)->get();
						if(!empty($Assignments)  && count($Assignments)>0){
							?>
							<i class="fa fa-check-square" aria-hidden="true" style="color:green;margin-left: 10%;"></i>
						<?php 
						}
						
						?>
						
						<div id="getCourseAssignForm_<?php echo (isset($course->id)?$course->id:"")?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">


							<div class="modal-content">
							<div class="modal-header">
							<h4 class="modal-title">Assignment Upload<div class="succesmessage"></div><div class="errormessage"></div> </h4> 
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							


							</div>
							<div class="modal-body">
							<div class="panel-body">

							 
						<div class="x_content">
						<div class="row">
						<div class="col-sm-12">
						<table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<?php $assignments = App\CoursesAssignment::where('heading_id',$course->id)->get();		
						if($assignments){
						foreach($assignments as $assignment){ ?>
						<tr><td><?php $aname= unserialize($assignment->assignment); 						
						echo $aname['assignment']['name'];
						
						?></td><td>
						<a href="https://docs.google.com/viewer?url=<?php echo asset($aname['assignment']['src']); ?>" target="_blank">  
						 <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
						 </td><td><a href="javascript:courseController.courseAssignmentdelete('<?php echo $assignment->id; ?>')"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>
						</td></tr>
						<?php  } } ?>
						</table>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12">
						<form class="form-horizontal form-label-left" onsubmit="return courseController.adminSaveCourseAssignment('<?php echo (isset($course->id)?$course->id:"")?>','<?php echo (isset($course->course_id)?$course->course_id:"")?>',this)"  enctype="multipart/form-data" method="POST"> 
						<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select file <span class="required">*</span>
						</label>
						<div class="col-md-8 col-sm-8">
						<input type="hidden" name="course_id" value="<?php echo (isset($course->id)?$course->id:"")?>">
						<input type="file" name="assignment" accept=".pdf,.doc"  required="required" class="form-control ">
						</div>
						</div>


						<div class="ln_solid preview"></div>
						<div class="item form-group">
						<div class="col-md-7 col-sm-7 offset-md-4">
						<button type="submit" class="btn btn-success" name="submit">Submit</button>
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
						<?php } } ?>
					    </tbody>
					</table>
					 
					
                  </div>
				  
                </div>
              </div>
            </div>
                </div>
              </div>
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
		<style>
		/* .lms-accordian .paccordion {
		background-color: transparent;
		color: #444;
		cursor: pointer;
		padding: 8px;
		width: 100%;
		border: none;
		margin: 0;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
		}

		.lms-accordian .paccordion:hover {
		background-color: #ccc;
		}

		.lms-accordian .paccordion:after {
		content: '\002B';
		color: #777;
		font-weight: bold;
		float: left;
		margin-right: 5px;
		}

		.paccordion.active:after {
		content: "\2212";
		}

		.panel {
		padding: 0 18px;
		background-color: white;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.2s ease-out;
		} */
		</style>
	 
     @endsection