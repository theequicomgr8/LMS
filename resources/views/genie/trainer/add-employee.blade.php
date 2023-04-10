 @extends('genie.layouts.app')
 @section('title')
     Add Employee  
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
										<i class="fa fa-money"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Add Employee</h2>
										<p>Welcome to <span class="bread-ntd">Add Employee</span></p>
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
 
	 
	<!-- Breadcomb area End-->
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        
                        <div class="cmp-tb-hd bcs-hd">
                            <h6>Add Employee Details</h6>
                           
                        </div>
						
						<form action="{{url('genie/employee/add')}}" method="post" class="" autocomplete="off">
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
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{ old('first_name')}}" >
											@if ($errors->has('first_name'))
											<small class="error">{{ $errors->first('first_name') }}</small>
											@endif
										 
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
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name')}}" placeholder="Enter Last Name" >
										@if ($errors->has('last_name'))
											<small class="error">{{ $errors->first('last_name') }}</small>
											@endif
									 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							 <div class="nk-int-mk">
                                    <h6>Enter Role<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-tasks"></i>
                                    </div>
                                    <div class="nk-int-st">
                                      <select class="selectpicker bootstrap-select fm-cmp-mg" name="role" data-rule="marital_status" data-msg="Enter Marital Status">
											<option value="">Enter Role</option>
											<option value="Admin" @if ("Admin"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Admin" ) ? "selected":"" }} @endif >Admin</option>
											
											<option value="Manager" @if ("Manager"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Manager" ) ? "selected":"" }} @endif >Manager</option>
											
											<option value="User" @if ("User"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "User" ) ? "selected":"" }} @endif >User</option>
											
											
									 
											
											
											
											</select>
										 @if ($errors->has('role'))
											<small class="error">{{ $errors->first('role') }}</small>
											@endif
                                    </div>
                                </div>
                            </div>
							</div>
							   <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Email<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter Email" >
										@if ($errors->has('email'))
											<small class="error">{{ $errors->first('email') }}</small>
											@endif
										 
                                    </div>
                                </div>
                            </div>
							
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Mobile<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="mobile" value="{{ old('mobile')}}" placeholder="Enter mobile" >
										@if ($errors->has('mobile'))
											<small class="error">{{ $errors->first('mobile') }}</small>
											@endif
										 
                                    </div>
                                </div>
                            </div>
							
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							  <div class="nk-int-mk">
                                    <h6>Password<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="password" value="{{ old('password')}}" placeholder="Enter Password" >
										@if ($errors->has('password'))
											<small class="error">{{ $errors->first('password') }}</small>
											@endif
										 
                                    </div>
                                </div>
                            </div>
							
							
							
                        </div> 
						
						 
						   
                        
						 
						 
						 
						
						
						<div class="row">
						<button class="btn btn-success notika-btn-success waves-effect" name="submit" style="margin-left: 38%;width:200px">Submit</button>
						</div>
						 
						</form>
                    </div>
                </div>
            </div>
            
			  </div>
    </div>
    <!-- Form Element area End-->
    
     @endsection