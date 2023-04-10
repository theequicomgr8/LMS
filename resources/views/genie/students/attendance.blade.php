@extends('genie.layouts.app')
@section('title')
Student Attendance
@endsection
@section('content')
<style>
  .btn-primary {
    background-color: #13293e;
    border-color: #13293e;
  }
  .table-attendence_1, .table-attendence_2, .table-attendence_3, .table-attendence_4{display:none;}

  .btn-primary:hover {
    color: #fff;
    background-color: #13293e;
    border-color: #13293e;
  }

</style>
<div class="right_col padding-student-top" role="main">
  <div class="">
<?php //echo "<pre>"; print_r($students); ?>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-8">
        @if(!empty($students))
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
			       
			        $calscolor="four";
			   }else if($k=='5'){
			       
			         $calscolor="five";
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
        <div class="batches student-attendance" style="background:none; box-shadow:none;">
          <!--<div class="batches-heading1 content-deliver-heading1">
            <h4>
              <?php //if($student->course){ echo $student->course; } ?>
              <?php //if($student->batch_name){ echo '('.$student->batch_name.')'; } ?>
            </h4>
          </div>-->

          <div class="new-attand-sec" style="border-radius: unset; overflow:hidden;">
            <div class="container">
              <div class="row">
                <div class="col-md-2 new-attand-item1 <?php echo $calscolor; ?>" >
                  <div class="hexshape">
                    <img src="{{asset('/img/attand-new.png')}}" alt="new-fee-course-icon.png">
                      <!--<p title="<?php if($student->course){ echo $student->course; } ?>"><?php if($student->course){ echo $student->course; } ?> </p>-->
                  </div>

                </div>
                <div class="col-md-7 new-fee-item2">
                  <div class="course-fee-dtl">
                    <h2><?php if($student->course){ echo $student->course; } ?></h2>
                    <h2>Batch Name: <?php if($student->batch_name){ echo $student->batch_name; } else{  echo "N/A"; } ?></h2>
                    <hr>
                    <div class="d-flex attand-dtl-btn">
                      <p>Total Classes : <?php 
                     $attendancebatch= App\FeesBatchsAttendance::where('batch_id',$student->stud_batch_id)->orderby('id','desc')->get()->count();
                     echo $attendancebatch;
                      ?></p>
                      <p>Present : <?php 
                      $attendancecount = App\FeesStudentsAttendance::where('students_id',$student->std_id)->orderby('id','desc')->get()->count();
                      echo $attendancecount;
                      ?></p>
                      <p>Absent : <?php $absent = $attendancebatch - $attendancecount; echo $absent; ?></p>
                    </div> 
                  </div>
                </div>
                <div class="col-md-3 new-attand-item3">
                  
                <canvas id="myChart_<?php echo $k;?>"></canvas>
					
				<script>
					setTimeout(function() {
								var doughnut = document.getElementById("myChart_<?php echo $k;?>") .getContext("2d");
								var myDoughnutChart = new Chart(doughnut, {
                                type: 'doughnut',
                                data: {
                                labels:["Class","Present", "Absent"],
                                datasets: [{
                                    label: "My First dataset",
                                    data: [<?php echo $attendancebatch;?>, <?php echo $attendancecount; ?>, <?php echo $absent; ?>],
                                    backgroundColor: ['#3175de','#2eb086','#fc4f4f'],
                                    borderColor: ['#3175de','#2eb086','#fc4f4f']
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
                            <button type="btn" class="clickto-check_<?php echo $k; ?> clickto-check" style="margin-top: 4px; border-radius:0px;">View Details</button>
							

                </div> 
              </div>
              <div class="table-attendence_<?php echo $k; ?>">
              <table class="table table-bordered attent-table">
		  <thead>
			<tr>
			  <th scope="col">S.No</th>
			  <th scope="col">Date</th>
			  <th scope="col">Present</th>
			  <th scope="col">Absent</th>
			</tr>
		  </thead>
	
  <tbody>
  <?php 
  $attendancecount = App\FeesStudentsAttendance::where('students_id',$student->std_id)->orderby('id','desc')->get();
  $studentdate=[];
  if(!empty($attendancecount)){
      foreach($attendancecount as $attend){
          $studentdate[date('d-m-Y',strtotime($attend->created_at))]=$attend->created_at;
          
      }
  }

  
  $attencelist = App\FeesBatchsAttendance::where('batch_id',$student->stud_batch_id)->orderby('id','desc')->get();
		if($attencelist){ 
		    $i=0;  
		foreach($attencelist as $attence){
		    $i++;
		     
		 ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php  if($attence->created_at){ echo date('d M Y',strtotime($attence->created_at)); } ?></td>
      <td><?php if(array_key_exists(date('d-m-Y',strtotime($attence->created_at)),$studentdate)){ ?><i class="fa fa-check" aria-hidden="true"></i> <?php } ?></td>
      <td><?php if(!array_key_exists(date('d-m-Y',strtotime($attence->created_at)),$studentdate)){  ?><i class="fa fa-times" aria-hidden="true" style="color:red;"></i> <?php } ?></td>
    </tr>
	 <?php }   
		} ?>
    <!--<tr>
      <th scope="row">2</th>
      <td>03-April-2022</td>
      <td></td>
      <td><i class="fa fa-times" aria-hidden="true"></i></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>04-April-2022</td>
      <td><i class="fa fa-check" aria-hidden="true"></i></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>05-April-2022</td>
      <td></td>
      <td><i class="fa fa-times" aria-hidden="true"></i></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>06-April-2022</td>
      <td><i class="fa fa-check" aria-hidden="true"></i></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td>07-April-2022</td>
      <td></td>
      <td><i class="fa fa-times" aria-hidden="true"></i></td>
    </tr>-->
  </tbody>
</table>
              </div>
            </div>
          </div>

        </div>
       


        @endforeach
        @endif

      </div>
      @include('genie.layouts.sidebar_form')

    </div>
  </div>
</div>
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
/*var doughnut = document.getElementById("myChart") .getContext("2d");
var myDoughnutChart = new Chart(doughnut, {
    type: 'doughnut',
    data: {
    labels:["Total","Present", "Absent"],
    datasets: [{
        label: "My First dataset",
        data: [55, 45, 10],
        backgroundColor: ['#3175de','#2eb086','#fc4f4f'],
        borderColor: ['#3175de','#2eb086','#fc4f4f']
     }]
   },
  options: {
    plugins:{   
             legend: {
               display: false
                     },
                  }

  }
});*/


$(document).ready(function(){
  $(".clickto-check_1").click(function(){
    $(".table-attendence_1").toggle();
  });
  $(".clickto-check_2").click(function(){
    $(".table-attendence_2").toggle();
  });
  $(".clickto-check_3").click(function(){
    $(".table-attendence_3").toggle();
  });
  $(".clickto-check_4").click(function(){
    $(".table-attendence_4").toggle();
  });
  
 
});
</script>


@endsection