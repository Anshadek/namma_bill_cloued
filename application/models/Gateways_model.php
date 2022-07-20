<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gateways_model extends CI_Model {
	
	public function update_gateways(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));


		//PAYPAL
		$paypal = array(
		                'sandbox'         		=> $paypal_sandbox,
		                'email'        	   		=> $paypal_email,
		                'status'         		=> 1,
		                'store_id'         		=> 1,
		                'updated_at'            => $CUR_DATE,
		                'updated_by'        	=> $CUR_USERNAME,
		              );
		$query1 = $this->db->where('id',1)->update('db_paypal', $paypal);
		if (!$query1){
			return "failed";
		}

		//INSTAMOJO
		$instamojo = array(
		                'sandbox'         		=> $mojo_sandbox,
		                'api_key'        	   	=> $mojo_api_key,
		                'api_token'        		=> $mojo_api_token,
		                'status'         		=> 1,
		                'store_id'         		=> 1,
		                'updated_at'            => $CUR_DATE,
		                'updated_by'        	=> $CUR_USERNAME,
		              );
		$query1 = $this->db->where('id',1)->update('db_instamojo', $instamojo);
		if (!$query1){
			return "failed";
		}


		//Bank Details
		$bank_details = array(
		                'country_id'        	=> $country_id,
		                'holder_name'        	=> $account_holder_name,
		                'bank_name'        		=> $bank_name,
		                'branch_name'        	=> $bank_branch,
		                'code'        			=> $bank_code,
		                'account_type'        	=> $account_type,
		                'account_number'        => $account_number,
		                'other_details'        	=> $other_details,
		                'description'           => $description,
		                'status'        		=> $bank_status,
		              );
		$query1 = $this->db->where('store_id',1)->update('db_bankdetails', $bank_details);
		if (!$query1){
			return "failed";
		}


		return "success";
	}

	public function update_status($id,$status){

		if($id==1){
			echo "Sorry! This Record Restricted! Can't Update Status";exit();
		}

		if (set_status_of_table($id,$status,'db_gateways')){
            echo "success";
        }
        else{
            echo "failed";
        }
        
	}

	public function delete_gateways_from_table($ids){
		$this->db->trans_begin();

		if($ids==1){
			echo "Sorry! This Record Restricted! Can't Delete";exit();
		}
		$q1 = $this->db->query("select count(*) as tot_entrys from db_sales where gateway_id in ($ids)");
		if($q1->row()->tot_entrys >0 ){
			echo "Sales Invoices Exist of Gateway! Please Delete Sales Invoices!";exit();
		}

		//ACCOUNT RESET
		$reset_accounts = $this->db->select("debit_account_id,credit_account_id")
									->where("gateway_id in ($ids)")
									->group_by("debit_account_id,credit_account_id")
									->get("ac_transactions");
		//ACCOUNT RESET END

		#----------------------------------
		$this->db->where("gateway_id in ($ids)");
		$this->db->where("gateway_id!=1");
		$this->db->where("short_code",'OPENING BALANCE PAID');
      	//if not admin
      	if(!is_admin()){
        	$this->db->where("store_id",get_current_store_id());
      	}

      	$query1=$this->db->delete("db_salespayments");
        #---------------------------------
        $this->db->where("id in ($ids)");
		$this->db->where("id!=1");
      	//if not admin
      	if(!is_admin()){
        	$this->db->where("store_id",get_current_store_id());
      	}

      	$query2=$this->db->delete("db_gateways");
        #---------------------------------

      	//ACCOUNT RESET
        if($reset_accounts->num_rows()>0){
        	foreach ($reset_accounts->result() as $res1) {
        		if(!update_account_balance($res1->debit_account_id)){
					return 'failed';
				}

				if(!update_account_balance($res1->credit_account_id)){
					return 'failed';
				}

        	}
        }
        //ACCOUNT RESET END
        
        if ($query1 && $query2){
        	$this->db->trans_commit();
            echo "success";
        }
        else{
            echo "failed";
        }	
	}

	public function show_pay_now_modal($gateway_id){
		$CI =& get_instance();
		$sales_id='';
		
		$q2=$this->db->query("select * from db_gateways where id=$gateway_id");
		$res2=$q2->row();

		$gateway_name=$res2->gateway_name;
	    $gateway_mobile=$res2->mobile;
	    $gateway_phone=$res2->phone;
	    $gateway_email=$res2->email;
	    $gateway_country=$res2->country_id;
	    $gateway_state=$res2->state_id;
	    $gateway_address=$res2->address;
	    $gateway_postcode=$res2->postcode;
	    $gateway_gst_no=$res2->gstin;
	    $gateway_tax_number=$res2->tax_number;
	    $gateway_opening_balance=$res2->opening_balance;
	    $gateway_sales_due=$res2->sales_due;

	    $sales_date='';//$res1->sales_date;
	    $reference_no='';//$res1->reference_no;
	    $sales_code='';//$res1->sales_code;
	    $sales_note='';//$res1->sales_note;
	    $grand_total=0;//$res1->grand_total;
	    $paid_amount=0;//$res1->paid_amount;
	    //$due_amount =0;//$grand_total - $paid_amount;

	    if(!empty($gateway_country)){
	      $gateway_country = $this->db->query("select country from db_country where id='$gateway_country'")->row()->country;  
	    }
	    if(!empty($gateway_state)){
	      $gateway_state = $this->db->query("select state from db_states where id='$gateway_state'")->row()->state;  
	    }

	    $sum_of_ob_paid = $this->db->query("select coalesce(sum(payment),0) sum_of_ob_paid from db_salespayments where gateway_id=$gateway_id and short_code='OPENING BALANCE PAID'")->row()->sum_of_ob_paid; 
	    $gateway_opening_balance_due = $gateway_opening_balance - $sum_of_ob_paid;

	    $q6 = $this->db->query("select coalesce(sum(grand_total),0) as total_sales_amount,coalesce(sum(paid_amount),0) as total_paid_amount from db_sales where gateway_id=$gateway_id"); 
	    $total_sales_amount = $q6->row()->total_sales_amount;
	    $total_paid_amount = $q6->row()->total_paid_amount;
	    //$total_sales_due_amount =$total_sales_amount - $total_paid_amount;
	    $due_amount = number_format($gateway_sales_due + $gateway_opening_balance_due,2,'.','') ;
		?>
		<div class="modal fade" id="pay_now">
		  <div class="modal-dialog ">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center">Pay Due Payments</h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-12 invoice-col">
			          <i><?= $this->lang->line('gateway_details'); ?></i>
			          <address>
			            <strong><?php echo  $gateway_name; ?></strong><br>
			            <?php echo (!empty(trim($gateway_mobile))) ? $this->lang->line('mobile').": ".$gateway_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_phone))) ? $this->lang->line('phone').": ".$gateway_phone."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_email))) ? $this->lang->line('email').": ".$gateway_email."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_gst_no))) ? $this->lang->line('gst_number').": ".$gateway_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_tax_number))) ? $this->lang->line('tax_number').": ".$gateway_tax_number."<br>" : '';?>
			            
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-12 invoice-col">

			        	<table class="table table-sm table-bordered bg-info" width="100%">
			        		<tr>
			        			<td class="text-right"><?= $this->lang->line('opening_balance'); ?></td>
			        			<td class="text-right"><?= $CI->currency($gateway_opening_balance); ?></td>
			        			<td class="text-right"><?= $this->lang->line('total_sales_amount'); ?></td>
			        			<td class="text-right"><?= $CI->currency($total_sales_amount); ?></td>
			        		</tr>
			        		<tr>
			        			<td class="text-right"><?= $this->lang->line('opening_balance_due'); ?></td>
			        			<td class="text-right"><?= $CI->currency($gateway_opening_balance_due); ?></td>
			        			<td class="text-right"><?= $this->lang->line('paid_amount'); ?></td>
			        			<td class="text-right"><?= $CI->currency($total_paid_amount); ?></td>
			        		</tr>
			        		<tr>
			        			<td colspan="2"></td>
			        			<td class="text-right"><?= $this->lang->line('sales_due'); ?></td>
			        			<td class="text-right"><?= $CI->currency($gateway_sales_due); ?></td>
			        		</tr>
			        	</table>
			         
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		        <div>
		        <input type="hidden" name="payment_row_count" id='payment_row_count' value="1">
		        <div class="col-md-12  payments_div">
		          <div class="box box-solid bg-gray">
		            <div class="box-body">
		              <div class="row">
		         		<div class="col-md-6">
		                  <div class="">
		                  <label for="payment_date"><?= $this->lang->line('date'); ?></label>
		                    <div class="input-group date">
			                      <div class="input-group-addon">
			                      <i class="fa fa-calendar"></i>
			                      </div>
			                      <input type="text" class="form-control pull-right datepicker" value="<?= show_date(date("d-m-Y")); ?>" id="payment_date" name="payment_date" readonly>
			                    </div>
		                      <span id="payment_date_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-6">
		                  <div class="">
		                  <label for="amount"><?= $this->lang->line('amount'); ?></label>
		                    <input type="text" class="form-control text-right paid_amt" data-due-amt='<?=$due_amount;?>' id="amount" name="amount" placeholder="" value="<?=$due_amount;?>" onkeyup="calculate_payments()">
		                      <span id="amount_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-6">
		                  <div class="">
		                    <label for="payment_type"><?= $this->lang->line('payment_type'); ?></label>
		                    <select class="form-control" id='payment_type' name="payment_type">
		                      <?php
		                        $q1=$this->db->query("select * from db_paymenttypes where status=1 and store_id=".get_current_store_id());
		                         if($q1->num_rows()>0){
		                             foreach($q1->result() as $res1){
		                             echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
		                           }
		                         }
		                         else{
		                            echo "No Records Found";
		                         }
		                        ?>
		                    </select>
		                    <span id="payment_type_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		                <div class="col-md-6">
		                  <div class="">
		                    <label for="account_id"><?= $this->lang->line('account'); ?></label>
		                    <select class="form-control" id='account_id' name="account_id">
		                      <?php
                                echo '<option value="">-None-</option>'; 
                                echo get_accounts_select_list();
                                ?>
		                    </select>
		                    <span id="account_id_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		            <div class="clearfix"></div>
		        </div>  
		        <div class="row">
		               <div class="col-md-12">
		                  <div class="">
		                    <label for="payment_note"><?= $this->lang->line('payment_note'); ?></label>
		                    <textarea type="text" class="form-control" id="payment_note" name="payment_note" placeholder="" ></textarea>
		                    <span id="payment_note_msg" style="display:none" class="text-danger"></span>
		                  </div>
		               </div>
		                
		            <div class="clearfix"></div>
		        </div>   
		        </div>
		        </div>
		      </div><!-- col-md-12 -->
		    </div>
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        <button type="button" onclick="save_payment(<?=$gateway_id;?>)" class="btn bg-green btn-lg place_order btn-lg payment_save">Save<i class="fa  fa-check "></i></button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}

	public function save_payment(){
		$this->db->trans_begin();
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
		//echo "<pre>";print_r($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));exit();

		$this->load->model('sales_model');
		
    	if($amount=='' || $amount==0){$amount=null;}


		if($amount>0 && !empty($payment_type)){
			$bulk_payment = $amount;
			//Get Opening Balance
			$q2=$this->db->query("select * from db_gateways where id=$gateway_id");
			$res2=$q2->row();
			$gateway_opening_balance=$res2->opening_balance;
	    	$gateway_sales_due=$res2->sales_due;

	    	$sum_of_ob_paid = $this->db->query("select coalesce(sum(payment),0) sum_of_ob_paid from db_salespayments where gateway_id=$gateway_id and short_code='OPENING BALANCE PAID'")->row()->sum_of_ob_paid; 
	    	$gateway_opening_balance_due = $gateway_opening_balance - $sum_of_ob_paid;

	    	$payment_code =  get_init_code('sales_payment');
		    $count_id	  = get_count_id('db_salespayments');

	    	while($amount>0) {

	    		
	    		//Adjust Opening Balance
	    		if($amount<=$gateway_opening_balance_due && $gateway_opening_balance_due>0){
	    			$row_data = array(	
	    								'payment_code' 		=> $payment_code,
		    							'count_id' 			=> $count_id,
	    								'store_id' 			=> get_gateway_store_id($gateway_id),
	    								'gateway_id' 		=> $gateway_id,
	    							  	'payment_date'		=> system_fromatted_date($payment_date),
										'payment_type' 		=> $payment_type,
										'payment' 			=> $amount,
										'payment_note' 		=> $payment_note,
										'created_date' 		=> $CUR_DATE,
					    				'created_time' 		=> $CUR_TIME,
					    				'created_by' 		=> $CUR_USERNAME,
					    				'system_ip' 		=> $SYSTEM_IP,
					    				'system_name' 		=> $SYSTEM_NAME,
					    				'status' 			=> 1,
					    				'short_code' 		=> 'OPENING BALANCE PAID',
					    				'account_id' 		=> (empty($account_id)) ? null : $account_id,
	    								 );
	    			//$row_data['store_id']=(store_module() && is_admin()) ? $store_id : get_current_store_id();  
	    			//$q3 = $this->db->insert('db_cobpayments', $row_data);
	    			$q3 = $this->db->insert('db_salespayments', $row_data);

	    			$credit_amt = $amount;
	    			//Set the payment to specified account
					if(!empty($account_id)){
						//ACCOUNT INSERT
						$insert_bit = insert_account_transaction(array(
																	'transaction_type'  	=> 'OPENING BALANCE PAID',
																	'reference_table_id'  	=> $this->db->insert_id(),
																	'debit_account_id'  	=> null,
																	'credit_account_id'  	=> $account_id,
																	'debit_amt'  			=> 0,
																	'credit_amt'  			=> $credit_amt,
																	'process'  				=> 'SAVE',
																	'note'  				=> $payment_note,
																	'transaction_date'  	=> $CUR_DATE,
																	'payment_code'  		=> $payment_code,
																	'gateway_id'  			=> $gateway_id,
																	'supplier_id'  			=> '',
															));
						if(!$insert_bit){
							return "failed";
						}
					}
	    			$amount=0;
	    		}
	    		if($amount>=$gateway_opening_balance_due && $gateway_opening_balance_due){
	    			$row_data = array(	
	    								'payment_code' 		=> $payment_code,
		    							'count_id' 			=> $count_id,
	    								'store_id' 			=> get_gateway_store_id($gateway_id),
	    								'gateway_id' 		=> $gateway_id,
	    							  	'payment_date'		=> system_fromatted_date($payment_date),
										'payment_type' 		=> $payment_type,
										'payment' 			=> $gateway_opening_balance_due,
										'payment_note' 		=> $payment_note,
										'created_date' 		=> $CUR_DATE,
					    				'created_time' 		=> $CUR_TIME,
					    				'created_by' 		=> $CUR_USERNAME,
					    				'system_ip' 		=> $SYSTEM_IP,
					    				'system_name' 		=> $SYSTEM_NAME,
					    				'status' 			=> 1,
					    				'short_code' 		=> 'OPENING BALANCE PAID',
					    				'account_id' 		=> (empty($account_id)) ? null : $account_id,
	    								 );
	    			//$row_data['store_id']=(store_module() && is_admin()) ? $store_id : get_current_store_id();  
	    			$row_data['store_id']= get_current_store_id();  
	    			//$q3 = $this->db->insert('db_cobpayments', $row_data);
	    			$q3 = $this->db->insert('db_salespayments', $row_data);

	    			$credit_amt = $gateway_opening_balance_due;
	    			//Set the payment to specified account
	    			if(!empty($account_id)){
						//ACCOUNT INSERT
						$insert_bit = insert_account_transaction(array(
																	'transaction_type'  	=> 'OPENING BALANCE PAID',
																	'reference_table_id'  	=> $this->db->insert_id(),
																	'debit_account_id'  	=> null,
																	'credit_account_id'  	=> $account_id,
																	'debit_amt'  			=> 0,
																	'credit_amt'  			=> $credit_amt,
																	'process'  				=> 'SAVE',
																	'note'  				=> $payment_note,
																	'transaction_date'  	=> $CUR_DATE,
																	'payment_code'  		=> $payment_code,
																	'gateway_id'  			=> $gateway_id,
																	'supplier_id'  			=> '',
															));
						if(!$insert_bit){
							return "failed";
						}
					}
					//end

	    			$amount-=$gateway_opening_balance_due;
	    		}

	    		//Set Sales Payments
	    		if($amount<=$gateway_sales_due){
	    			$qs4=$this->db->query("select id,grand_total,paid_amount,coalesce(grand_total-paid_amount,0) as sales_due from db_sales where grand_total!=paid_amount and gateway_id=".$gateway_id);
	    			foreach ($qs4->result() as $res) {
	    				$grand_total = $res->grand_total;
	    				$paid_amount = $res->paid_amount;
	    				$sales_due = $res->sales_due;
	    				$sales_id = $res->id;
	    				if($amount<=$sales_due && $sales_due>0){
	    					$salespayments_entry = array(
	    						'payment_code' 		=> $payment_code,
		    					'count_id' 			=> $count_id,
		    					'store_id' 			=> get_gateway_store_id($gateway_id),
	    						'gateway_id' 		=> $gateway_id,
								'sales_id' 			=> $sales_id, 
								'payment_date'		=> system_fromatted_date($payment_date),//Current Payment with sales entry
								'payment_type' 		=> $payment_type,
								'payment' 			=> $amount,
								'payment_note' 		=> $payment_note,
								'created_date' 		=> $CUR_DATE,
			    				'created_time' 		=> $CUR_TIME,
			    				'created_by' 		=> $CUR_USERNAME,
			    				'system_ip' 		=> $SYSTEM_IP,
			    				'system_name' 		=> $SYSTEM_NAME,
			    				'status' 			=> 1,
			    				'account_id' 		=> (empty($account_id)) ? null : $account_id,
							);
						   $credit_amt = $amount;
						   $amount=0;
	    				}
	    			    if($amount>=$sales_due && $sales_due>0){
	    					$salespayments_entry = array(
	    						'payment_code' 		=> $payment_code,
		    					'count_id' 			=> $count_id,
		    					'store_id' 			=> get_gateway_store_id($gateway_id),
	    						'gateway_id' 		=> $gateway_id,
								'sales_id' 			=> $sales_id, 
								'payment_date'		=> system_fromatted_date($payment_date),//Current Payment with sales entry
								'payment_type' 		=> $payment_type,
								'payment' 			=> $sales_due,
								'payment_note' 		=> $payment_note,
								'created_date' 		=> $CUR_DATE,
			    				'created_time' 		=> $CUR_TIME,
			    				'created_by' 		=> $CUR_USERNAME,
			    				'system_ip' 		=> $SYSTEM_IP,
			    				'system_name' 		=> $SYSTEM_NAME,
			    				'status' 			=> 1,
			    				'account_id' 		=> (empty($account_id)) ? null : $account_id,
							);
							$credit_amt = $sales_due;
						   $amount-=$sales_due;
	    				}

	    				$q3 = $this->db->insert('db_salespayments', $salespayments_entry);

	    				//Set the payment to specified account
	    				if(!empty($account_id)){
							//ACCOUNT INSERT
							$insert_bit = insert_account_transaction(array(
																		'transaction_type'  	=> 'SALES PAYMENT',
																		'reference_table_id'  	=> $this->db->insert_id(),
																		'debit_account_id'  	=> null,
																		'credit_account_id'  	=> $account_id,
																		'debit_amt'  			=> 0,
																		'credit_amt'  			=> $credit_amt,
																		'process'  				=> 'SAVE',
																		'note'  				=> $payment_note,
																		'transaction_date'  	=> $CUR_DATE,
																		'payment_code'  		=> $payment_code,
																		'gateway_id'  			=> $gateway_id,
																		'supplier_id'  			=> '',
																));
							if(!$insert_bit){
								return "failed";
							}
						}
						//end
						
	    				
	    				$q10=$this->sales_model->update_sales_payment_status($sales_id);
						if($q10!=1){
							return "failed";
						}
	    			}
					
	    		}
	    		
	    		
	    		/*$bulkpayments_entry = array(
	    						'gateway_id' 		=> $gateway_id,
								'payment_date'		=> system_fromatted_date($payment_date),//Current Payment with sales entry
								'payment_type' 		=> $payment_type,
								'payment' 			=> $bulk_payment,
								'payment_note' 		=> $payment_note,
								'created_date' 		=> $CUR_DATE,
			    				'created_time' 		=> $CUR_TIME,
			    				'created_by' 		=> $CUR_USERNAME,
			    				'system_ip' 		=> $SYSTEM_IP,
			    				'system_name' 		=> $SYSTEM_NAME,
			    				'store_id' 			=> get_current_store_id(),
			    				'payment_of'		=> "Sales",
							);

	    		$q33 = $this->db->insert('db_custbulkpayments', $bulkpayments_entry);
				if(!$q33){
					return "failed";
				}*/





	    	}//amount>0
				
			
		}
		else{
			return "Please Enter Valid Amount!";
		}
		
		$this->db->trans_commit();
		return "success";

	}

	public function show_pay_return_due_modal($gateway_id){

		$CI =& get_instance();
		$sales_id='';
		
		$q2=$this->db->query("select * from db_gateways where id=$gateway_id");
		$res2=$q2->row();

		$gateway_name=$res2->gateway_name;
	    $gateway_mobile=$res2->mobile;
	    $gateway_phone=$res2->phone;
	    $gateway_email=$res2->email;
	    $gateway_country=$res2->country_id;
	    $gateway_state=$res2->state_id;
	    $gateway_address=$res2->address;
	    $gateway_postcode=$res2->postcode;
	    $gateway_gst_no=$res2->gstin;
	    $gateway_tax_number=$res2->tax_number;
	    //$gateway_opening_balance=$res2->opening_balance;
	    $gateway_sales_return_due=$res2->sales_return_due;

	    $sales_date='';//$res1->sales_date;
	    $reference_no='';//$res1->reference_no;
	    $sales_code='';//$res1->sales_code;
	    $sales_note='';//$res1->sales_note;
	    $grand_total=0;//$res1->grand_total;
	    $paid_amount=0;//$res1->paid_amount;
	    //$due_amount =0;//$grand_total - $paid_amount;

	    if(!empty($gateway_country)){
	      $gateway_country = $this->db->query("select country from db_country where id='$gateway_country'")->row()->country;  
	    }
	    if(!empty($gateway_state)){
	      $gateway_state = $this->db->query("select state from db_states where id='$gateway_state'")->row()->state;  
	    }
	    //$sum_of_ob_paid = $this->db->query("select coalesce(sum(payment),0) sum_of_ob_paid from db_cobpayments where gateway_id=$gateway_id")->row()->sum_of_ob_paid; 
	    //$gateway_opening_balance_due = $gateway_opening_balance - $sum_of_ob_paid;

	    $q6 = $this->db->query("select coalesce(sum(grand_total),0) as total_sales_amount,coalesce(sum(paid_amount),0) as total_paid_amount from db_salesreturn where gateway_id=$gateway_id"); 
	    $total_sales_amount = $q6->row()->total_sales_amount;
	    $total_paid_amount = $q6->row()->total_paid_amount;
	    //$total_sales_due_amount =$total_sales_amount - $total_paid_amount;
	    $due_amount = number_format($total_sales_amount - $total_paid_amount,2,'.','') ;
		?>
		<div class="modal fade" id="pay_return_due">
		  <div class="modal-dialog ">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center">Pay Sales Return Due Payments</h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-12 invoice-col">
			          <i><?= $this->lang->line('gateway_details'); ?></i>
			          <address>
			            <strong><?php echo  $gateway_name; ?></strong><br>
			            <?php echo (!empty(trim($gateway_mobile))) ? $this->lang->line('mobile').": ".$gateway_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_phone))) ? $this->lang->line('phone').": ".$gateway_phone."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_email))) ? $this->lang->line('email').": ".$gateway_email."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_gst_no))) ? $this->lang->line('gst_number').": ".$gateway_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_tax_number))) ? $this->lang->line('tax_number').": ".$gateway_tax_number."<br>" : '';?>
			            
			          </address>
			        </div>
			        <!-- /.col -->
			        <div class="col-sm-12 invoice-col">

			        	<table class="table table-sm table-bordered bg-info" width="100%">
			        		<tr>
			        			<td class="text-right"><?= $this->lang->line('total_sales_amount'); ?></td>
			        			<td class="text-right"><?= $CI->currency($total_sales_amount); ?></td>
			        		</tr>
			        		<tr>
			        			<td class="text-right"><?= $this->lang->line('paid_amount'); ?></td>
			        			<td class="text-right"><?= $CI->currency($total_paid_amount); ?></td>
			        		</tr>
			        		<tr>
			        			<td class="text-right"><?= $this->lang->line('sales_due'); ?></td>
			        			<td class="text-right"><?= $CI->currency($gateway_sales_return_due); ?></td>
			        		</tr>
			        	</table>
			         
			        </div>
			        <!-- /.col -->
			      </div>
			      <!-- /.row -->
		      </div>
		      <div class="col-md-12">
		        <div>
		        <input type="hidden" name="payment_row_count" id='payment_row_count' value="1">
		        <div class="col-md-12  payments_div">
		          <div class="box box-solid bg-gray">
		            <div class="box-body">
		              <div class="row">
		         		<div class="col-md-6">
		                  <div class="">
		                  <label for="payment_date"><?= $this->lang->line('date'); ?></label>
		                    <div class="input-group date">
			                      <div class="input-group-addon">
			                      <i class="fa fa-calendar"></i>
			                      </div>
			                      <input type="text" class="form-control pull-right datepicker" value="<?= show_date(date("d-m-Y")); ?>" id="return_due_payment_date" name="return_due_payment_date" readonly>
			                    </div>
		                      <span id="return_due_payment_date_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-6">
		                  <div class="">
		                  <label for="amount"><?= $this->lang->line('amount'); ?></label>
		                    <input type="text" class="form-control text-right return_due_paid_amt" data-due-amt='<?=$due_amount;?>' id="return_due_amount" name="return_due_amount" placeholder="" value="<?=$due_amount;?>" >
		                      <span id="return_due_amount_msg" style="display:none" class="text-danger"></span>
		                </div>
		               </div>
		                <div class="col-md-6">
		                  <div class="">
		                    <label for="payment_type"><?= $this->lang->line('payment_type'); ?></label>
		                    <select class="form-control" id='return_due_payment_type' name="return_due_payment_type">
		                      <?php
		                        $q1=$this->db->query("select * from db_paymenttypes where status=1 and store_id=".get_current_store_id());
		                         if($q1->num_rows()>0){
		                             foreach($q1->result() as $res1){
		                             echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
		                           }
		                         }
		                         else{
		                            echo "No Records Found";
		                         }
		                        ?>
		                    </select>
		                    <span id="return_due_payment_type_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		                <div class="col-md-6">
		                  <div class="">
		                    <label for="account_id"><?= $this->lang->line('account'); ?></label>
		                    <select class="form-control" id='account_id' name="account_id">
		                      <?php
                                echo '<option value="">-None-</option>'; 
                                echo get_accounts_select_list();
                                ?>
		                    </select>
		                    <span id="account_id_msg" style="display:none" class="text-danger"></span>
		                  </div>
		                </div>
		            <div class="clearfix"></div>
		        </div>  
		        <div class="row">
		               <div class="col-md-12">
		                  <div class="">
		                    <label for="payment_note"><?= $this->lang->line('payment_note'); ?></label>
		                    <textarea type="text" class="form-control" id="return_due_payment_note" name="return_due_payment_note" placeholder="" ></textarea>
		                    <span id="return_due_payment_note_msg" style="display:none" class="text-danger"></span>
		                  </div>
		               </div>
		                
		            <div class="clearfix"></div>
		        </div>   
		        </div>
		        </div>
		      </div><!-- col-md-12 -->
		    </div>
		      </div><!-- col-md-9 -->
		      <!-- RIGHT HAND -->
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
		        <button type="button" onclick="save_return_due_payment(<?=$gateway_id;?>)" class="btn bg-green btn-lg place_order btn-lg return_due_payment_save">Save<i class="fa  fa-check "></i></button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<?php
	}
	public function save_return_due_payment(){
		$this->db->trans_begin();
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
		//echo "<pre>";print_r($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));exit();

		$this->load->model('sales_return_model');
		
    	if($amount=='' || $amount==0){$amount=null;}


		if($amount>0 && !empty($payment_type)){

			$q2=$this->db->query("select * from db_gateways where id=$gateway_id");
			$res2=$q2->row();
	    	$gateway_sales_return_due=$res2->sales_return_due;

	    	$payment_code =  get_init_code('sales_return_payment');
		    $count_id	  = get_count_id('db_salespaymentsreturn');

	    	while($amount>0) {

	    		//Set Sales Payments
	    		if($amount<=$gateway_sales_return_due){
	    			$qs4=$this->db->query("select id,grand_total,paid_amount,coalesce(grand_total-paid_amount,0) as sales_due from db_salesreturn where grand_total!=paid_amount and gateway_id=".$gateway_id);
	    			foreach ($qs4->result() as $res) {
	    				$grand_total = $res->grand_total;
	    				$paid_amount = $res->paid_amount;
	    				$sales_due = $res->sales_due;
	    				$return_id = $res->id;
	    				if($amount<=$sales_due && $sales_due>0){
	    					$salespayments_entry = array(
	    						'payment_code'      => $payment_code,
                            	'count_id'          => $count_id,       
								'return_id' 		=> $return_id, 
								'payment_date'		=> system_fromatted_date($payment_date),//Current Payment with sales entry
								'payment_type' 		=> $payment_type,
								'payment' 			=> $amount,
								'payment_note' 		=> $payment_note,
								'created_date' 		=> $CUR_DATE,
			    				'created_time' 		=> $CUR_TIME,
			    				'created_by' 		=> $CUR_USERNAME,
			    				'system_ip' 		=> $SYSTEM_IP,
			    				'system_name' 		=> $SYSTEM_NAME,
			    				'status' 			=> 1,
			    				'gateway_id' 		=> $gateway_id,
                      			'account_id'    	=> (empty($account_id)) ? null : $account_id,
							);
							$debit_amt = $amount;
						   $amount=0;
	    				}
	    			    if($amount>=$sales_due && $sales_due>0){
	    					$salespayments_entry = array(
	    						'payment_code'      => $payment_code,
                            	'count_id'          => $count_id,     
								'return_id' 		=> $return_id, 
								'payment_date'		=> system_fromatted_date($payment_date),//Current Payment with sales entry
								'payment_type' 		=> $payment_type,
								'payment' 			=> $sales_due,
								'payment_note' 		=> $payment_note,
								'created_date' 		=> $CUR_DATE,
			    				'created_time' 		=> $CUR_TIME,
			    				'created_by' 		=> $CUR_USERNAME,
			    				'system_ip' 		=> $SYSTEM_IP,
			    				'system_name' 		=> $SYSTEM_NAME,
			    				'status' 			=> 1,
			    				'gateway_id' 		=> $gateway_id,
			    				'account_id'    	=> (empty($account_id)) ? null : $account_id,
							);
							$debit_amt = $sales_due;
						   $amount-=$sales_due;
	    				}

	    				$salespayments_entry['store_id'] = get_current_store_id();
	    				$q3 = $this->db->insert('db_salespaymentsreturn', $salespayments_entry);

	    				//Set the payment to specified account
	    				if(!empty($account_id)){
							//ACCOUNT INSERT
							$insert_bit = insert_account_transaction(array(
																		'transaction_type'  	=> 'SALES PAYMENT RETURN',
																		'reference_table_id'  	=> $this->db->insert_id(),
																		'debit_account_id'  	=> $account_id,
																		'credit_account_id'  	=> null,
																		'debit_amt'  			=> $debit_amt,
																		'credit_amt'  			=> 0,
																		'process'  				=> 'SAVE',
																		'note'  				=> $payment_note,
																		'transaction_date'  	=> $CUR_DATE,
																		'payment_code'  		=> $payment_code,
																		'gateway_id'  			=> $gateway_id,
																		'supplier_id'  			=> '',
																));
							if(!$insert_bit){
								return "failed";
							}
						}
						//end
			             
		              
	    				$q10=$this->sales_return_model->update_sales_payment_status($return_id);
						if($q10!=1){
							return "failed";
						}

						if($amount==0){break;}

	    			}//foreach
					
	    		}
	    		

	    	}
				
			
		}
		else{
			return "Please Enter Valid Amount!";
		}
		
		$this->db->trans_commit();
		return "success";

	}

	public function delete_opening_balance_entry($entry_id){
		$gateway_id = $this->input->post('gateway_id');
        $this->db->trans_begin();
		$q1=$this->db->query("delete from db_salespayments where id=$entry_id and short_code='OPENING BALANCE PAID'");
		if(!$q1){
			return "failed";
		}
		$this->session->set_flashdata('success', 'Success!! Opening Balance Entry Deleted!');
		$this->db->trans_commit();
		return "success";
	}

	/*27-06-2020*/
	public function view_payment_list_modal($gateway_id){

		$res2=$this->db->query("select * from db_gateways where id=$gateway_id")->row();

		$gateway_name=$res2->gateway_name;
	    $gateway_mobile=$res2->mobile;
	    $gateway_phone=$res2->phone;
	    $gateway_email=$res2->email;
	    $gateway_country=$res2->country_id;
	    $gateway_state=$res2->state_id;
	    $gateway_address=$res2->address;
	    $gateway_postcode=$res2->postcode;
	    $gateway_gst_no=$res2->gstin;
	    $gateway_tax_number=$res2->tax_number;
	    $gateway_opening_balance=$res2->opening_balance;


	    if(!empty($gateway_country)){
	      $gateway_country = $this->db->query("select country from db_country where id='$gateway_country'")->row()->country;  
	    }
	    if(!empty($gateway_state)){
	      $gateway_state = $this->db->query("select state from db_states where id='$gateway_state'")->row()->state;  
	    }

	    $q6 = $this->db->query("select coalesce(sum(grand_total),0) as total_sales_amount,coalesce(sum(paid_amount),0) as total_paid_amount from db_salesreturn where gateway_id=$gateway_id"); 
	    $total_sales_amount = $q6->row()->total_sales_amount;
	    $total_paid_amount = $q6->row()->total_paid_amount;
	    //$total_sales_due_amount =$total_sales_amount - $total_paid_amount;
	    $due_amount = number_format($total_sales_amount - $total_paid_amount,2,'.','') ;

		?>
		<div class="modal fade" id="view_payments_modal">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header header-custom">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center"><?= $this->lang->line('payments'); ?></h4>
		      </div>
		      <div class="modal-body">
		        
		    <div class="row">
		      <div class="col-md-12">
		      	<div class="row invoice-info">
			        <div class="col-sm-6 invoice-col">
			          <?= $this->lang->line('gateway_details'); ?>
			          <address>
			            <strong><?php echo  $gateway_name; ?></strong><br>
			            <?php echo (!empty(trim($gateway_mobile))) ? $this->lang->line('mobile').": ".$gateway_mobile."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_phone))) ? $this->lang->line('phone').": ".$gateway_phone."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_email))) ? $this->lang->line('email').": ".$gateway_email."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_gst_no))) ? $this->lang->line('gst_number').": ".$gateway_gst_no."<br>" : '';?>
			            <?php echo (!empty(trim($gateway_tax_number))) ? $this->lang->line('tax_number').": ".$gateway_tax_number."<br>" : '';?>
			          </address>
			        </div>
			        <!-- /.col -->
			        <!-- /.col -->
			        <div class="col-sm-6 invoice-col">
			          <b><?= $this->lang->line('due_amount'); ?> :<span id='due_amount_temp'><?php echo number_format($due_amount,2,'.',''); ?></span></b><br>
			         
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
                                    <th><?= $this->lang->line('payment_number'); ?></th>
                                    <th><?= $this->lang->line('payment_date'); ?></th>
                                    <th><?= $this->lang->line('payment'); ?></th>
                                    <th><?= $this->lang->line('account'); ?></th>
                                    <th><?= $this->lang->line('payment_type'); ?></th>
                                    <th><?= $this->lang->line('payment_note'); ?></th>
                                    <th><?= $this->lang->line('created_by'); ?></th>
                                    <th><?= $this->lang->line('action'); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	
                                	$q1=$this->db->query("select * from db_salespayments where gateway_id=$gateway_id");
									$i=1;
									$str = '';
									if($q1->num_rows()>0){
										foreach ($q1->result() as $res1) {
											echo "<tr>";
											echo "<td>".$i++."</td>";
											echo "<td>".$res1->payment_code."</td>";
											echo "<td>".show_date($res1->payment_date)."</td>";
											echo "<td>".$res1->payment."</td>";
											echo "<td><a title='Click to check account' data-toggle='tooltip' href=".base_url('accounts/book/').$res1->account_id.">".get_account_name($res1->account_id)."</td>";
											echo "<td>".$res1->payment_type."</td>";
											echo "<td>".$res1->payment_note."</td>";
											echo "<td>".ucfirst($res1->created_by)."</td>";
										
											echo "<td>
											<a onclick='show_receipt(".$res1->id.")' title='Print Payment Receipt' class='pointer btn  btn-default' ><i class='fa fa-print'></i></a>
											</i>
											</td>";	
											echo "</tr>";
										}
									}
									else{
										echo "<tr><td colspan='9' class='text-danger text-center'>No Records Found</td></tr>";
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
	/*end*/
}
