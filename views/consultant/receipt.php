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
	$col1=$ui->col()->width(12)->open();
    $action = $action_recent;
    echo '<span style="color:red"> Last Activity : ';
    if($action->status==0)
          echo 'Pending estimate form';
          else if($action->status==1||$action->status==98)
          echo 'Canceled by Consultancy-in-charge';
          else if($action->status==2)
          echo 'Estimated Form Rejeced by ' . $action->auth.'';
          else if($action->status==3 )
          echo 'Estimated Form Forwarded by '.$action->auth.'';
          else if($action->status==7)
          echo 'Payment Completed!';
          else if($action->status==99 )
          echo 'Pending Disbursement Form';
          else if($action->status==100 )
          echo 'Disbursement Form Rejected by '.$action->auth.'';
          else if($action->status==101||$action->status==102||$action->status==103)
          echo 'Disbursement Form Approved by '.$action->auth.'';
          else if($action->status==104 )
          echo 'Pending Project Account Form';
          else if($action->status==105 )
          echo 'Project Account Form Rejected by '.$action->auth.'';
          else if($action->status==106 )
          echo 'Project Account Form recommended to Director by PCE';
            else if($action->status==107||$action->status==108)
          echo 'Project Account Form Approved by '.$action->auth.'';
          
          else if($action->status>=4 && $action->status <= 5 )
          echo 'Estimated Form Approved by '.$action->auth.'';
          else if(($action->status-4)%4==0 )
          echo 'Pending Proposal Form';
          else if($action->status==7)
          echo 'Completed!';
          else if(($action->status-6)%4==0)
          echo 'Proposal Form Approved By Pce';
          else if(($action->status-5)%4==0)
          echo 'Proposal Form Rejected By Pce';
          else if(($action->status-7)%4==0)
          echo 'ISM Cash Receipt has been Generated';

         
    echo ' ('.date('d M Y g:i a',strtotime($action_recent->timestamp)+19800).') </span>';
    $col1->close();
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
