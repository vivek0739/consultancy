<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultancy_proposal_approve extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
    //$this->emp_id = $this->session->userdata('id');
    $this->addJS("consultant/consultancy_proposal.js");
    $this->load->model('consultant/consultant_form','',TRUE);
    $this->load->model('consultant/consultant_help_model','',TRUE);
    $this->load->model('consultant/consultancy_proposal_approve_model','',TRUE);
		$this->load->model('consultant/consultancy_proposal_form_model','',TRUE);
	}

	public function index($sr_no='',$payment_no='',$auth_id='')
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
		$this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Form");
    if ($this->form_validation->run() == FALSE)
		{
			 $data['auth_id']=$auth_id;
			 $data['id']=$this->consultant_form->get_max_sr_no();
       $data['ci']=$this->consultant_form->getc_i($sr_no);
       $data['department']=$this->consultant_help_model->get_departments($data['ci']->department);
       $data['des']=$this->consultant_help_model->getDesignation($data['ci']->emp_no); 	
			 $data['user_detail']=$this->consultant_help_model-> get_detail_user($data['ci']->emp_no);
			 //print_r($data['user_detail']);
       $data['details'] = $this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
       $data['form1']=$this->consultant_form->getdetail_array($sr_no);
       $this->load->view('consultant/consultancy_proposal_approve',$data);
		}
		$this->drawFooter();
  }
  public function view_proposal_prev($sr_no='',$payment_no='',$auth_id='')
  {
    $data['details'] = $this->consultancy_proposal_approve_model->get_default_prev($sr_no,$payment_no);
    $data['form1']=$this->consultant_form->getdetail_array($sr_no);
    $this->drawHeader('Previous Version of Payment for Consultancy - '.$data['form1']['consultancy_title']);
    $this->load->view('consultant/view_proposal_prev',$data);
  }
  public function view_proposal_form_prev_one($sr_no='',$payment_no='',$modification_value='')
  {
        $this->drawHeader("Consultancy / Testing / Assignment proposal And Agreement Previous Form");
        $data['auth_id']='prev';
       $data['id']=$this->consultant_form->get_max_sr_no();
       $data['ci']=$this->consultant_form->getc_i($sr_no);
       $data['department']=$this->consultant_help_model->get_departments($data['ci']->department);
       $data['des']=$this->consultant_help_model->getDesignation($data['ci']->emp_no);  
       $data['user_detail']=$this->consultant_help_model-> get_detail_user($data['ci']->emp_no);
       //print_r($data['user_detail']);
       $data['details'] = $this->consultancy_proposal_approve_model->get_default_prev($sr_no,$payment_no,$modification_value);
       $data['form1']=$this->consultant_form->getdetail_array($sr_no);
       $this->load->view('consultant/consultancy_proposal_approve',$data);
   
  }
	public function approve($sr_no='',$payment_no='',$auth_id='')
	{
		$data=$this->consultant_form->getdetail_array($sr_no);
    $data1=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
    $status=$data1->status;
    $status2=4*$payment_no+4;
		if($auth_id=='pce')
      	{
        	  $auth='pce';
       		 	if($status!=0||$status2==7)
            {
                $this->session->set_flashdata('flashError','You have  already submitted your response.');
                redirect('home');
            }
        		if($this->input->post('action_taken')=='Are You Sure To Approve')
        		{
                $status=2;
                $status2+=2;
                $remark=$this->input->post('remark_text1');
               
                $description1= "pce has approved proposal form(2) with title " .$data1->consultancy_no.'and payment no. '.$data1->payment_no;
                $title1 = "View Your Proposal Form.";
                $link1 = "consultant/consultancy_proposal_approve/index/".$data1->sr_no.'/'.$data1->payment_no.'/ft';
                $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"approved");
                $this->add_action($sr_no,$remark,$status2,$auth);
                $this->consultancy_proposal_approve_model->approve($sr_no,$payment_no,$status);
                $this->session->set_flashdata('flashSuccess','Your Response has been submitted.');
                redirect('home');
            }
        		else if($this->input->post('action_taken')=='Are You Sure To Reject')
        		{
                $status=1;
                $status2+=1;
          			$remark=$this->input->post('remark_text2');
          			$description1= "pce has rejected proposal form(2) with title " .$data1->consultancy_no.'.';
       	    		$title1 = "Edit Your Form.";
         			  $link1 = "consultant/consultancy_proposal_form/edit/".$data1->sr_no.'/'.$data1->payment_no.'/ft';
         			  $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"");
       			    $this->add_action($sr_no,$remark,$status2,$auth);
                $this->consultancy_proposal_approve_model->approve($sr_no,$payment_no,$status);
                $this->session->set_flashdata('flashSuccess','Your Response has been submitted.');
                redirect('home');
            }
        }
  }
	function add_action($sr_no,$remark,$status,$auth)
  {
    $date = date("Y-m-d H:i:s");
    $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
  }
  function designation($id)
  {
      $this->load->model('consultant/consultant_help_model','',TRUE);
     
      $this->load->view('consultant/consultant_designation',$data);
  }
  function apply_form3()
  {

    $data['cons_row']=$this->consultancy_proposal_approve_model->get_all_payment();

    $this->drawHeader('Send Receipt');
    $this->load->view('consultant/receipt_all',$data);
  }
  function form3($sr_no,$payment_no)
  {
    $this->drawHeader("");

    $data['form1']=$this->consultant_form->getdetail_array($sr_no);
    $data['form2']=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
    if($data['form2']->status==3)
    {
      $this->session->set_flashdata('flashError','Your have already submitted.');
      redirect('home');
    }
    $this->load->view('consultant/receipt',$data);          
  }
  function form3_submit($sr_no,$payment_no)
  {
    $date = date("Y-m-d H:i:s");
    $upload=$this->upload_file('scope_path',$this->input->post('sr_no'),$payment_no);
    if($upload)
    {
      $data2=array('sr_no'=>$sr_no,
                    'payment_no'=>$payment_no,
                    'receipt_no'=>$this->input->post('receipt_no'),
                    'timestamp'=>$this->input->post('dated'),
                    'amount'=>$this->input->post('amount'),
                    'filepath'=>$upload['file_name'],
                    'date'=>$date,
                    'modification_value'=>0 );
      $data=$this->consultant_form->getdetail_array($sr_no);
      
      $data1=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
      $status=$data1->status;
      $status2=4*$payment_no+4;
      $status=3;
      $status2+=3;
      
      $description1= "consultancy No ". $data1->consultancy_no.",and payment no ". $data1->payment_no.'.';
      $title1 = "View Payment Receipt";
      $link1 = "consultant/consultancy_proposal_approve/view_receipt/".$data1->sr_no.'/'.$data1->payment_no;
      $id=$this->consultant_help_model->get_ar_proj();

      $this->db->trans_start();
      $this->notification->notify($id,"acc_ar_prj",$title1,$description1,$link1,"accepted");
      $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"accepted");
      $this->add_action($data['sr_no'],'Pce has send receipt for Payment No. '.$data1->payment_no,$status2,'pce');
      $this->consultancy_proposal_approve_model->approve($sr_no,$payment_no,$status);
                
      $this->consultancy_proposal_approve_model->put_receipt($data2);
      $this->db->trans_complete();

      $this->session->set_flashdata('flashSuccess','Your Response has been submitted.');
      redirect('home');
    }
                
  }
  function view_receipt($sr_no,$payment_no)
  {
    $this->drawHeader(" ");
    $data['data2']=$this->consultancy_proposal_approve_model->get_receipt($sr_no,$payment_no);
    $data['form2']=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
    if($data['form2']->status==3)
    {
      $this->load->view('consultant/view_receipt',$data);
    }
    else
    {
       $this->session->set_flashdata('flashSuccess','receipt has been not generated by pce');
      redirect('home');
    }
    
  }
  function view_receipt_prev($sr_no,$payment_no)
  {
    $data['details'] = $this->consultancy_proposal_approve_model->get_receipt_prev($sr_no,$payment_no);
    $data['form1']=$this->consultant_form->getdetail_array($sr_no);
    $this->drawHeader('Previous Version of Receipt of Payment No.'.$data['details'][0]->payment_no.'for Consultancy - '.$data['form1']['consultancy_title']);
    $this->load->view('consultant/view_receipt_prev',$data);
  }
  function view_receipt_prev_one($sr_no,$payment_no,$modification_value)
  {
     $data['data2'] = $this->consultancy_proposal_approve_model->get_receipt_prev($sr_no,$payment_no,$modification_value);
     $data['form2']=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
    $this->drawHeader('');
    $this->load->view('consultant/view_receipt',$data);
  }
  function edit_form3_all()
  {

    $data['cons_row']=$this->consultancy_proposal_approve_model->get_all_payment();

    $this->drawHeader('Edit Receipt');
    $this->load->view('consultant/edit_receipt_all',$data);
  }
  function edit_form3($sr_no,$payment_no)
  {
    $this->drawHeader(" ");
    $data['data2']=$this->consultancy_proposal_approve_model->get_receipt($sr_no,$payment_no);
    $data['form2']=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
    $this->load->view('consultant/edit_receipt',$data);
  }
  function edit_form3_submit($sr_no,$payment_no)
  {
   $date = date("Y-m-d H:i:s");
   if($_FILES['scope_path']['name']!='')
   {
      $upload=$this->upload_file('scope_path',$this->input->post('sr_no'),$payment_no);
      if($upload)
      {
       $data2=array('sr_no'=>$sr_no,
                    'payment_no'=>$payment_no,
                    'receipt_no'=>$this->input->post('receipt_no'),
                    'timestamp'=>$this->input->post('dated'),
                    'amount'=>$this->input->post('amount'),
                    'filepath'=>$upload['file_name'],
                    'date'=>$date,
                    'modification_value'=>$this->input->post('modification_value')+1);
        
      }
   }
   else
   {
    $data2=array('sr_no'=>$sr_no,
                    'payment_no'=>$payment_no,
                    'receipt_no'=>$this->input->post('receipt_no'),
                    'timestamp'=>$this->input->post('dated'),
                    'amount'=>$this->input->post('amount'),
                    'date'=>$date,
                    'modification_value'=>$this->input->post('modification_value')+1 );
       
    
   }
    
      $data=$this->consultant_form->getdetail_array($sr_no);
      $data1=$this->consultancy_proposal_approve_model->get_default($sr_no,$payment_no);
      $status=$data1->status;
      $status2=4*$payment_no+4;
      $status=3;
      $status2+=3;
      
      $description1= "PCE has edited consultancy No ". $data1->consultancy_no.",and payment no ". $data1->payment_no.'.';
      $title1 = "View Payment Receipt";
      $link1 = "consultant/consultancy_proposal_approve/view_receipt/".$data1->sr_no.'/'.$data1->payment_no;
      $id=$this->consultant_help_model->get_ar_proj();

      $this->db->trans_start();
      $this->notification->notify($id,"acc_ar_prj",$title1,$description1,$link1,"accepted");
      $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"accepted");
      $this->add_action($data['sr_no'],'Pce has send receipt for Payment No. '.$data1->payment_no,$status2,'pce');
      $this->consultancy_proposal_approve_model->approve($sr_no,$payment_no,$status);
                
      $this->consultancy_proposal_approve_model->put_receipt_edited($data2);
      $this->db->trans_complete();

      $this->session->set_flashdata('flashSuccess','Your Response has been submitted.');
      redirect('home');
    
                
  }
  function disbursement_apply_all()
  {
    $data['cons_row']=$this->consultant_form->getdetail_all();
    $this->drawHeader('Submit Disbursement Form');
    $this->load->view('consultant/disbursement_apply_all',$data);
    
  }
  private function upload_file($name ='',$sno = '',$payment_no='')
  {
    $config['upload_path'] = 'assets/files/consultant/RECEIPT';
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
       
        $filename='RECEIPT_'.date('YmdHis').$sno.$payment_no.$ext;
      }
    }
    else
    {
      $this->session->set_flashdata('flashError','ERROR: File Name not set.');
      redirect('consultant/consultant_proposal_approve/form3/'.$sr_no.'/'.$payment_no);
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

  }
?>