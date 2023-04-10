 @extends('genie.layouts.app')
 @section('title')
     Paid Invoice
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		  <!--<div class="page-title">-->
    <!--          <div class="title_left">-->
    <!--            <h4>Paid Invoice</h4>-->
    <!--          </div>              -->
    <!--        </div>-->
			<div class="clearfix"></div>
		  <div class="row">
              
              
             <style>
             #invoice-paylist .table-responsive
             {
    overflow-x: inherit;
             }
             
             #datatable-paidinvoice_wrapper,#datatable-invoice-paylist_wrapper
             {
                 padding:0px;
             }
             
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
                    <h2>Paid Invoice</h2>
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
                   
					
                    <table id="datatable-paidinvoice" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         
                           
                          <th>Date</th>						 
                          <th>Batch Name</th>
                          <th>Course</th>                         
                          <th>Invoice</th>
                          <th>Paid Amount</th>						  
                          <th>Advance </th>
                         <!-- <th>Balance</th>-->
                            <th>File</th>
                          <th>Pay list</th>
                          
                           
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
<button type="button" class="close assignclose" data-dismiss="modal">×</button>						
					</div>
					<div class="modal-body" style="padding-top:10px;">
					</div>
					 
				</div>

			</div>
		</div>
    
     @endsection