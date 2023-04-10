@extends('genie.layouts.app')
@section('title')
   Second Feed Back
@endsection
@section('content')	
     
    <style>
    .button-rating{
    margin: 2px 18px;
    border: 1px solid #c5c5c5;
    background: #fff;
    margin-right: 5px;
    }
    .first-section .btn-group >.help-block {
    color: red;
    font-size: 13px;
    font-weight: 100;
    position: absolute;
    position: absolute !important;
    left: 20px;
    top: 16px;
    color: #ff000052 !important;
    }
    .second-section .btn-group >.help-block {
    color: red;
    font-size: 13px;
    font-weight: 100;
    position: absolute;
    position: absolute !important;
    left: -42px;
    width:193px;
    top: 16px;
    color: #ff0000ab !important;
    }
    .third-section .btn-group >.help-block {
    color: red;
    font-size: 13px;
    font-weight: 100;
    position: absolute;
    position: absolute !important;
    left: -52px;
    width:193px;
    top: 16px;
    color: #ff0000ab !important;
    }
    .btn-primary
    {
    background-color: #13293e;
    border-color: #13293e;
    }
    .btn-primary:hover {
    color: #fff;
    background-color: #13293e;
    border-color: #13293e;
    }
    @media only screen and (max-width: 600px) {
    .second-section .btn-group >.help-block {
    display:block !important;    width: 180px;    left: 0px;
    
    
    }
    .third-section .btn-group >.help-block {
    display:block !important;
    width: 192px;        left: 0px;
    }
    }
    </style>
        <div class="right_col padding-student-top" role="main">
          <div class="">            
            <div class="clearfix"></div>			
            <div class="row">
                   <div class="col-md-8">
				     @if(!empty($students))
					  @foreach($students as $student)
					<?php $FB_2 = explode(',',$student->FB_2); 
					$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$student->courses);					 
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
					$headingcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('heading_id',$course->id)->where('status',1)->count();	
					 
					 
					$contents = App\CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('subcontent_id',$sub->id)->where('status',1)->count();   

					  $lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}					 
					}} 
					}}
					}}
										 
					$totalcousesf= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotalsf= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;
					?>
					@if($completetotalsf > ($totalcousesf/2))
				  <form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.secondFeedBacksubmit(this)">
                    <div class="feedback content-deliver"><div class="first-feedback-heading1 content-deliver-heading1">
                        <h4>Second Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
                      </div><div class="feedback-sections"><div class="feedback-sections-one"><div class="feedback-sections-heading">
                            <h4>Trainer / Facilitator</h4><h4 class="hidden-mobile">Ratings</h4>
                          </div><div class="feedback-sections-question first-section">
                            <ul>
                              <li><span>1. Trainer encouraged active participation</span><span>
                                  <div class="btn-group" role="group" aria-label="First group"> 
									<input type="hidden" name="std_id" value="<?php echo(isset($student->std_id)?$student->std_id:""); ?>">
									<input type="radio" name="participation" value="5" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==5)? "checked":"") ?>>5
									<input type="radio" name="participation" value="4" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==4)? "checked":"") ?>>4
									<input type="radio" name="participation" value="3" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==3)? "checked":"") ?>>3
									<input type="radio" name="participation" value="2" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==2)? "checked":"") ?>>2
									<input type="radio" name="participation" value="1" class="button-rating" <?php echo ((isset($FB_2[0]) && $FB_2[0]==1)? "checked":"") ?>>1
                                  </div></span></li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="preparation" value="5" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==5)? "checked":"") ?>>5
                                    <input type="radio" name="preparation" value="4" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==4)? "checked":"") ?>>4
									<input type="radio" name="preparation" value="3" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==3)? "checked":"") ?>>3
                                    <input type="radio" name="preparation" value="2" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==2)? "checked":"") ?>>2
                                    <input type="radio" name="preparation" value="1" class="button-rating" <?php echo ((isset($FB_2[1]) && $FB_2[1]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==5)? "checked":"") ?>>5
									<input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==4)? "checked":"") ?>>4
                                   <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==3)? "checked":"") ?>>3
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==2)? "checked":"") ?>>2
                                    <input type="radio" name="technology" value="5" class="button-rating" <?php echo ((isset($FB_2[2]) && $FB_2[2]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="queries" value="5" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==5)? "checked":"") ?>>5
                                    <input type="radio" name="queries" value="4" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==4)? "checked":"") ?>>4
                                    <input type="radio" name="queries" value="3" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==3)? "checked":"") ?>>3
                                    <input type="radio" name="queries" value="2" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==2)? "checked":"") ?>>2
                                    <input type="radio" name="queries" value="1" class="button-rating" <?php echo ((isset($FB_2[3]) && $FB_2[3]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Content / Course Outline</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question second-section">
                            <ul>
                              <li>
                                <span>1. Is Trainer sharing the notes/study material</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="material" value="1" class="button-rating" <?php echo ((isset($FB_2[4]) && $FB_2[4]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="material" value="0" class="button-rating" <?php echo ((isset($FB_2[4]) && $FB_2[4]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed is helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="helpful" value="1" class="button-rating" <?php echo ((isset($FB_2[5]) && $FB_2[5]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="helpful" value="0" class="button-rating" <?php echo ((isset($FB_2[5]) && $FB_2[5]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The content is organized and easy to follow</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="organized" value="1" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="organized" value="0" class="button-rating" <?php echo ((isset($FB_2[6]) && $FB_2[6]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Counselling, Placement & Activities</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question third-section">
                            <ul>
                              <li>
                                <span>1. Are you performing Practical/activities during training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="practical" value="1" class="button-rating" <?php echo ((isset($FB_2[7]) && $FB_2[7]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="practical" value="0" class="button-rating" <?php echo ((isset($FB_2[7]) && $FB_2[7]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Course Status Has Trainer covered 50% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="curriculum" value="1" class="button-rating" <?php echo ((isset($FB_2[8]) && $FB_2[8]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="curriculum" value="0" class="button-rating" <?php echo ((isset($FB_2[8]) && $FB_2[8]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="solving" value="1" class="button-rating" <?php echo ((isset($FB_2[9]) && $FB_2[9]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="solving" value="0" class="button-rating" <?php echo ((isset($FB_2[9]) && $FB_2[9]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="information" value="1" class="button-rating" <?php echo ((isset($FB_2[10]) && $FB_2[10]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="information" value="0" class="button-rating" <?php echo ((isset($FB_2[10]) && $FB_2[10]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="interacting" value="1" class="button-rating" <?php echo ((isset($FB_2[11]) && $FB_2[11]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="interacting" value="0" class="button-rating" <?php echo ((isset($FB_2[11]) && $FB_2[11]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Remark</h4>
                            
                          </div>
                          <div class="feedback-sections-question">
                            <ul>
                              <li>
							  <textarea name="std_second_remark" class="form-control"> {{$student->std_second_remark}}</textarea>                                 
                              </li>                              
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
					@if($student->first_feed=='1')
					<?php 	 				
					if(!empty($student->FB_2)){ ?> 					
					<?php }else{ ?>
					<div class="feedback-submit">
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
                    </div>
					<?php } ?>					
                     @endif
					 </form>
					 
					  @else
                    <div class="feedback content-deliver">
                      <div class="first-feedback-heading1 content-deliver-heading1">
                        <h4>Second Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
                      </div>
                      <div class="feedback-sections">
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Trainer has not initiated the feedback</h4>
                             
                          </div>
						  
						  </div>
						  </div>
					</div>
					@endif
					 
					@endforeach
					@endif
                  </div>
                  
                     @include('genie.layouts.sidebar_form')
            </div>
          </div>
        </div>
		<script>
       function hideA(x) {
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
    </script>
         
	@endsection