<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('monitoring_model'); 
	}
    
	public function index($key='')
	{	
		if(isset($key))
        {$data['records'] = $this->monitoring_model->view_list();	}

		$this->load->view('monitoring',$data);
		
	}
    
}
