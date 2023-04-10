 @extends('genie.layouts.app')
 @section('title')
    All Courses
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		    <!--<div class="page-title">-->
      <!--        <div class="title_left">-->
      <!--          <h3>Course <small>List</small></h3>-->
      <!--        </div>              -->
      <!--      </div>-->
			 <div class="clearfix"></div>
		  <div class="row">
              <style>
              .close {
    font-size: 32px;
}
              .dataTables_wrapper {
    position: relative;
    clear: both;
    zoom: 1;
    padding-left: 0px;
    padding-right: 0px;
}
			 .dataTables_length{
				 float: left;
			 }
			 div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    float: right;
}
             </style>
              
             
              <div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Course List</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
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
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-allcourse" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Course</th>                           
                          <th>Content</th>
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