<script type="text/javascript">
$(window).load(function(){
var sr_no=<?echo $cons_row->sr_no;?>;
$.ajax({
                type : "POST",
                url : site_url("consultant/consultant_ajax/show_member/"),
                data : {
                    'sr_no' : sr_no,
                   },
                 success : function(result){
                   $('#emp_row').html(result);
                },
                error : function(){
                    alert('some thing went wrong. please report');
                  }
});

var fund='<?echo $cons_row->type_edc_fund;?>'
     $('.expense_row').hide();
     if(fund.trim()=='pdp')
     {
         $('#edc_fund_consult').hide();
          $('#edc_fund_consult1').hide();
     }
     else if(fund.trim()=='other_consult')
    {
       $('#edc_fund_pdp').hide();
     
      $('#edc_fund_pdp1').hide();
     
    }
    else
    {

      $('#edc_fund_pdp').hide();
      $('#edc_fund_consult').hide();
      $('#edc_fund_consult1').hide();
      $('#edc_fund_pdp1').hide();
    }
    
});

$(document).ready(function(){
    $('#expense_col').click(function(){
        
       $('.expense_row').toggle();
           
     
        
    });

     $('#edc_fund').on('change',function(){ 
      if(this.value=='pdp')
      {
        $('#edc_fund_pdp1').show();
        $('#edc_fund_pdp').show();
        $('#edc_fund_consult').hide();
        $('#edc_fund_consult1').hide();
      }
      else if(this.value=='other_consult')
      {
        $('#edc_fund_pdp1').hide();
        $('#edc_fund_pdp').hide();
        $('#edc_fund_consult').show();
        $('#edc_fund_consult1').show();
      }
    });
    
    $('#gross_amount').on('keyup',function(){
          var f=this.value;
          var d=f/(1.14);
          var e=f-d;
          var a=d*.35;
          var bva=a*.1;
          var bvb=a*.01;
          $('#total_charge').val(d);
          $('#service_tax').val(e);
          $('#institute_charge').val(a);
          $('#in_house_exp').val(bva);
          $('#other_consultancy').val(bvb);
          
    });
    $('#consultancy_charge').on('keyup',function(){
          var f=$('#gross_amount').val();
          var c=this.value;
          var a= $('#institute_charge').val();
          var d= $('#total_charge').val();
          if(f!='')
          {
               var b=d-a-c;
               $('#expenses').val(b);
          }

    });
    var no_mem='<? echo $no_of_member; ?>';
    no_mem=no_mem-1;
           $.ajax({
                      url: site_url("ajax/department/"),
                      success: function(result){
                        for(i=2;i<=4;i++){
                          var id="#emp_dept"+i;
                          var user_id="#employee_select"+i;

                          $(id).append(result);
                          if(i<=no_mem)
                          {
                            var dept='';
                            var user='';

                            if(i==2)
                            {
                              dept='<? if($no_of_member>2) echo $deptm[2]; ?>';
                               user='<? if($no_of_member>2) echo $user[2]; ?>';
                            }
                            else if(i==3)
                            {
                                dept='<? if($no_of_member>3) echo $deptm[3]; ?>';
                                user='<? if($no_of_member>3)echo $user[3]; ?>';
                            }
                             else
                            {
                               dept='<? if($no_of_member>4) echo $deptm[4]; ?>';
                                user='<? if($no_of_member>4) echo $user[4]; ?>';
                            }
                            $(id).val(dept);
                            onclick_empname(i,user);
                            var emp="#emp_no"+i;
                            $(emp).val(user);
                            designation2(i,user);
                          }
                          
                        }
                          
                        
                      }
                    });

for(i=2;i<=4;i++){
  var position='';
  var share='';
  if(i<=no_mem)
  {
  if(i==2)
   {
     position='<? if($no_of_member>2) echo $position[2]; ?>';
     share='<? if($no_of_member>2) echo $share[2]; ?>';

    }
    else if(i==3)
   {
     position='<? if($no_of_member>3) echo $position[3]; ?>';
     share='<? if($no_of_member>3) echo $share[3]; ?>';
     
    }
     else
       {
     position='<? if($no_of_member>4) echo $position[4]; ?>';
     share='<? if($no_of_member>4) echo $share[4]; ?>';
    }
    
    var post="#position_select"+i;
    $(post).val(position);
    var shar="#share"+i;
   $(shar).val(share);
 }
}
    
});
function onclick_empname(table_id,user)
  {

    document.getElementById('employee').style.display="inherit";
    var emp_name=document.getElementById('employee_select'+table_id);

    var dept=document.getElementById('emp_dept'+table_id).value;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          emp_name.innerHTML = xmlhttp.responseText;
        }
      }
    xmlhttp.open("POST",site_url("consultant/consultant_ajax/empNameByDept/"+dept+'/'+user),true);
    xmlhttp.send();
    emp_name.innerHTML = "<i class=\"loading\"></i>";
  }
  function designation2(table_id,user)
  {
    var des_name=document.getElementById('des'+table_id);

    $.ajax({
                      url: site_url("consultant/consultant/designation/"+user),
                      success: function(result){
                       
                          des_name.value=result;
                        }
                          
                        
                      
                    });
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
	
	$column2 = $ui->col()->width(10)->open();
     $form = $ui->form()
     ->action('consultant/edit_consultancy_form/submit_edited_consult_form/'.$cons_row->sr_no)
     ->extras('enctype="multipart/form-data"')
     ->id('form_submit')
     ->open();
	 
  $row1=$ui->row()->open();
  $ui->callout()
           ->uiType("info")
           ->desc("No deduction will be made from the budget head except applicable income tax.")->show();
           
	$box = $ui->box()
			  ->title('ESTIMATE FORM ')
			  ->solid()	
			  ->uiType('primary')
			  ->open();
	
		$row1=$ui->row()->open();
		$innercol1=$ui->col()->width(6)->open();
			$ui->input()
			   ->label('Title<span style= "color:red;"> *</span>')
			   ->type('text')
			   ->name('consultant_title')
			   ->required()
			  ->value($cons_row->consultancy_title)
			   ->show();
			
     	 
     	$innercol1->close();
      
      $innercol1=$ui->col()->width(6)->open();
      
                if($cons_row->type_edc_fund=='pdp')
                {
                     $ui->select()
                                      ->label('Type')
                                        ->name('edc_fund')
                                        ->id('edc_fund')
                                        ->options(array($ui->option()->value('pdp')->text('SHORT COURSE')->selected(),
                                                            $ui->option()->value('other_consult')->text('CONSULTANCY')))
                                   
                                        ->required()
                                      
                                       ->show();
                }
                else if($cons_row->type_edc_fund=='other_consult')
                {
                     $ui->select()
                                      ->label('Type')
                                        ->name('edc_fund')
                                        ->id('edc_fund')
                                        ->options(array($ui->option()->value('pdp')->text('SHORT COURSE'),
                                                            $ui->option()->value('other_consult')->text('CONSULTANCY')->selected()))
                                   
                                        ->required()
                                      
                                       ->show();
                }
                else
                {
                 $ui->select()
                                      ->label('Type')
                                        ->name('edc_fund')
                                        ->id('edc_fund')
                                        ->options(array($ui->option()->value('0')->text('Select Option')->selected()->disabled(),
                                                            $ui->option()->value('pdp')->text('SHORT COURSE'),
                                                            $ui->option()->value('other_consult')->text('CONSULTANCY')))
                                   
                                        ->required()
                                      
                                       ->show();
                }
                                  
                                        
                                  
         $innercol1->close();
    
       

         /*scope file*/
      $innercol3=$ui->col()->width(6)->open();
      $coll=$ui->col()->width(8)->open();
      echo '<br>&nbsp;&nbsp;<a href="'.base_url().'assets/files/consultant/SCOPE_WORK/'.$cons_row->scope_work.'" title=
            "download file" download="'.$cons_row->scope_work.'">'.$cons_row->scope_work.'</a>';
      $coll->close();
      $colll=$ui->col()->width(4)->open();
      $js = 'onclick="javascript:document.getElementById(\'filebox1\').style.display=\'block\';"';
      echo "&nbsp;<div  align='right'>";
      $ui->button()->icon($ui->icon('refresh'))
                   ->value('Scope Of Work')
                   ->uiType('primary')
                   ->extras($js)
                   //->submit()
                   ->show();
      echo "</div><br/>";

      $colll->close();
      $innercol2=$ui->col()->id('filebox1')->extras('style="display:none"')->width(12)->open();

        
            $ui->input()
            ->label('Scope of work<span style= "color:red;"> *</span>')
              ->type('file')
              ->id('work_scope')
              ->name('work_scope')
              //->required()
              ->width(12)
              ->show();   

      echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
      $innercol2->close();
      $innercol3->close();
         /***/
      $innercol3=$ui->col()->width(6)->open();
      $coll=$ui->col()->width(8)->open();
      echo '<br>&nbsp;&nbsp;<a href="'.base_url().'assets/files/consultant/form/'.$cons_row->file_path.'" title=
            "download file" download="'.$cons_row->file_path.'">'.$cons_row->file_path.'</a>';
      $coll->close();
      $colll=$ui->col()->width(4)->open();
      $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
      echo "&nbsp;<div  align='right'>";
      $ui->button()->icon($ui->icon('refresh'))
                   ->value('Request Letter')
                   ->uiType('primary')
                   ->extras($js)
                   //->submit()
                   ->show();
      echo "</div><br/>";

      $colll->close();
     	$innercol2=$ui->col()->id('filebox')->extras('style="display:none"')->width(12)->open();

        
            $ui->input()
               ->label('Request File From Client<span style= "color:red;"> *</span>')
               ->type('file')
               ->id('scope_path')
               ->name('scope_path')
               //->required()
               ->width(12)
               ->show();   

      echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
     	$innercol2->close();
      $innercol3->close(); 
     	
		$row1->close();
    
        
        
    $ui->input()
       ->type('hidden')
       ->name('sr_no')
       ->required()
       ->value($cons_row->sr_no)
       ->show();
    $ui->input()
       ->type('hidden')
       ->name('modification_value')
       ->required()
       ->value($cons_row->modification_value)
       ->show();
	$box->close();
	$row1->close();
	$row1=$ui->row()->open();
	$row1->close();
	$row2=$ui->row()->open();
	$detail_box=$ui->box()
					->title('DETAILS OF THE CONSULTANT-IN-CHARGE')
					->solid()
					->uiType('primary')
					->open();
		$row1=$ui->row()->id('emp_row')->open();
		
     	$row1->close();
	$detail_box->close();
	$row2->close();
	$row2=$ui->row()->open();
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
                       ->placeholder('35% of total charge(D)')
								       ->value($cons_row->institute_charges)
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
     	    						 ->width(12)
     	    					 	 ->show();
                                  
     	    					$innercol1->close();
                    ?>
                    <? $innerrow1=$ui->row()->id('expense_col')->open(); ?>   
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
                                        ->placeholder('')
                                        ->value($cons_row->expenditure)
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
                                        ->placeholder('')
                                        ->value($cons_row->salary)
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
                                        ->placeholder('')
                                        ->value($cons_row->lodging)
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
                                        ->placeholder('not exceeding 20% of (D)')
                                        ->value($cons_row->contigency)
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                              </td>     
                         </tr>
                         
                          <tr class='expense_row' >
                              <td> </td>
                              <td>
                                <? $innercol1=$ui->col()->id('edc_fund_pdp1')->width(12)->open();
                                   echo "In-house Executive Development";
                                  
                                $innercol1->close();?>
                                <? $innercol1=$ui->col()->id('edc_fund_consult1')->width(12)->open();
                                    echo  "Other Consultancy";
                                $innercol1->close();?>
                                </td>
                              <td>
                                   <? $innercol1=$ui->col()->id('edc_fund_pdp')->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('in_house_exp')
                                        ->id('in_house_exp')
                                        ->placeholder('10% of (A)')
                                        ->value($cons_row->in_house)
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                                    <? $innercol1=$ui->col()->id('edc_fund_consult')->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('other_consultancy')
                                        ->id('other_consultancy')
                                        ->placeholder('1% of (A)')
                                        ->value($cons_row->other_consultancy)
                                        ->width(12)
                                        ->show();
                                  
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
                                        ->placeholder('')
                                        ->value($cons_row->non_recurring)
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
                                        ->placeholder('')
                                        ->value($cons_row->equipmental_charge)
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();
                                      ?>
                              </td>   
                              <?$innerrow1->close();?>  
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
                      ->placeholder('(A+B+C)')
								      ->value($cons_row->total_charge)
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
                      ->placeholder('14% of total charge(D)')
								      ->value($cons_row->service_tax)
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
     	    						->width(12)
     	    						->show();
     	    					$innercol1->close();?>
     	    				</td>	
     	    			</tr>
     	    		
     	    		<?
     $table->close();
     
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
  $col1->close();
	$innerrow1=$ui->row()->open();
	$col1=$ui->col()->width(12)->open();
          ?><center><br/>
          <?
          $ui->button()->icon($ui->icon('th'))
             ->type('submit')
             ->value('Submit')
             ->uiType('success')
             ->show();
          ?>
          </center><?
	$col1->close();
	$innerrow1->close();
	$row1->close();
     $charge_box->close();
	$row2->close();
     $form->close();
	$column2->close();