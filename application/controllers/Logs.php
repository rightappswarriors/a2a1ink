<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('logs_model');
		$this->load->model('historylog_model');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		$data['page_title']='Logs';
		$data['active_menu']='logs';
		
		if ($this->input->post()) {
			$fromdate = $this->input->post("datefrom");
			$todate = $this->input->post("dateto");
			$data['records'] = $this->logs_model->view_list($fromdate,$todate);
		}else $data['records'] = $this->logs_model->view_list();
		
		$this->load->view('logs',$data);
	}
}
