 @extends('genie.layouts.app')
 @section('title')
    Rool Allotment
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
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
				 
						
                    <h2>Room Allotment</h2>
                     
					 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-attendance" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         <th>Floor / Room No</th>
							<th>Time Batch</th>
                          
                        </tr>
                      </thead>
					  <tbody>
					  
                        <tr>
                          <td>Tiger</td>
                          <td>Nixon</td>
                          
                        </tr>
                        <tr>
                          <td>Garrett</td>
                          <td>Winters</td>
                          
                        </tr>
                         
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
    
    @endsection