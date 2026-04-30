<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('dashboard_model');
		$this->load->model('historylog_model');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		
		$data['page_title']='Settings';
		$data['active_menu']='settings';
        
        $data['record'] = $this->dashboard_model->view_info($this->session->userdata('arallink_accountid'));
		
		$this->load->view('settings',$data);
	}
    
    public function update()
	{
        $id = $this->session->userdata('arallink_accountid');
        
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|callback_is_unique_edit');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'organization' => $this->input->post('organization'),
				'address' => $this->input->post('address'),
				'contactno' => $this->input->post('contactno'),
				'email' => $this->input->post('email')
				//'provider' => $this->input->post('provider'),
				//'senderid' => $this->input->post('senderid')
			);
			
			$this->dashboard_model->update($id,$data);
			$this->session->set_flashdata('update_status','<code>Successfuly updated!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." has updated the settings.",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('settings','refresh');
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('settings');	
			
		}
	}
    
    public function is_unique_edit($email)
    {
        $id = $this->session->userdata('arallink_accountid');

        $this->db->where('email', $email);
        if (!empty($id)) {
            $this->db->where('id !=', $id);
        }

        $query = $this->db->get('accounts');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message(
                'is_unique_edit',
                'The {field} already exists.'
            );
            return FALSE;
        }

        return TRUE;
    }
    
}
