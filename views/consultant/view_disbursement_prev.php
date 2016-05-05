<?php
	
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();
	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file-o"))
				   ->title("Previous Versions of Consultancy Form With Title ")
				   ->tab("current", "Old Versions", true)
				   ->open();

			$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								<th>Consultancy Form Title</th>						
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								<th >Requested File</th>
								<th >View Links</th>
							</tr>
						</thead><?
					foreach($details as $row)
					{
						$mod = $row->modification_value;
								$mod = $mod - 1;
						?>
						<tr>
							<td align="center"><? echo $row->consultancy_title ?></td>
							<td align="center"><?=date('d M Y g:i a',strtotime($row->timestamp1))?></td>
							<td align="center"><?if($mod <= 0){echo 'Original';}else{ echo 'revised '.$mod;}?></td>
							<td align="center">
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
								<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/ciview_prev/'.$row->sr_no.'/'.$row->modification_value?>">
											  			<?
											  			$ui->button()->uiType('primary')->mini()->value('View Form')->show();
													?> </a>
							</td>
						</tr>
					<?}
					$table->close();
				
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>