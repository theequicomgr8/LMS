<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
<?php

 
	header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0'); 

	header('Pragma: no-cache'); 

	header('Content-Type: application/x-msexcel; format=attachment;'); 

	header('Content-Disposition: attachment; filename=Payout-details_'.date('Y-m-d_H:i:s').'.xls'); 



 


?>

    <table border="1" cellspacing="10" cellpadding="2">

    <thead>

      <tr>

        <th>Date</th>
        <th>Emp Code</th>
        <th>Name</th>
        <th>Department</th>
        <th>Fixed Salary</th>
        <th>Leaves</th>
        <th>Incentive</th>
        <th> Present advance</th>
        <th> Present advance</th>
        <th> Payable</th>
        <th> paid Amount</th>
        <th> Balance</th>
        <th> Current Advance</th>
 
        
      </tr>

    </thead>

    <tbody>

    <?php
// echo "<pre>";print_r($payouts);die;
 
if(!empty($payouts)){
	
	foreach($payouts as $pay){
		if($pay->balance<0){
		$balance = 0;
		}else{
		$balance= $pay->balance;
		}
            ?>

            <tr>

              <td><?php echo date('d-M-Y',strtotime($pay->created_at)); ?></td>
              <td><?php echo $pay->emp_code; ?></td>
              <td><?php echo $pay->name; ?></td>
              <td><?php echo $pay->department; ?></td>
              <td><?php echo $pay->fixed_salary; ?></td>
              <td><?php echo $pay->leaves; ?></td>
              <td><?php echo $pay->incentive; ?></td>
              <td><?php echo $pay->extra_work; ?></td>
              <td><?php echo $pay->temp_advance; ?></td>
              <td><?php echo $pay->payable; ?></td>
              <td><?php echo $pay->paid_amount; ?></td>
              <td><?php echo $balance; ?></td>
              <td><?php echo $pay->current_advance; ?></td>

               

            </tr>

            <?php

          }

      }

    ?>                

    </tbody>

    </table>
</html>
 