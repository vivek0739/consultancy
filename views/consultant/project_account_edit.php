<?php
	$ui = new UI();
	$errors=validation_errors();
	?><div id='data_row'>
        
   </div>
	<?
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	foreach ($details as $disbursement)
    {}
	//print_r($details);
	//print_r($detail);
	$inputRow1 = $ui->row()->open();
	$col1=$ui->col()->width(12)->open();

    echo '<span style="color:red"> Last Activity : '.$action_recent->remark.' ('.date('d M Y g:i a',strtotime($action_recent->timestamp)+19800).') </span>';
   $col1->close();
    $column1 = $ui->col()->width(0)->open();
	$column1->close();
    $column2 = $ui->col()->width(12)->open();    
   
	$box = $ui->box()
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	
	$form = $ui->form()->action('consultant/project_account/reconfirmation/'.$sr_no)->extras('enctype="multipart/form-data"')->open();
	$inputRow2 = $ui->row()->open();
	$col1 = $ui->col()->width(6)->open();
	$col1->close();
	$col2 = $ui->col()->width(6)->open();
		$ui->input()
		    ->type('text')
		    ->label('Consultancy No')
		    ->name('consultancy_no')
		    ->id('consultancy_no')
		    ->value($consultancy_no)
		    ->disabled()
		    ->show();
    $col1 = $ui->col()->width(6)->open();
	$ui->input()
		    ->type('hidden')
		    ->name('sr_no')
		    ->id('sr_no')
		    ->width(12)
		    ->value($sr_no)
		    ->show();   
	$col1->close();
	$col2->close();
	$col2 = $ui->col()->width(12)->open();
	// $ui->callout()
	// 		->uiType("info")
	// 		->desc('Enlc : Photocopies of money receipts. Disbursement sheet, Statement of expenditure, Distribution list of Honoraria to faculty and supporting staff of ISM.
	// 				')
	// 	->show();
	$col2->close();
	$inputRow2->close();
	$tabRow1=$ui->row()->open();
	$innercol2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->tabBox()
					  ->tab("t1", "Details of Receipt / Payment",true)
					  ->tab("t2", "Credits & Disbursement")
					  ->tab("t3", "Net Amount Paylable")
					  ->tab("t4", "Calculation Sheet For Course Consultancy/Testing Disbursement")

					  ->open();
			$t1 = $ui->tabPane()->id("t1")->active()->open();
			/*****************************TAB 1 OPEN*************************************************/
			$A_box = $ui->box()
					->solid()	
					->uiType('primary')
					->open();
						
						
				$table_A = $ui->table()
						->id('table_a')
						->bordered()
						->open();
						?>
					<tr>
						<td width=70%>Total Amount received</td>
						<td><?
							$ui->input()
							    ->type('text')
							    //->label(' ')
							    ->name('a_total_amount')
							    ->id('a_total_amount')
							    ->value($disbursement->total_amt)
							    
							    ->width(12)
							    ->show();
						?></td>
					</tr>
					<tr>
							<td width=70%>Services Tax (Including CESS) Cess</td>
							<td><?
								$ui->input()
									->type('text')
									->name('a_services_tax')
									->id('a_services_tax')
									->value($disbursement->service_tax)
									
									->width(12)
									->required()
									->show();
								?>
							</td>
						</tr>
					<tr>
						<td width=70%>Consultancy Fee(A)</td>
							<td><?
								$ui->input()
									->type('text')
									->name('a_total_charges')
									->id('a_total_charges')
									->value($disbursement->total_charge)
									
									->width(12)
									->required()
								    ->show();
								?>
							</td>
						</tr>
						
								
					<tr>
						<td width=70%>Deduct: Actual expenditure/payment already made(details 
							<i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $form1['sr_no'] ?>","<?= $auth_id?>")'></i>
						)
