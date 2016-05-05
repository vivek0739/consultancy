<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultant_ajax extends MY_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->addJS('consultant/consultant.js');
         $this->load->model('consultant/consultant_form','',TRUE);
        $this->load->model('consultant/consultant_help_model','',TRUE);
        $this->load->model('consultant/consultancy_proposal_form_model','',TRUE);
        $this->load->model('consultant/consultancy_proposal_approve_model','',TRUE);
		
    }

	public function index()
	{
		// Will never be used
	}
	public function empNameByDept($dept = '',$user_id)
	{
		$this->load->model('user/user_details_model','',TRUE);
		$data['empNames'] = $this->user_details_model->getEmpNamesByDept($dept);
		$data['user']=$user_id;
		$this->load->view('consultant/empNameByDept',$data);
	}
	function member()
	{
		/*$data1=array();
		$data1['sr_no']=$_POST['sr_no'];
		$data1['emp_no']=$_POST['emp_no'];
		$data1['department']=$_POST['dept_id'];
		$data1['postion']=$_POST['position'];
		$data1['share']=$_POST['share'];
		$data1['modification_value']=$_POST['modv'];*/
		$this->consultant_form->insertM($_POST);
		$data['members']=$this->consultant_form->getmember($_POST['sr_no']);
		
		$data['sr_no']=$_POST['sr_no'];
		$this->load->view('consultant/consultant_member',$data);
	}
	function member1($share1)
	{
		
		 $this->consultant_form->editC($share1,$_POST['sr_no']);
		$this->consultant_form->insertM($_POST);
		$data['members']=$this->consultant_form->getmember($_POST['sr_no']);
		$data['sr_no']=$_POST['sr_no'];
		$this->load->view('consultant/consultant_member',$data);

	}
	function rm_member()
	{
		 $this->consultant_form->delete_member($_POST['sr_no'],$_POST['emp_no']);
		$data['members']=$this->consultant_form->getmember($_POST['sr_no']);
		$data['sr_no']=$_POST['sr_no'];
		$this->load->view('consultant/consultant_member',$data);
	}
	function edit_member($share1)
	{
		
		 $this->consultant_form->edit_member($share1,$_POST['sr_no'],$_POST['emp_no']);
	
		$data['members']=$this->consultant_form->getmember($_POST['sr_no']);
		$data['sr_no']=$_POST['sr_no'];
		$this->load->view('consultant/consultant_member',$data);
	
	}
	function show_member()
	{
		
		 $data['members']=$this->consultant_form->getmember($_POST['sr_no']);
		$data['sr_no']=$_POST['sr_no'];
		$this->load->view('consultant/consultant_member',$data);
	}
	function checkShare()
	{
		$members=$this->consultant_form->getmember($_POST['sr_no']+1);
		//print_r($_POST['sr_no']);
		$sum=0;
		foreach ($members as $key => $member) {
			$sum+=$member->share;
		}
		
		if($sum==100)
			echo $sum;
		else
			echo 0;
	}
	//edited by prafff

	function view_modal1($sr_no,$auth_id)
	{

		$data['form2']=$this->consultancy_proposal_approve_model->get_default_all($sr_no);
      	$data['cons_row']=$this->consultant_form->getdetail($sr_no);
      	$data['auth_id']=$auth_id;
      	$data['ci']=$this->consultant_form->getc_i($sr_no);
      	$this->drawHeader('Documents');
      	$this->load->view('consultant/view_modal',$data);
      	$this->drawFooter();
	 
	}
	/***end***/
	function view_modal($sr_no,$auth_id)
	{
		$data['form2']=$this->consultancy_proposal_approve_model->get_default_all($sr_no);
     	$data['cons_row']=$this->consultant_form->getdetail($sr_no);
     	$data['auth_id']=$auth_id;
     	$data['ci']=$this->consultant_form->getc_i($sr_no);
     	$this->load->view('consultant/view_modal',$data);
	}
	function edit_modal($sr_no)
	{
		$data['form2']=$this->consultancy_proposal_approve_model->get_default_all($sr_no);
     	$data['cons_row']=$this->consultant_form->getdetail($sr_no);
     	
     	
     	$this->load->view('consultant/edit_modal',$data);
	}
}