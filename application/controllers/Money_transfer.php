<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Money_transfer extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('money_transfer_model','money_transfer');
	}
	public function index()
	{
		$this->permission_check('money_transfer_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('money_transfer_list');
		$this->load->view('accounts/money_transfer_list',$data);
	}
	public function add()
	{
		$this->permission_check('money_transfer_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('money_transfer');
		$this->load->view('accounts/money_transfer',$data);
	}
	
	
	public function new_money_transfer(){
		$this->permission_check('money_transfer_add');
		$this->form_validation->set_rules('transfer_date', 'Transfer date', 'trim|required');
		$this->form_validation->set_rules('transfer_code', 'Transfer Code', 'trim|required');
		$this->form_validation->set_rules('debit_account_id', 'From Account', 'trim|required');
		$this->form_validation->set_rules('credit_account_id', 'To Account', 'trim|required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->money_transfer->verify_and_save();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}
	public function update($id){
		$this->belong_to('ac_moneytransfer',$id);
		$this->permission_check('money_transfer_edit');
		$data=$this->data;
		$result=$this->money_transfer->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('money_transfer');
		$this->load->view('accounts/money_transfer', $data);
	}
	public function update_money_transfer(){
		$this->form_validation->set_rules('transfer_date', 'Transfer date', 'trim|required');
		$this->form_validation->set_rules('transfer_code', 'Transfer Code', 'trim|required');
		$this->form_validation->set_rules('debit_account_id', 'From Account', 'trim|required');
		$this->form_validation->set_rules('credit_account_id', 'To Account', 'trim|required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
			$result=$this->money_transfer->update_money_transfer();
			echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}

	public function ajax_list()
	{
		$list = $this->money_transfer->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $money_transfer) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value='.$money_transfer->id.' class="checkbox column_checkbox" >';
			
			$row[] = $money_transfer->transfer_code;
			$row[] = show_date($money_transfer->transfer_date);
			$row[] = $money_transfer->reference_no;

			$row[] = get_account_name($money_transfer->debit_account_id);
			$row[] = get_account_name($money_transfer->credit_account_id);

			$row[] = store_number_format($money_transfer->amount);

			$row[] = ucfirst($money_transfer->created_by);			
				     $str2 = '<div class="btn-group" title="View Money Transfer">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('money_transfer_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="'.base_url().'money_transfer/update/'.$money_transfer->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('money_transfer_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_money_transfer('.$money_transfer->id.')">
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
						"recordsTotal" => $this->money_transfer->count_all(),
						"recordsFiltered" => $this->money_transfer->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function delete_money_transfer(){
		$this->permission_check_with_msg('money_transfer_delete');
		$id=$this->input->post('q_id');
		echo $this->money_transfer->delete_money_transfer_from_table($id);
	}
	public function multi_delete_money_transfer(){
		$this->permission_check_with_msg('money_transfer_delete');
		$ids=implode (",",$_POST['checkbox']);
		echo $this->money_transfer->delete_money_transfer_from_table($ids);
	}

	function get_warehouse_accounts_select_list(){
		$this->db->where("store_id",get_current_store_id());
		if ($_POST['warehouse_id'] > 0){
			$this->db->where("warehouse_id",$_POST['warehouse_id']);
		}
		
	   $this->db->select("*")->where("status=1")->from("ac_accounts");
	   $this->db->order_by("sort_code");
	   $q1=$this->db->get();
 
	   $str='';
	   $select_id = ( isset($_POST['selected']) ? $_POST['selected'] : "");
		if($q1->num_rows($q1)>0)
		 {  
			//$str.='<option value="">-CREATE ACCOUNT HEAD-</option>'; 
			 foreach($q1->result() as $res1)
		   { 
			 $selected = ($select_id==$res1->id)? 'selected' : '';
			 
				 $str.= ($res1->parent_id==0) ? '<optgroup class="bg-yellow" label="'.$res1->account_name.'">' : '';
			 $str.="<option $selected data-account-name='".$res1->account_name."' value='".$res1->id."'>";
					 $str.=add_dash($res1->account_name,$res1->parent_id,$res1->sort_code);
				 
			 $str.="</option>";	
				 $str.= ($res1->parent_id==0) ? '</optgroup>' : '';
			 
		   //  echo get_accounts_select_list_sub(null,$res1->id);
		   }
		 }
		 else
		 {
			 //$str.='<option value="">No Records Found</option>'; 
		 }
		 echo $str;
  }


  function get_warehouse_accounts_select_list_for_create_account(){
	$this->db->where("store_id",get_current_store_id());
	if ($_POST['warehouse_id'] > 0){
		$this->db->where("warehouse_id",$_POST['warehouse_id']);
	}
	
   $this->db->select("*")->where("status=1")->from("ac_accounts");
   $this->db->order_by("sort_code");
   $q1=$this->db->get();

   $str='';
   $select_id = ( isset($_POST['selected']) ? $_POST['selected'] : "");
	if($q1->num_rows($q1)>0)
	 {  
		$str.='<option value="">-CREATE ACCOUNT HEAD-</option>'; 
		 foreach($q1->result() as $res1)
	   { 
		 $selected = ($select_id==$res1->id)? 'selected' : '';
		 
			 $str.= ($res1->parent_id==0) ? '<optgroup class="bg-yellow" label="'.$res1->account_name.'">' : '';
		 $str.="<option $selected data-account-name='".$res1->account_name."' value='".$res1->id."'>";
				 $str.=add_dash($res1->account_name,$res1->parent_id,$res1->sort_code);
			 
		 $str.="</option>";	
			 $str.= ($res1->parent_id==0) ? '</optgroup>' : '';
		 
	   //  echo get_accounts_select_list_sub(null,$res1->id);
	   }
	 }
	 else
	 {
		 //$str.='<option value="">No Records Found</option>'; 
	 }
	 echo $str;
}
	


}
