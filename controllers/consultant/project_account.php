<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date:  8 April 2016
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Project_account extends MY_Controller {

    function __construct()
    {
        parent::__construct(array('emp'));
        //$this->emp_id = $this->session->userdata('id');
        $this->addJS("consultant/disbursement.js");
        //$this->addJS('consultant/consultant_disbursement.js');
        //$this->addJS('consultant/disbursement_consultant.js');
        //
        $this->addJS('consultant/consultant.js');
        $this->load->model('consultant/consultant_form','',TRUE);
        //
        $this->load->model('consultant/consultant_disbursement_sheet_model','',TRUE);
        $this->load->model('consultant/consultant_disbursement_details_model','',TRUE);
        $this->load->model('consultant/consultant_help_model','',TRUE);
        $this->load->model('employee/emp_basic_details_model','',TRUE);
         $this->load->model('consultant/consultancy_proposal_approve_model','',TRUE);
         $this->load->model('consultant/consultant_form','',TRUE);
        $this->load->model('consultant/consultancy_proposal_form_model','',TRUE);
         $this->load->model('consultant/project_accounts','project_account',TRUE);
    }
    public function fill()
    {
      $data['cons_row'] = $this->project_account->get_disbursement_form();
      $this->drawheader('Fill Porject Account Form');
      $this->load->view('consultant/apply_project_account_form',$data);

    }
     public function form($sr_no)
    {
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      $var1 = $var[0];
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$sr_no;
      /***************details*********************/
      
      $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
      $data['emp_no']=$this->session->userdata('id');
      $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
      $data['emp_name']=$this->session->userdata('name');
      $data['dept_id']=$this->session->userdata('dept_id');
      $data['designation']=$this->session->userdata('designation');
      $this->load->model('departments_model','',TRUE);
      $data['departments']=$this->departments_model->get_departments();
      $data['form1']=$this->consultant_form->getdetail_array($sr_no);
      //print_r($data['form1']);
      $data['auth_id']='ft';
      $data['details'] = $this->consultant_disbursement_sheet_model->get_default($sr_no);
      $data['detail']=$this->project_account->get_staffs($sr_no);
      //print_r($data['detail']);
      $data['details2']=$this->project_account->get_consultant($sr_no);
      /************************************/
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->drawHeader("PROJECT ACCOUNTS");
      $this->load->view('consultant/project_account', $data);
      $this->drawFooter();
    }
    function confirmation($sr_no)
    {
                  $date = date("Y-m-d H:i:s");
                  $data = array(//'consultancy_no'=>$this->input->post('consultancy_no'),
                  'sr_no' => $sr_no,
                  'total_charge'=>$this->input->post('a_total_charges'),
                  'service_tax'=>$this->input->post('a_services_tax'),
                  'total_amt'=>$this->input->post('a_total_amount'),
                  'expenditure'=>$this->input->post('a_actual_expenditure'), 
                  'balance'=>$this->input->post('a_balance_available'),
                  
                  'timestamp'=>$date,
                
                  'institute_charge'=>$this->input->post('b_institue_support_charges'),
                  'dep_dev'=>$this->input->post('b_department_devlopment_fund'),
                  'prof_dev'=>$this->input->post('b_professional_devlopment_fund'),
                  'benevolent_fund'=>$this->input->post('b_benevolent_fund'),
                  'central_charge'=>$this->input->post('b_central_administrative_charges'),
                  'saving_inst_dev_fund'=>$this->input->post('saving_inst_dev_fund'),
                  'saving_dept_fund'=>$this->input->post('saving_dept_fund'),
                  'income_tax'=>$this->input->post('income_tax'),
                  'edc_dev'=>$this->input->post('b_edc_development_fund'),
                  'edc_lodging'=>$this->input->post('b_edc_lodging_boarding'),
                  'edc_xerox'=>$this->input->post('b_edc_xeroxing'),
                  'ism_vehicle'=>$this->input->post('b_ism_vehicle'),
                  'alumni_fund'=>$this->input->post('b_alumni_fund'),
                  
                  'other_payment'=>$this->input->post('b_other_payments'),
                  'total_credit'=>$this->input->post('b_total_credit'),
                  'balance'=>$this->input->post('c_balance_available'),
                  'total_credit'=>$this->input->post('c_total_credit'),
                  'net_amt'=>$this->input->post('c_net_amount'),
                 
                  'modification_value'=> 0 );
                  $this->db->trans_start();
                  $this->project_account->insert_detail($data);
                  $no_of_emp =$this->input->post('total_emp');
                  $emp_detail = array();
                  for($i=1;$i<$no_of_emp;$i++)
                  {
                      array_push($emp_detail, array(
                          'emp_no'=>$this->input->post('emp_no'.$i),
                        'bank_accno'=>$this->input->post('account_no'.$i),
                        'gross_amt'=>$this->input->post('gross_amt'.$i),
                        'income_tax'=>$this->input->post('income_tax_m'.$i),
                        'amount_paylable'=>$this->input->post('amount_paylable'.$i),
                        'sr_no' => $sr_no,
                        'modification_value'=> 0));
                  } 
                  //print_r($emp_detail);
                  $this->project_account->insert_emp($emp_detail);
                  $status = 104;
                  $this->add_action($sr_no,'project_account form has applied',104,'c_i' );
                  $this->consultant_disbursement_details_model->disbursement_approve($sr_no,104);
                  $this->send_noitification_consultancy($sr_no,$status);
                  $this->db->trans_complete();
                  // $this->session->set_flashdata('flashSuccess','Project Account Form has been successfully submited.');
                  // redirect('home');

    }
    function send_noitification_consultancy($sr_no,$status)
    {
          $data2=$this->consultant_disbursement_details_model->get_ci($sr_no);
          $id_ci=$data2->emp_no;
          $data=$this->consultant_disbursement_details_model->get_default($sr_no);
          foreach($data as $var)
          {}
          $title1 = "check the status.";
          if($status == 104)
          {
              $id=$this->consultant_help_model->get_pce();
              if(is_null($id))
              {
                  $this->session->set_flashdata('flashError','PCE has not been allocated it currently not exist.');
                  redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod');
              }
              //print_r($id);
              $link = "consultant/project_account/view/".$sr_no.'/pce';
              $title = "Please check and approve  .";
              $description= " Assistant Registrar(Project) has filled account project form  with consultancy No. ".$sr_no.'.';
              $this->notification->notify($id,"pce",$title,$description,$link,"");

            
              $description1= " Assistant Registrar(Project) has filled account project form  with consultancy No. ".$sr_no.'.';
              $link1 = "consultant/project_account/view/".$sr_no.'/ft';
              $this->notification->notify($id_ci,"emp",$title1,$description1,$link1,"");
          }
          else if($status == 105)
          {
              

              $id=$this->consultant_help_model->get_ar_proj();
              if(is_null($id))
              {
                  $this->session->set_flashdata('flashError','Assistant Registrar(Project) has not been allocated, it currently not exist.');
                  redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
              }
              $title = "Please edit the form.";
              $link = "consultant/project_account/edit/".$sr_no.'/ar';
              $description1= " project account form with title ".$var->consultancy_title.' has been rejected';
              $this->notification->notify($id,"acc_ar_prj",$title,$description1,$link,"");
              $link1 = "consultant/project_account/view/".$sr_no.'/ft';
              $this->notification->notify($id_ci,"emp",$title1,$description1,$link1,"");
          }
          else if($status == 106)
          {
              
              $id=$this->consultant_help_model->get_dt();
              $id1=$this->consultant_help_model->get_ar_proj();
              if(is_null($id))
              {
                  $this->session->set_flashdata('flashError','Director has not been allocated, it currently not exist.');
                  redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
              }
              $link = "consultant/project_account/view/".$sr_no.'/dt';
              $title = "Please check and approve  .";
              $description= " PCE has recommended account project form  with title. ".$var->consultancy_title.'.';
              $this->notification->notify($id,"dt",$title,$description,$link,"");

              $description1= " Pce has recommended  project account form with title ".$var->consultancy_title.'.';
              $link1 = "consultant/project_account/view/".$sr_no.'/ar';
              $link2 = "consultant/project_account/view/".$sr_no.'/ft';
              $this->notification->notify($id1,"acc_ar_prj",$title1,$description1,$link1,"");
              
              $this->notification->notify($id_ci,"emp",$title1,$description1,$link2,"");
          }
          else if($status == 107)
          {

              $id=$this->consultant_help_model->get_ar_proj();
              if(is_null($id))
              {
                  $this->session->set_flashdata('flashError','Assistant Registrar(Project) has not been allocated, it currently not exist.');
                  redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
              }
              
              $description1= " Pce has approved and senctioned  project account form with title ".$var->consultancy_title.'.';
              $link1 = "consultant/project_account/view/".$sr_no.'/ar';
              $link2 = "consultant/project_account/view/".$sr_no.'/ft';
              $this->notification->notify($id,"acc_ar_prj",$title1,$description1,$link1,"");
              
              $this->notification->notify($id_ci,"emp",$title1,$description1,$link2,"");
          }
          else if($status == 108)
          {

              $id=$this->consultant_help_model->get_ar_proj();
              if(is_null($id))
              {
                  $this->session->set_flashdata('flashError','Assistant Registrar(Project) has not been allocated, it currently not exist.');
                  redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
              }
              
              $description1= " Director has approved and senctioned  project account form with title ".$var->consultancy_title.'.';
              $link1 = "consultant/project_account/view/".$sr_no.'/ar';
              $link2 = "consultant/project_account/view/".$sr_no.'/ft';
              $this->notification->notify($id,"acc_ar_prj",$title1,$description1,$link1,"");
              
              $this->notification->notify($id_ci,"emp",$title1,$description1,$link2,"");
          }

         
    }
    public function edit($sr_no)
    {
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      $var1 = $var[0];
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$sr_no;
      /***************details*********************/
      
      $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
      $data['emp_no']=$this->session->userdata('id');
      $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
      $data['emp_name']=$this->session->userdata('name');
      $data['dept_id']=$this->session->userdata('dept_id');
      $data['designation']=$this->session->userdata('designation');
      $this->load->model('departments_model','',TRUE);
      $data['departments']=$this->departments_model->get_departments();
      $data['form1']=$this->consultant_form->getdetail_array($sr_no);
      //print_r($data['form1']);
      $data['auth_id']='ft';
      $data['details'] = $this->project_account->get_detail($sr_no);
      $data['detail']=$this->project_account->get_emp($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      /************************************/
      $this->drawHeader("PROJECT ACCOUNTS");
      $this->load->view('consultant/project_account_edit', $data);
      $this->drawFooter();
    }
    public function reconfirmation($sr_no)
    {
                 $date = date("Y-m-d H:i:s");
                  $data = array(//'consultancy_no'=>$this->input->post('consultancy_no'),
                  'sr_no' => $sr_no,
                  'total_charge'=>$this->input->post('a_total_charges'),
                  'service_tax'=>$this->input->post('a_services_tax'),
                  'total_amt'=>$this->input->post('a_total_amount'),
                  'expenditure'=>$this->input->post('a_actual_expenditure'), 
                  'balance'=>$this->input->post('a_balance_available'),
                  
                  'timestamp'=>$date,
                
                  'institute_charge'=>$this->input->post('b_institue_support_charges'),
                  'dep_dev'=>$this->input->post('b_department_devlopment_fund'),
                  'prof_dev'=>$this->input->post('b_professional_devlopment_fund'),
                  'benevolent_fund'=>$this->input->post('b_benevolent_fund'),
                  'central_charge'=>$this->input->post('b_central_administrative_charges'),
                  'saving_inst_dev_fund'=>$this->input->post('saving_inst_dev_fund'),
                  'saving_dept_fund'=>$this->input->post('saving_dept_fund'),
                  'income_tax'=>$this->input->post('income_tax'),
                  'edc_dev'=>$this->input->post('b_edc_development_fund'),
                  'edc_lodging'=>$this->input->post('b_edc_lodging_boarding'),
                  'edc_xerox'=>$this->input->post('b_edc_xeroxing'),
                  'ism_vehicle'=>$this->input->post('b_ism_vehicle'),
                  'alumni_fund'=>$this->input->post('b_alumni_fund'),
                  
                  'other_payment'=>$this->input->post('b_other_payments'),
                  'total_credit'=>$this->input->post('b_total_credit'),
                  'balance'=>$this->input->post('c_balance_available'),
                  'total_credit'=>$this->input->post('c_total_credit'),
                  'net_amt'=>$this->input->post('c_net_amount'),
                 
                  'modification_value'=> $this->input->post('modification_value') +1  );
                  $this->db->trans_start();
                  $this->project_account->edit_detail($sr_no);
                  $no_of_emp =$this->input->post('total_emp');
                  $emp_detail = array();
                  for($i=1;$i<$no_of_emp;$i++)
                  {
                      array_push($emp_detail, array(
                          'emp_no'=>$this->input->post('emp_no'.$i),
                        'bank_accno'=>$this->input->post('account_no'.$i),
                        'gross_amt'=>$this->input->post('gross_amt'.$i),
                        'income_tax'=>$this->input->post('income_tax_m'.$i),
                        'amount_paylable'=>$this->input->post('amount_paylable'.$i),
                        'sr_no' => $sr_no,
                        'modification_value'=> $this->input->post('modification_value') +1));
                  } 
                  //print_r($emp_detail);
                  $this->project_account->edit_emp($sr_no);
                  $this->project_account->update_detail($data);
                  $this->project_account->update_emp($emp_detail);
                  $this->add_action($sr_no,'project_account form has been updated',104,'c_i' );
                  $this->consultant_disbursement_details_model->disbursement_approve($sr_no,104);
                  $this->send_noitification_consultancy($sr_no,$status);
                  $this->db->trans_complete();
                  $this->session->set_flashdata('flashSuccess','Project Account Form has been successfully submited.');
                  redirect('home');
    }
    public function view($sr_no,$auth_id='ft')
    {
       $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      $var1 = $var[0];
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$sr_no;
      /***************details*********************/
      $data['cutoff'] = 200000;
      $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
      $data['emp_no']=$this->session->userdata('id');
      $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
      $data['emp_name']=$this->session->userdata('name');
      $data['dept_id']=$this->session->userdata('dept_id');
      $data['designation']=$this->session->userdata('designation');
      $this->load->model('departments_model','',TRUE);
      $data['departments']=$this->departments_model->get_departments();
      $data['form1']=$this->consultant_form->getdetail_array($sr_no);
      //print_r($data['form1']);
      $data['auth_id']=$auth_id;
      $data['details'] = $this->project_account->get_detail($sr_no);
      $data['detail']=$this->project_account->get_emp($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      /************************************/
      $this->drawHeader("PROJECT ACCOUNTS");
      $this->load->view('consultant/project_account_view', $data);
      $this->drawFooter();
    }
    function view_all($auth_id)
    {
      $data['auth_id']=$auth_id;
      $data['cons_row'] = $this->project_account->get_project_account_form();
      $this->drawheader('Fill Porject Account Form');
      $this->load->view('consultant/view_project_account_form',$data);
    }
    function approve($sr_no,$auth_id)
    {
        $status = $this->project_account->getStatus($sr_no);
        if($auth_id == 'pce')
        {

          
          if($status != 104)
          {
            $this->session->set_flashdata('flashError','You have  already submitted your response.');
            redirect('home');
          }
            if($this->input->post('action_taken')=='Are You Sure To Approve')
            {
              $status=107;
              $remark="Project Account has been approved";
            }
            else if($this->input->post('action_taken')=='Are You Sure To Recommend')
            {
              $status=106;
              $remark="Project Account has been recommend to Director";
            }
            else if($this->input->post('action_taken')=='Are You Sure To Reject')
            {
              $status=105;
              $remark=$this->input->post('remark_text2');
            }
        }
        else if($auth_id == 'dt')
        {
            //print_r($status);
            if($status != 106)
            {
              $this->session->set_flashdata('flashError','You dont have permission');
              redirect('home');
            }
            if($this->input->post('action_taken')=='Are You Sure To Approve')
            {
              $status=108;
              $remark="Project Account has been approved";
            }
           
            else if($this->input->post('action_taken')=='Are You Sure To Reject')
            {
              $status=105;
              $remark=$this->input->post('remark_text2');
            }
        }

        $this->add_action($sr_no,$remark,$status,$auth_id);
        $data['status']=$status;
        $this->send_noitification_consultancy($sr_no,$status);
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
        $this->db->trans_complete();
        // $this->session->set_flashdata('flashSuccess','You have submitted your response.');
        // redirect('home');
          
    }
    function add_action($sr_no,$remark,$status,$auth)
    {
        $date = date("Y-m-d H:i:s");
        $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
    }
}