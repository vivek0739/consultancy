<?php
	$ui = new UI();
	$errors=validation_errors();
	?><div id='data_row'>
        
   </div>
	<?
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$inputRow1 = $ui->row()->open();
	 
	
	$column2 = $ui->col()->width(12)->open();
	
	
	
	$column2->close();
    $column1 = $ui->col()->width(1)->open();

	$column1->close();
     $column2 = $ui->col()->width(10)->open();    
   
	$box = $ui->box()
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	//print_r($consultancy_no);
	$form = $ui->form()->action('consultant/consultant_disbursement_sheet/confirmation/'.$consultancy_no.'/'.$sr_no)->extras('enctype="multipart/form-data"')->open();
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
	$ui->callout()
			->uiType("info")
			->desc('Enlc : Photocopies of money receipts. Disbursement sheet, Statement of expenditure, Distribution list of Honoraria to faculty and supporting staff of ISM.
					')
		->show();
	$col2->close();
	$inputRow2->close();
	$tabRow1=$ui->row()->open();

	$innercol2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->tabBox()
					  ->tab("t1", "Details of Receipt",true)
					  ->tab("t2", "Credits and Disbursement")
					  ->tab("t3", "Net Amount")
					  ->tab("t4", "Consultants")
					  ->tab("t5", "Supporting Staffs")

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
									<td width=70%>Total Charges</td>
									<td><?
										$ui->input()
										    ->type('text')
										    //->label(' ')
										    ->name('a_total_charges')
										    ->id('a_total_charges')
										    ->value($form1['total_charge'])
										    ->width(12)
										    ->required()
										    ->show();
									?></td>
								</tr>
								<tr>
									<td width=70%>Services Tax + Educational Cess</td>
									<td><?
										$ui->input()
										    ->type('text')
										    //->label(' ')
										    ->name('a_services_tax')
										    ->id('a_services_tax')
										    ->value($form1['service_tax'])
										    ->width(12)
										    ->required()
										    ->show();
									?></td>
								</tr>
								<tr>
									<td width=70%>Total Amount received</td>
									<td><?
										$ui->input()
										    ->type('text')
										    //->label(' ')
										    ->name('a_total_amount')
										    ->id('a_total_amount')
										    ->value($form1['gross_amount'])
										    ->width(12)
										    ->show();
									?></td>
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
										    //->value()
										    ->width(12)
										    ->show();
									?></td>
								</tr>
								<tr>
									<td width=70%>Balance available for disbursement</td>
									<td><?
									$ui->input()
									    ->type('text')
									    //->label(' ')
									    ->name('a_balance_available')
									    ->id('a_balance_available')
									    //->value()
									    ->width(12)
									    ->show();
									?></td>
								</tr>
								<?
								$table_A->close();
								$innerRow = $ui->row()->open();
									$ui->input()
									    ->type('text')
									    ->label('Receipt No')
									    ->name('a_receipt_no')
									    ->id('a_receipt_no')
									    ->required()
									    ->width(6)
									    ->show();
								
								
							
								$ui->input()
	          						->label('Statement of expenditure')
	            					->type('file')
	            					->name('expenditure_path')
	            					->required()
	            					 ->width(6)
	            					->show();
	            				
								$innerRow->close();
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
								Service Tax + Educational Cess
								</td>
								<td><?
								
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_services_tax')
								    ->id('b_services_tax')
								    ->value($form1['service_tax'])
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Institue Support Charges @ 24.5% of A(1)
								</td>
								<td><?
								$value=24.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_institue_support_charges')
								    ->id('b_institue_support_charges')
								    ->value($value)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Department Devlopment fund @ 3.5% of A(1)
								</td>
								<td><?
								$value=3.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_department_devlopment_fund')
								    ->id('b_department_devlopment_fund')
								    ->value($value)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Professional Devlopment fund @ 3.5% of A(1)
								</td>
								<td><?
								$value=3.5*$total_charge/100;
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_professional_devlopment_fund')
								    ->id('b_professional_devlopment_fund')
								    ->value($value)
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
								    ->value($value)
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
								    ->value($value)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC Development fund
								</td>
								<td><?
								if($form1['type_edc_fund']='pdp')
								$value=$form1['in_house'];
								else
								$value=$form1['other_consultancy'];
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_development_fund')
								    ->id('b_edc_development_fund')
								    ->value($value)
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC Lodging and Boarding charges
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_lodging_boarding')
								    ->id('b_edc_lodging_boarding')
								   ->value($form1['lodging'])
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								EDC Xeroxing Charges
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_edc_xeroxing')
								    ->id('b_edc_xeroxing')
								    //->value()
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
								    //->value()
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Alumni fund Rs.100/- per participant for professional Development Programme
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_alumni_fund')
								    ->id('b_alumni_fund')
								    //->value()
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Equipment Charges(to be credited to Institue fund)
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_equipment_charges')
								    ->id('b_equipment_charges')
								    ->value($form1['equipmental_charge'])
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Other payment to be maid(Please given details) 
								supplier's bill should be sent separately to the accounts section for payment alongwith approval/snaction of the same
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_other_payments')
								    ->id('b_other_payments')
								    ->value()
								    ->width(12)
								    ->show();
								?></td>
								</tr>
								<tr>
								<td width=70%>
								Total Credit
								</td>
								<td><?
								$ui->input()
								    ->type('text')
								    //->label(' ')
								    ->name('b_total_credit')
								    ->id('b_total_credit')
								    //->value()
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
						Balance Available for disbursement(SL No. 5)
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_balance_available')
						    ->id('c_balance_available')
						    //->value()
						    ->width(12)
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Deduct: Total credit(SL No. 19)
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_total_credit')
						    ->id('c_total_credit')
						    //->value()
						    ->width(12)
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Net amount available for disbursement
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_net_amount')
						    ->id('c_net_amount')
						    //->value()
						    ->width(12)
						    //->required()
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Amount to be released as per list attached(Annexure II & III)
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_amount_released')
						    ->id('c_amount_released')
						    //->value()
						    ->width(12)
						    ->required()
						    ->show();
						?></td>
						</tr>
						<tr>
						<td width=70%>
						Net Savings
						</td>
						<td><?
						$ui->input()
						    ->type('text')
						    //->label(' ')
						    ->name('c_net_savings')
						    ->id('c_net_savings')
						    //->value()
						    ->width(12)
						    ->show();
						?></td>
						</tr>
						<tr>
				<?
						$innertable = $ui->table()
											  ->id('innertable')
											  ->bordered()
											  
				?>
							<tr>
								<td width=70%>Distribution of savings:<br>		A. 50% Institute Development Fund</td>
								<td><?$ui->input()->type('text')->name('c_institue_development')->id('c_institue_development')->width(12)->show();?></td>
							</tr>
							<tr>
								<td width=70%>    B. 50% to the Depts' Development Fund of CI & CO-CI(s) with equal share basis)</td>
								<td><?$ui->input()->type('text')->name('c_dept_development')->id('c_dept_development')->width(12)->show();?></td>
							
							</tr>
						</table>
				<?
						$innertable->close();
				?>
						</tr>
				<?
					$table_C->close();
					$C_box->close();
			/*********************TAB 3 CLOSE**********************************/
			$t3->close();
			$t4 = $ui->tabPane()->id("t4")->open();
						
								$ui->callout()
									   ->uiType("info")
									   ->desc('This is certify that the final report has been sent to the client on  '.(date("d-m-y")).'  
					            and a copy has been retained in the Department of '.$department)
									   ->show();
						/*******************************************************/
						/*$D1_box = $ui->box()
									 ->title('D. Details of Disbursement to Consultants')
								     ->solid()	
								  	 ->uiType('primary')
								  	 ->open();*/
						    $row1=$ui->row()->open();
							$col0=$ui->col()->width(6)->open();
							
							$ui->input()->label("Number Of Member")->id('member')->name('member')->placeholder('ex.-10')->addonRight($ui->button()->value('Enter')->id('sub')->uiType('primary'))->show();
							$col0->close();


							$row1->close();
							$row1=$ui->row()->id('test')->open();
							$row1->close();

					     	//$D1_box->close();
						/**********************************************************/
						
			$t4->close();
			$t5 = $ui->tabPane()->id("t5")->open();
			/********************TAB 5 OPEN*********************************/
						$E_box = $ui->box()
								     ->solid()	
								  	 ->uiType('primary')
								  	 ->open();

								$ui->callout()
									   ->uiType("info")
									   ->desc('This is certify that the below-mentioned Consultancy project has been completed and the report /course volume has been submitted to the client on '.(date("d-m-y")))
									   ->show();
					/***************************************************************/
							$row1=$ui->row()->open();
							$col0=$ui->col()->width(6)->open();
							
							$ui->input()->label("Number Of Staff")->id('staff')->name('staff')->placeholder('ex.-10')->addonRight($ui->button()->value('Enter')->id('sub1')->uiType('primary'))->show();
							$col0->close();


							$row1->close();
							$row1=$ui->row()->id('test1')->open();
							$row1->close();
					/****************************************************************/
						$E_box->close();		
			/********************TAB 5 CLOSE*********************************/
			$t5->close();
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