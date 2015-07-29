<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 2 july 2015
*/

	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$form = $ui->form()
				->action('consultant/consultancy_proposal_approve/form3_submit/'.$form2->sr_no.'/'.$form2->payment_no)
				->extras('enctype="multipart/form-data"')->id('form_submit')->open();
	$box = $ui->box()
        ->title('Receipt')
        ->solid() 
        ->uiType('primary')
        ->open();
    $row1=$ui->row()->open();
    $ui->input()
    	->type('text')
    	->label('Consultancy / Assignment No.')
    	->name('cons')
    	->id('cons')
    	->value($form2->consultancy_no)
    	->width(6)
    	->disabled()
    	->show();
    $ui->input()
    	->type('text')
    	->label('ISM Cash Receipt No.')
    	->name('receipt_no')
    	->id('receipt_no')
    	->value($data2->receipt_no)
      ->disabled()
    	->width(6)
    	
    	->show();
    $row1->close();
    $row1=$ui->row()->open();
    $ui->datePicker()
			->name('dated')
		    ->label('Dated<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value($data2->timestamp)
			->dateFormat('yyyy-mm-dd')
			->disabled()
			->width(6)
			->show();
    $ui->input()
    	->type('text')
    	->label('RS.')
    	->name('amount')
    	->id('amount')
    	->value($data2->amount)
      ->disabled()
    	->width(6)
    	
    	->show();
    $row1->close();
    $inputRow6 = $ui->row()->open();
	$innercol2=$ui->col()->width(3)->open();
      $ui->input()
         ->type('hidden')
         ->label('Scan Copy of Receipt')
          ->show();
       $innercol2->close();
      $innercol2=$ui->col()->width(9)->open();
      echo '<a href="'.base_url().'assets/files/consultant/RECEIPT/'.$data2->filepath.'" title=
            "download file" download="'.$data2->filepath.'">'.$data2->filepath.'</a>';
      $innercol2->close();
     
     $inputRow6->close();
    
   $row2=$ui->row()->noPrint()->open();
   $col2= $ui->col()->width(12)->open();
   echo '<br/><center>';
           $ui->printButton()->noPrint()
              ->uiType('primary')
              
              ->id('print_button')
              ->show();
    $col2->close();
 $row2->close();
	$box->close();
    $form->close();
	$column2->close();
	$row->close();
