 

	<!-- Design Start Here -->

	<!Doctype html>
	 <html>
	<head>
		<meta charset="utf-8">
		<title>Invoice_<?php echo $fees_details->name.'_'.date_format(date_create(),"d-m-Y"); ?></title>
 
		    <link href="<?php echo asset('genie/build/css/studentslipreceiptstyle.css'); ?>" rel="stylesheet">
	</head>
	<body>

	<header>
			<h1>FEES ESTIMATE</h1>
			<address >
				<b style="font-size: 18px;">Croma Campus</b>
				<p> G-21 Sector-3 Noida. </p>
				<p>Phone : 0120-4155255</p>
				<p>Email : info@cromacampus.com</p>
				<img src="http://fees.cromacampus.com/wp-content/themes/cromacampus/images/logo.png">
			</address>
			 
		</header>
		<article>	 
				 
			<table class="meta">
				<tr>
					<th><span >Receipt No</span></th>
					<td><span ><?php echo $fees_details->fees_invoice; ?></span></td>
				</tr>
				<tr>
					<th><span >Date</span></th>
					<td><span ><?php echo date_format(date_create($fees_details->paid_on), "d-M-Y"); ?></span></td>
				</tr>
				<tr>
					<th><span >Name</span></th>
					<td><span id="prefix" ></span><span><?php echo $fees_details->name; ?></span></td>
				</tr>
				<tr>
					<th><span >Mobile</span></th>
					<td><span id="prefix" ></span><span><?php echo $fees_details->phone; ?></span></td>
				</tr>
				 
				 
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span >Course</span></th>
						<th><span >Fees Type</span></th>
						<th><span >Mode</span></th>
						<th><span >Next Due Date</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class=""></a><span ><?php echo $fees_details->course; ?></span></td>
						<td><span>CF</span></td>
						<td><span><?php
                               if( $fees_details->payment_mode == 'cash'|| $fees_details->payment_mode == 'online'){
                                echo "Cash";
                              }else if($fees_details->payment_mode == 'paytmqr-1527937037'){
                                echo "PayTm";
								
                              }else if( $fees_details->payment_mode == 'website-1520598979' ){
										echo"Website";
                              }else if($fees_details->payment_mode == 'edc-1520599748'){								  
								  echo "EDC";								  
							  }else if($fees_details->payment_mode == 'tez-1532604466'){
								 echo "Google-Pay";
								  
							  }else if($fees_details->payment_mode=='phone-pay-1592888625'){
								  
								  echo "Phone-Pay";
								  
							  }else{
								  	echo ucfirst($fees_details->payment_mode);
								  
							  }
                            ?></span></td>
						 
						<td><span data-prefix></span><span><?php if($fees_details->due_date =='0000-00-00 00:00:00'){echo "NA";}else{echo date_format(date_create($fees_details->due_date),"d F, Y");} ?></span></td>
					</tr>

					 
				</tbody>
			</table>
			
			
			<table class="balance">
				<tr>
					<th><span>Amount</span></th>
					<td><span data-prefix></span><span><?php echo $fees_details->due_amt; ?></span></td>
				</tr>
				<tr>
					<th><span>Amount Paid</span></th>
					<td><span data-prefix></span><span style="font-weight: 700;"><?php echo $fees_details->paid_amt; ?></span></td>
				</tr>
				<tr>
					<th><span >Balance Due</span></th>
					<td><span data-prefix></span><span><?php echo $fees_details->due_amt-$fees_details->paid_amt; ?></span></td>
				</tr>
				
				
			</table>
			
			<table class="amount">
				<tr> 
					<td><span data-prefix></span><span><b style="font-weight: 700;">Amount in Words : </b><?php echo ucwords($fees_details->paid_amt_in_words); ?></span></td>
				</tr>
				<tr>
				 
					<td class="td-amount" ><span style="padding-left: 33px;font-weight: 700;"><?php

					$collect  =App\FeesUser::where('id',$fees_details->collector_id); 
 					if(empty($collect)){ echo $collect->display_name;  }?></span><span  style="padding-top: 26px;margin-left: 0px;">Authorised Signature</span></td>	
				</tr>
				 
				
				
			</table>
			 
			 
			 
		</article>
		<aside>
			<h1><span ><b style="font-weight: 700;">Terms & Conditions:</b> fee ones paid will not be refunded in any case.(Students Signature)</span><span style="margin-left:180px;">Student Copy</span></h1>
			<div class="thank" style="text-align:center">
				Thank You ! 				 
			</div>
			<div style="width:100%;text-align:center;margin-top:20px;position:relative;">
			<a style="background:#2E6DA4;padding:10px;text-decoration:none;color:#fff;border-radius:4px;" href="javascript::void(0);" onclick="this.parentElement.style.display='none';window.print();">Print Slip</a>
		</div>
		</aside>		
		 
	</body>
</html>
	<!-- Design Ends  Here -->
 