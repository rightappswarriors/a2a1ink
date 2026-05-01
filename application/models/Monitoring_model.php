<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends CI_Model {
	
	private $tablename = "storelogs";
	
	function __construct(){
        parent::__construct();
	}
	
    public function get_logs($key){
		$this->db->where("keyid",$key);
        $this->db->limit(1);
		return $this->db->get($this->tablename);
	}

	public function view_list()
	{
		return array();
	}
	
}