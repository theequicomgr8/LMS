<?php
	 
	 
	//$emp_details = getEmpsalarySlip($id);	
	//echo "<pre>";print_r($emp_details);die;
	// Creating the design for PopUp Window that shows Fees Slip
	/* Function code end */
function convert_number_to_words($number) {    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}
	
	
	if(!empty($emp_details))
      {		    
	//$month_of_salary_slip = $emp_details['month_of_salary_slip'];
      $newctc = $emp_details->fixed_salary;
	  $payable= $emp_details->fixed_salary-$emp_details->leaves-$emp_details->temp_advance+($emp_details->incentive+$emp_details->extra_work);
      $net_pay =   $payable;
      $monthctc =  ($newctc/12);
      $basic =  ($newctc * 40/100);
      $hra = ($newctc * 20/100);  
	  
	  $monthctcp =  ($net_pay/12);
      $basicp =  ($net_pay * 40/100);
      $hrap = ($net_pay * 20/100);
     $lta =  1000;
     $cumm_exp_ctc = 1000;
     $medi_reiub_ctc = 1250;
      $special = $newctc - ($basic + $hra + $lta + $cumm_exp_ctc + $medi_reiub_ctc);
      $specialp = $net_pay - ($basicp + $hrap + $lta + $cumm_exp_ctc + $medi_reiub_ctc);
      //$special = $monthctc - ($basic + $hra);
      $total_deductions = $monthctc - $net_pay;

/* Function code start */
   $number= round($net_pay);
   $data = convert_number_to_words($number); 

  
$startDate = time();
$currentdate = date('Y-m-d', strtotime('-1 months', $startDate)); 
if(!empty($currentdate)){ 
$sal_month = date('F',strtotime($currentdate));
if($sal_month == "January") {
		  $totalDays = 31;
	  } else if($sal_month == "February") {
		   $totalDays = 28;
	  } else if($sal_month == "March") {
		   $totalDays = 31;
	  } else if($sal_month == "April") {
		  $totalDays = 30;
	  } else if($sal_month == "May") {
		  $totalDays = 31;
	  } else if($sal_month == "June") {
		  $totalDays = 30;
	  } else if($sal_month == "July") {
		  $totalDays = 31;
	  } else if($sal_month == "August") {
		  $totalDays = 31;
	  } else if($sal_month == "September") {
		  $totalDays = 30;
	  } else if($sal_month == "October") { 
	  $totalDays = 31;
	  } else if($sal_month == "November") {
		  $totalDays = 30;
	  } else { $totalDays = 31; }
	
	
}

 
	  }
	  
 
	?>

	<!-- Design Start Here font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;-->

	<!Doctype html>
	 <html>
	<head>
		<meta charset="utf-8">
		<title>Salary_Slip_<?php echo $emp_details->first_name.'_'.date_format(date_create(),"d-m-Y"); ?></title>
		 
		<link href="<?php echo asset('genie/css/empinvoicestyle.css'); ?>" rel="stylesheet">
		 <style>
		 table { border-collapse:collapse; border-spacing: 0; }	
 		 
		 </style>
	</head>
	<body <?php $result = substr($emp_details->emp_code, 0, 2); if($result=="CC"){ ?> style="background-image:url(https://www.cromacampus.com/wp-content/themes/cromacampus/assets/img/croma_logo_invoice.jpg);background-repeat: no-repeat;background-position: center;background-size: 50%;" <?php }else if($result=="LE"){ ?> style="background-image:url(https://leadsedge.com/public/client/images/leadsedge-logo_invoice.jpg);background-repeat: no-repeat;background-position: center;background-size: 50%;"<?php } ?> >
 

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<table >
<tr>
<td style="border:1px solid grey;text-align:center; width:40%; height:70px; padding-top:10px;border-left: 2px solid grey;
    border-top: 2px solid grey;"><div></div>
<?php $result = substr($emp_details->emp_code, 0, 2); if($result=="CC"){ ?>
<img src="http://fees.cromacampus.com/wp-content/themes/cromacampus/images/logo.png" height="70px" width="150px" style="padding-top:13px;">
<?php }else if($result=="LE"){ ?>
<img src="https://leadsedge.com/public/client/images/logo-blue.png" height="100px" width="100px" style="padding-top:0px;">
<?php } ?>
</td>
<td style="border:1px solid grey; text-align:center; width:60%; height:70px; padding-top:15px;border-right: 2px solid grey;
    border-top: 2px solid grey;"><div></div><?php $result = substr($emp_details->emp_code, 0, 2); if($result=="CC"){ ?><span style="font-size:23px;font-weight:bold;">Croma Campus</span><br><br> <span>(G-21, Sector-03, Noida 201301, (U.P.))</span><?php }else if($result=="LE"){ ?>  <span style="font-size:23px;font-weight:bold;">LeadsEdge Media (P) Ltd.</span><br><br> <span style="margin-top:3px;">(G-21,Third Floor, Sector-03, Noida 201301, (U.P.))</span> <?php } ?> </td>

