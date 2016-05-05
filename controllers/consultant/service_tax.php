<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_tax extends MY_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->addJS('consultant/consultant.js');
        $this->load->model('consultant/consultant_help_model','',TRUE);
		
    }
	public function index()
	{
		/* edit the service tax;*/



	}
	public function insert()
	{
		$this->load->helper(array('form', 'url'));


		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('service_tax', 'Service Tax', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->drawHeader('');
			$this->load->view('consultant/insert_service_tax.php');
		}
		else
		{
			$timestamp = date("Y-m-d H:i:s");

			$service_tax = $this->input->post('service_tax');
			$this->consultant_help_model->put_service_tax($timestamp , $service_tax);
			$this->session->set_flashdata('flashSuccess','New service tax has been added');
            redirect('home');
		}

	}
}