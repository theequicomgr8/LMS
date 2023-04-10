@extends('genie.layouts.app')
@section('title')
Course Content
@endsection
@section('content')
<style>
  .btn-primary {background-color: #13293e;border-color: #13293e;}
  .btn-primary:hover {color: #fff;background-color: #13293e;border-color: #13293e;}
  .x_content h4 {margin-bottom: 0px;}
  </style>
<div class="right_col padding-student-top" role="main">
  <div class=""><div class="clearfix"></div><div class="row">
  <div class="col-md-8">
    @if(!empty($students))
    <?php $i=0; ?>
    <?php $k=0; ?>
    @foreach($students as $student)
    <?php $k++;
    
    if($k=='1'){
    
    $calscolor="one";
    }else if($k=='2'){
    
    $calscolor="two";
    }else if($k=='3'){
    
    $calscolor="three";
    }else if($k=='4'){
    
    $calscolor="fours";
    }else if($k=='5'){
    
    $calscolor="fives";
    }else if($k=='6'){
    
    $calscolor="six";
    }else if($k=='7'){
    $calscolor="seven";
    
    }else if($k=='8'){
    $calscolor="eight";
    }else if($k=='9'){
    
    $calscolor="nine";
    }
    ?>
    <?php  $i++; ?>
        <div class="content-deliver"><div class="content-deliver-heading1"><div class="row new-course-dtl"><div class="col-md-2 col-sm-12 <?php echo $calscolor; ?>"><div class="batch-icon"><img src="{{asset('/img/course-icon.png')}}" alt="dummyimg" style="padding:3px 10px;">
        </div></div><div class="col-md-7 col-sm-12">
			  <?php 
                $headinghed = DB::table('courses_heading as heading');		 
                $headinghed= $headinghed->where('course_id',$student->courses); 
                $headinghed= $headinghed->get();
                
                /*$headinghed=cache()->remember('heading',60*60*24,function(){
                	return DB::table('courses_heading as heading')->where('course_id',$student->courses)->get();		 
                });*/
                   
					$headingtotalhed =$headinghed->count();					 
					if(!empty($headinghed)){	
					$headingcompletehed=0;
					$contentstotalhed=0;
					$contentcompletehed=0;
					$subcontentstotalhed=0;
					$subcontentcompletehed=0;
					$lastcontentstotalhed=0;
					$lastcontentcompletehed=0;
					foreach($headinghed as $course){						 
					$headingcompletehed += DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('heading_id',$course->id)->where('status',1)->count();	
					
					/*$headingcompletehed=cache()->remember('courses_complete',60*60*24,function(){
                    	return $headingcompletehed += DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('heading_id',$course->id)->where('status',1)->count();		 
                    }); */
					 
					$contentshed = App\CoursesContent::where('heading_id',$course->id)->get();
					/*$contentshed=cache()->remember('CoursesContent',60*60*24,function(){
					   return App\CoursesContent::where('heading_id',$course->id)->get(); 
					});*/ 
					$contentstotalhed += $contentshed->count();

					if($contentshed){	
					foreach($contentshed as $content){
					$contentcompletehed += DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('content_id',$content->id)->where('status',1)->count();
					 
					$subcontentshed = App\CoursesSubContent::where('content_id',$content->id)->get();
					/*$subcontentshed=cache()->remember('CoursesSubContent',60*60*24,function(){
					   return App\CoursesSubContent::where('content_id',$content->id)->get();
					}); */
					
					$subcontentstotalhed +=$subcontentshed->count();
					if($subcontentshed){										
					foreach($subcontentshed as $sub){
					$subcontentcompletehed += DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('subcontent_id',$sub->id)->where('status',1)->count(); 
                    
					$lastcontentshed = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
					
					/*$lastcontentshed=cache()->remember('CoursesLastContent',60*60*24,function(){
					   return App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
					});*/
					
					$lastcontentstotalhed +=$lastcontentshed->count();
					if($lastcontentshed){										
					foreach($lastcontentshed as $last){
					$lastcontentcompletehed += DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('lastcontent_id',$last->id)->where('status',1)->count();  
					}}
					}} 
					}}
					}}
					$totalcousehed= $headingtotalhed+$contentstotalhed +$subcontentstotalhed +$lastcontentstotalhed;
					$completetotalhed= $headingcompletehed+$contentcompletehed +$subcontentcompletehed +$lastcontentcompletehed;
					$stud_c_per= intval(($completetotalhed*100)/$totalcousehed);
						 
					 
			  ?>
                <h4> <p class="strong-headin2" title="<?php  if($student->course){ echo $student->course; } ?>"><strong style="color: #347cea; font-weight: 500;font-size: 20px;"><?php if($student->course){ echo $student->course; }else { echo "N/A" ;	} ?></strong></p></h4>
                <div class="d-flex courseicon">
                   <ul><li><i class="fa fa-book" aria-hidden="true"></i> Latest Curriculum </li>&nbsp;<li> <i class="fa fa-code" aria-hidden="true"></i> Capstone Project </li>&nbsp;
                       <li> <i class="fa fa-male" aria-hidden="true"></i> Industry Trainers </li>
                   </ul>
                </div>
                <ul class="cousetpc">
                <li>  Total Topics <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php if($totalcousehed){ echo $totalcousehed; }else { echo "0" ;	} ?> </span> </li>
                <li>  Topics Covered <span style=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php if($completetotalhed){ echo $completetotalhed; }else { echo "0" ;	} ?> </span> </li>
               <li>  Course Completed <span style="">&nbsp;: <?php if($stud_c_per){ echo $stud_c_per; }else { echo "0" ;	} ?>%  </span> </li>
                </ul>
              </div>
              <div class="col-md-3 col-sm-12">
                 <canvas id="chart_<?php echo $k;?>"></canvas>
				<script>
					setTimeout(function() {
					var doughnut = document.getElementById("chart_<?php echo $k;?>") .getContext("2d");
					var myDoughnutChart = new Chart(doughnut, {
                        type: 'doughnut',
                        data: {
                        labels:["Topic","Covered", "Completed"],
                        datasets: [{
                            label: "My First dataset",
                            data: [<?php echo $totalcousehed; ?>,<?php echo $completetotalhed;?>, <?php echo $stud_c_per; ?>],
                            backgroundColor: ['#3175DE','#f0a500','#fc4f4f'],
                            borderColor: ['#3175DE','#f0a500','#fc4f4f']
                         }]
                       },
                      options: {
                        plugins:{   
                                 legend: {
                                   display: false
                                         },
                                      },
                                      cutoutPercentage: 70
                    
                      }

                });
					}, 1000);
            </script>
                 <button type="btn" class="click-course-dtl<?php echo $i; ?> clickto-check" style="margin-top: 4px; border-radius:0px;">View Details</button>

              </div>

            </div>

          </div>
          <div class="open-course-dtl<?php echo $i; ?> col-12 mt-3" style="display: <?php if($i==1){ echo "block"; } ?>;">  		 
			 
					
                    <div class="content-deliver">
                     
                      <div class="content-deliver-sections">
					<?php   
					$heading = DB::table('courses_heading as heading');				 
					$heading= $heading->where('course_id',$student->courses);
					$heading= $heading->get();  
					
					/*$heading=cache()->remember('courses_heading_',60*60*24,function(){
					   return DB::table('courses_heading as heading')->where('course_id',$student->courses)->get();
					});*/
					if(!empty($heading)){	
					    $k=0;
						foreach($heading as $course){
						    $k++;
					$headingcomplete = DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('heading_id',$course->id)->first();
					
					?>
					<div class="acc-panel-pan">
                        <button class="accordion-lms" >
                          <strong>
							<?php if((isset($headingcomplete->status) && $headingcomplete->status==1)){ ?>
							<del><?php echo '<span title="'.str_replace('?','',$course->heading).'">'.substr(str_replace('?','',$course->heading),0,50).'</span>..'; ?></del> <span style="font-size: 12px;font-weight: 500;"><?php if(!empty($headingcomplete->heading_date)){ echo '('.date('d M Y H:i:s',strtotime($headingcomplete->heading_date)).')'; } ?> </span>
							<?php }else{ ?>
							<?php echo '<span title="'.str_replace('?','',$course->heading).'">'.substr(str_replace('?','',$course->heading),0,50).'</span>..'; ?>
							<?php } ?>
							</strong> 
							   
                          
                     </button>
                        <div class="panel">
                          <ul>
						  <?php 
						  
						  $contents = App\CoursesContent::where('heading_id',$course->id)->get();
		
								if($contents){	
								foreach($contents as $content){
								$contentcomplete = DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('content_id',$content->id)->first();
							 
								?>
							 
								<li><?php if(!empty($contentcomplete->status) && $contentcomplete->status==1){ ?><del><?php echo str_replace('?','',$content->coursescontent); ?></del> <span style="font-size: 12px;font-weight: 500;"><?php if(!empty($contentcomplete->content_date)){ echo '('.date('d M Y H:i:s',strtotime($contentcomplete->content_date)).')'; } ?> </span><?php }else{ ?> <?php echo str_replace('?','',$content->coursescontent); ?> <?php } ?> </li>
									
								<?php $subcontents = App\CoursesSubContent::where('content_id',$content->id)->get();
								 
									if($subcontents){										
									foreach($subcontents as $sub){
										$subcontentcomplete = DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('subcontent_id',$sub->id)->first();  ?>
                              <ul>
                                <li> <?php if(!empty($subcontentcomplete->status) && $subcontentcomplete->status==1){  ?> <del> <?php echo str_replace('?','',$sub->subcontent); ?></del>  <span style="font-size: 12px;font-weight: 500;"><?php if(!empty($subcontentcomplete->subcontent_date)){ echo '('.date('d M Y H:i:s',strtotime($subcontentcomplete->subcontent_date)).')'; } ?> </span><?php }else{ ?> <?php echo str_replace('?','',$sub->subcontent); ?> <?php  } ?> </li>
                                  	<?php $lastcontents = App\CoursesLastContent::where('subcontent_id',$sub->id)->get();
										if($lastcontents){										
										foreach($lastcontents as $last){
											$lastcontentcomplete = DB::table('courses_complete')->where('batch_id',$student->stud_batch_id)->where('trainer_id',$student->trainer)->where('course_id',$student->courses)->where('lastcontent_id',$last->id)->first();  ?>
								  
								  <ul>
                                    <li><?php if(!empty($lastcontentcomplete->status) && $lastcontentcomplete->status==1){ ?><del> 
									<?php echo str_replace('?','',$last->lastcontent); ?>
									</del><span style="font-size: 12px;font-weight: 500;"> <?php if($lastcontentcomplete->lastcontent_date){ echo '('.date('d M Y H:i:s',strtotime($lastcontentcomplete->lastcontent_date)).')'; } ?></span> <?php  }else{ ?>  <?php  echo str_replace('?','',$last->lastcontent);  ?><?php } ?></li>
                                  </ul>
										<?php  } } ?>
                             
                                
                              </ul>
							  
									<?php } } ?>
								<?php  } } ?>
                          </ul>
                        </div>
						 
					</div>
					<?php }  } ?>
                        
						 
						
                      </div>
                    </div>
					
					 
			 
                  
            </div>
          
        </div>
		@endforeach
				@endif
        
       
        
      </div>

      <style>
    .open-course-dtl1, .open-course-dtl2, .open-course-dtl3 {display:none; padding-bottom:1px;}
    .content-deliver-heading1{padding:0;}
    .new-course-dtl .col-md-2 {display: flex; align-items: center; justify-content: center; zoom: 2; padding:8px 0;}
    .new-course-dtl .col-md-3 {display: flex; align-items: center; justify-content: center; flex-direction: column;}
    .new-course-dtl .col-md-7{display: flex; flex-direction: column; justify-content: center;}
    .new-course-dtl{margin:0;}
    .new-course-dtl .col-md-7 p { margin: 0px; color: #767373; padding: 1px 0;}
    .new-course-dtl .col-md-2 img{max-width:100%;}
    .new-course-dtl .col-md-3 a {
    background: linear-gradient(45deg, #3876F1, #1C19B0); padding: 7px 15px; color: #fff; border-radius: 4px;}
    .acc-panel-pan {position: relative;margin-bottom: 9px;border: 1px solid #dbdbdb;}
    .download-icon { position: absolute; right: 15px;top: 11px;}
    .accordion-lms.active {border-bottom: 1px solid #dbdbdb !important;}
      </style>
      @include('genie.layouts.sidebar_form')

    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

  $(document).ready(function() {
    $(".click-course-dtl1").click(function() {
      $(".open-course-dtl1").fadeToggle("slow");
    });
    
    $(".click-course-dtl2").click(function() {
      $(".open-course-dtl2").fadeToggle("slow");
    });
    
    $(".click-course-dtl3").click(function() {
      $(".open-course-dtl3").fadeToggle("slow");
    });

    /* $(".click-course-dtl1").click(function() {
      $(".open-course-dtl2, .open-course-dtl3").hide();
    });
   */
});


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

  var acc = document.getElementsByClassName("accordion-lms");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }

  var acc = document.getElementsByClassName("click-course-dtl");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
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