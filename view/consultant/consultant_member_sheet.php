


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
	
	
	
	$column2 = $ui->col()->width(12)->open();
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
					                  for($i=2;$i<=$no_of_people;$i++)
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
					     	
		 $column2->close();
		 $row->close();
?>
<script type="text/javascript" language="javascript">

var no_of_people='<?echo $no_of_people;?>';
no_of_people=parseInt(no_of_people);


$.ajax({
											url: site_url("ajax/department/"),
											success: function(result){

												for(i=2;i<=no_of_people;i++){
													var id="#emp_dept"+i;
												
													$(id).append(result);
												}
													
												
											}
										});
for(i=2;i<=no_of_people;i++)
{
	var id="#emp_dept"+i;

	$(id).on('change' , function()
	{
										
     	    							onclick_empname(i);
    });
}
function onclick_empname(table_id)
{
	alert(table_id);
}


</script>