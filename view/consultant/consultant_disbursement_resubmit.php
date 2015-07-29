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
    //print_r($consultancy_no);
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
    $form = $ui->form()->action('consultant/consultant_disbursement_sheet/confirmation/'.$consultancy_no.'/'.$sr_no)->extras('enctype="multipart/form-data"')->open();
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
                        ->value('')
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
                        ->value('')
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
                        ->value('')
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
                    $col1 = $ui->col()->width(6)->open();
                        $ui->input()
                        ->type('text')
                        ->label('Receipt No')
                        ->name('a_receipt_no')
                        ->id('a_receipt_no')
                        ->required()
                        ->width(12)
                        ->show();
                    $col1->close();
                    $col2 = $ui->col()->width(6)->open();
                        $ui->datePicker()
                        ->name('date')
                        ->label('Date')         
                        //->extras(min='date("Y-m-d")')
                        ->value(date("yy-mm-dd"))
                        ->dateFormat('yy-mm-dd')
                        //->width(6)
                        ->show();
                    $col2->close();
                    $innerRow->close();
                    $innerRow1 = $ui->row()->open();
                                $column1 = $ui->col()->width(6)->open();
                                $ui->input()
                                    ->label('Money Receipt')
                                    ->type('file')
                                    ->name('receipt_path')
                                    ->required()
                                    ->show();
                                $column1->close();
                                $column2 = $ui->col()->width(6)->open();
                                $ui->input()
                                    ->label('Statement of expenditure')
                                    ->type('file')
                                    ->name('expenditure_path')
                                    ->required()
                                    ->show();
                                $column2->close();
                                $innerRow1->close();

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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                        //->value()
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
                                          ->striped()
                                          ->sortable()
                                          //->searchable()
                                          //->paginated()
                                          ->open();
                    ?>
                        <tr>
                            <td width=70%>Distribution of savings:<br>      A. 50% Institute Development Fund</td>
                            <td><?$ui->input()->type('text')->name('c_institue_development')->id('c_institue_development')->width(12)->show();?></td>
                        </tr>
                        <tr>
                            <td width=70%>    B.50% to the Depts' Development Fund of CI & CO-CI(s) with equal share basis)</td>
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
                              <th>Department</th>
                              <th>Employee's Name</th>
                              <th>Employee No.</th>
                              
                              <th>Select Position</th>
                              <th>Gross Amount(Rs)</th>


                            </thead>
                            <tr>
                              <td>

                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('emp_dept1')
                                  ->id('emp_dept1')
                                  ->value($department)
                                  ->disabled()
                                        ->show();
                                  $ui->input()
                                  ->type('hidden')
                                  ->name('emp_dept1')
                                  ->id('emp_dept1')
                                  ->required()
                                  ->value($dept_id)
                                  
                                        ->show();
                                  
                   
                                   $innercol1->close();
                              ?></td>
                              <td>
                                <? $r3col1 = $ui->col()->id('employee')->open();
                              $ui->input()
                                ->type('text')
                                ->name('employee_select1')
                                ->id('employee_select1')
                                ->value($emp_name)
                                ->disabled()
                                ->show();
                              $ui->input()
                                ->type('hidden')
                                ->name('employee_select1')
                                ->id('employee_select1')
                                ->value($emp_name)
                                ->required()
                                
                                ->show();
                              $r3col1->close();
                              ?></td>
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('emp_no1')
                              ->id('emp_no1')
                              ->value($emp_no)
                              ->disabled()
                                  ->width(12)
                                  ->show();
                                  $ui->input()
                                  ->type('hidden')
                                  ->name('emp_no1')
                              ->id('emp_no1')
                              ->value($emp_no)
                              ->required()
                                  
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                               
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('position_select1')
                                  ->id("position_select1")
                                  ->value('Consultanct-In-Charge')
                                  ->disabled()
                                    ->show();
                                     $ui->input()
                                  ->type('hidden')
                                  ->name('position_select1')
                                  ->id("position_select1")
                                  ->value('ci')
                                  ->required()
                                    ->show();
                                   $innercol1->close();
                              ?></td>
                              
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('gross_amt1')
                                  ->id("gross_amt1")
                                  ->width(12)
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                              </tr><?
                              for($i=2;$i<=10;$i++)
                            {
                              
                              ?><tr>
                              <td>

                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->select()
                            ->name('emp_dept'.$i)
                            ->id('emp_dept'.$i)
                            ->options(array($ui->option()->value('0')->text('Select Employee Department')->disabled()->selected()))
                                        ->show();
                                   $innercol1->close();
                              ?></td>
                              <td>
                                <? $r3col1 = $ui->col()->id('employee')->open();
                              $ui->select()
                                ->name('employee_select'.$i)
                                ->id('employee_select'.$i)
                                ->options(array($ui->option()->value('0')->text('Select Employee')->disabled()->selected()))
                                ->show();
                              $r3col1->close();
                              ?></td>
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('emp_no'.$i)
                              ->id('emp_no'.$i)
                              ->value('')
                                  ->width(12)
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                               
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->select()
                                  ->name('position_select'.$i)
                                  ->id("position_select".$i)
                                  ->options(array(
                                      $ui->option()->value('coci')->text('Co-consultant-in-charge'),
                                      $ui->option()->value('ftm')->text('Faculty Member')->selected()))
                            
                                //->required()
                                    ->show();
                                   $innercol1->close();
                              ?></td>
                              
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('gross_amt'.$i)
                                  ->id("gross_amt".$i)
                                  ->width(12)
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                              </tr><?
                              
                            }
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
                              <th>Department</th>
                              <th>Employee's Name</th>
                              <th>Employee No.</th>
                              
                              <th>Select Position</th>
                              <th>Amount(Rs)</th>


                            </thead>
                            <?
                              for($i=1;$i<=10;$i++)
                            {
                              
                              ?><tr>
                              <td>

                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->select()
                            ->name('e_emp_dept'.$i)
                            ->id('e_emp_dept'.$i)
                            ->options(array($ui->option()->value('0')->text('Select Employee Department')->disabled()->selected()))
                                        ->show();
                                   $innercol1->close();
                              ?></td>
                              <td>
                                <? $r3col1 = $ui->col()->id('employee')->open();
                              $ui->select()
                                ->name('e_employee_select'.$i)
                                ->id('e_employee_select'.$i)
                                ->options(array($ui->option()->value('0')->text('Select Employee')->disabled()->selected()))
                                ->show();
                              $r3col1->close();
                              ?></td>
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('e_emp_no'.$i)
                              ->id('e_emp_no'.$i)
                              ->value('')
                                  ->width(12)
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                              
                              
                              
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->select()
                                  ->name('e_position_select'.$i)
                                  ->id("e_position_select".$i)
                                  ->options(array(
                                      $ui->option()->value('ss')->text('Supporting Staff'),
                                      $ui->option()->value('ftm')->text('Faculty Member')->selected()))
                            
                                //->required()
                                    ->show();
                                   $innercol1->close();
                              ?></td>
                              
                              <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                  ->type('text')
                                  ->name('e_amt'.$i)
                                  ->id("w_amt".$i)
                                  ->width(12)
                                  ->show();
                                   $innercol1->close();
                              ?></td>
                              </tr><?
                              
                            }
                            $table->close();
                    $col1->close();
                    $row1->close();
            /****************************************************************/
                $E_box->close();
            $t5->close();
        $tabBox1->close();
$tabRow1->close();
    
    
    
    
    
    $innerRow1=$ui->row()->open();
    $column1=$ui->col()->width(6)->open();
                ?>
                <center><br/>
                <?php
                     $ui->button()
                        ->value(' submit ')
                        ->uiType('primary')
                        ->submit()
                        ->name('mysubmit')
                        ->show();
                ?>
                </center><br/>
                <?
        $form->close();
    $column1->close();
    $column2=$ui->col()->width(6)->open();
         ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('rejected_form')
             ->value('Rejected Form')
             ->uiType('danger')
             ->extras("onclick='new_pop_window(".$sr_no.")'")
             ->show();
          ?>
          </center><br/><?
    $column2->close();
    $innerRow1->close();
    $box->close();

    $column2->close();
    $column3 = $ui->col()->width(1)->open();
    $column3->close();
    $inputRow1->close();
?><script>

function new_pop_window(sr_no)
{
    //window.alert("http://www.w3schools.com");
    window.open("<?php echo base_url() ?>index.php/consultant/consultant_disbursement_sheet/ciview_pce/"+sr_no);
}
</script>