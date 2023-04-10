 @extends('genie.layouts.app')
 @section('title')
     Feed Back Question
@endsection
@section('content')	
    <div class="right_col" role="main">
				<div class="">
					 
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
							<div class="x_panel">
								<div class="x_title">
									<h2> Feed Back Question</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form class="form-horizontal form-label-left"  onsubmit="return studentsController.feedbackQuestion(this)">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select  name="heading" class="form-control" >
												<option value="">Select heading</option>
												<option value="trainer_facilitator">Trainer / Facilitator</option>
												<option value="handson_activities">Hands-On / Activities</option>
												<option value="education_counsellor">Education Counsellor</option>
												</select>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Question <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea type="text" name="question" class="form-control" placeholder="Enter Question">
												</textarea>
											</div>	
										</div>									
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Answer Type <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select name="ans_type" class="form-control">
												<option value="">Slect Ans Type</option>
												<option value="rating">Rating</option>
												<option value="yes">Yes / No</option>
												</select>
											</div>
										</div>
										 
										 
										 
										<div class="ln_solid"></div>
										<div class="item form-group mb-0">
											<div class="col-md-6 col-sm-6 offset-md-3">
												 									 
												<button class="btn btn-primary" type="reset" name="reset">Reset</button>										 
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