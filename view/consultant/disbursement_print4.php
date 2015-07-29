<?php
$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$column1 = $ui->col()->width(1)->open();
	$column1->close();
	$column2 = $ui->col()->width(10)->open();
	?>
		<h2 align='center' width=100%>INDIAN SCHOOL OF MINES, DHANBAD</h2>
		<table border=0 align= 'center' width= 100%>
			<tr>
				<td width= 50%></td>
				<td>
					<table border=2 align= 'center' width= 100%>
					<tr>
						<td>
							<h4 align='center'>CONSULTANCY / BILL</h4>
							<h5>SI.No.</h5>
							<h5>Dated:</h5>
						</td>
					</tr>
					</table>
					<p>While processing the bill AR (B&P) to check the SI.No. and ensure that earlier consultancy bills have already been processed for payment.</p>
				</td>
			</tr>
		</table>
		<h4 align='center'>OFFICE OF THE PROFESSOR OF CONTINUING EDUCATION</h4>
		<h4 align='center'>INDIAN SCHOOL OF MINES, DHANBAD-826004</h4>
		<h4 align='center'>BILL FORWARDING MEMO FOR CONSULTANCY / COURSE ETC.</h4>
		<p>1.Consultancy No.</p>
		<p>2.Name of the Client</p>
		<p>3.Consultant Incharge Prof./Dr./Shri.</p>
		<p>4.Department of</p>
		<table width=100%>
			<tr>
				<td width=20%><p>5.Project Team</p></td>
				<td>i)</td>
			</tr>
			<tr>
				<td></td>
				<td>ii)</td>
			</tr>
			<tr>
				<td></td>
				<td>iii)</td>
			</tr>
			<tr>
				<td></td>
				<td>iv)</td>
			</tr>
		</table>
		<p>6.Actual Period of Work</p>
		<p>7.Date of Submission of final report</p>
		<p>8.Total Consultancy / Testing Charge Rs.</p>
		<p>9.Consultancy / Testing Charge Received on ................................................................<br>vide ISM cash receipt No./ Bank Credit...........................................................................</p>
		<p>10.No of pages in the bill including enclosures:<br><br></p>
		<p>AR(B&P) section may process strictly as per noticed ISM Consultancy / Testing Rules, Guidelines for the C.I. etc. It may be ensured that all pages of bills and cutting, if any, are countersigned by PCE,Any Change made in the bill may be communicated to PCE in order to keep the countersigned by PCE's office corrected and updated. No bill under this consultancy may be accepted unless it is forwarded through and counterigned by PCE.</p>
		<table width=100%>
			<td align='left' width=50%><br><br><h4>AR(B&P)</h4></td>
			<td align='right'><br><br><p>Professor of Continuing Education</p></td>
		</table>
	<?$ui->printButton()->noPrint()
				->id('print')
				->show();
	$column2->close();
?>