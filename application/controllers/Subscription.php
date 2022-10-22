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

    //==================check downgrade or not ======================
    $q1 = $this->db->select("warehouse_count,user_count")
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
    if (!empty($q1) > 0 ){
      if ($q1->warehouse_count <= $q2->num_rows() || $q1->user_count <= $q3->num_rows() ){
        $this->session->set_flashdata('failed', "can't downgrade your package");
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
    $razorpayOrder = $api->order->create(array(
      'receipt'         => rand(),
      'amount'          =>$amount * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ));
    $amount = $razorpayOrder['amount'];
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $data = $this->prepareData($amount,$razorpayOrderId,$warehouse_id,$pacakage_id);

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






}

