<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {
	
	function __construct(){
        parent::__construct();
	}
	
    public function insert($data){
		$this->db->insert('accounts',$data);
        return $this->db->insert_id();
	}
    
    public function insert_login($data){
		return $this->db->insert('sysusers',$data);
	}
    
}