</tr>
</table>
<table cellpadding="5">
<tr >
<td style="border-left:2px solid grey;border-right:2px solid grey; text-align:center; font-size:16px; font-weight:bold;text-decoration-line: underline;"><u>Salary slip for the month of <?php if(!empty($sal_month)){ echo $sal_month; } ?>, <?php echo date('Y',strtotime($currentdate)); ?> </u></td>
</tr>
</table>

<table cellpadding="4" border="2px">
<tr>
<td valign="middle" style="text-align:left;font-size:13px;font-weight:bold;"> Employee Code</td>
<td valign="middle" style="text-align:left; "><?php if(!empty($emp_details->emp_code)){ echo $emp_details->emp_code; } ?> </td>
<td valign="middle" style="text-align:left;font-size:13px;font-weight:bold;"> Employee Name</td>
<td valign="middle" style="text-align:left;"> <?php if(!empty($emp_details->first_name)){ echo $emp_details->first_name.' '.$emp_details->last_name; } ?></td>
</tr>

<tr>
<td style="text-align:left;font-size:13px;font-weight:bold;"> Date of Joining</td>
<td style="text-align:left;"><?php echo date('d-M, Y',strtotime($emp_details->dateofjoining)); ?></td>
<td style="text-align:left;font-size:13px;font-weight:bold; "> Bank A/C No.</td>
<td style="text-align:left; "> <?php if(!empty($emp_details->bankac)){ echo $emp_details->bankac; }else{ echo "N.A."; }   ?></td>
</tr>

<tr>
<td style="text-align:left;font-size:13px;font-weight:bold; "> Department</td>
<td style="text-align:left;"> <?php echo $emp_details->department; ?></td>
<td style="text-align:left;font-size:13px;font-weight:bold; "> Pay Mode</td>
<td style="text-align:left; "> <?php if(!empty($emp_details->pay_mode)){ echo $emp_details->pay_mode;  }else{ echo"N.A";} ?></td>
</tr> 

<tr>
<td style="text-align:left;font-size:13px;font-weight:bold; "> Designation</td>
<td style="text-align:left;"> <?php echo $emp_details->designation; ?></td>
<td style="text-align:left;font-size:13px;font-weight:bold;"> Net Pay (<i class="fa fa-inr"></i>)</td>
<td style="text-align:left; "> <i class="fa fa-inr"></i> <?php echo $net_pay; ?></td>
</tr>

</table>

<table cellpadding="4">
<tr>
<td style="border-left:2px solid grey;border-right:2px solid grey;border-bottom:1px solid grey;font-size:13px;font-weight:bold;"> <strong>Days Payable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp;<?php if(!empty($totalDays)){ echo $totalDays-$emp_details->leaves_day;  } ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LWP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp; <?php if(!empty($emp_details->leaves_day)){ echo $emp_details->leaves_day;  }else{ echo "0"; } ?></td>
</tr>

<tr>
<td style="border-left:2px solid grey;border-right:2px solid grey;font-size:15px;font-weight:bold;">Salary Details</td>
</tr>
</table>

<table cellpadding="4" border="2px">

<tr>
<td valign="middle" style="text-align:left;font-size:13px;font-weight:bold;"> Pay Components</td>
<td valign="middle" style="text-align:center;font-size:13px;font-weight:bold; "> Amount (<i class="fa fa-inr"></i>)</td>
<!--<td valign="middle" style="text-align:center;font-size:13px;font-weight:bold;"> Amount Payable (<i class="fa fa-inr"></i>)</td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Basic</td>
<td valign="middle" style="text-align:center; "> <?php echo round($basic).'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"> <?php  echo round($basicp).'.00'; ?></td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> HRA</td>
<td valign="middle" style="text-align:center; "><?php echo round($hra).'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"> <?php  echo round($hrap).'.00'; ?></td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Special Personal Allowance</td>
<td valign="middle" style="text-align:center;"><?php  echo $special.'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"><?php  echo $specialp.'.00'; ?></td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> LTA</td>
<td valign="middle" style="text-align:center; "> <?php echo $lta.'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"> <?php echo $lta.'.00'; ?></td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Communication Expenses</td>
<td valign="middle" style="text-align:center; "> <?php echo $cumm_exp_ctc.'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"><?php echo $cumm_exp_ctc.'.00'; ?></td>-->
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Medical</td>
<td valign="middle" style="text-align:center; "> <?php echo $medi_reiub_ctc.'.00'; ?></td>
<!--<td valign="middle" style="text-align:center;"> <?php echo $medi_reiub_ctc.'.00'; ?></td>-->
</tr>

