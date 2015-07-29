<script type="text/javascript">

$(window).load(function(){

    
    
     var ci='<?echo $auth_id;?>'
      $('#approve_col').hide();
      $('#reject_col').hide();
      $('#cancel_col').hide();
     if(ci.trim()=='c_i'||ci.trim()=='ft')
     {
      $('#action_taken5').show();
      $('#action_taken').hide();
      $('#action_taken1').hide();
     }
     else if(ci.trim()=='prev')
     {
     	$('#action_taken5').hide();
      $('#action_taken').hide();
      $('#action_taken1').hide();
     }
     else
    {
      $('#action_taken5').hide();
      $('#action_taken').show();
      $('#action_taken1').show();
    }
     $('#action_taken').on('click',function(){
        $('#approve_col').show();
        $('#reject_col').hide();
        $('#cancel_col').hide();
     });
     $('#action_taken1').on('click',function(){
        $('#approve_col').hide();
        $('#reject_col').show();
        $('#cancel_col').hide();
     });
     $('#action_taken5').on('click',function(){
        $('#approve_col').hide();
        $('#reject_col').hide();
        $('#cancel_col').show();
     });
     
      
});


    
</script>
<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');



	
	
	
	$row = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(10)->open();
		   
	
	$box = $ui->box()
			  
			  ->title('<u>Title</u> - '.$form1['consultancy_title'])
			  ->uiType('primary')
			  ->open();
	$row1 = $ui->row()->open();

	$column1 = $ui->col()->width(6)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(6)->open();
	
	$ui->input()
		    ->type('text')
		    ->label('CONS/')
		    ->name('cons')
		    ->disabled()
		    ->value($details->consultancy_no)
		    ->width(12)
		    ->required()
		    ->show();
	$column2->close();
	
	$row1->close();
	$form = $ui->form()
		->action('consultant/consultancy_proposal_approve/approve/'.$details->sr_no.'/'.$details->payment_no.'/'.$auth_id)->extras('enctype="multipart/form-data"')->open();
	
	$CI_box = $ui->box()
				 ->title('Consultancy Incharge')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow1 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Name')
		    ->name('name')
		    ->disabled()
		    ->value($user_detail->salutation.' '.$user_detail->first_name.' '.$user_detail->middle_name.' '.$user_detail->last_name)
		    ->width(12)
		    ->show();

		
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Designation')
		    ->name('designation')
		    ->value($des)
		    ->disabled()
		    ->width(6)
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('Department/Centre')
		    ->name('department/centre')
		    ->disabled()
		    ->value($department)
		    ->width(6)
		    ->show();

		

	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Telephone: Direct')
		    ->name('telephone')
		    ->disabled()
		    ->value($user_detail->contact_no)
		    ->width(6)
		    ->show();
		$ui->input()
		    ->type('text')
		    ->label('E-mail')
		    ->name('email')
		    ->disabled()
		    ->value($user_detail->email)
		    ->width(6)
		    ->show();

	$inputRow3->close();

	$CI_box->close();

	$ETS_box = $ui->box()
				 ->title('Expected Time Schedule')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow1 = $ui->row()->open();

	

	
		

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->input()
		    ->type('text')
		    ->label('Year')
		    ->name('year')
		    ->value($details->year)
		    ->width(3)
		    ->disabled()
		    ->show();

		 $ui->input()
		    ->type('text')
		    ->label('Month')
		    ->name('month')
		    ->width(3)
		    ->value($details->month)
		    ->disabled()
		    ->show();

		 $ui->input()
		    ->type('text')
		    ->label('Weeks')
		    ->name('weeks')
		    ->value($details->week)
		    ->width(3)
		    ->disabled()
		    ->show();

		 $ui->input()
		    ->type('text')
		    ->label('Days')
		    ->name('days')
		    ->value($details->days)
		    ->width(3)
		    ->disabled()
		    ->show();

	$inputRow2->close();

	$inputRow3 = $ui->row()->open();

   $ui->input()
	  ->type('text')
		->label('Starting Date')
			->value(date('d M Y ',strtotime($details->timestamp)+19800))
			->width(6)
			->disabled()
			->show();
	
	$inputRow3->close();


	$ETS_box->close();

	$Client_box = $ui->box()
				 ->title('Client Details(Fill in Block Letters)')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow1 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Firm Name')
		    ->name('firm_name')
		    ->value($details->firm_name)
		    ->width(12)
		    ->disabled()
		    ->show();

		
	$inputRow1->close();
	$inputRow2 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Contact Person Name')
		    ->name('contact_person_name')
		    ->value($details->person_name)
		    ->width(6)
		    ->disabled()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('Designation')
		    ->name('client_designation')
		    ->value($details->designation)
		    ->width(6)
		    ->disabled()
		    ->show();

		
	$inputRow2->close();
	$inputRow2_1 = $ui->row()->open();
		$ui->textarea()
		    ->label('Address')
            ->name('client_address')
            ->value($details->address)
            ->width(12)
            ->disabled()
            ->show();
	$inputRow2_1->close();
	$inputRow3 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('City')
		    ->name('client_city')
		    ->value($details->city)
		    ->width(6)
		    ->disabled()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('PIN')
		    ->name('client_pin')
		    ->value($details->pincode)
		    ->width(6)
		    ->disabled()
		    ->show();

		
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Phone No')
		    ->name('client_phone_no')
		    ->value($details->contact_no)
		    ->width(6)
		    ->disabled()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('EXTN')
		    ->name('client_extn')
		    ->value($details->extn)
		    ->width(6)
		    ->disabled()
		    ->show();

		
	$inputRow4->close();
	$inputRow5 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Fax')
		    ->name('client_fax')
		    ->value($details->fax)
		    ->width(6)
		    ->disabled()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('E-mail')
		    ->name('client_email')
		    ->value($details->email)
		    ->width(6)
		    ->disabled()
		    ->show();
	$inputRow5->close();
	$Client_box->close();
	/*****************************************************************************/
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
	
	/*****************************************************************************/
	$TCAPD_box = $ui->box()
				 ->title('Total Charges And Payment Details')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	
	$inputRow1 = $ui->row()->open();

    		$ui->input()
    		->label('Payment No.')
		    ->type('text')
		    ->name('payment_no')
		    ->value($details->payment_no)
		    ->disabled()
		    ->width(6)
		    ->show();
		$ui->input()
		    ->type('text')
		    ->label('Mode of Payment')
		    ->name('payment')
			->id("payment")
			->value($payment_mode)
		    ->width(6)
		    ->disabled()
		    ->show();
	$ui->input()
			    ->type('text')
			    ->label('Payment Enclosed')
			    ->name('payment_enclosed')
			    ->id("payment_enclosed")
			    ->value($payment_enclosed)
			    ->width(6)
			    ->disabled()
			    ->show();
	$ui->input()
		    ->type('text')
		    ->label('Currency')
		    ->name('currency')
			->id("currency")
			->value($currency)
		    ->width(6)
		    ->disabled()
		    ->show();
	$inputRow1->close();
	$inputRow2 = $ui->row()->open();
		
		$ui->input()
			    ->type('text')
			    ->label('Foreign Currency Type(if any)')
			    ->name('currency_type')
			    ->id("currency_type")
			    ->value($details->currency_type)
			    ->width(6)
			    ->disabled()
			    ->show();
	$inputRow2->close();
	$inputRow3 = $ui->row()->open();
		

		
	$inputRow3->close();
	$inputRow4 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Total Value(in figure)')
		    ->name('total_value_fig')
		    ->value($details->value_fig)
		    ->width(6)
		    ->disabled()
		    ->show();
    	$ui->input()
		    ->type('text')
		    ->label('Total Value(in words)')
		    ->name('total_value_words')
		    ->value($details->value_word)
		    ->width(6)
		    ->disabled()
		    ->show();

		
	$inputRow4->close();

	$inputRow5 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Bank Name and Branch')
		    ->name('bank_name')
		    ->value($details->bank_name)
		    ->width(6)
		    ->disabled()
		    ->show();
	
		$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection No.')
		    ->name('dd_cheque_no')
		    ->value($details->dd_cheque_no)
		    ->width(6)
		    ->disabled()
		    ->show();

		
	$inputRow5->close();
	$inputRow6 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection Amount')
		    ->name('dd_cheque_amount')
		    ->value($details->dd_cheque_amt)
		    ->width(6)
		    ->disabled()
		    ->show();

		$ui->datePicker()
			->name('dd_cheque_date')
		    ->label('DD/Cheque/Transection Date.')			
			//->extras(min='date("Y-m-d")')
			//->value(date("yy-mm-dd"))
			->dateFormat('yyyy-mm-dd')
			->value($details->dd_cheque_date)
			->width(6)
			->disabled()
			->show();	
	    
	$inputRow6->close();
	$inputRow6 = $ui->row()->open();
	$innercol2=$ui->col()->width(12)->open();
	  echo '<b>scan copy of DD/Cheque/Transection</b> ';
      echo '<a href="'.base_url().'assets/files/consultant/DD/'.$details->file_path.'" title=
            "download file" download="'.$details->file_path.'">'.$details->file_path.'</a><br/>';
     $innercol2->close();    
	$inputRow6->close();

	$TCAPD_box->close();

	$OAT_box = $ui->box()
				 ->title('Objective And Type')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
			  	
	$tabBox1 = $ui->tabBox()
				  ->tab("scope", "Scope of consultancy", true)
				  ->tab("testing", "Testing Type")
				  ->tab("client", "Client Type")
			      ->open();
	$tab1 = $ui->tabPane()->id("scope")->active()->open();
	$flag=1;
	


	/**scope of consultancy*/
	
		$inputRow1 = $ui->row()->open();
		
      	
      	$innercol2=$ui->col()->width(12)->open();
	  echo '<b>Scope of Consultancy</b> ';
      echo '<a href="'.base_url().'assets/files/consultant/SCOPE_CONSULT/'.$details->scope_consultancy.'" title=
            "download file" download="'.$details->scope_consultancy.'">'.$details->scope_consultancy.'</a><br/>';
     $innercol2->close();  
   	    $inputRow1->close();
	
    $tab1->close();




	$tab2 = $ui->tabPane()->id("testing")->open();
	$flag=2;
	$inputRow1 = $ui->row()->open();
	$inputRow2 = $ui->col()->width(8)->open();

	$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>No.</th>
			<th></th>
			<th></th>
			
		
		</thead>
	
			<tr>
				<td>1.</td>
				<td>
					<? echo 'Product Development'; ?>
				</td>
				<td align='center'><?
				if($details->product_development)
				{
					$ui->icon('check')->show();
					//$ui->button()->mini()->uiType('success')->icon($ui->icon('check'))->disabled()->show();
				}
				
				
					
					
					?>
				</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>
					<? echo 'Process Development'; ?>
				</td>
				<td align='center'>
					<?
					if($details->process_development)
					{
					 $ui->icon('check')->show();
				    }
				
					?>
				</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>
					<? echo 'Checking of Design'; ?>
				</td>
				<td align='center'>
					<?
					if( $details->checking_of_design)
					{
					$ui->icon('check')->show();
					}
					
					?>
				</td>
			</tr>
			<tr>
				<td>4.</td>
				<td>
					<? echo 'Checking of Analysis'; ?>
				</td>
				<td align='center'>
					<?
					if( $details->checking_of_analysis)
					{
						$ui->icon('check')->show();
					}
				
					?>
				</td>
			</tr>
			<tr>
				<td>5.</td>
				<td>
					<? echo 'Report Writing/Evaluation'; ?>
				</td>
				<td align='center'>
					<?
					if($details->report_writing)
					{
					$ui->icon('check')->show();
					}
				
					?>
				</td>
			</tr>
			<tr>
				<td>6.</td>
				<td>
					<? echo 'Testing & Interpretation'; ?>
				</td>
				<td align='center'>
					<?
					if($details->testing)
					$ui->icon('check')->show();
				
					?>
				</td>
			</tr>
			<tr>
				<td>7.</td>
				<td>
					<? echo 'HRD/CEP'; ?>
				</td>
				<td align='center'>
					<?
					if($details->hrd)
				$ui->icon('check')->show();
				
					?>
				</td>
			</tr>
			<tr>
				<td>8.</td>
				<td>
					<? echo 'Computation'; ?>
				</td>
				<td align='center'>
					<?
					if($details->computation)
					$ui->icon('check')->show();
					?>
				</td>
			</tr><tr>
				<td>9.</td>
				<td>
					<? echo 'Advice'; ?>
				</td>
				<td align='center'>
					<?
					if( $details->advice)
				$ui->icon('check')->show();
					?>
				</td>
			</tr><tr>
				<td>10.</td>
				<td>
					<? echo 'other specify'; ?>
				</td>
				<td align='center'>
					<?
					
				   	 $value=$details->other;
					 $ui->input()
					    ->type('text')
					    ->name('testing10')
					    ->value($value)
					    ->disabled()
					    ->width(12)
					    ->show();
					?>
				</td>
			</tr>
		<?

		$table->close();
		
		
		
	 $inputRow2->close();
	 $inputRow1->close();

	 $tab2->close();



     $tab3 = $ui->tabPane()->id("client")->open();
	 $flag=3;

	 $inputRow1 = $ui->row()->open();
	 $inputRow2 = $ui->col()->width(8)->open();
		$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>No.</th>
			<th></th>
			<th></th>
			
		
		</thead>
	
			<tr>
				<td>1.</td>
				<td>
					<? echo 'Private Sector'; ?>
				</td>
				<td align='center'>
					<?
					
					if($details->private_sector)
					$ui->icon('check')->show();
					
					?>
				</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>
					<? echo 'Govt Sector'; ?>
				</td>
				<td align='center'>
					<?
					if($details->govt_sector)
					$ui->icon('check')->show();
					?>
				</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>
					<? echo 'Publict Sector'; ?>
				</td>
				<td align='center'>
					<?
					if($details->public_sector)
					$ui->icon('check')->show();
					?>
				</td>
			</tr>
			<tr>
				<td>4.</td>
				<td>
					<? echo 'Funding Agency'; ?>
				</td>
				<td align='center'>
					<?
					if($details->funding_agency)
					$ui->icon('check')->show();
					?>
				</td>
			</tr>
			<tr>
				<td>5.</td>
				<td>
					<? echo 'Foreign Organisation'; ?>
				</td>
				<td align='center'>
					<?
					if($details->foreign_organisation)
					$ui->icon('check')->show();
					?>
				</td>
			</tr>
			<tr>
				<td>6.</td>
				<td>
					<? echo 'Other Specify'; ?>
				</td>
				<td align='center'>
					<?
					
				   	 $value=$details->other_client;
					 $ui->input()
					    ->type('text')
					    ->name('client6')
					    ->value($value)
					    ->disabled()
					    ->width(12)
					    ->show();
					?>
				</td>
			</tr>
	<?

		$table->close();
	$inputRow2->close();
	

	$tab3->close();
	$tabBox1->close();

	$inputRow1 = $ui->row()->open();

	$column1 = $ui->col()->width(6)->open();
	?><h4>Correspondence with client :</h4><?
	$column1->close();
	$correspondence;
	/*****************************************************************************/
	if($details->correspondence == 1)
		$correspondence='Yes';
	else
		$correspondence='No';
	/*****************************************************************************/
	
			$ui->input()
			    ->type('text')
			    ->name('correspondence')
			    ->value($correspondence)
			    ->width(6)
			    ->disabled()
			    ->show();
	
	
	

