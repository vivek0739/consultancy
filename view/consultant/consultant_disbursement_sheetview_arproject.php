<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$inputRow1 = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	$column2 = $ui->col()->width(10)->open();
	foreach ($details as $disbursement)
	{}
	$box = $ui->box()
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();
	$inputRow2 = $ui->row()->open();
	$col1 = $ui->col()->width(6)->open();
	$col1->close();
	$col2 = $ui->col()->width(6)->open();
		$ui->input()
		    ->type('text')
		    ->label('Consultancy No')
		    ->name('consultancy_no')
		    ->id('consultancy_no')
		    ->disabled()
		    ->value($disbursement->consultancy_no)
		    ->width(12)
		    ->show();
	$col2->close();
	$consultancy_no = $disbursement->consultancy_no;
	$ui->callout()
				   ->uiType("info")
				   ->desc('Enlc : Photocopies of money receipts. Disbursement sheet, Statement of expenditure, Distribution list of Honoraria to faculty and supporting staff of ISM.
				   	')
				   ->show();
	$inputRow2->close();
	$form = $ui->form()->action('consultant/consultant_disbursement_sheet/disbursement_approve/'.$consultancy_no.'/'.$sr_no.'/'.$auth_id)->extras('enctype="multipart/form-data"')->open();
	$tabRow1=$ui->row()->open();
		$tabBox1 = $ui->tabBox()
					  ->tab("t1", "Details of Receipt",true)
					  ->tab("t2", "Credits and Disbursement")
					  ->tab("t3", "Net Amount")
					  ->tab("t4", "Consultants")
					  ->tab("t5", "Supporting Staffs")
					  ->tab("t6", "Memo")
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
						    ->show();
						?></td>
						</tr>
				<?
						$table_A->close();

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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
						    ->disabled()
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
								<td><?$ui->input()->type('text')->name('c_institue_development')->id('c_institue_development')->width(12)->disabled()->value($disbursement->c_dist_save1)->show();?></td>
							</tr>
							<tr>
								<td width=70%>    B.50% to the Depts' Development Fund of CI & CO-CI(s) with equal share basis)</td>
								<td><?$ui->input()->type('text')->name('c_dept_development')->id('c_dept_development')->width(12)
								->disabled()->value($disbursement->c_dist_save2)->show();
								?></td>
							
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
							  ->title('Details of Disbursement to Consultants')
							  ->solid()	
							  ->uiType('primary')
							  ->open();

					$dept;
				  	foreach($details2 as $detail1)
				  	{
				    	  if($detail1->position=='ci')
				    	  {
				        	  $dept=$detail1->name;
				      	  }
				  	}
				        $ui->callout()
				           ->uiType("info")
				           ->desc('This is certify that the final report has been sent to the client on  '.(date("d-m-y")).'  
				            and a copy has been retained in the Department of '.$dept)
				           ->show();

				        $table1=$ui->table()
				     	    				->hover()
				     	    				->bordered()
				     	    				->width(12)
				     	    				->open();

				     	    	?><thead>
				     	    		<th>Employee No.</th>
				     	    		<th>Employee's Name</th>
				                	<th>Department</th>
				                    <th>Designation</th>
				     	    		<th>Select Position</th>
				     				<th>Gross Amount</th>
								</thead><?
							foreach($details2 as $var)
							{?>
								<tr>
									<td><? echo $var->emp_no; ?></td>
									<td><? echo $var->first_name.' '.$var->middle_name.' '.$var->last_name ?></td>
									<td> <? echo $var->name ?></td>
				                  
				                  <td><? echo $var->designation; ?></td>
				                  
				                  <td>
				                    <?/******************************/
				                    $position;
				                    if($var->position == 'ci')
				                        $position='Consultant-In-Charge';
				                    else if($var->position == 'coci')
				                        $position='Co-Consultant-In-Charge';
				                    else
				                        $position='Faculty Member';
				                    /**************************************/ 
				                       echo $position;
				                  ?></td>
				                  
				                  <td>
				                    <? echo $var->gross_amt; ?></td>
				                  </tr>
								</tr>
							<?}

				     	$table1->close();
				     	$innerRow11 = $ui->row()->open();
				     	print_r('   ');
				     	$innerRow11->close();
					$D_box->close();
			$t4->close();
			$t5 = $ui->tabPane()->id("t5")->open();
					$E_box = $ui->box()
								 ->title('Details of Disbursement of Honoraria to Supporting Staff of ISM')
							     ->solid()	
							  	 ->uiType('primary')
							  	 ->open();

						$table=$ui->table()
				                  ->hover()
				                  ->bordered()
				                  ->width(12)
				                  ->open()
				                ?><thead>
				                  <?/*<th width=15%>Department</th>*/?>
				                  <th>Employee no.</th>
				                  <th>Employee's Name</th>
				                  <th>Department.</th>
				                  <th>Designation</th>
				                  <th>Position</th>
				                  <th>Amount(Rs)</th>
				                  <th>GAS previous FY</th>
				                  <th>75% GAS previous FY</th>
				                  <th>Total payment FY</th>
				                </thead>
				      <?
				            $i=1;
				            foreach($detail as $row)
				            {
				              ?>
				              <tr>
				                  <td><? echo $row->emp_no ?></td>
				                  <td><? echo $row->first_name.' '.$row->middle_name.' '.$row->last_name ?></td>
				                  <td><? echo $row->name ?></td>
				                  <td><? echo $row->designation ?></td>
				                  <td>
				                    <?/******************************/
				                    $position;
				                    if($row->position == 'ss')
				                        $position='Supporting Staff';
				                    else if($row->position == 'coci')
				                        $position='Co-Consultant-In-Charge';
				                    else
				                        $position='Faculty Member';
				                    /**************************************/ 
				                    echo $position;?>
				              	  </td>
				              	  <td>
				              	  	<?echo $row->amount;?>
				              	  </td>
				              	  <td><? echo $row->gas_previous; ?></td>
				              	  <td><? echo $row->fy_gas_previous; ?></td>
				              	  <td><? echo $row->total_current_fy; ?></td>
				              </tr>

				            <?
				            $i++;
				          }  
				                $table->close();

					$E_box->close();
			$t5->close();
	/****************************************************************************************************/
	foreach($details3 as $memo)
	{}
			$t6 = $ui->tabPane()->id("t6")->open();
				?><h4 align='center'>INDIAN SCHOOL OF MINES, DHANBAD</h4>
				<table width=100%>
					<tr>
						<td width=70%></td>
						<td>
							CONSULTANCY / BILL<br>
							<?
								$ui->input()
				                    ->type('text')
				                    ->name('memo_si_no')
				                    ->id('memo_si_no')
				                    ->label('SI.No')
				                    ->value($memo->sr_no)
				                    //->required()
				                    ->disabled()
				                    ->show();
				                $ui->input()
				                    ->type('text')
				                    ->name('memo_dated')
				                    ->id('memo_dated')
				                    ->label('Dated')
				                    ->value($memo->dated)
				                    //->required()
				                    ->disabled()
				                    ->show();    
							?>
							<br>
							<P>While processing the bill AR (B&P) to check the SI.No. and ensure that earlier consultancy bills have already been processed for payment.</p>
						</td>
					</tr>
				</table>
				<h4 align='center'>OFFICE OF THE PROFESSOR OF CONTINUING EDUCATION<br>
				INDIAN SCHOOL OF MINES, DHANBAD - 826004<br>
				BILL FORWARDING MEMO FOR CONSULTANCY / COURSE ETC.</h4>
				<table width=100%>
					<tr>
						<td width=60%>1. Consultancy No.</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_consultancy_no')
				                    ->id('memo_consultancy_no')
				                    ->value($memo->consultancy_no)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>2. Name of the Client</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_client_name')
				                    ->id('memo_client_name')
				                    ->value($memo->client_name)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>3. Consultancy Incharge Prof./Dr./Shri</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_consultancy_incharge')
				                    ->id('memo_consultancy_incharge')
				                    ->value($memo->consultancy_incharge)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>4. Department of</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_department')
				                    ->id('memo_department')
				                    ->value($memo->department)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>5. Project Team</td>
						<td></td>
					</tr>
					<tr>
						<td width=60%>i)</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_prj_team1')
				                    ->id('memo_prj_team1')
				                    ->value($memo->project_team1)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>ii)</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_prj_team2')
				                    ->id('memo_prj_team2')
				                    ->value($memo->project_team2)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>iii)</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_prj_team3')
				                    ->id('memo_prj_team3')
				                    ->value($memo->project_team3)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>iv)</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_prj_team4')
				                    ->id('memo_prj_team4')
				                    ->value($memo->project_team4)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>6. Actual Period of Work</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_period')
				                    ->id('memo_period')
				                    ->value($memo->work_period)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>7. Date of Submission of final report</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_report')
				                    ->id('memo_report')
				                    ->value($memo->submission_date)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>8. Total Consultancy / Testing Charges Rs.</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_charge')
				                    ->id('memo_charge')
				                    ->value($memo->testing_charge)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>9. Consultancy / Testing Charges Received on</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_charge_received')
				                    ->id('memo_charge_received')
				                    ->value($memo->charge_received_date)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>vide ISM cash receipt No. / Bank Credit</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_bank_credit')
				                    ->id('memo_bank_credit')
				                    ->value($memo->bank_credit)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
					<tr>
						<td width=60%>10. No of pages in the bill including enclosures</td>
						<td><?
							$ui->input()
				                    ->type('text')
				                    ->name('memo_pages')
				                    ->id('memo_pages')
				                    ->value($memo->enclosure)
				                    //->required()
				                    ->disabled()
				                    ->show();
						?></td>
					</tr>
				</table>
				<p>AR(B&P) section may process strictly as per noticed ISM Consultancy / Testing Rules, 
				Guidelines for the C.I. etc. It may be ensured that all pages of bills and cutting, if any, 
				are countersigned by PCE,Any Change made in the bill may be communicated to PCE in order to 
				keep the countersigned by PCE's office corrected and updated. No bill under this consultancy 
				may be accepted unless it is forwarded through and counterigned by PCE.</p>
				<?	
			$t6->close();
	/****************************************************************************************************/		
		$tabBox1->close();
