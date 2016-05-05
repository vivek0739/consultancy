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
		    ->label('Linkup No')
		    ->name('link')
		    ->value($result->link_up_no)
		    ->disabled()
		    ->width(6)
		    //->placeholder()
		    ->show();
	$ui->input()
		    ->type('text')
		    ->label('Page No')
		    ->name('page')
		    ->value($result->page_no)
		    ->width(6)
		    ->disabled()
		    //->placeholder()
		    ->show();
		   // print_r($details->consultancy_no);
		    $form = $ui->form()
		->action('consultant/consultancy_proposal_approve/approve_fill/'.$details->sr_no.'/'.$details->payment_no.'/'.$auth_id)->extras('enctype="multipart/form-data"')->open();
	if($payment_no->payment_no > 1 && $auth_id == 'pce')
	$ui->input()
		    ->type('text')
		    ->label('CONS/')
		    ->value($details->consultancy_no)
		    ->disabled()
		    ->width(10)
		    //->placeholder()
		    ->show();
	else
		$ui->input()
		    ->type('text')
		    ->label('CONS/')
		    ->name('cons')
		    ->value()
		    ->width(10)
		    ->required()
		    ->show();

	$column2->close();
	
	$row1->close();
	
	
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
	$TCAPD_box = $ui->box()
				 ->title('Total Charges And Payment Details')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow4 = $ui->row()->open();
	$value=$payment_no->payment_no;
    		$ui->input()
    		->label('Payment No.')
		    ->type('text')
		    ->name('payment_no')
		    ->value($value)
		    ->disabled()
		    ->width(6)
		    ->show();
	$value='';
		if($payment_no->payment_no > 1) $value=$client->value_fig;
		$ui->input()
		    ->type('text')
		    ->label('Total Value(in figure)<span style= "color:red;"> *</span>')
		    ->name('total_value_fig')
		    ->id('value_fig')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		 $value='';
		if($payment_no->payment_no > 1) $value=$client->value_word;
    	$ui->input()
		    ->type('text')
		    ->label('Total Value(in words)<span style= "color:red;"> *</span>')
		    ->name('total_value_words')
		    ->id('value_word')
		    ->value($value)
		    ->required()
		    ->width(12)
		    //->placeholder()
		    ->show();

		
	$inputRow4->close();
	
	$inputRow2 = $ui->row()->open();
		$ui->select()
			->label('Mode of Payment :')
			->name('payment')
			->id("payment")
			->options(array($ui->option()->value('0')->text('Cheque')->selected(),
		   					$ui->option()->value('1')->text('Draft'),
		   					$ui->option()->value('2')->text('Online Payment')))
			->width(6)
			->show();
		$ui->select()
			->label('Currency :')
			->name('currency')
			->id("currency")
			->options(array($ui->option()->value('0')->text('Indian Currency')->selected(),
			   					$ui->option()->value('1')->text('Foreign Currency')))
			->width(6)
			->show();
	$inputRow2->close();

	
	$innerRow1 = $ui->row()->open();
	
	$ui->select()
			->label('Payment Enclosed :')
			->name('payment_enclosed')
			->id("payment_enclosed")
			->options(array($ui->option()->value('0')->text('Full Payment')->selected(),
			   					$ui->option()->value('1')->text('Part Payment')))
			->width(6)
			->show();

	?><div id='currency_row'>
	<?$ui->input()
			    ->type('text')
			    ->label('Currency Type')
			    ->name('currency_type')
			    ->id("currency_type")
			    ->width(6)
			    ->show();?>
	</div><?
		
	
	$innerRow1->close();
	
	
	$inputRow3 = $ui->row()->open();
		

		
	$inputRow3->close();
	

	$inputRow5 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Bank Name and Branch<span style= "color:red;"> *</span>')
		    ->name('bank_name')
		    ->required()
		    ->width(6)
		    ->show();

		$ui->datePicker()
			->name('dd_cheque_date')
		    ->label('DD/Cheque/Transection Date.<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value(date("yy-mm-dd"))
			->dateFormat('yy-mm-dd')
			->width(6)
			->show();
		
	$inputRow5->close();
	$inputRow6 = $ui->row()->open();
	$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection No.<span style= "color:red;"> *</span>')
		    ->name('dd_cheque_no')
		    ->required()
		    ->width(6)
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection Amount<span style= "color:red;"> *</span>')
		    ->name('dd_cheque_amount')
		    ->id('dd_cheque_amount')
		    ->required()
		    ->width(6)
		    ->show();

		    
	$inputRow6->close();
	$inputRow6 = $ui->row()->open();
	$innercol2=$ui->col()->width(12)->open();
        $ui->input()
          ->label('Scan Copy Of DD/Cheque/Transection')
            ->type('file')
            ->name('scope_path')
            ->required()
            
            ->show();

    echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
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
					<? echo 'Public Sector'; ?>
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
	
	$value=$payment_no->payment_no;
    $ui->input()
		    ->type('hidden')
		    ->name('payment_no')
		    ->value($value)
		    ->required()
		    
		    //->placeholder()
		    ->show();
	
$col1=$ui->col()->width(12)->open();
    $action = $action_recent;
    echo '<span style="color:red"> Last Activity : ';
    if($action->status==0)
          echo 'Pending estimate form';
          else if($action->status==1||$action->status==98)
          echo 'Canceled by Consultancy-in-charge';
          else if($action->status==2)
          echo 'Estimated Form Rejeced by ' . $action->auth.'';
          else if($action->status==3 )
          echo 'Estimated Form Forwarded by '.$action->auth.'';
          else if($action->status==7)
          echo 'Payment Completed!';
          else if($action->status==99 )
          echo 'Pending Disbursement Form';
          else if($action->status==100 )
          echo 'Disbursement Form Rejected by '.$action->auth.'';
          else if($action->status==101||$action->status==102||$action->status==103)
          echo 'Disbursement Form Approved by '.$action->auth.'';
          else if($action->status==104 )
          echo 'Pending Project Account Form';
          else if($action->status==105 )
          echo 'Project Account Form Rejected by '.$action->auth.'';
          else if($action->status==106 )
          echo 'Project Account Form recommended to Director by PCE';
            else if($action->status==107||$action->status==108)
          echo 'Project Account Form Approved by '.$action->auth.'';
          
          else if($action->status>=4 && $action->status <= 5 )
          echo 'Estimated Form Approved by '.$action->auth.'';
          else if(($action->status-4)%4==0 )
          echo 'Pending Proposal Form';
          else if($action->status==7)
          echo 'Completed!';
          else if(($action->status-6)%4==0)
          echo 'Proposal Form Approved By Pce';
          else if(($action->status-5)%4==0)
          echo 'Proposal Form Rejected By Pce';
          else if(($action->status-7)%4==0)
          echo 'ISM Cash Receipt has been Generated';

         
    echo ' ('.date('d M Y g:i a',strtotime($action_recent->timestamp)+19800).') </span>';
    $col1->close();
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
  $col1=$ui->col()->width(12)->open();
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
           echo '<center>';
		echo '<a class="btn btn-primary" href="'.base_url().'index.php/consultant/consultancy_proposal_approve/viewtest/'.$details->sr_no.'/'.$details->payment_no.'/'.$auth_id.'">Print</a>';
		echo '</center>';
    $col2->close();
 $row2->close();
	$box->close();
	$column2->close();

	$row->close();
?>