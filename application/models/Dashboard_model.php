<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	private $tablename = "accounts";
	
	function __construct(){
        parent::__construct();
	}
	
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update($this->tablename,$data);
	}
	
	public function view_info($id){
		$this->db->where("id",$id);
		return $this->db->get($this->tablename);
	}
	
	public function get_total(){
		
		$accountid = $this->session->userdata('arallink_accountid');
		
		return $this->db->query("
		
		SELECT
  (SELECT COUNT(*) FROM devices d   WHERE d.accountid = $accountid and d.deleted = 'no' and d.status = 1) AS devices_total,
  (SELECT COUNT(*) FROM consumers c WHERE c.accountid = $accountid and c.deleted = 'no' and c.status = 1) AS consumers_total,
  (SELECT COUNT(*) FROM storelogs s WHERE s.accountid = $accountid and s.deleted = 'no' and s.status = 1) AS logs_total
		
		");
		
	}
	
}