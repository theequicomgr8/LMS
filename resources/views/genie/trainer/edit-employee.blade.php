 @extends('genie.layouts.app')
 @section('title')
     Edit Employee  
@endsection
@section('content')	
  
      <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="fa fa-user"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Employee Personal Details:</h2>
										<p>Welcome to <span class="bread-ntd">Employee Personal Details:</span></p>
											<div class="successmessage"></div>
											<div class="errormessage"></div>
											@if(Session::has('success')) 	
											<div class="row">
											<div class="col-md-12 col-md-offset-1">
											<div class="alert alert-success">
											<strong>Success!</strong> {{Session::get('success')}}
											</div>
											</div>
											</div>
											@endif
											@if(Session::has('failed')) 	
											<div class="row">
											<div class="col-md-12 col-md-offset-1">
											<div class="alert alert-danger">
											<strong>!</strong> {{Session::get('failed')}}
											</div>
											</div>
											</div>
											@endif
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <div class="form-element-area" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                    
						 
						<form action="" method="post" class="employeepersionaldetails" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                         
							             {{csrf_field()}}                    
							 <div class="nk-int-mk">
                                    <h6>First Name<span class="required">*</span></h6>
                                </div>
							<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
									<input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name',(isset($edit_data)) ? $edit_data->first_name:"")}}" data-rule="first_name" data-msg="Enter First Name">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                    <h6>Middle Name</h6>
                                </div>
							  
								<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name',(isset($edit_data)) ? $edit_data->middle_name:"")}}" placeholder="Middle Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                    <h6>Last Name<span class="required">*</span></h6>
                                </div>
							  
								<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name',(isset($edit_data)) ? $edit_data->last_name:"")}}" placeholder="Last Name" data-rule="last_name" data-msg="Enter Last Name">
										<div class="validation"></div>
										
                                    </div>
                                </div>
                            </div>
                        </div> 
						
						<div class="row">
						
						  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
                                    <h6>Father’s/Husband’s Name<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="father_name" value="{{ old('father_name',(isset($edit_data)) ? $edit_data->father_name:"")}}" placeholder="Father’s/Husband's Name:"data-rule="father_name" data-msg="Enter Father’s/Husband's Name">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="nk-int-mk">
									<h6>Personal Email <span class="required">*</span></h6>
									</div>

							   <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="company_email" value="{{ old('company_email',(isset($edit_data)) ? $edit_data->company_email:"")}}" placeholder="Personal E-mail ID:" data-rule="company_email" data-msg="Enter Personal E-mail ID:" >
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Primary Mobile<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="mobile" value="{{ old('mobile',(isset($edit_data)) ? $edit_data->mobile:"")}}" placeholder="Mobile Contact Number:" data-rule="mobile" data-msg="Enter Contact Number" <?php if(Auth::user()->role == "Manager" || Auth::user()->role == "Admin"){ }else{ echo "readonly"; } ?>>
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
						
						<div class="row">
                          
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Emergency Mobile<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" value="{{ old('emergency_mobile',(isset($edit_data)) ? $edit_data->emergency_mobile:"")}}" name="emergency_mobile" placeholder="Emergency Contact Number:" data-rule="emergency_mobile" data-msg="Enter Emergency Mobile">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Marital Status</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st"> 
											<select class="selectpicker bootstrap-select fm-cmp-mg" name="marital_status" data-rule="marital_status" data-msg="Enter Marital Status">
											<option value="">Select Marital Status</option>
											<option value="Married" @if ("Married"== old('marital_status'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->marital_status == "Married" ) ? "selected":"" }} @endif >Married</option>
											<option value="Unmarried" @if ("Unmarried"== old('marital_status'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->marital_status == "Unmarried" ) ? "selected":"" }} @endif >Unmarried</option>
											</select>	
											<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Gender</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       
											<select class="selectpicker bootstrap-select fm-cmp-mg" name="gender" data-rule="gender" data-msg="Enter Gender">
											<option value="">Select Gender</option>
											<option value="Male" @if ("Male"== old('gender'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->gender == "Male" ) ? "selected":"" }} @endif >Male</option>
											<option value="Female" @if ("Female"== old('gender'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->gender == "Female" ) ? "selected":"" }} @endif >Female</option>

											</select>
											<div class="validation"></div>
											 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Date of Birth<span class="required">*</span></h6>
									</div>
                               
 
							   <div class="form-group ic-cmp-int" id="dob">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="nk-int-st">									 
                                        <input type="text" class="form-control date" name="dob" value="{{ old('dob',(isset($edit_data)) ? $edit_data->dob:"")}}" placeholder="Date of Birth" data-rule="dob" data-msg="Enter Date of Birth">
										<div class="validation"></div>
										
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Refrence Name</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="refrence_name" value="{{ old('refrence_name',(isset($edit_data)) ? $edit_data->refrence_mobile:"")}}" placeholder="Refrence Name" data-rule="refrence_name" data-msg="Enter Refrence Name">
										<div class="validation"></div>
                                    </div>
                                   
                                </div>
                            </div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Refrence Mobile</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="refrence_mobile" value="{{ old('refrence_mobile',(isset($edit_data)) ? $edit_data->refrence_mobile:"")}}" placeholder="Refrence mobile no" data-rule="refrence_mobile" data-msg="Enter Refrence mobile No">
										<div class="validation"></div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
						
                        
						<div class="row">
                        
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Permanent Address<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-house"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address',(isset($edit_data)) ? $edit_data->permanent_address:"")}}" placeholder="Permanent Address" data-rule="permanent_address" data-msg="Enter Permanent Address" <?php if(Auth::user()->role == "Manager" || Auth::user()->role == "Admin"){ }else{ echo "readonly"; } ?>>
										<div class="validation"></div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Current Address<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-house"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="current_address" value="{{ old('current_address',(isset($edit_data)) ? $edit_data->current_address:"")}}" placeholder="Current Address" data-rule="current_address" data-msg="Enter Current Address">
										<div class="validation"></div>
                                    </div>
                                    
                                </div>
                            </div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Password </h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
									 
                                        <input type="text" class="form-control" name="password" value="" placeholder="*********** " >
										 
                                    </div>
                                </div>
                            </div>
                        </div>
						
						 
						
						
						<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						</div>
						<button class="btn btn-success notika-btn-success waves-effect" name="submit" style="margin-left: 20%;margin-top: 15px;width:200px;">Submit</button>
					 
						</div>
						 
						</form>
                    </div>
                </div>
            </div>
            </div>
     </div>
			 
      <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Employee Official Details</h2>
										<p>Welcome to <span class="bread-ntd">Employee Official Details:</span></p>
										 
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="form-element-area" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="container">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">                     
                        
						<form onsubmit="return employeeController.employeedetails(this)" autocomplete="off">
                       
							{{csrf_field()}}     
                        
						 
						 <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Primary Company Email <span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-mail"></i>
                                    </div>
                                    <div class="nk-int-st">
									<input type="hidden" name="employee_id" id="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
                                        <input type="text" class="form-control" name="email" value="{{ old('email',(isset($edit_data)) ? $edit_data->email:"")}}" placeholder="Enter  email" data-rule="email" data-msg="Enter Email" <?php if(Auth::user()->role == "Manager" || Auth::user()->role == "Admin"){ }else{ echo "readonly"; } ?>>
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                       
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							 <div class="nk-int-mk">
                                    <h6>Role<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                      <select class="selectpicker bootstrap-select fm-cmp-mg" name="role" id="role" data-rule="role" data-msg="Select Role" >
											<option value="">Select Role</option>
											<option value="Admin" @if ("Admin"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Admin" ) ? "selected":"" }} @endif <?php if(Auth::user()->role == "Manager" || Auth::user()->role == "Admin"){ }else{ echo "disabled"; } ?>>Admin</option>
											
											<option value="Manager" @if ("Manager"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Manager" ) ? "selected":"" }} @endif <?php if(Auth::user()->role == "Manager" || Auth::user()->role == "Admin"){ }else{ echo "disabled"; } ?>>Manager</option>
												
									 <option value="User" @if ("User"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "User" ) ? "selected":"" }} @endif >User</option>
												
									 
											
											
											
											</select>
										 <div class="validation"></div>
                                    </div>
                                
                           
									</div> 
									</div> 
									
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Reporting Manager<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-sun-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        
										 <select class=" bootstrap-select fm-cmp-mg" name="reporting_manager" id="reporting_manager" data-rule="reporting_manager" data-msg="Select manager">
											<option value="">Select Manger</option>
											
											<?php 											

												 
												if(!empty($managers)){
												foreach($managers as $manager ){
												?>
												<option value="<?php echo $manager->id ?>" @if ($manager->id== old('reporting_manager'))
												selected="selected"	
												@else
												{{ (isset($edit_data) && $edit_data->reporting_manager == $manager->id ) ? "selected":"" }} @endif ><?php echo $manager->first_name.' 
											
											
											'.$manager->last_name; ?></option>
												<?php } }  ?>								 
											
											
											</select>
										 <div class="validation"></div>
										 
                                    </div>
                                </div>
                            </div>
                        </div> 

						<div class="row">
						
					
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Date of Joining</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control dateofjoining" name="dateofjoining" value="{{ old('dateofjoining',(isset($edit_data)) ? $edit_data->dateofjoining:"")}}"  >
										 <div class="validation"></div>
										 
                                    </div>
                                </div>
                            </div>
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Department<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-sun-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        
										 <select class="selectpicker bootstrap-select fm-cmp-mg" name="department" id="departments" data-rule="department" data-msg="Select department">
											<option value="">Select Department</option>
											
												<?php 
												
												if(!empty($departments)){
												foreach($departments as $department ){
												?>
												<option value="<?php echo $department->id ?>" @if ($department->id== old('department'))
												selected="selected"	
												@else
												{{ (isset($edit_data) && $edit_data->department == $department->id ) ? "selected":"" }} @endif ><?php echo $department->department; ?></option>
												<?php } }  ?>									 
											
											
											</select>
										 <div class="validation"></div>
										 
                                    </div>
                                </div>
                            </div>
								 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Designation<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
									 <select class="bootstrap-select fm-cmp-mg" name="designation" id="designations" data-rule="designation" data-msg="Select designation">
									 	<?php if(!empty($designations)){
												foreach($designations as $designation ){
												?>
										<option value="<?php echo $designation->id ?>" @if ($designation->id== old('designation'))
												selected="selected"	
												@else
												{{ (isset($edit_data) && $edit_data->designation == $designation->id ) ? "selected":"" }} @endif ><?php echo $designation->designation; ?></option>
											
										<?php } } ?>
                                     </select>
									 <div class="validation"></div>
                                    </div>
                                </div>
                            </div> 
							</div>
							<div class="row">
							 
							     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Company Mobile</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="company_mobile" value="{{ old('company_mobile',(isset($edit_data)) ? $edit_data->company_mobile:"")}}" placeholder="Enter Company Mobile" data-rule="company_mobile" data-msg="Enter Company Mobile">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
								
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Fixed Salary<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="fixed_salary" value="{{ old('fixed_salary',(isset($edit_data)) ? $edit_data->fixed_salary:"")}}" placeholder="Enter Bank A/C" >
										 <div class="validation"></div>
										 
                                    </div>
                                </div>
                            </div>
								
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Employee Code<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="emp_code" value="{{ old('emp_code',(isset($edit_data)) ? $edit_data->emp_code:"")}}" data-rule="emp_code" data-rule-number="true" data-msg="Select Employee Numeric Code" placeholder="Enter employee exp CC0001" maxlength=6	">
										  <div class="validation"></div>
										 
                                    </div>
                             </div>
							</div>
						 		 
				   
							
                        </div> 
						 
						
						
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						</div>
						<button class="btn btn-success notika-btn-success waves-effect" name="submit" style="margin-left: 20%;width:200px;">Submit</button>
						</div>
						 
						</form>
                    </div>
                </div>
            </div>
        </div>
			
			
	<div class="breadcomb-area" style="margin-top: 15px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Employee Document Details</h2>
										<p>Welcome to <span class="bread-ntd">Employee Document Details:</span></p>
										 
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	  <div class="form-element-area" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="container">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">                     
                        
						<form onsubmit="return employeeController.employeedocuments(this)" autocomplete="off">
                       
							{{csrf_field()}}     
                         
						 
							<div class="row">
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Passport No </h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
									 <input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
                                        <input type="text" class="form-control" name="passport_no" value="" placeholder="Passport No" >
										 
                                    </div>
                                </div>
                            </div>
							   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>PAN Card No</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="pan_no" value="{{ old('pan_no',(isset($edit_data)) ? $edit_data->pan_no:"")}}" placeholder="Enter PAN Card No" data-rule="pan_no" data-msg="Enter PAN Card No">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>AAdhar No<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="aadhar_no" value="{{ old('aadhar_no',(isset($edit_data)) ? $edit_data->aadhar_no:"")}}" placeholder="Enter Aadhar" data-rule="aadhar_no" data-msg="Enter AAdhar no">
									 <div class="validation"></div>
                                    </div>
                                </div>
                            </div>                 
							
							</div>				 
				   
							
                        
						 
						
						
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						</div>
						<button class="btn btn-success notika-btn-success waves-effect" name="submit" style="margin-left: 20%;width:200px;">Submit</button>
						</div>
						 
						</form>
                    </div>
                    </div>
                </div>
            </div>
            </div>
			
	 			 
			  <div class="breadcomb-area" style="margin-top: 15px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="breadcomb-list">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="breadcomb-wp">
											<div class="breadcomb-icon">
												<i class="notika-icon notika-house"></i>
											</div>
											<div class="breadcomb-ctn">
												<h2>Company Experience</h2>
												<p>Welcome to <span class="bread-ntd">Company Experience:</span></p>
													 
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
										<div class="breadcomb-report">
											   <button type="button" class="btn btn-success" style="margin-left: 35px;" data-toggle="modal" data-target="#myModalthree">Add Experience</button>
						   
											</div>
						   
						   <div class="modal fade" id="myModalthree" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
												 <h4>Add Company Experience</h4>
												<div class="successexperience" style="color:#fff"></div>
												<div class="errorexperience"></div>
                                            </div>
                                            <div class="modal-body">
                                               
									<form action="" method="" class="addcompanyexperience" autocomplete="off">                                              
											  <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Company Name<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="nk-int-st">
									<input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
                                        <input type="text" class="form-control" name="companyname" placeholder="Company Name"  data-rule="companyname" data-msg="Enter Company Name">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Designation<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-sticky-note-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="designation" placeholder="Enter Designation" data-rule="designation" data-msg="Enter Designation">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Department<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="department" placeholder="Enter Department" data-rule="department" data-msg="Enter Department">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date From<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control datefrom" name="experience_from" placeholder="select Date From" data-rule="experience_from" data-msg="Select Experience Date From">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date To<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control dateto" name="experience_to" placeholder="Select Date To" data-rule="experience_to" data-msg="Select Experience Date To">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Reason of Living</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="reason_of_living" placeholder="Enter Reason of Living" data-rule="reason_of_living" data-msg="Enter Reason of Living">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
					
						 <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" name="submit">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
												</form>
											
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
							
										 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		 

	<?php if(!empty($employeeexperience)) { ?>
<div class="form-element-area" style="margin-top:15px;margin-bottom:15px;">
        <div class="container">
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">				 
						
						<?php 
							$i=0;
						foreach($employeeexperience as $experience){
							$i++;
						?>
						 
						<div class="form-element-list  experience">
						 
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Company Name <?php echo $i; ?></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="nk-int-st">
                                         <?php echo $experience->company_name ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Designation</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-sticky-note-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       <?php echo $experience->designation; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Department</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <?php echo $experience->department; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date From</h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <?php echo date('d-M-Y',strtotime($experience->experience_from)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date To</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                          <?php echo date('d-M-Y',strtotime($experience->experience_to)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Reason of Living</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                          <?php echo $experience->reason_of_living; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					 
						  <div class="row">
						  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					 
						</div>
						  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						  
						   <button type="button" class="btn btn-success" style="margin-top:-79px;margin-left: 137px;" data-toggle="modal" data-target="#updateExperience_<?php echo $experience->id; ?>"><i class="fa fa-edit"></i></button>
						   <?php  if(Auth::user()->role == "admin"){ ?>
						   <button type="button" class="btn btn-danger" style="margin-top:-119px;margin-left: 191px;" id="delexperience_<?php echo $experience->id ?>"><i class="fa fa-trash"></i></button>
						   <?php } ?>
						   <script>
						   
							//delete Education
							$('#delexperience_<?php echo $experience->id ?>').on('click', function(){ 


							 $.ajax({
							url: '/genie/employee/del_experience/<?php echo $experience->id;?>',
							type: 'get',
							cache: false,
							contentType: false,
							processData: false, 
							success: function(data) { 
							var obj = JSON.parse(data);	
							if(obj.status){
								alert(obj.msg);
								window.location=document.location.href;   
							}else{
								alert(obj.msg);
								
							}
							 
							 
							}
							 
							});
							});
						   </script>
						   
						   <div class="modal fade" id="updateExperience_<?php echo $experience->id; ?>" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
												 <h4>Edit Company Experience</h4>
												<div class="successexperience" style="color:#fff"> </div>
												<div class="errorexperience"></div>
                                            </div>
                                            <div class="modal-body">
                                               
									<form action="" method="" class="editcompanyexperience" autocomplete="off">                                              
											  <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Company Name<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="nk-int-st">
									<input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
									<input type="hidden" name="experience_id" value="{{ (isset($experience)) ? $experience->id:""}}">
                                        <input type="text" class="form-control" name="companyname" value="{{ (isset($experience)) ? $experience->company_name:""}}" placeholder="Company Name"  data-rule="companyname" data-msg="Enter Company Name">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Designation<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-sticky-note-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="designation" value="{{ (isset($experience)) ? $experience->designation:""}}" placeholder="Enter Designation" data-rule="designation" data-msg="Enter Designation">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Department<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="department" value="{{ (isset($experience)) ? $experience->department:""}}" placeholder="Enter Department" data-rule="department" data-msg="Enter Department">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date From<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control datefrom" value="{{ (isset($experience)) ? $experience->experience_from:""}}" name="experience_from" placeholder="select Date From" data-rule="experience_from" data-msg="Select Experience Date From">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Experience Date To<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control dateto" name="experience_to" value="{{ (isset($experience)) ? $experience->experience_to:""}}" placeholder="Select Date To" data-rule="experience_to" data-msg="Select Experience Date To">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Reason of Living</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="reason_of_living" value="{{ (isset($experience)) ? $experience->reason_of_living:""}}" placeholder="Enter Reason of Living" data-rule="reason_of_living" data-msg="Enter Reason of Living">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
					
						 <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" name="submit">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
												</form>
											
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
						</div>
						</div>
				 		<hr>
						
						</div>
						
						
				
						<?php  }  ?>
						   
						    </div>
            </div>	
            </div>	
            </div>	
			<?php } ?>
			
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="fa fa-graduation-cap"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Education Details</h2>
										<p>Welcome to <span class="bread-ntd">Education Details:</span></p>
											 
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									 <button type="button" class="btn btn-success" style="margin-left: 35px;" data-toggle="modal" data-target="#addeducation">Add Education</button>
						   
						   </div>
						   
						   <div class="modal fade" id="addeducation" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4>Add Education</h4>
												<div class="successexperience" style="color:#fff"></div>
												<div class="errorexperience"></div>
                                            </div>
                                            <div class="modal-body">
                                                
									<form action="" method="" class="addeducation" autocomplete="off">                                              
						 <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="nk-int-st">   
										<input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
										<select class="selectpicker bootstrap-select fm-cmp-mg" name="education" data-rule="education" data-msg="Select Education">
											<option value="">Select Education</option>
											<option value="10th" @if ("10th"== old('education'))
									selected="selected"	
									  @endif>10TH</option>
											<option value="12th" @if ("12th"== old('education'))
									selected="selected"	
									 @endif >12TH</option>
									  
									  <option value="Graduation" @if ("Graduation"== old('education'))
									selected="selected"	
									  @endif>Graduation</option>
									  <option value="PostGraduation" @if ("PostGraduation"== old('education'))
									selected="selected"	
									 @endif >Post Graduation</option>
											</select>	
											<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Institute<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-institution"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="institute" placeholder="Enter Institute/College" data-rule="institute" data-msg="Enter Institute/College">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>University/Board<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="university_board" placeholder="Enter University/Board" data-rule="university_board" data-msg="Enter University/Board">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Certificate/Degree</h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="certificate" placeholder="Enter Certificate/Degree" data-rule="certificate" data-msg="Enter Certificate/Degree">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Specialisation<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="specialisation" placeholder="Enter Area of Specialisation" data-rule="specialisation" data-msg="Enter Specialisation Course">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>% Marks/ CGPA<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="percentage" placeholder="Enter % Marks/ CGPA" data-rule="percentage" data-msg="Enter % Marks/ CGPA">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        
                           
                        </div>
						<div class="row">
                           
							 

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date From<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control datefrom" name="education_from" placeholder="Select Education date From" data-rule="education_from" data-msg="Select Education Date From">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date To<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control dateto" name="education_to" placeholder="Select Education Date To" data-rule="education_to" data-msg="Select Education Date To">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
						
						 
										<div class="modal-footer">
										<button type="submit" class="btn btn-default" name="submit">Save</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</form>
											
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
								
								
								 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if(!empty($employeeeducations)) {?>
	<div class="form-element-area" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="container">	
			
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">              
						
						 
						
						<?php  
							$i=0;
						foreach($employeeeducations as $educations){
							$i++;
						?>
						 
						<div class="form-element-list  experience">
						 
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education <?php echo $i; ?></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="nk-int-st">
                                         <?php echo $educations->education ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Institute</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-institution"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       <?php echo $educations->institute; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>University/Board</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <?php echo $educations->university_board; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Certificate/Degree</h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <?php echo $educations->certificate; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Specialisation</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                          <?php echo $educations->specialisation	; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>% Marks/ CGPA</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                          <?php echo $educations->percentage; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date From</h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <?php echo date('d-M-Y',strtotime($educations->education_from)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date To</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                          <?php echo date('d-M-Y',strtotime($educations->education_to)); ?>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Upload Degree</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       @if(!empty($educations->degree_image))
									<img src="{{asset('/upload/'.$educations->degree_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="degreeimage_<?php echo $educations->id; ?>" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 
									@else
									<input type="file" class="form-control" name="degreeimg" id="degreeimg_<?php echo $educations->id ?>" style="display:none; width: 89px;">
									<a href="javascript:void(0);" id="getdegreeImage_<?php echo $educations->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									@endif
                                    </div>
									<script>
									// update pan image
										$("#getdegreeImage_<?php echo $educations->id ?>").click(function(){
										$('#degreeimg_<?php echo $educations->id ?>').trigger('click'); 
										});

										$('#degreeimg_<?php echo $educations->id ?>').on('change', function(){ 

										$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

										var file = this.files[0];

										var form = new FormData();
										form.append('image', file);

										$.ajax({


										url: '/genie/employee/degreeimage/<?php echo $educations->id ?>',
										type: 'post',
										cache: false,
										contentType: false,
										processData: false,
										data: form,
										success: function(data) {
										var obj = JSON.parse(data);	
										if(obj.status){
											alert(obj.msg);
										}else{
											alert(obj.msg);
											
										}
										 
										} 
										});

										});



										//delete pic image
										$('#degreeimage_<?php echo $educations->id ?>').on('click', function(){ 


										 $.ajax({
										url: '/genie/employee/del_degreeimage/<?php echo $educations->id ?>',
										type: 'get',
										cache: false,
										contentType: false,
										processData: false, 
										success: function(data) { 
										var obj = JSON.parse(data);	
										if(obj.status){
											alert(obj.msg);
										}else{
											alert(obj.msg);
											
										}
										 
										 
										}
										 
										});
										});
									</script>
									
                                </div>
                            </div>-->
                        </div>
						
						  <div class="row">
						  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					 
						</div>
						  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						  
						   <button type="button" class="btn btn-success" style="margin-top:-77px;margin-left: 137px;" data-toggle="modal" data-target="#updateeducation_<?php echo $educations->id; ?>"><i class="fa fa-edit"></i></button>
						   <?php  if(Auth::user()->role == "admin"){ ?>
						    <button type="button" class="btn btn-danger" style="margin-top:-119px;margin-left: 191px;" id="deleducation_<?php echo $educations->id ?>" ><i class="fa fa-trash"></i></button> 
						   <?php } ?>
						   <script>
						   
							//delete Education
							$('#deleducation_<?php echo $educations->id ?>').on('click', function(){ 


							 $.ajax({
							url: '/genie/employee/del_education/<?php echo $educations->id ?>',
							type: 'get',
							cache: false,
							contentType: false,
							processData: false, 
							success: function(data) { 
							var obj = JSON.parse(data);	
							if(obj.status){
								alert(obj.msg);
								window.location=document.location.href;   
							}else{
								alert(obj.msg);
								
							}
							 
							 
							}
							 
							});
							});
						   </script>
						    
						   
						   <div class="modal fade" id="updateeducation_<?php echo $educations->id; ?>" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
												 <h4>Edit Education</h4>
												<div class="successexperience" style="color:#fff"></div>
												<div class="errorexperience"></div>
                                               
												
                                            </div>
                                            <div class="modal-body">
											
									<form action="" method="" class="editeducation" autocomplete="off">                                              
							<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-home"></i>
                                    </div> 
                                    <div class="nk-int-st">
									<input type="hidden" name="employee_id" value="{{ (isset($edit_data)) ? $edit_data->id:""}}">
									<input type="hidden" name="education_id" value="{{ (isset($educations)) ? $educations->id:""}}">
                                      
										<select class="selectpicker bootstrap-select fm-cmp-mg" name="education" data-rule="education" data-msg="Enter Gender">
										<option value="">Select Education</option>
										<option value="10th" @if ("10th"== old('education'))
									selected="selected"	
									  @else
										{{ (isset($educations) && $educations->education == "10th" ) ? "selected":"" }} @endif>10TH</option>
											<option value="12th" @if ("12th"== old('education'))
									selected="selected"	
									@else
										{{ (isset($educations) && $educations->education == "12th" ) ? "selected":"" }} @endif >12TH</option>
									  
									  <option value="Graduation" @if ("Graduation"== old('education'))
									selected="selected"	
									  @else
										{{ (isset($educations) && $educations->education == "Graduation" ) ? "selected":"" }} @endif>Graduation</option>
									  <option value="PostGraduation" @if ("PostGraduation"== old('education'))
									selected="selected"	
									@else
										{{ (isset($educations) && $educations->education == "PostGraduation" ) ? "selected":"" }}  @endif >Post Graduation</option>
										
										 

										</select>
										<div class="validation"></div>
									  
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Institute<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-institution"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="institute" value="{{ old('institute',(isset($educations)) ? $educations->institute:"")}}" placeholder="Enter Institute/College" data-rule="institute" data-msg="Enter Institute/College">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>University/Board<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="university_board" value="{{ old('university_board',(isset($educations)) ? $educations->university_board:"")}}" placeholder="Enter University/Board" data-rule="university_board" data-msg="Enter University/Board">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Certificate/Degree</h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="certificate" value="{{ old('certificate',(isset($educations)) ? $educations->certificate:"")}}" placeholder="Enter Certificate/Degree" data-rule="certificate" data-msg="Enter Certificate/Degree">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Specialisation<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="specialisation" value="{{ old('specialisation',(isset($educations)) ? $educations->specialisation:"")}}" placeholder="Enter Area of Specialisation" data-rule="specialisation" data-msg="Enter Specialisation Course">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>% Marks/ CGPA<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="percentage" value="{{ old('percentage',(isset($educations)) ? $educations->percentage:"")}}" placeholder="Enter % Marks/ CGPA" data-rule="percentage" data-msg="Enter % Marks/ CGPA">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                        
                           
                        </div>
						<div class="row">
                           
							 

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date From<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int" >
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control datefrom" name="education_from" value="{{ old('education_from',(isset($educations)) ? $educations->education_from:"")}}" placeholder="Select Education date From" data-rule="education" data-msg="Select Education Date From">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Education Date To<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control dateto" name="education_to" value="{{ old('education_to',(isset($educations)) ? $educations->education_to:"")}}" placeholder="Select Education Date To" data-rule="education_to" data-msg="Select Education Date To">
										<div class="validation"></div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
						 <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" name="submit">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
												</form>
											
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
						</div>
						</div>
				
				 		
						<hr>
						</div>
						
						
						<?php  }  ?>
						   
						    </div>
            </div>	
			
			
			 
			
                 
        </div>
    </div>
	
	<?php } ?>
    <!-- Form Element area End-->
    <!-- Datepicker area Start-->
      <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-file"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Upload Document:</h2>
										<p>Welcome to <span class="bread-ntd">Upload Document:</span></p>
											 
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	  <div class="form-element-area" style="margin-top: 15px;margin-bottom: 15px;">
        <div class="container">
			
			  <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
                            <h6></h6>    
												
                        </div>
						<form action="" method="post" autocomplete="off">
                       
					   <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Photo<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int image">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									  @if(!empty($edit_data->pic_image))
									<img src="{{asset('/upload/'.$edit_data->pic_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="picimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 
									@else
									<input type="file" class="form-control" name="photoimg" id="photoimg" style="width: 89px;">
									<a href="javascript:void(0);" id="getImage"></a>
									@endif
									                                  
										
                                    </div>
                                </div>
                            </div>   

							
							
							 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>PAN Card<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									 
                                         @if(!empty($edit_data->pan_image))
											 <?php $pdf =substr($edit_data->pan_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->pan_image)){ echo asset('/upload/'.$edit_data->pan_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="panimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
										 			<img src="{{asset('/upload/'.$edit_data->pan_image)}}" style="max-width:150px; height:100px; width:100px;">	 
								
									<a href="javascript:void(0);" id="panimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 
										 <?php } ?>
										 
									@else
									<input type="file" class="form-control" name="panimg" id="panimg" style="width: 89px;">
									<a href="javascript:void(0);" id="getPanImage"></a>
									@endif
									        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>AAdhar No<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st dz-message">
									 @if(!empty($edit_data->aadhar_image))
											 <?php $pdf =substr($edit_data->aadhar_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->aadhar_image)){ echo asset('/upload/'.$edit_data->aadhar_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="aadharimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
                                         
									<img src="{{asset('/upload/'.$edit_data->aadhar_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="aadharimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									@else
									<input type="file" class="form-control " name="aadharimg" id="aadharimg" style="width: 89px;">
									<a href="javascript:void(0);" id="getAadharImage"></a>
									@endif
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Appointment Letter (Croma Campus)<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int image">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									 @if(!empty($edit_data->appointment_image))
											 <?php $pdf =substr($edit_data->appointment_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->appointment_image)){ echo asset('/upload/'.$edit_data->appointment_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
									  
									<img src="{{asset('/upload/'.$edit_data->appointment_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									@else
									<input type="file" class="form-control" name="appointment_img" id="appointment_img" style="width: 89px;">
									<a href="javascript:void(0);" id="getappointment_img"></a>
									@endif
									                                  
										
                                    </div>
                                </div>
                            </div>   

							
							
							 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Last Education Doc<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									 
                                         @if(!empty($edit_data->education_image))
											 <?php $pdf =substr($edit_data->education_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->education_image)){ echo asset('/upload/'.$edit_data->education_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="educationimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
										 			<img src="{{asset('/upload/'.$edit_data->education_image)}}" style="max-width:150px; height:100px; width:100px;">	 
								
									<a href="javascript:void(0);" id="educationimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 
										 <?php } ?>
										 
									@else
									<input type="file" class="form-control" name="education_img" id="education_img" style="width: 89px;">
									<a href="javascript:void(0);" id="getEducationImage"></a>
									@endif
									        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Previous Company Appointment Letter<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st dz-message">
									 @if(!empty($edit_data->prev_appointment_image))
											 <?php $pdf =substr($edit_data->prev_appointment_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->prev_appointment_image)){ echo asset('/upload/'.$edit_data->prev_appointment_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="prev_appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
                                        
									<img src="{{asset('/upload/'.$edit_data->prev_appointment_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="prev_appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									@else
									<input type="file" class="form-control " name="prev_appointment_img" id="prev_appointment_img" style="width: 89px;">
									<a href="javascript:void(0);" id="get_prev_appointment_img"></a>
									@endif
                                    </div>
                                </div>
                            </div>
                        </div>
							<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Agreement<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st dz-message">
									 @if(!empty($edit_data->agreement_image))
											 <?php $pdf =substr($edit_data->agreement_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($edit_data->agreement_image)){ echo asset('/upload/'.$edit_data->agreement_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="agreement_image" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
                                         
									<img src="{{asset('/upload/'.$edit_data->agreement_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="agreement_image" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									@else
									<input type="file" class="form-control " name="agreement_img" id="agreement_img" style="width: 89px;">
									<a href="javascript:void(0);" id="getagreementImage"></a>
									@endif
                                    </div>
                                </div>
                            </div>
							</div>
					 
						 
						</form>
                       
                    </div>
                </div>
            </div>
            </div>
            </div>
    
    <!-- Start Footer area-->
	<script>
	 $(document).ready(function(){
		$('input[type="file"]').ezdz({
			text: 'Drag and drop',
			validators: {
				maxWidth:  4000,
				maxHeight: 4000
			},
			accept: function(e) 
			{
				console.log(e);
			},
			init	:   function(e) {console.log(e);},
			reject	: function(file, errors) {
				if (errors.mimeType) {
					alert(file.name + ' must be an image.');
				}

				if (errors.maxWidth) {
					alert(file.name + ' must be width:600px max.');
				}

				if (errors.maxHeight) {
					alert(file.name + ' must be height:400px max.');
				}
			}
		});
		

 
$("#getImage").click(function(){
$('#photoimg').trigger('click'); 
});

$('#photoimg').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/picimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete pic image
$('#picimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_picimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});
 
 // update pan image
$("#getPanImage").click(function(){
$('#panimg').trigger('click'); 
});

$('#panimg').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/panimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete pic image
$('#panimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_panimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});
 
 //aadhar image
$("#getAadharImage").click(function(){
$('#aadharimg').trigger('click'); 
});

$('#aadharimg').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/aadharimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete pic image
$('#aadharimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_aadharimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});



 //Appointment Letter (Croma Campus)*
$("#getappointment_img").click(function(){
$('#appointment_img').trigger('click'); 
});

$('#appointment_img').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/appointmentimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete Appointment Letter (Croma Campus)*
$('#appointmentimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_appointmentimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});


 //Last Education Doc*
$("#getEducationImage").click(function(){
$('#education_img').trigger('click'); 
});

$('#education_img').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/educationimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete Appointment Letter (Croma Campus)*
$('#educationimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_educationimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});
 

 //Previous Company Appointment Letter*
$("#get_prev_appointment_img").click(function(){
$('#prev_appointment_img').trigger('click'); 
});

$('#prev_appointment_img').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/preappointmentimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//delete Previous Company Appointment Letter*
$('#prev_appointmentimage').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_preappointmentimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});
 
 //Agreement on Stamp Paper*
$("#getagreementImage").click(function(){
$('#agreement_img').trigger('click'); 
});

$('#agreement_img').on('change', function(){ 

$("#preview").html('<img src="site/images/loading-icon.gif" alt="Uploading...." style="width:120px;height:120px;"/>');

var file = this.files[0];

var form = new FormData();
form.append('image', file);

$.ajax({


url: '/genie/employee/agreementimage/<?php echo $edit_data->id ?>',
type: 'post',
cache: false,
contentType: false,
processData: false,
data: form,
success: function(data) {
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
} 
});

});



//Agreement on Stamp Paper*
$('#agreement_image').on('click', function(){ 


 $.ajax({
url: '/genie/employee/del_agreementimage/<?php echo $edit_data->id ?>',
type: 'get',
cache: false,
contentType: false,
processData: false, 
success: function(data) { 
var obj = JSON.parse(data);	
if(obj.status){
	alert(obj.msg);
}else{
	alert(obj.msg);
	
}
 
 
}
 
});
});
 
		
		
	 });
	</script>
     @endsection