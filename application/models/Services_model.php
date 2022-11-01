<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model {

	var $table = 'db_service_working_status as a';
	var $column_order = array(
								'a.id',
								'a.status',
								'a.note',
								'a.created_date',
								'a.updated_date',
								'a.created_by',
								'b.item_name',
								'b.item_code',
								'c.sales_code',
								); //set column field database for datatable orderable
	var $column_search = array(
								'a.id',
								'a.status',
								'a.note',
								'a.created_date',
								'a.updated_date',
								'a.created_by',
								'b.item_name',
								'b.item_code',
								'c.sales_code',
								); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 
	
	//Save Cutomers
	public function verify_and_save(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

		$this->db->trans_begin();
		$this->db->trans_strict(TRUE);

		$file_name='';
		if(!empty($_FILES['item_image']['name'])){

			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/items/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024;
	        $config['max_width']            = 1500;
	        $config['max_height']           = 1500;
	       
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('item_image'))
	        {	
	                $error = array('error' => $this->upload->display_errors());
	                print($error['error']);
	                exit();
	        }
	        else
	        {		
	        	$file_name=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/items/'.$file_name;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 75;
				$config['height']       = 50;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end

	        	
	        }
		}
		
		//Validate This items already exist or not
		$store_id=(store_module() && is_admin()) ? $store_id : get_current_store_id();
		/*$query=$this->db->query("select * from db_items where upper(item_name)=upper('$item_name') and store_id=$store_id");
		if($query->num_rows()>0){
			return "Sorry! This Items Name already Exist.";
		}*/
		
		//Create items unique Number
		$this->db->query("ALTER TABLE db_items AUTO_INCREMENT = 1");
		//end

		
		//$stock = $current_opening_stock + $new_opening_stock;

		

		#------------------------------------
		$info = array(
							'count_id' 					=> get_count_id('db_items'), 
		    				'item_code' 				=> get_init_code('item'), 
		    				'item_name' 				=> $item_name,
		    				'category_id' 				=> $category_id,
							'category_id' 				=> $category_id,
		    				'price' 					=> $price,
		    				'tax_id' 					=> $tax_id,
		    				'purchase_price' 			=> $purchase_price,
		    				'tax_type' 					=> $tax_type,
		    				'sales_price' 				=> $sales_price,
							'warehouse_id' 				=> $warehouse_id,
		    				/*System Info*/
		    				'created_date' 				=> $CUR_DATE,
		    				'created_time' 				=> $CUR_TIME,
		    				'created_by' 				=> $CUR_USERNAME,
		    				'system_ip' 				=> $SYSTEM_IP,
		    				'system_name' 				=> $SYSTEM_NAME,
		    				'status' 					=> 1,
		    				'service_bit' 				=> 1,
		    				'seller_points'				=> $seller_points,
		    				'custom_barcode'			=> $custom_barcode,
		    				'description'				=> $description,
		    				'hsn'						=> $hsn,
		    				'discount_type'				=> $discount_type,
		    				'discount'					=> $discount,
		    			);
		if(!empty($file_name)){
			$info['item_image'] = 'uploads/items/'.$file_name;
		}

		$info['store_id']=(store_module() && is_admin()) ? $store_id : get_current_store_id();	

		$query1 = $this->db->insert('db_items', $info);
		#------------------------------------
		if(!$query1){
			return "failed";
		}
		
		$item_id = $this->db->insert_id();
		

		if ($query1){
				
				
				$this->db->query("update db_items set expire_date=null where expire_date='0000-00-00'");
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Success!! New Service Added Successfully!');
		        return "success";
		}
		else{
				$this->db->trans_rollback();
				//unlink('uploads/items/'.$file_name);
		        return "failed";
		}
		
	}

	
	public function update_services(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
		
		//Validate This items already exist or not
		$store_id=(store_module() && is_admin()) ? $store_id : get_current_store_id();
		$this->db->trans_begin();
		/*$query=$this->db->query("select * from db_items where upper(item_name)=upper('$item_name') and id<>$q_id and store_id=$store_id");
		if($query->num_rows()>0){
			return "This Items Name already Exist.";
		}
		else{*/

			$file_name=$item_image='';
			if(!empty($_FILES['item_image']['name'])){

				$new_name = time();
				$config['file_name'] = $new_name;
				$config['upload_path']          = './uploads/items/';
		        $config['allowed_types']        = 'jpg|png';
		        $config['max_size']             = 1024;
		        $config['max_width']            = 1500;
		        $config['max_height']           = 1500;
		       
		        $this->load->library('upload', $config);

		        if ( ! $this->upload->do_upload('item_image'))
		        {
		                $error = array('error' => $this->upload->display_errors());
		                print($error['error']);
		                exit();
		        }
		        else
		        {		
		        	$file_name=$this->upload->data('file_name');
		        	
		        	/*Create Thumbnail*/
		        	$config['image_library'] = 'gd2';
					$config['source_image'] = 'uploads/items/'.$file_name;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = 75;
					$config['height']       = 50;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					//end

					//$item_image=" ,item_image='".$config['source_image']."' ";
					$item_image=$config['source_image'];

		        }
			}

			//$stock = $current_opening_stock + $new_opening_stock;
		

			$info = array(
		    				'item_name' 				=> $item_name,
		    				'category_id' 				=> $category_id,		    				
		    				'price' 					=> $price,
		    				'tax_id' 					=> $tax_id,
		    				'purchase_price' 			=> $purchase_price,
		    				'tax_type' 					=> $tax_type,
		    				'sales_price' 				=> $sales_price,
		    				'seller_points'				=> $seller_points,
							'warehouse_id' 				=> $warehouse_id,
		    				'custom_barcode'			=> $custom_barcode,
		    				'description'				=> $description,
		    				'hsn'						=> $hsn,
		    				'discount_type'				=> $discount_type,
		    				'discount'					=> $discount,
		    			);
			//Image Path	
			if(!empty($file_name)){
				$info['item_image'] = 'uploads/items/'.$file_name;
			}

			//Store ID
			$info['store_id']=(store_module() && is_admin()) ? $store_id : get_current_store_id();	

			$query1 = $this->db->where('id',$q_id)->update('db_items', $info);


			if(!$query1){
				return "failed";
			}

			

			
			if ($query1){
				   $this->db->query("update db_items set expire_date=null where expire_date='0000-00-00'");
				   $this->db->trans_commit();
				   $this->session->set_flashdata('success', 'Success!! Service Item Updated Successfully!');
			        return "success";
			}
			else{
					$this->db->trans_rollback();
			        return "failed";
			}
		/*}*/
	}

	function get_service_status_datatables()
	{
		
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
	}
	private function _get_datatables_query()
	{
		
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		$this->db->join('db_items as b','b.id=a.item_id','left');
		$this->db->join('db_sales as c','c.id=a.sales_id','left');
		//if(!is_admin()){
	      $this->db->where("a.store_id",get_current_store_id());
		  if ($_POST['warehouse_id'] != ""){
			
			$this->db->where("a.warehouse_id",$_POST['warehouse_id']);
		  }
		  
	    //}
	    //echo $this->db->get_compiled_select();exit();

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
	public function count_all()
	{
		//$this->db->where("store_id",get_current_store_id());
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

}
