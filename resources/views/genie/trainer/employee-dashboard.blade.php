 @extends('genie.layouts.app')
 @section('title')
     Dashboard  
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
										<i class="fa fa-dashboard"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Dashboard</h2>
										<p>Welcome to <span class="bread-ntd">Employee Dashboard</span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<a title="Download Report" class="btn" href="{{url('genie/dashboard/get-dashboardexpert')}}"><i class="notika-icon notika-sent"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="sale-statistic-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     
                        
						 <div class="data-table-list">
						<div class="table-responsive">
                            <table id="data-table-employee-dashboard" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Emp Id</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Salary</th>
                                        <th>Leaves</th>
                                        <th>Incentive</th>
										<th>Ext.W</th>
                                        <th>P.Ad</th>
										<th>Payable</th>
                                        <th>Paid</th>   
										<th>Balance</th>
										<th>C.Ad</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
								
								
                                 
                            </table>
                        </div>
					
					</div>
						 
                   
                </div>
			</div>
			
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="javascript:dashboardController.adjust()" title="Pay Invoice" class="btn btn-success notika-btn-success" style="margin-left: 84px;margin-top: 10px;">Adjust Invoice</a>
				</div>
				</div>
        </div>
    </div>
    <!-- End Sale Statistic area-->
   
    @endsection