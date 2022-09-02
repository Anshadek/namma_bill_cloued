<?php
 function get_brands_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	   $store_id = (!empty($store_id)) ? $store_id : get_current_store_id();

	   $CI->db->where("store_id",$store_id);

	  $q1=$CI->db->select("*")->where("status=1")->from("db_brands")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  //$str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->brand_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
  function get_items_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	  //if not admin
	  if(!empty($store_id)){
	    $CI->db->where("store_id",$store_id);
	  }

	  $q1=$CI->db->select("*")->where("status=1")->from("db_items")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	$str='';
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->item_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
  function get_categories_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	  $store_id = (!empty($store_id)) ? $store_id : get_current_store_id();

	  $CI->db->where("store_id",$store_id);
	  
	  $q1=$CI->db->select("*")->where("status=1")->from("db_category")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  

	    	//$str.='<option value="">-Select-</option>'; 

	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }


 function get_categories_select_list_pos($select_id='',$store_id=''){
	$CI =& get_instance();

   $store_id = (!empty($store_id)) ? $store_id : get_current_store_id();

   $CI->db->where("store_id",$store_id);
   
   $q1=$CI->db->select("*")->where("status=1")->from("db_category")->get();
   $str='';
	if($q1->num_rows($q1)>0)
	 {  

		 //$str.='<option value="">-Select-</option>'; 

		 foreach($q1->result() as $res1)
	   { 
		 $selected = ($select_id==$res1->id)? 'selected' : '';
		 $str.="<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
	   }
	 }
	 else
	 {
		 $str.='<option value="">No Records Found</option>'; 
	 }
	 return $str;
}

 function get_payment_types_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	  $store_id = (!empty($store_id)) ? $store_id : get_current_store_id();

	  $CI->db->where("store_id",$store_id);
	  
	  $q1=$CI->db->select("*")->where("status=1")->from("db_paymenttypes")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  

	    	//$str.='<option value="">-Select-</option>'; 

	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->payment_type)? 'selected' : '';
	        $str.="<option $selected value='".$res1->payment_type."'>".$res1->payment_type."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_units_select_list($select_id=''){
 	  $CI =& get_instance();

	  //if not admin
	  //if(!is_admin()){
	    $CI->db->where("store_id",get_current_store_id());
	  //}
	  
	  $q1=$CI->db->select("*")->where("status=1")->from("db_units")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  $str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->unit_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_tax_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

 	  //if not admin
	  if(!empty($store_id)){
	    $CI->db->where("store_id",$store_id);
	  }
	  
	  //if not admin
	 // if(!is_admin()){
	    $CI->db->where("store_id",get_current_store_id());
	  //}
	  
	  $q1=$CI->db->select("*")->where("status=1")->from("db_tax")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  $str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected data-tax='".$res1->tax."' value='".$res1->id."'>".$res1->tax_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }

   function get_country_select_list($select_id='',$show_select_option=false){
 	  $CI =& get_instance();

	  $q1=$CI->db->select("*")->where("status=1")->from("db_country")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	 $str.= ($show_select_option) ? '<option value="">-Select-</option>' : ''; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->country."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_state_select_list($select_id=''){
 	  $CI =& get_instance();

	  //if not admin
	  /*if(!is_admin()){
	    $CI->db->where("store_id",get_current_store_id());
	  }*/

	  $q1=$CI->db->select("*")->where("status=1")->from("db_states")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  $str.='<option value="">Select State</option>'; 
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
	    return $str;
 }
 function get_customers_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	  //if not admin
	  if(!empty($store_id)){
	    $CI->db->where("store_id",$store_id);
	  }

	  $q1=$CI->db->select("*")->where("status=1")->from("db_customers")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	$str='';
	        foreach($q1->result() as $res1)
	      { 
	      	//$customer_previous_due = $res1->sales_due +$res1->opening_balance;
	      	//$customer_previous_due = store_number_format($customer_previous_due,0);

	      	$customer_previous_due = $res1->sales_due +$res1->opening_balance;
	      	
	      	$customer_previous_due -=get_paid_cob($res1->id);

	      	$tot_advance = store_number_format($res1->tot_advance,0);
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected data-delete_bit='".$res1->delete_bit."' data-tot_advance='".$tot_advance."' data-previous_due='".store_number_format($customer_previous_due,false)."' value='".$res1->id."'>".$res1->customer_code."-".$res1->customer_name."-".$res1->mobile."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_customers_select_list_pos($select_id='',$store_id=''){
	$CI =& get_instance();

   //if not admin
   if(!empty($store_id)){
	 $CI->db->where("store_id",$store_id);
   }

   $q1=$CI->db->select("*")->where("status=1")->from("db_customers")->get();
   $str='';
	if($q1->num_rows($q1)>0)
	 {  
		 $str='';
		 foreach($q1->result() as $res1)
	   { 
		   $customer_purchase_due = store_number_format($res1->sales_due,0);
		   $customer_previous_due =  store_number_format($res1->opening_balance,0);
		  // $customer_previous_due = store_number_format($customer_previous_due,0);
		   
		   $customer_previous_due -=get_paid_cob($res1->id);

		   $tot_advance = store_number_format($res1->tot_advance,0);
		 $selected = ($select_id==$res1->id)? 'selected' : '';
		 $disabled = ($res1->count_id != 1)? 'disabled' : '';
		 $str.="<option $selected data-selected-warehouse_id='".$res1->warehouse_id."' data-customer-purchase-due='".$customer_purchase_due."' data-delete_bit='".$res1->delete_bit."' data-tot_advance='".$tot_advance."' data-previous_due='".$customer_previous_due."' value='".$res1->id."'$disabled>".$res1->customer_code."-".$res1->customer_name."-".$res1->mobile."</option>";
	   }
	 }
	 else
	 {
		 $str.='<option value="">No Records Found</option>'; 
	 }
	 return $str;
}
  function get_suppliers_select_list($select_id='',$store_id='',$show_select=false){
 	  $CI =& get_instance();

	  //if not admin
	  if(!empty($store_id)){
	    $CI->db->where("store_id",$store_id);
	  }

	  $q1=$CI->db->select("*")->where("status=1")->from("db_suppliers")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
			if($show_select==true){
	    		$str.='<option value="">-Select-</option>'; 
	    	}
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->supplier_code."-".$res1->supplier_name."-".$res1->mobile."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_expense_category_select_list($select_id='',$store_id=''){
 	  $CI =& get_instance();

	  //if not admin
	  if(!empty($store_id)){
	    $CI->db->where("store_id",$store_id);
	  }

	  $q1=$CI->db->select("*")->where("status=1")->from("db_expense_category")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	//$str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
  function get_warehouse_select_list($select_id='',$store_id='',$show_select=false){
 	  $CI =& get_instance();

	   $show_select=true;

	  //Only Allowed Warehouse show to loged in user
 	if(!is_admin()){
		
		
 		//Find the previllaged wareshouses to the user
		
		 $privileged_warehouses = get_privileged_warehouses_ids();
		 
 		$q3 = $CI->db->select("warehouse_id")->where("id in ($privileged_warehouses)")->get("db_userswarehouses");
 		$ids = array();
 		foreach ($q3->result() as $res3) {
 			$ids[] = $res3->warehouse_id;
 		}
 		$ids = implode(',', $ids);
 		//$CI->db->where("id in ($ids)");
 	}

    //if not admin
	//   if(!empty($store_id)){
	//     $CI->db->where("store_id",$store_id);
	//   }
	//   else{
	//   	$CI->db->where("store_id",get_current_store_id());
	//   }
	  if(!is_admin()){
		$privileged_warehouses = get_privileged_warehouses_ids();
	  $q1=$CI->db->select("*")
	  ->where("status=1")
	  ->where("id in ($privileged_warehouses)")
	  ->from("db_warehouse")->get();
	  }else{
		$q1=$CI->db->select("*")->where("status=1")->where("store_id",get_current_store_id())->from("db_warehouse")->get();
	  }
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	if($show_select==true && is_admin()){
	    		$str.='<option value="">-Select-</option>'; 
	    	}
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->warehouse_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }

  function get_users_select_list($role_id='',$store_id=''){
 	  $CI =& get_instance();

	  $str='';

	  	$str.='<option value="">All</option>';
	  	if($role_id==1 || $role_id==2){
	    	$CI->db->where("store_id",$store_id);
	    }
	    else{//other user
	    	$CI->db->where("id",$CI->session->userdata('inv_userid'));
	    }

	    

	  $q1=$CI->db->select("*")->where("status=1")->from("db_users")->get();
	  
	   if($q1->num_rows($q1)>0)
	    {  

	    	
	        foreach($q1->result() as $res1)
	      { 
	        //$selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option  value='".$res1->username."'>".ucfirst($res1->username)."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }

 function get_cheque_status_select_list($selection=''){
 	  $records = array(
 	  					'Pending',
 	  					'Cleared',
 	  					'Not-Cleared',
 	  					'Waiting',
 	  					'Cancelled',
 	  					);
 	  $str='';
 	  $str.='<option value="">-Select-</option>'; 
 	  foreach($records as $res1)
      { 
        $selected = (strtoupper($selection)==strtoupper($res1))? 'selected' : '';
        $str.="<option $selected value='".$res1."'>".$res1."</option>";
      }
	  return $str;
 }
 function get_coupon_type_select_list($selection=''){
 	  $records = array(
 	  					'Fixed',
 	  					'Percentage',
 	  					);
 	  $str='';
 	  $str.='<option value="">-Select-</option>'; 
 	  foreach($records as $res1)
      { 
        $selected = (strtoupper($selection)==strtoupper($res1))? 'selected' : '';
        $str.="<option $selected value='".$res1."'>".$res1."</option>";
      }
	  return $str;
 }

function get_packages_select_list($select_id=''){
 	  $CI =& get_instance();

	  $q1=$CI->db->select("*")->where("status=1")->from("db_package")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	$str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected value='".$res1->id."'>".$res1->package_name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }
 function get_discount_coupon_select_list($select_id=''){
 	  $CI =& get_instance();

	  $q1=$CI->db->select("*")
	  												->where("status=1")
	  												/*->where("expire_date>='".date("Y-m-d")."'")*/
	  												->from("db_coupons")->get();
	  $str='';
	   if($q1->num_rows($q1)>0)
	    {  
	    	$str.='<option value="">-Select-</option>'; 
	        foreach($q1->result() as $res1)
	      { 
	        $selected = ($select_id==$res1->id)? 'selected' : '';
	        $str.="<option $selected data-type='".$res1->type."' data-value='".$res1->value."' data-expire_date='".show_date($res1->expire_date)."' value='".$res1->id."'>".$res1->name."</option>";
	      }
	    }
	    else
	    {
	    	$str.='<option value="">No Records Found</option>'; 
	    }
	    return $str;
 }

 function get_super_admin_bank_account_type_select_list($selection=''){
 	  $records = array(
 	  					'Saving',
 	  					'Current',
 	  					);
 	  $str='';
 	  //$str.='<option value="">-Select-</option>'; 
 	  foreach($records as $res1)
      { 
        $selected = (strtoupper($selection)==strtoupper($res1))? 'selected' : '';
        $str.="<option $selected value='".$res1."'>".$res1."</option>";
      }
	  return $str;
 }

 function get_super_admin_bank_status_select_list($selection=''){
 	  $records = array( 1 => 'Active', 0 => 'Disable');
 	  $str='';
 	  //$str.='<option value="">-Select-</option>'; 
 	  foreach($records as $key => $value)
      { 
         $selected = ($selection==$key)? 'selected' : '';
         $str.="<option $selected value='".$key."'>".$value."</option>";
      }
	  return $str;
 }
