<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {
	
	private $tablename = "storelogs";
	
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
	
	public function view_list($fromdate = '', $todate = ''){
		
		if($fromdate == '' and $todate == ''){
			$fromdate = date("Y-m-d",strtotime("first day of this month"));
			$todate = date("Y-m-d");
		}
		
		return $this->db->query("
		SELECT a.*, b.consumer, c.direction  
		FROM storelogs a 
		LEFT JOIN consumers b on b.cardno = a.cardno and b.accountid = ". $this->session->userdata('arallink_accountid') ."
		LEFT JOIN devices c on c.serialno = a.device and c.accountid = ". $this->session->userdata('arallink_accountid') ."
		WHERE a.status = 1 and a.deleted = 'no' and a.accountid = ". $this->session->userdata('arallink_accountid') ." 
		and a.logdate BETWEEN '$fromdate' and '$todate'  
		ORDER BY a.logdatetime desc 
		");
		
	}
	
	public function view_info($id){
		$this->db->where("id",$id);
		return $this->db->get($this->tablename);
	}
	
}