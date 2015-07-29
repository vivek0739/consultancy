<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 23 june 2015
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Edit_consultancy_form extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        
         $this->load->model('consultant/consultant_form','',TRUE);
        $this->load->model('consultant/consultant_help_model','',TRUE);
    }
     public function index()
    {
    }

public function edit_consultancy($sr_no='')
    {
      if($sr_no=='')
      {
        
        $id=$this->session->userdata('id');
        $data['cons_row']=$this->consultant_form->getAllConsult($id);
        $data['payment']=$this->consultant_form->get_no_payment();
        if(count($data['cons_row']) == 0)
        {
          $this->session->set_flashdata('flashError','There is no any conultancy form to edit.');
          redirect('home');
        }
         $this->drawheader('Edit Consultancy Form');
         $this->load->view('consultant/edit_consultancy_form',$data);

      }
      else
      {
        $id=$this->session->userdata('id');
        $this->consultant_form->insertRMtemp($sr_no);
        $data['cons_row']=$this->consultant_form->getdetail($sr_no);
        if($data['cons_row']->status==0 
          || $data['cons_row']->status==2 
          ||$data['cons_row']->status>=5)
        {
          $members=$this->consultant_form->getmember($sr_no);
           
           $i=1;
          $user= array();
           $deptm=array();
           $share=array();
           $position = array();
          foreach ($members as $key => $member) {
            $user[$i]=$member->emp_no;
            $deptm[$i]=$member->department;
            $share[$i]=$member->share;
            $position[$i]=$member->position;
            $i++;
        }
        $data['user']=$user;
        $data['deptm']=$deptm;
        $data['share']=$share;
        $data['position']=$position;
        $data['no_of_member']=$i;
        $this->load->model('employee/emp_basic_details_model','',TRUE);
        $data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
        $data['id']=$this->consultant_form->get_max_sr_no();
        $data['emp_no']=$this->session->userdata('id');
        $data['department']=$this->consultant_help_model->get_departments($this->session->userdata('dept_id'));
        $data['emp_name']=$this->session->userdata('name');
        $data['designation']=$this->session->userdata('designation');
        $this->load->model('departments_model','',TRUE);
        $data['departments']=$this->departments_model->get_departments();
         $data['dept_id']=$this->session->userdata('dept_id');
         $this->drawheader('Edit Consultancy Form');
        $this->load->view('consultant/edit_consultancy_detail',$data);
      }
      else
      {
          $this->session->set_flashdata('flashError',"You can't edit until approved by director");
          redirect('home');
          return false;
      } 

    }
      
}
    function submit_edited_consult_form($sr_no)
    {
      $sum=0;
    $this->db->trans_start();
    if($_FILES['scope_path']['name'] != '')
    {
        $upload=$this->upload_file('scope_path',$this->input->post('sr_no'));
        
            if($upload)
            {
                $date = date("Y-m-d H:i:s");
                $data = array('sr_no'=>$this->input->post('sr_no'),
                            'consultancy_title'=>$this->input->post('consultant_title'),
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
                          'modification_value'=>($this->input->post('modification_value') + 1),
                          'status'=>0,
                          'timestamp'=>$date 
                          );
                if($_FILES['work_scpe']['name'] != '')
                {

                  $upload_scope=$this->upload_scope('work_scope',$this->input->post('sr_no'));
                  if($upload_scope)
                  $data['scope_work']=$upload_scope['file_name'];
                }
                

                $this->consultant_form->insertEMtemp($sr_no);
                $this->consultant_form->insertEdited($sr_no);
                $this->consultant_form->insertMtemp($sr_no,$data['modification_value']);
                $this->consultant_form->update($data);
               
        }
      }
      else
      {
        
                $date = date("Y-m-d H:i:s");
                $data = array('sr_no'=>$this->input->post('sr_no'),
                            'consultancy_title'=>$this->input->post('consultant_title'),
                            
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
                          'modification_value'=>($this->input->post('modification_value') + 1),
                          'status'=>0,
                          'timestamp'=>$date 
                          );
                if($_FILES['work_scpe']['name'] != '')
                {

                  $upload_scope=$this->upload_scope('work_scope',$this->input->post('sr_no'));
                  if($upload_scope)
                  $data['scope_work']=$upload_scope['file_name'];
                }
                
                $this->consultant_form->insertEMtemp($sr_no);
                $this->consultant_form->insertEdited($sr_no);
                $this->consultant_form->insertMtemp($sr_no,$data['modification_value']);
                $this->consultant_form->update($data);
                
                

      }
              
                $this->add_action($data['sr_no'],'Edited Reason : '.$this->input->post('remark'),0,'c_i' );
                $this->send_noitification_consultancy($data);
                $this->db->trans_complete();
                $this->session->set_flashdata('flashSuccess','Consultancy form has been updated.');
                redirect('home');
     

        
    }
function send_noitification_consultancy($data)
    {
        $iduser=$this->session->userdata('id');
        $description = "Employee with emp_no ".$iduser." had updated the consultancy with title ".$data['consultancy_title'].'.';
        $title = "Please check and approve  .";
        $link = "consultant/consultant/view_consultancy_form_hod/".$data['sr_no'].'/hod';
        $id=$this->consultant_help_model->get_hod($iduser);
        
        $this->notification->notify($id,"hod",$title,$description,$link,"");
     
    }
    function add_action($sr_no,$remark,$status,$auth)
    {
      $date = date("Y-m-d H:i:s");
      $this->consultant_form->add_action($sr_no,$remark,$status,$auth,$date);
    }
 
 function upload_file($name ='',$sno = '')
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
                redirect('consultant/edit_consultancy_form/edit_consultancy/'.$sr_no);
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
     private function upload_scope($name ='',$sno = '')
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
                redirect('consultant/edit_consultancy_form/edit_consultancy/'.$sr_no);
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
