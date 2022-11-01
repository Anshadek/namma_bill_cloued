<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class Subscription extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		
	}

	public function index(){
		$data=array_merge($this->data);
		$data['page_title']=$this->lang->line('subscriptions');
		$this->load->view('subscriptions-list', $data);
	}
	
	public function your_subscription(){
		$this->permission_check('store_view');
		$data=array_merge($this->data);
		$data['page_title']=$this->lang->line('store_list');
		$this->load->view('your-subscriptions-list', $data);
	}
	public function purchase_package($data_arr){
		$data = array(
			'package_id'		=> $data_arr['package_id'],
			'coupon_id'		=> $data_arr['coupon_id'],
			'warehouse_id'		=> $data_arr['warehouse_id'],
			'razorpay_payment_id'		=> $data_arr['razorpay_payment_id'],
			'razorpay_signature'		=> $data_arr['razorpay_signature'],
			'created_date'		=>  date("Y/m/d"),
      'created_time' => date('H:i:s'),
			'created_by'		=> 'store',
			'status'			=> 'active',
			'type'			=> 'subscription',

		);
		$q1 = $this->db->insert('db_store_purchased_packages', $data);
		if (!$q1) {
			return "failed";
		} else {
			return "success";
		}
	}

	public function pay()
  {
    
		$amount = $this->input->post('amount');
		$pacakage_id = $this->input->post('id');
		$warehouse_id = $this->input->post('warehouse_id');
		$coupon_id = $this->input->post('coupon_id');

    //==================check downgrade or not ======================
    $q1 = $this->db->select("warehouse_count,user_count,is_unlimited")
    ->where('id',$pacakage_id)
		->get("db_package_subscription")->row();

    $q2 = $this->db->select("*")
    ->where('store_id',get_current_store_id())
    ->where('status',1)
		->get("db_users");

    $q3 = $this->db->select("*")
    ->where('store_id',get_current_store_id())
    ->where('status',1)
		->get("db_warehouse");
    if (!empty($q1) > 0 && $q1->is_unlimited == 0 ){
      if ( $q1->warehouse_count <= $q2->num_rows() || $q1->user_count <= $q3->num_rows() ){
        $this->session->set_flashdata('failed', "Your active warehouse is ".$q3->num_rows()." Please deactivate first then downgrade");
			  redirect(base_url().'subscription');
        return 0;
      }
    }
    //=====================================
    $api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);
    /**
     * You can calculate payment amount as per your logic
     * Always set the amount from backend for security reasons
     */
		$_SESSION['package_id'] = $pacakage_id;
		$_SESSION['warehouse_id'] = $warehouse_id;
    $_SESSION['payable_amount'] = $amount;
	$_SESSION['coupon_id'] = $coupon_id;
    $razorpayOrder = $api->order->create(array(
      'receipt'         => rand(),
      'amount'          =>$amount * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ));
    $amount = $razorpayOrder['amount'];
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $data = $this->prepareData($amount,$razorpayOrderId,$warehouse_id,$pacakage_id,$coupon_id);

    return $this->load->view('rezorpay',array('data' => $data));
	//die();
  }

  public function verify()
  {
    $success = true;
    $error = "payment_failed";
    if (empty($_POST['razorpay_payment_id']) === false) {
      $api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);
    try {
        $attributes = array(
          'razorpay_order_id' => $_SESSION['razorpay_order_id'],
          'razorpay_payment_id' => $_POST['razorpay_payment_id'],
          'razorpay_signature' => $_POST['razorpay_signature']
        );
        $api->utility->verifyPaymentSignature($attributes);
      } catch(SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay_Error : ' . $e->getMessage();
      }
    }
    if ($success === true) {
      /**
       * Call this function from where ever you want
       * to save save data before of after the payment
       */
     $data['razorpay_payment_id'] = $_POST['razorpay_payment_id'];
		 $data['razorpay_signature'] = $_POST['razorpay_signature'];
		 $data['warehouse_id'] = $_SESSION['warehouse_id'];
		 $data['package_id'] = $_SESSION['package_id'];
		 $data['coupon_id'] = $_SESSION['coupon_id'];
		 
		 $res = $this->purchase_package($data);
		 if($res == 'success'){
			$this->session->set_flashdata('success', 'your subscription has been successfully completed');
			redirect(base_url().'subscription/your_subscription');
		 }else{
			$this->session->set_flashdata('success', 'something went wrong');
			redirect(base_url().'subscription/your_subscription');
		 }
     
    }
    else {
			$this->session->set_flashdata('success', 'something went wrong');
			redirect(base_url().'subscription');
    }
  }

  public function prepareData($amount,$razorpayOrderId)
  {
    $data = array(
      "key" => RAZOR_KEY_ID,
      "amount" => $amount,
      "name" => "Coding Birds Online",
      "description" => "Learn To Code",
      "image" => "https://demo.codingbirdsonline.com/website/img/coding-birds-online/coding-birds-online-favicon.png",
      "prefill" => array(
        "name"  => $this->input->post('name'),
        "email"  => $this->input->post('email'),
        "contact" => $this->input->post('contact'),
      ),
      "notes"  => array(
        "address"  => "Hello World",
        "merchant_order_id" => rand(),
      ),
      "theme"  => array(
        "color"  => "#F37254"
      ),
      "order_id" => $razorpayOrderId,
    );
    return $data;
  }

	function get_coupon_details(){
		
		$coupon_code = $this->input->post('coupon_code');
		$package_amount = $this->input->post('package_amount');
		
		$coupon_code = strtoupper($coupon_code);
		
		$customer_id = $this->input->post('customer_id');
		//Get coupon data
		$this->db->select("a.expire_date,a.value,a.type,a.id");
		$this->db->where("upper(a.code) like '$coupon_code'");
		$this->db->where('b.is_admin',1);
		//$this->db->where("a.customer_id",$customer_id);
		$this->db->from("db_store_coupons a");
		$this->db->join("db_coupons b","b.id=a.coupon_id");
		$q1 = $this->db->get();
		
		$data =array();
		if($q1->num_rows()>0){
			$row = $q1->row();

			
			//Verify Customer
			// if($row->customer_id!=$customer_id){
			// 	$expire_status = "Invalid";
			// 	$message = "This coupon not belongs to this Customer!!";
			// 	$coupon_value =$row->value; 
			// 	$coupon_type =$row->type; 
			// 	$occasion_name =$row->name; 
			// 	$expire_date =$row->expire_date;
			// }
			if($row->expire_date>=date('Y-m-d')){
				if($row->type == 'Fixed'){
					$new_package_amount = $package_amount - $row->value;
				}else{
					$percentage = $row->value;
					$total = $package_amount;
					$percentage_amount = ($percentage / 100) * $total;
					$new_package_amount = $package_amount - $percentage_amount;
					

				}
				
				$expire_status = "Valid";
				$message = "Valid Coupon,Expired on ".show_date($row->expire_date)."";
				$coupon_value =$row->value; 
				$coupon_id =$row->id; 
				$coupon_type =$row->type; 
				$new_package_amount = $new_package_amount;
				$expire_date =$row->expire_date; 
			}else{   
				$expire_status= "Expired";
				$message = "Coupon Expired on ".show_date($row->expire_date)."!";
				$coupon_value =0;
				$coupon_id =0; 
				$new_package_amount = 0;
				$coupon_type =$row->type."(".$row->value.")"; 
				$expire_date =$row->expire_date; 
			}


			$data = array(
							'expire_date' =>$expire_date,
							'coupon_value' =>$coupon_value,
							'coupon_type' =>$coupon_type,
							'coupon_id'=>$coupon_id,
							'new_package_amount' => $new_package_amount,
							'expire_status' => $expire_status,
							'message' => $message,
							);
		}
		else{
			$expire_status= "Invalid";
			$message = "Invalid Coupon Code!!";
			$data = array(
							'expire_date' =>'',
							'coupon_value' =>0,
							'coupon_id' =>"",
							'coupon_type' =>'',
							'occasion_name' =>'',
							'new_package_amount' => '',
							'expire_status' => $expire_status,
							'message' => $message,
							);
		}
		echo json_encode($data);
	}





}

