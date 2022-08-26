<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_profile_model extends CI_Model {

	// public function update_store(){

	// 	//Filtering XSS and html escape from user inputs 
	// 	extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
	// 	//echo "<pre>";print_r($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));exit();

	// 	//if not admin
	// 	if(!is_admin()){
	// 		if($q_id!=get_current_store_id()){
	// 			echo "Something Went Wrong";exit();
	// 		}
	// 	}


	// 	$this->db->trans_begin();

		
	// 	$store_logo='';
	// 	if(!empty($_FILES['store_logo']['name'])){
	// 		$config['upload_path']          = './uploads/store/';
	//         $config['allowed_types']        = 'gif|jpg|jpeg|png';
	//         $config['max_size']             = 1000;
	//         $config['max_width']            = 1000;
	//         $config['max_height']           = 1000;

	//         $this->load->library('upload', $config);

	//         if ( ! $this->upload->do_upload('store_logo'))
	//         {
	//                 $error = array('error' => $this->upload->display_errors());
	//                 return $error['error'];
	//                 exit();
	//         }
	//         else
	//         {
	//         	   $store_logo='uploads/store/'.$this->upload->data('file_name');
	//         }
	// 	}

	// 	$change_return = (isset($change_return)) ? 1 : 0;
	// 	$mrp_column = (isset($mrp_column)) ? 1 : 0;
	// 	$previous_balance_bit = (isset($previous_balance_bit)) ? 1 : 0;
	// 	$round_off = (isset($round_off)) ? 1 : 0;

		

	// 	$data = array(
	// 	    				'store_code'				=> $store_code,
	// 	    				'store_name'				=> $store_name,
	// 	    				'store_website'				=> $store_website,
	// 	    				'mobile'					=> $mobile,
	// 	    				'phone'						=> $phone,
	// 	    				'email'						=> $email,
	// 	    				'country'					=> $country,
	// 	    				'state'						=> $state,
	// 	    				'city'						=> $city,
	// 	    				'address'					=> $address,
	// 	    				'postcode'					=> $postcode,
	// 	    				'bank_details'				=> $bank_details,
	// 	    				'category_init'				=> $category_init,
	// 	    				'item_init'					=> $item_init,
	// 	    				'supplier_init'				=> $supplier_init,
	// 	    				'purchase_init'				=> $purchase_init,
	// 	    				'purchase_return_init'		=> $purchase_return_init,
	// 	    				'customer_init'				=> $customer_init,
	// 	    				'sales_init'				=> $sales_init,
	// 	    				'sales_return_init'			=> $sales_return_init,
	// 	    				'expense_init'				=> $expense_init,
	// 	    				'quotation_init'			=> $quotation_init,
	// 	    				'money_transfer_init'		=> $money_transfer_init,
	// 	    				'accounts_init'				=> $accounts_init,
	// 	    				'currency_id'				=> $currency,
	// 	    				'currency_placement'		=> $currency_placement,
	// 	    				'timezone'					=> $timezone,
	// 	    				'date_format'				=> $date_format,
	// 	    				'time_format'				=> $time_format,
	// 	    				'sales_discount'			=> $sales_discount,
	// 	    				'sales_discount'			=> $sales_discount,
	// 	    				'change_return'				=> $change_return,
	// 	    				'sales_invoice_format_id'	=> $sales_invoice_format_id,
	// 	    				'pos_invoice_format_id'		=> $pos_invoice_format_id,
	// 	    				'sales_invoice_footer_text'	=> $sales_invoice_footer_text,
	// 	    				'invoice_terms'				=> $invoice_terms,
	// 	    				'round_off'					=> $round_off,
	// 	    				'language_id'				=> $language_id,
	// 	    				'decimals'					=> $decimals,
	// 	    				'sales_payment_init'		=> $sales_payment_init,
	// 	    				'sales_return_payment_init'	=> $sales_return_payment_init,
	// 	    				'purchase_payment_init'		=> $purchase_payment_init,
	// 	    				'purchase_return_payment_init'	=> $purchase_return_payment_init,
	// 	    				'expense_payment_init'	=> $expense_payment_init,
	// 	    				'cust_advance_init'	=> $cust_advance_init,
	// 	    				'mrp_column'	=> $mrp_column,
	// 	    				'previous_balance_bit'	=> $previous_balance_bit,
	// 	    			);

	// 	if(!empty($store_logo)){
	// 		$data['store_logo']=$store_logo;
	// 	}
	// 	/*custom helper*/
	// 	if(gst_number()){
	// 		$data['gst_no']=$gst_no;
	// 	}
	// 	if(vat_number()){
	// 		$data['vat_no']=$vat_no;
	// 	}
	// 	if(pan_number()){
	// 		$data['pan_no']=$pan_no;
	// 	}
	// 	/*end*/

		
	// 		$store_code_count=$this->db->query("select count(*) as store_code_count from db_store where upper(store_code)=upper('$store_code') and id<>$q_id")->row()->store_code_count;
	// 		if($store_code_count>0){
	// 			echo "Sorry! Store Code Already Exist!\nPlease Change Store Code";exit();
	// 		}

	// 		$q1 = $this->db->where('id',$q_id)->update('db_store', $data);
	// 		if($q1){
	// 			$this->db->trans_commit();
	// 			$this->session->unset_userdata('currency');
	// 			//$this->session->set_flashdata('success', 'Success!! Record Updated Successfully! ');
	// 			echo "success";
	// 		}

		

	// 	exit();
	// }



	public function update_store(){

		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
		//echo "<pre>";print_r($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));exit();
		
		//if not admin
		// if(!is_admin()){
		// 	if($q_id!=get_current_store_id()){
		// 		echo "Something Went Wrong";exit();
		// 	}
		// }


		$this->db->trans_begin();

		
		$store_logo='';
		if(!empty($_FILES['store_logo']['name'])){
			$config['upload_path']          = './uploads/store/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 1000;
	        $config['max_width']            = 1000;
	        $config['max_height']           = 1000;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('store_logo'))
	        {
	                $error = array('error' => $this->upload->display_errors());
	                return $error['error'];
	                exit();
	        }
	        else
	        {
	        	   $warehouse_logo='uploads/store/'.$this->upload->data('file_name');
	        }
		}else{
			$warehouse_logo = $_FILES['store_logo']['name'];
		}

		$change_return = (isset($change_return)) ? 1 : 0;
		$mrp_column = (isset($mrp_column)) ? 1 : 0;
		$previous_balance_bit = (isset($previous_balance_bit)) ? 1 : 0;
		$round_off = (isset($round_off)) ? 1 : 0;

		

		$data = array(
		    				//'store_code'				=> $store_code,
		    				'warehouse_name'			=> $warehouse_name,
		    				'warehouse_website'			=> $warehouse_website,
		    				'mobile'					=> $mobile,
		    				'phone'						=> $phone,
		    				'email'						=> $email,
		    				'country'					=> $country,
		    				'state'						=> $state,
		    				'city'						=> $city,
		    				'address'					=> $address,
		    				'postcode'					=> $postcode,
		    				'bank_details'				=> $bank_details,
		    				'category_init'				=> $category_init,
		    				'item_init'					=> $item_init,
		    				'supplier_init'				=> $supplier_init,
		    				'purchase_init'				=> $purchase_init,
		    				'purchase_return_init'		=> $purchase_return_init,
		    				'customer_init'				=> $customer_init,
		    				'sales_init'				=> $sales_init,
		    				'sales_return_init'			=> $sales_return_init,
		    				'expense_init'				=> $expense_init,
		    				'quotation_init'			=> $quotation_init,
		    				'money_transfer_init'		=> $money_transfer_init,
		    				'accounts_init'				=> $accounts_init,
		    				'currency_id'				=> $currency,
		    				'currency_placement'		=> $currency_placement,
		    				'timezone'					=> $timezone,
		    				'date_format'				=> $date_format,
		    				'time_format'				=> $time_format,
		    				'sales_discount'			=> $sales_discount,
		    				'sales_discount'			=> $sales_discount,
		    				'change_return'				=> $change_return,
		    				'sales_invoice_format_id'	=> $sales_invoice_format_id,
		    				'pos_invoice_format_id'		=> $pos_invoice_format_id,
		    				'sales_invoice_footer_text'	=> $sales_invoice_footer_text,
		    				'invoice_terms'				=> $invoice_terms,
		    				'round_off'					=> $round_off,
		    				'language_id'				=> $language_id,
		    				'decimals'					=> $decimals,
		    				'sales_payment_init'		=> $sales_payment_init,
		    				'sales_return_payment_init'	=> $sales_return_payment_init,
		    				'purchase_payment_init'		=> $purchase_payment_init,
		    				'purchase_return_payment_init'	=> $purchase_return_payment_init,
		    				'expense_payment_init'	=> $expense_payment_init,
		    				'cust_advance_init'	=> $cust_advance_init,
		    				'mrp_column'	=> $mrp_column,
		    				'previous_balance_bit'	=> $previous_balance_bit,
		    			);

		if(!empty($warehouse_logo)){
			$data['ware_house_logo']=$warehouse_logo;
		}
		/*custom helper*/
		if(gst_number()){
			$data['gst_no']=$gst_no;
		}
		if(vat_number()){
			$data['vat_no']=$vat_no;
		}
		if(pan_number()){
			$data['pan_no']=$pan_no;
		}
		/*end*/

		
			// $store_code_count=$this->db->query("select count(*) as store_code_count from db_store where upper(store_code)=upper('$store_code') and id<>$q_id")->row()->store_code_count;
			// if($store_code_count>0){
			// 	echo "Sorry! Store Code Already Exist!\nPlease Change Store Code";exit();
			// }
				
			$q1 = $this->db
			->where('id',$q_id)
			//->where('warehouse_type','System')
			->update('db_warehouse', $data);
			if($q1){
				$this->db->trans_commit();
				$this->session->unset_userdata('currency');
				//$this->session->set_flashdata('success', 'Success!! Record Updated Successfully! ');
				echo "success";
			}

		

		exit();
	}








	//Get store_details
	public function get_details($id){
		$data=$this->data;

		$query1=$this->db->query("select db_warehouse.*,db_store.store_code from db_warehouse
		LEFT JOIN db_store ON db_warehouse.store_id=db_store.id
		 where 
		 warehouse_type
		 ='System'
		 and 
		 upper(store_id )
		 =upper('$id')
		
		 ");
		if($query1->num_rows()==0){
			show_404();exit;
		}
		else{
			/* QUERY 1*/
			$data['q_id']=$query1->row()->id;
			return array_merge($data,$query1->row_array());
			return $data;
		}
	}

	public function create_store()
	{
		
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		//echo "<pre>";print_r($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));exit();

		//if not admin


		$this->db->trans_begin();
		if (!empty($mobile)) {
			$query = $this->db->query("select * from db_users where mobile='$mobile'")->num_rows();
			if ($query > 0) {
				return "This Moble Number already exist.";
			}
		}
		if (!empty($email)) {
			$query = $this->db->query("select * from db_users where email='$email'")->num_rows();
			if ($query > 0) {
				return "This Email ID already exist.";
			}
		}

		$store_logo = '';
		if (!empty($_FILES['store_logo']['name'])) {
			$config['upload_path']          = './uploads/store/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1000;
			$config['max_height']           = 1000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('store_logo')) {
				$error = array('error' => $this->upload->display_errors());
				return $error['error'];
				exit();
			} else {
				$store_logo = 'uploads/store/' . $this->upload->data('file_name');
			}
		}

		$change_return = (isset($change_return)) ? 1 : 0;
		$mrp_column = (isset($mrp_column)) ? 1 : 0;
		$round_off = (isset($round_off)) ? 1 : 0;

		$query = $this->db->query("SELECT * FROM db_store ORDER BY id DESC LIMIT 1");
		$result = $query->result_array();
		if (count($result) > 0){
			$code = substr($result[0]['store_code'] , -4);
		$l=max(strlen($code),1);
		$next_code=str_pad($code+1, $l,"0", STR_PAD_LEFT);
		$store_code = 'ST'.$next_code;
		}else{
			$store_code = 'ST0003';
		}
		
		
	$data = array(
			'store_code'				=> $store_code,
			'store_name'				=> $store_name,
			'currency_id'			=>35,
			'currency_placement'	=>'Left',
			'mobile'					=> $mobile,
			'phone'						=> $phone,
			'email'						=> $email,
			'country'					=> $country,
			'timezone'					=>'Asia/Kolkata',
			'state'						=> $state,
			'city'						=> $city,
			'address'					=> $address,
			'postcode'					=> $postcode,
			'bank_details'				=> $bank_details,
			'status'					=>1,
		
		);

		if (!empty($store_logo)) {
			$data['store_logo'] = $store_logo;
		}
		/*custom helper*/
		
		if (vat_number()) {
			$data['vat_no'] = $vat_no;
		}
		if (pan_number()) {
			$data['pan_no'] = $pan_no;
		}
		/*end*/


	
		$q1 = $this->db->insert('db_store', $data);
		
		$row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("db_store")->row();
		
		$last_inert_id =$row->id;
	
		

		/*$query=$this->db->query("select * from db_users where username='$new_user'")->num_rows();
				if($query>0){ return "This username already exist.";}*/
		
		$info = array(
			'username' 				=> $store_name,
			'last_name' 			=> '',
			'password' 				=> md5(12345),
			'mobile' 				=> $mobile,
			'email' 				=> $email,
			/*System Info*/
			'created_date' 			=> $CUR_DATE,
			'created_time' 			=> $CUR_TIME,
			'created_by' 			=> 'admin',
			'system_ip' 			=> $SYSTEM_IP,
			'system_name' 			=> $SYSTEM_NAME,
			'role_id'				=>2,
			'status' 				=> 1,
			'store_id'              =>$last_inert_id,
		
		);
		
	
		$q1 = $this->db->insert('db_users', $info);
		
		$data = array(

			'store_id'					=> $last_inert_id,
			'currency_id'			=>35,
			'currency_placement'	=>'Left',
			'warehouse_type'            => 'System',
			'warehouse_name'			=> $store_name,
			'mobile'					=> $mobile,
			'phone'						=> $phone,
			'email'						=> $email,
			'country'					=> $country,
			'timezone'					=>'Asia/Kolkata',
			'state'						=> $state,
			'city'						=> $city,
			'address'					=> $address,
			'postcode'					=> $postcode,
			'status'					=>1,
			'bank_details'				=> $bank_details,
		
		);
		

		if (!empty($store_logo)) {
			$data['warehouse_logo'] = $store_logo;
		}
		/*custom helper*/
		
		if (vat_number()) {
			$data['vat_no'] = $vat_no;
		}
		if (pan_number()) {
			$data['pan_no'] = $pan_no;
		}
		/*end*/


	
		$q1 = $this->db->insert('db_warehouse', $data);

		if (!$q1) {
			return "failed";
		}
		
		$this->db->trans_commit();
		$this->session->set_flashdata('success', 'Success!! New User created Succssfully!!');
		return "success";
		if ($q1) {
			$this->db->trans_commit();
			$this->session->unset_userdata('currency');
			$this->session->set_flashdata('success', 'Success!! Record Updated Successfully! ');
			echo "success";
		}



		exit();
	}

}
