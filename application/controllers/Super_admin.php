<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('warehouse_model','warehouse');
			$this->load->model('store_profile_model','store');
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
		$this->load->view('super_admin/store-list',$data);
	}
	public function add_users(){
		$data=$this->data;//My_Controller constructor data accessed here
		$data['page_title']='Warehouse List';
		$this->load->view('super_admin/add-store',$data);
	}
	public function create_store(){
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		if (!empty($mobile)) {
			$query = $this->db->query("select * from db_users where mobile='$mobile'")->num_rows();
			if ($query > 0) {
				$this->session->set_flashdata('danger','This Moble Number already exist.');
				redirect('super_admin/add_users');
				
			}
		}
		if (!empty($email)) {
			$query = $this->db->query("select * from db_users where email='$email'")->num_rows();
			if ($query > 0) {
				$this->session->set_flashdata('danger','This Email ID already exist.');
				redirect('super_admin/add_users');
				
			}
		}
		$result=$this->store->create_store();
		$this->session->set_flashdata('success', 'Succesfully Saved.');
		redirect('super_admin/users');

		
		}
		public function warehouse_status_update(){
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$result=$this->warehouse->status_update($id,$status);
			return $result;

		}

		public function pay_status_update(){
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$result=$this->warehouse->pay_status_update($id,$status);
			return $result;

		}

		
	
	


}
