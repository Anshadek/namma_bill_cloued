<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_coupon extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load_global();
		$this->load->model('discount_coupon_model', 'discount_coupon');
	}

	public function add() {
		$this->permission_check('discountCouponAdd');
		$data = $this->data;
		$data['page_title'] = $this->lang->line('discountCoupon');
		$this->load->view('coupons/create', $data);
	}
	
	public function save() {
		$this->form_validation->set_rules('coupon_name', 'Coupon Name', 'trim|required');
		//$this->form_validation->set_rules('code', 'Coupon Code', 'trim|required');
		$this->form_validation->set_rules('expire_date', 'Expire Date', 'trim|required');
		$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'trim|required');
		$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result = $this->discount_coupon->save_record();
			echo $result;
		} else {
			echo validation_errors();
		}
	}
	public function update($id) {
		$this->belong_to('db_coupons', $id);
		$this->permission_check('discountCouponEdit');
		$data = $this->data;

		$this->load->model('discount_coupon_model');
		$result = $this->discount_coupon_model->get_details($id, $data);
		$data = array_merge($data, $result);
		$data['page_title'] = $this->lang->line('discountCoupon');
		$this->load->view('coupons/create', $data);
	}
	public function update_discount_coupon() {
		$this->form_validation->set_rules('discount_coupon', 'discount_coupon', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$this->load->model('discount_coupon_model');
			$result = $this->discount_coupon_model->update_discount_coupon();
			echo $result;
		} else {
			echo "Please Enter Coupon name.";
		}
	}
	public function view() {
		$this->permission_check('discountCouponView');
		$data = $this->data;
		$data['page_title'] = $this->lang->line('discountCoupons');
		$this->load->view('coupons/list', $data);
	}

	public function ajax_list() {
		$list = $this->discount_coupon->get_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $discount_coupon) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value=' . $discount_coupon->id . ' class="checkbox column_checkbox" >';
			$row[] = $discount_coupon->name;
			//$row[] = $discount_coupon->code;
			$row[] = show_date($discount_coupon->expire_date);
			$row[] = store_number_format($discount_coupon->value);
			$row[] = $discount_coupon->type;
			

			if ($discount_coupon->status == 1) {
				$str = "<span onclick='update_status(" . $discount_coupon->id . ",0)' id='span_" . $discount_coupon->id . "'  class='label label-success' style='cursor:pointer'>Active </span>";} else {
				$str = "<span onclick='update_status(" . $discount_coupon->id . ",1)' id='span_" . $discount_coupon->id . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
			}
			$row[] = $str;
			$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

			if ($this->permissions('discountCouponEdit')) {
				$str2 .= '<li>
												<a title="Edit Record ?" href="' . base_url() . 'discount_coupon/update/' . $discount_coupon->id . '">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';
			}

			if ($this->permissions('discountCouponDelete')) {
				$str2 .= '<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_coupon(' . $discount_coupon->id . ')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>

										</ul>
									</div>';
			}

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->discount_coupon->count_all(),
			"recordsFiltered" => $this->discount_coupon->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function update_status() {
		$this->permission_check_with_msg('discountCouponEdit');
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$this->load->model('discount_coupon_model');
		$result = $this->discount_coupon_model->update_status($id, $status);
		return $result;
	}

	public function delete_coupon() {
		$this->permission_check_with_msg('discountCouponDelete');
		$id = $this->input->post('q_id');
		return $this->discount_coupon->delete_coupons($id);
	}
	public function multi_delete() {
		$this->permission_check_with_msg('discountCouponDelete');
		$ids = implode(",", $_POST['checkbox']);
		return $this->discount_coupon->delete_coupons($ids);
	}

}
