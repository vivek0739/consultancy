<?php

class Consultant_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu($auth='')
	{
		$menu=array();
		//auth ==> emp.
		$menu['emp']=array();
		$menu['emp']["Consultancy"] = array();
		$menu['emp']["Consultancy"]['Apply For consultancy'] = site_url('consultant/consultant/index');
		$menu['emp']["Consultancy"]['Submit Proposal Form'] = site_url('consultant/consultancy_proposal_form/consultancy_proposal_form_all/ft');
		$menu['emp']["Consultancy"]['Submit Disbursement Form'] = site_url('consultant/consultancy_proposal_approve/disbursement_apply_all');
		$menu['emp']["Consultancy"]['Edit Consultancy Form'] = site_url('consultant/edit_consultancy_form/edit_consultancy');
		$menu['emp']["Consultancy"]['View Consultancy Form'] = site_url('consultant/consultant/view_consultancy_form/ft');
		$menu['emp']["Consultancy"]['View Disbursement Form'] = site_url('consultant/consultant_disbursement_sheet/view_disbursement_form/ft');
		
		//auth ==> dt
		$menu['dt']=array();
		$menu['dt']["Consultancy"] = array();
		$menu['dt']["Consultancy"]['View Consultancy Form'] = site_url('consultant/consultant/view_consultancy_form/dt');
		
		//auth ==> hod
		$menu['hod']=array();
		$menu['hod']["Consultancy"] = array();
		$menu['hod']["Consultancy"]['View Consultancy Form'] = site_url('consultant/consultant/view_consultancy_form/hod');
		
		//auth ==> pce
		$menu['pce']=array();
		$menu['pce']["Consultancy"] = array();
		$menu['pce']["Consultancy"]['View Consultancy Form'] = site_url('consultant/consultant/view_consultancy_form/pce');
		$menu['pce']["Consultancy"]['Send Receipt'] = site_url('consultant/consultancy_proposal_approve/apply_form3');
		$menu['pce']["Consultancy"]['Edit Receipt'] = site_url('consultant/consultancy_proposal_approve/edit_form3_all');

		$menu['acc_ar_prj']=array();
		$menu['acc_ar_prj']["Consultancy"] = array();
		$menu['acc_ar_prj']["Consultancy"]['View Consultancy Form'] = site_url('consultant/consultant/view_consultancy_form/acc_ar_prj');
		

		return $menu;
	}
}