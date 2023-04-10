  @extends('genie.layouts.app')
 @section('title')
    Dashborad
@endsection
@section('content')	
    <style>
    .tile_count .tile_stats_count {
    padding: 0px 57px 0 40px !important;
    }
    .mt-20{padding-top: 20px; }
    .trianner-section a{font-size: 19px;color: #747474;font-weight:600;}
    .icons-trianner .fa{font-size: 44px;}
    ul.quick-list li{padding-left: 0px;}
    </style>
 <div class="right_col" role="main">
<div class="row mt-20">
			<style>
			.text-box {
			font-size: 19px;justify-content: space-between;
			align-items: center;
			display: flex;

			}
			.total-count-section p
			{
			margin-bottom:0px;
			font-size: 14px;
			margin-top:4px;
			color: #333;
			}
			.x_panel {
			padding:20px;
			}
			.x_content
			{
			padding:0px;
			margin:0px;
			}

			</style>
					<div class="col-md-3 col-sm-3 batch-box1">
					<div class="x_panel tile fixed_height_150">

					<div class="x_content">

					<div class="text-box">
					    <div class="trianner-section total-count-section">
			            <a href="{{url('batch/running-batches')}}">Running Batch</a>
					        <p><?php if(!empty($batches)){ echo $batches; }else{  echo "0"; } ?></p>

					    </div>
					    <div class="icons-trianner">
					         <i class="fa fa-clock-o" style="color: #00c292;"></i>
					    </div>
					  </div>  

					</div>
					</div>
					</div>

					<div class="col-md-3 col-sm-3 batch-box1">
					<div class="x_panel tile fixed_height_150 overflow_hidden">

					<div class="x_content">
				
						<div class="text-box">
					    <div class="trianner-section total-count-section">
			            <a href="{{url('batch/finished-batches')}}">Finished Batch</a>
					        <p><?php if(!empty($batchesfinish)){ echo $batchesfinish; }else{  echo "0"; } ?></p>

					    </div>
					    <div class="icons-trianner">
					         <i class="fa fa-th-list" style="color: #FB9678;"></i>
					    </div>
					  </div>
					</div>
					</div>
					</div>


					<div class="col-md-3 col-sm-3 batch-box1">
					<div class="x_panel tile fixed_height_150">

					<div class="x_content">

		<div class="text-box">
					    <div class="trianner-section total-count-section">
			            <a href="{{url('invoice/paid-invoice')}}">Invoice Paid</a>
					        <p><?php if(!empty($paidinvoice)){ echo $paidinvoice; }else{  echo "0"; } ?></p>

					    </div>
					    <div class="icons-trianner">
					         <i class="fa fa-file-pdf-o" style="color: #01C0C8;"></i>
					    </div>
					  </div>

					</div>
					</div>
					</div> 

					<div class="col-md-3 col-sm-3 batch-box1">
					<div class="x_panel tile fixed_height_150">

					<div class="x_content">
							<div class="text-box">
					    <div class="trianner-section total-count-section">
			            <a href="{{url('invoice/pay-history')}}">Payment History</a>
					        <p><?php if(!empty($paidamount->total_pay_amount)){ echo $paidamount->total_pay_amount +$paidamount->total_advance; }else{  echo "0"; } ?></p>

					    </div>
					    <div class="icons-trianner">
					         <i class="fa fa-inr" style="color: #00598d;"></i>
					    </div>
					  </div>

					
					</div>
					</div>
					</div>

					</div>
           
          <br />

          <div class="row">

			<?php 

			if(!empty($runningbatches)){ 
			foreach($runningbatches as $batches){ 
			$stundent = App\FeesStudents::where('stud_batch_id', $batches->id)->get();
 
			?>
			<div class="col-md-4 col-sm-4 batch-box" onclick="window.open('<?php echo url('batch/batch-details'); ?>/<?php echo base64_encode($batches->id); ?>')">

			<div class="x_panel tile">
			 
			<h2><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Batch Name: <?php if(!empty($batches->batch_name)){ echo $batches->batch_name; } ?>"> <?php if(!empty($batches->batch_name)){ echo substr($batches->batch_name,0,22).'...'; } ?></a></h2>                   
			<div class="x_content">




			<ul class="quick-list">
	<li><i class="fa fa-calendar"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Batch Start Date <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ">Start Date: <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ( <?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?>)</a>
			</li>
			<li><i class="fa fa-book"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Course : <?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?>" ><?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?> </a>
			</li>
 
			<li><i class="fa fa-calendar-check-o"></i><a href="#">Attendance <?php if($batches->attendancebatch){ echo $batches->attendancebatch;  }else { echo "0"; } ?></a> </li>

			</ul>

	
			</div>
			
			<div class="show-student"><?php $i=0; if($stundent){ 
			    
			    foreach($stundent as $stud){ 
			    $i++;
			 	if($i<=5){
	    	 if($i==1){
				$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
		    	$color= ('#' . $rand);
			}else if($i==2){
				$color="#3399FF";
			}else if($i==3){
				$color="#FF5E33";				
			}else if($i==4){ 
			$color="#FF33B2";
			}else if($i==5){ 
			$color="#008000";
			}else if($i==6){ 
			$color="#FF4C33";
			}else if($i==7){ 
			$color="#FF33B2";
			}else if($i==8){ 
			$color="#AFFF33";
			}else if($i==9){ 
			$color="#161814";
			}else if($i==10){ 
			$color="#F51C1C";
			}else{
			    	$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
		    	$color= ('#' . $rand);
			} 
			    ?> 
			    <?php 
			$names= explode(' ',ucwords($stud->name));

			if(!empty($names)){
			$resultname="";
			//foreach($names as $key){	 	 				 
			$resultname = substr(ucwords($names['0']),0,2);
		/*	if(!empty($names['1'])){
			$resultname .= substr(ucwords($names['1']),0,1);
			}else{
			$resultname .='&nbsp;';
			}*/
			//}					 				
			}else{
			$resultname .="&nbsp;";
			}
		 
			?> 
			    <a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" class="student-name" style="background: <?php echo $color; ?>;margin-left:-9.6px" target="_blank" title="<?php 	echo ucwords($stud->name);	 ?>">
			    <?php 	echo ucwords($resultname);	 ?></a>  <?php  } } }  if($i==1){ echo $i.' Student'; }else{  echo $i.' Students'; } ?> </div> 
			    	
			</div>
			</div>
		
			<?php } } ?>
             

          </div>


          <div class="row">
             


            
          </div>
        </div>
       @endsection