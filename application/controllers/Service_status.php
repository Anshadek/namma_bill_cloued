<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_status extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load_global();
		$this->load->model('Services_model', 'services');
	}
	public function index()
	{
		$this->permission_check('cust_adv_payments_add');
		$data = $this->data;
		$data['page_title'] = $this->lang->line('advance_payments_list');
		$this->load->view('service_status/list', $data);
	}
	public function ajax_list()
	{
		$list = $this->services->get_service_status_datatables();

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rec) {

			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checkbox[]" value=' . $rec->id . ' class="checkbox column_checkbox" >';
			$row[] = $rec->sales_code;
			$row[] = $rec->item_name . '--' . $rec->item_code;
			$row[] = ucwords(str_replace('_', ' ', $rec->status));
			$row[] = isset($rec->note)?$rec->note:'--' ;
			$row[] = show_date($rec->created_date);
			$row[] = $rec->created_by;
			$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

			if ($this->permissions('cust_adv_payments_edit')) {
				$str2 .= '<li>
												<a onclick="changeStatus(' . $rec->id . ',' . "'$rec->status'" . ',' . "' $rec->note'" . ')">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';
			}

			if ($this->permissions('cust_adv_payments_delete')) {
				$str2 .= '<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_row(' . $rec->id . ')">
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
			"recordsTotal" => $this->services->count_all(),
			"recordsFiltered" => $this->services->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function update_status()
	{

		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$note = $this->input->post('note');

		$info = array(
			'status' 				=> $status,
			'note' 				=> $note,
			'created_by' 		=> $this->session->userdata('inv_username'),
		);


		$q1 = $this->db->where('id', $id)->update('db_service_working_status', $info);

		if ($q1) {
			$this->session->set_flashdata('success', 'Success!! Brand Updated Successfully!');
			echo "success";
		} else {
			echo "failed";
		}
	}

	public function delete_service_status()
	{
		$id = $this->input->post('q_id');
		
		//$query1 = $this->db->where('id' ,$id)->delete("db_service_working_status");
		$query1 = $this->db->delete('db_service_working_status', array('id' => $id));
		if (!$query1) {
			echo "failed";
		} else {
			echo "success";
		}
	}
	public function multi_delete()
	{
		$this->permission_check_with_msg('cust_adv_payments_delete');
		$ids = implode(",", $_POST['checkbox']);
		return $this->advance->delete_advance_from_table($ids);
	}
}
