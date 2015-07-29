 <script type="text/javascript">

$(window).load(function(){

     $('.expense_row').hide();
    
     var ci='<?echo $auth_id;?>'
      $('#approve_col').hide();
      $('#reject_col').hide();
      $('#cancel_col').hide();
      $('#forward_col').hide();
     if(ci.trim()=='c_i'||ci.trim()=='ft')
     {
      $('#action_taken5').show();
      $('#action_taken').hide();
      $('#action_taken1').hide();
      $('#action_taken6').hide();
     }
     else if(ci.trim()=='hod')
    {
      $('#action_taken5').hide();
      $('#action_taken').hide();
      $('#action_taken6').show();
      $('#action_taken1').show();
    }
     else if(ci.trim()!='prev')
    {
      $('#action_taken5').hide();
      $('#action_taken').show();
      $('#action_taken1').show();
      $('#action_taken6').hide();
    }

    else
    {

      $('#action_taken5').hide();
      $('#action_taken').hide();
      $('#action_taken1').hide();
      $('#action_taken6').hide();
    }
     $('#action_taken').on('click',function(){
        $('#approve_col').show();
        $('#reject_col').hide();
        $('#cancel_col').hide();
        $('forward_col').hide();
     });
     $('#action_taken1').on('click',function(){
        $('#approve_col').hide();
        $('#reject_col').show();
        $('#cancel_col').hide();
        $('#forward_col').hide();
     });
     $('#action_taken5').on('click',function(){
        $('#approve_col').hide();
        $('#reject_col').hide();
        $('#cancel_col').show();
        $('#forward_col').hide();
     });
      $('#action_taken6').on('click',function(){
        $('#approve_col').hide();
        $('#reject_col').hide();
        $('#cancel_col').hide();
        $('#forward_col').show();
     });
     
      
});

$(document).ready(function(){
    $('#expense_col').click(function(){
        
       $('.expense_row').toggle();
           
     
        
    });

    
});
function myFunction(sr_no,modv) {
        mywindow = window.open("<?php echo base_url() ?>index.php/consultant/consultant/view_action/" + sr_no+ "/" +modv ,'_blank', "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550");
        
      
       
      } 

