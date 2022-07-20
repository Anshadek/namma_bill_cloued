<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skrill extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$parameters = [
		    'user_email' => 'askaralimkndr@gmail.com',
		    'secret_word' => 'secret word',
		    'merchant_id' => 'iamaskarali@gmail.com',
		    'mqi' => 'this is sample mqi'
		];

		$this->load->library('skrillapi', $parameters);

		echo "Hello";
	}

}

/* End of file Skrill.php */
/* Location: ./application/controllers/Skrill.php */