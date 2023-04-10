 @extends('genie.layouts.app')
 @section('title')
     User List  
@endsection
@section('content')	
	<!-- Breadcomb area Start-->
	 
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>User List</h2>
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
                        <div class="table-responsive">
                            <table id="data-table-user" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>                                         
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>                                     
										<th>Action</th>
                                       
                                    </tr>
                                </tfoot>
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