</div>							</td>
						<td><?
							$ui->input()
							    ->type('text')
							    //->label(' ')
							    ->name('a_actual_expenditure')
							    ->id('a_actual_expenditure')
							    ->value($disbursement->expenditure)
							    
							    ->width(12)
							    ->show();
						?></td>
					</tr>
				<tr>
					<td width=70%>Balance</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('a_balance_available')
					    ->id('a_balance_available')
					    ->value($disbursement->balance)
					   
					    ->width(12)
					    ->show();
					?></td>
				</tr>
								<?
								$table_A->close();
								
						$A_box->close();
			/*********************TAB 1 CLOSE******************************************/			
			$t1->close();
			$t2 = $ui->tabPane()->id("t2")->open();
			/*********************TAB 2 OPEN***********************************/
			$total_charge=$form1['total_charge'];
							$B_box = $ui->box()
									     ->solid()	
									  	 ->uiType('primary')
									  	 ->open();

							$table_B = $ui->table()
													  ->id('table_b')
													  ->bordered()
													  
													  ->open();
						?>
								
								<tr>
								<td width=70%>
								Institue Support Charges @ 24.5% of A
								</td>
								<td><?
								$value=24.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_institue_support_charges')
								    ->id('b_institue_support_charges')
								    ->value($disbursement->institute_charge)
								    
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Deptt. Dev. fund @ 3.5% of A(1)+Saving
								</td>
								<td><?
								$value=3.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_department_devlopment_fund')
								    ->id('b_department_devlopment_fund')
								    ->value($disbursement->dep_dev)
								   
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Professional Dev. fund @ 3.5% of A(1)
								</td>
								<td><?
								$value=3.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_professional_devlopment_fund')
								    ->id('b_professional_devlopment_fund')
								    ->value($disbursement->prof_dev)
								    
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Benevolent fund @ 1.75% of A(1)
								</td>
								<td><?
								$value=1.75*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_benevolent_fund')
								    ->id('b_benevolent_fund')
								    ->value($disbursement->benevolent_fund)
								    
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Central Administrative charges @ 1.75% of A(1)
								</td>
								<td><?
								$value=1.75*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_central_administrative_charges')
								    ->id('b_central_administrative_charges')
								    ->value($disbursement->central_charge)
								    
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr >
								<td  width=70%>
									<pre style="border:0px;">Saving to be credited:
	i) 50% of Inst. Dev. Fund

	ii)50% of Department Fund</pre>
								</td>
								<td ><?
								$value=1.75*$total_charge/100;
								
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('saving_inst_dev_fund')
								    ->id('saving_inst_dev_fund')
								    ->value($disbursement->saving_inst_dev_fund)
								    
								    ->width(12)
								    ->show();
								
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('saving_dept_fund')
								    ->id('saving_dept_fund')
								    ->value($disbursement->saving_dept_fund)
								    
								    ->width(12)
								    ->show();

								?></td>
								</tr>
								<tr>
								<td width=70%>
								Income Tax
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_income_tax')
								    ->id('b_income_tax')
								    ->value($disbursement->income_tax)
								    
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC Development fund
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_development_fund')
								    ->id('b_edc_development_fund')
								    ->value($disbursement->edc_dev)
								   
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								ISM Alumni fund Rs.100/- per participant
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_alumni_fund')
								    ->id('b_alumni_fund')
								    ->value($disbursement->alumni_fund)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC Lodging  charges
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_lodging_boarding')
								    ->id('b_edc_lodging_boarding')
								   ->value($disbursement->edc_lodging)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC 4000 Xeroxing Charges
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_xeroxing')
								    ->id('b_edc_xeroxing')
								    ->value($disbursement->edc_xerox)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								ISM Vehicle Charges
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_ism_vehicle')
								    ->id('b_ism_vehicle')
								    ->value($disbursement->ism_vehicle)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								
								
								<tr>
								<td width=70%>
								Others
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_other_payments')
								    ->id('b_other_payments')
								    ->value($disbursement->other_payment)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Grand Total
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_total_credit')
								    ->id('b_total_credit')
								    ->value($disbursement->total_credit)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
						<?
							$table_B->close();
							$B_box->close();		
			/*********************TAB 2 CLOSE************************************/
			$t2->close();
			$t3 = $ui->tabPane()->id("t3")->open();
			/*********************TAB 3 OPEN*********************************/
							$C_box = $ui->box()
							     ->solid()	
							  	 ->uiType('primary')
							  	 ->open();

									$table_C = $ui->table()
											  ->id('table_c')
											  ->bordered()
											  
											  ->open();		  	 
						?>
						<tr>
						<td width=70%>
						Balance Amount Available for disbursement
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_balance_available')
						    ->id('c_balance_available')
						    ->value($disbursement->balance)
						    ->width(12)
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Total credit as per (B) above
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_total_credit')
						    ->id('c_total_credit')
						    ->value($disbursement->total_credit)
						    ->width(12)
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Net amount to pay
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_net_amount')
						    ->id('c_net_amount')
						    ->value($disbursement->net_amt)
						    ->width(12)
						    //->required()
						    ->show();
						?></td>
						</tr>
						
				<?
					$table_C->close();
					$C_box->close();
			/*********************TAB 3 CLOSE**********************************/
			$t3->close();
			$t4 = $ui->tabPane()->id("t4")->open();
						
								 $table1=$ui->table()->bordered()
				     	    				->width(10)
				     	    				->open();

				     	    	?><thead>
				     	    		<th>Sl.No.</th>
				     	    		<th>Employee No.</th>
				     	    		<th>Employee's Name</th>
				                	<th>Department</th>
				     	    		<th>Bank A/C. No.</th>
				     	    		<th>Gross Amount</th>
				     				<th>Income Tax</th>
				     				<th>Net Amount Paylable</th>
								</thead><?
							$i=1;
							foreach($detail as $var)
							{?>

								<tr>
									<td><? echo $i;  ?></td>
									<td><? echo $var->emp_no; ?>
									<? $innercol1=$ui->col()->width(12)->open();
					                    $ui->input()
					                      ->type('hidden')
					                      ->name('emp_no'.$i)
					                      ->id('emp_no'.$i)
					                      ->value($var->emp_no)

					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
									<td><? echo $var->first_name.' '.$var->middle_name.' '.$var->last_name ?></td>
									<td> <? echo $var->name ?></td>
									
				                  
				                  <td>
					                    <? $innercol1=$ui->col()->width(12)->open();
					                    $ui->input()
					                      ->type('text')
					                      ->name('account_no'.$i)
					                      ->id('account_no'.$i)
					                      ->value($var->bank_accno)
					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
				                  
				                  
				                  
				                  <td>
				                    <? $innercol1=$ui->col()->width(12)->open();
					                    $ui->input()
					                      ->type('text')
					                      ->name('gross_amt'.$i)
					                      ->id('gross_amt'.$i)
					                      ->value($var->gross_amt)
					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
				                  
				                   <td>
					                    <? $innercol1=$ui->col()->width(12)->open();
					                    $ui->input()
					                      ->type('text')
					                      ->name('income_tax_m'.$i)
					                      ->id('income_tax_m'.$i)
					                      ->value($var->income_tax)
					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
					                  <td>
					                    <? $innercol1=$ui->col()->width(12)->open();
					                    $ui->input()
					                      ->type('text')
					                      ->name('amount_paylable'.$i)
					                      ->id('amount_paylable'.$i)
					                      ->value($var->amount_paylable)
					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
								</tr>
							<? $i++;}
							

				     	$table1->close();
				     	$innercol1=$ui->col()->width(12)->open();
					    $ui->input()
	                      ->type('hidden')
	                      ->name('total_emp')
	                      ->id('total_emp')
	                      ->value($i)

	                      ->width(12)
	                      ->show();
					                      
					    $ui->input()
                           ->type('text')
                           ->name('modification_value')
                           //->required()
                           ->value($disbursement->modification_value)
                           ->show();
				     	$innerRow11 = $ui->row()->open();
				     	print_r('   ');
				     	$innerRow11->close();

					     	//$D1_box->close();
						/**********************************************************/
						
			$t4->close();
			
		$tabBox1->close();
		$innercol2->close();
	$tabRow1->close();
	
