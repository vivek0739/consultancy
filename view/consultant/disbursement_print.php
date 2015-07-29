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
	?>
		<h3 align= 'center'>INDIAN SCHOOL OF MINES</h3>
		<h4 align= 'center'>DHANBAD-826004</h4>
		<h4 align= 'center'>DISBURSEMENT SHEET</h4>
		<h4 align= 'center'>Consultancy Project No.<? echo $disbursement->consultancy_no; ?></h4>
	<?
	$inputRow1 = $ui->row()->open(); 
	?>
		<table border=2 align= 'center' width= 100%>
			<tr>A.   Details of Receipt/Payment:</tr>
			<tr>
				<td width=80%>1.Total Charges</td>
				<td align= 'center'><? echo $disbursement->a_total_charge; ?></td>
			</tr>
			<tr>
				<td width=80%>2.Services Tax + Educational Cess</td>
				<td align= 'center'><? echo $disbursement->a_services_tax; ?></td>
			</tr>
			<tr>
				<td width=80%>3.Total Amount received</td>
				<td align= 'center'><? echo $disbursement->a_total_amt; ?></td>
			</tr>
			<tr>
				<td width=80%>4.Deduct: Actual expenditure/payment already made(please give details)</td>
				<td align= 'center'><? echo $disbursement->a_expenditure; ?></td>
			</tr>
			<tr>
				<td width=80%>5.Balance available for disbursement</td>
				<td align= 'center'><? echo $disbursement->a_balance; ?></td>
			</tr>
		</table>
		<table border=2 align= 'center' width= 100%>
		<tr>B.  Credit and Disbursement</tr>
		<tr>
			<td width=80%>6.Service Tax + Educational Cess</td>
			<td align= 'center'><? echo $disbursement->b_services_tax; ?></td>
		</tr>
		<tr>
			<td width=80%>7.Institue Support Charges @ 24.5% of A(1)</td>
			<td align= 'center'><? echo $disbursement->b_institute_charge; ?></td>
		</tr>
		<tr>
			<td width=80%>8.Department Devlopment fund @ 3.5% of A(1)</td>
			<td align= 'center'><? echo $disbursement->b_dep_dev; ?></td>
		</tr>
		<tr>
			<td width=80%>9.Professional Devlopment fund @ 3.5% of A(1)</td>
			<td align= 'center'><? echo $disbursement->b_prof_dev; ?></td>
		</tr>
		<tr>
			<td width=80%>10.Benevolent fund @ 1.75% of A(1)</td>
			<td align= 'center'><? echo $disbursement->b_benevolent_fund; ?></td>
		</tr>
		<tr>
			<td width=80%>11.Central Administrative charges @ 1.75% of A(1)</td>
			<td align= 'center'><? echo $disbursement->b_central_charge; ?></td>
		</tr>
		<tr>
			<td width=80%>12.EDC Development fund</td>
			<td align= 'center'><? echo $disbursement->b_edc_dev; ?></td>
		</tr>
		<tr>
			<td width=80%>13.EDC Lodging and Boarding charges</td>
			<td align= 'center'><? echo $disbursement->b_edc_lodging; ?></td>
		</tr>
		<tr>
			<td width=80%>14.EDC Xeroxing Charges</td>
			<td align= 'center'><? echo $disbursement->b_edc_xerox; ?></td>
		</tr>
		<tr>
			<td width=80%>15.ISM Vehicle Charges</td>
			<td align= 'center'><? echo $disbursement->b_ism_vehicle; ?></td>
		</tr>
		<tr>
			<td width=80%>16.Alumni fund Rs.100/- per participant for professional Development Programme</td>
			<td align= 'center'><? echo $disbursement->b_alumni_fund; ?></td>
		</tr>
		<tr>
			<td width=80%>17.Equipment Charges(to be credited to Institue fund)</td>
			<td align= 'center'><? echo $disbursement->b_equip_charge; ?></td>
		</tr>
		<tr>
			<td width=80%>18.Other payment to be maid(Please given details) 
						supplier's bill should be sent separately to the accounts section for payment alongwith approval/snaction of the same</td>
			<td align= 'center'><? echo $disbursement->b_other_payment; ?></td>
		</tr>
		<tr>
			<td width=80%>19.Total Credit</td>
			<td align= 'center'><? echo $disbursement->b_total_credit; ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		</table>
		<table border=2 align= 'center' width= 100%>
		<tr>C. Net Amount</tr>
		<tr>
			<td width=80%>20.Balance Available for disbursement</td>
			<td align='center'><? echo $disbursement->c_balance; ?></td>
		</tr>
		<tr>
			<td width=80%>21.Deduct: Total credit(SL No. 19)</td>
			<td align='center'><? echo $disbursement->c_total_credit; ?></td>
		</tr>
		<tr>
			<td width=80%>22.Net amount available for disbursement</td>
			<td align='center'><? echo $disbursement->c_net_amt; ?></td>
		</tr>
		<tr>
			<td width=80%>23.Amount to be released as per list attached(A & B)</td>
			<td align='center'><? echo $disbursement->c_release_amt; ?></td>
		</tr>
		<tr>
			<td width=80%>24.Net Savings</td>
			<td align='center'><? echo $disbursement->c_net_saving; ?></td>
		</tr>
		<tr>
			<td width=80%>25.Distribution of savings:<br>A. 50% Institute Development Fund</td>
			<td align='center'><? echo $disbursement->c_dist_save1; ?></td>
		</tr>
		<tr>
			<td width=80%>B.50% to the Depts' Development Fund of CI & CO-CI(s) with equal share basis)</td>
			<td align='center'><? echo $disbursement->c_dist_save2; ?></td>
		</tr>
		</table>
		<p align='center'>Encl: Photocopies of money receipt, Disbursement sheet, Statement of expenditure,Distribution list of Honoraria to faculty & supporting staff of ISM</p>
		<table border=0.5 align= 'center' width= 100%>
		<tr>
			<td align='left'><br>Signature of HOD</td>
			<td></td>
			<td align='left' width=35%><br>Signature of Consultant Incharge</td>
		</tr>
		<tr>
			<td align='left'>Date:</td>
			<td><?$ui->printButton()->noPrint()
				->id('print')
				->show();?></td>
			<td align='left'>Date:</td>
		</tr>
		</table>
	<? $inputRow1->close();

	$column2->close();
?>