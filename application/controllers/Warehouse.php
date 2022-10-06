<?php 
	/**
	 * Author: Askarali
	 * Date: 13-04-2019
	 */
	class Warehouse extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->load_global();
			$this->load->model('warehouse_model','warehouse');
			$this->load->model('store_model','store');
			
		}
		public function index(){
			$this->permission_check('warehouse_view');
			$data=$this->data;//My_Controller constructor data accessed here
			$data['page_title']='Warehouse List';
			$this->load->view('warehouse/warehouse-list',$data);
		}
		// public function save_or_update(){
			
		// 	$data=$this->data;//My_Controller constructor data accessed here
		// 	$this->form_validation->set_rules('warehouse_name', 'Warehouse Name', 'required|trim');
			
		// 	if ($this->form_validation->run() == TRUE) {
		// 		if($this->input->post('command')=='save'){
		// 			$result=$this->warehouse->verify_and_save($data);
		// 		}
		// 		else{
		// 			$result=$this->warehouse->verify_and_update($data);
		// 		}
				
		// 		echo $result;
		// 	} 
		// 	else {
		// 		//echo validation_errors();
		// 		echo "Please Fill Compulsory(* marked) Fields.";
		// 	}
		
		// }
		public function new_warehouse(){
			//$result=$this->store->verify_and_save();

			//check package limit
			$warehouse_id = get_store_warehouse_id();
			$store_id 	= get_current_store_id();
			$q1 = $this->db->select("*")
			->where('warehouse_id',$warehouse_id )->limit(1)
			->get("db_store_purchased_packages")->row();
			
			if (!empty($q1)) {
				if ($q1->type == 'subscription') { 	

				$q2 = $this->db->select("*")
			->where('store_id',$store_id)
			->get("db_users");

			$q3 = $this->db->select("*")
			->where('id',$q1->package_id)
			->limit(1)
			->get("db_package_subscription")
			->row();
			if($q2->num_rows() >= $q3->warehouse_count ){
				echo "Your package limit is expired";
				return 0;
			}

				}
			}
			//==================================

			$result=$this->warehouse->verify_and_save();
			echo $result;	
		}
		public function add(){
			
			$this->permission_check('warehouse_add');
			$data=$this->data;//My_Controller constructor data accessed here
			//$data['page_title']='Create/Update Warehouse';
			//$data['page_title']='Warehouse';
			$data=array_merge($this->data,$this->store->store_making_codes());
			$data['page_title']=$this->lang->line('Warehouse');
			
			$this->load->view('warehouse/warehouse',$data);
		}
		public function status_update(){
			$this->permission_check('warehouse_edit');
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$result=$this->warehouse->status_update($id,$status);
			return $result;

		}
		public function edit($id){
			$this->belong_to('db_warehouse',$id);
			$this->permission_check('warehouse_edit');
			$data=$this->warehouse->get_details($id);
			$data['page_title']='Warehouse';
			$this->load->view('warehouse/warehouse', $data);
		}
		public function delete_warehouse(){
			$this->permission_check('warehouse_delete');
			$id=$this->input->post('id');
			$result=$this->warehouse->delete_warehouse($id);
			echo $result;
		}

		/*Used in items-list.php*/
		public function view_warehouse_wise_stock_item(){
			$this->permission_check_with_msg('items_view');
			$this->load->model('warehouse_model');
			$item_id=$this->input->post('item_id');
			echo $this->warehouse_model->view_warehouse_wise_stock_item($item_id);
		}
	}

	

?>
