 @extends('genie.layouts.app')
 @section('title')
     Running Batches
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		    <!--<div class="page-title">-->
      <!--        <div class="title_left">-->
      <!--          <h3>Running Batch</h3>-->
      <!--        </div>              -->
      <!--      </div>-->
			 <div class="clearfix"></div>
		  <div class="row">
              <style>
                #leads_filter form
                {
                  align-items: center;
}
              #leads_filter 
              {
                  padding-right:0px;
                  padding-left:0px;
              }
                    .dataTables_length{
                    float: left;
                    }
                    div.dataTables_wrapper div.dataTables_filter {
                    text-align: right;
                    float: right;
                    }
                    .table-striped tbody tr:nth-of-type(odd) td .lms-accordian .panel{
                    background:#f2f2f2;
                    }
             </style>
              
             
              <div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Running Batches</h2>
                     
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
						  <?php  $role = Session::get('role');	 
						  if($role=="Admin"){						  
						  ?>
						  <div id="leads_filter" class="col-md-12" style="border-bottom:1px solid #E6E9ED;margin-bottom:20px;">
							<form method="GET" action="" novalidate autocomplete="off" class="running-form">
								<div class="col-md-3 col-sm-12 col-12">
									<div class="form-group">
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
								  
								
								<div class="col-md-3 col-sm-12 col-12">
									<div class="form-group">
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
								 
								
								<div class="col-md-3 col-sm-12 col-12">								
									<div class="form-group">									
								 <label></label>

									 
										<button type="submit" class="btn btn-block btn-info mb-0 mt-2">Filter</button>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-12">
									<!--<div class="keep-open btn-group open" title="Columns"><button type="button" aria-label="columns" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="glyphicon glyphicon-th icon-th"></i> <span class="caret"></span></button><ul class="dropdown-menu" role="menu" style="top: 28px;left: -70px;transform: translate3d(-75px, 28px, 0px) !important;">
					 

				<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Id]" data-field="Id" value="0" checked="checked"> Id</label></li> 
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Date]" data-field="Date" value="1" checked="checked"> Date</label></li>
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Batch Name]" data-field="Batch Name" value="2" checked="checked"> Batch Name</label></li>
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Course]" data-field="Course" value="3" checked="checked"> Course</label></li>
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Fees Pending]" data-field="Fees Pending" value="4" checked="checked"> Fees Pending</label></li>
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Slot]" data-field="Slot" value="5" checked="checked"> Slot</label></li>
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Time]" data-field="Time" value="6" checked="checked"> Time</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Attend Count & Date]" data-field="Attend Count & Date" value="7" checked="checked"> Attend Count & Date</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Take Attendance]" data-field="Take Attendance" value="8" checked="checked"> Take Attendance</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Trainer]" data-field="Trainer" value="9" checked="checked"> Trainer</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[PDF]" data-field="PDF" value="10" checked="checked"> PDF</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Course Status]" data-field="Course Status" value="11" checked="checked"> Course Status</label></li>
					
					
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Feed Back]" data-field="Feed Back" value="12" checked="checked"> Feed Back</label></li>	
					<li role="menuitem"><label>					
					<input type="checkbox" id="check-columns" name="search[Rating]" data-field="Rating" value="13" checked="checked"> Rating</label></li>
					
					</ul></div>-->
					</div>
								
					
							</form>
						</div>
						  <?php } ?>
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-runningBatches" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                                           
                          <th>Date</th>
                          <th>Batch Name</th>
                          <th>Course</th>
                          <th>Fees Pending</th>                         
                          <th>Slot</th>
                        
                          <th>Time</th>
						    <th>Action</th>
                         <!-- <th>Attend Count & Date</th>
                          					  
						  <th>Trainer</th>
						 
                          <th>PDF</th>
                          <th>Course Status</th>
                          <th>Feed Back</th>
                          <th>Rating</th>-->
                        </tr>
                      </thead>
					    
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