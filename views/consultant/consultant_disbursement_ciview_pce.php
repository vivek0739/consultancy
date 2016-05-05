<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$inputRow1 = $ui->row()->open();
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
		    ->label('CONS')
		    ->name('consultancy_no')
		    ->id('consultancy_no')
		    ->disabled()
		    ->value($disbursement->consultancy_no)
		    ->width(12)
		    ->show();
	$col2->close();
	$consultancy_no = $disbursement->consultancy_no;
	$inputRow2->close();
	$ui->callout()
				   ->uiType("info")
				   ->desc('Enlc : Photocopies of money receipts. Disbursement sheet, Statement of expenditure, Distribution list of Honoraria to faculty and supporting staff of ISM.
				   	')
				   ->show();
	$A_box = $ui->box()
				 ->title('A. Details of Receipt/Payment:')
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
		<td width=70%>
		Total Charges
		</td>
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
		<td width=70%>
		Services Tax + Educational Cess
		</td>
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
		<td width=70%>
		Total Amount received
		</td>
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
		<td width=70%>
		Deduct: Actual expenditure/payment already made(please give details
		<i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $sr_no ?>","<?= $auth_id?>")'></i>
		)
		</td>
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
		<td width=70%>
		Balance available for disbursement
		</td>
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
	$B_box = $ui->box()
				 ->title('B. Credits and Disbursement')
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
		<td width=70%>
		Service Tax + Educational Cess
		</td>
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
		<td width=70%>
		Institue Support Charges @ 24.5% of A(1)
		</td>
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
		<td width=70%>
		Department Devlopment fund @ 3.5% of A(1)
		</td>
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
		<td width=70%>
		Professional Devlopment fund @ 3.5% of A(1)
		</td>
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
		<td width=70%>
		Benevolent fund @ 1.75% of A(1)
		</td>
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
		<td width=70%>
		Central Administrative charges @ 1.75% of A(1)
		</td>
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
		<td width=70%>
		EDC Development fund
		</td>
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
		<td width=70%>
		EDC Lodging and Boarding charges
		</td>
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
		<td width=70%>
		EDC Xeroxing Charges
		</td>
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
		<td width=70%>
		ISM Vehicle Charges
		</td>
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
		<td width=70%>
		Alumni fund Rs.100/- per participant for professional Development Programme
		</td>
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
		<td width=70%>
		Equipment Charges(to be credited to Institue fund)
		</td>
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
		    ->value($disbursement->b_other_payment)
		    ->width(12)
		    ->disabled()
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
		    ->value($disbursement->b_total_credit)
		    ->width(12)
		    ->disabled()
		    ->show();
		?></td>
		</tr>
<?
	$table_B->close();
	$B_box->close();
	$C_box = $ui->box()
				 ->title('C. Net Amount')
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
		<td width=70%>
		Balance Available for disbursement(SL No. 5)
		</td>
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
		<td width=70%>
		Deduct: Total credit(SL No. 19)
		</td>
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
		<td width=70%>
		Net amount available for disbursement
		</td>
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
		<td width=70%>
		Amount to be released as per list attached(Annexure II & III)
		</td>
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
		<td width=70%>
		Net Savings
		</td>
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
/**********************************************************************/
$D_box = $ui->box()
			  ->title('D. Details of Disbursement to Consultants')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$dept;
  	foreach($consultants as $detail1)
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
			foreach($consultants as $var)
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
/***********************************************************************/

	$E_box = $ui->box()
				 ->title('E. Details of Disbursement of Honoraria to Supporting Staff of ISM')
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
            foreach($staffs as $row)
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
	$form = $ui->form()->action('consultant/consultant_disbursement_sheet/disbursement_cancel/'.$disbursement->sr_no)/*->extras('enctype="multipart/form-data"')*/->open();
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
	$form->close();
	$box->close();
	$column2->close();
	$column3 = $ui->col()->width(1)->open();
	$column3->close();
	$inputRow1->close();
?>
<script>
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

      }
</script>