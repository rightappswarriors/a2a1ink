<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('devices_model');
		$this->load->model('historylog_model');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		$data['page_title']='Devices';
		$data['active_menu']='devices';
		
        $data['records'] = $this->devices_model->view_list();
        
		$this->load->view('devices',$data);
	}
    
    public function addnew()
	{
		$data['page_title']='Devices';
		$data['active_menu']='devices';
		
		$this->load->view('devices_new',$data);
	}
    
    public function update()
	{
		$data['page_title']='Devices';
		$data['active_menu']='devices';
	   
        $id = $this->uri->segment(3);
        
        $data['record']=$this->devices_model->view_info($id);
        
		$this->load->view('devices_update',$data);
	} 
    
    public function update_submit()
	{
        $id = $this->uri->segment(3);
        
		$this->form_validation->set_rules('serialno', 'Serial No.', 'trim|required|callback_is_unique_edit');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'device' => $this->input->post('device'),
				'modelno' => $this->input->post('modelno'),
				'serialno' => $this->input->post('serialno'),
				'direction' => $this->input->post('direction'),
				'gsmno' => $this->input->post('gsmno')
			);
			
			$this->devices_model->update($id,$data);
			$this->session->set_flashdata('update_status','<code>Successfuly updated!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." updated a device ".$this->input->post('device').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('devices','refresh');
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('devices');	
			
		}
	}
    
    public function is_unique_edit($serialno)
    {
        $id = $this->uri->segment(3); // include current record

        $this->db->where('serialno', $serialno);
        if (!empty($id)) {
            $this->db->where('id !=', $id);
        }

        $query = $this->db->get('devices');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message(
                'is_unique_edit',
                'The {field} already exists.'
            );
            return FALSE;
        }

        return TRUE;
    }
    
    public function addnew_submit()
	{
		$this->form_validation->set_rules('serialno', 'Serial No.', 'trim|required|is_unique[devices.serialno]');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'device' => $this->input->post('device'),
				'modelno' => $this->input->post('modelno'),
				'serialno' => $this->input->post('serialno'),
				'direction' => $this->input->post('direction'),
				'gsmno' => $this->input->post('gsmno'),
				'accountid' => $this->session->userdata('arallink_accountid'),
				'dateadded' => date("Y-m-d H:i:s")
			);
			
			$this->devices_model->insert($data);
			$this->session->set_flashdata('update_status','<code>Successfuly added!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." added new device ".$this->input->post('device').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('devices','refresh');
			
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('devices');	
			
		}
	}
    
    public function remove(){
        
        $id = $this->uri->segment(3);
        $data = array(
            'deleted' => 'yes',
            'status' => 0
                     );
        $this->devices_model->update($id,$data);
        
        // INSERT History Log
        $datalog = array(
            'user' => $this->session->userdata('arallink_userid'),
            'description' => $this->session->userdata('arallink_username')." has deleted a device with ID: ".$id.".",
            'dateadded' => date("Y-m-d H:i:s")
        );
        $this->historylog_model->insert($datalog);
        
        $this->session->set_flashdata('update_status','<code>Successfuly deleted!</code>');
        redirect('devices','refresh');
        
    }
    
}
