<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {
	
	private $tablename = "accounts";
	
	function __construct(){
        parent::__construct();
	}
	
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update($this->tablename,$data);
	}
    
    public function insert($data){
		return $this->db->insert("storelogs",$data);
	}
	
    public function get_accountid($key){
		$this->db->where("keyid",$key);
        $this->db->limit(1);
		return $this->db->get($this->tablename);
	}
    
	public function get_consumer($uid,$accountid){
		$this->db->where("accountid",$accountid);
		$this->db->where("cardno",$uid);
		$this->db->where("status",1);
		$this->db->where("deleted",'no');
        $this->db->limit(1);
		return $this->db->get("consumers");
	}
    
    public function get_device($serial,$accountid){
		$this->db->where("accountid",$accountid);
		$this->db->where("serialno",$serial);
        $this->db->limit(1);
		return $this->db->get("devices");
	}
	
}