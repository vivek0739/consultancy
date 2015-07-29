<script type="text/javascript">
$(window).load(function(){

	$('#year').val('<? echo $client->year;?>');
$('#month').val('<?echo $client->month;?>');
$('#weeks').val('<?echo $client->week;?>');
$('#days').val('<?echo $client->days;?>');
	

});
</script>
<?php

	$ui = new UI();
	print_r($client);
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');

	foreach ($details as $detail)

	$row1 = $ui->row()->open();

	
	$row1->close();
	$row = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(10)->open();
	
	
	$box = $ui->box()
			  ->title('<u>Title</u> - '.$cons_row->consultancy_title)
			  
			  ->uiType('primary')
			  ->open();
    $column1 = $ui->col()->width(6)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(6)->open();

	$ui->input()
		    ->type('text')
		    ->label('CONS/')
		    ->name('cons')
		    ->value($id->consultancy_no+1)
		    ->disabled()
		    ->width(10)
		    //->placeholder()
		    ->show();

	$column2->close();
	$ui->callout()
				   ->uiType("info")
				   ->desc('AGREEMENT BETWEEN CLIENT AND CONSULTANT:(To be filled in only on the request of client):This agreement is subject to the Standard Term and Conditions for undertaking/Testing/Project at ISM Dhanbad unless specially agreed to otherwise, the details mentioned above have been read and are acceptable.')
				   ->show();
	$form =  $ui->form()
				->action('consultant/consultancy_proposal_form/edit/'.$cons_row->sr_no.'/'.$client->payment_no.'/ft')
				->extras('enctype="multipart/form-data"')
				->id('form_submit')
				->open();
	
	$CI_box = $ui->box()
				 ->title('Consultancy Incharge')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow1 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Name<span style= "color:red;"> *</span>')
		    ->name('name')
		    //->required()
		    ->disabled()
		    ->value($detail->salutation.' '.$detail->first_name.' '.$detail->middle_name.' '.$detail->last_name)
		    ->width(12)
		    //->placeholder()
		    ->show();

		
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Designation<span style= "color:red;"> *</span>')
		    ->name('designation')
		    ->value($detail->designation)
		    //->required()
		    ->disabled()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('Department/Centre<span style= "color:red;"> *</span>')
		    ->name('department/centre')
		    //->required()
		    ->disabled()
		    ->value($detail->dept_name)
		    ->width(6)
		    //->placeholder()
		    ->show();

	$inputRow2->close();

	$inputRow3 = $ui->row()->open();

		
		$ui->input()
		    ->type('text')
		    ->label('Telephone: Direct<span style= "color:red;"> *</span>')
		    ->name('telephone')
		    //->required()
		    ->disabled()
		    ->value($detail->contact_no)
		    ->width(6)
		    //->placeholder()
		    ->show();


		$ui->input()
		    ->type('text')
		    ->label('E-mail<span style= "color:red;"> *</span>')
		    ->name('email')
		    //->required()
		    ->disabled()
		    ->value($detail->email)
		    ->width(6)
		    //->placeholder()
		    ->show();

	$inputRow3->close();

	$CI_box->close();

	$ETS_box = $ui->box()
				 ->title('Expected Time Schedule')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow1 = $ui->row()->open();

		
		
	$array1= array();
	for($i=0;$i<100;$i++)
	{
		array_push($array1,$ui->option()->value($i)->text($i));
	}
	$ui->select()
			->label('Year<span style= "color:red;"> *</span>')
		    ->name('year')
		   	->id('year')
			->options($array1)
			->width(3)
			->show();

	$array_month= array();
	for($i=0;$i<13;$i++)
	{
		array_push($array_month,$ui->option()->value($i)->text($i));
	}
	$ui->select()
			->label('Month<span style= "color:red;"> *</span>')
		    ->name('month')
		    ->id('month')
			->options($array_month)
			->width(3)
			->show();	

	
	$array_weeks= array();
	for($i=0;$i<6;$i++)
	{
		array_push($array_weeks,$ui->option()->value($i)->text($i));
	}
	$ui->select()
			->label('Weeks<span style= "color:red;"> *</span>')
		    ->name('weeks')
		    ->id('weeks')
			->options($array_weeks)
			->width(3)
			->show();