$tabRow1->close();
	
	
	
	
/**********************************************************************/

/***********************************************************************/

	
//$form = $ui->form()->action('')/*->extras('enctype="multipart/form-data"')*/->open();

/*$innerRow = $ui->row()->open();
$col1=$ui->col()->width(5)->open();
$col1->close();
$col2 = $ui->col()->width(1)->open();
		$ui->button()
			->name('approve')
			->id('approve')
			->value('Approve')
	    	->uiType('success')
	    	//->submit()
	    	->extras('onclick=showapprove()')
	    	//->name('mysubmit')
	    	->show();
$col2->close();
	
$col12=$ui->col()->width(1)->open();
		$ui->button()
			->name('reject')
			->id('reject')
			->value('Reject')
	    	->uiType('danger')
	    	//->submit()
	    	->extras('onclick=showremark()')
	    	//->name('')
	    	->show();
$col12->close();
	
$innerRow->close();

$innerRow1 = $ui->row()->id('remark1')->open();
	$form1 = $ui->form()->action('consultant/consultant_disbursement_sheet/disbursement_approve/'.$consultancy_no)/*->extras('enctype="multipart/form-data"')*->open();
	$row1 = $ui->row()->open();
	$col3 = $ui->col()->width(3)->open();
	$col3->close();
	$col4 = $ui->col()->width(6)->open();
	$ui->textarea()
		    ->type('text')
		    //->label(' ')
		    ->name('remark_apv')
		    ->id('remark_apv')
		    ->classes('remark_approve')
		    //->value($disbursement->c_net_saving)
		    ->width(12)
		    ->show();
	$col4->close();
	$row1->close();
	?><center><?
	$ui->button()
		->value('Approve')
	    ->uiType('success')
	    ->submit()
	    ->classes('approve_remark')
	    //->name('mysubmit')
	    ->show();
	 ?></center><?
	$form1->close();
$innerRow1->close();
$innerRow2 = $ui->row()->id('remark2')->open();
	$form2 = $ui->form()->action('consultant/consultant_disbursement_sheet/disbursement_reject/'.$consultancy_no)/*->extras('enctype="multipart/form-data"')*->open();
	$row1 = $ui->row()->open();
	$col3 = $ui->col()->width(3)->open();
	$col3->close();
	$col4 = $ui->col()->width(6)->open();
	$ui->textarea()
		    ->type('text')
		    //->label(' ')
		    ->name('remark')
		    ->id('remark')
		    ->classes('remark_reject')
		    //->value($disbursement->c_net_saving)
		    ->width(12)
		    ->show();
	$col4->close();
	$row1->close();
	?><center><?
	$ui->button()
		->value('reject')
	    ->uiType('danger')
	    ->submit()
	    ->classes('reject_remark')
	    //->name('mysubmit')
	    ->show();
	 ?></center><?
	$form2->close();
$innerRow2->close();*/
$innerRow1=$ui->row()->open();
$col1=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken')
             ->value('Approve')
             ->uiType('success')
             ->extras('onclick=showapprove()')
             ->show();
          ?>
          </center><br/><?
