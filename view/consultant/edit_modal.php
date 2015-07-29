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
	$box = $ui->box()
			  ->title('Title : '.$cons_row->consultancy_title)
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
			<th>Edit Estimate Form</th>
			<th>Request Letter</th>
		
		</thead>
	
			<tr>
				<td>
					<? echo $cons_row->sr_no; ?>
				</td>
				<td>
					<a href="<?=base_url().'index.php/consultant/edit_consultancy_form/edit_consultancy/'.$cons_row->sr_no?>"><? 
		  			echo '<span class="label label-success">Edit Consultancy Form</span>';

		  			?></a>
				</td>
				
				<td align="center">
		
					<a href="<?=base_url().'assets/files/information/circular/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>">
						<?echo '<span class="label label-primary">Download</span>';?>
				</td>
			</tr>
		<?

	$table->close();
	
	$col2->close();
				
	$row1->close();
	$row2=$ui->row()->open();
	echo '<br/>';
	$col2=$ui->col()->width(12)->open();
	echo '<i>Form2 & Form3</i><br/>';
	$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>Payment No.</th>
			<th>Edit Propsoal Form</th>
			<th>DD</th>
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
					<a href="<?=base_url().'index.php/consultant/consultancy_proposal_form/edit/'.$cons_row->sr_no.'/'.$action->payment_no?>">
		  			<? 
		  			echo '<span class="label label-success">Edit Form</span>';

		  			?></a>
				</td>
				
				<td align="center">
		
		<a href="<?=base_url().'assets/files/consultant/DD/'.$action->file_path?>" download="<?=$action->file_path?>">
			<span class="label label-primary">download</span></a>
		</td>
				<td align="center">
		
		<a href="<?=base_url().'assets/files/consultant/RECEIPT/'.$action->filepath?>" download="<?=$action->filepath?>">
			<span class="label label-primary">download</span></a>
		</td>
				
					
				
			</tr>
		<?
	}
	$table->close();
	
	$col2->close();
	$row2->close();
	$row1=$ui->row()->open();
	
	$col2=$ui->col()->width(12)->open();
	echo '<i>Form4</i><br/>';
	$table=$ui->table()->hover()->bordered()
								->sortable()
							    ->open();
	?>
		<thead>
			<th>Serial No.</th>
			<th>Edit Disbursement Form</th>
			<th>Expenditure</th>
		
		</thead>
	
			<tr>
				<td>
					<? echo $cons_row->sr_no; ?>
				</td>
				<td>
					<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/resubmit/'.$action->consultancy_no.'/'.$cons_row->sr_no?>"><? 
		  			echo '<span class="label label-success">Edit Consultancy Form</span>';

		  			?></a>
				</td>
				
				<td align="center">
		
					<a href="<?=base_url().'assets/files/information/circular/'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>">
						<?echo '<span class="label label-primary">Download</span>';?>
				</td>
			</tr>
		<?

	$table->close();
	
	$col2->close();
				
	$row1->close();
 	$box->close();
	?></div></center>
	<div class="modal-footer">
	</div>
	<?
$test_box->close();
$test_col->close();
$test_row->close();
?>