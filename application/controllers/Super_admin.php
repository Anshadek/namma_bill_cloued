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
		$pay_status = "";
		$status = "";
		$date = "";
		$data = $this->data; //My_Controller constructor data accessed here

		if ($this->input->post()) {
			$this->db->select('db_warehouse.*', 'profile_picture as prof');
			$this->db->from('db_warehouse');
			$pay_status = $this->input->post('filter_pay_status');
			$status = $this->input->post('filter_status');
			$date = $this->input->post('filter_date');
			
			if ($pay_status == 0 || $pay_status == 1) {
				$this->db->where('pay_status', $pay_status);
			}
			if ($status == 0 || $status == 1) {
				
				$this->db->where('status', $status);
			}
			if (!empty($date)) {
				
				$this->db->where('created_date', $date);
			}
			
			$res = $this->db->get();
			$data['warehouses'] = $res->result();
		} else {

			$q1 = $this->db->select("*")->where('warehouse_type', 'System')->get("db_warehouse");
			$data['warehouses'] = $q1->result();
		}
		$data['page_title'] = 'Warehouse List';
		$data['filter_pay_status'] = $pay_status;
		$data['filter_status'] = $status;
		$data['filter_date'] = $date;
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
		$data['page_title'] = 'Add/  Store';
		$this->load->view('super_admin/add-store', $data);
	}
	public function view_store($id)
	{
		//print_r($id);
		//die();
		//$this->belong_to('db_warehouse',$id);

		$data = $this->warehouse->get_details($id);
		$data['page_title'] = 'View Store';
		$this->load->view('super_admin/view-store', $data);
	}
	public function create_store()
	{

		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		//=======================================update section ===============================================
		if ($q_id > 0) {
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
		$this->form_validation->set_rules("store_name", "Store Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[db_users.email]'");
		$this->form_validation->set_rules("mobile", "Mobile", "required|regex_match[/^[0-9]{10}$/]");
		$this->form_validation->set_rules("pan_no", "Pan No", "trim|required");
		$this->form_validation->set_rules("state", "State", "trim|required");
		$this->form_validation->set_rules("country", "State", "trim|required");
		$this->form_validation->set_rules("city", "City", "trim|required");
		$this->form_validation->set_rules("postcode", "Postcode", "trim|required");
		if ($this->form_validation->run() == false) {
			echo validation_errors();
		} else {
			$result = $this->store->create_store();

			$this->session->set_flashdata('success', 'Succesfully Saved.');
			echo 'success';
			return 0;
		}
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
		if ($result == 'success') {
			$q2 = $this->db->query("delete from db_store where id=" . $store_id);
			if ($q2 != 1) {
				echo "failed";
				return 0;
			} else {
				//$this->db->trans_commit();
				echo "success";
				return 1;
			}
		}
		echo $result;
	}

	//trial pack category

	public function trial_pack_category()
	{

		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Trial pack Category List';
		$this->load->view('super_admin/trialpack-category-list', $data);
	}
	public function create_trial_pack_category()
	{
		//============update section =================
		if ($_POST['id'] > 0) {

			$res = $this->update_trial_pack_category($_POST);
			echo $res;
			return 0;
		}
		//=========================================
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));

		$query = $this->db->query("SELECT * FROM db_trialpack_category ORDER BY id DESC LIMIT 1");
		$result = $query->result_array();
		if (count($result) > 0) {
			$code = substr($result[0]['code'], -4);
			$l = max(strlen($code), 1);
			$next_code = str_pad($code + 1, $l, "0", STR_PAD_LEFT);
			$cat_code = 'TR' . $next_code;
		} else {
			$cat_code = 'TR0001';
		}

		$data = array(
			'code'				=> $cat_code,
			'name'				=> $name,
			'note'				=> $note,
			'status'			=> 1,
		);
		$q1 = $this->db->insert('db_trialpack_category', $data);
		if (!$q1) {
			echo "failed";
			return 0;
		} else {
			echo "success";
			return 1;
		}
	}
	public function update_trial_pack_category()
	{

		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		$data = array(
			'name'				=> $name,
			'note'				=> $note,
		);
		$q1 = $this->db
			->where('id', $id)
			->update('db_trialpack_category', $data);
		if (!$q1) {
			return "failed";
		} else {
			return "success";
		}
	}
	public function trial_pack_category_status_update()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$query1 = "update db_trialpack_category set status='$status' where id=$id";
		if ($this->db->simple_query($query1)) {
			echo "success";
		} else {
			echo "failed";
		}
	}

	public function delete_trial_pack_category()
	{
		$id = $this->input->post('id');
		$is_cat_exists = $this->db->query("select * from db_trialpackage where trial_pack_catid=" . $id);
		if ($is_cat_exists->num_rows() > 0) {
			echo "trialpcak is already exists on this category";
			return 0;
		}
		$q1 = $this->db->query("delete from db_trialpack_category where id=" . $id);
		if ($q1 != 1) {
			echo "failed";
			return 0;
		} else {
			//$this->db->trans_commit();
			echo "success";
			return 1;
		}
	}


	//trial package master 

	public function trial_package()
	{

		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Trial package List';
		$this->load->view('super_admin/trialpackage-list', $data);
	}
	public function create_trial_package()
	{
		//============update section =================
		if ($_POST['id'] > 0) {

			$res = $this->update_trial_package($_POST);
			echo $res;
			return 0;
		}
		//=========================================
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		$data = array(
			'trial_pack_catid'	=> $trial_pack_catid,
			'name'				=> $name,
			'day_or_month'		=> $day_or_month,
			'days'				=> $days,
			'status'			=> 1,
		);
		$q1 = $this->db->insert('db_trialpackage', $data);
		if (!$q1) {
			echo "failed";
			return 0;
		} else {
			echo "success";
			return 1;
		}
	}
	public function update_trial_package()
	{

		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		$data = array(
			'trial_pack_catid'	=> $trial_pack_catid,
			'name'				=> $name,
			'day_or_month'		=> $day_or_month,
			'days'				=> $days,

		);
		$q1 = $this->db
			->where('id', $id)
			->update('db_trialpackage', $data);
		if (!$q1) {
			return "failed";
		} else {
			return "success";
		}
	}
	public function trial_package_status_update()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if ($status == 0) {
			$is_primary = $this->db->query("select * from db_trialpackage where is_primary=1 and  id=" . $id);
			if ($is_primary->num_rows() > 0) {
				echo "This trialpack is primary can't inactive now";
				return 0;
			}
		}
		$query1 = "update db_trialpackage set status='$status' where id=$id";
		if ($this->db->simple_query($query1)) {
			echo "success";
		} else {
			echo "failed";
		}
	}

	public function delete_trial_package()
	{
		$id = $this->input->post('id');

		$is_primary = $this->db->query("select * from db_trialpackage where is_primary=1 and  id=" . $id);
		if ($is_primary->num_rows() > 0) {
			echo "This trialpack is primary can't delete now";
			return 0;
		}

		$q1 = $this->db->query("delete from db_trialpackage where id=" . $id);
		if ($q1 != 1) {
			echo "failed";
			return 0;
		} else {
			//$this->db->trans_commit();
			echo "success";
			return 1;
		}
	}
	public function trial_package_primary_status_update()
	{
		$id = $this->input->post('id');
		$cat_id = $this->input->post('cat_id');

		$is_inactive = $this->db->query("select * from db_trialpackage where status=0 and  id=" . $id);
		if ($is_inactive->num_rows() > 0) {
			echo "This trialpack is inactive now";
			return 0;
		}




		$query1 = "update db_trialpackage set is_primary=0";
		if ($this->db->simple_query($query1)) {
			$query1 = "update db_trialpackage set is_primary=1 where id=$id";
			if ($this->db->simple_query($query1)) {
				echo "success";
			} else {
				echo "failed";
			}
		} else {
			echo "failed";
		}
	}
	//==========subscription area==============
	public function subscription()
	{

		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Subscription List';
		$this->load->view('super_admin/subscription-list', $data);
	}
	public function create_subscription()
	{
		//============update section =================
		if ($_POST['id'] > 0) {

			$res = $this->update_subscription($_POST);
			echo $res;
			return 0;
		}
		//=========================================
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		$data = array(
			'name'	=> $name,
			'amount'	=> $amount,
			'validity'		=> $validity,
			'is_unlimited'	=> $is_unlimited,
			'user_count'	=> $user_count,
			'warehouse_count'	=> $warehouse_count,
			'status'			=> 1,
		);
		$q1 = $this->db->insert('db_package_subscription', $data);
		if (!$q1) {
			echo "failed";
			return 0;
		} else {
			echo "success";
			return 1;
		}
	}
	public function update_subscription()
	{

		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		if ($is_unlimited == 1) {
			$user_count = 0;
			$warehouse_count = 0;
		}
		$data = array(
			'name'	=> $name,
			'amount'	=> $amount,
			'validity'		=> $validity,
			'user_count'	=> $user_count,
			'is_unlimited'	=> $is_unlimited,
			'warehouse_count'	=> $warehouse_count,

		);
		$q1 = $this->db
			->where('id', $id)
			->update('db_package_subscription', $data);
		if (!$q1) {
			return "failed";
		} else {
			return "success";
		}
	}
	public function subscription_status_update()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$query1 = "update db_package_subscription set status='$status' where id=$id";
		if ($this->db->simple_query($query1)) {
			echo "success";
		} else {
			echo "failed";
		}
	}

	public function delete_subscription()
	{
		$id = $this->input->post('id');
		$validity = $this->input->post('validity');
		$end_date  =  date('Y-m-d');
		$start_date = date('Y-m-d', strtotime('-' . $validity . ' day'));

		$this->db->select();
		$this->db->from('db_store_purchased_packages');
		$this->db->where('package_id', $id);
		$this->db->where('type','subscription');
		$this->db->where('created_date >= date("' . $start_date . '")');
		$this->db->where('created_date <= date("' . $end_date . '")');
		if ($this->db->get()->num_rows() > 0) {
			echo "Subscription user still exists";
			return 0;
		}
		$q1 = $this->db->query("delete from db_package_subscription where id=" . $id);
		if ($q1 != 1) {
			echo "failed";
			return 0;
		} else {
			//$this->db->trans_commit();
			echo "success";
			return 1;
		}
	}
	public function store_subscription()
	{

		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Create Subscription List';
		$this->load->view('super_admin/store-subscription-list', $data);
	}
	public function assing_store_subscription()
	{


		//============update section =================
		if ($_POST['id'] > 0) {

			$res = $this->update_assign_store_subscription($_POST);
			echo $res;
			return 0;
		}
		//=========================================
		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));
		$data = array(
			'store_id'	=> 0,
			'warehouse_id'	=> $warehouse_id,
			'package_id'		=> $package_id,
			'created_date'	=> $date,
			'status'	=> $status,
			'created_by'	=> 'super_admin',
			'type'	=> 'subscription',

		);
		$q1 = $this->db->insert('db_store_purchased_packages', $data);
		if (!$q1) {
			echo "failed";
			return 0;
		} else {
			echo "success";
			return 1;
		}
	}

	public function update_assign_store_subscription()
	{


		extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST, $_GET))));

		$data = array(
			'store_id'	=> 0,
			'warehouse_id'	=> $warehouse_id,
			'package_id'		=> $package_id,
			'created_date'	=> $date,
			'status'	=> $status,
			'created_by'	=> 'super_admin',
			'type'	=> 'subscription',

		);
		$q1 = $this->db
			->where('id', $id)
			->update('db_store_purchased_packages', $data);

		if (!$q1) {
			return "failed";
		} else {
			return "success";
		}
	}

	public function delete_assign_store_subscription()
	{
		$id = $this->input->post('id');
		$q1 = $this->db->query("delete from db_store_purchased_packages where id=" . $id);
		if ($q1 != 1) {
			echo "failed";
			return 0;
		} else {
			//$this->db->trans_commit();
			echo "success";
			return 1;
		}
	}

	//==========reports============
	public function newly_created_pos_report()
	{
		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Warehouse List';
		$this->load->view('super_admin/newly-created-pos-list', $data);
	}
	public function expiring_pos_report()
	{
		$data = $this->data; //My_Controller constructor data accessed here
		$data['page_title'] = 'Warehouse List';
		$this->load->view('super_admin/expired-pos-list', $data);
	}
}
