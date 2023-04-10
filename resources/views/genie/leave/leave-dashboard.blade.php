 @extends('genie.layouts.app')
 @section('title')
    Leave Dashboard You Applied
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
										<h2>Leave Dashboard</h2>
										<p>Welcome to <span class="bread-ntd">Leave Dashboard You Applied</span></p>
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
                            <table id="data-table-leave-dashboard" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Emp ID</th>
                                        <th>Name</th>
                                        <th>Carry forward Leaves</th>
                                        <th>Current Leaves</th>
                                        <th>Total Leaves</th>
                                        <th>Leaves Taken</th>
                                        <th>Balance Leaves</th>                                  
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