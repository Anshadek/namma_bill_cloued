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
			echo validation_errors();
		}else{
		$result=$this->store->create_store();
		
		$this->sendmail($_POST['email']);
		$this->session->set_flashdata('success', 'Please Login Here!');
		echo "success";
		//redirect('login');
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


 public function sendmail($to_email){

	$this->load->library('email');
		//$to_email = 'anshadali.ek@gmail.com';
        $from_email = 'no_reply@nammabilling.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> '.base_url().'sign_up/verify_emailid/'. md5($to_email) . '<br /><br /><br />Thanks<br />Namma bill Team';
        
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.nammabilling.com'; //smtp host name
        $config['smtp_port'] = '587'; //smtp port number
        $config['smtp_user'] = 'no_reply@nammabilling.com';
        $config['smtp_pass'] = 'brD88#qig'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'Nammabill');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        // $this->email->send();
    if (!$this->email->send()) {
    show_error($this->email->print_debugger()); }
  else {
    echo 'Your verification email has been sent successfully. Please verify your email to log in!';
  }
 }

 function verify_emailid($key)
 {
	 $data = array('mail_verified' => 1);
	 $this->db->where('md5(email)', $key);
	$res =  $this->db->update('db_users', $data);
	if($res){
		$login_url = base_url();
		echo 'your mail is verified..you can login now <a href="' . $login_url . '">Login nammabill</a>';
	}else{
		echo 'something went wrong..!!';
	}

 }
 function check_mail_exists(){
	
	$q1=$this->db->select("*")
		->where('email',$_POST['email'])
		->from("db_users")->get();
		 if($q1->num_rows()>0){
			echo true;
		 }else{
			echo 2;
		 }
 }
	

}

