<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumers extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('consumers_model');
		$this->load->model('categories_model');
		$this->load->model('historylog_model');
		$this->load->library('upload');
		if(!$this->session->userdata('arallink_login')){
			redirect(site_url('login'));
		}
	}
    
	public function index()
	{
		$data['page_title']='Consumers';
		$data['active_menu']='consumers';
		
        $data['records'] = $this->consumers_model->view_list();
        
		$this->load->view('consumers',$data);
	}
    
    public function addnew()
	{
		$data['page_title']='Consumers';
		$data['active_menu']='consumers';
        
		$data['categories'] = $this->categories_model->view_list();
		
        $this->load->view('consumers_new',$data);
	}
    
    public function update()
	{
		$data['page_title']='Consumers';
		$data['active_menu']='consumers';
	   
        $id = $this->uri->segment(3);
        
        $data['record']=$this->consumers_model->view_info($id);
        $data['categories'] = $this->categories_model->view_list();
        
		$this->load->view('consumers_update',$data);
	} 
    
    public function update_submit()
	{
        $id = $this->uri->segment(3);
        
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'consumer' => $this->input->post('consumer'),
				'cardno' => $this->input->post('cardno'),
				'mobileno' => $this->input->post('mobileno'),
				'category' => $this->input->post('category')
			);
			
			// Handle photo upload
			$photo_path = $this->handle_photo_upload($id);
			if ($photo_path !== FALSE) {
			    $data['photo'] = $photo_path;
			}
			
			$this->consumers_model->update($id,$data);
			$this->session->set_flashdata('update_status','<code>Successfuly updated!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." updated consumer ".$this->input->post('consumer').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('consumers','refresh');
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$data['page_title'] = 'Consumers';
			$data['active_menu'] = 'consumers';
			$data['record'] = $this->consumers_model->view_info($id);
			$data['categories'] = $this->categories_model->view_list();
			$this->load->view('consumers_update', $data);	
			
		}
	}
    
    public function addnew_submit()
	{
		$this->form_validation->set_rules('consumer', 'Consumer', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) 
		{
			
			$data = array(
				'consumer' => $this->input->post('consumer'),
				'cardno' => $this->input->post('cardno'),
				'mobileno' => $this->input->post('mobileno'),
				'category' => $this->input->post('category'),
				'accountid' => $this->session->userdata('arallink_accountid'),
				'dateadded' => date("Y-m-d H:i:s")
			);
			
			// Handle photo upload
			$photo_path = $this->handle_photo_upload();
			if ($photo_path !== FALSE) {
			    $data['photo'] = $photo_path;
			}
			
			$this->consumers_model->insert($data);
			$this->session->set_flashdata('update_status','<code>Successfuly added!</code>');
			
			// INSERT History Log
			$datalog = array(
				'user' => $this->session->userdata('arallink_userid'),
				'description' => $this->session->userdata('arallink_username')." added new consumer ".$this->input->post('consumer').".",
				'dateadded' => date("Y-m-d H:i:s")
			);
			$this->historylog_model->insert($datalog);
			
			redirect('consumers','refresh');
			
			
		}else{
			
			$this->session->set_flashdata('update_status','<code>Error!</code>');
			$this->load->view('consumers');	
			
		}
	}
    
     public function remove(){
         
         $id = $this->uri->segment(3);
         $data = array(
             'deleted' => 'yes',
             'status' => 0
                      );
         $this->consumers_model->update($id,$data);
         
         // INSERT History Log
         $datalog = array(
             'user' => $this->session->userdata('arallink_userid'),
             'description' => $this->session->userdata('arallink_username')." has deleted a category with ID: ".$id.".",
             'dateadded' => date("Y-m-d H:i:s")
         );
         $this->historylog_model->insert($datalog);
         
         $this->session->set_flashdata('update_status','<code>Successfuly deleted!</code>');
         redirect('consumers','refresh');
         
     }
     
     private function handle_photo_upload($consumer_id = NULL)
     {
         // Check if a file was uploaded
         if (!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) {
             return FALSE;
         }
         
         // Configure upload settings
         $config['upload_path'] = './uploads/photos/';
         $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
         $config['max_size'] = 2048; // 2MB
         $config['encrypt_name'] = TRUE;
         
         $this->upload->initialize($config);
         
         // Perform upload
         if ($this->upload->do_upload('photo')) {
             $upload_data = $this->upload->data();
             
             // Delete old photo if exists (and consumer_id provided)
             if ($consumer_id) {
                 $this->delete_old_photo($consumer_id);
             }
             
             return 'uploads/photos/' . $upload_data['file_name'];
         } else {
             // Upload failed, set error message
             $this->session->set_flashdata('upload_error', $this->upload->display_errors('', ''));
             return FALSE;
         }
     }
     
     private function delete_old_photo($consumer_id)
     {
         $consumer = $this->consumers_model->view_info($consumer_id)->row();
         if ($consumer && !empty($consumer->photo) && file_exists(FCPATH . $consumer->photo)) {
             @unlink(FCPATH . $consumer->photo);
         }
     }
     
 }
