 @extends('genie.layouts.app')
 @section('title')
     All Employee  
@endsection
@section('content')	
	<!-- Breadcomb area Start-->
	 <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="fa fa-users"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Employee List</h2>
										<p>Welcome to <span class="bread-ntd">Employee List</span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">									 
									<a title="Download Report" class="btn" href="{{url('genie/employee/get-employeeexpert')}}"><i class="notika-icon notika-sent"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
					
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                     <div class="row">	 
							  
					  <form  method="GET" action=""  novalidate autocomplete="off">
					   <div class="row">	 
							        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Department</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-windows"></i>
                                    </div>
                                    <div class="nk-int-st">
									 
                                        <select class="selectpicker bootstrap-select fm-cmp-mg" name="search[department]" id="departments">
											<option value="">Select Department</option>
											 
											 
											 @if(!empty($departmentlist))
												@foreach($departmentlist as $department)
													@if(isset($search['department']) && $search['department']==$department->id)
														<option value="{{ $department->id }}" selected>{{ $department->department}}</option>
													@else
														<option value="{{ $department->id }}">{{ $department->department }}</option>
													@endif
												@endforeach
											@endif
											</select>
                                    </div>
                                </div>
                                </div>
								
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Designation</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
									 <select class="bootstrap-select fm-cmp-mg" name="search[designation]" id="designations">
									 </select>
                                    
                                    </div>
                                </div>
                                </div>	
								
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Status</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <select class="selectpicker bootstrap-select fm-cmp-mg" name="search[status]" >
											<option value="">Select Status</option>		 
												<option value="1" @if(isset($search['status']) && $search['status']==1) selected @endif>Active</option>
											 
												<option value="2" @if(isset($search['status']) && $search['status']==2) selected @endif> Inactive</option>
												<!--<option value="3" @if(isset($search['status']) && $search['status']==3) selected @endif> Deleted</option>-->
													 
											</select>
                                    </div>
                                </div>
                                </div>	
                                </div>	
								 <div class="row">	 
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Date From</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control date_from" name="search[date_from]" value="{{ $search['date_from'] or "" }}" placeholder="Select Date From">
                                    </div>
                                </div>
                                </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Date To</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">     
										<i class="notika-icon notika-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control date_to" name="search[date_to]" value="{{ $search['date_to'] or "" }}" placeholder="Select Date To">										 
                                    </div>
                                </div>
                                </div> 

								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  
                                <div class="form-group ic-cmp-int">
                                     
                                    <div class="nk-int-st">
                                        
								<button type="submit" class="btn btn-success" style="margin-top:15%;width: 200px;" name="submit">Filter</button>
					 					 
                                    </div>
                                 
                                </div>
                                </div>
                                </div>
                          </form>
                            
						</div>
		
                        <div class="table-responsive">
                            <table id="data-table-employee" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Joining Date</th>
                                        <th>Emp  Id</th>
                                        <th>Name</th>                                     
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Status</th>   
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <!-- Start Footer area-->
       @endsection