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
	public function purchase_pacakage(){
		echo $this->pay();
		
		$pacakage_id = $this->input->post('id');
		$warehouse_id = $this->input->post('warehouse_id');

		$data = array(
			'package_id'		=> $pacakage_id,
			'warehouse_id'		=> $warehouse_id,
			'created_date'		=>  date("Y/m/d"),
			'created_by'		=> 'store',
			'status'			=> 'active',
			'type'			=> 'subscription',

				

		);
		$q1 = $this->db->insert('db_store_purchased_packages', $data);
		if (!$q1) {
			echo "failed";
		} else {
			echo "success";
		}
	}

	public function pay()
  {
	
    $api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);
    /**
     * You can calculate payment amount as per your logic
     * Always set the amount from backend for security reasons
     */
    $_SESSION['payable_amount'] = 10;
    $razorpayOrder = $api->order->create(array(
      'receipt'         => rand(),
      'amount'          =>10 * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ));
    $amount = $razorpayOrder['amount'];
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $data = $this->prepareData($amount,$razorpayOrderId);
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
      $this->setRegistrationData();
      redirect(base_url().'register/success');
    }
    else {
      redirect(base_url().'register/paymentFailed');
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

