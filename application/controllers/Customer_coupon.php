<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_coupon extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load_global();
		$this->load->model('customer_coupon_model', 'customer_coupon');
	}

	public function generate($customer_id='') {
		$this->permission_check('customerCouponAdd');
		$data = $this->data;
		$data['page_title'] = $this->lang->line('generatecustomerCoupon');
		$data['customer_id'] = $customer_id;
		$this->load->view('coupons/generate', $data);
	}


	public function save() {
		$this->form_validation->set_rules('coupon_id', 'Coupon Name', 'trim|required');
		$this->form_validation->set_rules('code', 'Coupon Code', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result = $this->customer_coupon->save_record();
			echo $result;
		} else {
			echo validation_errors();
		}
	}
	/*public function update($id) {
		$this->belong_to('db_coupons', $id);
		$this->permission_check('customerCouponEdit');
		$data = $this->data;

		$this->load->model('customer_coupon_model');
		$result = $this->customer_coupon_model->get_details($id, $data);
		$data = array_merge($data, $result);
		$data['page_title'] = $this->lang->line('customerCoupon');
		$this->load->view('coupons/create', $data);
	}*/
	/*public function update_customer_coupon() {
		$this->form_validation->set_rules('customer_coupon', 'customer_coupon', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$this->load->model('customer_coupon_model');
			$result = $this->customer_coupon_model->update_customer_coupon();
			echo $result;
		} else {
			echo "Please Enter Coupon name.";
		}
	}*/
	public function index() {
		$this->permission_check('customerCouponView');
		$data = $this->data;
		$data['page_title'] = $this->lang->line('customerCouponsList');
		$this->load->view('coupons/customer-coupons-list', $data);
	}

	public function ajax_list() {
		$list = $this->customer_coupon->get_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customer_coupon) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value=' . $customer_coupon->id . ' class="checkbox column_checkbox" >';
			$row[] = $customer_coupon->customer_name;
			$row[] = $customer_coupon->name;
			$row[] = $customer_coupon->code;
					$str='';
					if($customer_coupon->expire_date<date("Y-m-d")){ 
			 			$str = "<span class='label label-danger'>Expired</span>";
			 		}

			$row[] = show_date($customer_coupon->expire_date)."<br>".$str;
			$row[] = store_number_format($customer_coupon->value);
			$row[] = $customer_coupon->type;
			$row[] = $customer_coupon->description;
			

			if ($customer_coupon->status == 1) {
				$str = "<span onclick='update_status(" . $customer_coupon->id . ",0)' id='span_" . $customer_coupon->id . "'  class='label label-success' style='cursor:pointer'>Active </span>";} else {
				$str = "<span onclick='update_status(" . $customer_coupon->id . ",1)' id='span_" . $customer_coupon->id . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
			}
			$row[] = $str;

			$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';
											
											if($this->permissions('customerCouponView'))
											$str2.='<li>
												<a title="Take Print" target="_blank" href="customer_coupon/print/'.$customer_coupon->id.'">
													<i class="fa fa-fw fa-print text-blue"></i>Print
												</a>
											</li>
											';

											if($this->permissions('customerCouponDelete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_coupon(\''.$customer_coupon->id.'\')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>
											
										</ul>
									</div>';

			

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->customer_coupon->count_all(),
			"recordsFiltered" => $this->customer_coupon->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function update_status() {
		$this->permission_check_with_msg('customerCouponEdit');
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$this->load->model('customer_coupon_model');
		$result = $this->customer_coupon_model->update_status($id, $status);
		return $result;
	}

	public function delete_coupon() {
		$this->permission_check_with_msg('customerCouponDelete');
		$id = $this->input->post('q_id');
		return $this->customer_coupon->delete_coupons($id);
	}
	public function multi_delete() {
		$this->permission_check_with_msg('customerCouponDelete');
		$ids = implode(",", $_POST['checkbox']);
		return $this->customer_coupon->delete_coupons($ids);
	}
	function get_coupon_details(){
		$coupon_code = $this->input->post('coupon_code');
		$invoice_type = $this->input->post('invoice_type');
		$coupon_code = strtoupper($coupon_code);
		$customer_id = $this->input->post('customer_id');
		//Get coupon data
		$this->db->select("a.expire_date,a.value,a.type,b.name,a.customer_id");
		$this->db->where("upper(a.code) like '$coupon_code'");
		//$this->db->where("a.customer_id",$customer_id);
		$this->db->from("db_customer_coupons a");
		$this->db->join("db_coupons b","b.id=a.coupon_id");
		$q1 = $this->db->get();
		$data =array();
		if($q1->num_rows()>0){
			$row = $q1->row();

			
			//Verify Customer
			if($row->customer_id!=$customer_id){
				$expire_status = "Invalid";
				$message = "This coupon not belongs to this Customer!!";
				$coupon_value =$row->value; 
				$coupon_type =$row->type; 
				$occasion_name =$row->name; 
				$expire_date =$row->expire_date;
			}
			else if(($row->expire_date>=date('Y-m-d') && $invoice_type=='sales' ) || ($invoice_type=='return')){
				$expire_status = "Valid";
				$message = "Valid Coupon,Expired on ".show_date($row->expire_date)."";
				$coupon_value =$row->value; 
				$coupon_type =$row->type; 
				$occasion_name =$row->name; 
				$expire_date =$row->expire_date; 
			}else{
				$expire_status= "Expired";
				$message = "Coupon Expired on ".show_date($row->expire_date)."!";
				$coupon_value =0;
				$coupon_type =$row->type."(".$row->value.")"; 
				$occasion_name =$row->name;
				$expire_date =$row->expire_date; 
			}


			$data = array(
							'expire_date' =>$expire_date,
							'coupon_value' =>$coupon_value,
							'coupon_type' =>$coupon_type,
							'occasion_name' =>$occasion_name,
							'expire_status' => $expire_status,
							'message' => $message,
							);
		}
		else{
			$expire_status= "Invalid";
			$message = "Invalid Coupon Code!!";

			$data = array(
							'expire_date' =>'',
							'coupon_value' =>0,
							'coupon_type' =>'',
							'occasion_name' =>'',
							'expire_status' => $expire_status,
							'message' => $message,
							);
		}
		echo json_encode($data);
	}

	//Print Coupons 
	public function print($coupon_id)
	{
		$this->belong_to('db_customer_coupons',$coupon_id);
		if(!$this->permissions('customerCouponView')){
			$this->show_access_denied_page();
		}
		$data=$this->data;
		$data=array_merge($data,array('coupon_id'=>$coupon_id));
		$data['page_title']=$this->lang->line('discountCouponPrint');
		$this->load->view('coupons/print-coupon',$data);
	}

}
