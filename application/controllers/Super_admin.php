<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Super_admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load_global();
		$this->load->model('warehouse_model', 'warehouse');
		$this->load->model('store_profile_model', 'store');
	}
	public function dashboard()
	{

		//echo "<pre>";echo(  get_super_admin_bank_status_select_list());exit;
		$this->load->model('dashboard_model'); //Model
		$data = $this->data;
		if (is_admin()) {
			$data = array_merge($data, $this->dashboard_model->get_subscription_chart());
		}
		$data['page_title'] = $this->lang->line('dashboard');
		if (isset($_POST['store_id'])) {
			$data['store_id'] = $_POST['store_id'];
		}

		$this->load->view('super-admin-dashboard', $data);
	}

	public function stores()
	{
		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Warehouse List';
		$this->load->view('super_admin/store-list', $data);
	}

	public function add_store()
	{
		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Warehouse List';
		$this->load->view('super_admin/add-store', $data);
	}
	public function edit_store($id)
	{
		//print_r($id);
		//die();
		//$this->belong_to('db_warehouse',$id);

		$data = $this->warehouse->get_details($id);
		$data['page_title'] = 'Add/Edit Store';
		$this->load->view('super_admin/add-store', $data);
	}
	public function create_store()
	{

		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		//=======================================update section ===============================================
		if($q_id > 0){
			$result = $this->store->superadmin_update_store();
		} 
		//=======================================================================================
		if (!empty($mobile)) {
			$query = $this->db->query("select * from db_users where mobile='$mobile'")->num_rows();
			if ($query > 0) {

				echo 'This Moble Number already exist.';
				return 0;
				//redirect('super_admin/add_users');

			}
		}
		if (!empty($email)) {
			$query = $this->db->query("select * from db_users where email='$email'")->num_rows();
			if ($query > 0) {
				echo  "This Email ID already exist.";
				return 0;
				//redirect('super_admin/add_users');

			}
		}
		$result = $this->store->create_store();

		$this->session->set_flashdata('success', 'Succesfully Saved.');
		echo 'success';
		return 0;
	}
	public function warehouse_status_update()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$result = $this->warehouse->status_update($id, $status);
		return $result;
	}

	public function pay_status_update()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$result = $this->warehouse->pay_status_update($id, $status);
		return $result;
	}

	public function delete_store()
	{
		$id = $this->input->post('id');
		$store_id  = $this->db->select('store_id')
			->where('id', $id)
			->limit(1)
			->get('db_warehouse')
			->row();
			
		$result = $this->warehouse->delete_warehouse($id);
		if($result == 'success'){
			$q2=$this->db->query("delete from db_store where id=".$store_id);
			if($q2!=1)
			{
				echo "failed";
				return 0;
			}
			else{
				$this->db->trans_commit();
					echo "success";
					return 1;
			}
		}
		echo $result;
	}
}
