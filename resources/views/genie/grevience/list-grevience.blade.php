 @extends('genie.layouts.app')
 @section('title')
     User
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Grevience<small>List</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
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
                   
					
                            <!--  Table start -->
                            <table class="table table-bordered table-striped" id="Grevence-datatable">
                        		<thead>
                        			<tr>
                        				<th>ID</th>
                        				<th>Name</th>
                        				<th>Mobile</th>
                        				<th>Related</th>
                        				<th>Status</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        		   
                                </tbody>
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
      
     <script src="https://code.jquery.com/jquery-3.6.4.js"></script>   

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
     @endsection