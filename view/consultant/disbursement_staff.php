<?php
	
	$ui = new UI();
	$column1 = $ui->col()->width(0)->open();
	$column1->close();
	$column2 = $ui->col()->width(12)->open();
	/****************************************************/
	$row1=$ui->row()->open();
							$col1=$ui->col()->width(12)->open();
								$table=$ui->table()
					                  ->hover()
					                  ->bordered()
					                  ->width(12)
					                  ->open()
					                ?><thead>
					                  <th width=20%>Department</th>
					                  <th width=20%>Employee's Name</th>
					                  <th width=20%>Employee No.</th>
					                  
					                  <th width=20%>Select Position</th>
					                  <th width=20%>Amount(Rs)</th>


					                </thead>
					                <?
					                  for($i=1;$i<=$staff;$i++)
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
					                      ->id("e_amt".$i)
					                      ->width(12)
					                      ->show();
					                       $innercol1->close();
					                  ?></td>
					                  </tr><?
					                  
					                }
					                $table->close();
					     	$col1->close();
					     	$row1->close();
	/****************************************************/
	$column2->close();
?>


<script type="text/javascript">
		/*$(document).ready(function(){
			alert('HII');
     	    					$(window).load(function() {

alert('HIIi');*/
     	    					
     	    					
     	    						$.ajax({
											url: site_url("ajax/department/"),
											success: function(result){
												for(i=1;i<=30;i++){
													var id="#e_emp_dept"+i;
												
													$(id).append(result);
												}
													
												
											}
										});
     	    						$('#e_emp_dept1').on('change' , function()
									{
     	    							onclick_empname(1);
     	    						
									});	
									$('#e_emp_dept2').on('change' , function()
									{
     	    							onclick_empname(2);
     	    						
									});	
									$('#e_emp_dept3').on('change' , function()
									{
     	    							onclick_empname(3);
     	    						
									});	
									$('#e_emp_dept4').on('change' , function()
									{
     	    							onclick_empname(4);
     	    						
									});	
									$('#e_emp_dept5').on('change' , function()
									{
     	    							onclick_empname(5);
     	    						
									});
									$('#e_emp_dept6').on('change' , function()
									{
     	    							onclick_empname(6);
     	    						
									});
									$('#e_emp_dept7').on('change' , function()
									{
     	    							onclick_empname(7);
     	    						
									});
									$('#e_emp_dept8').on('change' , function()
									{
     	    							onclick_empname(8);
     	    						
									});
									$('#e_emp_dept9').on('change' , function()
									{
     	    							onclick_empname(9);
     	    						
									});
									$('#e_emp_dept10').on('change' , function()
									{
     	    							onclick_empname(10);
     	    						
									});
									$('#e_emp_dept11').on('change' , function()
									{
     	    							onclick_empname(11);
     	    						
									});	
									$('#e_emp_dept12').on('change' , function()
									{
     	    							onclick_empname(12);
     	    						
									});	
									$('#e_emp_dept13').on('change' , function()
									{
     	    							onclick_empname(13);
     	    						
									});	
									$('#e_emp_dept14').on('change' , function()
									{
     	    							onclick_empname(14);
     	    						
									});	
									$('#e_emp_dept15').on('change' , function()
									{
     	    							onclick_empname(15);
     	    						
									});
									$('#e_emp_dept16').on('change' , function()
									{
     	    							onclick_empname(16);
     	    						
									});
									$('#e_emp_dept17').on('change' , function()
									{
     	    							onclick_empname(17);
     	    						
									});
									$('#e_emp_dept18').on('change' , function()
									{
     	    							onclick_empname(18);
     	    						
									});
									$('#e_emp_dept19').on('change' , function()
									{
     	    							onclick_empname(19);
     	    						
									});
									$('#e_emp_dept20').on('change' , function()
									{
     	    							onclick_empname(20);
     	    						
									});
									$('#e_emp_dept21').on('change' , function()
									{
     	    							onclick_empname(21);
     	    						
									});	
									$('#e_emp_dept22').on('change' , function()
									{
     	    							onclick_empname(22);
     	    						
									});	
									$('#e_emp_dept23').on('change' , function()
									{
     	    							onclick_empname(23);
     	    						
									});	
									$('#e_emp_dept24').on('change' , function()
									{
     	    							onclick_empname(24);
     	    						
									});	
									$('#e_emp_dept25').on('change' , function()
									{
     	    							onclick_empname(25);
     	    						
									});
									$('#e_emp_dept26').on('change' , function()
									{
     	    							onclick_empname(26);
     	    						
									});
									$('#e_emp_dept27').on('change' , function()
									{
     	    							onclick_empname(27);
     	    						
									});
									$('#e_emp_dept28').on('change' , function()
									{
     	    							onclick_empname(28);
     	    						
									});
									$('#e_emp_dept29').on('change' , function()
									{
     	    							onclick_empname(29);
     	    						
									});
									$('#e_emp_dept30').on('change' , function()
									{
     	    							onclick_empname(30);
     	    						
									});
									$('#e_employee_select1').on('change' , function()
									{

     	    							document.getElementById('e_emp_no1').value=this.value;
     	    							designation(1);
     	    						
									});	
									$('#e_employee_select2').on('change' , function()
									{

     	    							document.getElementById('e_emp_no2').value=this.value;
     	    							designation(2);
     	    						
									});	
									$('#e_employee_select3').on('change' , function()
									{

     	    							document.getElementById('e_emp_no3').value=this.value;
     	    							designation(3);
     	    						
									});	
									$('#e_employee_select4').on('change' , function()
									{

     	    							document.getElementById('e_emp_no4').value=this.value;
     	    							designation(4);

     	    						
									});	
									$('#e_employee_select5').on('change' , function()
									{

     	    							document.getElementById('e_emp_no5').value=this.value;
     	    							designation(5);
     	    						
									});
									$('#e_employee_select6').on('change' , function()
									{

     	    							document.getElementById('e_emp_no6').value=this.value;
     	    							designation(6);
     	    						
									});
									$('#e_employee_select7').on('change' , function()
									{

     	    							document.getElementById('e_emp_no7').value=this.value;
     	    							designation(7);
     	    						
									});
									$('#e_employee_select8').on('change' , function()
									{

     	    							document.getElementById('e_emp_no8').value=this.value;
     	    							designation(8);
     	    						
									});
									$('#e_employee_select9').on('change' , function()
									{

     	    							document.getElementById('e_emp_no9').value=this.value;
     	    							designation(9);
     	    						
									});
									$('#e_employee_select10').on('change' , function()
									{

     	    							document.getElementById('e_emp_no10').value=this.value;
     	    							designation(10);
     	    						
									});
									$('#e_employee_select11').on('change' , function()
									{

     	    							document.getElementById('e_emp_no11').value=this.value;
     	    							designation(11);
     	    						
									});	
									$('#e_employee_select12').on('change' , function()
									{

     	    							document.getElementById('e_emp_no12').value=this.value;
     	    							designation(12);
     	    						
									});	
									$('#e_employee_select13').on('change' , function()
									{

     	    							document.getElementById('e_emp_no13').value=this.value;
     	    							designation(13);
     	    						
									});	
									$('#e_employee_select14').on('change' , function()
									{

     	    							document.getElementById('e_emp_no14').value=this.value;
     	    							designation(14);

     	    						
									});	
									$('#e_employee_select15').on('change' , function()
									{

     	    							document.getElementById('e_emp_no15').value=this.value;
     	    							designation(15);
     	    						
									});
									$('#e_employee_select16').on('change' , function()
									{

     	    							document.getElementById('e_emp_no16').value=this.value;
     	    							designation(16);
     	    						
									});
									$('#e_employee_select17').on('change' , function()
									{

     	    							document.getElementById('e_emp_no17').value=this.value;
     	    							designation(17);
     	    						
									});
									$('#e_employee_select18').on('change' , function()
									{

     	    							document.getElementById('e_emp_no18').value=this.value;
     	    							designation(18);
     	    						
									});
									$('#e_employee_select19').on('change' , function()
									{

     	    							document.getElementById('e_emp_no19').value=this.value;
     	    							designation(19);
     	    						
									});
									$('#e_employee_select20').on('change' , function()
									{

     	    							document.getElementById('e_emp_no20').value=this.value;
     	    							designation(20);
     	    						
									});
									$('#e_employee_select21').on('change' , function()
									{

     	    							document.getElementById('e_emp_no21').value=this.value;
     	    							designation(21);
     	    						
									});	
									$('#e_employee_select22').on('change' , function()
									{

     	    							document.getElementById('e_emp_no22').value=this.value;
     	    							designation(22);
     	    						
									});	
									$('#e_employee_select23').on('change' , function()
									{

     	    							document.getElementById('e_emp_no23').value=this.value;
     	    							designation(23);
     	    						
									});	
									$('#e_employee_select24').on('change' , function()
									{

     	    							document.getElementById('e_emp_no24').value=this.value;
     	    							designation(24);

     	    						
									});	
									$('#e_employee_select25').on('change' , function()
									{

     	    							document.getElementById('e_emp_no25').value=this.value;
     	    							designation(25);
     	    						
									});
									$('#e_employee_select26').on('change' , function()
									{

     	    							document.getElementById('e_emp_no26').value=this.value;
     	    							designation(26);
     	    						
									});
									$('#e_employee_select27').on('change' , function()
									{

     	    							document.getElementById('e_emp_no27').value=this.value;
     	    							designation(27);
     	    						
									});
									$('#e_employee_select28').on('change' , function()
									{

     	    							document.getElementById('e_emp_no28').value=this.value;
     	    							designation(28);
     	    						
									});
									$('#e_employee_select29').on('change' , function()
									{

     	    							document.getElementById('e_emp_no29').value=this.value;
     	    							designation(29);
     	    						
									});
									$('#e_employee_select30').on('change' , function()
									{

     	    							document.getElementById('e_emp_no30').value=this.value;
     	    							designation(30);
     	    						
									});

									
     	    					//});	
  // });	
/*$(document).ready(function(){
	$("#no_of_persons").on('keyup' , function()
			{
				
				no_of_persons(this.value);

			});
});
function no_of_persons(num)
{
	$.ajax({
		url: site_url("consultant/consultant/detail_table/"+num),
		success: function(result){
			$("#detail_table").html(result);
		}
	});
}*/
function onclick_empname(table_id)
	{

		document.getElementById('employee').style.display="inherit";
		var emp_name=document.getElementById('e_employee_select'+table_id);

		var dept=document.getElementById('e_emp_dept'+table_id).value;
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
			    emp_name.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("ajax/empNameByDept/"+dept),true);
		xmlhttp.send();
		emp_name.innerHTML = "<i class=\"loading\"></i>";
	}

function designation(table_id)
{

	var emp_no=document.getElementById('e_employee_select'+table_id).value;
	
	var des_name=document.getElementById('e_des'+table_id);
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
			    des_name.value += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("consultant/consultant/designation/"+emp_no),true);
		xmlhttp.send();
		des_name.innerHTML = "<i class=\"loading\"></i>";
}
</script>