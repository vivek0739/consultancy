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
        ->title('Generate Receipt')
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
    	->value()
    	->width(6)
    	
    	->show();
    $row1->close();
    $row1=$ui->row()->open();
    $ui->datePicker()
			->name('dated')
		    ->label('Dated<span style= "color:red;"> *</span>')			
			//->extras(min='date("Y-m-d")')
			->value(date("Y-mm-dd"))
			->dateFormat('yyyy-mm-dd')
			
			->width(6)
			->show();
    $ui->input()
    	->type('text')
    	->label('RS.')
    	->name('amount')
    	->id('amount')
    	->value($form2->dd_cheque_amt)
    	->width(6)
    	
    	->show();
    $row1->close();
    $inputRow6 = $ui->row()->open();
	$innercol2=$ui->col()->width(12)->open();
        $ui->input()
          ->label('Scan Copy Of Receipt')
            ->type('file')
            ->name('scope_path')
            ->required()
            
            ->show();

    echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
   
     	$innercol2->close();
     
     $inputRow6->close();
    

    ?><center><br/>
<?php
	 $ui->button()
		->value('submit')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();
	$box->close();
    $form->close();
	$column2->close();
	$row->close();
