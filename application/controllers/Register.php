<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('register_model');
	}
	
	public function index()
	{
		if($this->session->userdata('arallink_login')){
			redirect('dashboard','refresh');
		}	
        $data['page_title']='Registration';
		$this->load->view('register',$data);
	}
	
	public function process()
	{
		
		$this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|is_unique[accounts.email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[sysusers.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[rpassword]');
		$this->form_validation->set_rules('rpassword', 'Repeat Password', 'trim');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
            // ACCOUNTS
			$data = array(
				'organization' => $this->input->post('organization'),
				'address' => $this->input->post('address'),
				'contactno' => $this->input->post('contactno'),
				'email' => $this->input->post('email'),
                'keyid' => $this->generateCode(),
				'dateadded' => date("Y-m-d H:i:s")
			);
			$accountid = $this->register_model->insert($data);
            
            // LOGIN INFO
            $data_login = array(
				'accountid' => $accountid,
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->register_model->insert_login($data_login);
            
			$this->session->set_flashdata('update_status','<div class="alert alert-success">You are successfuly registered!</div>');
			
			redirect('login','refresh');
			
			
		}else{
			
			$this->session->set_flashdata('update_status','<div class="alert alert-danger">Error!</div>');
			$this->index();	
			
		}
		
	}
    
    function generateCode($totalLength = 10)
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        $code = '';
        for ($i = 0; $i < 3; $i++) {
            $code .= $letters[random_int(0, 25)];
        }

        for ($i = 0; $i < $totalLength - 3; $i++) {
            $code .= $numbers[random_int(0, 9)];
        }

        return $code;
    }
	
}
