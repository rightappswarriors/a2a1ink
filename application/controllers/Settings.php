<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('dashboard_model');
		$this->load->model('historylog_model');
		$this->load->library('upload');
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
			
			// Handle logo upload
			$logo_path = $this->handle_logo_upload($id);
			if ($logo_path !== FALSE) {
			    $data['logo'] = $logo_path;
			}
			
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
			$this->session->set_flashdata('update_status','<code>Error! Please check the form.</code>');
			$data['page_title'] = 'Settings';
			$data['active_menu'] = 'settings';
			$data['record'] = $this->dashboard_model->view_info($id);
			$this->load->view('settings', $data);	
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
    
    private function handle_logo_upload($account_id)
    {
        // Check if a file was uploaded
        if (!isset($_FILES['logo']) || $_FILES['logo']['error'] == UPLOAD_ERR_NO_FILE) {
            return FALSE;
        }
        
        // Configure upload settings
        $config['upload_path'] = './uploads/logos/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|svg|webp';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        
        $this->upload->initialize($config);
        
        // Perform upload
        if ($this->upload->do_upload('logo')) {
            $upload_data = $this->upload->data();
            
            // Delete old logo if exists
            $this->delete_old_logo($account_id);
            
            return 'uploads/logos/' . $upload_data['file_name'];
        } else {
            // Upload failed, set error message
            $this->session->set_flashdata('upload_error', $this->upload->display_errors('', ''));
            return FALSE;
        }
    }
    
    private function delete_old_logo($account_id)
    {
        $account = $this->dashboard_model->view_info($account_id)->row();
        if ($account && !empty($account->logo) && file_exists(FCPATH . $account->logo)) {
            @unlink(FCPATH . $account->logo);
        }
    }
    
}
