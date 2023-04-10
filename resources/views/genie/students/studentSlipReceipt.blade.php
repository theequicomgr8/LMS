<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice_<?php echo $fees_details->name.'_'.date_format(date_create(),"d-m-Y"); ?></title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
  <link href="{{asset('printdata/invoiceslips.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
    <div class="container">
      <div class="row align-items-center padding-invoice-em-top">
        <div class="col-sm-4 text-sm-left mb-3 mb-sm-0">
          <img id="logo" src="{{asset('printdata/logo.svg')}}" title="croma campus" alt="croma campus" width="250" />
        </div>
        <div class="col-sm-8 text-sm-left">
          <div class="header-info-section">
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('printdata/location.svg')}}">
              </div>
              <div class="header-info-address">
                <p>G-21, Sector 3, Noida, Uttar Pradesh 201301</p>
              </div>
            </div>
          </div>
          <div class="header-info-section" style="display:-webkit-box;" >
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('printdata/phone.svg')}}">
              </div>
              <div class="header-info-address">
                <p>+91-120-4155255</p>
              </div>
            </div>
            <div class="header-info" style="width: 167px;margin-left:134px;">
              <div class="header-info-icon">
                <img src="{{asset('printdata/mobile.svg')}}">
              </div>
              <div class="header-info-address">
                <p>+91-9821548232</p>
              </div>
            </div>
            <div class="header-info">
              <div class="header-info-icon">
                <img src="{{asset('printdata/Message.svg')}}">
              </div>
              <div class="header-info-address">
                <p>team-accounts@cromacampus.com</p>
              </div>
            </div>
            <div class="header-info" style="margin-left:6px;">
              <div class="header-info-icon">
                <img src="{{asset('printdata/web.svg')}}">
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
    <div class="container-fluid title-invoice student-invoice border-bottom">
      <div class="row padding-invoice-em">
        <div class="col-lg-12 pd-none">
          <h3>FEES ESTIMATE
          </h3>
        </div>

      </div>
    </div>
 <div class="container-fluid title-invoice em-invoice">
    <div class="Container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-table st-invoice-table padding-invoice padding-invoice-em-body">
            <table id="tablestudents">
              <tbody>
			  <tr style="background-color:#dddddd;color:#003453;">
          <td colspan="3" style="font-size:14px  !important;font-weight:600 !important;border-right: 2px solid #9b9b9b !important;">Name :- <span class="stcss"><?php if(!empty($fees_details->name)){ echo $fees_details->name; } ?></span></td>
                <td colspan="3" style="font-size:14px  !important; font-weight:600 !important; border-right: 2px solid #9b9b9b !important;">Receipt No :- <span class="stcss"><?php if(!empty($fees_details->fees_invoice)){ echo $fees_details->fees_invoice; } ?></span></td>
                <td colspan="3" style="font-size:14px  !important;font-weight:600 !important; ">Date :- <span class="stcss"><?php echo date_format(date_create($fees_details->paid_on), "d-M-Y"); ?></span></td>


              </tr>
			   
              <tr style="background-color:#f4f5f7;color:#003453;">
                <td colspan="3" style="font-size:14px  !important;font-weight:600 !important;border-right: 2px solid #9b9b9b !important;">Mobile :- <span class="stcss"><?php if(!empty($fees_details->phone)){ echo $fees_details->phone; } ?></span></td>
                <td colspan="3" style="font-size:14px  !important; font-weight:600 !important;border-right: 2px solid #9b9b9b !important;">Course :- <span class="stcss"><?php if(!empty($fees_details->course)){ echo $fees_details->course; } ?></span></td>
                <td colspan="3" style="font-size:14px  !important;font-weight:600 !important;">Fees Type :- <span class="stcss">CF</span></td>

      
                    </tr>
         

                


                    <tr style="background-color:#dddddd;color:#003453;">
                      <td colspan="3" style="font-size:14px  !important;font-weight:600 !important;border-right: 2px solid #9b9b9b !important;">Mode :- <span class="stcss"><?php
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
                       <td colspan="3" style="font-size:14px  !important;font-weight:600 !important;border-right: 2px solid #9b9b9b !important;">Student Id :- <span class="stcss"><?php if(!empty($fees_details->stud_id)){ echo $fees_details->stud_id; }; ?></span></td>

                      <td colspan="3" style="font-size:14px  !important; font-weight:600 !important;">Next Due Date :- <span class="stcss"><?php if($fees_details->due_date =='0000-00-00 00:00:00'){echo "NA";}else{echo date_format(date_create($fees_details->due_date),"d F, Y");} ?></span></td>
            
                          </tr>

               


            
			  
			  
			    <tr style="background-color:#dddddd;color:#263747;">
                <td colspan="6" style="font-size:14px  !important; font-weight:600 !important;border-top: 8px solid #fff;">Pay Components</td>
                <td colspan="3" style=" text-align:center !important;font-size:14px  !important;font-weight:600 !important;border-top: 8px solid #fff;border-left: 8px solid #fff;">Amount (<i class="fa fa-inr"></i>)

</td>
            
              </tr>
			   <tr style="background-color:#f4f5f7;color:#263747;">
                <td colspan="6" style="font-size:14px  !important; font-weight:500 !important;border-top: 3px solid #fff;">Fees Amount	
</td>
                <td colspan="3" style="text-align:center !important;font-size:14px  !important;font-weight:500 !important;border-top: 3px solid #fff;border-left: 8px solid #fff;"><?php if(!empty($fees_details->due_amt)){ echo $fees_details->due_amt; } ?>
</td>
            
              </tr>
			   <tr style="background-color:#dddddd;color:#263747;">
                <td colspan="6" style="font-size:14px  !important; font-weight:500 !important;border-top: 3px solid #fff;">Amount Paid	
</td>
                <td colspan="3" style="text-align:center !important; font-size:14px  !important;font-weight:500 !important;border-top: 3px solid #fff;border-left: 8px solid #fff;"><?php if(!empty($fees_details->paid_amt)){ echo $fees_details->paid_amt; } ?>
</td>
            
              </tr>
			  
			   <tr style="background-color:#f4f5f7;color:#263747;">
                <td colspan="6" style="font-size:14px  !important; font-weight:500 !important;border-top: 3px solid #fff;">Balance Due	

</td>
                <td colspan="3" style="text-align:center !important; font-size:14px  !important;font-weight:500 !important;border-top: 3px solid #fff;border-left: 8px solid #fff;"><?php echo $fees_details->due_amt-$fees_details->paid_amt; ?>
</td>
            
              </tr> 
			  </tbody>
			
			</table><hr>

      <table class="authorised-signature">
        <td class="td-singu"><span style="font-weight: 700; font-size: 16px;"><?php  
					 
 					if(!empty($collect)){ echo $collect->display_name;  } ?></span><span contenteditable="" style="padding-top: 10px;font-size: 16px;">Authorised Signature</span></td>

    </table>
		<div class="payslip-copyright"><p style="margin-bottom:8px;margin-top:8px;"><span style="font-weight:700;">Terms & Conditions: fee ones paid will not be refunded in any case.(Students Signature)
    </span><span style="margin-left:130px;">Student Copy</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>

  
  
   
  
  </main>
  <!-- Footer -->
  <footer class="text-center mt-2">
    <div class="btn-group btn-group-sm d-print-none"> <a href="javascript::void(0);" onclick="window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>   </div>
    </footer>
  <footer class="mt-4">
  </footer>

  </footer>

</div>
</body>
</html>