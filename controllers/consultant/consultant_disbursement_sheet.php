<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultant_disbursement_sheet extends MY_Controller
{
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
    }
    function disbursement($sr_no)
    {
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      foreach($var as $var1)
      {}
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
        $data['auth_id']='ft';
        $mod=$this->consultant_disbursement_details_model->get_default($sr_no);
        if(!empty($mod))
        {
           $this->session->set_flashdata('flashError','Consultant disbursement sheet has been already submited.');
          redirect('home'); 
        }
      /************************************/
      $this->drawHeader("Disbursement Sheet");
    $this->load->view('consultant/consultant_disbursement_sheet', $data);
    $this->drawFooter();
    }

  public function confirmation($consultancy_no,$sr_no)
  {
    /***************upload***************/
    $upload1=$this->upload_file('expenditure_path',$sr_no);
    /**********************************/
    if($upload1)
    {
        $var=$this->consultant_disbursement_details_model->get_consultancy_title($sr_no);
        foreach($var as $var1)
        {}
        $title=$var1->consultancy_title;
        $id_user = $this->session->userdata('id');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('consultant/consultant_disbursement_sheet_model','',TRUE);
        $this->drawHeader("Details of Disbursement To Consultants:");
        $this->form_validation->set_rules('a_total_charges', '', 'required');
        $this->form_validation->set_rules('a_services_tax', '', 'required');
        $this->form_validation->set_rules('c_amount_released', '', 'required');
        //$this->form_validation->set_rules('a_receipt_no', 'Receipt No', 'required');
        if ($this->form_validation->run() == FALSE)
        {
          //$data['details'] = $this->consultancy_proposal_form_model->get_default($id_user);
          /***************details*********************/
            $this->load->model('employee/emp_basic_details_model','',TRUE);
              $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
              $data['emp_no']=$this->session->userdata('id');
              $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
              $data['emp_name']=$this->session->userdata('name');
              $data['dept_id']=$this->session->userdata('dept_id');
              $data['designation']=$this->session->userdata('designation');
              $this->load->model('departments_model','',TRUE);
              $data['departments']=$this->departments_model->get_departments();
            /************************************/
          $this->load->view('consultant/consultant_disbursement_sheet',$data);
        }
        else
        {
          $date = date("Y-m-d H:i:s");
          $data = array(//'consultancy_no'=>$this->input->post('consultancy_no'),
                  'a_total_charge'=>$this->input->post('a_total_charges'),
                  'a_services_tax'=>$this->input->post('a_services_tax'),
                  'a_total_amt'=>$this->input->post('a_total_amount'),
                  'a_expenditure'=>$this->input->post('a_actual_expenditure'), 
                  'a_balance'=>$this->input->post('a_balance_available'),
                  'receipt_no'=>$this->input->post('a_receipt_no'),
                  'timestamp'=>$this->input->post('date'),
                  /*************upload**********/
                  'file_path'=>$upload1['file_name'],
                  /***************************************************/
                  'b_services_tax'=>$this->input->post('b_services_tax'),
                  'b_institute_charge'=>$this->input->post('b_institue_support_charges'),
                  'b_dep_dev'=>$this->input->post('b_department_devlopment_fund'),
                  'b_prof_dev'=>$this->input->post('b_professional_devlopment_fund'),
                  'b_benevolent_fund'=>$this->input->post('b_benevolent_fund'),
                  'b_central_charge'=>$this->input->post('b_central_administrative_charges'),
                  'b_edc_dev'=>$this->input->post('b_edc_development_fund'),
                  'b_edc_lodging'=>$this->input->post('b_edc_lodging_boarding'),
                  'b_edc_xerox'=>$this->input->post('b_edc_xeroxing'),
                  'b_ism_vehicle'=>$this->input->post('b_ism_vehicle'),
                  'b_alumni_fund'=>$this->input->post('b_alumni_fund'),
                  'b_equip_charge'=>$this->input->post('b_equipment_charges'),
                  'b_other_payment'=>$this->input->post('b_other_payments'),
                  'b_total_credit'=>$this->input->post('b_total_credit'),
                  'c_balance'=>$this->input->post('c_balance_available'),
                  'c_total_credit'=>$this->input->post('c_total_credit'),
                  'c_net_amt'=>$this->input->post('c_net_amount'),
                  'c_release_amt'=>$this->input->post('c_amount_released'),
                  'c_net_saving'=>$this->input->post('c_net_savings'),
                  'c_dist_save1'=>$this->input->post('c_institue_development'),
                  'c_dist_save2'=>$this->input->post('c_dept_development'),
                  'timestamp1'=>$date,
                  'modification_value'=> 0
                  );
          /*******************************MODIFICATION VALUE*************************************/
          
          /**************************deleting previous data*************************************/
          // $this->consultant_disbursement_details_model->delete_disbursement($consultancy_no);
          // $this->consultant_disbursement_details_model->delete_disbursement_members($consultancy_no);
          // $this->consultant_disbursement_details_model->delete_disbursement_staffs($consultancy_no);
          /*************************************************************************************/
          $data['consultancy_no']=$consultancy_no;
          $data['consultancy_title']=$title;
          $data['sr_no']=$sr_no;
          $this->consultant_disbursement_sheet_model->insert($data);
          /***********************************faculty********************************************/
          

          $total_emp=array();
          $total_staff=array();
          $no_of_member=$this->input->post('member');
          for($i=1;$i<=$no_of_member;$i++)
          {
            $data1=array('emp_no'=>$this->input->post('emp_no'.$i),
                        'position'=>$this->input->post('position_select'.$i),
                        'gross_amt'=>$this->input->post('gross_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value'=> 0
                        );
            /**************************************************/
            if($data1['position']=='ci')
                {
                  $data['c_i']=$data1['emp_no'];
                 }
            /***************************************************/
           array_push($total_emp,$data1);
          }
          
          foreach($total_emp as $key => $emp)
          {
            $this->consultant_disbursement_details_model->insert_member($emp);
          }
         
          
                        
          /*********************************************************************************/
          /******************************staff*************************************************/
          $no_of_staff=$this->input->post('staff');
          
          for($i=1;$i<=$no_of_staff;$i++)
          {
            $data2=array('emp_no'=>$this->input->post('e_emp_no'.$i),
                        'position'=>$this->input->post('e_position_select'.$i),
                        'amount'=>$this->input->post('e_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value'=> 0
                        );

            array_push($total_staff,$data2);
          }
          
          foreach($total_staff as $key => $staff)
          {
            $this->consultant_disbursement_details_model->insert_staff($staff);
          }
          /***********************************notice**********************************************
          

          $dept = $this->consultant_disbursement_sheet_model->getDept($id_user);
          $data['hod_id'] = $this->consultant_disbursement_sheet_model->getHodId($dept);
          var_dump($data['hod_id']);
          
          //$consultancy_no=$this->input->post('consultancy_no');
          $title = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $description = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $link = "consultant/consultant_disbursement_sheet/disbursement_view_hod/".$consultancy_no.'/'.$sr_no.'/hod';
          $this->notification->notify($data['hod_id'],"emp",$title,$description,$link,"");
          ***********************************************************************************/
           
          $this->add_action($data['sr_no'],'disbursement sheet has been applied',99,'c_i' );
          $this->consultant_disbursement_details_model->disbursement_approve($sr_no,99);
          $this->send_noitification_consultancy($data,$consultancy_no,$sr_no);

          $this->session->set_flashdata('flashSuccess','Consultant disbursement sheet has been successfully submited.');
          redirect('home');
        }
        
        $this->drawFooter();
    }
  }
  function resubmit($cons_no,$sr_no)
    {
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$sr_no;
      $data['auth_id'] = $this->session->userdata('id');
      //$data['sr_no']=$sr_no;
      /***************details*********************/
      
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
        $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);

        $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
        $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      /************************************/
      $this->drawHeader("Details of Disbursement To Consultants:");
    $this->load->view('consultant/consultant_disbursement_resubmit', $data);
    $this->drawFooter();
    }
  function ciview($sr_no)
    {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['auth_id'] = $this->session->userdata('id');
      $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/consultant_disbursement_ciview_hod',$data);
      $this->drawFooter();
    }
  public function reconfirmation($consultancy_no,$sr_no)
  {
    $var=$this->consultant_disbursement_details_model->get_consultancy_title($sr_no);
    foreach($var as $var1)
    {}
    $title=$var1->consultancy_title;
    if($_FILES['expenditure_path']['name'] != '')
    {
        /***************upload***************/
        $upload1=$this->upload_file('expenditure_path',$sr_no);
        /**********************************/
        if($upload1)
        {
            
          $date = date("Y-m-d H:i:s");
          $data = array(//'consultancy_no'=>$this->input->post('consultancy_no'),
                  'a_total_charge'=>$this->input->post('a_total_charges'),
                  'a_services_tax'=>$this->input->post('a_services_tax'),
                  'a_total_amt'=>$this->input->post('a_total_amount'),
                  'a_expenditure'=>$this->input->post('a_actual_expenditure'), 
                  'a_balance'=>$this->input->post('a_balance_available'),
                  'receipt_no'=>$this->input->post('a_receipt_no'),
                  'timestamp'=>$this->input->post('date'),
                  /*************upload**********/
                  'file_path'=>$upload1['file_name'],
                  /***************************************************/
                  'b_services_tax'=>$this->input->post('b_services_tax'),
                  'b_institute_charge'=>$this->input->post('b_institue_support_charges'),
                  'b_dep_dev'=>$this->input->post('b_department_devlopment_fund'),
                  'b_prof_dev'=>$this->input->post('b_professional_devlopment_fund'),
                  'b_benevolent_fund'=>$this->input->post('b_benevolent_fund'),
                  'b_central_charge'=>$this->input->post('b_central_administrative_charges'),
                  'b_edc_dev'=>$this->input->post('b_edc_development_fund'),
                  'b_edc_lodging'=>$this->input->post('b_edc_lodging_boarding'),
                  'b_edc_xerox'=>$this->input->post('b_edc_xeroxing'),
                  'b_ism_vehicle'=>$this->input->post('b_ism_vehicle'),
                  'b_alumni_fund'=>$this->input->post('b_alumni_fund'),
                  'b_equip_charge'=>$this->input->post('b_equipment_charges'),
                  'b_other_payment'=>$this->input->post('b_other_payments'),
                  'b_total_credit'=>$this->input->post('b_total_credit'),
                  'c_balance'=>$this->input->post('c_balance_available'),
                  'c_total_credit'=>$this->input->post('c_total_credit'),
                  'c_net_amt'=>$this->input->post('c_net_amount'),
                  'c_release_amt'=>$this->input->post('c_amount_released'),
                  'c_net_saving'=>$this->input->post('c_net_savings'),
                  'c_dist_save1'=>$this->input->post('c_institue_development'),
                  'c_dist_save2'=>$this->input->post('c_dept_development'),
                  'timestamp1'=>$date,
                  'modification_value'=>($this->input->post('modification_value') + 1)
                  );
          /*******************************MODIFICATION VALUE*************************************/
          $mod=$this->consultant_disbursement_details_model->get_default($sr_no);
          //print_r($mod);
          $total_emp=$this->consultant_disbursement_details_model->get_member($sr_no);
          $total_staff=$this->consultant_disbursement_details_model->get_staffs_member($sr_no);
          
          foreach($total_emp as $key => $emp)
          {
            $total_emp[$key]->modification_value=$data['modification_value'];
            if($emp->position=='ci')
            {
              $total_emp[$key]->gross_amt=$this->input->post('gross_amt_ci');
            }
            if($this->input->post('emp_check'.$emp->emp_no))
             {
                unset($total_emp[$key]);
             }
          }
          foreach($total_staff as $key => $staff)
          {
            $total_emp[$key]->modification_value=$data['modification_value'];
            if($this->input->post('staff_check'.$staff->emp_no))
             {
                unset($total_staff[$key]);
             }
          }

          
          /************************************************************************************/
          $data['consultancy_no']=$consultancy_no;
          $data['consultancy_title']=$title;
          $data['sr_no']=$sr_no;
          $this->consultant_disbursement_sheet_model->disbursement_mod($sr_no);
          $this->consultant_disbursement_sheet_model->update($data);
          
          /***********************************faculty********************************************/
          $no_of_member=$this->input->post('member');
          for($i=1;$i<=$no_of_member;$i++)
          {
            $data1=array('emp_no'=>$this->input->post('emp_no'.$i),
                        'position'=>$this->input->post('position_select'.$i),
                        'gross_amt'=>$this->input->post('gross_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value'=>($this->input->post('modification_value') + 1)
                        );
            /**************************************************/
            if($data1['position']=='ci')
                {
                  $data['c_i']=$data1['emp_no'];
                 }
            /***************************************************/
           array_push($total_emp,$data1);
          }
          $this->db->trans_start();
          $this->consultant_disbursement_details_model->insert_member_mod($sr_no);
          foreach($total_emp as $key => $emp)
          {
            $this->consultant_disbursement_details_model->insert_member($emp);
          }
         
          
                        
          /*********************************************************************************/
          /******************************staff*************************************************/
          $no_of_staff=$this->input->post('staff');
          
          for($i=1;$i<=$no_of_staff;$i++)
          {
            $data2=array('emp_no'=>$this->input->post('e_emp_no'.$i),
                        'position'=>$this->input->post('e_position_select'.$i),
                        'amount'=>$this->input->post('e_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value'=>($this->input->post('modification_value') + 1)
                        );

            array_push($total_staff,$data2);
          }
          
          $this->consultant_disbursement_details_model->insert_staff_mod($sr_no);
          foreach($total_staff as $key => $staff)
          {
            $this->consultant_disbursement_details_model->insert_staff($staff);
          }
          
          
      


                  
          /***********************************notice**********************************************
          

          $dept = $this->consultant_disbursement_sheet_model->getDept($id_user);
          $data['hod_id'] = $this->consultant_disbursement_sheet_model->getHodId($dept);
          var_dump($data['hod_id']);
          
          //$consultancy_no=$this->input->post('consultancy_no');
          $title = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $description = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $link = "consultant/consultant_disbursement_sheet/disbursement_view_hod/".$consultancy_no.'/'.$sr_no.'/hod';
          $this->notification->notify($data['hod_id'],"emp",$title,$description,$link,"");
          ***********************************************************************************/
           
          $this->add_action($data['sr_no'],'disbursement sheet has been applied',99,'c_i' );
          $this->consultant_disbursement_details_model->disbursement_approve($sr_no,99);
          $this->send_noitification_consultancy($data,$consultancy_no,$sr_no);
          $this->db->trans_complete();
          $this->session->set_flashdata('flashSuccess','Consultant disbursement sheet has been successfully submited.');
          redirect('home');
        }
    }
    else
    {
        
          $date = date("Y-m-d H:i:s");
          $data = array(//'consultancy_no'=>$this->input->post('consultancy_no'),
                  'a_total_charge'=>$this->input->post('a_total_charges'),
                  'a_services_tax'=>$this->input->post('a_services_tax'),
                  'a_total_amt'=>$this->input->post('a_total_amount'),
                  'a_expenditure'=>$this->input->post('a_actual_expenditure'), 
                  'a_balance'=>$this->input->post('a_balance_available'),
                  'receipt_no'=>$this->input->post('a_receipt_no'),
                  'timestamp'=>$this->input->post('date'),
                  /***************************************************/
                  'b_services_tax'=>$this->input->post('b_services_tax'),
                  'b_institute_charge'=>$this->input->post('b_institue_support_charges'),
                  'b_dep_dev'=>$this->input->post('b_department_devlopment_fund'),
                  'b_prof_dev'=>$this->input->post('b_professional_devlopment_fund'),
                  'b_benevolent_fund'=>$this->input->post('b_benevolent_fund'),
                  'b_central_charge'=>$this->input->post('b_central_administrative_charges'),
                  'b_edc_dev'=>$this->input->post('b_edc_development_fund'),
                  'b_edc_lodging'=>$this->input->post('b_edc_lodging_boarding'),
                  'b_edc_xerox'=>$this->input->post('b_edc_xeroxing'),
                  'b_ism_vehicle'=>$this->input->post('b_ism_vehicle'),
                  'b_alumni_fund'=>$this->input->post('b_alumni_fund'),
                  'b_equip_charge'=>$this->input->post('b_equipment_charges'),
                  'b_other_payment'=>$this->input->post('b_other_payments'),
                  'b_total_credit'=>$this->input->post('b_total_credit'),
                  'c_balance'=>$this->input->post('c_balance_available'),
                  'c_total_credit'=>$this->input->post('c_total_credit'),
                  'c_net_amt'=>$this->input->post('c_net_amount'),
                  'c_release_amt'=>$this->input->post('c_amount_released'),
                  'c_net_saving'=>$this->input->post('c_net_savings'),
                  'c_dist_save1'=>$this->input->post('c_institue_development'),
                  'c_dist_save2'=>$this->input->post('c_dept_development'),
                  'timestamp1'=>$date,
                  'modification_value'=>($this->input->post('modification_value') + 1)
                  );
          /*******************************MODIFICATION VALUE*************************************/
          $mod=$this->consultant_disbursement_details_model->get_default($sr_no);
          //print_r($mod);
          $total_emp=$this->consultant_disbursement_details_model->get_member($sr_no);
          $total_staff=$this->consultant_disbursement_details_model->get_staffs_member($sr_no);
          //print_r($total_emp);
          foreach($total_emp as $key => $emp)
          {
            $total_emp[$key]->modification_value=$data['modification_value'];
            
            if($emp->position=='ci')
            {
              $total_emp[$key]->gross_amt=$this->input->post('gross_amt_ci');
            }
            if($this->input->post('emp_check'.$emp->emp_no))
             {
                unset($total_emp[$key]);
             }
          }
          
          foreach($total_staff as $key => $staff)
          {
            $total_staff[$key]->modification_value=$data['modification_value'];
            //print_r($total_staff[$key]->modification_value);
            if($this->input->post('staff_check'.$staff->emp_no))
             {
                unset($total_staff[$key]);
             }
          }

          
          /************************************************************************************/
          $data['consultancy_no']=$consultancy_no;
          $data['consultancy_title']=$title;
          $data['sr_no']=$sr_no;
          $this->consultant_disbursement_sheet_model->disbursement_mod($sr_no);
          $this->consultant_disbursement_sheet_model->update($data);
          
          /***********************************faculty********************************************/
          $no_of_member=$this->input->post('member');
          for($i=1;$i<=$no_of_member;$i++)
          {
            $data1=array('emp_no'=>$this->input->post('emp_no'.$i),
                        'position'=>$this->input->post('position_select'.$i),
                        'gross_amt'=>$this->input->post('gross_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value' => ($this->input->post('modification_value') + 1)
                        );
            /**************************************************/
            if($data1['position']=='ci')
                {
                  $data['c_i']=$data1['emp_no'];
                 }
            /***************************************************/
           array_push($total_emp,$data1);
          }
          $this->db->trans_start();
          $this->consultant_disbursement_details_model->insert_member_mod($sr_no);
          foreach($total_emp as $key => $emp)
          {
            $this->consultant_disbursement_details_model->insert_member($emp);
          }
         
          
                        
          /*********************************************************************************/
          /******************************staff*************************************************/
          $no_of_staff=$this->input->post('staff');
          
          for($i=1;$i<=$no_of_staff;$i++)
          {
            $data2=array('emp_no'=>$this->input->post('e_emp_no'.$i),
                        'position'=>$this->input->post('e_position_select'.$i),
                        'amount'=>$this->input->post('e_amt'.$i),
                        'consultancy_no' => $consultancy_no,
                        'sr_no' => $sr_no,
                        'modification_value'=>($this->input->post('modification_value') + 1)
                        );

            array_push($total_staff,$data2);
          }
          
          $this->consultant_disbursement_details_model->insert_staff_mod($sr_no);
          foreach($total_staff as $key => $staff)
          {
            $this->consultant_disbursement_details_model->insert_staff($staff);
          }
          
          
      


                  
          /***********************************notice**********************************************
          

          $dept = $this->consultant_disbursement_sheet_model->getDept($id_user);
          $data['hod_id'] = $this->consultant_disbursement_sheet_model->getHodId($dept);
          var_dump($data['hod_id']);
          
          //$consultancy_no=$this->input->post('consultancy_no');
          $title = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $description = "Disbursement Sheet of Consultancy Project No.".$consultancy_no;
          $link = "consultant/consultant_disbursement_sheet/disbursement_view_hod/".$consultancy_no.'/'.$sr_no.'/hod';
          $this->notification->notify($data['hod_id'],"emp",$title,$description,$link,"");
          ***********************************************************************************/
           
          $this->add_action($data['sr_no'],'disbursement sheet has been updated ',99,'c_i' );
          $this->consultant_disbursement_details_model->disbursement_approve($sr_no,99);
          $this->send_noitification_consultancy($data,$consultancy_no,$sr_no);
          $this->db->trans_complete();
          $this->session->set_flashdata('flashSuccess','Consultant disbursement sheet has been successfully submited.');
          redirect('home');
      
    }
    $this->drawFooter();
}
  
  function disbursement_approve($cons_no,$sr_no,$auth_id)
  {
    //$data=$this->consultant_form->getdetail_array($sr_no);
    $data1=$this->consultant_disbursement_details_model->get_default($sr_no);
    foreach($data1 as $var)
    {}
    $data['status']=$var->status;
      $status=$data['status'];
      //$status=101;
      $remark=0;
      $auth='c_i';
      if($auth_id=='ft')
      {
         $auth='c_i';
        if($status == 99)
        {
            
            $this->session->set_flashdata('flashError','You have  already submitted your response.');
            redirect('home');

        }
        if($this->input->post('action_taken')=='Are You Sure To Cancel')
        {
            $status=99;
            $remark=$this->input->post('remark_text3');


        }
        
          
       
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
     }
      else if($auth_id=='hod')
      {
         $auth='hod';
        if($status != 99)
        {
            
            $this->session->set_flashdata('flashError','You have  already submitted your response.');
            redirect('home');

        }
       
        if($this->input->post('action_taken')=='Are You Sure To Forward')
        {
            $status=101;
            $remark='Forwarded by Hod';


        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=100;
          $remark=$this->input->post('remark_reject');
        }
          
       
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
     }
      else if($auth_id=='pce')
      {
         $auth='pce';
        if($status != 101)
        {
             $this->session->set_flashdata('flashError','You have  already submitted your response.');
            redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Forward')
        {
          $status=102;
          $remark='Forwarded by PCE';
          /*************************************************************************/
          $data['details']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $i=1;
      foreach($data['details'] as $row)
                {
                  $data1=array('gas_previous'=>$this->input->post('gas_previous'.$i),
                              'fy_gas_previous'=>$this->input->post('fy_gas_previous'.$i),
                              'total_current_fy'=>$this->input->post('total_current_fy'.$i));
                  $data2['emp_no']=$row->emp_no;
                  $data2['consultancy_no']=$row->consultancy_no;
                  //print_r($data1);
                  //print_r($i);
                
                       $this->consultant_disbursement_details_model->update_pce($data1,$data2);
                     $i++;
            }
        /*******************************Memo*********************************************/
                  $data3=array('consultancy_no'=>$this->input->post('memo_consultancy_no'),
                              'sr_no'=>$this->input->post('memo_si_no'),
                              'dated'=>$this->input->post('memo_dated'),
                              'client_name'=>$this->input->post('memo_client_name'),
                              'consultancy_incharge'=>$this->input->post('memo_consultancy_incharge'),
                              'department'=>$this->input->post('memo_department'),
                              'project_team1'=>$this->input->post('memo_prj_team1'),
                              'project_team2'=>$this->input->post('memo_prj_team2'),
                              'project_team3'=>$this->input->post('memo_prj_team3'),
                              'project_team4'=>$this->input->post('memo_prj_team4'),
                              'work_period'=>$this->input->post('memo_period'),
                              'submission_date'=>$this->input->post('memo_submission'),
                              'testing_charge'=>$this->input->post('memo_charge'),
                              'charge_received_date'=>$this->input->post('memo_charge_received'),
                              'bank_credit'=>$this->input->post('memo_bank_credit'),
                              'enclosure'=>$this->input->post('memo_pages'));
                  $this->consultant_disbursement_details_model->delete_pce_memo($cons_no);
                  $this->consultant_disbursement_details_model->insert_pce_memo($data3);
        /*************************************************************************/
        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=100;
          $remark=$this->input->post('remark_reject');
        }
          
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
        
      }
      else if($auth_id=='ar')
      {
         $auth='acc_ar_prj';
        if($status != 102)
        {
             $this->session->set_flashdata('flashError','You have  already submitted your response.');
            redirect('home');
        }
        if($this->input->post('action_taken')=='Are You Sure To Approve')
        {
          $status=103;
          $remark='Ar Prj Has Approved Disbursement Form';
        }
        else if($this->input->post('action_taken')=='Are You Sure To Reject')
        {
          $status=100;
          $remark=$this->input->post('remark_reject'); 
        }
          
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
      }
      $this->add_action($sr_no,$remark,$status,$auth);
      $data['status']=$status;
      $data['cons_no']=$cons_no;
      //print_r($data['c_i']);
      //print_r($auth_id);
      $this->send_noitification_consultancy($data,$cons_no,$sr_no);
      $this->session->set_flashdata('flashSuccess','You have submitted your response.');
      redirect('home');

  }
  /*******************************send notice************************************/
  function send_noitification_consultancy($data,$cons_no,$sr_no)
    {
        $data2=$this->consultant_disbursement_details_model->get_ci($sr_no);
       
        $id_ci=$data2->emp_no;
        $data=$this->consultant_disbursement_details_model->get_default($sr_no);
        foreach($data as $var)
        {}
        $data1['status']=$var->status;
        $description = "Employee with emp_no ".$id_ci." had appllied for Disbursement Sheet with title ".$var->consultancy_title.'.';
        $title = "Please check and approve  .";
        $description1= $this->session->userdata("designation")." has approved  Disbursement Sheet with title ".$var->consultancy_title.'.';
        $title1 = "check the status.";
        $link1 = "consultant/consultant_disbursement_sheet/ciview_pce/".$sr_no;
        
        $status=$data1['status'];
        //$status=102;
        if($status==99)
        {
          $link = "consultant/consultant_disbursement_sheet/disbursement_view_hod/".$cons_no.'/'.$sr_no.'/hod';
          $id=$this->consultant_help_model->get_hod($id_ci);
          if(is_null($id))
          {
            $link = "consultant/consultant_disbursement_sheet/disbursement_view_hod/".$cons_no.'/'.$sr_no.'/hod';
            $id=$this->consultant_help_model->get_hos($id_ci);
            $this->notification->notify($id,"hos",$title,$description,$link,"");
          
          }
          else
          {
            $this->notification->notify($id,"hod",$title,$description,$link,"");
          }
          
          
          
        }
        else if($status==100)
        {
            $description1= "Your disbursement Sheet with title ".$var->consultancy_title.' has been rejected.';
            $title1 = "Please edit this form";
            $link1 = "consultant/consultant_disbursement_sheet/disbursement_rejected/".$sr_no;
            $this->notification->notify($id_ci,"emp",$title1,$description1,$link1,"rejected");
        }
        else if($status==101)
        { 
          $id=$this->consultant_help_model->get_pce();
          if(is_null($id))
          {
              $this->session->set_flashdata('flashError','PCE has not been allocated it currently not exist.');
              redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod');
          }
          //print_r($id);
          $link = "consultant/consultant_disbursement_sheet/disbursement_view_pce/".$cons_no.'/'.$sr_no.'/pce';
          $this->notification->notify($id,"pce",$title,$description,$link,""); 
          $description1= " Hod/Hos has forwarded disbursement sheet with title ".$var->consultancy_title.'.';
          $this->notification->notify($id_ci,"emp",$title1,$description1,$link1,"");
        }
        else if($status==102)
        {
           $link = "consultant/consultant_disbursement_sheet/disbursement_view_arproject/".$cons_no.'/'.$sr_no.'/ar';

            $id=$this->consultant_help_model->get_ar_proj();
            if(is_null($id))
            {
                $this->session->set_flashdata('flashError','Assistant Registrar(Project) has not been allocated, it currently not exist.');
                redirect("consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/pce');
            }
            //print_r($id);
            $this->notification->notify($id,"acc_ar_prj",$title,$description,$link,"");
             $description1= " Pce has approved  disbursement sheet with title ".$var->consultancy_title.'.';
           $this->notification->notify($id_ci,"emp",$title1,$description1,$link1,"");
        }
        else if($status==103)
        {
          $description = "Assistant Registar has approved disbursement sheet with title ".$var->consultancy_title.'.';
          $title = "Disbursement Sheet Completed";
          $link = "consultant/consultant_disbursement_sheet/ciview/".$sr_no;
          $id=$this->consultant_help_model->get_dt();
          $this->notification->notify($id_ci,"emp",$title,$description,$link,"accepted");
        }
      


    }
  /******************************************************************************/
  public function disbursement_view_hod($cons_no,$sr_no,$auth_id)
  {
    /******************************validate***********************************************/
    $id_user1=$this->session->userdata('id');
    $ci=$this->consultant_disbursement_details_model->get_ci($sr_no);
       
        $emp_no=$ci->emp_no;
    $id_user2=$this->consultant_help_model->get_hod($emp_no);
    if(is_null($id_user2))
    {
      $id_user2=$this->consultant_help_model->get_hos($emp_no);
    }
    // echo $id_user1;
    // echo $id_user2;
    if($id_user1 =='' || ($id_user1 !=$id_user2))
    {

      $this->session->set_flashdata('flashError','Acccess Denied!'.$auth_id);
      redirect('home');
    }
    /*******************************************************************************/
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->drawHeader("Disbursement Sheet");
    $data['consultancy_no'] = $cons_no;
    $data['sr_no'] = $sr_no;
    $data['auth_id'] = $auth_id;
    $data['details'] = $this->consultant_disbursement_sheet_model->get_default($sr_no);
    $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
    $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
    $data['form1']=$this->consultant_form->getdetail_array($sr_no);
    $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
    $this->load->view('consultant/consultant_disbursement_sheetview_hod',$data);
    $this->drawFooter();
  }
  public function disbursement_view_pce($cons_no,$sr_no,$auth_id)
  {
    /****************************Validate******************************************/
    $id_user1=$this->session->userdata('id');
    //print_r($id_user1);
    $id_user2=$this->consultant_help_model->get_pce();
    //print_r($id_user2);
    if($id_user1 =='' || ($id_user1 !=$id_user2))
    {

      $this->session->set_flashdata('flashError','Acccess Denied!'.$auth_id);
      redirect('home');
    }
    /*******************************************************************************/
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->drawHeader("Disbursement Sheet");
    $data['consultancy_no'] = $cons_no;
    $data['sr_no'] = $sr_no;
    $data['auth_id'] = $auth_id;
    $data['detail_form2'] = $this->consultancy_proposal_approve_model->get_default($sr_no,1);
    $data['ci']=$this->consultant_form->getc_i($sr_no);
    $data['user_detail']=$this->consultant_help_model-> get_detail_user($data['ci']->emp_no);
       $data['department']=$this->consultant_help_model->get_departments($data['ci']->department);
    //print_r($data['detail_form2']);
    $data['details'] = $this->consultant_disbursement_sheet_model->get_default($sr_no);
    $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
    $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
    //$data['details3']=$this->consultant_disbursement_details_model->get_memo($sr_no);
    //print_r($data['details3']);
    $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/consultant_disbursement_sheetview_pce',$data);
      $this->drawFooter();
  }
  public function disbursement_view_arproject($cons_no,$sr_no,$auth_id)
  {
    /*************************Validate*******************************************/
    $id_user1=$this->session->userdata('id');
    
    $id_user2=$this->consultant_help_model->get_ar_proj();
    
    if($id_user1 =='' || ($id_user1 !=$id_user2))
    {

      $this->session->set_flashdata('flashError','Acccess Denied!'.$auth_id);
      redirect('home');
    }
    /********************************************************************************/
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->drawHeader("Disbursement Sheet");
    $data['consultancy_no'] = $cons_no;
    $data['sr_no'] = $sr_no;
    $data['auth_id'] = $auth_id;
    $data['details'] = $this->consultant_disbursement_sheet_model->get_default($sr_no);
    $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
    $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
    $data['details3']=$this->consultant_disbursement_details_model->get_pce_memo($sr_no);
    //print_r($details3);
    $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
    $this->load->view('consultant/consultant_disbursement_sheetview_arproject',$data);
    $this->drawFooter();
  }
  function pce_submit($consultancy_no)
  {
    $data['details']=$this->consultant_disbursement_details_model->get_staffs($consultancy_no);
    $i=1;
      foreach($data['details'] as $row)
                {
                  $data1=array('gas_previous'=>$this->input->post('gas_previous'.$i),
                              'fy_gas_previous'=>$this->input->post('fy_gas_previous'.$i),
                              'total_current_fy'=>$this->input->post('total_current_fy'.$i));
                  $data2['emp_no']=$row->emp_no;
                  $data2['consultancy_no']=$row->consultancy_no;
                  //print_r($data1);
                  //print_r($i);
                
                       $this->consultant_disbursement_details_model->update_pce($data1,$data2);
                     $i++;
            } 
            $this->session->set_flashdata('flashSuccess','Consultancy Form has been successfully submited.');
        redirect('home');
  }
  function add_action($sr_no,$remark,$status,$auth)
    {
      $date = date("Y-m-d H:i:s");
      $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
    }
  function view_disbursement_action($sr_no)
    {
      $data['action']=$this->consultant_disbursement_details_model->get_disbursement_action($sr_no);
      $data['disbursement']=$this->consultant_disbursement_details_model->get_default($sr_no);
      foreach($data['disbursement'] as $row){}
      $this->drawheader('Title: '.$row->consultancy_title);
      $this->load->view('consultant/view_disbursement_action',$data);
    }
  function disbursement_reject($cons_no)
  {

  }
  /*******************************************rest******************************************/
  
  /*public function disbursement_hod_approve($cons_no)
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->drawHeader("Details of Disbursement To Consultants:");
    $consultancy_no = $cons_no;
    $data['details'] = $this->consultant_disbursement_sheet_model->get_default($consultancy_no);
    $data['detail']=$this->consultant_disbursement_details_model->get_staffs($consultancy_no);
    $data['details2']=$this->consultant_disbursement_details_model->get_consultant($consultancy_no);
    //$data1['remark']=$this->input->post('')
  }*/
  
  
  
  function disbursement_rejected($sr_no)
  {
    //$data['id_user'] = $this->session->userdata('id');
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      foreach($var as $var1)
      {}
      $cons_no=$var1->consultancy_no;
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$sr_no;
      $data['auth_id'] = $this->session->userdata('id');
      /***************details*********************/
      $data['details'] = $this->consultant_disbursement_sheet_model->get_default($data['sr_no']);
      $data['staffs']=$this->consultant_disbursement_details_model->get_staffs($data['sr_no']);
      $data['consultants']=$this->consultant_disbursement_details_model->get_consultant($data['sr_no']);
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();

      /************************************/
      $this->drawHeader("Details of Disbursement To Consultants:");
    $this->load->view('consultant/consultant_disbursement_rejected', $data);
    $this->drawFooter();
  }
  
  function ciview_prev($sr_no,$mod)
    {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['details'] = $this->consultant_disbursement_details_model->get_default_prev($sr_no,$mod);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs_prev($sr_no,$mod);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant_prev($sr_no,$mod);
       $data['action_recent']=$this->consultant_form->get_last_action($sr_no);  
      $this->load->view('consultant/consultant_disbursement_ciview_hod',$data);
      $this->drawFooter();
    }
  function ciview_pce($sr_no)
  {
    $var=$this->consultant_disbursement_details_model->get_default($sr_no);
      foreach($var as $var1)
      {}
    $cons_no=$var1->consultancy_no;
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->drawHeader("Disbursement Sheet");
    $data['consultancy_no'] = $cons_no;
    $data['sr_no'] = $sr_no;
    $data['auth_id'] = $this->session->userdata('id');
    $data['details'] = $this->consultant_disbursement_sheet_model->get_default($sr_no);
    $data['staffs']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
    $data['consultants']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
    $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
    $this->load->view('consultant/consultant_disbursement_ciview_pce',$data);
    $this->drawFooter();
  }
  function view_disbursement_form($auth_id)
    {
        //print_r($auth_id);
        $id=$this->session->userdata('id');
        if($auth_id=='ft'||$auth_id=='c_i')
        {
        //$data['cons_row1']=$this->consultant_form->getAllConsult1($id);
        //$data['cons_row']=$this->consultant_form->getAllConsult($id);  
        $data['details']=$this->consultant_disbursement_details_model->get_disbursement_ci($id);
        }
        
        else if($auth_id=='pce'||$auth_id=='acc_ar_prj')
        {
          //$data['cons_row1']=$this->consultant_form->getAllConsult1();
          //$data['cons_row']=$this->consultant_form->getAllConsult();
          $data['details']=$this->consultant_disbursement_details_model->get_disbursement_all();
        }
        
        else if($auth_id=='hod')
        {
          $dept_id=$this->session->userdata('dept_id');
          //$data['cons_row']=$this->consultant_form->getAllConsultHod($dept_id);
          //$data['cons_row1']=$this->consultant_form->getAllConsultHod1($dept_id);
          $data['details']=$this->consultant_disbursement_details_model->get_disbursement_hod($dept_id);
        }
        //print_r($dept_id);
        /*foreach($data['details'] as $row)
        {
          print_r('/'.$row->consultancy_no);
        }
        /*
        $data['auth_id']=$auth_id;
        $data['payment']=$this->consultant_form->get_no_payment();
         */
        if(count($data['details']) == 0)
        {
          $this->session->set_flashdata('flashError','There is no any disbursement form to view.');
          redirect('home');
        }
       $data['auth_id']=$auth_id;
      $this->drawheader('View Applied Form');
      $this->load->view('consultant/view_disbursement_form',$data);
    }
    function disbursement_cancel($sr_no)
    {
      $data=$this->consultant_disbursement_details_model->get_default($sr_no);
      foreach($data as $var)
        {}
      $status=$var->status;
      if($status == 98 || $status == 103)
      {
        $this->session->set_flashdata('flashError','The disbursement form cannot be canceled.');
          redirect('home');
        
        }
      else
      {
        $status=98;
        $this->consultant_disbursement_details_model->disbursement_approve($sr_no,$status);
        $this->session->set_flashdata('flashError','The disbursement form canceled.');
          redirect('home');
      }
    }
  function view_disbursement_prev($sr_no)
  {
    
    $data['details']=$this->consultant_disbursement_details_model->get_disbursement_prev($sr_no);
    //$data['auth_id']=$auth_id;
    $this->drawheader('View Previous Form');
    $this->load->view('consultant/view_disbursement_prev',$data);
  }
  function disbursement_form1($sr_no)
  {
    $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/disbursement_print',$data);
      $this->drawFooter();
  }
  function disbursement_form2($sr_no)
  {
    $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/disbursement_print2',$data);
      $this->drawFooter();
  }
  function disbursement_form3($sr_no)
  {
    $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/disbursement_print3',$data);
      $this->drawFooter();
  }
  function disbursement_form4($sr_no)
  {
    $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Sheet");
      $data['sr_no'] = $sr_no;
      $data['details'] = $this->consultant_disbursement_details_model->get_default($sr_no);
      $data['detail']=$this->consultant_disbursement_details_model->get_staffs($sr_no);
      $data['details2']=$this->consultant_disbursement_details_model->get_consultant($sr_no);
      $data['details3']=$this->consultant_disbursement_details_model->get_pce_memo($sr_no);
      $data['action_recent']=$this->consultant_form->get_last_action($sr_no);
      $this->load->view('consultant/disbursement_print4',$data);
      $this->drawFooter();
  }
  function completed_link($sr_no)
  {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->drawHeader("Disbursement Forms");
      $data['sr_no'] = $sr_no;
      $this->load->view('consultant/disbursement_link',$data);
      $this->drawFooter();
  }
  private function upload_file($name ='',$sno)
    {
        $config['upload_path'] = 'assets/files/consultant/disbursement';
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
                   
                    $filename='DISBURSEMENT_'.date('YmdHis').$sno.$ext;
                }
            }
            else
            {
                $this->session->set_flashdata('flashError','ERROR: File Name not set.');
                redirect('consultant/consultant_disbursement_sheet/disbursement/'.$sr_no);
                return FALSE;
            }
       
            $config['file_name'] = $filename;
            //$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
            //return FALSE;

            if(!is_dir($config['upload_path'])) //create the folder if it's not already exists
            {
                mkdir($config['upload_path'],0777,TRUE);
            }

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_multi_upload($name))       //do_multi_upload is back compatible with do_upload
            {
                $this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
                redirect('consultant/consultant_disbursement_sheet/disbursement/'.$sr_no);
                return FALSE;
            }
            else
            {
                $upload_data = $this->upload->data();
                return $upload_data;
            }
    }
    function from_consultant_view($sr_no)
    {
      //$sr_no=$_POST['sr_no'];
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      foreach($var as $var1)
      {}
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$var1->sr_no;
      /***************details*********************/
      
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
      $member=$_POST['member'];
      $data['member']=$member;
      if($member<=30)
      {
        $this->load->view('consultant/disbursement_member',$data);
      }
      else
      {
        ?><p align='center'>Member Limit 30.</p><?
      }
    }
    function from_consultant_member_view($sr_no)
    {
      //$sr_no=$_POST['sr_no'];
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
      foreach($var as $var1)
      {}
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$var1->sr_no;
      /***************details*********************/
      
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
        $member=$_POST['member'];
        $data['member']=$member;
        if($member<=30)
        {
          $this->load->view('consultant/disbursement_member_without_ci',$data);
        }
        else
        {
          ?><p align='center'>Member Limit 30.</p><?
        }
    }
    function from_consultant_staff_view($sr_no)
    {
      //$sr_no=$_POST['sr_no'];
      $var=$this->consultant_disbursement_details_model->get_consultancy_no($sr_no);
    // print_r($sr_no);
      foreach($var as $var1)
      {}
      $cons_no=$var1->consultancy_no;
      //$title=$var1->consultancy_title;
      //$data['id_user'] = $this->session->userdata('id');
      $data['consultancy_no']=$cons_no;
      $data['sr_no']=$var1->sr_no;
      /***************details*********************/
      
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['dept_id']=$this->session->userdata('dept_id');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
      $staff=$_POST['staff'];
      $data['staff']=$staff;
      if($staff<=30)
      {
        $this->load->view('consultant/disbursement_staff',$data);
      }
      else
      {
        ?><p align='center'>Staff Limit 30.</p><?
      }
    }
       
}
?>