?>
<center>
<?php
	 $ui->button()
		->value(' submit ')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();
?>
</center>
<?
	$form->close();
	$box->close();

	$column2->close();
	$column3 = $ui->col()->width(1)->open();
	$column3->close();
	$inputRow1->close();
?>
<script type="text/javascript">

function myFunction2(sr_no,auth_id) {
	
        $.ajax({
                url : site_url("consultant/consultant_ajax/view_modal/" + sr_no+ "/" +auth_id),
                success : function(result){
                    if(result.length != false){
                       //alert(result);
                       $dRow = $('#data_row');
                        $dRow.html(result);
                    }
                },
                error : function(){
                    alert('some thing went wrong. please report');
                }
            });
       
      } 

$('#sub').on('click',function(){

	//alert('HII');
	var member=$('#member').val();
	var sr_no=$('#sr_no').val();
	//alert(sr_no);


	$.ajax({
		type : "POST",
		url : site_url("consultant/consultant_disbursement_sheet/from_consultant_view/" + sr_no),
		data : {
			'member' : member
			//'sr_no' : sr_no
		},
		success: function(result)
		{
			$('#test').html(result);
		}
	});
});

$('#sub1').on('click',function(){

	//alert('HII');
	var staff=$('#staff').val();
	var sr_no=$('#sr_no').val();
	//alert(sr_no);


	$.ajax({
		type : "POST",
		url : site_url("consultant/consultant_disbursement_sheet/from_consultant_staff_view/" + sr_no),
		data : {
			'staff' : staff
			//'sr_no' : sr_no
		},
		success: function(result)
		{
			$('#test1').html(result);
		}
	});
});

</script>