$innerrow1=$ui->col()->width(6)->open();
  $col1=$ui->col()->width(12)->open();
          ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken')
             ->value('Approve')
             ->uiType('success')
             ->show();
          ?>
          </center><br/><?
  $col1->close();
  $col1=$ui->col()->id('approve_col')->width(12)->open();
          ?><center>
          <?
          $ui->textarea()
              ->label('Remark')
              ->id('remark_text1')
              ->name('remark_text1')
              ->placeholder('Not more than 200 character')
              ->value('')
              ->show();
          $ui->button()->icon($ui->icon('check'))
             ->type('submit')
             ->name('action_taken')
             ->id('action_taken3')
             ->value('Are You Sure To Approve')
             ->uiType('success')
             ->show();
          ?>
          </center><?
  $col1->close();
  $innerrow1->close();
   $innerrow1=$ui->col()->width(6)->open();
  $col1=$ui->col()->width(6)->open();
          ?><center></br>
          <?
          $ui->button()->icon($ui->icon('remove'))
             
             ->name('action_taken')
              ->id('action_taken1')
             ->value('Reject')
             ->uiType('danger')
             ->show();
          ?>
          </center><br/><?

  $col1->close();
 
  $col1=$ui->col()->id('reject_col')->width(12)->open();
          ?><center>
          <?
          $ui->textarea()
              ->label('Remark')
              ->id('remark_text2')
              ->name('remark_text2')
              ->placeholder('Not more than 200 character')
              ->value('')
              ->show();
          $ui->button()->icon($ui->icon('remove'))
             ->type('submit')
             ->name('action_taken')
              ->id('action_taken4')
             ->value('Are You Sure To Reject')
             ->uiType('danger')
             ->show();
          ?>
          </center><?
  $col1->close();
  $innerrow1->close();
 
  $inputRow1->close();
  $OAT_box->close();
	$form->close();
$row2=$ui->row()->noPrint()->open();
	 $col2= $ui->col()->width(6)->open();
           $ui->printButton()->noPrint()
           	  ->uiType('primary')
           	  
           	  ->id('print_button')
           	  ->show();
    $col2->close();
 $row2->close();
	$box->close();
	$column2->close();

	$row->close();
?>