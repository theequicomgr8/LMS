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
										<h2>Deleted Employees</h2>
										<p>Welcome to <span class="bread-ntd">Deleted Employees</span></p>
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
                            <table id="data-table-employee-delete" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Joining Date</th>
                                        <th>Emp  Id</th>
                                        <th>Name</th>                                     
                                        <th>Mobile</th>
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