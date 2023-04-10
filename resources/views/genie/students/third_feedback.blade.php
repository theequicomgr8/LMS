@extends('genie.layouts.app')
@section('title')
     Feed Back
@endsection
@section('content')	
           
   <style>
    .button-rating{margin: 2px 18px;border: 1px solid #c5c5c5;background: #fff;margin-right: 5px;}
    .first-section .btn-group >.help-block {color: red;font-size: 13px;font-weight: 100;position: absolute;position: absolute !important;left: 20px;top: 16px;color: #ff000052 !important;    }
    .second-section .btn-group >.help-block {color: red;font-size: 13px;font-weight: 100;position: absolute;position: absolute !important;left: -42px;width:193px;top: 16px;color: #ff0000ab !important;}
    .third-section .btn-group >.help-block {color: red;font-size: 13px;font-weight: 100;position: absolute;position: absolute !important;left: -52px;width:193px;top: 16px;color: #ff0000ab !important;}
    .btn-primary{background-color: #13293e;border-color: #13293e;}
    .btn-primary:hover {color: #fff;background-color: #13293e;border-color: #13293e;}
    @media only screen and (max-width: 600px) {.second-section .btn-group >.help-block {display:block !important;    width: 180px;    left: 0px;}
    .third-section .btn-group >.help-block {display:block !important; width: 192px;        left: 0px;}
    }
    </style>

        <!-- page content -->
        <div class="right_col padding-student-top"  role="main">
          <div class="">            
            <div class="clearfix"></div>			
            <div class="row">
                   
				    <div class="col-md-8">
					 @if(!empty($students))
					  @foreach($students as $student)
					<?php $FB_3 = explode(',',$student->FB_3); 	
					
					
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
					$headingcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('heading_id',$course->id)->count();	
					 
					 
					$contents = App\CoursesContent::where('heading_id',$course->id)->get();
					$contentstotal += $contents->count();

					if($contents){	
					foreach($contents as $content){
					$contentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('content_id',$content->id)->count();
					 
					$subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
					$subcontentstotal +=$subcontents->count();
					if($subcontents){										
					foreach($subcontents as $sub){
					$subcontentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('subcontent_id',$sub->id)->count();   

					  $lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
					$lastcontentstotal +=$lastcontents->count();
					if($lastcontents){										
					foreach($lastcontents as $last){
					$lastcontentcomplete += App\CoursesComplete::where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('lastcontent_id',$last->id)->count();  
					}}					 
					}} 
					}}
					}}
										 
					$totalcousetf= $headingtotal+$contentstotal +$subcontentstotal +$lastcontentstotal;
					$completetotaltf= $headingcomplete+$contentcomplete +$subcontentcomplete +$lastcontentcomplete;
					 					
					?>
					
					@if($completetotaltf== $totalcousetf)
				   <form action="" class="form-horizontal form-label-left" onsubmit="return studentsController.thirdFeedBacksubmit(this)">
                    <div class="feedback content-deliver">
                      <div class="first-feedback-heading1 content-deliver-heading1 ">
                        <h4>Third Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
                      </div>
                      <div class="feedback-sections">
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Trainer / Facilitator</h4>
                            <h4 class="hidden-mobile">Ratings</h4>
                          </div>
                          <div class="feedback-sections-question first-section">
                            <ul>
                              <li>
                                <span>1. The training met your expectations</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
								     <input type="hidden" name="std_id" value="<?php echo(isset($student->std_id)?$student->std_id:""); ?>"><input type="radio" name="expectations" class="button-rating" value="5" <?php echo ((isset($FB_3[0]) && $FB_3[0]==5)? "checked":"") ?>>5
                                    <input type="radio" name="expectations" value="4" class="button-rating" <?php echo ((isset($FB_3[0]) && $FB_3[0]==4)? "checked":"") ?>>4
									<input type="radio" name="expectations" value="3" class="button-rating" <?php echo ((isset($FB_3[0]) && $FB_3[0]==3)? "checked":"") ?>>3
                                    <input type="radio" name="expectations" value="2" class="button-rating" <?php echo ((isset($FB_3[0]) && $FB_3[0]==2)? "checked":"") ?>>2
                                    <input type="radio" name="expectations" value="1" class="button-rating" <?php echo ((isset($FB_3[0]) && $FB_3[0]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. The training materials distributed were helpful</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="helpful" value="5" class="button-rating" <?php echo ((isset($FB_3[1]) && $FB_3[1]==5)? "checked":"") ?>>5
                                   <input type="radio" name="helpful" value="4" class="button-rating" <?php echo ((isset($FB_3[1]) && $FB_3[1]==4)? "checked":"") ?>>4
                                   <input type="radio" name="helpful" value="3" class="button-rating" <?php echo ((isset($FB_3[1]) && $FB_3[1]==3)? "checked":"") ?>>3
                                    <input type="radio" name="helpful" value="2" class="button-rating" <?php echo ((isset($FB_3[1]) && $FB_3[1]==2)? "checked":"") ?>>2
                                    <input type="radio" name="helpful" value="1" class="button-rating" <?php echo ((isset($FB_3[1]) && $FB_3[1]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="participation" value="5" class="button-rating" <?php echo ((isset($FB_3[2]) && $FB_3[2]==5)? "checked":"") ?>>5
                                    <input type="radio" name="participation" value="4" class="button-rating" <?php echo ((isset($FB_3[2]) && $FB_3[2]==4)? "checked":"") ?>>4
									<input type="radio" name="participation" value="3" class="button-rating" <?php echo ((isset($FB_3[2]) && $FB_3[2]==3)? "checked":"") ?>>3
                                    <input type="radio" name="participation" value="2" class="button-rating" <?php echo ((isset($FB_3[2]) && $FB_3[2]==2)? "checked":"") ?>>2
                                    <input type="radio" name="participation" value="1" class="button-rating" <?php echo ((isset($FB_3[2]) && $FB_3[2]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Trainer’s ability to resolve queries</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="queries" value="5" class="button-rating" <?php echo ((isset($FB_3[3]) && $FB_3[3]==5)? "checked":"") ?>>5
                                    <input type="radio" name="queries" value="4" class="button-rating" <?php echo ((isset($FB_3[3]) && $FB_3[3]==4)? "checked":"") ?>>4
                                    <input type="radio" name="queries" value="3" class="button-rating" <?php echo ((isset($FB_3[3]) && $FB_3[3]==3)? "checked":"") ?>>3
                                    <input type="radio" name="queries" value="2" class="button-rating" <?php echo ((isset($FB_3[3]) && $FB_3[3]==2)? "checked":"") ?>>2
                                    <input type="radio" name="queries" value="1" class="button-rating" <?php echo ((isset($FB_3[3]) && $FB_3[3]==1)? "checked":"") ?>>1
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
                                <span>1. Does your Trainer helped you in resume designing</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="designing" value="1" class="button-rating" <?php echo ((isset($FB_3[4]) && $FB_3[4]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="designing" value="0" class="button-rating" <?php echo ((isset($FB_3[4]) && $FB_3[4]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Does Trainer provided you Interview questions & tips</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="questions" value="1" class="button-rating" <?php echo ((isset($FB_3[5]) && $FB_3[5]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="questions" value="0" class="button-rating" <?php echo ((isset($FB_3[5]) && $FB_3[5]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. The time allotted for the training was sufficient.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="sufficient" value="1" class="button-rating" <?php echo ((isset($FB_3[6]) && $FB_3[6]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="sufficient" value="0" class="button-rating" <?php echo ((isset($FB_3[6]) && $FB_3[6]==0)? "checked":"") ?>>NO
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
                                <span>1. Practical/activities performed were sufficient as per Course Content</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="performed" value="1" class="button-rating" <?php echo ((isset($FB_3[7]) && $FB_3[7]==1)? "checked":"") ?>>YES
                                   <input type="radio" name="performed" value="0" class="button-rating" <?php echo ((isset($FB_3[7]) && $FB_3[7]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Has Trainer covered 100% of the curriculum</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="curriculum" value="1" class="button-rating" <?php echo ((isset($FB_3[8]) && $FB_3[8]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="curriculum" value="0" class="button-rating" <?php echo ((isset($FB_3[8]) && $FB_3[8]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Has Placement cell gathered your educational/technical data</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="technical" value="1" class="button-rating" <?php echo ((isset($FB_3[9]) && $FB_3[9]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="technical" value="0" class="button-rating" <?php echo ((isset($FB_3[9]) && $FB_3[9]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Has you mockup interviews been conducted</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="conducted" value="1" class="button-rating" <?php echo ((isset($FB_3[10]) && $FB_3[10]==1)? "checked":"") ?>>YES</button>
                                   <input type="radio" name="conducted" value="0" class="button-rating" <?php echo ((isset($FB_3[10]) && $FB_3[10]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>5. Is Placement Cell interacting with you</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="interacting" value="1" class="button-rating" <?php echo ((isset($FB_3[11]) && $FB_3[11]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="interacting" value="0" class="button-rating" <?php echo ((isset($FB_3[11]) && $FB_3[11]==0)? "checked":"") ?>>NO 
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
							  <textarea name="std_third_remark" class="form-control"> {{$student->std_third_remark}}</textarea>                                 
                              </li>                              
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
						@if($student->first_feed=='2')
					<?php 	 				
					if(!empty($student->FB_3)){ ?> 					
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
                        <h4>Third Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
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