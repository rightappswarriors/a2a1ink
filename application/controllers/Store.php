<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

    public $CI = NULL;
    
	function __construct(){
        parent::__construct();
        $this->CI = & get_instance();
		date_default_timezone_set('Asia/Manila');
        $this->load->model('store_model');
	}
    
	public function index()
	{
        
        if ($this->input->post()) {
        
            $uid = $this->input->post("uid");
            $key = $this->input->post("keyid");
            $serial = $this->input->post("serial");
            
            // ACCOUNT RECORD
            $account_record = $this->store_model->get_accountid($key);
            if($account_record->num_rows()>0){
                
                // CONSUMER RECORD
                $accountid = $account_record->row()->id;
                $consumer_record = $this->store_model->get_consumer($uid,$accountid);
                
                if($consumer_record->num_rows()>0){
                
                $row=$consumer_record->row();
                    
                $logdatetime = date("Y-m-d H:i:s");
                $logdate = date("Y-m-d");

                $data = array(
                    'cardno' => $uid,
                    'accountid' => $accountid,
                    'device' => $serial,
                    'logdatetime' => $logdatetime,
                    'logdate' => $logdate
                );
                $this->store_model->insert($data);

                // DEVICE RECORD 
                $gateinfo = "none";    
                $gaterecord = $this->store_model->get_device($serial,$accountid);
                if($gaterecord->num_rows()>0){
                    $gateinfo = $gaterecord->row()->direction;
                }
                    
                $toreturn = $row->consumer . "|";
                $toreturn .= date("m/d/Y", strtotime($logdate)) . "|";
                $toreturn .= date('h:i:a', strtotime($logdatetime)) . "|";
                $toreturn .= $row->mobileno . "|";
                $toreturn .= $gateinfo;
                
                echo $toreturn;    
                    
                }else{
                    echo "002"; // CARD NOT FOUND
                }
                    
            }else{
                echo "001"; // KEY NOT FOUND
            }
                
        }else{
            echo "POST ONLY!";
        }
            
	}
    
}
