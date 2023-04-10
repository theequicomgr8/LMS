 @extends('genie.layouts.app')
 @section('title')
     Finished Batches
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
			<div class="clearfix"></div>
		  <div class="row">
             <style>
            #leads_filter form {align-items: center;}
            #leads_filter{padding-right:0px;padding-left:0px;}
            .dataTables_length{float: left;}
            div.dataTables_wrapper div.dataTables_filter {text-align: right;float: right;}
             </style>
              <div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Finished Batches</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
						  <div id="leads_filter" class="col-md-12" style="border-bottom:1px solid #E6E9ED;margin-bottom:20px;padding-bottom: 20px;    margin-top: -16px;
">
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

									 
										<button type="submit" class="btn btn-block btn-info mb-0 mt-2">Filter</button>
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
						  <!--<th>PDF</th>-->
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
              </div>
            </div>
          </div>
        </div>
          
    
     @endsection