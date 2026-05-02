<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		$this->load->model('monitoring_model');
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'dummy')); 
	}
    
	public function index()
	{
		$this->load->view('monitoring');

	}

	public function getData()
	{
		$key = $this->input->get('key');

		if(!empty($key))
		{
			$cacheKey = 'monitoring_data_' . md5($key);
			$records = $this->cache->get($cacheKey);

			if ($records === FALSE) {
				$records = $this->monitoring_model->view_list();
				$this->cache->save($cacheKey, $records, 2);
			}
		}

		$this->output->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'records' => $records ?? []
			]));
	}
}
