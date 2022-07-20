<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('subscribers_model','subscription');
	}
	
	/*public function index()
	{
		$this->load->model('package_model');
		$this->permission_check('subscription');
		//$data=$this->data;
		$data=array_merge($this->data,$this->package_model->get_package_list());
		$data['page_title']=$this->lang->line('subscription');
		$this->load->view('subscription-list',$data);
	}*/
	/*public function save(){
		$this->form_validation->set_rules('package_id', 'Package Name', 'trim|required');
		$this->form_validation->set_rules('category', 'Package Category', 'trim|required');
		$this->form_validation->set_rules('package_count', 'Package Count', 'trim|required');
		$this->form_validation->set_rules('total', 'Total', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result = $this->save_record();
			echo $result;
		} else {
			echo validation_errors();
		}
	}*/

	/*public function save_record(){

		$data['payment_by'] = 'Manual';
        $data['payer_email'] = $user->emal;
        $data['store_id'] = $store_id
        
        $data['txn_id'] = '';//for PayPal
        $data['payment_id'] = ''; //for Instamojo

        $data['payment_gross'] = $total
        $data['currency_code'] = '';
        $data['payment_status'] = "success";

        $data['package_id'] = $package_id; 

	}*/
	public function list($store_id)
	{
		//$this->load->model('package_model');
		$this->permission_check('subscription');
		$data=$this->data;
		$store_details = get_store_details($store_id);
		$subscription_details = get_subscription_rec($store_details->current_subscriptionlist_id);
		$user_details=get_user_details($store_details->user_id);

		//$package_details = (isset($subscription_details->package_id)) ? get_package_details($subscription_details->package_id) : array();
		
		$data['store_details']=$store_details;
		$data['store_id']=$store_id;
		$data['subscription_details']=$subscription_details;
		//$data['package_details']=$this->package_model->get_package_list();

		$data['user_details']=$user_details;

		$data['page_title']=$this->lang->line('subscription_list');
		$this->load->view('superadmin-subscription-list',$data);
	}
	public function add($store_id='')
	{
		if(!is_admin()){
			echo "Restricted";
		}

		if(empty($store_id)){
			echo "Something went wrong";exit;
		}
		
		$data=array_merge($this->data);
		
		$data['store_id']=$store_id;
		$data['page_title']=$this->lang->line('add_subscription');
		$this->load->view('manual-subscription',$data);
	}
	public function get_category(){
		$package_id = $this->input->post('package_id');
		$package_details=get_package_details($package_id);
		$data = array(
						'monthly_price' =>$package_details->monthly_price,
						'annual_price' =>$package_details->annual_price,
					);
		echo json_encode($data);
	}
	/*public function save_update_subscription(){
		$this->form_validation->set_rules('subscription_name', 'Subscription Name', 'trim|required');
		$this->form_validation->set_rules('monthly_price', 'Monthly Price', 'trim|required');
		$this->form_validation->set_rules('annual_price', 'Annual Price', 'trim|required');
		$this->form_validation->set_rules('trial_days', 'Trial Days', 'trim|required');
		$this->form_validation->set_rules('max_warehouses', 'Max Warehouses', 'trim|required');
		$this->form_validation->set_rules('max_users', 'Max Users', 'trim|required');
		$this->form_validation->set_rules('max_items', 'Max Items', 'trim|required');
		$this->form_validation->set_rules('max_invoices', 'Max Invoices', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->subscription->save_and_update();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}*/
	/*public function update($id){
		$this->belong_to('db_subscription',$id);
		$this->permission_check('subscription');
		$data=$this->data;
		$result=$this->subscription->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('subscription');
		$this->load->view('subscription', $data);
	}*/

	public function ajax_list()
	{
		$list = $this->subscription->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		$current_subscription = get_current_subcription_id($this->input->post('store_id'));
		foreach ($list as $subscription) {
			
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$subscription->id.' class="checkbox column_checkbox" >';

			$activated = ($subscription->id==$current_subscription) ? "<span class='label label-success' style='cursor:pointer'>Active </span>" : '';
			

			$row[] = $subscription->package_name."\n".$activated;
			$row[] = show_date($subscription->subscription_date);
			$row[] = $subscription->trial_days;
			$row[] = (!empty($subscription->expire_date)) ? show_date($subscription->expire_date) : '';
			$row[] = $subscription->max_warehouses;
			$row[] = $subscription->max_users;
			$row[] = $subscription->max_items;
			$row[] = $subscription->max_invoices;

					$str = "<b>Payment:</b> ".$subscription->payment_gross;
					$str .= "<br><b>Payment Type:</b> ".$subscription->payment_type;
					$str .= "<br><b>Payment Status:</b> ".$subscription->payment_status;
			$row[] = $str;

			 		/*if($subscription->package_status==1){ 
			 			$str= "<span onclick='update_status(".$subscription->id.",0)' id='span_".$subscription->id."'  class='label label-success' style='cursor:pointer'>Active </span>";}
					else{ 
						$str = "<span onclick='update_status(".$subscription->id.",1)' id='span_".$subscription->id."'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
					}

			$row[] = is_admin() ? $str : 'NA';*/			
					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											
											
											if($this->permissions('subscription_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_subscription('.$subscription->id.')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>
											
										</ul>
									</div>';			

			$row[] = (is_admin()) ? $str2 : 'NA';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->subscription->count_all(),
						"recordsFiltered" => $this->subscription->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	/*public function update_status(){
		$this->permission_check_with_msg('subscription');
		$id=$this->input->post('id');
		$status=$this->input->post('status');

		$result=$this->subscription->update_status($id,$status);
		return $result;
	}
	
	public function delete_subscription(){
		$this->permission_check_with_msg('subscription');
		$id=$this->input->post('q_id');
		return $this->subscription->delete_subscription_from_table($id);
	}
	public function multi_delete(){
		$this->permission_check_with_msg('subscription');
		$ids=implode (",",$_POST['checkbox']);
		return $this->subscription->delete_subscription_from_table($ids);
	}*/
	
	
}
