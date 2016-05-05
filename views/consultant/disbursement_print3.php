<?php
$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	foreach ($details as $disbursement)
	{}
	$column2 = $ui->col()->width(8)->open();
	$ui
					->printButton()->noPrint()
					 ->uiType('primary')
				->id('print')
				->show();
	$i=1;
	?>
	<table width=100%>
		<tr>
			<td width=65%></td>
			<td>Consultancy Project No. <?echo $disbursement->consultancy_no;?></td>
		</tr>
	</table>
	<h5 align ='center'>B. DETAILS OF DISBURSEMENT OF HONORARIA TO SUPPORTING STAFF OF ISM</h5>
	<table border=1 align= 'center' width= 100%>
		<tr>
			<td align='center' width=10%>SI.No.</td>
			<td align='center' width=30%>Name</td>
			<td align='center' width=12%>Employee Code Number</td>
			<td align='center' width=12%>Amount(Rs)</td>
			<td align='center' width=12%>Gross Annual Salary(GAS) of previous F.Y></td>
			<td align='center' width=12%>75% of GAS of previous F.Y.</td>
			<td align='center' width=12%>Total honoraria processed for payment so far in the current F.Y.</td>
		</tr>
	<?
	foreach($detail as $staff)
	{?>
		<tr>
			<td align='center'><?echo $i;?></td>
			<td align='center'><? echo $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name ?></td>
			<td align='center'><? echo $staff->emp_no; ?></td>
			<td align='center'><? echo $staff->amount; ?></td>
			<td align='center'><? echo $staff->gas_previous; ?></td>
			<td align='center'><? echo $staff->fy_gas_previous; ?></td>
			<td align='center'><? echo $staff->total_current_fy; ?></td>
		</tr>
	<?
	$i++;
	}
	?>
	</table>
	<p align='center'><br>This is to certify that Final Report has been sent to the client on date and a copy has been retained in the department of <br><br></p>
	<table width=100%>
		<tr>
			<td width=65%></td>
			<td>Signature of Consultant Incharge<br>
			Name:<br>
			Date:</td>
		</tr>
	</table>
	<?

	$column2->close();
?>