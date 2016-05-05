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
			   ->action('consultant/consultancy_proposal_form/choice/'.$sr_no)
	           ->extras('enctype="multipart/form-data"')
	           ->id('form_submit')
	           ->open();
	
	$CI_box = $ui->box()
				 ->title('CHOICE OF PAYMENT')
			     ->solid()	
			  	 ->uiType('primary')
			  	 ->open();

			  $innercol1=$ui->col()->width(12)->open();
					                    $ui->select()
					                    ->label('Type of Payment')
					                      ->name('choice')
					                      ->id("choice")
					                      ->options(array(
					                          $ui->option()->value(0)->text('Without Money Detalis'),
					                          $ui->option()->value(1)->text('With Money Detalis')->selected()))
					                
					                    //->required()
					                        ->show();
					                       $innercol1->close();
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