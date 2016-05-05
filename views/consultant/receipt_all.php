<script type="text/javascript">
$('#')

</script>
<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width()->open();
	$column1->close();

	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->box()
				   ->icon($ui->icon("file-o"))
				   ->title("Send Receipt")
				   ->solid()
				   ->uiType('primary')
				   //->tab("current", "Current Circulars", true)
				   ->open();
	
			//$tab1 = $ui->tabPane()->id("current")->active()->open();
					$table = $ui->table()->hover()->bordered()->searchable()->paginated()
							    ->open();
?>
						<thead>
							<tr>
														
								<th> Title</th>
								<th> Payment No.</th>
								<th>Posted On/ Edited On</th>
								<th>Revision Status</th>
								
								
							    <th>Receipt</th>
							</tr>
						</thead>
<?php
			
					foreach($cons_row as $key => $cons_row1) 
					{
						if($cons_row1->status!=3)
						{
							?>						
						
						<tr>
									
									<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row1->consultancy_title?></td>
									<td align="center"><?=$cons_row1->payment_no?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row1->timestamp)+19800)?></td>
									
									<td align="center">
								<?php
									if ($cons_row1->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row1->modification_value.'</font>';
								?>
									</td>
								
									<td>
										
										  		<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/form3/'.$cons_row1->sr_no.'/'.$cons_row1->payment_no?>">
										  		
										  			<? 
										  			$ui->button()->icon($ui->icon('send'))->uiType('primary')->mini()->value('Send')->show(); ?>
									</td>
								</tr>
					<?
						
 						}
 					}
					$table->close();
				
		//$tab1->close();

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>