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

	public function view_list($key)
	{
		$this->db->select('
			s.logdatetime,
			s.logdate,
			LOWER(d.direction) as direction,
			c.consumer,
			c.photo,
			s.cardno AS sl_cardno,
			c.cardno AS cn_cardno
		');

		$this->db->from('storelogs s');

		$this->db->join('devices d', 's.device = d.serialno', 'left');
		$this->db->join('consumers c', 's.accountid = c.accountid', 'left');

		$this->db->where('s.device', $key);

		$this->db->order_by('s.logdatetime', 'DESC');
		$this->db->limit(3);

		$query = $this->db->get();

		return $query->result();
	}
	
}
