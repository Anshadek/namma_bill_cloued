<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_up extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_info();
		$this->load->model('store_profile_model','store');
		// if(get_domain()!=get_dbdomain()){echo appinfo_domain_msg();exit();}
        //if( (appinfo()!=get_dbmid()) || (appinfo()!="1")){echo appinfo_mid_msg();exit();}/*@@/appinfo/@@*/
		is_sql_full_group_by_enabled();
	}
	
	public function index()
	{	
		$this->load->view('signup');
			
	}

	public function add_customer(){
		
		$this->form_validation->set_rules("store_name", "Store Name", "required");
		 $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[db_users.email]'");
		 $this->form_validation->set_rules("mobile", "Mobile", "required|regex_match[/^[0-9]{10}$/]");
		 $this->form_validation->set_rules("pan_no", "Pan No", "trim|required");
		 $this->form_validation->set_rules("state", "State", "trim|required");
		 $this->form_validation->set_rules("country", "State", "trim|required");
		$this->form_validation->set_rules("city", "City", "trim|required");
		$this->form_validation->set_rules("postcode", "Postcode", "trim|required");
		if($this->form_validation->run() == false) { 
			return $this->load->view('signup');
		}else{
		$result=$this->store->create_store();
		$this->session->set_flashdata('success', 'Please Login Here!');
		redirect('login');
		}
		//echo $result;	
	}

	function get_state_select_list(){
		
		$select_id = isset($_POST['selected']) ? $_POST['selected'] : 0;
		$q1=$this->db->select("*")
		->where('country',$_POST['country'])
		->from("db_states")->get();
		$str='';
		 if($q1->num_rows($q1)>0)
		  {  
			  $str='';
			  $str.='<option value="">-- Select --</option>'; 
			  foreach($q1->result() as $res1)
			{ 
				
			  $selected = ($select_id==$res1->id)? 'selected' : '';
			  $str.="<option $selected value='".$res1->id."'>".$res1->state."</option>";
			}
		  }
		  else
		  {
			  $str.='<option value="">No Records Found</option>'; 
		  }
		  echo $str;
   }
	

}

