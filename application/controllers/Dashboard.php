<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $CI = NULL;

	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('dashboard_model');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		
		$data['page_title']='Dashboard';
		$data['active_menu']='dashboard';
		
		$data['records'] = $this->dashboard_model->get_total();
		
		$this->load->view('dashboard',$data);
	}
}
