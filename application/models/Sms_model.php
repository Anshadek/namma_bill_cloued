<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_model extends CI_Model {
	public function xss_html_filter($input){
		return $this->security->xss_clean(html_escape($input));
	}
	//UPDATE SMS API
	public function api_update(){
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		//print_r($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));exit();
		$store_id = get_current_store_id();
		$this->db->trans_begin();
		if($hidden_rowcount>0){
		$this->db->query("delete from db_smsapi where store_id=".$store_id);
		$this->db->query("ALTER TABLE db_smsapi AUTO_INCREMENT = 1");
			for($i=1; $i<=$hidden_rowcount; $i++){
				if(isset($_POST['info_'.$i])){
					$info 	 	= $_POST['info_'.$i];
					$key 	 	= $_POST['key_'.$i];
					$key_value 	= $_POST['key_val_'.$i];
					
					$q1=$this->db->query("insert into db_smsapi(
								info,`key`,key_value,store_id)
								values(
								'$info',
								'$key',
								'$key_value',
								$store_id
							)");
					if(!$q1){
						return "failed";
					}

				}//if end()
			}//for end()	
		}

		$q2=$this->db->query("update db_store set sms_status=$sms_status where id=".$store_id);
		if(!$q2){
			return "failed";
		}

		//save Twilio SMS API
		$twilio = array('account_sid' => $account_sid,'auth_token'=>$auth_token,'twilio_phone'=>$twilio_phone );
		$q1=$this->db->select("*")->where("store_id",$store_id)->get("db_twilio");
        if($q1->num_rows()>0){
          $q2 = $this->db->where("store_id",$store_id)->update("db_twilio",$twilio);
        }
        else{
        	$twilio = array_merge($twilio,array('store_id' => $store_id));
        	$q2=$this->db->insert("db_twilio",$twilio);
        }

        if(!$q2){
        	return "failed";
        }

			$this->session->set_flashdata('success', 'Record Successfully Saved!!');
			$this->db->trans_commit();
		    return "success";
	}
	//Send Messagr
	public function send_sms($mobile,$message){

		$store_id = get_current_store_id();

		$store_rec = get_store_details();
		$sms_status=$store_rec->sms_status;

		if($sms_status==0){
			return "Sorry! Can't Send.Please Enable SMS";
		}
		if($sms_status==1){
			$q1=$this->db->query("select * from db_smsapi where store_id=".$store_id);
			if($q1->num_rows()>0){
				$api=array();
				foreach($q1->result() as $res1){
					if($res1->info =='message'){
						$api = array_merge($api, [$res1->key => $message]);
					}
					else if($res1->info =='mobile'){
						$api = array_merge($api, [$res1->key => $mobile]);
					}
					else{
						$api = array_merge($api, [$res1->key => $res1->key_value]);
					}
				}
				/*For Special characters need to set unicode Ex: Currency Symbols*/
				$api = array_merge($api, ['unicode' => '1']);
				
				//print_r($api);exit();

				$ch = curl_init();
				$data = http_build_query($api);
				$getUrl = $api['weblink']."?".$data;
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_URL, $getUrl);
				curl_setopt($ch, CURLOPT_TIMEOUT, 80);
				 
				$response = curl_exec($ch);
				 
				if(curl_error($ch)){
					return 'failed';
				}
				else
				{
					return 'success';
				}
				 
				curl_close($ch);
				//return $output;
			}
			else{
				return "API Not Available";
			}
		}
		if($sms_status==2){
			//Twilio SMS API
			$this->load->model('twilio_model');
			return $this->twilio_model->index($mobile,$message);
		}
		

	}

}

/* End of file Sms_model.php */
/* Location: ./application/models/Sms_model.php */