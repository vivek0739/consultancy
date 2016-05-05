<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class stdObject {
    public function __construct(array $arguments = array()) {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }
 }

class Consultancy_proposal_form extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
        //$this->emp_id = $this->session->userdata('id');
        $this->addJS("consultant/consultancy_proposal.js");
        $this->load->model('consultant/consultancy_proposal_form_model','',TRUE);
         $this->load->model('consultant/consultant_form','',TRUE);
        $this->load->model('consultant/consultant_help_model','',TRUE);
         $this->load->model('consultant/consultancy_proposal_approve_model','',TRUE);
	}
	public function choice($sr_no)
	{
		$this->drawHeader("");
		$this->load->helper(array('form', 'url'));


		$this->load->library('form_validation');
		$this->form_validation->set_rules('choice', 'Type of Payment', 'required');
		$data['sr_no']=$sr_no;
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('consultant/consultancy_proposal_choice',$data);	
		}
		else
		{
			$choice=$this->input->post('choice');
			if($choice==1)
			{

				redirect('consultant/consultancy_proposal_form/index/'.$sr_no);
			}
			else
			{
				redirect('consultant/consultancy_proposal_form/index_without/'.$sr_no);
			}
		}
		
	}
	public function index($sr_no,$auth_id='')
	{
		/*$pos=strrpos($auth_id,"DA1");
		if($auth_id =='' || ($auth_id !='hod' && $auth_id !='dt' && $auth_id !='dsw' && $auth_id !='est_ar' && $auth_id !='exam_dr'
			&& $auth_id !='admin' && $auth_id !='hos' && $auth_id !='hoc' && $pos == FALSE))
		{
			$this->session->set_flashdata('flashError','Acccess Denied!'.$auth_id);
			redirect('home');
		}*/
		$this->load->helper(array('form', 'url'));


		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firm_name', 'Firm Name', 'required');
		$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required');
		$this->form_validation->set_rules('client_designation', 'Designation', 'required');
		$this->form_validation->set_rules('client_address', 'Address', 'required');
		$this->form_validation->set_rules('client_city', 'City', 'required');
		$this->form_validation->set_rules('client_pin', 'Pin', 'required');
		$this->form_validation->set_rules('client_phone_no', 'Phone No', 'required');
		$this->form_validation->set_rules('client_extn', 'Extn', 'required');
		$this->form_validation->set_rules('client_fax', 'Fax', 'required');
		$this->form_validation->set_rules('client_email', 'Email', 'required');

		
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('weeks', 'Weeks', 'required');
		$this->form_validation->set_rules('days', 'Days', 'required');

		$this->form_validation->set_rules('total_value_fig', 'Total Value(in figure)', 'required');
		$this->form_validation->set_rules('total_value_words', 'Total Value(in words)', 'required');
		$this->form_validation->set_rules('bank_name', 'Bank Name and Branch', 'required');
		$this->form_validation->set_rules('dd_cheque_no', 'DD/Cheque No.', 'required');
		$this->form_validation->set_rules('dd_cheque_amount', 'DD/Cheque Amount', 'required');
	


		$this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Form");

		if ($this->form_validation->run() == FALSE)
		{
			$id_user = $this->session->userdata('id');
			
			$data['details'] = $this->consultancy_proposal_form_model->get_default($id_user);
			//for linkup no.
			$data['result']=$this->consultant_form->get_link_up_no($sr_no); 
			$data['cons_row']=$this->consultant_form->getdetail($sr_no);
			if($data['cons_row']->status==7)
			{

				$this->session->set_flashdata('flashError','Proposal Form has been completed.');
				redirect('home');
			}
			//print_r($data['cons_row']);
				//
				// $data['id']->consultancy_no-=1;
				
				$data['payment_no']=$this->consultancy_proposal_form_model->get_max_payment_no($sr_no);
				$consultancy=$this->consultancy_proposal_form_model->is_payment($sr_no);
				$data['id']=$consultancy;
			if(isset($data['payment_no']->payment_no))
			{
				
				
				$data['client']=$this->consultancy_proposal_approve_model->get_default($sr_no,$data['payment_no']->payment_no);
				
			}
			else
			{
				$data['payment_no']->payment_no = 0;
				//print_r($data['payment_no']);
			}
			
			
			$this->load->view('consultant/consultancy_proposal_form',$data);
		}
		else
		{
			$this->db->trans_start();
			$date = date("Y-m-d H:i:s");
			$payment_no=$this->input->post('payment_no');
			$upload=$this->upload_file('scope_path',$this->input->post('sr_no'));
			if($upload)
            {
		            $consultancy_no=$this->input->post('cons');
					$data1 = array('sr_no'=>$this->input->post('sr_no'),
								  'firm_name'=>$this->input->post('firm_name'),
								  'person_name'=>$this->input->post('contact_person_name'),
								  'designation'=>$this->input->post('client_designation'),
								  'address'=>$this->input->post('client_address'), 
								  'city'=>$this->input->post('client_city'),
								  'pincode'=>$this->input->post('client_pin'),
								  'contact_no'=>$this->input->post('client_phone_no'),
								  'extn'=>$this->input->post('client_extn'),
								  'fax'=>$this->input->post('client_fax'),
								  'modification_value'=>0,
								  'email'=>$this->input->post('client_email'),
								  );
					
					$data4 = array('consultancy_no'=>$consultancy_no,
									'payment_no'=>$this->input->post('payment_no'),
									'sr_no'=>$this->input->post('sr_no'),
									'file_path'=>$upload['file_name'],
								  	'year'=>$this->input->post('year'),
								  	'month'=>$this->input->post('month'),
								  	'week'=>$this->input->post('weeks'), 
								  	'days'=>$this->input->post('days'),
								  	'timestamp'=>$this->input->post('starting_date'),
								  	'payment_mode'=>$this->input->post('payment'),
								  	'currency'=>$this->input->post('currency'),
								  	'currency_type'=>$this->input->post('currency_type'),
								  	'payment_enclosed'=>$this->input->post('payment_enclosed'),
								  	'value_fig'=>$this->input->post('total_value_fig'), 
								  	'value_word'=>$this->input->post('total_value_words'),
								  	'bank_name'=>$this->input->post('bank_name'),
								  	'dd_cheque_no'=>$this->input->post('dd_cheque_no'),
								  	'dd_cheque_amt'=>$this->input->post('dd_cheque_amount'),
								  	'dd_cheque_date'=>$this->input->post('dd_cheque_date'),
								  	'scope_consultancy'=>$this->input->post('scope_consultancy1'),
								  	'status'=>0,
								  	'modification_value'=>0,
								  	'date'=>$date,
								  	'correspondence'=>$this->input->post('correspondence'),
								  );
					 if($_FILES['scope_consultancy']['name'] != '')
					 {
					 	$upload_scope=$this->upload_scope('scope_consultancy',$this->input->post('sr_no'),$payment_no);
       	    			if($upload_scope) $data4['scope_consultancy']=$upload_scope['file_name'];
					
					 }
					$data5 = array('sr_no' => $this->input->post('sr_no'),
								   'product_development' => $this->input->post('testing1'),
								   'process_development' => $this->input->post('testing2'),
								   'checking_of_design' => $this->input->post('testing3'),
								   'checking_of_analysis' => $this->input->post('testing4'),
								   'report_writing' => $this->input->post('testing5'),
								   'testing' => $this->input->post('testing6'),
								   'hrd' => $this->input->post('testing7'),
								   'computation' => $this->input->post('testing8'),
								   'advice' => $this->input->post('testing9'),
								   'other' => $this->input->post('testing10'),
								   'modification_value' => 0,
								    );
					$data6 = array('sr_no' => $this->input->post('sr_no'),
								   'private_sector' => $this->input->post('client1'),
								   'govt_sector' => $this->input->post('client2'),
								   'public_sector' => $this->input->post('client3'),
								   'funding_agency' => $this->input->post('client4'),
								   'foreign_organisation' => $this->input->post('client5'),
								   'other_client' => $this->input->post('client6'),
								   'modification_value' => 0,
								    );
				
					//$this->consultancy_proposal_form_model->insert($data1,$data2,$data3);
					
					$data['cons_row']=$this->consultant_form->getdetail($sr_no);
					$status=$payment_no*4+4;

					//these function insert the data into table
					$this->consultancy_proposal_form_model->insert1($data1,$data4,$payment_no);
					$this->consultancy_proposal_form_model->insertType($data5,$data6,$payment_no);
					$this->add_action($data4['sr_no'],$this->session->userdata('id') .
							' has submitted the proposal form',$status,'c_i' );
		            
		            //notification 
		            $description1= $this->session->userdata("id")." has submitted proposal form with payment no . ".
		            				$data4['payment_no']. ' and title '
		            			.$data['cons_row']->consultancy_title.'.';

		       	    $title1 = "check the status.";
		         	$link1 = "consultant/consultancy_proposal_approve/index/".$data4['sr_no'].'/'.$data4['payment_no'].'/pce';
		         	$id=$this->consultant_help_model->get_pce();
		            $this->notification->notify($id,"pce",$title1,$description1,$link1,"");
		            $this->consultancy_proposal_form_model->insert_mode_payment($sr_no,1);
		        	$this->db->trans_complete();
		        	//redirection
		        	$this->session->set_flashdata('flashSuccess','Proposal Form has been successfully submited.');
					redirect('home');
			}
		}
		$this->drawFooter();
}
function index_without($sr_no,$auth_id="")
{
		$this->load->helper(array('form', 'url'));


		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firm_name', 'Firm Name', 'required');
		$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required');
		$this->form_validation->set_rules('client_designation', 'Designation', 'required');
		$this->form_validation->set_rules('client_address', 'Address', 'required');
		$this->form_validation->set_rules('client_city', 'City', 'required');
		$this->form_validation->set_rules('client_pin', 'Pin', 'required');
		$this->form_validation->set_rules('client_phone_no', 'Phone No', 'required');
		$this->form_validation->set_rules('client_extn', 'Extn', 'required');
		$this->form_validation->set_rules('client_fax', 'Fax', 'required');
		$this->form_validation->set_rules('client_email', 'Email', 'required');

		
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('weeks', 'Weeks', 'required');
		$this->form_validation->set_rules('days', 'Days', 'required');

	


		$this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Form");

		if ($this->form_validation->run() == FALSE)
		{
			$id_user = $this->session->userdata('id');
			
			$data['details'] = $this->consultancy_proposal_form_model->get_default($id_user);
			//for linkup no.
			$data['result']=$this->consultant_form->get_link_up_no($sr_no); 
			$data['cons_row']=$this->consultant_form->getdetail($sr_no);
			// if($data['cons_row']->status==7)
			// {

			// 	$this->session->set_flashdata('flashError','Proposal Form has been completed.');
			// 	redirect('home');
			// }
			//print_r($data['cons_row']);
				//
				// $data['id']->consultancy_no-=1;
				
				$data['payment_no']=$this->consultancy_proposal_form_model->get_max_payment_no($sr_no);
				$consultancy=$this->consultancy_proposal_form_model->is_payment($sr_no);
				$data['id']=$consultancy;
			if(isset($data['payment_no']->payment_no))
			{
				
				
				$data['client']=$this->consultancy_proposal_approve_model->get_default($sr_no,$data['payment_no']->payment_no);
				
			}
			else
			{
				$data['payment_no']->payment_no = 0;
				//print_r($data['payment_no']);
			}
			
			
			$this->load->view('consultant/consultancy_proposal_form_without',$data);
		}
		else
		{
			$this->db->trans_start();
			$date = date("Y-m-d H:i:s");
			$payment_no=$this->input->post('payment_no');
			
		            $consultancy_no=$this->input->post('cons');
					$data1 = array('sr_no'=>$this->input->post('sr_no'),
								  'firm_name'=>$this->input->post('firm_name'),
								  'person_name'=>$this->input->post('contact_person_name'),
								  'designation'=>$this->input->post('client_designation'),
								  'address'=>$this->input->post('client_address'), 
								  'city'=>$this->input->post('client_city'),
								  'pincode'=>$this->input->post('client_pin'),
								  'contact_no'=>$this->input->post('client_phone_no'),
								  'extn'=>$this->input->post('client_extn'),
								  'fax'=>$this->input->post('client_fax'),
								  'modification_value'=>0,
								  'email'=>$this->input->post('client_email'),
								  );
					
					$data4 = array('consultancy_no'=>$consultancy_no,
									'payment_no'=>$this->input->post('payment_no'),
									'sr_no'=>$this->input->post('sr_no'),
									'file_path'=>"",
								  	'year'=>$this->input->post('year'),
								  	'month'=>$this->input->post('month'),
								  	'week'=>$this->input->post('weeks'), 
								  	'days'=>$this->input->post('days'),
								  	'timestamp'=>$this->input->post('starting_date'),
								  	'payment_mode'=>$this->input->post('payment'),
								  	'currency'=>$this->input->post('currency'),
								  	'currency_type'=>$this->input->post('currency_type'),
								  	'payment_enclosed'=>$this->input->post('payment_enclosed'),
								  	'value_fig'=>$this->input->post('total_value_fig'), 
								  	'value_word'=>$this->input->post('total_value_words'),
								  	'bank_name'=>$this->input->post('bank_name'),
								  	'dd_cheque_no'=>$this->input->post('dd_cheque_no'),
								  	'dd_cheque_amt'=>$this->input->post('dd_cheque_amount'),
								  	'dd_cheque_date'=>$this->input->post('dd_cheque_date'),
								  	'scope_consultancy'=>$this->input->post('scope_consultancy1'),
								  	'status'=>0,
								  	'modification_value'=>0,
								  	'date'=>$date,
								  	'correspondence'=>$this->input->post('correspondence'),
								  );
					 if($_FILES['scope_consultancy']['name'] != '')
					 {
					 	$upload_scope=$this->upload_scope('scope_consultancy',$this->input->post('sr_no'),$payment_no);
       	    			if($upload_scope) $data4['scope_consultancy']=$upload_scope['file_name'];
					
					 }
					$data5 = array('sr_no' => $this->input->post('sr_no'),
								   'product_development' => $this->input->post('testing1'),
								   'process_development' => $this->input->post('testing2'),
								   'checking_of_design' => $this->input->post('testing3'),
								   'checking_of_analysis' => $this->input->post('testing4'),
								   'report_writing' => $this->input->post('testing5'),
								   'testing' => $this->input->post('testing6'),
								   'hrd' => $this->input->post('testing7'),
								   'computation' => $this->input->post('testing8'),
								   'advice' => $this->input->post('testing9'),
								   'other' => $this->input->post('testing10'),
								   'modification_value' => 0,
								    );
					$data6 = array('sr_no' => $this->input->post('sr_no'),
								   'private_sector' => $this->input->post('client1'),
								   'govt_sector' => $this->input->post('client2'),
								   'public_sector' => $this->input->post('client3'),
								   'funding_agency' => $this->input->post('client4'),
								   'foreign_organisation' => $this->input->post('client5'),
								   'other_client' => $this->input->post('client6'),
								   'modification_value' => 0,
								    );
				
					$data['cons_row']=$this->consultant_form->getdetail($sr_no);
					$status=$payment_no*4+4;

					//these function insert the data into table
					$this->consultancy_proposal_form_model->insert1($data1,$data4,$payment_no);
					$this->consultancy_proposal_form_model->insertType($data5,$data6,$payment_no);
					$this->add_action($data4['sr_no'],$this->session->userdata('id') .
							' has submitted the proposal form',$status,'c_i' );
		            
		            //notification 
		            $description1= $this->session->userdata("id")." has submitted proposal form with payment no . ".
		            				$data4['payment_no']. ' and title '
		            			.$data['cons_row']->consultancy_title.'.';

		       	    $title1 = "check the status.";
		         	$link1 = "consultant/consultancy_proposal_approve/index/".$data4['sr_no'].'/'.$data4['payment_no'].'/pce';
		         	$id=$this->consultant_help_model->get_pce();
		            $this->notification->notify($id,"pce",$title1,$description1,$link1,"");

		            $this->consultancy_proposal_form_model->insert_mode_payment($sr_no,0);
		        	$this->db->trans_complete();
		        	//redirection
		        	$this->session->set_flashdata('flashSuccess','Proposal Form has been successfully submited.');
					redirect('home');
		
		}
}
function done($sr_no)
{
	$data=$this->consultant_form->getdetail_array($sr_no);
    
	$this->consultant_form->approve($sr_no,7);
	$this->add_action($data['sr_no'],
							' Your consultancy form has been completed',7,'c_i' );
		            
	$description1='consultancy form has been completed';
	$title1 = "Fill the Disbursement Form";
	$link1 = "consultant/consultant_disbursement_sheet/disbursement/".$data['sr_no'];
	$this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"");
	$this->session->set_flashdata('flashSuccess','Disbursement sheet for this consultancy form will be generated.');
	redirect('home');	        	
}
function edit($sr_no='',$payment_no='',$auth_id='')
	{
		$this->load->helper(array('form', 'url'));


		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firm_name', 'Firm Name', 'required');
		$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required');
		$this->form_validation->set_rules('client_designation', 'Designation', 'required');
		$this->form_validation->set_rules('client_address', 'Address', 'required');
		$this->form_validation->set_rules('client_city', 'City', 'required');
		$this->form_validation->set_rules('client_pin', 'Pin', 'required');
		$this->form_validation->set_rules('client_phone_no', 'Phone No', 'required');
		$this->form_validation->set_rules('client_extn', 'Extn', 'required');
		$this->form_validation->set_rules('client_fax', 'Fax', 'required');
		$this->form_validation->set_rules('client_email', 'Email', 'required');

		
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('weeks', 'Weeks', 'required');
		$this->form_validation->set_rules('days', 'Days', 'required');

		$this->form_validation->set_rules('total_value_fig', 'Total Value(in figure)', 'required');
		$this->form_validation->set_rules('total_value_words', 'Total Value(in words)', 'required');
		$this->form_validation->set_rules('bank_name', 'Bank Name and Branch', 'required');
		$this->form_validation->set_rules('dd_cheque_no', 'DD/Cheque No.', 'required');
		$this->form_validation->set_rules('dd_cheque_amount', 'DD/Cheque Amount', 'required');
		


		$this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Form");

		if ($this->form_validation->run() == FALSE)
		{
			$id_user = $this->session->userdata('id');
			
			$data['details'] = $this->consultancy_proposal_form_model->get_default($id_user);
			
			$data['cons_row']=$this->consultant_form->getdetail($sr_no);
			// print_r($data['cons_row']);
			if($payment_no*3+7 < $data['cons_row']->status || $data['cons_row']->status == 7)
			{

					$this->session->set_flashdata('flashError','Now you can not edit this proposal form.');
					redirect('home');
			}
			
			$consultancy=$this->consultancy_proposal_form_model->is_payment($sr_no);
			$data['id']=$consultancy;
			$data['id']->consultancy_no-=1;
			$data['payment_no']=$payment_no-1;
			$data['client']=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);

			$this->load->view('consultant/consultancy_proposal_form_edit',$data);
		}
		else
		{
			$this->db->trans_start();
			$date = date("Y-m-d H:i:s");
			if($_FILES['scope_path']['name'] != '')
			{
        
				$upload=$this->upload_file('scope_path',$this->input->post('sr_no'),$this->input->post('payment_no'));
				if($upload)
           		 {
            		$consultancy_no=$this->input->post('cons');
					$data1 = array('sr_no'=>$this->input->post('sr_no'),
							  'firm_name'=>addslashes($this->input->post('firm_name')),
							  'person_name'=>$this->input->post('contact_person_name'),
							  'designation'=>addslashes($this->input->post('client_designation')),
							  'address'=>addslashes($this->input->post('client_address')), 
							  'city'=>$this->input->post('client_city'),
							  'pincode'=>$this->input->post('client_pin'),
							  'contact_no'=>$this->input->post('client_phone_no'),
							  'extn'=>$this->input->post('client_extn'),
							  'fax'=>$this->input->post('client_fax'),
							  'email'=>$this->input->post('client_email'),
							  'modification_value'=>$this->input->post('modification_value')+1,
							  );
				
					$data4 = array('consultancy_no'=>$consultancy_no,
								'payment_no'=>$this->input->post('payment_no'),
								'sr_no'=>$this->input->post('sr_no'),
								'file_path'=>$upload['file_name'],
							  	'year'=>$this->input->post('year'),
							  	'month'=>$this->input->post('month'),
							  	'week'=>$this->input->post('weeks'), 
							  	'days'=>$this->input->post('days'),
							  	'timestamp'=>$this->input->post('starting_date'),
							  	'payment_mode'=>$this->input->post('payment'),
							  	'currency'=>$this->input->post('currency'),
							  	'currency_type'=>$this->input->post('currency_type'),
							  	'payment_enclosed'=>$this->input->post('payment_enclosed'),
							  	'value_fig'=>$this->input->post('total_value_fig'), 
							  	'value_word'=>$this->input->post('total_value_words'),
							  	'bank_name'=>$this->input->post('bank_name'),
							  	'dd_cheque_no'=>$this->input->post('dd_cheque_no'),
							  	'dd_cheque_amt'=>$this->input->post('dd_cheque_amount'),
							  	'dd_cheque_date'=>$this->input->post('dd_cheque_date'),
							  	'scope_consultancy'=>($this->input->post('scope_consultancy1')),
							  	'modification_value'=>$this->input->post('modification_value')+1,
							  	'date'=>$date,
							  	'correspondence'=>$this->input->post('correspondence'),
							  	'status'=>0,
							);

					if($_FILES['scope_consultancy']['name'] != '')
					 {
					 	$upload_scope=$this->upload_scope('scope_consultancy',$this->input->post('sr_no'));
       	    			if($upload_scope) $data4['scope_consultancy']=$upload_scope['file_name'];
					
					 }
					$data5 = array('sr_no' => $this->input->post('sr_no'),
								   'product_development' => $this->input->post('testing1'),
								   'process_development' => $this->input->post('testing2'),
								   'checking_of_design' => $this->input->post('testing3'),
								   'checking_of_analysis' => $this->input->post('testing4'),
								   'report_writing' => $this->input->post('testing5'),
								   'testing' => $this->input->post('testing6'),
								   'hrd' => $this->input->post('testing7'),
								   'computation' => $this->input->post('testing8'),
								   'advice' => $this->input->post('testing9'),
								   'other' => $this->input->post('testing10'),
								   'modification_value' => 0,
								    );
					$data6 = array('sr_no' => $this->input->post('sr_no'),
								   'private_sector' => $this->input->post('client1'),
								   'govt_sector' => $this->input->post('client2'),
								   'public_sector' => $this->input->post('client3'),
								   'funding_agency' => $this->input->post('client4'),
								   'foreign_organisation' => $this->input->post('client5'),
								   'other_client' => $this->input->post('client6'),
								   'modification_value' => 0,
								    );
							 
					}
			}
            else
            {
            	$consultancy_no=$this->input->post('cons');
				$data1 = array('sr_no'=>$this->input->post('sr_no'),
							  'firm_name'=>addslashes($this->input->post('firm_name')),
							  'person_name'=>$this->input->post('contact_person_name'),
							  'designation'=>addslashes($this->input->post('client_designation')),
							  'address'=>addslashes($this->input->post('client_address')), 
							  'city'=>$this->input->post('client_city'),
							  'pincode'=>$this->input->post('client_pin'),
							  'contact_no'=>$this->input->post('client_phone_no'),
							  'extn'=>$this->input->post('client_extn'),
							  'fax'=>$this->input->post('client_fax'),
							  'email'=>$this->input->post('client_email'),
							  'modification_value'=>$this->input->post('modification_value')+1,
							  );
				
				$data4 = array('consultancy_no'=>$consultancy_no,
								'payment_no'=>$this->input->post('payment_no'),
								'sr_no'=>$this->input->post('sr_no'),
								
							  	'year'=>$this->input->post('year'),
							  	'month'=>$this->input->post('month'),
							  	'week'=>$this->input->post('weeks'), 
							  	'days'=>$this->input->post('days'),
							  	'timestamp'=>$this->input->post('starting_date'),
							  	'payment_mode'=>$this->input->post('payment'),
							  	'currency'=>$this->input->post('currency'),
							  	'currency_type'=>$this->input->post('currency_type'),
							  	'payment_enclosed'=>$this->input->post('payment_enclosed'),
							  	'value_fig'=>$this->input->post('total_value_fig'), 
							  	'value_word'=>$this->input->post('total_value_words'),
							  	'bank_name'=>$this->input->post('bank_name'),
							  	'dd_cheque_no'=>$this->input->post('dd_cheque_no'),
							  	'dd_cheque_amt'=>$this->input->post('dd_cheque_amount'),
							  	'dd_cheque_date'=>$this->input->post('dd_cheque_date'),
							  	'scope_consultancy'=>($this->input->post('scope_consultancy1')),
							  	'date'=>$date,
							  	'modification_value'=>$this->input->post('modification_value')+1,
							  	'correspondence'=>$this->input->post('correspondence'),
							  	'status'=>0,
							  );
					if($_FILES['scope_consultancy']['name'] != '')
					 {
					 	$upload_scope=$this->upload_scope('scope_consultancy',$this->input->post('sr_no'));
       	    			if($upload_scope) $data4['scope_consultancy']=$upload_scope['file_name'];
					
					 }
					$data5 = array('sr_no' => $this->input->post('sr_no'),
								   'product_development' => $this->input->post('testing1'),
								   'process_development' => $this->input->post('testing2'),
								   'checking_of_design' => $this->input->post('testing3'),
								   'checking_of_analysis' => $this->input->post('testing4'),
								   'report_writing' => $this->input->post('testing5'),
								   'testing' => $this->input->post('testing6'),
								   'hrd' => $this->input->post('testing7'),
								   'computation' => $this->input->post('testing8'),
								   'advice' => $this->input->post('testing9'),
								   'other' => $this->input->post('testing10'),
								   'modification_value' => 0,
								    );
					$data6 = array('sr_no' => $this->input->post('sr_no'),
								   'private_sector' => $this->input->post('client1'),
								   'govt_sector' => $this->input->post('client2'),
								   'public_sector' => $this->input->post('client3'),
								   'funding_agency' => $this->input->post('client4'),
								   'foreign_organisation' => $this->input->post('client5'),
								   'other_client' => $this->input->post('client6'),
								   'modification_value' => 0,
								    );
            }
			
			$data['cons_row']=$this->consultant_form->getdetail($sr_no);
			$this->consultancy_proposal_form_model->insertM($sr_no,$payment_no);
			//print_r($this->input->post('modification_value'));
			$this->consultancy_proposal_form_model->update($data1,$data4,$data5,$data6,$payment_no);
           	$status=$payment_no*4+4;
			$this->add_action($data4['sr_no'],$this->session->userdata('id') .
					' has updated the proposal form with payment_no '.$payment_no,$status,'c_i' );
            
            $description1= $this->session->userdata("id")." has edited proposal form with payment no . ".$data4['payment_no']. ' for  consultancy '
            			.$data4['consultancy_no'].'.';
       	    $title1 = "check the status.";
         	$link1 = "consultant/consultancy_proposal_approve/index/".$data4['sr_no'].'/'.$data4['payment_no'].'/pce';
         	$id=$this->consultant_help_model->get_pce();
            $this->notification->notify($id,"pce",$title1,$description1,$link1,"");
        $this->db->trans_complete();
			

			$this->session->set_flashdata('flashSuccess','Proposal Form has been successfully edited.');
			redirect('home');
		
		}
		

		$this->drawFooter();
	}
	function add_action($sr_no,$remark,$status,$auth)
    {
      $date = date("Y-m-d H:i:s");
      $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
    }
    function view_proposal_form($sr_no='',$payment_no='',$auth_id)
    {	
    		$this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Form");
    		$data['auth_id']=$auth_id;
			$data['id']=$this->consultant_form->get_max_sr_no();
       		$data['ci']=$this->consultant_form->getc_i($sr_no);
       		
      		 $data['department']=$this->consultant_help_model->get_departments($data['ci']->department);
      		 $data['des']=$this->consultant_help_model->getDesignation($data['ci']->emp_no); 	
			 $data['user_detail']=$this->consultant_help_model-> get_detail_user($data['ci']->emp_no);
			

			 $data['details'] = $this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
       		
			 $this->load->view('consultant/consultancy_proposal_approve',$data);
    }
    function consultancy_proposal_form_all($auth_id)
    {
    	$id=$this->session->userdata('id');
        $data['cons_row']=$this->consultant_form->getAllConsult($id);
        $data['payment']=$this->consultant_form->get_no_payment();
        if(count($data['cons_row']) == 0)
        {
          $this->session->set_flashdata('flashError','There is no any conultancy form to edit.');
          redirect('home');
        }
         $this->drawheader('Apply Proposal Form');
         
    	$this->load->view('consultant/proposal_form_all',$data);
    }
    
     private function upload_file($name ='',$sno = '',$payment_no='')
    {
        $config['upload_path'] = 'assets/files/consultant/DD';
        $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png|xls|xlsx|csv';
        $config['max_size']  = '1050';

            if(isset($_FILES[$name]['name']))
            {
                if($_FILES[$name]['name'] == "")
                    $filename = "";
                else
                {
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                   
                    $filename='DD_'.date('YmdHis').$sno.$ext;
                }
            }
            else
            {
                $this->session->set_flashdata('flashError','ERROR: File Name not set.');
               redirect('consultant/consultancy_proposal_form/index/'.$sno.'/ft');
                return FALSE;
            }
       
            $config['file_name'] = $filename;
            //$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
            //return FALSE;

            if(!is_dir($config['upload_path'])) //create the folder if it's not already exists
            {
                mkdir($config['upload_path'],0777,TRUE);
            }

            $this->load->library('upload', $config,'file_req');
      if( ! $this->file_req->do_multi_upload($name))       //do_multi_upload is back compatible with do_upload
      {
          $this->session->set_flashdata('flashError',$this->file_req->display_errors('',''));
          redirect('consultant/consultant/index');
          return FALSE;
      }
      else
      {
          $upload_data = $this->file_req->data();
          return $upload_data;
      }
    }
     private function upload_scope($name ='',$sno = '',$payment_no)
  {
      $config['upload_path'] = 'assets/files/consultant/SCOPE_CONSULT';
      $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png|xls|xlsx|csv';
      $config['max_size']  = '1050';
      if(isset($_FILES[$name]['name']))
      {
          if($_FILES[$name]['name'] == "")
              $filename = "";
          else
          {
              $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
              $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
             
              $filename='SCOPE_'.date('YmdHis').$sno.$ext;
          }
      }
      else
      {
          $this->session->set_flashdata('flashError','ERROR: File Name not set.');
          redirect('consultant/consultancy_proposal_form/index/'.$sno.'/ft');
                return FALSE;
      }
      $config['file_name'] = $filename;
          //$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
          //return FALSE;
      if(!is_dir($config['upload_path'])) //create the folder if it's not already exists
      {
          mkdir($config['upload_path'],0777,TRUE);
      }

      $this->load->library('upload', $config,'scope_work');

      if ( ! $this->scope_work->do_multi_upload($name))       //do_multi_upload is back compatible with do_upload
      {
          $this->session->set_flashdata('flashError',$this->scope_work->display_errors('',''));
          redirect('consultant/consultant/index');
          return FALSE;
      }
      else
      {
          $upload_data = $this->scope_work->data();

          return $upload_data;
      }
  }
}
?>