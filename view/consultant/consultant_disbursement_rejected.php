<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$inputRow1 = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	$column2 = $ui->col()->width(10)->open();
	$box = $ui->box()
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	foreach($details as $disbursement)
	{}
	$inputRow2 = $ui->row()->open();
	$col1 = $ui->col()->width(6)->open();
	$col1->close();
	$col2 = $ui->col()->width(6)->open();
		$ui->input()
		    ->type('text')
		    ->label('CONS')
		    ->name('consultancy_no')
		    ->id('consultancy_no')
		    ->width(12)
		    ->value($consultancy_no)
		    ->disabled()
		    ->show();
	$col2->close();
	$ui->callout()
				   ->uiType("info")
				   ->desc('Enlc : Photocopies of money receipts. Disbursement sheet, Statement of expenditure, Distribution list of Honoraria to faculty and supporting staff of ISM.
				   	')
				   ->show();
	$inputRow2->close();

	$form = $ui->form()->action('consultant/consultant_disbursement_sheet/resubmit/'.$consultancy_no.'/'.$sr_no)->extras('enctype="multipart/form-data"')->open();
	$tabRow1=$ui->row()->open();
		$tabBox1 = $ui->tabBox()
					  ->tab("t1", "Details of Receipt",true)
					  ->tab("t2", "Credits and Disbursement")
					  ->tab("t3", "Net Amount")
					  ->tab("t4", "Consultants")
					  ->tab("t5", "Supporting Staffs")
					  ->open();
			$t1 = $ui->tabPane()->id("t1")->active()->open();
				$A_box = $ui->box()
						 ->title('Details of Receipt/Payment:')
					     ->solid()	
					  	 ->uiType('primary')
					  	 ->open();
				$table_A = $ui->table()
									  ->id('table_a')
									  ->bordered()
									  ->striped()
									  ->sortable()
									  //->searchable()
									  //->paginated()
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
					    ->value($disbursement->a_total_charge)
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
					    ->value($disbursement->a_services_tax)
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
					    ->value($disbursement->a_total_amt)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Deduct: Actual expenditure/payment already made(please give details)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('a_actual_expenditure')
					    ->id('a_actual_expenditure')
					    ->value($disbursement->a_expenditure)
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
					    ->value($disbursement->a_balance)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
				<?
				$table_A->close();
				$innerRow = $ui->row()->open();
				$col1 = $ui->col()->width(6)->open();
					$ui->input()
				    ->type('text')
				    ->label('Receipt No')
				    ->name('a_receipt_no')
				    ->id('a_receipt_no')
				    ->value($disbursement->receipt_no)
				    ->required()
				    ->width(12)
				    ->show();
				$col1->close();
				$col2 = $ui->col()->width(6)->open();
					$ui->datePicker()
					->name('date')
				    ->label('Date')			
					//->extras(min='date("Y-m-d")')
					->value($disbursement->timestamp)
					->dateFormat('yy-mm-dd')
					//->width(6)
					->show();
				$col2->close();
				$innerRow->close();

			$A_box->close();
			$t1->close();
			$t2 = $ui->tabPane()->id("t2")->open();
				$B_box = $ui->box()
							 ->title('Credits and Disbursement')
						     ->solid()	
						  	 ->uiType('primary')
						  	 ->open();

				$table_B = $ui->table()
										  ->id('table_b')
										  ->bordered()
										  ->striped()
										  ->sortable()
										  //->searchable()
										  //->paginated()
										  ->open();
					?>
					<tr>
					<td width=70%>Service Tax + Educational Cess</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_services_tax')
					    ->id('b_services_tax')
					    ->value($disbursement->b_services_tax)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Institue Support Charges @ 24.5% of A(1)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_institue_support_charges')
					    ->id('b_institue_support_charges')
					    ->value($disbursement->b_institute_charge)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Department Devlopment fund @ 3.5% of A(1)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_department_devlopment_fund')
					    ->id('b_department_devlopment_fund')
					    ->value($disbursement->b_dep_dev)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Professional Devlopment fund @ 3.5% of A(1)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_professional_devlopment_fund')
					    ->id('b_professional_devlopment_fund')
					    ->value($disbursement->b_prof_dev)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Benevolent fund @ 1.75% of A(1)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_benevolent_fund')
					    ->id('b_benevolent_fund')
					    ->value($disbursement->b_benevolent_fund)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Central Administrative charges @ 1.75% of A(1)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_central_administrative_charges')
					    ->id('b_central_administrative_charges')
					    ->value($disbursement->b_central_charge)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>EDC Development fund</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_edc_development_fund')
					    ->id('b_edc_development_fund')
					    ->value($disbursement->b_edc_dev)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>EDC Lodging and Boarding charges</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_edc_lodging_boarding')
					    ->id('b_edc_lodging_boarding')
					    ->value($disbursement->b_edc_lodging)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>EDC Xeroxing Charges</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_edc_xeroxing')
					    ->id('b_edc_xeroxing')
					    ->value($disbursement->b_edc_xerox)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>ISM Vehicle Charges</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_ism_vehicle')
					    ->id('b_ism_vehicle')
					    ->value($disbursement->b_ism_vehicle)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Alumni fund Rs.100/- per participant for professional Development Programme</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_alumni_fund')
					    ->id('b_alumni_fund')
					    ->value($disbursement->b_alumni_fund)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Equipment Charges(to be credited to Institue fund)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_equipment_charges')
					    ->id('b_equipment_charges')
					    ->value($disbursement->b_equip_charge)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Other payment to be maid(Please given details) 
					supplier's bill should be sent separately to the accounts section for payment alongwith approval/snaction of the same</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_other_payments')
					    ->id('b_other_payments')
					    ->value($disbursement->b_other_payment)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Total Credit</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('b_total_credit')
					    ->id('b_total_credit')
					    ->value($disbursement->b_total_credit)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
				<?
				$table_B->close();
				$B_box->close();		
			$t2->close();
			$t3 = $ui->tabPane()->id("t3")->open();
				$C_box = $ui->box()
							 ->title('Net Amount')
						     ->solid()	
						  	 ->uiType('primary')
						  	 ->open();

				$table_C = $ui->table()
										  ->id('table_c')
										  ->bordered()
										  ->striped()
										  ->sortable()
										  //->searchable()
										  //->paginated()
										  ->open();		  	 
					?>
					<tr>
					<td width=70%>Balance Available for disbursement(SL No. 5)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('c_balance_available')
					    ->id('c_balance_available')
					    ->value($disbursement->c_balance)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Deduct: Total credit(SL No. 19)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('c_total_credit')
					    ->id('c_total_credit')
					    ->value($disbursement->c_total_credit)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Net amount available for disbursement</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('c_net_amount')
					    ->id('c_net_amount')
					    ->value($disbursement->c_net_amt)
					    ->width(12)
					    //->required()
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Amount to be released as per list attached(Annexure II & III)</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('c_amount_released')
					    ->id('c_amount_released')
					    ->value($disbursement->c_release_amt)
					    ->width(12)
					    ->required()
					    ->show();
					?></td>
					</tr>
					<tr>
					<td width=70%>Net Savings</td>
					<td><?
					$ui->input()
					    ->type('text')
					    //->label(' ')
					    ->name('c_net_savings')
					    ->id('c_net_savings')
					    ->value($disbursement->c_net_saving)
					    ->width(12)
					    ->show();
					?></td>
					</tr>
					<tr>
					<?
					$innertable = $ui->table()
										  ->id('innertable')
										  ->bordered()
										  ->striped()
										  ->sortable()
										  //->searchable()
										  //->paginated()
										  ->open();
					?>
						<tr>
							<td width=70%>Distribution of savings:<br>		A. 50% Institute Development Fund</td>
							<td><?$ui->input()->type('text')->name('c_institue_development')->id('c_institue_development')->value($disbursement->c_dist_save1)->width(12)->show();?></td>
						</tr>
						<tr>
							<td width=70%>    B.50% to the Depts' Development Fund of CI & CO-CI(s) with equal share basis)</td>
							<td><?$ui->input()->type('text')->name('c_dept_development')->id('c_dept_development')
							->value($disbursement->c_dist_save2)->width(12)->show();?></td>
						
						</tr>
					</table>
					<?
					$innertable->close();
					?>
					</tr>
					<?
				$table_C->close();
				$C_box->close();
			$t3->close();
			$t4 = $ui->tabPane()->id("t4")->open();
				$D_box = $ui->box()
							 ->title('D. Details of Disbursement to Consultants')
						     ->solid()	
						  	 ->uiType('primary')
						  	 ->open();
				
						$ui->callout()
							   ->uiType("info")
							   ->desc('This is certify that the final report has been sent to the client on  '.(date("d-m-y")).'  
			            and a copy has been retained in the Department of '.$department)
							   ->show();
				/*******************************************************/
					$row1=$ui->row()->open();
					$col1=$ui->col()->width(12)->open();
						$table=$ui->table()
			                  ->hover()
			                  ->bordered()
			                  ->width(12)
			                  ->open()
			                ?><thead>
			                  <th>Employee No.</th>
			                  <th>Employee's Name</th>
			                  <th>Department</th>
			                  <th>Select Position</th>
			                  <th>Gross Amount(Rs)</th>
			                </thead>
			                <?
			                foreach($consultants as $row)
			                {?>
			            		<tr>
			            		<td><? echo $row->emp_no ?></td>
			            		<td><? echo $row->first_name.' '.$row->middle_name.' '.$row->last_name ?></td>
			            		<td><? echo $row->name ?></td>
			            		 <td>
			                    <?/******************************/
			                    $position;
			                    if($row->position == 'ci')
			                        $position='Consultant-In-Charge';
			                    else if($row->position == 'coci')
			                        $position='Co-Consultant-In-Charge';
			                    else
			                        $position='Faculty Member';
			                    /**************************************/ 
			                       echo $position;
			                  ?></td>
			            		<td><? echo $row->gross_amt ?></td>
			            		</tr>
			               <? }
			                $table->close();
			     	$col1->close();
			     	$row1->close();
				/**********************************************************/
				$D_box->close();
			$t4->close();
			$t5 = $ui->tabPane()->id("t5")->open();
				$E_box = $ui->box()
							 ->title('E. Details of Disbursement of Honoraria to Supporting Staff of ISM')
						     ->solid()	
						  	 ->uiType('primary')
						  	 ->open();

						$ui->callout()
							   ->uiType("info")
							   ->desc('This is certify that the below-mentioned Consultancy project has been completed and the report /course volume has been submitted to the client on '.(date("d-m-y")))
							   ->show();
			/***************************************************************/
					$row1=$ui->row()->open();
					$col1=$ui->col()->width(12)->open();
						$table=$ui->table()
			                  ->hover()
			                  ->bordered()
			                  ->width(12)
			                  ->open()
			                ?><thead>
			                  <th>Employee No.</th>
			                  <th>Employee's Name</th>
			                  <th>Department</th>
			                  <th>Select Position</th>
			                  <th>Amount(Rs)</th>
			                </thead>
			                <?foreach($staffs as $var)
			                {?>
			                <tr>
			                	<td><? echo $var->emp_no ?></td>
			                	<td><? echo $var->first_name.' '.$var->middle_name.' '.$var->last_name ?></td>
			                	<td><? echo $var->name ?></td>
			                	<td>
			                    <?/******************************/
			                    $position;
			                    if($var->position == 'ss')
			                        $position='Supporting Staff';
			                    else if($var->position == 'coci')
			                        $position='Co-Consultant-In-Charge';
			                    else
			                        $position='Faculty Member';
			                    /**************************************/ 
			                       echo $position;
			                  ?></td>
			                  <td><? echo $var->amount ?></td>
			                </tr>

			                <?}
			                $table->close();
			     	$col1->close();
			     	$row1->close();
			/****************************************************************/
				$E_box->close();
			$t5->close();
		$tabBox1->close();
    $tabRow1->close();	
$row11 = $ui->row()->open();
$col1 = $ui->col()->width(6)->open();
?>
<center>
<?php
	 $ui->button()
		->value('Re Apply')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();
?>
</center>
<?
	$form->close();
	$col1->close();
	$col2 = $ui->col()->width(6)->open();
	$form1 = $ui->form()->action('consultant/consultant_disbursement_sheet/disbursement_cancel/'.$sr_no)/*->extras('enctype="multipart/form-data"')*/->open();
	?><center>
		<?php
	 	$ui->button()
			->value('Cancel')
	    	->uiType('danger')
	    	->submit()
	    	->name('mysubmit')
	    	->show();
	?>
	</center><?
	$form1->close();
	$col2->close();
	$row11->close();
	$box->close();

	$column2->close();
	$column3 = $ui->col()->width(1)->open();
	$column3->close();
	$inputRow1->close();
?>