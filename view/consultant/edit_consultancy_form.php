<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width()->open();
	$column1->close();
	$column2 = $ui->col()->width(12)->open();
	$new_payment=$payment;
	
            $data_row = $ui->row()->id('data_row')->open();
            $data_row->close();
	
	$column2->close();
	$column2 = $ui->col()->width(12)->open();
		$tabBox1 = $ui->box()
				   ->icon($ui->icon("file"))
				   ->title("Your Consultancy Form")
				   ->solid()
				   ->uiType('primary')
				   //->tab("current", "Current Circulars", true)
				   ->open();
	$new_payment=$payment;
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
								<th >link</th>
								<th >Request file</th>
							    
							</tr>
						</thead>
<?php
					foreach($cons_row as $key => $cons_row) 
					{
?>
						<tr>
									
									<td class='col-md-4 col-lg-4 col-xs-4' align="center"><?=$cons_row->consultancy_title?></td>
									
									<td align="center"><?=date('d M Y g:i a',strtotime($cons_row->timestamp)+19800)?></td>
									
									<td align="center">
								<?php
									if ($cons_row->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised'.' '.$cons_row->modification_value.'</font>';
								?>
									</td>
									
									
									<td><i class="fa fa-link" style="cursor:pointer; color:#C00;" onclick='myFunction2("<?= $cons_row->sr_no ?>")'></i>
									</td>
									<td align="center">
									
									<a href="<?=base_url().'assets/files/consultant/form'.$cons_row->file_path?>" download="<?=$cons_row->file_path?>"><?=$ui->button()->icon($ui->icon("download"))->uiType('primary')->value('Download')->mini()->show();?></a>
									</td>
						</tr>
					<? }
					$table->close();
				
		//$tab1->close();

		$tabBox1->close();

	$column2->close();

	$outer_row->close();
?>
<script type="text/javascript">

function myFunction2(sr_no,auth_id) {
	
        $.ajax({
                url : site_url("consultant/consultant_ajax/edit_modal/" + sr_no),
                success : function(result){
                    if(result.length != false){
                        $('#data_row').html(result);
                    }
                },
                error : function(){
                    alert('some thing went wrong. please report');
                }
            });
       
      } 
</script>