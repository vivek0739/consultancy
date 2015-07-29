<script type="text/javascript">
var p=1;
$(window).load(function(){

     $('.expense_row').hide();
     $('#edc_fund_pdp').show();
      $('#edc_fund_consult').hide();
      $('#edc_fund_consult1').hide();
      $('#edc_fund_pdp1').show();
     
});
 
$(document).ready(function(){
    $('#expense_col').click(function(){
        
       $('.expense_row').toggle();
           
     
        
    });
    
    $('#add_member').click(function(){
        var sr_no=<?echo $id->sr_no;?>;
        var dept_id='<?echo $dept_id;?>';
        var emp_no='<?echo $emp_no;?>';
        var position='ci';
        var share=$('#share1').val();
        var modv='0';
        dept_id=dept_id.trim();
             emp_no=emp_no.trim();
            
            sr_no=sr_no+1;
        if(share=='')
        {
           alert('enter the share value');
        }
        else
        {
             
            $.ajax({
                type : "POST",
                url : site_url("consultant/consultant_ajax/member/"),
                data : {
                    'sr_no' : sr_no,
                    'emp_no' : emp_no,
                    'department' : dept_id,
                    'position' : position,
                    'share' : share,
                    'modification_value' : modv
                   },
                 success : function(result){
                   $('#emp_row').html(result);
                },
                error : function(){
                    alert('some thing went wrong. please report');
           
              }
        
           });
        }
        
        
       
});
$('#form_submit').on('submit', function(e) {
     
          var f=$('#gross_amount').val();
          var c=$('#consultancy_charge').val();
          var a= $('#institute_charge').val();
          var d= $('#total_charge').val();
          var b=$('#expenses').val();
          var ef=$('#service_tax').val();



         var b1=$('#expenditure').val();
          var b2=$('#salary').val();
          var b3=$('#lodging').val();
          var b4=$('#contigency').val();
          var b5a=$('#in_house_exp').val();
          var b5b=$('#other_consultancy').val();
          var b6=$('#non_recurring').val();
          var b7=$('#equipment_charge').val();
          
          a=parseFloat(a);
          b=parseFloat(b);
          c=parseFloat(c);
          d=parseFloat(d);
          ef=parseFloat(ef);
          f=parseFloat(f);
          
           b1=parseFloat(b1);
          b2=parseFloat(b2);
          b3=parseFloat(b3);
          b4=parseFloat(b4);
          b5a=parseFloat(b5a);
          b5b=parseFloat(b5b);
          b6=parseFloat(b6);
          b7=parseFloat(b7);

           var edc_type=$('#edc_fund').val();
          var b5;
          if(edc_type=='pdp')
            b5=b5a;
          else
            b5=b5b;
         if(b1+b2+b3+b4+b5+b6+b7!=b)
          {
            
            alert('All Sub Section of B should be sum to B');
            e.preventDefault();
          }
          else if(a+b+c!=d)
          {
            alert('Section A,B,C should be sum to Section D');
            e.preventDefault();
          }
          else if(d+ef!=f)
          {
             alert('Section D and E should sum to F');
            e.preventDefault();
          }
          else if(Math.abs(d*0.35-a)>0.000001)
          {
            alert('Section A should be 20% of D');
            e.preventDefault();
          }
          else if(d*0.2<b4)
          {
            alert('contigency should not exceed 20% of D');
            e.preventDefault();
          }
          else if(Math.abs(d*0.14 - ef)>0.000001)
          {
            
            alert('Section E should be 14% of D');
            e.preventDefault();
          }
          else if(d*0.2<b4)
          {
            alert('contigency should not exceed 20% of D');
            e.preventDefault();
          }
          else
          {
           
            var sr_no=<?php echo $id->sr_no;?>;
            var form = $(this);
            

            sr_no=parseInt(sr_no);
              e.preventDefault();
              $.ajax({
                  url: site_url("consultant/consultant_ajax/checkShare/"),
                  async: 'false',
                  cache: 'false',
                  type: 'POST',
                  data: {
                              'sr_no' : sr_no,
                             
                             },
                  success: function (response) {
                    
                      if (response == 0) {
                          alert('total share should be 100')
                      } else {
                          //submit if valie
                          form[0].submit()
                      }
                  },
                error : function(){
                    alert('some thing went wrong. please report');
           
              }

              });
              
          }

        
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
          a= a.toFixed(2);
          d= d.toFixed(2);
          e= e.toFixed(2);
          bva=bva.toFixed(2);
          bvb=bvb.toFixed(2);

          $('#total_charge').val(d);
          $('#service_tax').val(e);
          $('#institute_charge').val(a);
          $('#in_house_exp').val(bva);
          $('#other_consultancy').val(bvb);
          
          /*for future use
          replace 0.0 by given percentage for the tax divided by 100*/
         /* var other_tax=d*0.0;
          var edu_cess=e*0.0;
          $('#other_tax').val(other_tax);
          $('#educational_cess').val(edu_cess);
          */
          
    });
    $('#consultancy_charge').on('keyup',function(){
          var f=$('#gross_amount').val();
          var c=this.value;
          var a= $('#institute_charge').val();
          var d= $('#total_charge').val();
          if(f!='')
          {
               var b=d-a-c;
               b= b.toFixed(2);
               $('#expenses').val(b);
          }

    });
    
});


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
          ->action('consultant/consultant/submit_consult_form')
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
			  
			   ->show();
			
     	 
     	$innercol1->close();
      
      $innercol1=$ui->col()->width(6)->open();
                                   $ui->select()
                                      ->label('Type')
                                        ->name('edc_fund')
                                        ->id('edc_fund')
                                        ->options(array($ui->option()->value('pdp')->text('SHORT COURSE')->selected(),
                                                           $ui->option()->value('other_consult')->text('CONSULTANCY')))
                                   
                                        ->required()
                                      
                                       ->show();
                                        
                                  
         $innercol1->close();
    
       
      $innercol2=$ui->col()->width(6)->open();
        $ui->input()
          ->label('Scope of work')
            ->type('file')
            ->name('work_scope')
            ->required()
            
            ->show();

    echo "(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)<br/><br/>";
      $innercol2->close();
     	$innercol2=$ui->col()->width(6)->open();
        $ui->input()
          ->label('Letter of request from client/Approval letter from Director')
            ->type('file')
            ->name('scope_path')
            ->required()
            
            ->show();
 
    echo "(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
     	$innercol2->close();
     	
		$row1->close();
    $value=1;
    if($id->sr_no != NULL)
       $value = $id->sr_no +1;
    $ui->input()
       ->type('hidden')
       ->id('total_share')
       ->required()
       ->value($value)
       ->show();  
    
    $ui->input()
       ->type('hidden')
       ->name('sr_no')
       ->required()
       ->value($value)
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
                  <th></th>

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
                      ->value($dept_id)
                      ->required()
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
                      ->id('des1')
                      ->name('des1')
                      ->value($designation)
                      ->disabled()
                      ->width(12)
                      ->show();
                    $ui->input()
                      ->type('hidden')
                      ->id('des1')
                      ->name('des1')
                      ->value($designation)
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
                      ->name('share1')
                      ->id("share1")
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  <td>
                 <? $col1=$ui->col()->width(2)->open();
                  
                   $ui->button()->icon($ui->icon('plus'))
                    ->mini()
                     ->id('add_member')
                      ->value('Add')
                      ->uiType('success')
                      ->show();
                  
                 $col1->close();
                 ?></td>
                  </tr>
               <?
              
     	    			$table->close();
                $ui->callout()
                  ->desc('Click add button otherwise member will not be added')
                  ->uiType('info')
                  ->show();
          
     	$col1->close();
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
								      ->value('')
                      ->required()
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
								->value()
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
                                        ->value()
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
                                        ->value()
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
                                        ->value()
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
                                        ->value()
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
                                        ->value()
                                        ->width(12)
                                        ->show();
                                  
                                      $innercol1->close();?>
                                    <? $innercol1=$ui->col()->id('edc_fund_consult')->width(12)->open();
                                   $ui->input()
                                        ->type('text')
                                        ->name('other_consultancy')
                                        ->id('other_consultancy')
                                        ->placeholder('1% of (A)')
                                        ->value()
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
                                        ->value()
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
                                        ->value()
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
								->value('')
                ->required()
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
								->value('')
     	    						->width(12)
                      ->required()
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
								->value('')
     	    						->width(12)
                      ->required()
     	    						->show();
     	    					   $innercol1->close();?>
     	    				</td>	
     	    			</tr>
                <?
                /*for future use
                <tr>
                  <td>F/td>
                  <td>EDUCATIONAL CESS </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('educational_cess')
                      ->id('educational_cess')
                      ->placeholder('3% of total charge(D)')
                      ->value('')
                      ->width(12)
                      ->required()
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
                <tr>
                  <td>G</td>
                  <td>OTHER TAX </td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('other_tax')
                      ->id('sother_tax')
                      ->placeholder('14% of total charge(D)')
                ->value('')
                      ->width(12)
                      ->required()
                      ->show();
                       $innercol1->close();?>
                  </td> 
                </tr>
                */
                ?>
     	    			<tr>
     	    				<td>F</td>
     	    				<td>GROSS AMOUNT </td>
     	    				<td>
     	    					<? $innercol1=$ui->col()->width(12)->open();
     	    					$ui->input()
     	    						->type('text')
     	    						->name('gross_amount')
								->id('gross_amount')
								->value('')
     	    						->width(12)
                      ->required()
     	    						->show();
     	    					   $innercol1->close();?>
     	    				</td>	
     	    			</tr>
     	    		
     	    		<?
     $table->close();
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
  $col1=$ui->col()->width(12)->open();
  $col1->close();
	$innerrow1->close();
	$row1->close();
     $charge_box->close();
	$row2->close();
     $form->close();
	$column2->close();