</script>
<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 19 june 2015
*/

  $ui = new UI();
  $errors=validation_errors();
  if($errors!='')
    $this->notification->drawNotification('Validation Errors',validation_errors(),'error');
  $row = $ui->row()->open();
  $column1 = $ui->col()->width(1)->open();
  $column1->close();
  $string='<i class="fa fa-search"  style="cursor:pointer; color:#fff; align:right;"'
                ." onclick='myFunction("
                .$cons_row->sr_no
                .','
                .$cons_row->modification_value
                .")'"
                .'></i>';
  $column2 = $ui->col()->width(10)->open();
  $form = $ui->form()->action('consultant/consultant/approve_consult_form/'.$cons_row->sr_no.'/'.$auth_id)->extras('enctype="multipart/form-data"')->open();
  $row1=$ui->row()->open();
  $box = $ui->box()
        ->title($string." ".'ESTIMATE FORM ')
        ->solid() 
        ->uiType('primary')
        ->open();
  $row1=$ui->row()->open();
  
      $ui->input()
         ->label('Title<span style= "color:red;"> *</span>')
         ->type('text')
         ->name('consultant_title')
         ->value($cons_row->consultancy_title)
         ->width(6)
         ->disabled()
         ->show();
 
     $ui->input()
        ->label('Type')
        ->type('text')
        ->name('edc_fund')
        ->id('edc_fund')
        ->value($cons_row->type_edc_fund)
        ->width(6)
        ->disabled()
        ->show();
  
  $row1->close();
  $row1=$ui->row()->open();
  
  $innercol2=$ui->col()->width(6)->open();
      echo '<b> Scope of Work </b><br/>';
  
      echo '<a href="'.base_url().'assets/files/consultant/SCOPE_WORK/'.$cons_row->scope_work.'" title=
            "download file" download="'.$cons_row->scope_work.'">'.$cons_row->scope_work.'</a>';
      
  $innercol2->close();
  
  $innercol2=$ui->col()->width(6)->open();
      echo'<b> Request_file from client / Approval letter from director</b><br/>';
         
  
      echo '<a href="'.base_url().'assets/files/consultant/form/'.$cons_row->file_path.'" title=
            "download file" download="'.$cons_row->file_path.'">'.$cons_row->file_path.'</a>';
            echo '<br/><br/>';
  $innercol2->close();
      $ui->input()
         ->type('hidden')
         ->name('sr_no')
         ->required()
         ->value($cons_row->sr_no)
         ->show();
  $box->close();
  
  $detail_box=$ui->box()
          ->title('DETAILS OF THE CONSULTANT-IN-CHARGE')
          ->solid()
          ->uiType('primary')
          ->open();
  $row1=$ui->row()->open();
  $col1=$ui->col()->width(12)->open();
            /*$ui->input()
                 ->label('No. of person<span style= "color:red;"> *</span>')
                   ->type('text')
                   ->name('no_of_persons')
                   ->id("no_of_persons")

                   ->show();*/
                $table=$ui->table()
                  ->hover()
                  ->bordered()
                  ->width(12)
                  ->open()
                ?><thead>
                  <th>Department</th>
                  <th>Employee's Name</th>
                  <th>Employee No.</th>
                  <th>Designation</th>
                  <th>Select Position</th>
                  <th>Tentative Share</th>


                </thead>
               
                <?
                $i=1;
                foreach ($members as $key => $member)
                 {
                  ?><tr>
                  <td>

                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                        ->type('text')
                       ->name('emp_dept'.$i)
                      ->id('emp_dept'.$i)
                      ->value($member->dept)
                      ->disabled()
                      ->show();
                       $innercol1->close();
                  ?></td>
                  <td>
                    <? $r3col1 = $ui->col()->id('employee')->open();
                  $ui->input()
                    ->type('text')
                    ->name('employee_select'.$i)
                    ->id('employee_select'.$i)
                    ->value($member->salutation." ".$member->first_name." ".$member->middle_name." ".$member->last_name)
                      ->disabled()
                    ->show();
                  $r3col1->close();
                  ?></td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('emp_no'.$i)
                     ->id('emp_no'.$i)
                    ->value($member->emp_no)
                    ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->id('des'.$i)
                      ->name('des'.$i)
                      ->value($member->designation)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  
                  <td>
                    <?
                    if($member->position=='ci')
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select'.$i)
                      ->id("position_select".$i)
                      ->value('Consultancy-In-Charge')
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                    }
                    else if($member->position=='coci')
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select'.$i)
                      ->id("position_select".$i)
                      ->value('COCI')
                      ->disabled()
                      ->width(12)
                      ->show();
                      $innercol1->close();
                    }
                    else 
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select'.$i)
                      ->id("position_select".$i)
                      ->value('Faculty Member')
                      ->disabled()
                      ->width(12)
                      ->show();
                     $innercol1->close();
                    }
                    
                       
                  ?></td>
                  
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('share'.$i)
                      ->id("share".$i)
                      ->value($member->share)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  </tr><?
                  
                }
                $table->close();
      $col1->close();
      $row1->close();
  $detail_box->close();
 
  $charge_box=$ui->box()
          ->title('BREAK-UP OF TOTAL CHARGES')
          ->solid()
          ->uiType('primary')
          ->open();
  $row1=$ui->row()->open();
    $col1=$ui->col()->width(12)->open();
            /*$ui->input()
                 ->label('No. of person<span style= "color:red;"> *</span>')
                   ->type('text')
                   ->name('no_of_persons')
                   ->id("no_of_persons")

                   ->show();*/
                $table=$ui->table()
                  ->hover()
                  ->bordered()
                  ->width(12)
                  ->open()
                ?><thead>
                  <th>SECTION.</th>
                  <th>BUDGET HEAD DISCRIPTION</th>
                  <th>TOTAL(Rs.)</th>
                </thead>
                <tr>
                  <td>A</td>
                  <td>INSTITUTE CHARGES </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('institute_charge')
                     ->id('institute_charge')
                      ->value($cons_row->institute_charges)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
                <tr>
                  <td>B</td>
                  <td><a id='expense_col'>EXPENSES </a>
                                </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('expenses')
                      ->id('expenses')
                      ->value($cons_row->expenses)
                      ->disabled()
                      ->width(12)
                      ->show();
                                  
                         $innercol1->close();
                                     ?>
                                  
                  </td>
                              
                </tr>
                          
                         <tr class='expense_row'>
                              <td></td>
                              <td>Expenditure for academic activity like condition of tutorial,practical,field visit e.t.c
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('expenditure')
                                        ->id('expenditure')
                                        ->value($cons_row->expenditure)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td></td>
                              <td><?echo "Salary/Cost of Labour Hanorarium of staf/Outside consultants,Travel,Alumni fund etc"?>
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('salary')
                                        ->id('salary')
                                        ->value($cons_row->salary)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td></td>
                              <td>Lodging and Boarding charges for residential course(Twin Sharing /Single sharing)
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('lodging')
                                        ->id('lodging')
                                        ->value($cons_row->lodging)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td></td>
                              <td>Contigency/Consumables etc
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('contigency')
                                        ->id('contigency')
                                        ->value($cons_row->contigency)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         
                          <tr class='expense_row' >
                              <td> </td>
                              <td>
                                <? $innercol1=$ui->col()->id('edc_fund_pdp1')->width(12)->open();
                                  if($cons_row->type_edc_fund=='pdp')
                                   echo "In-house Executive Development";
                                  else if($cons_row->type_edc_fund=='other_consult')
                                    echo  "Other Consultancy";
                                      $innercol1->close();?>
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->id('edc_fund_pdp')->width(12)->open();
                                  if($cons_row->type_edc_fund=='pdp')
                                   {
                                    $ui->input()
                                        ->type('text')
                                        ->name('in_house_exp')
                                        ->id('in_house_exp')
                                        ->value($cons_row->in_house)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                      }
                                  else if($cons_row->type_edc_fund=='other_consult')
                                    {
                                         $ui->input()
                                        ->type('text')
                                        ->name('other_consultancy')
                                        ->id('other_consultancy')
                                        ->placeholder('1% of (A)')
                                        ->value($cons_row->other_consultancy)
                                        ->width(12)
                                        ->show();
                                    }
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         
                         <tr class='expense_row'>
                              <td></td>
                              <td>Non-Recurring : Equipment,Material etc
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('non_recurring')
                                        ->id('non_recurring')
                                        ->value($cons_row->non_recurring)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td></td>
                              <td>Equipment Charge (to be credited to School Fund)
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('equipment_charge')
                                        ->id('equipment_charge')
                                        ->value($cons_row->equipmental_charge)
                                        ->disabled()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();
                                      ?>
                              </td>   
                             
                         </tr>
                         
                <tr>
                  <td>C</td>
                  <td>CONSULTANCY CHARGE</td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('consultancy_charge')
                ->id('consultancy_charge')
                ->value($cons_row->consultancy_charge)
                ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
                <tr>
                  <td>D</td>
                  <td>TOTAL CHARGES </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('total_charge')
                      ->id('total_charge')
                      ->value($cons_row->total_charge)
                      ->disabled()
                      ->width(12)
                      ->show();
                                        
                       $innercol1->close();?>
                  </td> 
                </tr>
                <tr>
                  <td>E</td>
                  <td>SERVICE TAX </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('service_tax')
                      ->id('service_tax')
                      ->value($cons_row->service_tax)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
                <tr>
                  <td>F</td>
                  <td>GROSS AMOUNT </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('gross_amount')
                     ->id('gross_amount')
                      ->value($cons_row->gross_amount)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
              
              <?
     $table->close();
     $col1->close();
    

    $innerrow1=$ui->col()->noPrint()->width(6)->open();
  $col1=$ui->col()->width(12)->open();
          ?><br/><center>
          <?
          $ui->button()->icon($ui->icon('check'))
             
             ->name('action_taken')
             ->id('action_taken')
             ->value('Approve')
             ->uiType('success')
             ->show();
          ?>
          </center>
          <center>
          <?
          $ui->button()->icon($ui->icon('check'))
             ->name('action_taken')
             ->id('action_taken6')
             ->value('Forward')
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
  
  $col1=$ui->col()->id('forward_col')->width(12)->open();
          ?><center>
          <?
          $ui->textarea()
              ->label('Remark')
              ->id('remark_text4')
              ->name('remark_text4')
              ->placeholder('Not more than 200 character')
              ->value('')
              ->show();
          $ui->button()->icon($ui->icon('check'))
             ->type('submit')
             ->name('action_taken')
             ->id('action_taken3')
             ->value('Are You Sure To Forward')
             ->uiType('success')
             ->show();
          ?>
          </center><?
  $col1->close();
  
  $col1=$ui->col()->width(12)->open();
          
  $col1->close();
  
  
  
  $innerrow1->close();
   $innerrow1=$ui->col()->noPrint()->width(6)->open();
  $col1=$ui->col()->width(12)->open();
          ?><center><br/>
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
  $innerrow1=$ui->col()->noPrint()->width(12)->open();
  $col1=$ui->col()->width(12)->open();
          ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('remove'))
             
             ->name('action_taken')
             ->id('action_taken5')
             ->value('Cancel')
             ->uiType('danger')
             ->show();
          ?>
          </center><br/><?
  $col1->close();
  $col1=$ui->col()->id('cancel_col')->width(12)->open();
         
          $ui->textarea()
              ->label('Remark')
              ->id('remark_text3')
              ->name('remark_text3')
              ->placeholder('Not more than 200 character')
              ->value('')
              ->show();

          $ui->button()->icon($ui->icon('check'))
             ->type('submit')
             ->name('action_taken')
             ->id('action_taken7')
             ->value('Are You Sure To Cancel')
             ->uiType('danger')
             ->show();
         
          
  $col1->close();
  $innerrow1->close();
   $row1->close();
   $row2=$ui->row()->noPrint()->open();
   $col2= $ui->col()->width(6)->open();
           $ui->printButton()->noPrint()
              ->uiType('primary')
              
              ->id('print_button')
              ->show();
    $col2->close();
 $row2->close();
     $charge_box->close();
  
  $row2->close();
     $form->close();

  $column2->close();