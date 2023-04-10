 @extends('genie.layouts.app')
 @section('title')
     Running Batches
@endsection
@section('content')	
    <div class="right_col" role="main">
          <div class="">
		    <div class="page-title">
              <div class="title_left">
                <h4>Running Batch</h4>
              </div>              
            </div>
			 <div class="clearfix"></div>
		  <div class="row">
            <style>
            .title_left h4 {font-size: 21px;margin-top: 20px;margin-bottom: 22px;font-weight: 500;color: #000;padding: 0px 5px;}
            ul.quick-list li {padding-left: 0px;}
            .x_content {padding: 0px;margin: 0px;}
            .dataTables_length{float: left;}
            div.dataTables_wrapper div.dataTables_filter {text-align: right;float: right;}
            .table-striped tbody tr:nth-of-type(odd) td .lms-accordian .panel{background:#f2f2f2;}
            </style>
              <div class="col-md-12 col-sm-12"><div class="x_content"><div class="row">
			  <?php 
			if(!empty($runningbatches)){ 
			foreach($runningbatches as $batches){ 
			$stundent = App\FeesStudents::where('stud_batch_id', $batches->id)->get();
	 
			?>
			 
			<div class="col-md-4 col-sm-4 batch-box" onclick="window.open('<?php echo url('batch/batch-details'); ?>/<?php echo base64_encode($batches->id); ?>')">
			<div class="x_panel tile">
			<h2><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" class="batchname" title="Batch Name: <?php if(!empty($batches->batch_name)){ echo $batches->batch_name; } ?>"> <?php if(!empty($batches->batch_name)){ echo substr($batches->batch_name,0,22).'...'; } ?></a></h2>                   
			<div class="x_content">
			<ul class="quick-list">
	<li><i class="fa fa-calendar"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Batch Start Date <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ">Start Date: <?php if(!empty($batches->batch_created_on)){ echo date('d M Y',strtotime($batches->batch_created_on)); } ?> ( <?php if($batches->occurrence=='WD'){ echo "Weekday";  }else { echo "Weekend"; } ?>)</a>
			</li>
			<li><i class="fa fa-book"></i><a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" target="_blank" title="Course : <?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?>" ><?php if(!empty($batches->course_name)){ echo $batches->course_name;  } ?> </a>
			</li>
			<li><i class="fa fa-calendar-check-o"></i><a href="#">Attendance <?php if($batches->attendancebatch){ echo $batches->attendancebatch;  }else { echo "0"; } ?></a> </li>
			</ul>
			</div>
			<div class="show-student"><?php $i=0; if($stundent){ foreach($stundent as $stud){ 
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
			$color="#33FFF9";
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
			$resultname = substr(ucwords($names['0']),0,2);
	 		}else{
			$resultname .="&nbsp;";
			}
			?> 
			    <a href="{{url('batch/batch-details')}}/<?php echo base64_encode($batches->id); ?>" class="student-name" style="background: <?php echo $color; ?>;margin-left:-9.6px" target="_blank" title="<?php 	echo ucwords($stud->name);	 ?>">
			    <?php 	echo ucwords($resultname);	 ?></a>  <?php   } } }  if($i==1){ echo $i.' Student'; }else{  echo $i.' Students'; } ?> </div> 
			    
			</div>
			</div>
		 
			<?php } } ?>
			  
            </div>
            </div>
              </div>
            </div>
          </div>
        </div>
           
    
     @endsection