</table>

<table cellpadding="4">
<tr>
<td style="border-left:2px solid grey;border-right:2px solid grey;border-bottom:2px solid grey;font-size:13px;font-weight:bold;">   Total Salary: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-inr"></i> <?php echo $newctc ?><!--<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-inr"></i> <?php echo $net_pay ?></span>--> </td>
</tr>

<tr>
<td style="border-left:2px solid grey;border-right:2px solid grey;border-top:0.5px solid grey;font-size:15px;font-weight:bold;"> Inclusion & Deductions</td>
</tr>
</table>

<table cellpadding="4" border="2px">

<tr>
<td valign="middle" style="text-align:left;font-size:13px;font-weight:bold;"><strong> Components</strong></td>
<td valign="middle" style="text-align:center;font-size:13px;font-weight:bold;"><strong>Amount (<i class="fa fa-inr"></i>)</strong></td>
</tr>

<tr>
<td valign="middle" style="text-align:left;">Incentive</td>
<td valign="middle" style="text-align:center;"><?php  if(!empty($emp_details->incentive)){ echo $emp_details->incentive;}else{ echo "0.00"; } ?></td>
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Over Time</td>
<td valign="middle" style="text-align:center;"><?php  if(!empty($emp_details->extra_work)){ echo $emp_details->extra_work;}else{ echo "0.00"; } ?></td>
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Tax Deductions</td>
<td valign="middle" style="text-align:center;">0.00</td>
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Leave Deductions </td>
<td valign="middle" style="text-align:center;"><?php  if(!empty($emp_details->leaves)){ echo $emp_details->leaves;}else{ echo "0.00"; } ?></td>
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Advance Amount</td>
<td valign="middle" style="text-align:center;"><?php if(!empty($emp_details->temp_advance)){ echo $emp_details->temp_advance;  }else{ echo "0.00"; } ?></td>
</tr>

<tr>
<td valign="middle" style="text-align:left;"> Others</td>
<td valign="middle" style="text-align:center;">0.00</td>
</tr>
</table>

<table cellpadding="4">
<?php 
$total_amtid= (($emp_details->incentive+$emp_details->extra_work)-($emp_details->leaves + $emp_details->temp_advance));
if(!empty($total_amtid) && $total_amtid>=0) {?>
<tr>
<td valign="middle" style="border-left:2px solid grey;border-right:2px solid grey;border-bottom:2px solid grey;font-size:13px;text-align:left;font-weight:bold;"><strong> Total Inclusion : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-inr"></i> <?php echo (($emp_details->incentive+$emp_details->extra_work)-($emp_details->leaves + $emp_details->temp_advance)); ?>.00</strong></td>
</tr>
<?php  }else{ ?>
<tr>
<td valign="middle" style="border-left:2px solid grey;border-right:2px solid grey;border-bottom:2px solid grey;font-size:13px;text-align:left;font-weight:bold;"><strong> Total Deductions : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-inr"></i> <?php echo -(($emp_details->incentive+$emp_details->extra_work)-($emp_details->leaves + $emp_details->temp_advance)); ?>.00</strong></td>
</tr>
<?php } ?>
<tr>
<td valign="middle" style="border:1px solid #000;font-size:13px;text-align:left;font-weight:bold;"><strong> Net Payble Amount : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-inr"></i> <?php if(!empty($net_pay)){ echo $net_pay;  } ?></strong><br><br> <span style="font-size: 14px;font-weight:500;"> </span></td>
</tr>

</table>

 <strong style="font-size: 12px;
    font-weight: 600;">Terms & Conditions:</strong> <span style="font-size: 12px;">This is a computer generated payslip and does not require signature and stamp.</span>
			 
<div style="width:100%;text-align:center;margin-top:20px;position:relative;">
			<a style="background:#2E6DA4;padding:10px;text-decoration:none;color:#fff;border-radius:4px;" href="javascript::void(0);" onclick="window.print();">Print Slip</a>
		</div>

	  
	</body>
</html>
	<!-- Design Ends  Here -->
 