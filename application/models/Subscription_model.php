<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends CI_Model {

	//Datatable start
	var $table = 'db_subscription as a';
	var $column_order = array(
								'a.id',
								'a.package_name',
								'a.subscription_date',
								'a.trial_days',
								'a.expire_date',
								'a.max_warehouses',
								'a.max_users',
								'a.max_items',
								'a.max_invoices',
								'a.payment_status',
								'a.package_status',
								'a.store_id'); //set column field database for datatable orderable
	var $column_search = array('a.id',
								'a.package_name',
								'a.subscription_date',
								'a.trial_days',
								'a.expire_date',
								'a.max_warehouses',
								'a.max_users',
								'a.max_items',
								'a.max_invoices',
								'a.payment_status',
								'a.package_status',
								'a.store_id' ); //set column field database for datatable searchable 
	var $order = array('a.id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{
    /*If account payble checked*/
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		//if not admin
    //if(!is_admin()){
      $this->db->where("a.store_id",get_current_store_id());
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
	//Datatable end

	//Save Cutomers
	public function save_and_update(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST,$_GET))));
    $expire_date=system_fromatted_date($expire_date);

    $store_id=get_current_store_id();
    $info = array(
                'store_id'            => $store_id, 
                'subscription_name'         => $subscription_name,
                'description'          => $description,
                'monthly_price'         => $monthly_price,
                'annual_price'             => $annual_price,
                'trial_days'           => $trial_days,
                'expire_date'         => $expire_date,
                'max_warehouses'        => $max_warehouses,
                'max_users'        => $max_users,
                'max_items'        => $max_items,
                'max_invoices'        => $max_invoices,
                /*System Info*/
                
              );

		if($command=='save'){
      $info1 = array(
                'created_date'        => $CUR_DATE,
                'created_time'        => $CUR_TIME,
                'created_by'        => $CUR_USERNAME,
                'system_ip'         => $SYSTEM_IP,
                'system_name'         => $SYSTEM_NAME,
                'status'          => 1,
              );

      $this->db->query("ALTER TABLE db_subscription AUTO_INCREMENT = 1");
      $query1 = $this->db->insert('db_subscription', array_merge($info,$info1));
      $this->session->set_flashdata('success', 'Success!! New Subscription Added Successfully!');
    }
    else{
      $query1 = $this->db->where('id',$q_id)->update('db_subscription', $info);
      $this->session->set_flashdata('success', 'Success!! Subscription Updated Successfully!');
    }
    $this->db->set("expire_date",null)->where("expire_date",'1970-01-01')->update("db_subscription");
		if(!$query1){
		  return "failed";
		}
		return "success";
		
	}

	//Get subscription_details
	public function get_details($id,$data){
		//Validate This subscription already exist or not
		$query=$this->db->query("select * from db_subscription where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
      $data['store_id']=$query->store_id;
			$data['subscription_name']=$query->subscription_name;
      $data['monthly_price']=$query->monthly_price;
      $data['annual_price']=$query->annual_price;
      $data['trial_days']=$query->trial_days;
      $expire_date = (date("d-m-Y",strtotime($query->expire_date))!='01-01-1970') ? show_date($query->expire_date) : '';
      $data['expire_date']=$expire_date;
      $data['description']=$query->description;
      $data['max_warehouses']=$query->max_warehouses;
      $data['max_users']=$query->max_users;
      $data['max_items']=$query->max_items;
      $data['max_invoices']=$query->max_invoices;
			
			return $data;
		}
	}

  public function update_status($id,$status){
       if (set_status_of_table($id,$status,'db_subscription')){
            echo "success";
        }
        else{
            echo "failed";
        }
  }
	
	public function delete_subscription_from_table($ids){
      $this->db->trans_begin();
          #---------------------------------
          $this->db->where("id in ($ids)");
          //if not admin
          if(!is_admin()){
            $this->db->where("store_id",get_current_store_id());
          }

          $query2=$this->db->delete("db_subscription");
          #---------------------------------

          if ($query2){
            $this->db->trans_commit();
              echo "success";
          }
          else{
              echo "failed";
          } 
	}

	

}
