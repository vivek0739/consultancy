<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 19 june 2015
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Consultant extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->addJS('consultant/consultant.js');
        $this->load->model('consultant/consultant_form','',TRUE);
        $this->load->model('consultant/consultant_help_model','',TRUE);
        $this->load->model('consultant/consultancy_proposal_form_model','',TRUE);
    }
     public function index()
    {
        $this->load->model('employee/emp_basic_details_model','',TRUE);
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['id']=$this->consultant_form->get_max_sr_no();
        if(is_null($data['id']->sr_no)) $data['id']->sr_no=0;
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $data['service_tax']=$this->consultant_help_model->get_service_tax();
        //print_r($data['service_tax']);
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
        $this->consultant_form->delete_member($data['id']->sr_no+1);
    	  $this->drawheader('');
    	  $this->load->view('consultant/consultant_estimate_form',$data);
    }
    function designation($id)
    {
        $this->load->model('consultant/consultant_help_model','',TRUE);
        $data['des']=$this->consultant_help_model->getDesignation($id);
        $this->load->view('consultant/consultant_designation',$data);
    }
    function submit_consult_form()
    {

        $upload=$this->upload_file('scope_path',$this->input->post('sr_no'));
        $upload_scope=$this->upload_scope('work_scope',$this->input->post('sr_no'));
        
        if($upload && $upload_scope)
            {
                $date = date("Y-m-d H:i:s");
                $data = array('sr_no'=>$this->input->post('sr_no'),
                          'consultancy_title'=>$this->input->post('consultant_title'),
                          'scope_work'=>$upload_scope['file_name'],
                          'file_path'=>$upload['file_name'],
                          'institute_charges'=>$this->input->post('institute_charge'),
                          'expenses'=>$this->input->post('expenses'), 
                          'expenditure'=>$this->input->post('expenditure'),
                          'salary'=>$this->input->post('salary'),
                          'lodging'=>$this->input->post('lodging'),
                          'contigency'=>$this->input->post('contigency'),
                          'type_edc_fund'=>$this->input->post('edc_fund'),
                          'in_house'=>$this->input->post('in_house_exp'),
                          'other_consultancy'=>$this->input->post('other_consultancy'),
                          'non_recurring'=>$this->input->post('non_recurring'),
                          'equipmental_charge'=>$this->input->post('equipment_charge'), 
                          'consultancy_charge'=>$this->input->post('consultancy_charge'),
                          'total_charge'=>$this->input->post('total_charge'),
                          'service_tax'=>$this->input->post('service_tax'),
                          'gross_amount'=>$this->input->post('gross_amount'),
                          'modification_value'=>0,
                          'status'=>0,
                          'timestamp'=>$date 
                       );
                $this->db->trans_start();
                $this->consultant_form->insert($data);
                $this->consultant_form->insertMtemp($this->input->post('sr_no'),$data['modification_value']);
              
                $this->add_action($data['sr_no'],$this->session->userdata('id').' has applied the estimated form',0,'c_i' );
                $this->send_noitification_consultancy($data);
                $this->db->trans_complete();
                $this->session->set_flashdata('flashSuccess','Form Submitted, status will be notified.');
                redirect('home');
             }

        
    }
    function approve_consult_form($sr_no,$auth_id)
    {
       $this->db->trans_start();
      $data=$this->consultant_form->getdetail_array($sr_no);
      $status=$data['status'];
      $remark=0;
      $auth='c_i';
      if($auth_id=='ft')
      {
        $auth='c_i';
        if($status == 1)
        {
          $this->session->set_flashdata('flashError','You have  already submitted your response.');
          redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Cancel')
        {
          $status=1;
          $remark=$this->input->post('remark_text3');
        }
        $this->consultant_form->approve($sr_no,$status);
      }
      else if($auth_id=='hod')
      {
        $auth='hod';
        if($status != 0)
        {
          $this->session->set_flashdata('flashError','You have  already submitted your response.');
          redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Forward')
        {
          $status=3;
          $remark=$this->input->post('remark_text4');;
        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=2;
          $remark=$this->input->post('remark_text2');
        }
        $this->consultant_form->approve($sr_no,$status);
      }
      else if($auth_id=='pce')
      {
        $auth='pce';
        if($status != 3)
        {
          $this->session->set_flashdata('flashError','You have  already submitted your response.');
          redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Forward')
        {
          $status=4;
          $remark=$this->input->post('remark_text1');
        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=2;
          $remark=$this->input->post('remark_text2');
        }
        $this->consultant_form->approve($sr_no,$status);
      }
      else if($auth_id=='dt')
      {
        $auth='dt';
        if($status != 4)
        {
          $this->session->set_flashdata('flashError','You have  already submitted your response.');
          redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Approve')
        {
          $status=5;
          $remark=$this->input->post('remark_text1');
        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=2;
          $remark=$this->input->post('remark_text2'); 
        }
        $data['payment_no']=$this->consultancy_proposal_form_model->is_payment($sr_no);
        // if(count($data['payment_no'])==0)
        // {
        //   $this->consultant_form->allot_cons($sr_no);
        // }
        $this->consultant_form->approve($sr_no,$status);
      }
      $this->add_action($sr_no,$remark,$status,$auth);
      $data['status']=$status;
      $this->send_noitification_consultancy($data);
      $this->db->trans_complete();
      $this->session->set_flashdata('flashSuccess','You have submitted your response.');
      redirect('home');

  }
  function send_noitification_consultancy($data)
  {
      $iduser=$this->session->userdata('id');
      $description = "Employee  ".$this->session->userdata('name')." had appllied for consultancy with title ".$data['consultancy_title'].'.';
      $title = "Please check and approve  .";
      $description1= $this->session->userdata("designation")." has approved  conultancy with title ".$data['consultancy_title'].'.';        $title1 = "check the status.";
      $link1 = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/c_i';
      $status=$data['status'];
      if($status==0)
        {
          $link = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod';
          $id=$this->consultant_help_model->get_hod($iduser);
          if(is_null($id))
          {
            $link = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod';
            $id=$this->consultant_help_model->get_hos($iduser);
            $this->notification->notify($id,"hos",$title,$description,$link,"");
          }
          else
          {
            $this->notification->notify($id,"hod",$title,$description,$link,"");
          }
        }
        else if($status==2)
        {
          $description = "Employee with emp_no ".$data['c_i']." had appllied for consultancy with title ".$data['consultancy_title'].'.';
          $description1= "Your consultancy Form with title ".$data['consultancy_title'].' has been rejected.';
          $title1 = "Please edit this form";
          $link1 = "consultant/edit_consultancy_form/edit_consultancy/".$data['sr_no'];
          $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"rejected");
        }
        else if($status==3)
        { 
          $description = "Employee with emp_no ".$data['c_i']." had appllied for consultancy with title ".$data['consultancy_title'].'.';
          $id=$this->consultant_help_model->get_pce();
          if(is_null($id))
          {
              $this->session->set_flashdata('flashError','PCE has not been allocated it currently not exist.');
              redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod');
          }
          $link = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce';
          $this->notification->notify($id,"pce",$title,$description,$link,""); 
          $description1= " Hod/Hos has approved  your conultancy form with title ".$data['consultancy_title'].'.';
          $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"");
        }
        else if($status==4)
        {
          $description = "Employee with emp_no ".$data['c_i']." had appllied for consultancy with title ".$data['consultancy_title'].'.';
          $link = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/dt';
          $id=$this->consultant_help_model->get_dt();
          if(is_null($id))
          {
              $this->session->set_flashdata('flashError','Director has not been allocated it currently not exist.');
              redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
          }
          $this->notification->notify($id,"dt",$title,$description,$link,"");
          $description1= " Pce has approved  your conultancy form with title ".$data['consultancy_title'].'.';
          $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"");
        }
        else if($status==5)
        {
          $description1 = "Director  has approved consultancy form with title ".$data['consultancy_title'].'.';
          $description = "Assign Linkup No. to ".$data['consultancy_title'].'.' ;
          $id=$this->consultant_help_model->get_pce();
          if(is_null($id))
          {
              $this->session->set_flashdata('flashError','PCE has not been allocated it currently not exist.');
              redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod');
          }
          $link = "consultant/consultant/assign_linkup_no/".$data['sr_no'].'/pce';
          $this->notification->notify($id,"pce",$title,$description,$link,""); 
          
          $this->notification->notify($data['c_i'],"emp",$title1,$description1,$link1,"");
        }
        else if($status==6)
        {
          $description = "Link Up No. generated for consultancy form with title ".$data['consultancy_title'].'.';
          $title = "fill this form in <u>know more</u>";
          $link = "consultant/consultancy_proposal_form/choice/".$data['sr_no'];
          $id=$this->consultant_help_model->get_dt();
          $this->notification->notify($data['c_i'],"emp",$title,$description,$link,"accepted");
        }
  }
  function assign_linkup_no($sr_no,$auth_id="")
  {
        $data['sr_no']=$sr_no;
        $this->load->model('consultant/consultant_help_model','',TRUE);
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data=$this->consultant_form->getdetail_array($sr_no);
        $status=$data['status'];
        if($status == 6)
        {

          $this->session->set_flashdata('flashError','You have  assign linkup no.');
          redirect('home');
        }
        
        $this->form_validation->set_rules('link_up_no', '', 'required');
        $this->form_validation->set_rules('page_no', '', 'required');
        $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
        if ($this->form_validation->run() == FALSE)
        {
          $this->drawHeader("Assign Link Up No.");
          $this->load->view('consultant/assign_link_up_no',$data);
        }
        else
        {
          $link_up = $this->input->post('link_up_no');
          $page_no = $this->input->post('page_no');
          $this->consultant_form->insert_link_up_no($sr_no,$link_up,$page_no);

          $data=$this->consultant_form->getdetail_array($sr_no);
          $remark = "Link Up Generated";
          $status = 6;
          $this->add_action($sr_no,$remark,$status,$auth_id);
          $data['status']=$status;
          $this->consultant_form->approve($sr_no,$status);
          $this->send_noitification_consultancy($data);
          $this->session->set_flashdata('flashSuccess','Link Up No. generated');
                redirect('home');
        }
        
  }
  function edit_linkup_no($sr_no,$auth_id="")
  {
        $data['sr_no']=$sr_no;
        $this->load->model('consultant/consultant_help_model','',TRUE);
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['result']=$this->consultant_form->get_link_up_no($sr_no); 
        
        $this->form_validation->set_rules('link_up_no', '', 'required');
        $this->form_validation->set_rules('page_no', '', 'required');
        if ($this->form_validation->run() == FALSE)
        {
          $this->drawHeader("Edit Link Up No.");
          $this->load->view('consultant/edit_link_up_no',$data);
        }
        else
        {
          $link_up = $this->input->post('link_up_no');
          $page_no = $this->input->post('page_no');
          $this->consultant_form->edit_link_up_no($sr_no,$link_up,$page_no);

          $data=$this->consultant_form->getdetail_array($sr_no);
          $remark = "Link Up Generated";
          $status = 6;
          $this->add_action($sr_no,$remark,$status,$auth_id);
          $data['status']=$status;
          $this->consultant_form->approve($sr_no,$status);
          $this->send_noitification_consultancy($data);
          $this->session->set_flashdata('flashSuccess','Link Up No. updated');
          redirect('home');
        }
        
  }
  function view_consultancy_form($auth_id)
  {
      $id=$this->session->userdata('id');
      if($auth_id=='ft'||$auth_id=='c_i')
      {
        $data['cons_row1']=$this->consultant_form->getAllConsult1($id);
        $data['cons_row']=$this->consultant_form->getAllConsult($id);  
      }
      else if($auth_id=='pce'||$auth_id=='dt'||$auth_id=='acc_ar_prj')
      {
        $data['cons_row1']=$this->consultant_form->getAllConsult1();
        $data['cons_row']=$this->consultant_form->getAllConsult();
      }
      else if($auth_id=='hod')
      {
        $dept_id=$this->session->userdata('dept_id');
        $data['cons_row']=$this->consultant_form->getAllConsultHod($dept_id);
        $data['cons_row1']=$this->consultant_form->getAllConsultHod1($dept_id);
      }
      $data['auth_id']=$auth_id;
      $data['payment']=$this->consultant_form->get_no_payment();
      if(count($data['cons_row']) == 0)
      {
        $this->session->set_flashdata('flashError','There is no any conultancy form to view.');
        redirect('home');
      }
      $this->drawheader('View Applied Form');
      $this->load->view('consultant/view_consultancy_form',$data);
  }
  function view_consultancy_prev($sr_no,$auth_id)
  {
      $data['cons_row']=$this->consultant_form->getdetailprev($sr_no);
      $data['auth_id']=$auth_id;
      $this->drawheader('View Previous Form');
      $this->load->view('consultant/view_consultancy_form_prev',$data);
  }
  function view_consultancy_form_hod($sr_no,$auth_id)
  {

      $id=$this->session->userdata('id');
      $data['cons_row']=$this->consultant_form->getdetail($sr_no);
      $data['members']=$this->consultant_form->getmember($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
     // print_r($data['action_recent']);
      $data['auth_id']=$auth_id;
      $this->drawheader('View Consultancy Form');
      $this->load->view('consultant/view_consultancy_detail',$data);
    
  }
  function view_consultancy_form_prev_one($sr_no,$modv,$auth_id)
  {
      $id=$this->session->userdata('id');
      $auth_id='prev';
      $data['cons_row']=$this->consultant_form->getdetailprevone($sr_no,$modv);

      $data['members']=$this->consultant_form->getprevmember($sr_no,$modv);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $data['auth_id']=$auth_id;
      $this->drawheader('View Previous Form');
      $this->load->view('consultant/view_consultancy_detail',$data);
  }
  function viewtest($sr_no,$auth_id)
  {
          $this->addJS('student_view_report/print_script.js');
          $id=$this->session->userdata('id');
          $data['cons_row']=$this->consultant_form->getdetail($sr_no);
          $data['members']=$this->consultant_form->getmember($sr_no);
      
          $data['auth_id']=$auth_id;
          $this->load->helper(array('dompdf', 'file'));
          $ff= $this->load->view('consultant/view_consultancy_form_print.php',$data,TRUE);
          pdf_create($ff, 'consultancy_form'.$sr_no);

  }
  function view_action($sr_no,$modv='')
  {
      $data['action']=$this->consultant_form->get_data_action($sr_no);
      $data['cons_row']=$this->consultant_form->getdetail($sr_no);

      $this->drawheader('Title: '.$data['cons_row']->consultancy_title);
      $this->load->view('consultant/view_action',$data);
  }
  function add_action($sr_no,$remark,$status,$auth)
  {
      $date = date("Y-m-d H:i:s");
      $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
  }
    
  private function upload_file($name ='',$sno = 0)
  {
      $config['upload_path'] = 'assets/files/consultant/form';
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
             
              $filename='CONSULTANCY_'.date('YmdHis').$sno.$ext;
          }
      }
      else
      {
          $this->session->set_flashdata('flashError','ERROR: File Name not set.');
          redirect('consultant/consultant/index');
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
  private function upload_scope($name ='',$sno = 0)
  {
      $config['upload_path'] = 'assets/files/consultant/SCOPE_WORK';
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
          redirect('consultant/consultant/index');
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