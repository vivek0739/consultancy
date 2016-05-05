<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(3)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(6)->open();
	$table=$ui->table()->width(6)->open();
	?>
		<thead>
			<th>Time Of Acion</th>
			<th>Remark</th>
			<th>Type of Action</th>
		</thead>
	<?	
	foreach ($action as $key => $action) {
		if($action->status>=98)
		{
			?>
				<tr>
					<td>
						<? echo $action->timestamp; ?>
					</td>
					<td>
						<? echo $action->remark; ?>
					</td>
					<td>
						<?
						if($action->status==99)
						echo '<span class="label label-primary">Pending Disbursement form</span>';
						else if($action->status==98)
						echo '<span class="label label-danger">Canceled by Consultancy-in-charge</span>';
						else if($action->status==100)
						echo '<span class="label label-danger">Disbursement Form Rejeced by ' . $action->auth.'</span>';
						else if($action->status>=101 && $action->status <= 102 )
						echo '<span class="label label-warning">Disbursement Form Approved by '.$action->auth.'</span>';
						else if($action->status==103)
						echo '<span class="label label-success">Completed(Assistance Registarar)!</span>';

						?>
					</td>
				</tr>
			<?
		}	
	}
	$table->close();
	
	$column2->close();
