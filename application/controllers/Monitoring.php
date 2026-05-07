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
    
	public function index($key)
	{
		$data['active_menu'] = 'monitoring';
		$data['key'] = $key;

		$this->load->view('monitoring', $data);

	}

	public function getData($key)
	{
		if(!isset($key) || $key === '')
		{
			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'false',
					'records' => [],
				]));
		}

		$cacheKey = 'monitoring_data_' . md5($key);
		$records = $this->cache->get($cacheKey);

		if ($records === FALSE) {
			$records = $this->monitoring_model->view_list($key);
			$this->cache->save($cacheKey, $records, 2);
		}

		return $this->output->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'records' => $records ?: [],
				'key' => $key,
			]));
	}
}
