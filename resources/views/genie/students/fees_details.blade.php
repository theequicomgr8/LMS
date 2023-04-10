@extends('genie.layouts.app')
@section('title')
     Fees Details
@endsection
@section('content')	

         <style>
             
              .btn-primary
            {
                background-color: #13293e;
    border-color: #13293e;
            }
            .btn-primary:hover {
    color: #fff;
    background-color: #13293e;
    border-color: #13293e;
}
.modal-header {
    padding: 6px 31px 8px;
    color: #000;
}
@media only screen and (max-width: 991px) {
#data-table-fees-list{
display: block;
    width: 100%;
    overflow-x: auto;
}
}

         </style>
        <?php //echo "<pre>"; print_r($students); die;?> 
      <div class="right_col padding-student-top" role="main">
          <div class="">
            
            <div class="clearfix"></div>
			 
            <div class="row">
              <div class="col-md-8">
               	  

        @if(!empty($students))
			<?php $k=0; ?>
        @foreach($students as $student)
		 
			 <?php $k++;
			   
			   if($k=='1'){
			       
			       $calscolor="first";
			   }else if($k=='2'){
			       
			       $calscolor="second";
			   }else if($k=='3'){
			       
			        $calscolor="third";
			   }else if($k=='4'){
			       
			        $calscolor="four";
			   }else if($k=='5'){
			       
			         $calscolor="five";
			   }else if($k=='6'){
			       
			         $calscolor="six";
			   }else if($k=='7'){
			         $calscolor="seven";
			       
			   }else if($k=='8'){
			         $calscolor="eight";
			   }else if($k=='9'){
			       
			         $calscolor="nine";
			   }
			   ?>
			   <div class="fee1 content-deliver" style="background:none; box-shadow:none;">
                  <!--<div class="fee-heading1 content-deliver-heading1">-->
                  <!--  <h4>Fee Details <?php if($student->course){ echo $student->course; } ?> </h4>                     -->
                  <!--</div>-->

                  <div class="new-fee-sec <?php echo $calscolor; ?>">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-3 new-fee-item1" >
                            <a href="https://www.cromacampus.com/payment" target="_blank"><div class="hexshape">
                              <img src="{{asset('/img/new-fee.png')}}" alt="new-fee-course-icon"  style="max-width:100%; height:116px;">
                              </a>
                               
                            </div>
                            
                          </div>
                          <div class="col-md-7 new-fee-item2">
                              <div class="course-fee-dtl">
                                  <h2><?php if($student->course){ echo $student->course; } ?></h2>
                                  <h2>Batch Name: <?php if($student->batch_name){ echo $student->batch_name; }?></h2>
                                  <hr>
                                  <div class="d-flex fee-dtl-btn">
                                      <p>Total Fees : <?php if($student->to_be_paid){ echo $student->to_be_paid; }?></p>
                                    <p>Paid Fees : <?php  
                                    //  Cache::forget('wp_fees_details');
                                    // $feespending=cache()->remember('wp_fees_details',60*60*24,function(){
                                    // 	return DB::connection('mysql2')->table('wp_fees_details as fees')->where('s_id',$student->std_id)->sum('paid_amt');
                                    // });
                                    
                                    
                                    
                                    $feespending = DB::connection('mysql2')->table('wp_fees_details as fees')->where('s_id',$student->std_id)->sum('paid_amt');
                                    if($feespending){ 				
                                    $paid = $feespending;  
                                    }else{ $paid=0; }
                                    echo $paid;
                                    ?></p>
                                      <p>Balance : <?php $balance = $student->to_be_paid - $paid; 
									  echo $balance;?></p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-2 new-fee-item3" style="max-width: 18%; flex: 0 0 18%;">
                            <div class="fee-recipt-dtl">
                                <div class="fee-recipt-item">
                                 <a href="#">
                                 <div>
                                 <p>Payment Receipt</p>
                                 <a href="javascript:void(0);" id="" data-toggle="modal" data-target="#studetns_slip<?php echo (isset($student->id)?$student->id:""); ?>"><img src="{{asset('/img/fee-receipt.png')}}" alt="fee-receipt"></a>

								<div id="studetns_slip<?php echo (isset($student->id)?$student->id:""); ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title">Fee Receipt</h5> <button type="button" class="close assignclose"  data-dismiss="modal"> &times;</button>
							</div>
							<div class="modal-body" style="margin-top: -36px;">
							<div class="panel-body" >


							<div class="x_content">
							<div class="row">
							<div class="col-sm-12">
							<table id="data-table-fees-list" border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
							
							 <thead>
                                <tr>
                                  <th>Date</th>						  
                                  <th>Name</th>
                                  <th>Course</th>
                                  <th>Amount</th>
                                  <th>Mode</th>
                                  <th>Slip</th>                 
                                </tr>
                      </thead>
						<?php  
						$feesDetails = App\FeesDetails::where('s_id',$student->std_id)->get();		
						
						/*$feesDetails=cache()->remember('fee_sk',60*60*24,function(){
                        	return App\FeesDetails::where('s_id',$student->std_id)->get();
                        });*/
                        
						if($feesDetails){
							 
						foreach($feesDetails as $fees){
							 $feesstudent = App\FeesStudents::where('id',$student->std_id)->first();		
							 
						   ?>
						<tr>
						<td><?php if(!empty($fees->paid_on)){ echo date('d M Y',strtotime($fees->paid_on)); } ?></td>
						<td><?php if(!empty($feesstudent->name)){ echo $feesstudent->name; } ?></td>
						<td><?php $feesCourse = App\FeesCourse::where('id',$feesstudent->courses)->first(); 
						if(!empty($feesCourse->course)){ echo $feesCourse->course; } ?></td>
						<td><?php if(!empty($fees->paid_amt)){ echo $fees->paid_amt; } ?></td>
						<td><?php if(!empty($fees->payment_mode)){ echo $fees->payment_mode; } ?></td>
						<td>  <a href="javascript:void(0);" id="studentSlipReceipt" title="Students Slip" data-sid="<?php echo $fees->id; ?>"><i class="fa fa-print" aria-hidden="true"></i></a></td></tr>						
						<?php  } } ?> 
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
                                 </a>
                                </div>
                                <div class="fee-recipt-item2">
                                  <div>
                                  <p>Due Date <br><span><?php  if(!empty($student->next_due_date) && ($student->next_due_date !="0000-00-00 00:00:00") ){  echo date('d-M-Y',strtotime($student->next_due_date) ); }else{  echo "N/A"; } ?></span></p>
                                    
                                  </div>                                
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
				
				@endforeach
				@endif
                <!--<div class="fee">
                  <div class="fee-heading">
                    <h4>Fee Details</h4>
                    <a href="#0"><i class="fa fa-download"></i></a>
                  </div>
                  <div class="fee-sections">
                    <div class="fee-status">
                      <div class="fee-status-heading">
                        <p class="strong-heading">Course Name</p>
                        <span>:</span>
                        <p>Python Learning Training</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Last Fee Paid</p>
                        <span>:</span>
                        <p>01st-Feb-2020 <a href="#0" class="blue-color" style="font-size: 10px;">(View All Receipt)</a></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Total Fees</p>
                        <span>:</span>
                        <p>₹25,000</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Balance</p>
                        <span>:</span>
                        <p><span class="bg-yellow" style="padding: 9px;color: #000;font-weight: 600;">₹0</span></p>
                      </div> 
                      <div class="fee-status-heading">
                        <p class="strong-heading">Next Fee Date</p>
                        <span>:</span>
                        <p>21st-Feb-2020</p>
                      </div>   
                      <div class="fee-status-heading">
                        <p class="strong-heading">Payment</p>
                        <span>:</span>
                        <p><span class="bg-green" style="padding: 9px;color: #fff;font-weight: 600;">NO DUE</span></p>
                      </div>
                    </div>
                  </div>
                </div>-->
              </div>
                     @include('genie.layouts.sidebar_form')
            </div>
          </div>
        </div>
	
	
       <script>
		//$('#data-table-fees-list').dataTable();  //SK
		</script>

	@endsection