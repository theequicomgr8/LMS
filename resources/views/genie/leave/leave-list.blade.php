 @extends('genie.layouts.app')
 @section('title')
    Leave Applications You Applied
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
										<i class="notika-icon notika-windows"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Leave Report</h2>
										<p>Welcome to <span class="bread-ntd">Leave Applications You Applied</span></p>
										 <div class="basic-tb-hd">
                           
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
                        </div>
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
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                       
                        <div class="table-responsive">
                            <table id="data-table-leave" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>EMP ID</th>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Leave Day(Full Day/Half Day)</th>    
										<th>No of Days</th>										
										<th>LYH</th>										
										<th>Paid Leave</th>										
										<th>LWP</th>										 									
                                        <th>Applied On</th>                                        
										<th>Reason</th>
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