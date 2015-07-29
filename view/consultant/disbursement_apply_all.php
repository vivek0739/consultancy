<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width()->open();
	$column1->close();

	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->box()
				   ->icon($ui->icon("file"))
				   ->title("Your Consultancy Form")
				   ->solid()
				   ->uiType('primary')
				   //->tab("current", "Current Circulars", true)
				   ->open();
	$outer_row = $ui->row()->open();
			//$tab1 = $ui->tabPane()->id("current")->active()->open();
					$table = $ui->table()->hover()->bordered()
								->sortable()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>
														
								<th> Title</th>
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								
								
							    <th>Disbursement Form</th>
							</tr>
						</thead>
<?php
					foreach($cons_row as $key => $cons_row) 
					{
						if($cons_row->status==7){
							?>						
						<tr>
									
									<td align="center"><?=$cons_row->consultancy_title?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
									
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									
									
									<td>
										
										  		<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/disbursement/'.$cons_row->sr_no.'/ft'?>">
										  		
										  			<? 
										  			$ui->button()->uiType('primary')->value('Apply')->show(); 
										  
									?>
								</tr>
					<?
						}
 }
					$table->close();
				
		//$tab1->close();
	    $outer_row->close();
		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>