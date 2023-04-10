 @extends('genie.layouts.app')
 @section('title')
     View Batches Details
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
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
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Batches<small>Batches</small> (<?php echo $batches->batch_name; ?>)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-runningBatches" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                           
                         
                          <th>Name</th>
						  <th>Attendance</th>
                          <th>Count</th>
                          <th>Today’s Attendance</th>
                          <th>Course</th>
                          <th>Feedback</th>
                         
                        
                        </tr>
                      </thead>
						<tbody>
						<?php //echo "<pre>";print_r($batches); 
						if(!empty($students)){
							foreach($students as $student){
								
								 
						?>
						<tr>
						 
							<td><?php  
						 
								if(count($student->next_due_amt)>0){
										echo "<span title='Fees Pending in this Students'>".$student->name."</span>"."<i class='fa fa-check-square' aria-hidden='true' style='color:red' title='Fees Pending in this Students'></i>";
								}else{
							echo $student->name;
								}
							?></td>
						 	
						<td>						 
						<input type="checkbox" class="check-box" value="<?php echo $student->id; ?>"></td>
							<td>
							<?php
							echo $student->attendancecount;
							?>
							</td>
							<td>
							<?php												 
							$currentdate = date('Y-m-d');
							if($currentdate == date('Y-m-d',strtotime($student->attenddate))){														
							echo "Yes".'('.date('H:i:s',strtotime($student->attenddate)).')';														
							}
							?>
							</td>
								 
								<td><?php  
						$course = App\FeesCourse::where('id',$student->courses)->first();
					if(!empty($course)){
						echo $course->course;
						
					}
						?></td>
						<td> </td>
						
						 
						 
						</tr>   
						<?php } } ?>						
						</tbody>                      
					  </table>
					
					
                  </div>
						<form role="form" method="POST" action="" id="submitattendance">

						<input type="hidden" name="total" id="total" value="<?php echo count($students);?>">
						<input type="hidden" name="attend" id="attendance-count" value="" />
						</form>
						<button type="button" class="bnt btn-success" onclick="javascript:batchController.studentsAttendance()">Attendance Submit</button>
						
									
                </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
    <script>
		function submitattendance()
		{
			var $this = this;
				$this.checked_Ids = [];
				$('.check-box:checked').each(function(){
					if(!(new String("on").valueOf() == $(this).val())){
						$this.checked_Ids.push($(this).val());
					}
				});
				$('#attendance-count').val($this.checked_Ids);
			 //alert($this.checked_Ids);
				
				 
			 
		}
		</script>
     @endsection