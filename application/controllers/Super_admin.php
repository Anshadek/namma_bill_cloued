<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('warehouse_model','warehouse');
			$this->load->model('store_model','store');
	}
	public function dashboard()
	{	
		
		//echo "<pre>";echo(  get_super_admin_bank_status_select_list());exit;
		$this->load->model('dashboard_model');//Model
		$data=$this->data;
		if(is_admin()){
			$data = array_merge($data,$this->dashboard_model->get_subscription_chart());
		}
		$data['page_title']=$this->lang->line('dashboard');
		if(isset($_POST['store_id'])){
			$data['store_id'] =$_POST['store_id'];
		}
		
			$this->load->view('super-admin-dashboard',$data);
		
		
	}

	public function users(){
		$data=$this->data;//My_Controller constructor data accessed here
		$data['page_title']='Warehouse List';
		$this->load->view('super_admin/user-list',$data);
	}
	public function add_users(){
		$data=$this->data;//My_Controller constructor data accessed here
		$data['page_title']='Warehouse List';
		$this->load->view('super_admin/add-user',$data);
	}
	


}
