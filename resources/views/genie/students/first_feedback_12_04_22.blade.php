@extends('genie.layouts.app')
@section('title')
     Feed Back
@endsection
@section('content')	
           
         
        <!-- /top navigation -->
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

        <!-- page content -->
        <div class="right_col padding-student-top" role="main">
          <div class="">            
            <div class="clearfix"></div>			
            <div class="row">
                  <div class="col-md-8">
				  <?php //echo "<pre>";print_r($students); ?>
				  @if(!empty($students))
					  @foreach($students as $student)
					<?php $FB_1 = explode(',',$student->FB_1); ?>	
					@if($student->attendancecount>=2)					
				  <form action="" class="form-horizontal form-label-left content-deliver" onsubmit="return studentsController.firstFeedBacksubmit(this)">
                    <div class="feedback">
                      <div class="first-feedback-heading1 content-deliver-heading1">
                        <h4>First Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
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
                                <span>1. Trainer encouraged active participation</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="hidden" name="std_id" value="<?php echo(isset($student->std_id)?$student->std_id:""); ?>"><input type="radio" name="participation" class="button-rating" value="5" <?php echo ((isset($FB_1[0]) && $FB_1[0]==5)? "checked":"") ?>>5
                                    <input type="radio" name="participation" class="button-rating" value="4" <?php echo ((isset($FB_1[0]) && $FB_1[0]==4)? "checked":"") ?>>4
                                    <input type="radio" name="participation" class="button-rating" value="3" <?php echo ((isset($FB_1[0]) && $FB_1[0]==3)? "checked":"") ?>>3
                                    <input type="radio" name="participation" class="button-rating" value="2" <?php echo ((isset($FB_1[0]) && $FB_1[0]==2)? "checked":"") ?>>2
                                    <input type="radio" name="participation" class="button-rating" value="1" <?php echo ((isset($FB_1[0]) && $FB_1[0]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Trainer’s Preparation/presentation of training</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="preparation" class="button-rating" value="5" <?php echo ((isset($FB_1[1]) && $FB_1[1]==5)? "checked":"") ?>>5
                                    <input type="radio" name="preparation" class="button-rating" value="4" <?php echo ((isset($FB_1[1]) && $FB_1[1]==4)? "checked":"") ?>>4
                                    <input type="radio" name="preparation" class="button-rating" value="3" <?php echo ((isset($FB_1[1]) && $FB_1[1]==3)? "checked":"") ?>>3
                                    <input type="radio" name="preparation" class="button-rating" value="2" <?php echo ((isset($FB_1[1]) && $FB_1[1]==2)? "checked":"") ?>>2
                                    <input type="radio" name="preparation" class="button-rating" value="1" <?php echo ((isset($FB_1[1]) && $FB_1[1]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Trainer’s Knowledge on the technology</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="technology" class="button-rating" value="5" <?php echo ((isset($FB_1[2]) && $FB_1[2]==5)? "checked":"") ?>>5
                                    <input type="radio" name="technology" class="button-rating" value="4" <?php echo ((isset($FB_1[2]) && $FB_1[2]==4)? "checked":"") ?>>4
                                    <input type="radio" name="technology" class="button-rating" value="3" <?php echo ((isset($FB_1[2]) && $FB_1[2]==3)? "checked":"") ?>>3
                                    <input type="radio" name="technology" class="button-rating" value="2" <?php echo ((isset($FB_1[2]) && $FB_1[2]==2)? "checked":"") ?>>2
                                    <input type="radio" name="technology" class="button-rating" value="1" <?php echo ((isset($FB_1[2]) && $FB_1[2]==1)? "checked":"") ?>>1
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
						  
						  
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Hands-On / Activities</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question second-section">
                            <ul>
                              <li>
                                <span>1. Is Trainer taking 2 hours session</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="session" class="button-rating" value="1" <?php echo ((isset($FB_1[3]) && $FB_1[3]==1)? "checked":"") ?>>YES
                                   <input type="radio" name="session" class="button-rating" value="0" <?php echo ((isset($FB_1[3]) && $FB_1[3]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Required software were available for the practical before training starts.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="software" class="button-rating" value="1" <?php echo ((isset($FB_1[4]) && $FB_1[4]==1)? "checked":"") ?>>YES
                                     <input type="radio" name="software" class="button-rating" value="0" <?php echo ((isset($FB_1[4]) && $FB_1[4]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="feedback-sections-one">
                          <div class="feedback-sections-heading">
                            <h4>Education Counsellor</h4>
                            <h4 class="hidden-mobile">Yes/No</h4>
                          </div>
                          <div class="feedback-sections-question third-section">
                            <ul>
                              <li>
                                <span>1. Has counsellor explained you about fee structure.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="feestructure" class="button-rating" value="1" <?php echo ((isset($FB_1[5]) && $FB_1[5]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="feestructure" class="button-rating" value="0" <?php echo ((isset($FB_1[5]) && $FB_1[5]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>2. Is your counsellor providing you batch timing.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                   <input type="radio" name="batchtiming" class="button-rating" value="1" <?php echo ((isset($FB_1[6]) && $FB_1[6]==1)? "checked":"") ?>>YES 
                                    <input type="radio" name="batchtiming" class="button-rating" value="0" <?php echo ((isset($FB_1[6]) && $FB_1[6]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>3. Is your counsellor solving your queries.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="queries" class="button-rating" value="1" <?php echo ((isset($FB_1[7]) && $FB_1[7]==1)? "checked":"") ?>>YES
                                    <input type="radio" name="queries" class="button-rating" value="0" <?php echo ((isset($FB_1[7]) && $FB_1[7]==0)? "checked":"") ?>>NO
                                  </div>
                                </span>
                              </li>
                              <li>
                                <span>4. Does your counsellor provided you all information you wanted.</span>
                                <span>
                                  <div class="btn-group" role="group" aria-label="First group">
                                    <input type="radio" name="information" class="button-rating" value="1"  <?php echo ((isset($FB_1[8]) && $FB_1[8]==1)? "checked":"") ?>>YES
                                   <input type="radio" name="information" class="button-rating" value="0" <?php echo ((isset($FB_1[8]) && $FB_1[8]==0)? "checked":"") ?>>NO
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
                              <li style="border-bottom:0px;">
							  <textarea name="std_first_remark" class="form-control"> {{$student->std_first_remark}}</textarea>                                 
                              </li>                              
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
				 
					<?php 	 				
					if(!empty($student->FB_1)){ ?> 					
					<?php }else{ ?>
					<div class="feedback-submit">
                     <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
                    </div>
					<?php } ?>
					
					 
					</form>
					  @else
                    <div class="feedback content-deliver">
                      <div class="first-feedback-heading1 content-deliver-heading1">
                        <h4>First Feedback <?php if($student->course){ echo '('.$student->course.')'; } ?></h4>
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