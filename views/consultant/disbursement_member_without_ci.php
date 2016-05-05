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
					                  <th width=20%>Gross Amount(Rs)</th>


					                </thead>
					                
					                  </tr><?
					                  for($i=1;$i<=$member;$i++)
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
													var id="#emp_dept"+i;
												
													$(id).append(result);
												}
													
												
											}
										});
     	    						$('#emp_dept1').on('change' , function()
									{
     	    							onclick_empname(1);
     	    						
									});	
									$('#emp_dept2').on('change' , function()
									{
     	    							onclick_empname(2);
     	    						
									});	
									$('#emp_dept3').on('change' , function()
									{
     	    							onclick_empname(3);
     	    						
									});	
									$('#emp_dept4').on('change' , function()
									{
     	    							onclick_empname(4);
     	    						
									});	
									$('#emp_dept5').on('change' , function()
									{
     	    							onclick_empname(5);
     	    						
									});
									$('#emp_dept6').on('change' , function()
									{
     	    							onclick_empname(6);
     	    						
									});
									$('#emp_dept7').on('change' , function()
									{
     	    							onclick_empname(7);
     	    						
									});
									$('#emp_dept8').on('change' , function()
									{
     	    							onclick_empname(8);
     	    						
									});
									$('#emp_dept9').on('change' , function()
									{
     	    							onclick_empname(9);
     	    						
									});
									$('#emp_dept10').on('change' , function()
									{
     	    							onclick_empname(10);
     	    						
									});
									$('#emp_dept11').on('change' , function()
									{
     	    							onclick_empname(11);
     	    						
									});
									$('#emp_dept12').on('change' , function()
									{
     	    							onclick_empname(12);
     	    						
									});
									$('#emp_dept13').on('change' , function()
									{
     	    							onclick_empname(13);
     	    						
									});
									$('#emp_dept14').on('change' , function()
									{
     	    							onclick_empname(14);
     	    						
									});
									$('#emp_dept15').on('change' , function()
									{
     	    							onclick_empname(15);
     	    						
									});
									$('#emp_dept16').on('change' , function()
									{
     	    							onclick_empname(16);
     	    						
									});
									$('#emp_dept17').on('change' , function()
									{
     	    							onclick_empname(17);
     	    						
									});
									$('#emp_dept18').on('change' , function()
									{
     	    							onclick_empname(18);
     	    						
									});
									$('#emp_dept19').on('change' , function()
									{
     	    							onclick_empname(19);
     	    						
									});
									$('#emp_dept20').on('change' , function()
									{
     	    							onclick_empname(20);
     	    						
									});
									$('#emp_dept21').on('change' , function()
									{
     	    							onclick_empname(21);
     	    						
									});
									$('#emp_dept22').on('change' , function()
									{
     	    							onclick_empname(22);
     	    						
									});	
									$('#emp_dept23').on('change' , function()
									{
     	    							onclick_empname(23);
     	    						
									});	
									$('#emp_dept24').on('change' , function()
									{
     	    							onclick_empname(24);
     	    						
									});	
									$('#emp_dept25').on('change' , function()
									{
     	    							onclick_empname(25);
     	    						
									});
									$('#emp_dept26').on('change' , function()
									{
     	    							onclick_empname(26);
     	    						
									});
									$('#emp_dept27').on('change' , function()
									{
     	    							onclick_empname(27);
     	    						
									});
									$('#emp_dept28').on('change' , function()
									{
     	    							onclick_empname(28);
     	    						
									});
									$('#emp_dept29').on('change' , function()
									{
     	    							onclick_empname(29);
     	    						
									});
									$('#emp_dept30').on('change' , function()
									{
     	    							onclick_empname(30);
									});
									$('#employee_select1').on('change' , function()
									{

     	    							document.getElementById('emp_no1').value=this.value;
     	    							designation(1);
     	    						
									});	
									$('#employee_select2').on('change' , function()
									{

     	    							document.getElementById('emp_no2').value=this.value;
     	    							designation(2);
     	    						
									});	
									$('#employee_select3').on('change' , function()
									{

     	    							document.getElementById('emp_no3').value=this.value;
     	    							designation(3);
     	    						
									});	
									$('#employee_select4').on('change' , function()
									{

     	    							document.getElementById('emp_no4').value=this.value;
     	    							designation(4);

     	    						
									});	
									$('#employee_select5').on('change' , function()
									{

     	    							document.getElementById('emp_no5').value=this.value;
     	    							designation(5);
     	    						
									});
									$('#employee_select6').on('change' , function()
									{

     	    							document.getElementById('emp_no6').value=this.value;
     	    							designation(6);
     	    						
									});
									$('#employee_select7').on('change' , function()
									{

     	    							document.getElementById('emp_no7').value=this.value;
     	    							designation(7);
     	    						
									});
									$('#employee_select8').on('change' , function()
									{

     	    							document.getElementById('emp_no8').value=this.value;
     	    							designation(8);
     	    						
									});
									$('#employee_select9').on('change' , function()
									{

     	    							document.getElementById('emp_no9').value=this.value;
     	    							designation(9);
     	    						
									});
									$('#employee_select10').on('change' , function()
									{

     	    							document.getElementById('emp_no10').value=this.value;
     	    							designation(10);
     	    						
									});
									$('#employee_select11').on('change' , function()
									{

     	    							document.getElementById('emp_no11').value=this.value;
     	    							designation(11);
     	    						
									});
									$('#employee_select12').on('change' , function()
									{

     	    							document.getElementById('emp_no12').value=this.value;
     	    							designation(12);
     	    						
									});
									$('#employee_select13').on('change' , function()
									{

     	    							document.getElementById('emp_no13').value=this.value;
     	    							designation(13);
     	    						
									});
									$('#employee_select14').on('change' , function()
									{

     	    							document.getElementById('emp_no14').value=this.value;
     	    							designation(14);
     	    						
									});
									$('#employee_select15').on('change' , function()
									{

     	    							document.getElementById('emp_no15').value=this.value;
     	    							designation(15);
     	    						
									});
									$('#employee_select16').on('change' , function()
									{

     	    							document.getElementById('emp_no16').value=this.value;
     	    							designation(16);
     	    						
									});
									$('#employee_select17').on('change' , function()
									{

     	    							document.getElementById('emp_no17').value=this.value;
     	    							designation(17);
     	    						
									});
									$('#employee_select18').on('change' , function()
									{

     	    							document.getElementById('emp_no18').value=this.value;
     	    							designation(18);
     	    						
									});
									$('#employee_select19').on('change' , function()
									{

     	    							document.getElementById('emp_no19').value=this.value;
     	    							designation(19);
     	    						
									});
									$('#employee_select20').on('change' , function()
									{

     	    							document.getElementById('emp_no20').value=this.value;
     	    							designation(20);
     	    						
									});
									$('#employee_select21').on('change' , function()
									{

     	    							document.getElementById('emp_no21').value=this.value;
     	    							designation(21);
     	    						
									});
									$('#employee_select22').on('change' , function()
									{

     	    							document.getElementById('emp_no22').value=this.value;
     	    							designation(22);
     	    						
									});	
									$('#employee_select23').on('change' , function()
									{

     	    							document.getElementById('emp_no23').value=this.value;
     	    							designation(23);
     	    						
									});	
									$('#employee_select24').on('change' , function()
									{

     	    							document.getElementById('emp_no24').value=this.value;
     	    							designation(24);

     	    						
									});	
									$('#employee_select25').on('change' , function()
									{

     	    							document.getElementById('emp_no25').value=this.value;
     	    							designation(25);
     	    						
									});
									$('#employee_select26').on('change' , function()
									{

     	    							document.getElementById('emp_no26').value=this.value;
     	    							designation(26);
     	    						
									});
									$('#employee_select27').on('change' , function()
									{

     	    							document.getElementById('emp_no27').value=this.value;
     	    							designation(27);
     	    						
									});
									$('#employee_select28').on('change' , function()
									{

     	    							document.getElementById('emp_no28').value=this.value;
     	    							designation(28);
     	    						
									});
									$('#employee_select29').on('change' , function()
									{

     	    							document.getElementById('emp_no29').value=this.value;
     	    							designation(29);
     	    						
									});
									$('#employee_select30').on('change' , function()
									{

     	    							document.getElementById('emp_no30').value=this.value;
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
			    emp_name.innerHTML += xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",site_url("ajax/empNameByDept/"+dept),true);
		xmlhttp.send();
		emp_name.innerHTML = "<i class=\"loading\"></i>";
	}

function designation(table_id)
{

	var emp_no=document.getElementById('employee_select'+table_id).value;
	
	var des_name=document.getElementById('des'+table_id);
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