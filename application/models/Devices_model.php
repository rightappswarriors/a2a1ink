<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices_model extends CI_Model {
	
	private $tablename = "devices";
	
	function __construct(){
        parent::__construct();
	}
	
	public function insert($data){
		return $this->db->insert($this->tablename,$data);
	}
	
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update($this->tablename,$data);
	}
	
	public function remove($id){
		$data = array(
			'status'	=>	0,
			'deleted'	=>	'yes'
		);
		$this->db->where("id",$id);
		return $this->db->update($this->tablename,$data);
	}
	
	public function view_list(){
		$this->db->where("status",1);
        $this->db->where("deleted",'no');
        $this->db->where("accountid",$this->session->userdata('arallink_accountid'));
		$this->db->order_by('device','asc');
        return $this->db->get($this->tablename);
	}
	
	public function view_info($id){
		$this->db->where("id",$id);
		return $this->db->get($this->tablename);
	}
	
}