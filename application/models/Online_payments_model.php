<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online_payments_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }
    //insert transaction data

    public function storeTransaction($data = array()){
        $insert = $this->db->insert('db_paypalpaylog',$data);
        return $insert?true:false;
    }

    /**
     * Validate is records exist or not
    */
    public function validatePaypalRecords():bool{
        $q1 = $this->db->select('*')->where("store_id",1)->get("db_paypal");
        if($q1->num_rows()>0){
            $email = $q1->row()->email;
            if(empty(trim($email))){
                return false;
            }
            return true;
        }
        else{
            return false;
        }

    }

    /**
     * Validate is records exist or not
    */
    public function validateInstamojoRecords():bool{
        $q1 = $this->db->select('*')->where("store_id",1)->get("db_instamojo");
        if($q1->num_rows()>0){
            $key = trim($q1->row()->api_key);
            $token = trim($q1->row()->api_token);
            if(empty($key) || empty($token) ){
                return false;
            }
            return true;
        }
        else{
            return false;
        }

    }


}