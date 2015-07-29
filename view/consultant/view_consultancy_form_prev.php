<?php
	
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Previous Versions of Consultancy Form With Title - ".$cons_row[0]->consultancy_title)
				   ->tab("current", "Old Versions", true)
				   ->open();

			$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								
														
								<th>Applied On/ Edited On</th>
								<th>Revision Status</th>
								
								<th >Request Letter</th>
								<th >Scope of Work</th>	
								<th >View Links</th>
							</tr>

						</thead>
<?php
					foreach($cons_row as $key => $cons_row) 
					{
?>
						<tr>
									
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
								
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->scope_work?>" download="<?=$cons_row->scope_work?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
									<td>
									  		
										  		<a href="<?=base_url().'index.php/consultant/consultant/view_consultancy_form_prev_one/'.$cons_row->sr_no.'/'.$cons_row->modification_value.'/'.$auth_id?>"><?=$ui->button()->uiType('primary')->mini()->value('View Form')->show(); ?> </a>
								<?php 
									
									echo'</td>
								</tr>';
					}
					$table->close();
				
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
