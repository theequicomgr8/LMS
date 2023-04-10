 @extends('genie.layouts.app')
 @section('title')
     Finished Batches
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		     <div class="page-title">
              <div class="title_left">
                <h4>Finished Batch</h4>
              </div>              
            </div>
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
			 
              <!--<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Finished<small>Batches</small></h2>
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
						  <?php  $role = Session::get('role');	 
						  if($role=="Admin"){						  
						  ?>
						  <div id="leads_filter" class="col-md-12" style="border-bottom:2px solid #E6E9ED;margin-bottom:10px;padding-bottom:10px;">
							<form method="GET" action="" novalidate autocomplete="off">
								<div class="form-group">
									<div class="col-md-3">
										<label>Trainer</label>
										<select class="form-control select_trainer" name="search[trainer]">
											<option value="">Select Trainer</option>
											@if(!empty($trainers))
												@foreach($trainers as $trainer)
													@if(isset($search['trainer']) && $search['trainer']==$trainer->id)
														<option value="{{ $trainer->id }}" selected>{{ $trainer->name }}</option>
													@else
														<option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
								  
								<div class="form-group">
									<div class="col-md-3">
										<label>Course</label>
										<select class="form-control select_course" name="search[course]">
											<option value="">Select Course</option>
											@if(!empty($courses))
												 
												@foreach($courses as $course)
													@if(isset($search['course']) && $search['course']==$course->id)
														<option value="{{ $course->id }}" selected>{{ $course->course }}</option>
													@else
														<option value="{{ $course->id }}">{{ $course->course }}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
								 
								 
								<div class="form-group">
									<div class="col-md-3">
								 <label></label>

									 
										<button type="submit" class="btn btn-block btn-info">Filter</button>
									</div>
								</div>
							</form>
						</div>
						  <?php } ?>
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-finishedBatches" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;</th>
                           
                          <th>Date</th>
                          <th>Batch Name</th>
                          <th>Course</th>
                          <th>Trainer</th>
                          <th>Fees Pending</th>
                          <th>Slot</th>
                          <th>Time</th>
                          <th>Attend Count</th>
                          <th>Course Status</th>
                          <th>Feed Back</th>
						  <th>PDF</th>
                          <th>Rating</th>
                        </tr>
                      </thead>
						<tbody>
						<?php  
						if(!empty($batches)){
							foreach($batches as $batch){
								
								 
						?>
						<tr>
						 
							<td><?php
									$getstudetns = App\FeesStudents::where('stud_batch_id',$batch->id)->get();

							if(count($getstudetns)>0){ 						
						 
							?>
							
							<a href="{{url('/genie/batch/view-batch-details')}}/<?php echo $batch->id; ?>"><?php echo $batch->id; ?></a>
							
							<?php
							
							}else{

								echo "<span style='color:red' title='No students of this Batch'>".$batch->id."</spans>";
								}  
							
							
							  ?></td>
						 
						<td><?php echo date('d-M-Y',strtotime($batch->batch_created_on)); ?></td>
						
						<td><?php echo $batch->batch_name; ?></td>
						<td><?php  
						$course = App\FeesCourse::where('id',$batch->batch_course)->first();
					if(!empty($course)){
						echo $course->course;
						
					}
						?></td>						
						<td><?php  
						$trainer = App\FeesTrainer::where('id',$batch->batch_trainer)->first();
					if(!empty($trainer)){
						echo $trainer->name;
						
					}
						?></td>					 
						<td><?php echo $batch->occurrence; ?></td>
						<td><?php echo $batch->batch_starts_on.''.$batch->batch_end_on; ?></td>
						<td></td>
						<td> </td>
						<td> </td>
						<td> </td>
						</tr>   
						<?php } } ?>						
						</tbody>                      
					  </table>
					
					
                  </div>
                </div>
              </div>
            </div>
                </div>
              </div>-->
			  
			  
			   <div class="col-md-12 col-sm-12 ">

                  <div class="x_content">
                      
			  <div class="row">
			  <?php 
			if(!empty($batchesfinish)){ 
			foreach($batchesfinish as $batches){ 
			$stundent = App\FeesStudents::where('stud_batch_id', $batches->id)->get();
	 
			?>
			 
			<div class="col-md-4 col-sm-4 batch-box" onclick="window.open('<?php echo url('batch/batch-details'); ?>/<?php echo base64_encode($batches->id); ?>')">

			<div class="x_panel tile">
			
			<h2><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" class="batchname" title="Batch Name: <?php if(!empty($batches->batch_name)){ echo $batches->batch_name; } ?>"> <?php if(!empty($batches->batch_name)){ echo substr($batches->batch_name,0,22).'...'; } ?></a></h2>                   
			<div class="x_content">




			<ul class="quick-list">
	<li><i class="fa fa-calendar"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Batch Start Date <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ">Start Date: <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ( <?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?>)</a>
			</li>
			<li><i class="fa fa-book"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Course : <?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?>" ><?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?> </a>
			</li>
			<!--<li><i class="fa fa-clock-o"></i><a href="#"><?php if(!empty($batches->batch_starts_on)){ echo $batches->batch_starts_on;  } ?>To  <?php if(!empty($batches->batch_end_on)){ echo $batches->batch_end_on;  } ?></a> </li>-->
			<!--<li><i class="fa fa-calendar"></i><a href="#"><?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?></a> </li>-->
			<li><i class="fa fa-calendar-check-o"></i><a href="#">Attendance <?php if($batches->attendancebatch){ echo $batches->attendancebatch;  }else { echo "0"; } ?></a> </li>

			</ul>

	
			</div>
			
			<div class="show-student"><?php $i=0; if($stundent){ foreach($stundent as $stud){ 
			    $i++;
			 	if($i<=5){
	    	 if($i==1){
				$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
			$color= ('#' . $rand);
			}else if($i==2){
				$color="#3399FF";
			}else if($i==3){
				$color="#FF5E33";				
			}else if($i==4){ 
			$color="#33FFF9";
			}else if($i==5){ 
			$color="#008000";
			}else if($i==6){ 
			$color="#FF4C33";
			}else if($i==7){ 
			$color="#FF33B2";
			}else if($i==8){ 
			$color="#AFFF33";
			}else if($i==9){ 
			$color="#161814";
			}else if($i==10){ 
			$color="#F51C1C";
			} else{
			    	$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
		    	$color= ('#' . $rand);
			}
			    ?> 
			    <?php 
			$names= explode(' ',ucwords($stud->name));

			if(!empty($names)){
			$resultname="";
			//foreach($names as $key){	 	 				 
			$resultname = substr(ucwords($names['0']),0,2);
		/*	if(!empty($names['1'])){
			$resultname .= substr(ucwords($names['1']),0,1);
			}else{
			$resultname .='&nbsp;';
			}*/
			//}					 				
			}else{
			$resultname .="&nbsp;";
			}
		 
			?> 
			    <a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" class="student-name" style="background: <?php echo $color; ?>;margin-left:-9.6px" target="_blank" title="<?php 	echo ucwords($stud->name);	 ?>">
			    <?php 	echo ucwords($resultname);	 ?></a>  <?php  } } }  if($i==1){ echo $i.' Student'; }else{  echo $i.' Students'; } ?> </div> 
			    
			</div>
			</div>
		 
			<?php } } ?>
			  
            </div>
            </div>
              </div>
			  
			  
            </div>
          </div>
        </div>
          
    
     @endsection