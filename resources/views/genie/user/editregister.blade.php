 @extends('genie.layouts.app')
 @section('title')
     Edit User
@endsection
@section('content')	
    <div class="right_col" role="main">
				<div class="">
					 
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12" style="margin-top: 32px;">
							<div class="x_panel">
								<div class="x_title">
									<h2>User Form</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
			
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form class="form-horizontal form-label-left"  onsubmit="return userController.editRegisterSubmit(this)">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input type="hidden" name="user_id" id="user_id" value="{{((isset($edit_data)) ? $edit_data->id:"")}}" >
												<input type="text" name="name" class="form-control" value="{{ old('name',(isset($edit_data)) ? $edit_data->name:"")}}" placeholder="Enter Name">
											</div>
										</div>									
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="email" class="form-control" value="{{ old('email',(isset($edit_data)) ? $edit_data->email:"")}}" placeholder="Enter Email">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mobile</label>
											<div class="col-md-6 col-sm-6 ">
												<input  type="text" name="mobile" class="form-control" value="{{ old('mobile',(isset($edit_data)) ? $edit_data->mobile:"")}}" placeholder="Enter Mobile">
											</div>
										</div>
										 <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Role <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<select name="role" class="form-control">
											<option value=""> Select Role</option>											
											<option value="Admin" @if ("Admin"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Admin" ) ? "selected":"" }} @endif> Admin</option>
											<option value="Manager" @if ("Manager"== old('role'))
									selected="selected"	
									@else
									{{ (isset($edit_data) && $edit_data->role == "Manager" ) ? "selected":"" }} @endif> Manager</option>
											</select>
												 
											</div>
										</div>
										 
										<div class="ln_solid"></div>
										<div class="item form-group mb-0">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>										 
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

					 
			<!-- footer content -->
		 
			<!-- /footer content -->
		</div>
	</div>
      
    
     @endsection