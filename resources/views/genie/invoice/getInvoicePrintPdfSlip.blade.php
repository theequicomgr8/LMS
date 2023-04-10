<!DOCTYPE html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo ucwords($trainer->name); ?>_Invoice_<?php echo date('d-m-Y H:i:s'); ?></title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
  <!--<link href="<?php //echo get_template_directory_uri() ?>/bower_components/trainerInvoiceSlip.css" rel="stylesheet">-->
  <link href="<?php echo asset('genie/build/css/trainerInvoiceSlip.css'); ?>" rel="stylesheet">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
    <div class="container">
      <div class="row align-items-center padding-invoice">
        <div class="col-sm-4 text-sm-left mb-3 mb-sm-0">
          <img id="" src="{{asset('genie/imginvoice/logo.svg')}}" title="croma campus" alt="croma campus" width="250" />
		  
        </div>
        <div class="col-sm-8 text-sm-left">
          <div class="header-info-section">
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('genie/imginvoice/location.svg')}}">
              </div>
              <div class="header-info-address">
                <p>G-21, Block G, Sector 3, Noida, Uttar Pradesh 201301</p>
              </div>
            </div>
          </div>
          <div class="header-info-section" style="display:-webkit-box;" >
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('genie/imginvoice/phone.svg')}}">
              </div>
              <div class="header-info-address">
                <p>+91-120-4155255</p>
              </div>
            </div>
            <div class="header-info" style="width: 167px;margin-left:112px;">
              <div class="header-info-icon">
                <img src="{{asset('genie/imginvoice/mobile.svg')}}">
              </div>
              <div class="header-info-address">
                <p>+91-9310482394</p>
              </div>
            </div>
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('genie/imginvoice/Message.svg')}}">
              </div>
              <div class="header-info-address">
                <p>team-accounts@cromacampus.com</p>
              </div>
            </div>
            <div class="header-info" style="margin-left:6px;">
              <div class="header-info-icon">
                <img src="{{asset('genie/imginvoice/web.svg')}}">
              </div>
              <div class="header-info-address">
                <p>www.cromacampus.com</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <!-- Main Content -->
  <main>
    <div class="container-fluid title-invoice">
      <div class="row">
        <div class="col-sm-12">
          <h3>Training Invoice</h3>
        </div>
      </div>
    </div>
  <div class="row padding-invoice">
    <div class="col-sm-6 text-sm-right order-sm-1">
      <address>
        <span><strong>Date :</strong><?php if($batches->firstdate_attendance){ echo date('d-M-Y',strtotime($batches->firstdate_attendance)); } ?></span><br />
        <span>+91-<?php echo $trainer->trainer_phone; ?></span><br />
        <span><?php echo $trainer->trainer_email; ?></span>
      </address>
    </div>
    <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
      <address>
        <strong>Mr/Ms<?php echo ucwords($trainer->name); ?>.</strong><br />
        <span><strong>Course:<?php echo ucfirst($batches->course_name); ?></strong> </span>
      </address>
    </div>
  </div>
  <div class="row padding-invoice" style="margin-bottom: 6px;">
    <div class="col-sm-12">
      <strong class="blue">Batch Id.: </strong><span contenteditable><?php echo $batches->batch_name; ?></span>
    </div>
  </div>
  <div class="Container padding-invoice">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-table">
            <table>
              <tr>
                <th>S.No.</th>
                <th>Candidate Name</th>
                <th>Student Number</th>
                <th>Fee Received</th>
              </tr>
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
				<td><span ><?php echo $student->phone; ?></span></td>	 
				<td contenteditable><span ><?php echo $student->stud_decided_fees.'.00'; ?></span></td>	 
			</tr>
			  <?php } } ?>
               
              <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Fees Amount</strong></td>
                <td style="border: 1px solid #9c9c9c;"><strong contenteditable>
				<?php 
					$std_amount=0;
					foreach($feesstudents as $std){
					$std_amount += $std->stud_decided_fees;						
					} 
					echo $std_amount.'.00';
				?></strong></td>
              </tr>
              <tr>
                <td colspan="3" style="text-align: right;" contenteditable><strong contenteditable>Share -<?php echo $invoice->share ?>
  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; 
 Release - <?php echo $invoice->releases ?> </strong></td>
                <td style="border: 1px solid #9c9c9c;"><strong contenteditable><?php if(!empty($invoice->amount)){ echo $invoice->amount.'.00'; }else{ echo "0.00";} ?></strong></td>
              </tr>
              <tr>
                <td colspan="3" style="text-align: right;"><strong>Advance</strong></td>
                <td style="border: 1px solid #9c9c9c;"><strong contenteditable><?php if(!empty($invoice->temp_advance)){ echo $invoice->temp_advance.'.00';}else{ echo "0.00";} ?></strong></td>
              </tr>
              <tr>
                <td colspan="3" style="text-align: right;"><strong contenteditable>Net Amount <?php if($invoice->invoice50 == '1'){ echo "(1st 50%)";} if($invoice->invoicesecond50 =='1'){ echo "(2nd 50%)"; } ?></strong></td>
                <td style="border: 1px solid #9c9c9c;"><strong contenteditable><?php if(!empty($invoice->amount)){ echo $invoice->amount-$invoice->temp_advance.'.00';}else{ echo "0.00";}  ?></strong></td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
  
   
  <div class="container padding-invoice">
	<div class="row">
      <div class="col-9 sd">
		<div class="payment-detail">
          <i class="yellow">Trainer Payment Details:</i><br>
          <strong>Bank Details : HDFC &nbsp;&nbsp; | &nbsp;&nbsp; Holder Name : ABC &nbsp;&nbsp; | &nbsp;&nbsp; A/c No. 9999999999 &nbsp;&nbsp; | &nbsp;&nbsp; IFSC Code : BARB00000</strong>
          <div class="payment-link">
            <img src="{{asset('genie/imginvoice/paytm-logo.png')}}">&nbsp;&nbsp; 
            <strong>9999999999 &nbsp;&nbsp; |&nbsp;&nbsp; </strong>
            <img src="{{asset('genie/imginvoice/google-pay.png')}}">&nbsp;&nbsp; 
            <strong>9999999999 &nbsp;&nbsp; |&nbsp;&nbsp; </strong>
            <img src="{{asset('genie/imginvoice/phonepay.png')}}">&nbsp;&nbsp; 
            <strong>9999999999 &nbsp;&nbsp;</strong>
          </div>
        </div>
		
		<div class="team-manag">
          <div class="account-team">
            <i class="yellow">Account Team</i><br>
            <strong>Name : </strong><span>Yash Kant</span><br />
            <strong>E-mail : </strong><span>accounts@cromacampus.com</span><br>
            <strong>Mobile :</strong><span> +91-9821548232</span>
          </div>
          <div class="Escalation-team">
            <i class="yellow">Escalation Team</i><br>
            <strong>Name : </strong><span>Pawan Dixit</span><br />
            <strong>E-mail : </strong><span>pawan.dixit@cromacampus.com</span><br />
            <strong>Mobile :</strong><span> +91-9711277666</span>
          </div>
        </div>
		
		<div class="imp-notes">
          <i class="yellow">Important Notes :</i>
           <ul>
             <li>After getting the invoice payment you will receive mail/SMS regarding that Payment, Kindly verify the account that you have received.No query will be entertained after 48 hrs. <br> Amount will be credited within 5 days once you receive the invoice from Account Team.</li>
             <li>During entire training, you need to share Study Material (Soft Copy),Assigments,Live Project and Recordings else we will hold the invoice.</li>
           </ul>
           <h3>Thank You For Your Business!!!</h3>
        </div>
		
		
	  </div>
	  
	  
      <div class="col-3">
        <div class="auth-sign">
          <img src="{{asset('genie/imginvoice/Pawan_Signature.svg')}}" alt="">
          <h3>Authorised Signature</h3>
        </div>
      </div> 
	  
	  
	</div>
  </div>
  </main>
  <!-- Footer -->
  <footer class="text-center mt-4">
  <div class="btn-group btn-group-sm d-print-none"> <a href="javascript::void(0);" onclick="window.print();" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>   </div>
  </footer>
  </footer>
</div>
</body>
</html>