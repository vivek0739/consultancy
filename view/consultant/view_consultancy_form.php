<?php
	
	$ui = new UI();


	$outer_row = $ui->row()->open();
	
	$column1 = $ui->col()->width(0)->open();
	$column1->close();
	$column2 = $ui->col()->width(12)->open();
	$new_payment=$payment;
	?><div class="modal-body">
        <center>
        <?php
            $data_row = $ui->row()->id('data_row')->open();
            $data_row->close();?>
   </div>
	<?
	
	$column2->close();
	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Consultancy Form")
				   ->tab("current", "To Be Approved",true)
				   ->tab("archived", "Approved")
				   ->tab("complete", "Completed")
				   ->tab("cancel", "Canceled")
				   ->open();

			$tab1 = $ui->tabPane()->id("current")->active()->open();
			$flag=1;

				// if($count_current_circular != 0){

					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>
															
								<th>Title</th>
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								<th>Action</th>
								
								<th >Links</th>
								<th >Requested File</th>
							</tr>

						</thead>
<?php
					$new_cons_row=$cons_row;

					foreach($cons_row as $key => $cons_row) 
					{
						
						if(($cons_row->status<5 && $cons_row->status!=1
							&& ($auth_id=='ft'||$auth_id=='c_i'))||
							$cons_row->status==2)
						{

?>
						<tr>

									
									<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
								
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $cons_row->sr_no ?>", "<?= $cons_row->modification_value?>")'></i>
									</td>
									
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>","<?= $auth_id?>")'></i>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
								</tr>
					<? }

					}
					$table->close();
				// }
				// else
				// {
				// 	$ui->callout()
				// 	   ->uiType("info")
				// 	   ->title("No Current Circular.")
				// 	   ->desc("You have not any current circular to view.")
				// 	   ->show();
				// }
?>
<br/>
<?php

			$tab1->close();
			$flag=2;
			$tab2 = $ui->tabPane()->id("archived")->open();

				$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
		 if($auth_id=='pce')
		 {
						 	?>
										<thead>
											<tr>							
												<th >Consultancy No.</th>								
												<th>Title</th>
												<th>Posted On/ Edited On</th>
												<th>Revision Status</th>
												<th>Action</th>
												
												<th>Links</th>
												
												<th>Requested File</th>
												<th>done</th>
											</tr>

										</thead>
				<?php
									$new_cons_row1=$cons_row1;

									foreach($cons_row1 as $key => $cons_row) 
									{
										if($cons_row->status>=5 && $cons_row->status!=7)
										{
											
				?>
										<tr>
													<td align="center"><?=$cons_row->consultancy_no?></td>
													<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
													
													<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
												
													<td align="center">
												<?php
													if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
												?>
													</td>
													<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $cons_row->sr_no ?>", "<?= $cons_row->modification_value?>")'></i>
													</td>
													
													</td>
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>","<?= $auth_id?>")'></i>
									</td>

												<td align="center">
													
													<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>">
														<?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
													</td>
												<td align="center">
													
													<a href="<?=base_url().'index.php/consultant/consultancy_proposal_form/done/'.$cons_row->sr_no?>">
														<?=$ui->button()->icon($ui->icon('check'))->mini()->uiType('success')->value('Done')->show();?></a>
												
													</td>
												</tr>

									<? }
									}
		 }
		 else
		 {
				 		?>
								<thead>
									<tr>							
										<th >Consultancy No.</th>								
										<th>Title</th>
										<th>Posted On/ Edited On</th>
										<th>Revision Status</th>
										<th>Action</th>
										
										<th >Links</th>
										<th >Requested File</th>
									</tr>

								</thead>
		<?php
							$new_cons_row1=$cons_row1;

							foreach($cons_row1 as $key => $cons_row) 
							{
								if($cons_row->status>=5 && $cons_row->status!=7)
								{
									
		?>
								<tr>
											<td align="center"><?=$cons_row->consultancy_no?></td>
											<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
											
											<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
										
											<td align="center">
										<?php
											if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
										?>
											</td>
											<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $cons_row->sr_no ?>", "<?= $cons_row->modification_value?>")'></i>
											</td>
											
											</td>
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>","<?= $auth_id?>")'></i>
									</td>
									<td align="center">
											
											<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
											</td>
										<?	echo '
										</tr>';
							 }
							}
							
		 }
$table->close();
				// else
				// {
				// 	$ui->callout()
				// 	   ->uiType("info")
				// 	   ->title("No Archived Circular.")
				// 	   ->desc("You have not any Archived circular to view.")
				// 	   ->show();
				// }
?>
<br/>
<?php
		$tab2->close();
		$tab3 = $ui->tabPane()->id("complete")->open();
		$flag=3;
		$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Consultancy No.</th>								
								<th>Title</th>
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								<th>Action</th>
								
								<th >Links</th>
								<th >Requested File</th>
							</tr>

						</thead>
<?php
					$cons_row1=$new_cons_row1;
					foreach($cons_row1 as $key => $cons_row) 
					{
						if($cons_row->status==7)
						{
							

?>					
						<tr>
									<td align="center"><?=$cons_row->consultancy_no?></td>
									<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
								
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $cons_row->sr_no ?>", "<?= $cons_row->modification_value?>")'></i>
									</td>
									
									</td>
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>","<?= $auth_id?>")'></i>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
									<? echo'
								</tr>';
					}
					}
					$table->close();
				// else
				// {
				// 	$ui->callout()
				// 	   ->uiType("info")
				// 	   ->title("No Archived Circular.")
				// 	   ->desc("You have not any Archived circular to view.")
				// 	   ->show();
				// }
?>
<br/>
<?php
		$tab3->close();
			$flag=4;
			$tab4 = $ui->tabPane()->id("cancel")->open();

				$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
																
								<th>Title</th>
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								<th>Action</th>
								
								<th >Links</th>
								<th >Requested File</th>
							</tr>

						</thead>
<?php
					$cons_row=$new_cons_row;
					foreach($cons_row as $key => $cons_row) 
					{
						if($cons_row->status==1)
						{

?>
						<tr>
									<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
								
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									<td><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $cons_row->sr_no ?>", "<?= $cons_row->modification_value?>")'></i>
									</td>
									
									</td>
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>","<?= $auth_id?>")'></i>
									</td>
									
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
								</tr>
					<?}
					}
					$table->close();
				// else
				// {
				// 	$ui->callout()
				// 	   ->uiType("info")
				// 	   ->title("No Archived Circular.")
				// 	   ->desc("You have not any Archived circular to view.")
				// 	   ->show();
				// }
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
<script type="text/javascript">
function myFunction(sr_no,modv) {
        mywindow = window.open("<?php echo base_url() ?>index.php/consultant/consultant/view_action/" + sr_no+ "/" +modv ,'_blank', "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550");
        
      
       
      } 
function myFunction2(sr_no,auth_id) {

        $.ajax({
                url : site_url("consultant/consultant_ajax/view_modal/" + sr_no+ "/" +auth_id),
                success : function(result){
                    if(result.length != false){
                       
                        $('#data_row').html(result);
                    }
                },
                error : function(){
                    alert('some thing went wrong. please report');
                }
            });
       
      } 
</script>