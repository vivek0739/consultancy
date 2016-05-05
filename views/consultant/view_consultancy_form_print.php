<?php $ui=new UI();
if($cons_row->type_edc_fund=='pdp')
	$type_of_form="SHORT COURSE";
else
	$type_of_form="CONSULTANCY";

	
	

?>

<style>
body{ font-size: 13px; }
h2{ font:16px; font-weight:bold;}
table{ width:100%;}
.form-control{ width:50px;}
</style>
<table border="0">
  <tr>
    <td align="center"><div style="font-size:18px; font-weight:bold;">INDIAN SCHOOL OF MINES DHANBAD - 826004</div></td>
  </tr>
 </table>
<table border="0">
  <tr>
    <td width="32%">&nbsp;</td>
    <td width="39%" align="center" style="text-decoration:underline; font-weight:bold;">Consultancy Form</td>
    <td width="29%" align="right"> Dated <span class="col-sm-8 invoice-col"><?php echo date('d M Y',strtotime($cons_row->timestamp)); ?></span></td>
  </tr>
</table>
<br/><br/>
<table border="0">
  <tr>
    <td ><span class="col-sm-4 invoice-col" style="background:#F4F4F4;"><strong>Title </strong></span></td>
    <td ><span class="col-sm-8 invoice-col"><span style="text-transform:capitalize;"><?php echo $cons_row->consultancy_title; ?></span> </td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td><span class="col-sm-4 invoice-col"><strong>Type </strong></span></td>
    <td><span class="col-sm-8 invoice-col"><?php echo $type_of_form; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<br/><br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">DETAIL OF CONSULTANCY INCHARGE<br/></div></td>
  </tr>
</table>
<table border="2">
	<tr>
                  <th width = "20%"><b>Department</b></th>
                  <th width = "20%">Employee's Name</th>
                  <th width = "20%">Employee No.</th>
                  <th width = "20%">Designation</th>
                  <th width = "20%"> Position</th>
                  <th width = "20%">Tentative Share</th>


     </tr>
               
                <?
                $i=1;
                foreach ($members as $key => $member)
                 {
                  ?><tr>
                  <td width = "20%"> <? echo $member->dept;?></td>
                  <td width = "20%"> <? echo $member->salutation." ".$member->first_name." ".$member->middle_name." ".$member->last_name;
                  ?></td>
                  <td width = "20%"><? echo $member->emp_no; ?></td>
                  
                  <td width = "20%"> <? echo $member->designation;?></td>
                  
                  <td width = "20%"> <? echo $member->position; ?></td>
                  
                  <td width = "20%"><? echo $member->share; ?></td>
                  </tr><?
                  
                }?>
  
</table>
<br/><br/>
<table border="0">
  <tr>
    <td ><div style="font-size:16px; font-weight:bold; background:#ccc; padding:4px;">BREAK-UP OF TOTAL CHARGES<br/></div></td>
  </tr>
</table>
<table border="2">
<tr>
                  <th width = "10%" >SECTION.</th>
                  <th width = "70%">BUDGET HEAD DISCRIPTION</th>
                  <th width = "20%">TOTAL(Rs.)</th>
 </tr>
                <tr>
                  <td>A</td>
                  <td>INSTITUTE CHARGES </td>
                  <td>
                    <? echo $cons_row->institute_charges;?>
                  </td> 
                </tr>
                <tr>
                  <td>B</td>
                  <td><a id='expense_col'>EXPENSES </a>
                                </td>
                  <td>
                    <? echo $cons_row->expenses;
                                     ?>
                                  
                  </td>
                              
                </tr>
                          
                         <tr class='expense_row'>
                              <td>B i)</td>
                              <td>Expenditure for academic activity like condition of tutorial,practical,field visit e.t.c
                                </td>
                              <td>
                                   <? echo $cons_row->expenditure;?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td>B ii)</td>
                              <td><?echo "Salary/Cost of Labour Hanorarium of staf/Outside consultants,Travel,Alumni fund etc"?>
                                </td>
                              <td>
                                   <? echo $cons_row->salary;?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td>B iii)</td>
                              <td>Lodging and Boarding charges for residential course(Twin Sharing /Single sharing)
                                </td>
                              <td>
                                   <? echo $cons_row->lodging;?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td>B iv)</td>
                              <td>Contigency/Consumables etc
                                </td>
                              <td>
                                   <? echo $cons_row->contigency;?>
                              </td>     
                         </tr>
                         
                          <tr class='expense_row' >
                              <td>B v)</td>
                              <td>
                                <? 
                                  if($cons_row->type_edc_fund=='pdp')
                                   echo "In-house Executive Development";
                                  else if($cons_row->type_edc_fund=='other_consult')
                                    echo  "Other Consultancy";?>
                                </td>
                              <td>
                                   <? 
                                  if($cons_row->type_edc_fund=='pdp')
                                   {
                                     echo $cons_row->in_house;
                                   }
                                  else if($cons_row->type_edc_fund=='other_consult')
                                    {
                                         echo $cons_row->other_consultancy;
                                    }
                                  ;?>
                              </td>     
                         </tr>
                         
                         <tr class='expense_row'>
                              <td>B vi)</td>
                              <td>Non-Recurring : Equipment,Material etc
                                </td>
                              <td>
                                   <? echo $cons_row->non_recurring;?>
                              </td>     
                         </tr>
                         <tr class='expense_row'>
                              <td>B vii)</td>
                              <td>Equipment Charge (to be credited to School Fund)
                                </td>
                              <td>
                                   <? echo $cons_row->equipmental_charge;
                                      ?>
                              </td>   
                             
                         </tr>
                         
                <tr>
                  <td>C</td>
                  <td>CONSULTANCY CHARGE</td>
                  <td>
                    <? echo $cons_row->consultancy_charge;?>
                  </td> 
                </tr>
                <tr>
                  <td>D</td>
                  <td>TOTAL CHARGES </td>
                  <td>
                    <? echo $cons_row->total_charge;?>
                    
                  </td> 
                </tr>
                <tr>
                  <td>E</td>
                  <td>SERVICE TAX </td>
                  <td>
                    <? echo $cons_row->service_tax;?>
                  </td> 
                </tr>
                <tr>
                  <td>F</td>
                  <td>GROSS AMOUNT </td>
                  <td>
                    <? echo $cons_row->gross_amount;?>
                  </td> 
                </tr>
</table>