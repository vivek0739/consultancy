<?php
	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$inputRow1 = $ui->row()->open();
	$column1 = $ui->col()->width(4)->open();

	$column1->close();
	$column2 = $ui->col()->width(4)->open();
	$box = $ui->box()
			  ->title('')
			  ->uiType('primary')
			  ->open();
	$inputRow2 = $ui->row()->open();
	$form = $ui->form()
			   ->action('consultant/service_tax/insert/')
	           ->extras('enctype="multipart/form-data"')
	           ->id('form_submit')
	           ->open();

	           $ui->input()
				    ->type('text')
				    ->label('Service Tax<span style= "color:red;"> *</span>')
				    ->name('service_tax')
				    ->required()
				    ->value()
				    ->width(12)
				    ->placeholder('e.g 14')
				    ->show();
			?> <center><?
				$ui->button()
			 	->width(12)
				->value('submit')
			    ->uiType('primary')
			    ->submit()
			    ->name('mysubmit')
			    ->show();
			?></center><?
			 
		$inputRow2->close();
	$form->close();
	$box->close();
	$column2->close();
	$inputRow1->close();
?>