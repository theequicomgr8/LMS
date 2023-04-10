 @extends('genie.layouts.app')
 @section('title')
     Daily Log
@endsection
@section('content')	
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <div class="right_col" role="main">
        <div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Day <small>Log</small></h3>
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
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						<div class="x_title">
							<h2>Day<small> Log</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Settings 1</a>
										<a class="dropdown-item" href="#">Settings 2</a>
									</div>
								</li>
								<li><a class="close-link"><i class="fa fa-close"></i></a></li>
							  
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
													<label class="filter-btn-label" for="from_date">From Date</label>
							<input type="text" placeholder="From date" value="<?php if(isset($search['date_from'])){ echo $search['date_from']; } ?>" name="search[date_from]"  class="form-control datefrom" autocomplete="off">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-3">
													<label class="filter-btn-label" for="to_date">To Date</label>
														<input type="text" placeholder="To date" value="<?php if(isset($search['date_to'])){ echo $search['date_to']; } ?>" name="search[date_to]" class="form-control dateTo" autocomplete="off">
												</div> 
											</div> 
											<div class="form-group">
												<div class="col-md-3"><?php //echo $search['role']; ?>
													<label>Role</label>
													<select class="form-control" name="search[role]">
														<option value="all">Select All</option>
														<option value="Trainer" <?php if(isset($search['role']) && $search['role']=="Trainer" ){ echo "selected"; } ?> selected>Trainer</option>
														<option value="Student" <?php if(isset($search['role']) && $search['role']=="Student" ){ echo "selected"; } ?>>Student</option>
														<option value="Admin" <?php if(isset($search['role']) && $search['role']=="Admin" ){ echo "selected"; } ?>>Admin</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-3">
													<label>Live Class</label>
													<select class="form-control" name="search[live]">
														<option value="all">All</option>
														<option value="Yes"<?php if(isset($search['live']) && $search['live']=="Yes" ){ echo "selected"; } ?>>Yes</option>
														<option value="No"<?php if(isset($search['live']) && $search['live']=="No" ){ echo "selected"; } ?>>No</option>
														
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-3">
													<label>Course Marked</label>
													<select class="form-control" name="search[course_mark]">
														<option value="all">All</option>
														<option value="Yes"<?php if(isset($search['course_mark']) && $search['course_mark']=="Yes" ){ echo "selected"; } ?>>Yes</option>
														<option value="NO"<?php if(isset($search['course_mark']) && $search['course_mark']=="NO" ){ echo "selected"; } ?>>NO</option>
														
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
								<?php	} ?>
									<div class="card-box table-responsive">
										<table id="datatable-dayLog" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>  
													<th>Date</th>						  
													<th>Name</th>	
													<th>Mobile</th>
													<th>Role</th>                         
													<th>Technology</th>
													<th>Batch</th>
													<th>LC </th>
													<th>CM </th>
												 
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
    <div id="invoice-paylist" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Payment List</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>	
				</div>
				<div class="modal-body" style="padding-top:0">
				</div>
					 
			</div>
		</div>
	</div>
	 
 
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<script>
		$('.datefrom').datepicker({
			startView: 1,
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			dateFormat: "yy-mm-dd",	 
			todayHighlight: true  
		});   

		$('.dateTo').datepicker({
			startView: 1,
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			dateFormat: "yy-mm-dd",	 
			todayHighlight: true  
		});   

	</script>
  
    
     @endsection
	