<?php $ui=new UI();
$payment_mode;
	if($details->payment_mode==0)
		$payment_mode='By Cheque';
	else if($details->payment_mode==1)
		$payment_mode='By Draft';
	else
		$payment_mode='Invalid';
	
	/*****************************************************************************/
	/*****************************************************************************/
	$currency;
	$payment_enclosed;
	if($details->currency==0)
		$currency='Indian Currency';
	else if($details->payment_mode==1)
		$currency='Foreign Currency';
	else
		$currency='Invalid';
	
	/*****************************************************************************/		
	/*****************************************************************************/
	$payment_enclosed;
	if($details->payment_enclosed==0)
		$payment_enclosed='Full Payment';
	else if($details->payment_mode==1)
		$payment_enclosed='Part Payment';
	else
		$payment_enclosed='Invalid';

?>
<style>
body{ font-size: 13px; }
h2{ font:16px; font-weight:bold;}
table{ width:100%;}
.form-control{ width:50px;}
</style>
<table border="0">
  <tr>
    <td align="center"><div style="font-size:18px; font-weight:bold;">INDIAN SCHOOL OF MINES DHANBAD - 826004</div></td>
  </tr>
 </table>
<table border="0">
  <tr>
    <td width="32%">&nbsp;</td>
    <td width="39%" align="center" style="text-decoration:underline; font-weight:bold;">Proposal Form</td>
    <td width="29%" align="right"> Dated <span class="col-sm-8 invoice-col"><?php echo date('d M Y',strtotime($details->timestamp)); ?></span></td>
  </tr>
</table>
 <br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Consultancy Incharge</div></td>
  </tr>
</table>
<table border="0">
	<tr>
   <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Name</strong></span></td>
   <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo ucwords($user_detail->salutation.' '.$user_detail->first_name.' '.$user_detail->middle_name.' '.$user_detail->last_name); ?></span> </td>
   <td >&nbsp;</td>
  </tr>
  <tr>
   <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Designation</strong></span></td>
   <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $des; ?></span> </td>
   <td >&nbsp;</td>
   <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Department/Centre</strong></span></td>
   <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $department; ?></span> </td>
   
    <td >&nbsp;</td>
  </tr>
  <tr>
   <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Telephone</strong></span></td>
   <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $user_detail->contact_no; ?></span> </td>
   <td >&nbsp;</td>
   <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>E-mail</strong></span></td>
   <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $user_detail->email; ?></span> </td>
   <td >&nbsp;</td>
  </tr>

    
</table>
<br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Expected time Schedule</div></td>
  </tr>
</table>
<table border="0">
	<tr>
    <td width="12%" ><strong>Year</strong></td>
    <td width="12%" ><?php echo $details->year; ?></td>
    <td width="12%" ><strong>Month</strong></td>
	<td width="12%" ><?php echo $details->month; ?></td>
	<td width="12%" ><strong>Weeks</strong></td>
    <td width="12%" ><?php echo $details->week; ?></td>
    <td width="12%" ><strong>Days</strong></td>
	<td width="12%" ><?php echo $details->days; ?></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Starting Date</strong></td>
    <td width="25%"><?php echo date('d M Y ',strtotime($details->timestamp)+19800);?></td>
    <td width="25%"></td>
    <td width="25%"></td>
    <td >&nbsp;</td>
  </tr>
  
</table>
<br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Client Details</div></td>
  </tr>
</table>
<table border="0">
   <tr>
    <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Firm Name</strong></span></td>
    <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $details->firm_name; ?></span> </td>
   <td >&nbsp;</td>
	
  </tr>
  <tr>
    <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Contact Person Name</strong></span></td>
    <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $details->person_name; ?></span> </td>
    
    <td width="25%"><strong>Designation</strong></td>
    <td width="25%"><?php echo $details->designation?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Address</strong></span></td>
    <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $details->address; ?></span> </td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>City</strong></td>
    <td width="25%"><?php echo $details->city?></td>
    <td width="25%"><strong>PIN</strong></td>
    <td width="25%"><?php echo $details->pincode?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Phone No.</strong></td>
    <td width="25%"><?php echo $details->contact_no?></td>
    <td width="25%"><strong>EXTN</strong></td>
    <td width="25%"><?php echo $details->extn?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>FAX</strong></td>
    <td width="25%"><?php echo $details->fax?></td>
    <td width="25%"><strong>E-mail</strong></td>
    <td width="25%"><?php echo $details->email?></td>
    <td >&nbsp;</td>
  </tr>
  
</table>
<br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Total Charges And Payment Details</div></td>
  </tr>
