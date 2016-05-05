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
				->action('consultant/consultancy_proposal_approve/edit_form3_submit/'.$form2->sr_no.'/'.$form2->payment_no)
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
    	->value($data2->receipt_no)
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
			
			->width(6)
			->show();
    $ui->input()
    	->type('text')
    	->label('RS.')
    	->name('amount')
    	->id('amount')
    	->value($data2->amount)
    	->width(6)
    	
    	->show();
    $row1->close();

    $row1=$ui->row()->open();
        $coll=$ui->col()->width(4)->open();
    echo '<a href="'.base_url().'assets/files/consultant/RECEIPT/'.$data2->filepath.'" title=
            "download file" download="'.$data2->filepath.'">'.$data2->filepath.'</a>';
      $coll->close();
      $colll=$ui->col()->width(2)->open();
    $js = 'onclick="javascript:document.getElementById(\'filebox\').style.display=\'block\';"';
        $ui->button()->icon($ui->icon('refresh'))
      ->value('Change')
        ->uiType('primary')
        ->extras($js)
        ->mini()
        //->submit()
        ->show();
     

    $colll->close();
        $innercol2=$ui->col()->id('filebox')->extras('style="display:none"')->width(6)->open();

        
            $ui->input()
            ->label('Scan Copy of Receipt<span style= "color:red;"> *</span>')
              ->type('file')
              ->id('scope_path')
              ->name('scope_path')
              //->required()
              ->show();   

    echo"(Allowed Types: pdf, doc, docx, jpg, jpeg, png, xls, xlsx, csv and Max Size: 1.0 MB)";
     $innercol2->close();
      $ui->input()
       ->type('hidden')
       ->name('modification_value')
       ->required()
       ->value($data2->modification_value)
       ->show();
      $row1->close();
     
     
    

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