$array_days= array();
	for($i=0;$i<32;$i++)
	{
		array_push($array_days,$ui->option()->value($i)->text($i));
	}
	$ui->select()
			->label('Days<span style= "color:red;"> *</span>')
		    ->name('days')
		    ->id('days')
			->options($array_days)
			->width(3)
			->show();

	$inputRow1->close();

	$inputRow3 = $ui->row()->open();
	

	$ui->datePicker()
			->name('starting_date')
		    ->label('Starting Date<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value(date("Y-mm-dd"))
			->dateFormat('yyyy-mm-dd')
			->value($client->timestamp)
			->width(6)
			->show();
	
	$ui->input()
		    ->type('hidden')
		    ->name('sr_no')
		    ->value($cons_row->sr_no)
		    ->required()
		    
		    //->placeholder()
		    ->show();
	$value=1;
	if(isset($id))
	$value=$id->consultancy_no+1;
    $ui->input()
		    ->type('hidden')
		    ->name('cons')
		    ->value($value)
		    ->required()
		   
		    //->placeholder()
		    ->show();
	$value=$payment_no+1;
    $ui->input()
		    ->type('hidden')
		    ->name('payment_no')
		    ->value($value)
		    ->required()
		    
		    //->placeholder()
		    ->show();
    $ui->input()
		    ->type('hidden')
		    ->name('modification_value')
		    ->value($client->modification_value)
		    ->required()
		    
		    //->placeholder()
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
		    ->label('Firm Name<span style= "color:red;"> *</span>')
		    ->name('firm_name')
		    ->value($client->firm_name)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('Contact Person Name<span style= "color:red;"> *</span>')
		    ->name('contact_person_name')
		    ->value($client->person_name)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
	$inputRow1->close();
	$inputRow2 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Designation<span style= "color:red;"> *</span>')
		    ->name('client_designation')
		    ->value($client->designation)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->textarea()
		    ->label('Address<span style= "color:red;"> *</span>')
            //->placeholder()
            ->name('client_address')
            ->id('address')
            ->value($client->address)
            ->required()
            ->width(6)
            ->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('City<span style= "color:red;"> *</span>')
		    ->name('client_city')
		    ->id('city')
		    ->value($client->city)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('PIN<span style= "color:red;"> *</span>')
		    ->name('client_pin')
		    ->id('pincode')
		    ->value($client->pincode)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Phone No<span style= "color:red;"> *</span>')
		    ->name('client_phone_no')
		    ->id('client_phone_no')
		    ->value($client->contact_no)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('EXTN<span style= "color:red;"> *</span>')
		    ->name('client_extn')
		    ->id('client_extn')
		    ->value($client->extn)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		
	$inputRow4->close();
	$inputRow5 = $ui->row()->open();

		$ui->input()
		    ->type('text')
		    ->label('Fax<span style= "color:red;"> *</span>')
		    ->name('client_fax')
		    ->id('client_fax')
		    ->value($client->fax)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('E-mail<span style= "color:red;"> *</span>')
		    ->name('client_email')
		    ->id('client_email')
		    ->value($client->email)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
	$inputRow5->close();
	$Client_box->close();

	$TCAPD_box = $ui->box()
				 ->title('Total Charges And Payment Details')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow4 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Total Value(in figure)<span style= "color:red;"> *</span>')
		    ->name('total_value_fig')
		    ->id('value_fig')
		    ->value($client->value_fig)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
    	$ui->input()
		    ->type('text')
		    ->label('Total Value(in words)<span style= "color:red;"> *</span>')
		    ->name('total_value_words')
		    ->id('value_word')
		    ->value($client->value_word)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		
	$inputRow4->close();
	
	$inputRow2 = $ui->row()->open();
	if($client->payment_mode==0)
	{
		$ui->select()
			->label('Mode of Payment :')
			->name('payment')
			->id("payment")
			->options(array($ui->option()->value('0')->text('BY Cheque')->selected(),
		   					$ui->option()->value('1')->text('BY Draft')))
			->width(6)
			->show();
	}
	else
	{
		$ui->select()
			->label('Mode of Payment :')
			->name('payment')
			->id("payment")
			->options(array($ui->option()->value('0')->text('BY Cheque'),
		   					$ui->option()->value('1')->text('BY Draft')->selected()))
			->width(6)
			->show();
	}
	if($client->currency==0)
	{
		$ui->select()
			->label('Currency :')
			->name('currency')
			->id("currency")
			->options(array($ui->option()->value('0')->text('Indian Currency')->selected(),
			   					$ui->option()->value('1')->text('Foreign Currency')))
			->width(6)
			->show();
	}	
	else
	{
		$ui->select()
			->label('Currency :')
			->name('currency')
			->id("currency")
			->options(array($ui->option()->value('0')->text('Indian Currency'),
			   					$ui->option()->value('1')->text('Foreign Currency')->selected()))
			->width(6)
			->show();
	}
		
	$inputRow2->close();

	
	$innerRow1 = $ui->row()->open();
	if($client->payment_enclosed==0)
	{
		$ui->select()
			->label('Payment Enclosed :')
			->name('payment_enclosed')
			->id("payment_enclosed")
			->options(array($ui->option()->value('0')->text('Full Payment')->selected(),
			   					$ui->option()->value('1')->text('Part Payment')))
			->width(6)
			->show();
	}
	else
	{
		$ui->select()
			->label('Payment Enclosed :')
			->name('payment_enclosed')
			->id("payment_enclosed")
			->options(array($ui->option()->value('0')->text('Full Payment'),
			   					$ui->option()->value('1')->text('Part Payment')->selected()))
			->width(6)
			->show();
	}
	

	$column2 = $ui->col()->id('currency_row')->width(6)->open();
		$ui->input()
			    ->type('text')
			    ->label('Currency Type')
			    ->name('currency_type')
			    ->id("currency_type")
			    ->width(12)
			    ->show();
	$column2->close();
	$innerRow1->close();
	
	
	$inputRow3 = $ui->row()->open();
		

		
	$inputRow3->close();
	

	$inputRow5 = $ui->row()->open();
		$ui->input()
		    ->type('text')
		    ->label('Bank Name and Branch<span style= "color:red;"> *</span>')
		    ->name('bank_name')
		    ->value($client->bank_name)
		    ->required()
		    ->width(6)
		    ->show();

		$ui->datePicker()
			->name('dd_cheque_date')
		    ->label('DD/Cheque/Transection Date.<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value($client->dd_cheque_date)
			->dateFormat('yyyy-mm-dd')
			->width(6)
			->show();
		
	$inputRow5->close();
	$inputRow6 = $ui->row()->open();
	$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection No.<span style= "color:red;"> *</span>')
		    ->name('dd_cheque_no')
		    ->value($client->dd_cheque_no)
		    ->required()
		    ->width(6)
		    ->show();

		$ui->input()
		    ->type('text')
		    ->label('DD/Cheque/Transection Amount<span style= "color:red;"> *</span>')
		    ->name('dd_cheque_amount')
		    ->value($client->dd_cheque_amt)
		    ->required()
		    ->width(6)
		    ->show();

		    
	$inputRow6->close();
	$innercol3=$ui->col()->width(6)->open();
        $coll=$ui->col()->width(8)->open();
    echo '<br>&nbsp;&nbsp;<a href="'.base_url().'assets/files/consultant/DD/'.$client->file_path.'" title=
            "download file" download="'.$client->file_path.'">'.$client->file_path.'</a>';
      $coll->close();
      $colll=$ui->col()->width(4)->open();
    $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
    echo "&nbsp;<div  align='right'>";
    $ui->button()->icon($ui->icon('refresh'))
      ->value('Change File')
        ->uiType('primary')
        ->extras($js)
        //->submit()
        ->show();
     echo "</div><br/>";

    $colll->close();
     	$innercol2=$ui->col()->id('filebox')->extras('style="display:none"')->width(12)->open();

        
            $ui->input()
            ->label('Scan copy of DD/Cheque/Transection <span style= "color:red;"> *</span>')
              ->type('file')
              ->id('scope_path')
              ->name('scope_path')
              //->required()
              ->width(12)
              ->show();   

    echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
     	$innercol2->close();
     $innercol3->close(); 
     $innercol3=$ui->row()->open();
       $innercol3->close(); 
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
		$innercol3=$ui->col()->width(12)->open();
      	$inputRow1 = $ui->row()->open();
      	echo '<br>&nbsp;&nbsp;';
      	$js = 'onclick="javascript:document.getElementById(\'filebox1\').style.display=\'block\';"';
      	
      	$ui->button()->icon($ui->icon('refresh'))
                   ->value('Scope Of Consultancy')
                   ->uiType('primary')
                   ->extras($js)
                   ->width(6)
                   //->submit()
                   ->show();
        echo "&nbsp;&nbsp;";
       	
      	echo '<a href="'.base_url().'assets/files/consultant/SCOPE_CONSULT/'.$client->scope_consultancy.'" title=
            "download file" download="'.$client->scope_consultancy.'">'.$client->scope_consultancy.'</a>';
     
      	echo "<br/><br/>";
     	$inputRow1->close();
      	$inputRow1 = $ui->row()->open();
      
      	$innercol2=$ui->col()->id('filebox1')->extras('style="display:none"')->width(12)->open();

        
            $ui->input()
            ->label('Scope of Consultancy <span style= "color:red;"> *</span>')
              ->type('file')
              ->id('scope_consultancy')
              ->name('scope_consultancy')
              
              ->width(12)
              ->show(); 
             

      	echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
      	$innercol2->close();
      	$ui->input()
              ->type('hidden')
              ->id('scope_consultancy1')
              ->name('scope_consultancy1')
              ->value($client->scope_consultancy)
              ->width(12)
              ->show();   
      	$inputRow1->close();
      	$innercol3->close();
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
				if($client->product_development)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing1')
		               ->name('testing1')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						echo 5;
						$ui->input()
		               ->type('checkbox')
		               ->id('testing1')
		               ->name('testing1')
		              	->value(1)
		               ->show();
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
					if($client->process_development)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing2')
		               ->name('testing2')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing2')
		               ->name('testing2')
		              	->value(1)
		               ->show();
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
					if( $client->checking_of_design)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing3')
		               ->name('testing3')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing3')
		               ->name('testing3')
		              	->value(1)
		               ->show();
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
					if( $client->checking_of_analysis)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing4')
		               ->name('testing4')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						$ui->input()
		               ->type('checkbox')
		               ->id('testing4')
		               ->name('testing4')
		              	->value(1)
		               ->show();
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
					if($client->report_writing)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing5')
		               ->name('testing5')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing5')
		               ->name('testing5')
		              	->value(1)
		               ->show();
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
					if($client->testing)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing6')
		               ->name('testing6')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing6')
		               ->name('testing6')
		              	->value(1)
		               ->show();
				}
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
					if($client->hrd)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing7')
		               ->name('testing7')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing7')
		               ->name('testing7')
		              	->value(1)
		               ->show();
				}
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
					if($client->computation)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing8')
		               ->name('testing8')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testing8')
		               ->name('testing8')
		              	->value(1)
		               ->show();
				}
					?>
				</td>
			</tr><tr>
				<td>9.</td>
				<td>
					<? echo 'Advice'; ?>
				</td>
				<td align='center'>
					<?
					if( $client->advice)
				{
					$ui->input()
		               ->type('checkbox')
		               ->id('testing9')
		               ->name('testing9')
		               ->extras('checked')
		              	->value(1)
		               ->show();
				}
				else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('testin9')
		               ->name('testing9')
		              	->value(1)
		               ->show();
				}
					?>
				</td>
			</tr><tr>
				<td>10.</td>
				<td>
					<? echo 'other specify'; ?>
				</td>
				<td align='center'>
					<?
					$value='';
					if( $client->other!='')
				   	 $value=$client->other;
					 $ui->input()
					    ->type('text')
					    ->name('testing10')
					    ->value($value)
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
					
					if($client->private_sector)
					{
					$ui->input()
		               ->type('checkbox')
		               ->id('client1')
		               ->name('client1')
		               ->extras('checked')
		              	->value(1)
		               ->show();
					}
					else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('client1')
		               ->name('client1')
		              	->value(1)
		               ->show();
					}
					
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
					if($client->govt_sector)
					{
					$ui->input()
		               ->type('checkbox')
		               ->id('client12')
		               ->name('client2')
		               ->extras('checked')
		              	->value(1)
		               ->show();
					}
					else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('client2')
		               ->name('client2')
		              	->value(1)
		               ->show();
					}
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
					if($client->public_sector)
					{
					$ui->input()
		               ->type('checkbox')
		               ->id('client3')
		               ->name('client3')
		               ->extras('checked')
		              	->value(1)
		               ->show();
					}
					else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('client3')
		               ->name('client3')
		              	->value(1)
		               ->show();
					}
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
					if($client->funding_agency)
					{
					$ui->input()
		               ->type('checkbox')
		               ->id('client4')
		               ->name('client4')
		               ->extras('checked')
		              	->value(1)
		               ->show();
					}
					else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('client4')
		               ->name('client4')
		              	->value(1)
		               ->show();
					}
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
					if($client->foreign_organisation)
					{
					$ui->input()
		               ->type('checkbox')
		               ->id('client5')
		               ->name('client5')
		               ->extras('checked')
		              	->value(1)
		               ->show();
					}
					else
					{
						
						$ui->input()
		               ->type('checkbox')
		               ->id('client5')
		               ->name('client5')
		              	->value(1)
		               ->show();
					}
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
					$value='';
					if( $client->other_client!='')
				   	 $value=$client->other_client;
					 $ui->input()
					    ->type('text')
					    ->name('client6')
					    ->value($value)
					    ->width(12)
					    ->show();
					?>
				</td>
			</tr>
	<?

		$table->close();
	$inputRow2->close();
	$innerRow1->close();

	$tab3->close();
	$tabBox1->close();


	$inputRow1 = $ui->row()->open();

	$column1 = $ui->col()->width(4)->open();
	?><h4>Correspondence with client :</h4><?
	$column1->close();

	$column2 = $ui->col()->width(4)->open();
	$ui->radio()->label("Yes")->name("correspondence")->value('1')->checked()->show();
	$column2->close();

	$column3 = $ui->col()->width(4)->open();
	$ui->radio()->label("No")->name("correspondence")->value('0')->show();
	$column3->close();

	$inputRow1->close();
	$innerrow1=$ui->row()->open();
  $col1=$ui->col()->width(12)->open();
  echo '<br/>';
          $ui->textarea()
            ->label('Reason For Edition')
            ->id('remark')
            ->name('remark')
            ->required()
            ->placeholder('reason for change')
            ->show();
  $col1->close();
  $innerrow1->close();
	
	$OAT_box->close();

?>
<center>
<?php
	 $ui->button()
		->value(' submit ')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();

	$form->close();
	$box->close();
	$column2->close();

	$row->close();
?>