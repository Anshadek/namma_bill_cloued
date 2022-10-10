<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function xss_html_filter($input){
		return $this->security->xss_clean(html_escape($input));
	}
	


	public function verify_and_save(){

		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
		//$store_id=(store_module() && is_admin()) ? $store_id : get_current_store_id();
		$store_id= get_current_store_id();
		if(!empty($mobile)){
			$query=$this->db->query("select * from db_warehouse where mobile='$mobile' and  store_id=$store_id")->num_rows();
			if($query>0){ return "This Moble Number already exist.";}
		}
		if(!empty($email)){
			$query=$this->db->query("select * from db_warehouse where email='$email' and  store_id=$store_id")->num_rows();
			if($query>0){ return "This Email ID already exist.";}
		}
		$this->db->trans_begin();

		
		$ware_house_logo='';
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
	        	   $ware_house_logo='uploads/store/'.$this->upload->data('file_name');
	        }
		}

		$change_return = (isset($change_return)) ? 1 : 0;
		$mrp_column = (isset($mrp_column)) ? 1 : 0;
		$previous_balance_bit = (isset($previous_balance_bit)) ? 1 : 0;
		$round_off = (isset($round_off)) ? 1 : 0;


		$data = array(
		    				//'store_code'				=> $store_code,
							'store_id'					=>get_current_store_id(),
							'warehouse_type'           	=>   'Custom',
		    				'warehouse_name'			=> $warehouse_name,
		    				'warehouse_website'			=> $warehouse_website,
		    				'mobile'					=> $mobile,
		    				'phone'						=> $phone,
							'ware_house_logo'			=>$ware_house_logo,
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
		    				'date_format'				=> $date_format,
		    				'time_format'				=> $time_format,
		    				'sales_discount'			=> $sales_discount,
		    				'sales_discount'			=> $sales_discount,
		    				'change_return'				=> $change_return,
		    				'mrp_column'				=> $mrp_column,
		    				'previous_balance_bit'				=> $previous_balance_bit,
		    				'sales_invoice_format_id'	=> $sales_invoice_format_id,
		    				'pos_invoice_format_id'		=> $pos_invoice_format_id,
		    				'sales_invoice_footer_text'	=> $sales_invoice_footer_text,
		    				'invoice_terms'				=> $invoice_terms,
		    				'round_off'					=> $round_off,
		    				'decimals'					=> $decimals,
		    				'sales_payment_init'		=> $sales_payment_init,
		    				'sales_return_payment_init'	=> $sales_return_payment_init,
		    				'purchase_payment_init'		=> $purchase_payment_init,
		    				'purchase_return_payment_init'	=> $purchase_return_payment_init,
		    				'expense_payment_init'	=> $expense_payment_init,
		    				'cust_advance_init'	=> $cust_advance_init,
		    			);

		if(!empty($store_logo)){
			$data['store_logo']=$store_logo;
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

		


		if($command=='save'){
			// $store_code_count=$this->db->query("select count(*) as store_code_count from db_store where upper(store_code)=upper('$store_code')")->row()->store_code_count;
			// if($store_code_count>0){
			// 	echo "Sorry! Store Code Already Exist!\nPlease Change Store Code";exit();
			// }
			$extra_info = array(
							'invoice_view'				=> 1,
		    				'sms_status'				=> 0,
		    				'language_id'				=> $language_id,
		    				/*System Info*/
		    				'created_date' 				=> $CUR_DATE,
		    				'created_time' 				=> $CUR_TIME,
		    				'created_by' 				=> $CUR_USERNAME,
		    				'system_ip' 				=> $SYSTEM_IP,
		    				'system_name' 				=> $SYSTEM_NAME,
		    				'status' 					=> 1,
		    			);
			$data=array_merge($data,$extra_info);
			$q1 = $this->db->insert('db_warehouse', $data);
			$warehouse_id  = $this->db->insert_id();
		//============================================automatic account number genertaing==============================================
		$query = $this->db->query("SELECT accounts_init FROM db_store where id = ".get_current_store_id()." ORDER BY id DESC LIMIT 1");
		$accounts_init =  $query->result_array();
	
		$query = $this->db->query("SELECT account_code FROM ac_accounts ORDER BY id DESC LIMIT 1");
		$result = $query->result_array();
		$newstring = substr($result[0]['account_code'], -4);
		$next_int = $newstring + 1;
		$account_code = $accounts_init[0]['accounts_init'].'000'.$next_int;
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));

		$this->db->query("ALTER TABLE ac_accounts AUTO_INCREMENT = 1");
		if(empty($parent_id)) { 
			$parent_id=0;
			$maxid=$this->db->select("coalesce(max(id),0)+1 as maxid")->get("ac_accounts")->row()->maxid;
			$subtree_count='';
			$sort_code = $maxid;
		}
		else{
			//Find the sub tree count
			$this->db->select("sort_code")->where("id",$parent_id)->from("ac_accounts");
			$sort_code=$this->db->get()->row()->sort_code;
			$maxid=$this->db->select("count(*)+1 as maxid")->where("parent_id",$parent_id)->get("ac_accounts")->row()->maxid;
			$sort_code = $sort_code.".".$maxid;
		}
		
		$info = array(  
						'count_id' 					=> get_count_id('ac_accounts'), 
	    				'store_id' 					=> get_current_store_id(),
	    				'sort_code' 				=> $sort_code,
	    				'account_code' 				=> $account_code,
	    				'parent_id' 				=> $parent_id,
						'warehouse_id'				=> $warehouse_id,
	    				'account_name' 				=> 'cash',
	    				'note' 						=> "system created account",
	    				/*System Info*/
	    				'created_date' 				=> $CUR_DATE,
	    				'created_time' 				=> $CUR_TIME,
	    				'created_by' 				=> $CUR_USERNAME,
	    				'system_ip' 				=> $SYSTEM_IP,
	    				'system_name' 				=> $SYSTEM_NAME,
	    				'status' 					=> 1,
	    			);
		$q1 = $this->db->insert('ac_accounts', $info);
		//==============================================================================================================================
			//$store_id = $this->db->insert_id();
			//$this->load->model('customers_model');
			//$q2=$this->customers_model->create_walk_in_customer($store_id);

			// if(!$this->create_url_sms_api($store_id)){
			// 	return "failed";
			// }
			// if(!$this->create_url_sms_templates($store_id)){
			// 	return "failed";
			// }
			//$q3 = $this->create_default_warehouse($store_id,null,null);
			// if(!$q3){
			// 	echo "failed";exit();
			// }
			if($q1){
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Success!! Record Saved Successfully! ');
				echo "success";
			}

		}
		
		exit();
	}






	public function verify_and_update($data){
		
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		$store_id=(store_module() && is_admin()) ? $store_id : get_current_store_id();

		$query=$this->db->query("select * from db_warehouse where warehouse_name='$warehouse_name' and id<>$q_id and store_id=$store_id")->num_rows();
		if($query>0){ return "This Warehouse Name Already Exist.";}
		if(!empty($mobile)){
			$query=$this->db->query("select * from db_warehouse where mobile='$mobile' and id<>$q_id and store_id=$store_id")->num_rows();
			if($query>0){ return "This Moble Number already exist.";}
		}
		if(!empty($email)){
			$query=$this->db->query("select * from db_warehouse where email='$email' and id<>$q_id and store_id=$store_id")->num_rows();
			if($query>0){ return "This Email ID already exist.";}
		}
		
		$query1="UPDATE db_warehouse SET warehouse_name='$warehouse_name', mobile='$mobile', email='$email' where id=$q_id and store_id=$store_id";
		
		if ($this->db->simple_query($query1)){
				$this->session->set_flashdata('success', 'Success!! Warehouse Updated Succssfully!!');
		        return "success";
		}
		else{
		        return "failed";
		}

		

	}
	public function status_update($id,$status){
		
        $query1="update db_warehouse set status='$status' where id=$id";
		
		if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}

	public function pay_status_update($id,$status){
		
        $query1="update db_warehouse set pay_status='$status' where id=$id";
        if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}
	
	//Get users deatils
	public function get_details($id){
		$data=$this->data;
		$query1=$this->db->query("select * from db_warehouse
		 where 
		 upper(id )
		 =upper('$id')
		 ");
		if($query1->num_rows()==0){
			show_404();exit;
		}
		else{
			// check  users 	$this->db->table('');
		$this->db->select("db_users.password");
		$this->db->where("db_userswarehouses.warehouse_id",$id);
		$this->db->join("db_userswarehouses","db_users.id = db_userswarehouses.user_id");
		
		$users = $this->db->get('db_users')->row();
			/* QUERY 1*/
			$data['q_id']=$query1->row()->id;
			$data['password'] = (isset($users->password))  ? $users->password : "";

			return array_merge($data,$query1->row_array());
			return $data;
		}
	}

	public function delete_warehouse($id){
      	$this->db->trans_begin();
		//=============================checking warehouse effecting tables===================================================
      	// check items 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_items');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the item Records!";
		}
		// check category 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_category');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the category Records!";
		}
		// check varient 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_variants');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the variants Records!";
		}
		// check varient 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_variants');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the variants Records!";
		}
		// check purchase 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_purchase');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the purchase Records!";
		}

		// check  purchase retuern 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_purchasereturn');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the purchase return Records!";
		}

		// check  users 
		$this->db->select("*");
		  $this->db->where("b.warehouse_id",$id);
		  $this->db->join("db_userswarehouses as b","db_users.id = b.user_id");
		  $query = $this->db->get('db_users');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the users Records!";
		}
		// check  suppliers 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_suppliers');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the suppliers Records!";
		}
		// check  quotation 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_quotation');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the quotation Records!";
		}
		// check  expense 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_expense');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the expense Records!";
		}

		// check   custadvance 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_custadvance');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the  custamer advance Records!";
		}
		// check   account 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('ac_accounts');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the  account Records!";
		}

		// check expense category 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_expense_category');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the expense category Records!";
		}

		// check expense 
		$this->db->select("*");
		  $this->db->where("warehouse_id",$id);
		  $query = $this->db->get('db_expense');
		  $result = $query->result();
		if(count($result)>0){
			$this->db->trans_rollback();
			return "Can't Delete! These warehouse List Have the expense  Records!";
		}

		//==========================================================================================



        $q2=$this->db->query("delete from db_warehouse where id='$id' and warehouse_type='Custom' and store_id=".get_current_store_id());
      
		if($q2!=1)
		{
			$this->db->trans_rollback();
		    return "failed";
		}
		else{
			$this->db->trans_commit();
		        return "success";
		}
	}

	public function view_warehouse_wise_stock_item($item_id){
		$CI =& get_instance();
		$this->db->select("a.item_name,a.sales_price,a.store_id");
		$this->db->from("db_items as a");
		$this->db->select("b.brand_name");
		$this->db->join('db_brands as b','b.id=a.brand_id','left');
		$this->db->select("c.category_name");
		$this->db->from("db_category as c");
		$this->db->where("c.id=a.category_id");
		$this->db->where("a.id",$item_id);
		$q1=$this->db->get()->row();
		
		?>
		<div class="modal fade" id="view_warehouse_wise_stock_item_model">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center"><?=$this->lang->line('warehouse_wise_stock');?></h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-4 invoice-col">
			          <i><b><?= $this->lang->line('item_information') ?></b></i>
			          <address>
			            <?php echo (!empty(trim($q1->item_name))) ? $this->lang->line('item_name').": ".$q1->item_name."<br>" : '';?>
			            <?php echo (!empty(trim($q1->brand_name))) ? $this->lang->line('brand_name').": ".$q1->brand_name."<br>" : '';?>
			            <?php echo (!empty(trim($q1->category_name))) ? $this->lang->line('category_name').": ".$q1->category_name."<br>" : '';?>
			            
			            <?php echo (!empty(trim($q1->sales_price))) ? $this->lang->line('sales_price').": ".$CI->currency($q1->sales_price)."<br>" : '';?>
			          </address>
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		       
		     
		              <div class="row">
		         		<div class="col-md-12">
		                  
		                      <table class="table table-bordered">
                                 <thead>
                                  <tr class="bg-primary">
                                    <th>#</th>
                                    <th><?= $this->lang->line('warehouse_type'); ?></th>
                                    <th><?= $this->lang->line('warehouse_name'); ?></th>
                                    <th><?= $this->lang->line('stock_quantity'); ?></th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	//Only Allowed Warehouse show to loged in user
						         	if(!is_admin() && !is_store_admin()){
						         		//Find the previllaged wareshouses to the user
						         		$privileged_warehouses = get_privileged_warehouses_ids();
						         		$this->db->where("id in ($privileged_warehouses)");
						         	}
						         	$this->db->where("store_id",$q1->store_id);
                                	$q1=$this->db->select("*")->get("db_warehouse");
									$i=1;
									$str = '';
									if($q1->num_rows()>0){
										foreach ($q1->result() as $res1) {
											echo "<tr>";
											echo "<td>".$i++."</td>";
											echo "<td>".$res1->warehouse_type."</td>";
											echo "<td>".$res1->warehouse_name."</td>";
											echo "<td>".number_format(get_total_qty_of_warehouse_item($item_id,$res1->id),2)."</td>";
											echo "</tr>";
										}
									}
									else{
										echo "<tr><td colspan='4' class='text-danger text-center'>No Records Found</td></tr>";
									}
									?>
                                </tbody>
                            </table>
		               
		               </div>
		            <div class="clearfix"></div>
		        </div>    
		       
		     
		   
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}

	public function create_url_sms_api($store_id){
		$q1=$this->db->select("*")->where("store_id",$store_id)->get("db_smsapi");
		if($q1->num_rows()==0){
			$insertArray = [
			   [
			      'store_id' => $store_id,
			      'info' => 'url',
			      'key' => 'weblink',
			      'key_value' => 'http://example.com/sendmessage',
			   ],
			   [
			      'store_id' => $store_id,
			      'info' => 'mobile',
			      'key' => 'mobiles',
			      'key_value' => '',
			   ],
			   [
			      'store_id' => $store_id,
			      'info' => 'message',
			      'key' => 'message',
			      'key_value' => '',
			   ],
			   
			];
			if(!$this->db->insert_batch('db_smsapi', $insertArray)){
				return false;
			}
		}
		return true;
	}

	public function create_url_sms_templates($store_id){
		$q1=$this->db->select("*")->where("store_id",$store_id)->get("db_smstemplates");
		if($q1->num_rows()==0){
			$insertArray = [
			   [
			      'store_id' => $store_id,
			      'template_name' => 'GREETING TO CUSTOMER ON SALES',
			      'content' => "Hi {{customer_name}},
Your sales Id is {{sales_id}},
Sales Date {{sales_date}},
Total amount  {{sales_amount}},
You have paid  {{paid_amt}},
and due amount is  {{due_amt}}
Thank you Visit Again",
			      'variables' => "{{customer_name}}                          
{{sales_id}}
{{sales_date}}
{{sales_amount}}
{{paid_amt}}
{{due_amt}}
{{store_name}}
{{store_mobile}}
{{store_address}}
{{store_website}}
{{store_email}}
",
				'status'	=> 1,
				'undelete_bit'	=> 1,
			   ],
			   [
			      'store_id' => $store_id,
			      'template_name' => 'GREETING TO CUSTOMER ON SALES RETURN',
			      'content' => "Hi {{customer_name}},
Your sales return Id is {{return_id}},
Return Date {{return_date}},
Total amount  {{return_amount}},
We paid  {{paid_amt}},
and due amount is  {{due_amt}}
Thank you Visit Again",
			      'variables' => "{{customer_name}}                          
{{return_id}}
{{return_date}}
{{return_amount}}
{{paid_amt}}
{{due_amt}}
{{company_name}}
{{company_mobile}}
{{company_address}}
{{company_website}}
{{company_email}}
",
				'status'	=> 1,
				'undelete_bit'	=> 1,
			   ],
			   
			];
			if(!$this->db->insert_batch('db_smstemplates', $insertArray)){
				return false;
			}
		}
		return true;
	}
}
