<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    public $CI = NULL;
	private $key = '';
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('monitoring_model'); 
	}
    
	public function index($key='')
	{	
		if(isset($key))
		{
			$this->key = $key;
		}

		$this->load->view('monitoring');

	}

	public function getData()
	{
		if(isset($this->key))
		{
			$records = $this->monitoring_model->view_list();
		}

		$this->output->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'data' => $records
			]));
	}
}
