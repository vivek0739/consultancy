<script type="text/javascript">
$(document).ready(function(){
var pay='<? echo $payment_no->payment_no;?>';
	document.getElementById("testing1").checked = true;
if(pay.trim()!='0')
{
	
	$('#year').val('<?if($payment_no->payment_no) echo $client->year;?>');
	$('#month').val('<?if($payment_no->payment_no) echo $client->month;?>');
	$('#weeks').val('<?if($payment_no->payment_no) echo $client->week;?>');

	$('#days').val('<?if($payment_no->payment_no) echo $client->days;?>');
	
	
	

}

});

</script>
<?php

	$ui = new UI();
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

	if($payment_no->payment_no)
	$ui->input()
		    ->type('text')
		    ->label('CONS/')
		    ->name('cons')
		    ->value($id->consultancy_no)
		    ->disabled()
		    ->width(10)
		    //->placeholder()
		    ->show();

	$column2->close();
	$ui->callout()
				   ->uiType("info")
				   ->desc('AGREEMENT BETWEEN CLIENT AND CONSULTANT:(To be filled in only on the request of client):This agreement is subject to the Standard Term and Conditions for undertaking/Testing/Project at ISM Dhanbad unless specially agreed to otherwise, the details mentioned above have been read and are acceptable.')
				   ->show();
	$form = $ui->form()
			   ->action('consultant/consultancy_proposal_form/index_without/'.$cons_row->sr_no)
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
	$inputRow3 = $ui->row()->open();
	$array1= array();
	array_push($array1,$ui->option()->value(0)->text(0)->selected());
	for($i=1;$i<100;$i++)
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
	array_push($array_month,$ui->option()->value(0)->text(0)->selected());
	for($i=1;$i<13;$i++)
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
	array_push($array_weeks,$ui->option()->value(0)->text(0)->selected());
	for($i=1;$i<6;$i++)
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
$array_days[0]=$ui->option()->value(0)->text(0)->selected();
	for($i=1;$i<32;$i++)
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
	
	$value='';
	//print_r($payment_no);
		if($payment_no->payment_no) $value=$client->timestamp; else $value=date("Y-mm-dd");
	$ui->datePicker()
			->name('starting_date')
		    ->label('Starting Date<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value(date("Y-mm-dd"))
			->dateFormat('yyyy-mm-dd')
			->value($value)
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
	if(!empty($id))
	$value=$id->consultancy_no;
    $ui->input()
		    ->type('hidden')
		    ->name('cons')
		    ->value($value)
		    ->required()
		   
		    //->placeholder()
		    ->show();
	$value=$payment_no->payment_no+1;
    $ui->input()
		    ->type('hidden')
		    ->name('payment_no')
		    ->value($value)
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
		$value='';
		if($payment_no->payment_no) $value=$client->firm_name;
		$ui->input()
		    ->type('text')
		    ->label('Firm Name<span style= "color:red;"> *</span>')
		    ->name('firm_name')
		    ->id('firm_name')
			->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value='';
		if($payment_no->payment_no) $value=$client->person_name;
		$ui->input()
		    ->type('text')
		    ->label('Contact Person Name<span style= "color:red;"> *</span>')
		    ->name('contact_person_name')
		    ->id('person_name')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
	$inputRow1->close();
	$inputRow2 = $ui->row()->open();
		$value='';
		if($payment_no->payment_no) $value=$client->designation;
		$ui->input()
		    ->type('text')
		    ->label('Designation<span style= "color:red;"> *</span>')
		    ->name('client_designation')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value='';
		if($payment_no->payment_no) $value=$client->address;
		$ui->textarea()
		    ->label('Address<span style= "color:red;"> *</span>')
            //->placeholder()
            ->name('client_address')
            ->id('address')
            ->value($value)
            ->required()
            ->width(6)
            ->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
		$value='';
		if($payment_no->payment_no) $value=$client->city;
		$ui->input()
		    ->type('text')
		    ->label('City<span style= "color:red;"> *</span>')
		    ->name('client_city')
		    ->id('city')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value='';
		if($payment_no->payment_no) $value=$client->pincode;
		$ui->input()
		    ->type('text')
		    ->label('PIN<span style= "color:red;"> *</span>')
		    ->name('client_pin')
		    ->id('pincode')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();
		$value='';
		if($payment_no->payment_no) $value=$client->contact_no;
		$ui->input()
		    ->type('text')
		    ->label('Phone No<span style= "color:red;"> *</span>')
		    ->name('client_phone_no')
		    ->id('client_phone_no')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value='';
		if($payment_no->payment_no) $value=$client->extn;
		$ui->input()
		    ->type('text')
		    ->label('EXTN<span style= "color:red;"> *</span>')
		    ->name('client_extn')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();

		
	$inputRow4->close();
	$inputRow5 = $ui->row()->open();
		$value='';
		if($payment_no->payment_no) $value=$client->fax;
		$ui->input()
		    ->type('text')
		    ->label('Fax<span style= "color:red;"> *</span>')
		    ->name('client_fax')
		    ->id('client_fax')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value='';
		if($payment_no->payment_no) $value=$client->email;
		$ui->input()
		    ->type('text')
		    ->label('E-mail<span style= "color:red;"> *</span>')
		    ->name('client_email')
		    ->value($value)
		    ->required()
		    ->width(6)
		    //->placeholder()
		    ->show();
		$value=$payment_no->payment_no+1;
    		$ui->input()
    		->label('Payment No.')
		    ->type('text')
		    ->name('payment_no')
		    ->value($value)
		    ->disabled()
		    ->width(6)
		    ->show();
	$inputRow5->close();
	$Client_box->close();


	
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
	if($payment_no->payment_no)
	{
		$inputRow1 = $ui->row()->open();
		$innercol3=$ui->col()->width(12)->open();
      	$inputRow1 = $ui->row()->open();
      	echo '<br>&nbsp;&nbsp;';
      	$js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
      	
      	$ui->button()->icon($ui->icon('refresh'))
                   ->value('Scope Of Work')
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
      
      	$innercol2=$ui->col()->id('filebox')->extras('style="display:none"')->width(12)->open();

        
            $ui->input()
            ->label('Scope of work<span style= "color:red;"> *</span>')
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

	}
	else
	{
		
      
      	
            $ui->input()
            ->label('Scope of work<span style= "color:red;"> *</span>')
              ->type('file')
              ->id('scope_consultancy')
              ->name('scope_consultancy')
              ->required()
              ->width(12)
              ->show();   

      	echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
      	//$innercol2->close();
      	
	}
	
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
				if($payment_no->payment_no && $client->product_development)
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
					if($payment_no->payment_no && $client->process_development)
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
					if($payment_no->payment_no && $client->checking_of_design)
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
					if($payment_no->payment_no && $client->checking_of_analysis)
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
					if($payment_no->payment_no && $client->report_writing)
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
					if($payment_no->payment_no && $client->testing)
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
					if($payment_no->payment_no && $client->hrd)
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
					if($payment_no->payment_no && $client->computation)
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
					if($payment_no->payment_no && $client->advice)
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
					if($payment_no->payment_no && $client->other!='')
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
					
					if($payment_no->payment_no && $client->private_sector)
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
					if($payment_no->payment_no && $client->govt_sector)
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
					if($payment_no->payment_no && $client->public_sector)
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
					if($payment_no->payment_no && $client->funding_agency)
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
					if($payment_no->payment_no && $client->foreign_organisation)
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
					if($payment_no->payment_no && $client->other_client!='')
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
	
	$OAT_box->close();
?>
<center>
<?php
	 $ui->button()
		->value('submit')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();

	$form->close();
	$box->close();
	$column2->close();

	$row->close();
?>