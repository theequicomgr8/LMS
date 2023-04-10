 @extends('genie.layouts.app')
 @section('title')
     Pay Invoice
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		  <!--<div class="page-title">-->
    <!--          <div class="title_left">-->
    <!--            <h3>Pay <small>Invoice</small></h3>-->
    <!--          </div>              -->
    <!--        </div>-->
			<div class="clearfix"></div>
		  <div class="row">
              
              
             <style>
             #invoice-paylist .table-responsive
             {
                     overflow-x: inherit;

             }
             #datatable-payinvoice_wrapper,#datatable-invoice-paylist_wrapper
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
              <div class="col-md-12 col-sm-12 " style="margin-top: 32px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pay Invoice</h2>
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
						  <?php  $role = Session::get('role');	 
						  if($role=="Admin"){						  
						  ?>
						  <div id="leads_filter" style="border-bottom:1px solid #E6E9ED;margin-bottom:20px;padding-bottom: 20px;    margin-top: -16px;
">
							<form method="GET" action="" novalidate autocomplete="off">
								<div class="form-group">
									<div class="col-md-3">
										<label>Trainer</label>
										<select class="form-control select_trainer" name="search[trainer]">
											<option value="">Select Trainer</option>
											@if(!empty($trainers))
												@foreach($trainers as $trainer)
													@if(isset($search['trainer']) && $search['trainer']==$trainer->id)
														<option value="{{ $trainer->id }}" selected>{{ $trainer->name }}</option>
													@else
														<option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
								  
								<div class="form-group">
									<div class="col-md-3">
										<label>Course</label>
										<select class="form-control select_course" name="search[course]">
											<option value="">Select Course</option>
											@if(!empty($courses))
												 
												@foreach($courses as $course)
													@if(isset($search['course']) && $search['course']==$course->id)
														<option value="{{ $course->id }}" selected>{{ $course->course }}</option>
													@else
														<option value="{{ $course->id }}">{{ $course->course }}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
								 
								 
								<div class="form-group">
									<div class="col-md-3">
								 <label></label>

									 
										<button type="submit" class="btn btn-block btn-info mb-0 mt-2">Filter</button>
									</div>
								</div>
							</form>
						</div>
						  <?php } ?>
                            <div class="card-box table-responsive">
                   
					
                    <table id="datatable-payinvoice" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         
                           
                          <th>Date</th>						  
                          <th>Batch Name</th>
                          <th>Course</th>                         
                          <th>Invoice</th>
                          <th>Paid Amount </th>
                          <th>Advance </th>
                          <th>Balance</th>
                          <th>File</th>
                          <th>Pay List</th>
                           
                        </tr>
                      </thead>
					<!--	<tbody>
						<?php 
					//	echo "<pre>";print_r($invoices); 
						if(!empty($invoices)){
							foreach($invoices as $invoice){
								

								 
						?>
						<tr>
						 
							 
						 
						<td><?php echo date('d-M-Y',strtotime($invoice->invoice_date)); ?></td>
						
						<td><?php 
						$trainer = App\FeesTrainer::where('trainer_id',$invoice->trainer_pay_id)->first();
						if($trainer){ echo $trainer->name; }  ?></td>
						<td><?php  
						$batch = App\FeesBatches::where('id',$invoice->batch_id)->first();
					if(!empty($batch)){
						echo $batch->batch_name;
						
					}
						?></td>						
						<td><?php  
							$result_courses = unserialize($invoice->technology);
							
							if( count($result_courses) > 0 && !empty($result_courses) ) {

							foreach( $result_courses as $id ) {

							if( !empty($id) ) {

							$course = App\FeesCourse::where('id',$id)->first();
							if(!empty($course)){
							echo ucfirst($course->course);

							}
							}
							}

							}
 
						?></td>					 
						<td><?php echo $invoice->amount; ?></td>
						<td><?php echo $invoice->pay_amount; ?></td>
						<td><?php 
						$paytrainer = App\FeesPayTrainer::where('trainer_id',$invoice->trainer_pay_id)->select('advance_amount')->first();

						if(!empty($paytrainer)){
						echo $paytrainer->advance_amount;  }  ?>
						</td>
						<td><?php  
						if(!empty($paytrainer)){
						$balance_amm= (($invoice->amount) - ($paytrainer->advance_amount+$invoice->pay_amount));
						echo $balance_amm;
						}
						?></td>
						 
						<td> </td>
						 
						</tr>   
						<?php } } ?>						
						</tbody>  -->                    
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
						<button type="button" class="close" data-dismiss="modal">x</button>
						
					</div>
					<div class="modal-body" style="padding-top:10px;">
					</div>
					 
				</div>

			</div>
		</div>
    
     @endsection