</table>
<table border="0">
   <tr>
	<td width="25%"><strong>Payment No.</strong></td>
    <td width="25%"><?php echo $details->payment_no;?></td>
    <td width="25%"><strong>Mode of Payment</strong></td>
    <td width="25%"><?php echo $payment_mode;?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Payment Enclosed</strong></td>
    <td width="25%"><?php echo $payment_enclosed;?></td>
    <td width="25%"><strong>Currency</strong></td>
    <td width="25%"><?php echo $currency;?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Foreign Currency Type(if any)</strong></td>
    <td width="50%"><?php echo $details->currency_type;?></td>
    <td width="25%"></td>
    
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Total Value(in figure)</strong></td>
    <td width="25%"><?php echo $details->value_fig;?></td>
    <td width="25%"><strong>Total Value(in words)</strong></td>
    <td width="25%"><?php echo $details->value_word;?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>Bank Name and Branch</strong></td>
    <td width="25%"><?php echo $details->bank_name;?></td>
    <td width="25%"><strong>DD/Cheque/Transection No.</strong></td>
    <td width="25%"><?php echo $details->dd_cheque_no;?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><strong>DD/Cheque/Transection Amount.</strong></td>
    <td width="25%"><?php echo $details->dd_cheque_amt;?></td>
    <td width="25%"><strong>DD/Cheque/Transection Date</strong></td>
    <td width="25%"><?php echo $details->dd_cheque_date;?></td>
    <td >&nbsp;</td>
  </tr>
  
</table>
<br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Objectve And Type</div></td>
  </tr>
</table>
<table border="2">
  <tr>
  <td> <div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">&nbsp;</div></td>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Testing Type</div></td>
  <td> <div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">&nbsp;</div></td>
  </tr>
  
  
  <tr>
    <td> 1 </td>
    <td >Product Development</td>
    <td align='center'><?
				if($details->product_development)
				{
					echo "yes";
					//$ui->button()->mini()->uiType('success')->icon($ui->icon('check'))->disabled()->show();
				}?>
	</td>
  </tr>
  <tr>
  <td> 2 </td>
    <td > Process Development</td>
    <td align='center'>
    <?
				if($details->process_development)
          {
          echo "yes";
           }?>
	
	</td>
  </tr>
  <tr>
    <td> 3 </td>
    <td >Checkig of Design</td>
    <td align='center'><?
				if($details->checking_of_design)
				{
					echo "yes";
          	}?>
	</td>
  </tr>
  <tr>
    <td> 4 </td>
    <td >checking of Analysis</td>
    <td align='center'><?
				if($details->checking_of_analysis)
				{
					echo "yes";
          }?>
	</td>
  </tr>
  <tr>
    <td> 5 </td>
    <td >Report Writing/Evaluation</td>
    <td align='center'><?
        if($details->report_writing)
        {
          echo "yes";
          }?>
  </td>
  </tr><tr>
    <td> 6 </td>
    <td >Testing And Interpretation</td>
    <td align='center'><?
        if($details->testing)
        {
          echo "yes";
          }?>
  </td>
  </tr><tr>
    <td> 7 </td>
    <td >HRD/CEP</td>
    <td align='center'><?
        if($details->hrd)
        {
          echo "yes";
          }?>
  </td>
  </tr><tr>
    <td> 8 </td>
    <td >Computation</td>
    <td align='center'><?
        if($details->computation)
        {
          echo "yes";
          }?>
  </td>
  </tr><tr>
    <td> 9 </td>
    <td >Advice</td>
    <td align='center'><?
        if($details->advice)
        {
          echo "yes";
          }?>
  </td>
  </tr>
  <tr>
    <td> 10 </td>
    <td >Other Specify</td>
    <td align='center'><?
        if($details->other)
        {
          echo "yes";
          }?>
  </td>
  </tr>
</table>
<br/><br/>
<table border="2">
  <tr>
  <td> <div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">&nbsp;</div></td>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">Client Type</div></td>
  <td> <div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">&nbsp;</div></td>
  </tr>
  
  
  <tr>
    <td> 1 </td>
    <td >Private Sector</td>
    <td align='center'><?
        if($details->private_sector)
        {
          echo "yes";
          //$ui->button()->mini()->uiType('success')->icon($ui->icon('check'))->disabled()->show();
        }?>
  </td>
  </tr>
  <tr>
  <td> 2 </td>
    <td > Govt Sector</td>
    <td align='center'>
    <?
        if($details->govt_sector)
          {
          echo "yes";
           }?>
  
  </td>
  </tr>
  <tr>
    <td> 3 </td>
    <td >Public Sector</td>
    <td align='center'><?
        if($details->public_sector)
        {
          echo "yes";
            }?>
  </td>
  </tr>
  <tr>
    <td> 4 </td>
    <td >Funding Agency</td>
    <td align='center'><?
        if($details->funding_agency)
        {
          echo "yes";
          }?>
  </td>
  </tr>
  <tr>
    <td> 5 </td>
    <td >Foreign Organisation</td>
    <td align='center'><?
        if($details->foreign_organisation)
        {
          echo "yes";
          }?>
  </td>
  </tr>
  <tr>
    <td> 6 </td>
    <td >Other Specify</td>
    <td align='center'><?
        if($details->other_client)
        {
          echo "yes";
          }?>
  </td>
  </tr>
</table>


