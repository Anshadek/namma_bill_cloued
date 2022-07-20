<?php defined('BASEPATH') OR exit('No direct script access allowed');

    

class Stripe extends CI_Controller {

     

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function __construct() {

       parent::__construct();

       $this->load->library("session");

       $this->load->helper('url');

    }

     

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index()

    {

        $this->load->view('paypal_test/stripe');

    }

        

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function payment()

    {

      require_once('application/libraries/stripe/init.php');

     

      $stripeSecret = 'sk_test_51GaDAnB5TcGYIInBQ0lO3ucMUze485kGRTBghAn8ordblplJrUy3a439LRqkLICpxAh3U0Id6Ua28c2r2Dg2Gt0a00RekNi3LH';

 

      \Stripe\Stripe::setApiKey($stripeSecret);

      

        $stripe = \Stripe\Charge::create ([

                "amount" => $this->input->post('amount'),

                "currency" => "usd",

                "source" => $this->input->post('tokenId'),

                "description" => "This is from nicesnippets.com"

        ]);

             

       // after successfull payment, you can store payment related information into your database

              

        $data = array('success' => true, 'data'=> $stripe);

 

        echo json_encode($data);

    }

}