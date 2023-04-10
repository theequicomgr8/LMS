 @extends('genie.layouts.app')
 @section('title')
     View Employee  
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
										<h2>Employee View Details:</h2>
										<p>Welcome to <span class="bread-ntd">Employee View Details:</span></p>											 
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
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list employee-details">
                        
                        <div class="cmp-tb-hd bcs-hd">
                            <h6>View Employee Details</h6>
							 
                           
                        </div>
						 
					 
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                         
							                                
							  <div class="nk-int-mk">
                                    <h6>First Name<span class="required">*</span></h6>
                                </div>
							<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{((isset($view_data)) ? $view_data->first_name:"")}}
									 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    
							    <div class="nk-int-mk">
                                    <h6>Middle Name<span class="required">*</span></h6>
                                </div>
								<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       {{ ((isset($view_data)) ? $view_data->middle_name:"")}} 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>last Name<span class="required">*</span></h6>
                                </div>
							  
								<div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->last_name:"")}}
                                        
										
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
									{{ ((isset($view_data)) ? $view_data->father_name:"")}}
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="nk-int-mk">
									<h6>Primary Email <span class="required">*</span></h6>
									</div>
						                                
							   <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->email:"")}}
                                        
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
									{{ ((isset($view_data)) ? $view_data->mobile:"")}}
                                       
                                    </div>
                                </div>
                            </div>
                          
                        </div>
						
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="nk-int-mk">
									<h6>Designation<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-mortar-board"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->position_apply:"")}}
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Emergency Mobile<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->emergency_mobile:"")}}
                                        
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
									{{ (isset($view_data) ? $view_data->marital_status:"") }}
											 	
											 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="nk-int-mk">
									<h6>Gender</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="nk-int-st">
                                       	{{ (isset($view_data)?$view_data->gender:"") }}
											 
											 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <div class="nk-int-mk">
									<h6>Date of Birth<span class="required">*</span></h6>
									</div>
 
							   <div class="form-group ic-cmp-int" id="dob">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-calculator"></i>
                                    </div>
                                    <div class="nk-int-st">	
									{{ ((isset($view_data)) ? $view_data->dob:"")}}
                                        
										
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="nk-int-mk">
									<h6>Refrence Name</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->refrence_name:"")}}
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        
						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Refrence Mobile</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->refrence_mobile:"")}}
                                       
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="nk-int-mk">
									<h6>Permanent Address<span class="required">*</span></h6>
									</div>
                                <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-house"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->permanent_address:"")}}
                                         
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
									{{ ((isset($view_data)) ? $view_data->current_address:"")}}
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
						
						 <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->passport_no:"")}}
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->pan_no:"")}}
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
									{{ ((isset($view_data)) ? $view_data->aadhar_no:"")}}
                                         
                                    </div>
                                </div>
                            </div>
                        </div> 
						
						 
						
						
						 
						 
						 
                    </div>
                </div>
            </div>
           
		   <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
							<h2>Employee Official Details</h2>
												
                        </div>
						<form action="" method="post" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                	<div class="nk-int-mk">
									<h6>Company Email </h6>
									</div>
                                <div class="form-group ic-cmp-int image">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									 {{ ((isset($view_data)) ? $view_data->company_email:"")}}
									                                  
										
                                    </div>
                                </div>
                            </div>   

							
							
							 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <div class="nk-int-mk">
									<h6>Company Mobile</h6>
									</div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                         {{ ((isset($view_data)) ? $view_data->company_email:"")}}
									        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="nk-int-mk">
                                    <h6>Role</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        {{ ((isset($view_data)) ? $view_data->role:"")}}
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="nk-int-mk">
                                    <h6>Date of Joining</h6>
                                </div>
                                <div class="form-group ic-cmp-int image">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									 {{ ((isset($view_data)) ? $view_data->dateofjoining:"")}}
									                                  
										
                                    </div>
                                </div>
                            </div>   

							
							
							 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Department<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                         {{ ((isset($view_data)) ? $view_data->department:"")}}
									        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="nk-int-mk">
                                    <h6>Employee Code<span class="required">*</span></h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        {{ ((isset($view_data)) ? $view_data->emp_code:"")}}
                                    </div>
                                </div>
                            </div>
                        </div>
						
					 
						 
						</form>
                       
                    </div>
                </div>
            </div>
			
			
			
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd" style="margin-bottom: -59px;">
                            <h6>Company Experience</h6>                             
                        
					   </div>
						
						</div>
						
						 
						
						<?php if(!empty($employeeexperience)) {
							$i=0;
						foreach($employeeexperience as $experience){
							$i++;
						?>
						 
						<div class="form-element-list  experience">
						 <hr>
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
						
						  
				 		
						
						</div>
						
						 
						<?php  } } ?>
						   
						    </div>
            </div>	
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd" style="margin-bottom: -59px;">
                            <h6>Education Details</h6>                             
                        
					   </div>
						
						</div>
						
						 
						
						<?php if(!empty($employeeeducations)) {
							$i=0;
						foreach($employeeeducations as $educations){
							$i++;
						?>
						 
						<div class="form-element-list  experience">
						 <hr>
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
									 
									@endif
                                    </div>
									 
									
                                </div>
                            </div>
                        </div>
						
						  
				 		
						
						</div>
						
						 
						<?php  } } ?>
						   
						    </div>
            </div>	
			
			
			 <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="cmp-tb-hd">
                            <h6>Document Upload</h6>    
												
                        </div>
						<form action="" method="post" >
                       
					   <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>Photo</h6>
                                </div>
                                <div class="form-group ic-cmp-int image">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
									  @if(!empty($view_data->pic_image))
									<img src="{{asset('/upload/'.$view_data->pic_image)}}" style="max-width:150px; height:100px; width:100px;">										 
									@endif
									                                  
										
                                    </div>
                                </div>
                            </div>   

							
							
							 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>PAN Card</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                    <div class="nk-int-st">
                                         @if(!empty($view_data->pan_image))
									<img src="{{asset('/upload/'.$view_data->pan_image)}}" style="max-width:150px; height:100px; width:100px;">										 
									@endif
									        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h6>AAdhar No</h6>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        @if(!empty($view_data->aadhar_image))
									<img src="{{asset('/upload/'.$view_data->aadhar_image)}}" style="max-width:150px; height:100px; width:100px;">	
									 
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
									  

								@if(!empty($view_data->appointment_image))
											 <?php $pdf =substr($view_data->appointment_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($view_data->appointment_image)){ echo asset('/upload/'.$view_data->appointment_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
									  
									<img src="{{asset('/upload/'.$view_data->appointment_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									 
									 
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
                                       
                                         @if(!empty($view_data->education_image))
											 <?php $pdf =substr($view_data->education_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($view_data->education_image)){ echo asset('/upload/'.$view_data->education_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="educationimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
										 			<img src="{{asset('/upload/'.$view_data->education_image)}}" style="max-width:150px; height:100px; width:100px;">	 
								
									<a href="javascript:void(0);" id="educationimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 
										 <?php } ?>
										 
									 
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
                                    <div class="nk-int-st">
                                        @if(!empty($view_data->prev_appointment_image))
											 <?php $pdf =substr($view_data->prev_appointment_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($view_data->prev_appointment_image)){ echo asset('/upload/'.$view_data->prev_appointment_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="prev_appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
                                        
									<img src="{{asset('/upload/'.$view_data->prev_appointment_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="prev_appointmentimage" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									 
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
									 @if(!empty($view_data->agreement_image))
											 <?php $pdf =substr($view_data->agreement_image, -3); 
										 if($pdf=='pdf'){
										 ?>									 
								<a href="https://docs.google.com/viewer?url=<?php if(!empty($view_data->agreement_image)){ echo asset('/upload/'.$view_data->agreement_image); } ?>" target="_blank">View</a>								
									<a href="javascript:void(0);" id="agreement_image" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
									
										 <?php }else{ ?>
                                         
									<img src="{{asset('/upload/'.$view_data->agreement_image)}}" style="max-width:150px; height:100px; width:100px;">	
									<a href="javascript:void(0);" id="agreement_image" class="btn btn-inverse btn-circle m-b-5 deleteIcon"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
										 <?php } ?>
									 
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
 
   
     
    
 
	  @endsection