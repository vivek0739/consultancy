<?php

class Consultant_disbursement_sheet_model extends CI_Model
{

	var $table = 'consultancy_disbursement';
	var $table1 = 'consultancy_disbursement_modification';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}
	function disbursement_mod($data)
	{
		$this->db->insert($this->table1,$data);
	}
	function get_default($id_user)
	{
		$query=("SELECT * FROM consultancy_disbursement WHERE consultancy_disbursement.sr_no = '$id_user'");
		$query1=$this->db->query($query);
		return $query1->result();
	}

	function getDept($emp_id)
	{
		$this->db->select('dept_id');
		$this->db->from('user_details');
		$this->db->where('id', $emp_id);
		$query = $this->db->get();
		return $query->result()[0]->dept_id;
	}

	function getHodId($dept_id)
	{
		$query = $this->db->query("SELECT A.id as id 
									FROM (SELECT *FROM user_details WHERE dept_id = '$dept_id') as A 
									INNER JOIN (SELECT * FROM user_auth_types WHERE auth_id = 'hod') as B
									ON A.id = B.id
									WHERE A.dept_id = '$dept_id'");
		return $query->result()[0]->id;
	}
}

/* End of file post_notice_model.php */
/* Location: mis/application/models/post_notice_model.php */