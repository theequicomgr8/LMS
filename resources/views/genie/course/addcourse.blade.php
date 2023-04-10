 @extends('genie.layouts.app')
 @section('title')
     Add Course
@endsection
@section('content')	


    <div class="right_col" role="main">
				<div class="">
					<!--<div class="page-title">-->
					<!--<div class="title_left">-->
					<!--<h4>Add Course</h4>-->
					<!--</div>              -->
					<!--</div>-->
		 
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12" style="margin-top: 32px;">
							<div class="x_panel">
								<div class="x_title">
									<h2>Course Form</h2>
									 
									@if(Session::has('success')) 	
									<div class="row">
									<div class="col-md-8 col-md-offset-1">
									<div class="alert alert-success">
									<strong>Success!</strong> {{Session::get('success')}}
									</div>
									</div>
									</div>
									@endif
									@if(Session::has('failed')) 	
									<div class="row">
									<div class="col-md-8 col-md-offset-1">
									<div class="alert alert-danger">
									<strong>!</strong> {{Session::get('failed')}}
									</div>
									</div>
									</div>
									@endif
								 
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									
																	<?php
								$headinglistid=[];
								if(!empty($coursesheadinglist)){
								foreach($coursesheadinglist as $coursesheading){
								array_push($headinglistid ,$coursesheading->course_id );
								}
								}

								//echo "<pre>";print_r($headinglistid);die; ?>

									<form id="demo-form2" method="post" class="form-horizontal form-label-left" action="{{url('course/add')}}" enctype="multipart/form-data">
								{{ csrf_field() }}
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Course <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<select name="course" class="form-control select_course">
											<option value=""></option>
											<?php	
											if(!empty($feescourses)){
											foreach ($feescourses as $course){
											if(in_array($course->id, $headinglistid)){
											}else{  												 
											 ?>
											<option value="{{$course->id}}"> {{$course->course}}</option>
										<?php	
											}
											} }
										?>
											</select>
												 @if ($errors->has('course'))
											<small class="error">{{ $errors->first('course') }}</small>
											@endif
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select File <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="first-name" name="file" accept=".xls,.xlsx"  class="form-control ">
												@if ($errors->has('file'))
											<small class="error">{{ $errors->first('file') }}</small>
											@endif
											</div>
										</div>
										 
										 
										<div class="ln_solid"></div>
										<div class="item form-group mb-0">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												 
												<button type="submit" class="btn btn-success">Submit</button>
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
	<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>-->
      <script>
	 
		  
	
		  
	      </script>
    
     @endsection