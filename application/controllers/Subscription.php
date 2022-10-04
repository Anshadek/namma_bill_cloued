<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
}

