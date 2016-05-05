<?php
	
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();
	$column2 = $ui->col()->width(10)->open();
		$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("file"))
				   ->title("Previous Versions of Payment No. - ".$details[0]->payment_no)
				   ->tab("current", "Old Versions", true)
				   ->open();

			$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>							
								
								
								<th>Revision Status</th>
								
								<th >Scan Copy of DD/Cheque/Transection</th>
								<th >Scope of Consultancy</th>	
								<th >View Links</th>
							</tr>

						</thead>
<?php
					foreach($details as $key => $cons_row) 
					{
?>
						<tr>
									
								<td>	
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/DD/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/SCOPE_CONSULT/'.$cons_row->scope_consultancy?>" download="<?=$cons_row->scope_consultancy?>"><?=$ui->button()->icon($ui->icon("download"))->mini()->uiType('primary')->value('Download')->show();?></a>
									</td>
									<td>
									  		
										  		<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/view_proposal_form_prev_one/'.$cons_row->sr_no.'/'.$cons_row->payment_no.'/'.$cons_row->modification_value?>"><?=$ui->button()->uiType('primary')->mini()->value('View Form')->show(); ?> </a>
								<?php 
									echo'</td>
								</tr>';
					}
					$table->close();
				
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
