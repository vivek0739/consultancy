<?php

	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');


	$row1 = $ui->row()->open();

	
	
	
	$row1->close();
	$row = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(10)->open();
	
	
	$column1 = $ui->col()->width(2)->open();

	$column1->close();
	$column3 = $ui->col()->width(6)->open();

	$form = $ui->form()
			   ->action('consultant/consultant/edit_linkup_no/'.$sr_no)
	           ->extras('enctype="multipart/form-data"')
	           ->id('form_submit')
	           ->open();
	//print_r($result);
	$CI_box = $ui->box()
				 ->title('ASSIGN')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();

			$ui->input()
		    ->type('text')
		    ->label('Link Up No.<span style= "color:red;"> *</span>')
		    ->name('link_up_no')
		    ->required()
		    ->value($result->link_up_no)
		    ->width(6)
		    ->show();
		    
		    $ui->input()
		    ->type('text')
		    ->label('Page No.<span style= "color:red;"> *</span>')
		    ->name('page_no')
		    ->required()
		    ->value($result->page_no)
		    ->width(6)
		    ->show(); 
		    ?><center><?
		    	 $ui->button()
					->value('submit')
				    ->uiType('primary')
				    ->submit()
				    ->name('submit')
				    ->show();
		   ?> </center><?
		   
 	 
	$CI_box->close();
	$form->close();
	$column3->close();
	
	$column2->close();
	$row->close();