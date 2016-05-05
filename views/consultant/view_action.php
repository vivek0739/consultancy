<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 19 june 2015
*/

	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(6)->open();
	$table=$ui->table()->hover()->bordered()
							    ->open();
	?>
		<thead>
			<th>Time Of Acion</th>
			<th>Remark</th>
			<th>Type of Action</th>
		</thead>
	<?
	foreach ($action as $key => $action) {
		?>
			<tr>
				<td>
					<?=date('d M Y g:i a',strtotime($action->timestamp)+19800); ?>
				</td>
				<td class='col-md-4 col-lg-4 col-xs-4'>
					<? echo $action->remark; ?>
				</td>
				<td>
					<?
					if($action->status==0)
					echo '<span class="label label-primary">Pending estimate form</span>';
					else if($action->status==1||$action->status==98)
					echo '<span class="label label-danger">Canceled by Consultancy-in-charge</span>';
					else if($action->status==2)
					echo '<span class="label label-danger">Estimated Form Rejeced by ' . $action->auth.'</span>';
					else if($action->status==3 )
					echo '<span class="label label-warning">Estimated Form Forwarded by '.$action->auth.'</span>';
				 	else if($action->status==7)
					echo '<span class="label label-success">Payment Completed!</span>';
				 	else if($action->status==99 )
					echo '<span class="label label-primary">Pending Disbursement Form</span>';
				 	else if($action->status==100 )
					echo '<span class="label label-danger">Disbursement Form Rejected by '.$action->auth.'</span>';
				 	else if($action->status==101||$action->status==102||$action->status==103)
					echo '<span class="label label-success">Disbursement Form Approved by '.$action->auth.'</span>';
					else if($action->status==104 )
					echo '<span class="label label-primary">Pending Project Account Form</span>';
					else if($action->status==105 )
					echo '<span class="label label-danger">Project Account Form Rejected by '.$action->auth.'</span>';
					else if($action->status==106 )
					echo '<span class="label label-warning">Project Account Form recommended to Director by PCE</span>';
				    else if($action->status==107||$action->status==108)
					echo '<span class="label label-success">Project Account Form Approved by '.$action->auth.'</span>';
				 	
					else if($action->status>=4 && $action->status <= 5 )
					echo '<span class="label label-warning">Estimated Form Approved by '.$action->auth.'</span>';
					else if(($action->status-4)%4==0 )
					echo '<span class="label label-primary">Pending Proposal Form</span>';
					else if($action->status==7)
					echo '<span class="label label-success">Completed!</span>';
					else if(($action->status-6)%4==0)
					echo '<span class="label label-warning">Proposal Form Approved By Pce</span>';
					else if(($action->status-5)%4==0)
					echo '<span class="label label-danger">Proposal Form Rejected By Pce</span>';
					else if(($action->status-7)%4==0)
					echo '<span class="label label-warning">ISM Cash Receipt has been Generated</span>';

					?>
				</td>
			</tr>
		<?
	}
	$table->close();
	$row2=$ui->row()->noPrint()->open();
	 $col2= $ui->col()->width(6)->open();
           $ui->printButton()->noPrint()
           	  ->uiType('primary')
           	  
           	  ->id('print_button')
           	  ->show();
    $col2->close();
 $row2->close();
	$column2->close();
