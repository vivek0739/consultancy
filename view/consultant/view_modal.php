<script>
$(document).ready(function() {
    $('#data_dialog_fade').modal('show');
});
</script>
<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 2 july 2015
*/

	$ui = new UI();
	$test_row = $ui->row()->classes('modal fade')->id('data_dialog_fade')->open();
	$test_col = $ui->col()->classes('modal-dialog modal-lg')->id('data_dialog_dialog')->open();
	$test_box = $ui->box()->classes('modal-content')->id('data_dialog_content')->open();
?>

<div class="modal-body">
<center>
<?php
	
	
	$box=$ui->box()
			
			->title('Title - '.$cons_row->consultancy_title)
			->solid() 
			->uiType('primary')
			->open();
	$row1=$ui->row()->open();
	$col2=$ui->col()->width(12)->open();
	
	echo '<i>Form1</i><br/>';
	$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>Serial No.</th>
			<th>View Estimate Form</th>
			<th>Prev. Version Estimate Form</th>
			<th>Scope of Work</th>
			<th>Request Letter</th>
		
		</thead>
	
			<tr>
				<td>
					<? echo $cons_row->sr_no; ?>
				</td>
				<td>
					<a href="<?=base_url().'index.php/consultant/consultant/view_consultancy_form_hod/'.$cons_row->sr_no.'/'.$auth_id?>">
						<span class="label label-success">view Estimate Form</span></a>
				</td>
				
				
				<td align="center">
		
				<?	$col2=$ui->col()->width(6)->open();
	if ($cons_row->modification_value != 0)
									{
									?>
										  		
										  		<a href="<?=base_url().'index.php/consultant/consultant/view_consultancy_prev/'.$cons_row->sr_no.'/'.$auth_id?>">
										  			<span class="label label-warning">view Previous Version</span></a><?
									}	
    $col2->close();	?>
				</td>
				<td align="center">
		
					<a href="<?=base_url().'assets/files/consultant/SCOPE_WORK/'.$cons_row->scope_work?>" download="<?=$cons_row->scope_work?>">
						<span class="label label-primary">
							Download</span></a>
	
				</td>
				<td align="center">
		
					<a href="<?=base_url().'assets/files/consultant/form/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>">
						<span class="label label-primary">
							Download</span></a>
	
				</td>
			</tr>
		<?

	$table->close();
	
	$col2->close();
				
	$row1->close();
	$row2=$ui->row()->open();
	echo '<br/><i>Form2 & Form3</i><br/>';
	echo '<br/>';
	$col2=$ui->col()->width(12)->open();
	$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>Payment No.</th>
			<th>View Propsoal Form</th>
			<th>View Previous Version.</th>
			
			<th>DD</th>
			<th>View Receipt</th>
			<th>Previous Receipt</th>
			<th>Cash Receipt</th>
		</thead>
	<?

	foreach ($form2 as $key => $action) {
		?>
			<tr>
				<td>
					<? echo $action->payment_no; ?>
				</td>
				<td>
					<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/index/'.$cons_row->sr_no.'/'.$action->payment_no.'/'.$auth_id?>">
		  			<? 
		  			echo '<span class="label label-success">view Form</span>';

		  			?></a>
				</td>
				<td>
					<?
					if ($action->modification_value != 0)
									{
									?>
										  		
										  		<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/view_proposal_prev/'.$cons_row->sr_no.'/'.$action->payment_no.'/'.$auth_id?>">
										  			<?
										  			echo '<span class="label label-warning">previous Proposal form</span>';

										  		?></a><?
									}	
					?>
					
				</td>
				<td align="center">
		
		<a href="<?=base_url().'assets/files/consultant/DD/'.$action->file_path?>" download="<?=$action->file_path?>"><span class="label label-primary">download</span></a>
		</td>
				<td>
					<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/view_receipt/'.$cons_row->sr_no.'/'.$action->payment_no?>">
		  			<? 
		  			echo '<span class="label label-success">view Receipt Form</span>';

		  			?></a>
				</td>
				<td>
					<?
					if ($action->modv!= 0)
									{
									?>
										  		
										  		<a href="<?=base_url().'index.php/consultant/consultancy_proposal_approve/view_receipt_prev/'.$cons_row->sr_no.'/'.$action->payment_no?>">
										  			<?
										  			echo '<span class="label label-warning">previous Receipt</span>';

										  		?></a><?
									}	
					?>
					
				</td>
				<td align="center">
		
		<a href="<?=base_url().'assets/files/consultant/RECEIPT/'.$action->filepath?>" download="<?=$action->filepath?>"><span class="label label-primary">download</span></a>
		</td>
				
					<?
					/*if($action->status==0)
					echo '<span class="label label-primary">Pending estimate form</span>';
					else if($action->status==1)
					echo '<span class="label label-danger">Canceled by Consultancy-in-charge</span>';
					else if($action->status==2)
					echo '<span class="label label-danger">Estimated Form Rejeced by ' . $action->auth.'</span>';
					else if($action->status>=3 && $action->status <= 5 )
					echo '<span class="label label-warning">Estimated Form Approved by '.$action->auth.'</span>';
					else if(($action->status-5)%3==0 )
					echo '<span class="label label-primary">Pending Proposal Form</span>';
					else if($action->status==7)
					echo '<span class="label label-success">Completed!</span>';
					else if(($action->status-7)%3==0)
					echo '<span class="label label-warning">Proposal Form Approved By Pce</span>';
					else if(($action->status-6)%3==0)
					echo '<span class="label label-danger">Proposal Form Rejected By Pce</span>';
*/
					?>
				
			</tr>
		<?
	}
	$table->close();
	$col2->close();
	$row2->close();
	
	
	$row2=$ui->row()->open();
	$col1=$ui->col()->width(12)->open();

	 if($auth_id=='pce' && $cons_row->status!=7 && $cons_row->status>=5)
		 {
		 	echo '<br/>';
			?>
			<a href="<?=base_url().'index.php/consultant/consultancy_proposal_form/done/'.$cons_row->sr_no?>">
				<?=$ui->button()->icon($ui->icon("check"))->mini()->uiType('success')->value('Done')->show();?></a>
												

									<? 
									
		 }

    $col1->close();
    $row2->close();
 	$box->close();
	?></div></center>
	<div class="modal-footer">
	</div>
	<?
$test_box->close();
$test_col->close();
$test_row->close();
?>
