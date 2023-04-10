<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	<title><?php echo ucwords($trainer->name); ?>-Invoice_<?php echo date('d-m-Y H:i:s'); ?></title>
		<link href="<?php echo asset('genie/build/css/invoiceprintpdf.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<header>
			<h1>Mr. <?php echo ucwords($trainer->name); ?> Invoice Details</h1>
			 <b style="color: red;font-size: 15px;font-weight: 500;text-decoration: underline;">Note:After any Payment you have received a mail and text message,If you have not received this amount, please let us know within 48 hours. After that any query related to this payment will not be entertained. </b>
			 <p>
			   <b style="float: right;font-size: 15px;font-weight: 500;margin-top: 19px; margin-bottom: 18px;padding: 6px; background: chocolate;font-style: italic;">During entire training, You need to share Study Material(Soft Copy), Assignments,Live Project and Recordings else we will hold the invoice. </b></p> 
			   
			   
			   <p style="font-size: 15px;font-weight: 500;margin-top: 19px; margin-bottom: 18px;color: red;font-style: italic;">For any clarification kindly contact at: faisal.qureshi@cromacampus.com or call at 9599743981 </p>
			<address>
				<!--<b style="font-size: 18px;">Croma Campus Pvt Ltd</b>
				<p> G-21, Sector-3 Noida, U.P India </p>
				<p>Phone : 120-45665</p>
				<p>Email : info@cromacampus.com</p>
				<p>Website : www.cromacampus.com</p>-->
				<img src="https://www.cromacampus.com/wp-content/themes/cromacampus/assets/img/croma_logo.png">
			</address>
			<table class="meta">
				<tr>
					<th><span>Trainer Name : </span></th>
					<td><span><?php echo ucwords($trainer->name); ?></span></td>
				</tr>
				<tr>
					<th><span >Contact No : </span></th>
					<td><span ><?php echo $trainer->trainer_phone; ?></span></td>
				</tr>
				<tr>
					<th><span >Email : </span></th>
					<td><span ><?php echo $trainer->trainer_email; ?></span></td>
				</tr>			 
				<tr>
					<th><span >Bill Date</span></th>
					<td><span ><?php if($batches->firstdate_attendance){ echo date('d-M-Y',strtotime($batches->firstdate_attendance)); } ?></span></td>
				</tr>
				 				 
				 
			</table> 
		</header>
		 	
		<article>					 
						
			
			 
			<table class="inventory">
				<thead>
					<tr>
						<th><span >S.No</span></th>
						<th><span >Candidate Name</span></th>
						<th><span >Amount Received</span></th>
											
										
						 
						
					</tr>
				</thead>
				<tbody>
				 <?php
		$invoicstd = unserialize($invoice->studgroupid);		

		  if($invoicstd){
		$i=0;
		$totalamt=0;
		 foreach($invoicstd as $key=>$val){
		$i++;
		$student = App\FeesStudents::where('id','=',$val)->first();
	
		$totalamt +=$student->stud_decided_fees;
 
				  ?>
				
					<tr>
						<td><span ><?php echo $i; ?></span></td>	 
						<td><span ><?php echo $student->name; ?></span></td>	 
						<td><span ><?php echo $student->stud_decided_fees.'.00'; ?></span></td>	 
						
					
						
					 
					</tr>
				<?php  } } ?>
					 
			 
			 

				 
				
				
				</tbody>
			</table>
			
			
			 <table cellpadding="4" border="2px">

 

<tr>
<td valign="middle" style="padding-left: 10%;font-weight: 700;width: 44%;background: #EEE;border-color: #BBB;"> Total Fee</td>
<td valign="middle" style="padding-left: 81px;width: 50%;"> 
<?php 
$std_amount=0;
foreach($feesstudents as $std){
$std_amount += $std->stud_decided_fees;						
} 
echo $std_amount.'.00';
?></td>

</tr>

<tr>
<td valign="middle" style="padding-left: 10%;font-weight: 700;width: 44%;background: #EEE;border-color: #BBB;"> 
<strong contenteditable>Share -<?php echo $invoice->share ?>
  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; 
 Release - <?php echo $invoice->releases ?> </strong>

</td>
<td valign="middle" style="padding-left: 81px;width: 50%;"> <?php if(!empty($invoice->amount)){ echo $invoice->amount.'.00'; }else{ echo "0.00";} ?></td>
 
</tr>

<tr>
<td valign="middle" style="padding-left: 10%;font-weight: 700;width: 44%;background: #EEE;border-color: #BBB;">Advance</td>
<td valign="middle" style="padding-left: 81px;width: 50%;"><?php if(!empty($invoice->temp_advance)){ echo $invoice->temp_advance.'.00';}else{ echo "0.00";} ?></td>
 
</tr>

<tr>
<td valign="middle" style="padding-left: 10%;font-weight: 700;width: 44%;background: #EEE;border-color: #BBB;"> Total Amount <?php if($invoice->invoice50 == '1'){ echo "(1st 50%)";} if($invoice->invoicesecond50 =='1'){ echo "(2nd 50%)"; } ?></td>
<td valign="middle" style="padding-left: 81px;width: 50%;"> <?php if(!empty($invoice->amount)){ echo $invoice->amount-$invoice->temp_advance.'.00';}else{ echo "0.00";}  ?></td>
 
</tr>

 

</table>
			
			<!--<table class="amount">
				 
				<tr>
				 
					<td style="padding-top: 30px;"><span><b style="font-size: 12px;font-weight: bold;">Note:</b> This is a system generated invoice and hence no signature is required</span></td>
					<td class="td-amount" ><span>Autherised Signature</span></td>
				</tr>
				 
				
				
			</table>-->
			 
			 
			 
		</article>
		<aside>
			<!--<h1><span ><b style="font-weight: 700;">Regd. Office:</b>  G-21,Sector-3, Noida,Pin Code-201301 (UP), India.</span></h1>-->
			<div class="thank" style="text-align:center">
				Thank You ! 
				 
			</div>
		</aside>
		
		<div style="width:100%;text-align:center;margin-top:20px;position:relative;">
			<a style="background:#2E6DA4;padding:10px;text-decoration:none;color:#fff;border-radius:4px;cursor: pointer;"  onclick="window.print()">Print Slip</a>
		</div>
	</body>
</html>