<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_coupon_model extends CI_Model {

	var $table = 'db_coupons';
	var $column_order = array('id','name','expire_date','value','type','status'); //set column field database for datatable orderable
	var $column_search = array('id','name','expire_date','value','type','status'); //set column field database for datatable searchable 
	var $order = array('id' => 'desc'); // default order 

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		//if not admin
		//if(!is_admin()){
			$this->db->where("store_id",get_current_store_id());
		//}
		
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->where("store_id",get_current_store_id());
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function save_record(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));

		$expire_date=system_fromatted_date($expire_date);
		//Validate This customers already exist or not
		$store_id=(store_module() && is_admin()) ? $store_id : get_current_store_id();  	
		
		$info = array(
	                'store_id'         	=> $store_id,
	                //'code'         		=> $code,
	                'name'         		=> $coupon_name,
	                'expire_date'       => $expire_date,
	                'value'         	=> $coupon_value,
	                'type'		        => $coupon_type,
	                'description'		=> $description,
	              );
		if($command=='save'){
			
			$save_operation = array(
				                /*System Info*/
				                'created_date'        	=> $CUR_DATE,
				                'created_time'        	=> $CUR_TIME,
				                'created_by'        	=> $CUR_USERNAME,
				                'system_ip'         	=> $SYSTEM_IP,
				                'system_name'         	=> $SYSTEM_NAME,
				                'status'          		=> 1,
				              );
		    $info = array_merge($info,$save_operation);
		    $query1 = $this->db->insert('db_coupons', $info);
		    if(!$query1){
		    	return "failed";
		    }

		    $this->session->set_flashdata('success', 'Success!! Record Added Successfully!');
		}
		else{
			//UPDATE OPERATION
			$query1 = $this->db->where('id',$q_id)->update('db_coupons', $info);
			if(!$query1){
		    	return "failed";
		    }
		    $this->session->set_flashdata('success', 'Success!! Record Updated Successfully!');
		}
		return "success";
		
	}

	//Get brand_details
	public function get_details($id,$data){
		//Validate This brand already exist or not
		$query=$this->db->query("select * from db_coupons where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['name']=$query->name;
			//$data['code']=$query->code;
			$data['description']=$query->description;
			$data['value']=$query->value;
			$data['type']=$query->type;
			$data['expire_date']=show_date($query->expire_date);
			return $data;
		}
	}
	
	public function update_status($id,$status){
		if (set_status_of_table($id,$status,'db_coupons')){
            echo "success";
        }
        else{
            echo "failed";
        }
	}
	public function delete_coupons($ids){
			$this->db->trans_begin();

			$this->db->where("id in ($ids)");
			//if not admin
			if(!is_admin()){
				$this->db->where("store_id",get_current_store_id());
			}

			$query1=$this->db->delete("db_coupons");
	

	        if ($query1){
	        	$this->db->trans_commit();
	            echo "success";
	        }
	        else{
	            echo "failed";
	        }	
		
	}


}
