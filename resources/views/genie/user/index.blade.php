 @extends('genie.layouts.app')
 @section('title')
     User
@endsection
@section('content')	
<style>
    .dataTables_wrapper {
    position: relative;
    clear: both;
    zoom: 1;
    padding-left: 0px;
    padding-right: 0px;
}
</style>
    <div class="right_col" role="main">
          <div class="">
		  <!--<div class="page-title">-->
    <!--          <div class="title_left">-->
    <!--            <h4>User List</h4>-->
    <!--          </div>              -->
    <!--        </div>-->
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
              <div class="col-md-12 col-sm-12" style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
         
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-userlist" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Role</th>
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
            </div>
          </div>
        </div>
          
    
     @endsection