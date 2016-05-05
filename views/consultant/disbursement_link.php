<?php
	
	$ui = new UI();
	$column1 = $ui->col()->width(0)->open();
	$column1->close();
	$column2 = $ui->col()->width(12)->open();
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
															
							<th width=25% align='center'>Disbursement Sheet</th>
							<th width=25% align='center'>Details of Consultants members</th>
							<th width=25% align='center'>Details of Supporting Staff</th>
							<th width=25% align='center'>Consultancy Memo</th>
						</tr>
					</thead>
					<tr>
						<td align='center'>
							<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/disbursement_form1/'.$sr_no?>">
											<?
												$ui->button()->uiType('primary')->mini()->value('Disbursement Sheet')->show();
											?></a>
						</td>
						<td align='center'>
							<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/disbursement_form2/'.$sr_no?>">
											<?
												$ui->button()->uiType('primary')->mini()->value('Faculty Members')->show();
											?></a>
						</td>
						<td align='center'>
							<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/disbursement_form3/'.$sr_no?>">
											<?
												$ui->button()->uiType('primary')->mini()->value('Supporting Staff')->show();
											?></a>
						</td>
						<td align='center'>
							<a href="<?=base_url().'index.php/consultant/consultant_disbursement_sheet/disbursement_form4/'.$sr_no?>">
											<?
												$ui->button()->uiType('primary')->mini()->value('Consultancy Memo')->show();
											?></a>
						</td>
					</tr>
					<?
	$column2->close();
?>