$col1->close();
$col2=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken2')
             ->value('Reject')
             ->uiType('danger')
             ->extras('onclick=showreject()')
             ->show();
          ?>
          </center><br/><?
$col2->close();
$innerRow1->close();
$innerRow2=$ui->row()->open();
$col1=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->textarea()
		    ->type('text')
		    ->placeholder('remark not more than 200 character')
		    ->name('remark_approve')
		    ->id('remark_approve')
		    ->classes('approve_remark')
		    ->width(12)
		    ->show();
          ?>
          </center><br/><?
$col1->close();
$col2=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->textarea()
		    ->type('text')
		    ->placeholder('remark not more than 200 character')
		    ->name('remark_reject')
		    ->id('remark_reject')
		    ->classes('reject_remark')
		    ->width(12)
		    ->show();
          ?>
          </center><br/><?
$col2->close();
$innerRow2->close();
$innerRow3=$ui->row()->open();
$col1=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken3')
             ->value('Are You Sure To Approve')
             ->uiType('success')
             ->classes('approve_submit')
             ->submit()
             ->show();
          ?>
          </center><br/><?
$col1->close();
$col2=$ui->col()->width(6)->open();
 ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken4')
             ->value('Are You Sure To Reject')
             ->uiType('danger')
             ->classes('reject_submit')
             ->submit()
             ->show();
          ?>
          </center><br/><?
	$col2->close();
	$innerRow3->close();

	$form->close();
	$box->close();

	$column2->close();
	$column3 = $ui->col()->width(1)->open();
	$column3->close();
	$inputRow1->close();
?>
<script>
$('.reject_submit').hide();
$('.reject_remark').hide();
$('.approve_submit').hide();
$('.approve_remark').hide();
function showreject()
{
	$('.reject_remark').show();
	$('.reject_submit').show();
	$('.approve_submit').hide();
	$('.approve_remark').hide();			
}
function showapprove()
{
	$('.reject_submit').hide();
	$('.reject_remark').hide();
	$('.approve_submit').show();
	$('.approve_remark').show();		
}
</script>

