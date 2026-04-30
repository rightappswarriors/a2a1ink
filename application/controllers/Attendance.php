<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	public function index()
	{
		$data['page_title']='Attendance';
		$data['active_menu']='attendance';
		
		$this->load->view('attendance',$data);
	}
}
