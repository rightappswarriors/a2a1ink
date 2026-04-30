<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumers extends CI_Controller {

	public function index()
	{
		$data['page_title']='Consumers';
		$data['active_menu']='consumers';
		
		$this->load->view('consumers',$data);
	}
}
