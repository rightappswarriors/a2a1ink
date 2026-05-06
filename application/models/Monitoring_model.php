<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends CI_Model {
	
	private $tablename = "storelogs";
	private function sampleData()
	{
		$now = new DateTime();

		return array(
			array(
				"photo" => "https://picsum.photos/seed/student1/400/300",
				"name"  => "Juan dela Cruz",
				"id"    => "2026-00001",
				"time"  => $now->format('h:i:s A'),
				"date"  => $now->format('Y-m-d'),
				"status"=> "IN",
				"key"   => "VSH4527987"
			),
			array(
				"photo" => "https://picsum.photos/seed/student2/400/300",
				"name"  => "Maria Santos",
				"id"    => "2026-00002",
				"time"  => $now->format('h:i:s A'),
				"date"  => $now->format('Y-m-d'),
				"status"=> "IN",
				"key"   => "VSH4527987"
			),
			array(
				"photo" => "https://picsum.photos/seed/student3/400/300",
				"name"  => "Pedro Reyes",
				"id"    => "2026-00003",
				"time"  => $now->format('h:i:s A'),
				"date"  => $now->format('Y-m-d'),
				"status"=> "OUT",
				"key"   => "VSH5724987"
			),
			array(
				"photo" => "https://picsum.photos/seed/student4/400/300",
				"name"  => "Ana Lopez",
				"id"    => "2026-00004",
				"time"  => $now->format('h:i:s A'),
				"date"  => $now->format('Y-m-d'),
				"status"=> "IN",
				"key"   => "VSH4527987"
			),
			array(
				"photo" => "https://picsum.photos/seed/student2/400/300",
				"name"  => "Carlos Lando",
				"id"    => "2026-00006",
				"time"  => $now->format('h:i:s A'),
				"date"  => $now->format('Y-m-d'),
				"status"=> "IN",
				"key"   => "VSH5724987"
			),
		);
	}
	
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
		return array_values(array_filter($this->sampleData(), function($value) use ($key) {
			return $value['key'] === $key;
		}));
	}
	
}
