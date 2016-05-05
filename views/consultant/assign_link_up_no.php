<?php

	$ui = new UI();
	$errors=validation_errors();
	if($errors!='')
		$this->notification->drawNotification('Validation Errors',validation_errors(),'error');


	$row1 = $ui->row()->open();

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
	
	
	$row1->close();
	$row = $ui->row()->open();
	$column1 = $ui->col()->width(1)->open();

	$column1->close();
	
	$column2 = $ui->col()->width(10)->open();
	
	
	$column1 = $ui->col()->width(2)->open();

	$column1->close();
	$column3 = $ui->col()->width(6)->open();

	$form = $ui->form()
			   ->action('consultant/consultant/assign_linkup_no/'.$sr_no)
	           ->extras('enctype="multipart/form-data"')
	           ->id('form_submit')
	           ->open();
	
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
		    ->value()
		    ->width(6)
		    ->show();
		    
		    $ui->input()
		    ->type('text')
		    ->label('Page No.<span style= "color:red;"> *</span>')
		    ->name('page_no')
		    ->required()
		    ->value()
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