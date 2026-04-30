<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('login_model');
		$this->load->model('historylog_model');
	}
	
	public function index()
	{
		if($this->session->userdata('arallink_login')){
			redirect('dashboard','refresh');
		}	
        $data['page_title']='Sign-in';
		$this->load->view('login',$data);
	}
	
	public function changepass()
	{
		if(!$this->session->userdata('pms_login')){
			redirect(site_url('login'));
		}	
		$this->load->view('changepass');	
	}
	
	public function password_check($str)
	{
	   if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
		 return TRUE;
	   }
	   $this->form_validation->set_message('password_check', 'New Password is not acceptable.');
	   return FALSE;
	}
	
	public function changepass_submit()
	{
		$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[8]|alpha_numeric|callback_password_check');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'password' => md5($this->input->post('newpassword'))
			);
			
			$this->login_model->update_password($this->session->userdata('pms_userid'),$data);
			$this->session->set_flashdata('update_status','<div class="alert alert-success">Successfully updated!</div>');
			redirect('login/changepass','refresh');
			
			
		}else{
			
			$this->load->view('changepass');
			
		}	
	}
	
	public function process()
	{
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$error=0;

		if ($this->form_validation->run() == TRUE) 
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$login=$this->login_model->check_login($username,$password);

			if($login->num_rows()>0){
				
				// create sessions...
				$row=$login->row();
				
				$logsintoday = date("Y-m-d H:i:s");
				$newdata = array(
					'arallink_accountid' => $row->accountid,
					'arallink_username' => $username,
					'arallink_displayname' => $username,
					'arallink_userid' => $row->id,
					'arallink_senderid'   => 'JDEN SMS',
					'arallink_login'  => TRUE,
					'arallink_lastlogin'  => date("Y-m-d H:i:s",strtotime($row->lastlogin)),
					'arallink_logsintoday'  => $logsintoday
				);			
				
				// UPDATE LASTLOGIN
				$data = array('lastlogin' => $logsintoday);
				$this->login_model->user_update($row->id,$data);
				
				// INSERT History Log
				$datalog = array(
					'user' => $row->id,
					'description' => $username." just logs in.",
					'dateadded' => date("Y-m-d H:i:s")
				);
				$this->historylog_model->insert($datalog);
				
				$this->session->set_userdata($newdata);	
				redirect('dashboard','refresh');
				
			}else{
				
				$error=1;
				
			}

			
		}else{
			
			$error=1;	
			
		}
		
		if($error){
			$this->session->set_flashdata('update_status', '
					<div class="alert alert-danger">
					<strong><i class="dripicons-checkmark"></i> Oops!</strong> Username or password is not correct.
				</div>');
				$this->index();
		}
		
	}
	
	function logout(){
		
		// INSERT History Log
		$datalog = array(
			'user' => $this->session->userdata('arallink_userid'),
			'description' => $this->session->userdata('pms_username')." just logs out.",
			'dateadded' => date("Y-m-d H:i:s")
		);
		$this->historylog_model->insert($datalog);
		
		session_destroy();
		redirect(site_url("login"));
	}
	
	
}
