<?php
	
	$ui = new UI();
	$column1 = $ui->col()->width(0)->open();
	$column1->close();
	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file-o"))
				   ->title("Dissbursement Form")
				   ->tab("current", "To Be Approved",true)
				   ->tab("archived", "Approved")
				   ->tab("complete", "Completed")
				   ->tab("cancel", "Canceled")
				   ->open();
			$tab1 = $ui->tabPane()->id("current")->active()->open();
				echo "1";
				$table = $ui->table()
							->hover()
							->bordered()
							->sortable()
							->searchable()
							->paginated()
						    ->open();
					?>	    
					<thead>
						<tr>
															
							<th>Consultancy No.</th>
							<th>Title</th>
							<th>Posted On/ Edited On</th>
							<th>Revision Status</th>
							<th>Action</th>
							<th >Requested File</th>
							<th >View Links</th>
						</tr>
					</thead><?
					foreach($details as $row)
						{
							//print_r($row->status);
							if($row->status==99 || $row->status==100)
							{
								$mod = $row->modification_value;
								$mod = $mod - 1;
								$auth_id='ft';
								?>
								<tr>
									<td align="center"><? echo $row->consultancy_no; ?></td>
									<td align="center"><? echo $row->consultancy_title; ?></td>
									<td align="center"> <?=date('d M Y g:i a',strtotime($row->timestamp1))?> </td>
									<td align="center"><?if($mod <= 0){echo 'Original';}else{ echo 'revised '.$mod;}?> </td>
									<td align="center"><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $row->sr_no ?>")'></i>
									</td>
									<td align="center">

										<a href="<?=base_url().'index.php/consultant/consultant_ajax/view_modal1/'.$row->sr_no.'/'.$auth_id ?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('Money receipt')
												->show();
												?>
										</a><br>
										<a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path?>" download="<?=$row->file_path?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><br>
										<?/*?><a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path1?>" download="<?=$row->file_path1?>">
										<?
											$ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><?*/?>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/ciview/'.$row->sr_no?>">
											  			<?
											  			$ui->button()->uiType('primary')->mini()->value('View Form')->show();
													?> </a>
										<?
										if($mod > 0)
										{?>
											<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/view_disbursement_prev/'.$row->sr_no?>">
										  			<?
										  			$ui->button()->uiType('warning')->mini()->value('Prev')->show();

										  		?></a>
										<?}
										?>
									</td>
								</tr>
							<?}
						}
				$table->close();
			$tab1->close();
			$tab2 = $ui->tabPane()->id("archived")->open();
				echo "2";
				$table = $ui->table()
							->hover()
							->bordered()
							->sortable()
							->searchable()
							->paginated()
						    ->open();
						?>
					<thead>
						<tr>							
							<th>Consultancy No.</th>
							<th>Title</th>
							<th>Posted On/ Edited On</th>
							<th>Revision Status</th>
							<th>Action</th>
							<th >Requested File</th>
							<th >View Links</th>
						</tr>
					</thead><?
					foreach($details as $row)
						{
							if($row->status==101 || $row->status==102)
							{
								$mod = $row->modification_value;
								$mod = $mod - 1;
								?>
								<tr>
									<td align="center"><? echo $row->consultancy_no; ?></td>
									<td align="center"><? echo $row->consultancy_title; ?></td>
									<td align="center"> <?=date('d M Y g:i a',strtotime($row->timestamp1))?> </td>
									<td align="center"><?if($mod <= 0){echo 'Original';}else{ echo 'revised '.$mod;}?> </td>
									<td align="center"><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $row->sr_no ?>")'></i>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_ajax/view_modal1/'.$row->sr_no.'/'.$auth_id ?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('Money receipt')
												->show();
												?>
										</a><br>
										<a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path?>" download="<?=$row->file_path?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><br>
										<?/*?><a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path1?>" download="<?=$row->file_path1?>">
										<?
											$ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><?*/?>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/ciview/'.$row->sr_no?>">
											  			<?
											  			$ui->button()->uiType('primary')->mini()->value('View Form')->show();
													?> </a><?
										if($mod > 0)
										{?>
											<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/view_disbursement_prev/'.$row->sr_no?>">
										  			<?
										  			$ui->button()->uiType('warning')->mini()->value('Prev')->show();

										  		?></a>
										<?}?>
									</td>
								</tr>
							<?}
						}
					$table->close();
			$tab2->close();
			$tab3 = $ui->tabPane()->id("complete")->open();
				echo "3";
				$table = $ui->table()
							->hover()
							->bordered()
							->sortable()
							->searchable()
							->paginated()
						    ->open();
					?>
					<thead>
						<tr>							
							<th>Consultancy No.</th>
							<th>Title</th>
							<th>Posted On/ Edited On</th>
							<th>Revision Status</th>
							<th>Action</th>
							<th>Requested File</th>
							<th>View Links</th>
						</tr>
					</thead><?
					foreach($details as $row)
						{
							if($row->status==103)
							{
								$mod = $row->modification_value;
								$mod = $mod - 1;
								?>
								<tr>
									<td align="center"><? echo $row->consultancy_no; ?></td>
									<td align="center"><? echo $row->consultancy_title; ?></td>
									<td align="center"> <?=date('d M Y g:i a',strtotime($row->timestamp1))?> </td>
									<td align="center"><?if($mod <= 0){echo 'Original';}else{ echo 'revised '.$mod;}?> </td>
									<td align="center"><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $row->sr_no ?>")'></i>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_ajax/view_modal1/'.$row->sr_no.'/'.$auth_id ?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('Money receipt')
												->show();
												?>
										</a><br>
										<a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path?>" download="<?=$row->file_path?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><br>
										<?/*?><a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path1?>" download="<?=$row->file_path1?>">
										<?
											$ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><?*/?>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/completed_link/'.$row->sr_no?>">
											  			<?
											  			$ui->button()->uiType('primary')->mini()->value('View Form')->show();
													?> </a><?
										if($mod > 0)
										{?>
											<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/view_disbursement_prev/'.$row->sr_no?>">
										  			<?
										  			$ui->button()->uiType('warning')->mini()->value('Prev')->show();

										  		?></a>
										<?}?>
									</td>
								</tr>
							<?}
						}
						$table->close();
			$tab3->close();
			$tab4 = $ui->tabPane()->id("cancel")->open();
				echo "4";
				$table = $ui->table()
							->hover()
							->bordered()
							->sortable()
							->searchable()
							->paginated()
						    ->open();
					?>	    
					<thead>
						<tr>
															
							<th>Consultancy No.</th>
							<th>Title</th>
							<th>Posted On/ Edited On</th>
							<th>Revision Status</th>
							<th>Action</th>
							<th >Requested File</th>
							<th >View Links</th>
						</tr>

					</thead><?
					foreach($details as $row)
						{
							if($row->status==98)
							{
								$mod = $row->modification_value;
								$mod = $mod - 1;
								?>
								<tr>
									<td align="center"><? echo $row->consultancy_no; ?></td>
									<td align="center"><? echo $row->consultancy_title; ?></td>
									<td align="center"> <?=date('d M Y g:i a',strtotime($row->timestamp1))?> </td>
									<td align="center"><?if($mod <= 0){echo 'Original';}else{ echo 'revised '.$mod;}?> </td>
									<td align="center"><i class="fa fa-search" style="cursor:pointer; color:#C00;" onclick='myFunction("<?= $row->sr_no ?>")'></i>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_ajax/view_modal1/'.$row->sr_no.'/'.$auth_id ?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('Money receipt')
												->show();
												?>
										</a><br>
										<a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path?>" download="<?=$row->file_path?>">
											<?
											 $ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><br>
										<?/*?><a href="<?=base_url().'assets/files/consultant/disbursement/'.$row->file_path1?>" download="<?=$row->file_path1?>">
										<?
											$ui->button()->icon($ui->icon("download"))
												->mini()
												->uiType('primary')
												->value('statement of expentditure')
												->show();
										?></a><?*/?>
									</td>
									<td align="center">
										<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/ciview/'.$row->sr_no?>">
											  			<?
											  			$ui->button()->uiType('primary')->mini()->value('View Form')->show();
													?> </a><?
										if($mod > 0)
										{?>
											<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/view_disbursement_prev/'.$row->sr_no?>">
										  			<?
										  			$ui->button()->uiType('warning')->mini()->value('Prev')->show();

										  		?></a>
										<?}?>			
									</td>
								</tr>
							<?}
						}
				$table->close();
			$tab4->close();
		$tabBox1->close();
	$column2->close();
?>
<script type="text/javascript">
function myFunction(sr_no) {
        mywindow = window.open("<?php echo base_url() ?>index.php/consultant/consultant_disbursement_sheet/view_disbursement_action/" + sr_no,'_blank', "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=850, height=550"); 
      }
function Function(sr_no) {
        mywindow = window.open("<?php echo base_url() ?>index.php/consultant/consultant_disbursement_sheet/completed_link/" + sr_no,'_blank', "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=1000, height=700"); 
      } 
function myFunction2(sr_no,auth_id) {
	
	mywindow = window.open("<?php echo base_url() ?>index.php/consultant/consultant_ajax/view_modal/" + sr_no+ "/" + auth_id,'_blank', "toolbar=no, scrollbars=yes, resizable=no, top=50, left=300, width=1000, height=550");
       
      }            
</script>