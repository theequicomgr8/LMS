@extends('genie.layouts.app')
@section('title')
Feed Back
@endsection
@section('content')
 

<!-- /top navigation -->
<style>
  .button-rating {
    margin: 2px 18px;
    border: 1px solid #c5c5c5;
    background: #fff;
    margin-right: 5px;
  }
	
  .new-feedback .item .help-block{
    color: red !important;
	filter: none !important;
    font-size: 13px !important;
    font-weight: 100;
    position: absolute;
    left: 0;
	margin:35px;
  }
  .feedback-activities label{display:inline; zoom: 1.3;
    padding:0 28px 0 0;}
  .feedback-activities .help-block {position: absolute; font-size: 10px !important; left:117px; margin-left:-100px; margin-top:16px;}
  


  .second-section .btn-group>.help-block {
    color: red;
    font-size: 13px;
    font-weight: 100;
    position: absolute;
    position: absolute !important;
    left: -42px;
    width: 193px;
    top: 16px;
    color: #ff0000ab !important;
  }

  .third-section .btn-group>.help-block {
    color: red;
    font-size: 13px;
    font-weight: 100;
    position: absolute;
    position: absolute !important;
    left: -52px;
    width: 193px;
    top: 16px;
    color: #ff0000ab !important;
  }

  .btn-primary {
    background-color: #13293e;
    border-color: #13293e;
  }

  .btn-primary:hover {
    color: #fff;
    background-color: #13293e;
    border-color: #13293e;
  }

  @media only screen and (max-width: 600px) {
    .second-section .btn-group>.help-block {
      display: block !important;
      width: 180px;
      left: 0px;


    }

    .third-section .btn-group>.help-block {
      display: block !important;
      width: 192px;
      left: 0px;
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
        	<?php $k=0; ?>
        @foreach($students as $student)
        <?php 
        
       // echo "<pre>";print_r($student);
        
        $FB_1 = explode(',',$student->FB_1);
        
       
        ?>
        
         <?php $k++;
			   
			   if($k=='1'){
			       
			       $calscolor="first";
			        $colorclass="color1";
			       
			   }else if($k=='2'){
			       
			       $calscolor="second";
			        $colorclass="color2";
			   }else if($k=='3'){
			       
			        $calscolor="third";
			         $colorclass="color3";
			   }else if($k=='4'){
			       
			        $calscolor="four";
			         $colorclass="color4";
			   }else if($k=='5'){
			       
			         $calscolor="five";
			          $colorclass="color5";
			   }else if($k=='6'){
			       
			         $calscolor="six";
			          $colorclass="color6";
			   }else if($k=='7'){
			         $calscolor="seven";
			          $colorclass="color7";
			       
			   }else if($k=='8'){
			         $calscolor="eight";
			          $colorclass="color8";
			   }else if($k=='9'){
			       
			         $calscolor="nine";
			          $colorclass="color9";
			   }
			   ?>
       
        
        <!--============New Feed Back ================-->
        <div class="new-feedback2">
          <div class="row">
            <div class="col-lg-2 item1 <?php echo $calscolor; ?>">
              <img src="{{asset('img/feebback1.png')}}" alt="feebback1">             
            </div>
            <div class="col-lg-7 col-sm-12 item2">
              <h2><?php if($student->course){ echo $student->course; } ?></h2>
              <p class="batch"><?php if($student->batch_name){ echo $student->batch_name; } else{  echo "N/A"; } ?></p>
              <div style="width:100%; height:1px; background:#ddd;  margin:10px 0"></div>
              <div class="arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
              <p class="feed openform_<?php echo $k; ?>">Please give feedback for the training.</p>
            </div>
           
            <div class="col-lg-3 col-sm-12 item3 <?php echo $colorclass; ?>">
              <div class="feedend">
                <img src="{{asset('img/feedback2.png')}}" alt="feebback2">
               <button class="openform_<?php echo $k; ?>">Give Feedback</button>
              </div>
            </div>
          </div>
        <form action="" class="form-horizontal form-label-left content-deliver formopend_<?php echo $k; ?>"
          onsubmit="return studentsController.firstFeedBacksubmit(this)" style="display:none; box-shadow: unset; border-radius: unset; padding-top: 20px;">
          <div class="feedback">
            <div class="first-feedback-heading1 content-deliver-heading1">
              <h4>Give Feedback
                <span style="font-size:17px;"><?php if($student->course){ echo '('.$student->course.')'; } ?></span>
              </h4>
              <div class="d-flex ml-1">
                <div class="devider1"></div>
                <div class="devider2"></div>
              </div>
            </div>
            <div class="feedback-sections">
              <div class="feedback-sections-one">
                <div class="feedback-sections-heading">
                  <h4>Trainer / Facilitator</h4>
                </div>
                <h3 class="feedback-que">Trainer encouraged active participation?</h3>
                <div class="new-feedback">
                  <div class="item">
                    <label for="0_<?php echo $k; ?>">
						<input type="hidden" name="std_id" value="<?php echo(isset($student->std_id)?$student->std_id:""); ?>">
						<input class="radio" type="radio" name="participation" id="0_<?php echo $k; ?>" value="1" <?php echo ((isset($FB_1[0]) && $FB_1[0]==1)? "checked":"") ?>>
                      <span>😡</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="1_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="participation" id="1_<?php echo $k; ?>" value="2" <?php echo ((isset($FB_1[0]) && $FB_1[0]==2)? "checked":"") ?>>
                      <span>🙁</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="2_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="participation" id="2_<?php echo $k; ?>" value="3" <?php echo ((isset($FB_1[0]) && $FB_1[0]==3)? "checked":"") ?>>
                      <span>😐</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="3_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="participation" id="3_<?php echo $k; ?>" value="4" <?php echo ((isset($FB_1[0]) && $FB_1[0]==4)? "checked":"") ?>>
                      <span>🙂</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="4_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="participation" id="4_<?php echo $k; ?>" value="5" <?php echo ((isset($FB_1[0]) && $FB_1[0]==5)? "checked":"") ?>>
                      <span>😍</span>
                    </label>
                  </div>
                </div>

                <h3 class="feedback-que">Trainer’s Preparation/presentation of training?</h3>
                <div class="new-feedback">
                  <div class="item">
                    <label for="5_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="preparation" id="5_<?php echo $k; ?>" value="1" <?php echo ((isset($FB_1[1]) && $FB_1[1]==1)? "checked":"") ?>>
                      <span>😡</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="6_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="preparation" id="6_<?php echo $k; ?>" value="2" <?php echo ((isset($FB_1[1]) && $FB_1[1]==2)? "checked":"") ?>>
                      <span>🙁</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="7_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="preparation" id="7_<?php echo $k; ?>" value="3" <?php echo ((isset($FB_1[1]) && $FB_1[1]==3)? "checked":"") ?>>
                      <span>😐</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="8_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="preparation" id="8_<?php echo $k; ?>" value="4" <?php echo ((isset($FB_1[1]) && $FB_1[1]==4)? "checked":"") ?>>
                      <span>🙂</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="9_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="preparation" id="9_<?php echo $k; ?>" value="5" <?php echo ((isset($FB_1[1]) && $FB_1[1]==5)? "checked":"") ?>>
                      <span>😍</span>
                    </label>
                  </div>
                </div>

                <h3 class="feedback-que">Trainer’s Knowledge on the technology?</h3>
                <div class="new-feedback">
                  <div class="item">
                    <label for="10_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="technology" id="10_<?php echo $k; ?>" value="1" <?php echo ((isset($FB_1[2]) && $FB_1[2]==1)? "checked":"") ?>>
                      <span>😡</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="11_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="technology" id="11_<?php echo $k; ?>" value="2" <?php echo ((isset($FB_1[2]) && $FB_1[2]==2)? "checked":"") ?>>
                      <span>🙁</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="12_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="technology" id="12_<?php echo $k; ?>" value="3" <?php echo ((isset($FB_1[2]) && $FB_1[2]==3)? "checked":"") ?>>
                      <span>😐</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="13_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="technology" id="13_<?php echo $k; ?>" value="4" <?php echo ((isset($FB_1[2]) && $FB_1[2]==4)? "checked":"") ?>>
                      <span>🙂</span>
                    </label>
                  </div>

                  <div class="item">
                    <label for="14_<?php echo $k; ?>">
                      <input class="radio" type="radio" name="technology" id="14_<?php echo $k; ?>" value="5" <?php echo ((isset($FB_1[2]) && $FB_1[2]==5)? "checked":"") ?>>
                      <span>😍</span>
                    </label>
                  </div>
                </div>

              </div>
              <div class="feedback-sections-one">
                <div class="feedback-sections-heading">
                  <h4>Hands-On / Activities</h4>
                </div>
                <h3 class="feedback-que">Is Trainer taking 2 hours session?</h3>
                <div class="feedback-activities">
                  <label for="yes1">
                    <input type="radio" id="yes1" name="session" value="1" <?php echo ((isset($FB_1[3]) && $FB_1[3]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no1">
                    <input type="radio" id="no1" name="session" value="0" <?php echo ((isset($FB_1[3]) && $FB_1[3]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>

                <h3 class="feedback-que">Required software were available for the practical before training starts.</h3>
                <div class="feedback-activities">
                  <label for="yes2">
                    <input type="radio" id="yes2" name="software" value="1" <?php echo ((isset($FB_1[4]) && $FB_1[4]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no2">
                    <input type="radio" id="no2" name="software" value="0" <?php echo ((isset($FB_1[4]) && $FB_1[4]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>
                
              </div>
              <div class="feedback-sections-one">
                <div class="feedback-sections-heading">
                  <h4>Education Counsellor</h4>
                </div>
                <h3 class="feedback-que">Has counsellor explained you about fee structure?</h3>
                <div class="feedback-activities">
                  <label for="yes3">
                    <input type="radio" id="yes3" name="feestructure" value="1" <?php echo ((isset($FB_1[5]) && $FB_1[5]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no3">
                    <input type="radio" id="no3" name="feestructure" value="0" <?php echo ((isset($FB_1[5]) && $FB_1[5]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>

                <h3 class="feedback-que">Is your counsellor providing you batch timing?</h3>
                <div class="feedback-activities">
                  <label for="yes4">
                    <input type="radio" id="yes4" name="batchtiming" value="1" <?php echo ((isset($FB_1[6]) && $FB_1[6]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no4">
                    <input type="radio" id="no4" name="batchtiming" value="0" <?php echo ((isset($FB_1[6]) && $FB_1[6]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>

                <h3 class="feedback-que">Is your counsellor solving your queries?</h3>
                <div class="feedback-activities">
                  <label for="yes5">
                    <input type="radio" id="yes5" name="queries" value="1" <?php echo ((isset($FB_1[7]) && $FB_1[7]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no5">
                    <input type="radio" id="no5" name="queries" value="0" <?php echo ((isset($FB_1[7]) && $FB_1[7]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>

                <h3 class="feedback-que">Does your counsellor provided you all information you wanted?</h3>
                <div class="feedback-activities">
                  <label for="yes6">
                    <input type="radio" id="yes6" name="information" value="1" <?php echo ((isset($FB_1[8]) && $FB_1[8]==1)? "checked":"") ?>>
                    <span>Yes</span> </label>
                  <label for="no6">
                    <input type="radio" id="no6" name="information" value="0" <?php echo ((isset($FB_1[8]) && $FB_1[8]==0)? "checked":"") ?>>
                    <span>No</span> </label>
                </div>

              </div>

              <div class="feedback-sections-one">
                <div class="feedback-sections-heading" style="border-bottom: none;}">
                  

                </div>
                <div class="feedback-sections-question" style="width: 106%; background: #efefef; margin-left: -20px; max-height: 250px; padding:22px 0;">
                  <h4 style="padding: 0 19px; margin:0; font-size: 18px; color: #347CEA; letter-spacing: .5px;">Anything that can be improved?</h4>
              <div class="d-flex ml-1" style="padding: 0 18px">
                <div style="width: 100px;
    height: 3px;
    background-color: #707070;
    margin: 5px 3px 5px 0 !important;
    border-radius: 10px;"></div>
                <div style="width: 40px;
    height: 3px;
    background-color: #347CEA;
    margin: 5px 0 !important;
    border-radius: 10px;"></div>
              </div>
                  <ul>
                    <li style="border-bottom:0px; margin-left:-13px; margin-top:-7px;">
                      <textarea name="std_first_remark" class="form-control" style="height:100px;">{{$student->std_first_remark}} </textarea>
                    </li>
                  </ul>
                  <?php 	 				
					if(!empty($student->FB_1)){ ?>
          <?php }else{ ?>
          <div class="feedback-submit">
            <button class="btn btn-primary" type="reset">Reset</button>
            <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
          </div>
          <?php } ?> 
                </div>
              </div>
            </div>
          </div>
          


        </form>
        </div>
       
        @endforeach
        @endif

      </div>


      @include('genie.layouts.sidebar_form')
    </div>


  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function(){
        $(".openform_1").click(function(){

        $(".formopend_1").fadeToggle("2000");

        });
        
        
        $(".openform_2").click(function(){

        $(".formopend_2").fadeToggle("2000");

        });
        
        
        $(".openform_3").click(function(){

        $(".formopend_3").fadeToggle("2000");

        });
        
        
        
        $(".openform_4").click(function(){

        $(".formopend_4").fadeToggle("2000");

        });
        
        $(".openform_5").click(function(){

        $(".formopend_5").fadeToggle("2000");

        });
        
        
        });
        </script>
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