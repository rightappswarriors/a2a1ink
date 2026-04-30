<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('categories_model');
		$this->load->model('historylog_model');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		$data['page_title']='Categories';
		$data['active_menu']='consumers';
		
        $data['records'] = $this->categories_model->view_list();
        
		$this->load->view('categories',$data);
	}
    
    public function addnew()
	{
		$data['page_title']='Categories';
		$data['active_menu']='consumers';
		
		$this->load->view('categories_new',$data);
	}
    
    public function update()
	{
		$data['page_title']='Categories';
		$data['active_menu']='consumers';
	   
        $id = $this->uri->segment(3);
        
        $data['record']=$this->categories_model->view_info($id);
        
		$this->load->view('categories_update',$data);
	} 
    
    public function update_submit()
	{
        $id = $this->uri->segment(3);
        
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'category' => $this->input->post('category')
			);
			
			$this->categories_model->update($id,$data);
			$this->session->set_flashdata('update_status','<code>Successfuly updated!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." updated a category ".$this->input->post('category').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('categories','refresh');
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('devices');	
			
		}
	}
    
    public function addnew_submit()
	{
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'category' => $this->input->post('category'),
				'accountid' => $this->session->userdata('arallink_accountid'),
				'dateadded' => date("Y-m-d H:i:s")
			);
			
			$this->categories_model->insert($data);
			$this->session->set_flashdata('update_status','<code>Successfuly added!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." added new category ".$this->input->post('device').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('categories','refresh');
			
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('categories');	
			
		}
	}
    
    public function remove(){
        
        $id = $this->uri->segment(3);
        $data = array(
            'deleted' => 'yes',
            'status' => 0
                     );
        $this->categories_model->update($id,$data);
        
        // INSERT History Log
        $datalog = array(
            'user' => $this->session->userdata('arallink_userid'),
            'description' => $this->session->userdata('arallink_username')." has deleted a category with ID: ".$id.".",
            'dateadded' => date("Y-m-d H:i:s")
        );
        $this->historylog_model->insert($datalog);
        
        $this->session->set_flashdata('update_status','<code>Successfuly deleted!</code>');
        redirect('categories','refresh');
        
    }
    
}
