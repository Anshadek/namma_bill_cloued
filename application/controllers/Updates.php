<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updates extends MY_Controller {
	public function __construct(){
			parent::__construct();
			set_time_limit(0);
		}
	public function update_shipping_address(){
		$Q2 = $this->db->select("*")->get("db_customers");
		if($Q2->num_rows()>0){
			foreach($Q2->result() as $res){
				//Insert Shipping Address
				    $shipping_address_details = array(
				    									'store_id'		=>$res->store_id,
				    									'country_id'	=>$res->country_id,
				    									'state_id'		=>$res->state_id,
				    									'city'			=>$res->city,
				    									'postcode'		=>$res->postcode,
				    									'address'		=>$res->address,
				    									'customer_id'	=>$res->id,
				    									'location_link'	=>$res->location_link,
				    									'status'		=>1,
				    								);

				    $Q3 = $this->db->insert('db_shippingaddress', $shipping_address_details);
				    if(!$Q3){
				    	return false;
				    }
				    $shipping_address_id=$this->db->insert_id();


				    //Update shipping address to customer
					$Q4 = $this->db->set('shippingaddress_id',$shipping_address_id)->where('id',$res->id)->update('db_customers');
					if(!$Q4){
				    	return false;
				    }
				    //end
				}//foreach
		}
		return true;
	}
	public function update_db(){
		$current_app_version = $this->get_current_version_of_db();
		if($current_app_version==$this->source_version){
			echo "Database Already Updated!";
			exit();
		}

		//Update database
		$this->db->trans_begin();
		$current_db_name=$this->db->database;


		if($current_app_version=='2.0'){
			//Provide 2.1 updates 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.1' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'gstr_1_report')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'gstr_2_report')");if(!$q1){ echo "failed"; exit();}
		}//end 2.1

		else if($current_app_version=='2.1'){
			//Provide 2.2 updates  Date: 20-06-2021
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.2' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			
		}//end 2.2

		else if($current_app_version=='2.2'){
			//Provide 2.2 updates  Date: 03-09-2021
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.3' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_customers` ADD COLUMN `credit_limit` DOUBLE(20,4) NULL AFTER `tot_advance`");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `due_date` DATE NULL AFTER `sales_date`");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salespayments` ADD COLUMN `cheque_number` VARCHAR(100) NULL AFTER `advance_adjusted`, ADD COLUMN `cheque_period` INT(10) NULL AFTER `cheque_number`");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salespayments` ADD COLUMN `cheque_status` INT(1) NULL COMMENT 'used or not used' AFTER `cheque_period`");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salespayments` CHANGE `cheque_status` `cheque_status` VARCHAR(100) NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_customers` CHANGE `credit_limit` `credit_limit` DOUBLE(20,4) DEFAULT -1 NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_customers` SET `credit_limit`='-1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("CREATE TABLE `db_shippingaddress`( `id` INT(10), `store_id` INT(10), `country_id` INT(10), `state_id` INT(10), `city` VARCHAR(100), `postcode` VARCHAR(20), `address` TEXT, `status` INT(1), `customer_id` INT(10), FOREIGN KEY (`customer_id`) REFERENCES `db_customers`(`id`) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY (`store_id`) REFERENCES `db_store`(`id`) ON UPDATE CASCADE ON DELETE CASCADE )");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_customers` ADD COLUMN `shippingaddress_id` INT(10) NULL ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_shippingaddress` CHANGE `id` `id` INT(10) NULL AUTO_INCREMENT, ADD KEY(`id`)");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_shippingaddress` ADD COLUMN `location_link` TEXT NULL AFTER `customer_id`; ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_users` SET `status` = '0' WHERE `id` = '1';");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->update_shipping_address();
			if(!$q1){ echo "failed"; exit();}
			
		}//end 2.3
		else if($current_app_version=='2.3'){
			//Provide 2.4 updates  Date: 10-09-2021
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.4' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}

			$q1 = $this->db->query("ALTER TABLE `ci_sessions` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `ac_accounts` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `ac_transactions` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_instamojopayments` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_paypalpaylog` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_stocktransfer` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_stocktransferitems` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_stripepayments` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_userswarehouses` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_warehouseitems` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}

			$q1 = $this->db->query("ALTER TABLE `ac_moneydeposits` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}

			$q1 = $this->db->query("ALTER TABLE `ac_moneytransfer` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_custadvance` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_customer_payments` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_instamojo` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_paypal` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_shippingaddress` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_stripe` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_subscription` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_supplier_payments` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_twilio` ENGINE=INNODB, CHARSET=utf8mb4, COLLATE=utf8mb4_unicode_ci");if(!$q1){ echo "failed"; exit();}




			$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `init_code` VARCHAR(100) NULL AFTER `warehouse_id`; ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` CHANGE `count_id` `count_id` VARCHAR(20) NULL COMMENT 'Use to create Sales Code'");if(!$q1){ echo "failed"; exit();}

			//Update Sales Invoice number
			$q1 = $this->update_sales_invoice_numbers();
			if(!$q1){ echo "failed"; exit();}


		}//2.4

		if($current_app_version=='2.4'){
			//Provide 2.4.1 updates 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.4.1' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'delivery_sheet_report')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'load_sheet_report')");if(!$q1){ echo "failed"; exit();}
		}//end 2.4.1

		if($current_app_version=='2.4.1'){
			//Provide 2.5 updates 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.5' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_items` ADD COLUMN `discount_type` VARCHAR(100) NULL AFTER `status`, ADD COLUMN `discount` DOUBLE(20,2) NULL AFTER `discount_type`");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_items` SET `discount_type` = 'Percentage' , `discount` = '0'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_items` ADD COLUMN `mrp` DOUBLE(20,4) NULL ");if(!$q1){ echo "failed"; exit();}

			//Copy Paste Sales price to MRP
			$q1 = $this->update_mrp_if_items();
			if(!$q1){ echo "failed"; exit();}

			$q1 = $this->db->query("ALTER TABLE `db_store` ADD COLUMN `mrp_column` INT(1) DEFAULT 0 NULL");if(!$q1){ echo "failed"; exit();}

			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'show_purchase_price')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'customer_orders_report')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_permissions` SET `store_id` = '1' WHERE role_id=2 AND permissions='delivery_sheet_report'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_permissions` SET `store_id` = '1' WHERE role_id=2 AND permissions='load_sheet_report'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_permissions` SET `store_id` = '1' WHERE role_id=2 AND permissions='gstr_1_report'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_permissions` SET `store_id` = '1' WHERE role_id=2 AND permissions='gstr_2_report'");if(!$q1){ echo "failed"; exit();}


			
			
		}//end 2.5
		if($current_app_version=='2.5'){
			//Provide 2.6 updates 
			//WhatsApp 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.5.1' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'discountCouponAdd'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'discountCouponEdit'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'discountCouponDelete'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'discountCouponView'); ");if(!$q1){ echo "failed"; exit();}
			
			$q1 = $this->db->query("CREATE TABLE `db_coupons` (
						  `id` int(5) NOT NULL AUTO_INCREMENT,
						  `store_id` int(11) DEFAULT NULL,
						  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `description` text COLLATE utf8mb4_unicode_ci,
						  `value` double(20,2) DEFAULT NULL,
						  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `expire_date` date DEFAULT NULL,
						  `status` int(1) DEFAULT NULL,
						  `create_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `created_date` date DEFAULT NULL,
						  `created_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `system_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  `system_ip` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
						  PRIMARY KEY (`id`),
						  KEY `store_id` (`store_id`),
						  CONSTRAINT `db_coupons_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `db_store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
						  CONSTRAINT `db_coupons_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `db_store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
						) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
						");if(!$q1){ echo "failed"; exit();}
			
			$q1 = $this->db->query("ALTER TABLE `db_coupons` CHANGE `create_by` `created_by` VARCHAR(100) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");if(!$q1){ echo "failed"; exit();}
			
		
			/*Sales & Purchase GST Report*/
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'sales_gst_report')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'purchase_gst_report')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('2', '2', 'subscription')");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("
				ALTER TABLE `db_subscription` ADD COLUMN `payment_type` VARCHAR(250) NULL COMMENT 'manual subscription only' AFTER `package_status`, ADD COLUMN `package_count` INT(10) NULL COMMENT 'manual subscription only' AFTER `payment_type`
				");if(!$q1){ echo "failed"; exit();}

			
			
		}//end 2.5.1

		if($current_app_version=='2.5.1'){
			//Provide 2.5.1 updates oman ghost
			//WhatsApp 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.5.2' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salespayments` CHANGE `created_time` `created_time` VARCHAR(50) NULL; ");if(!$q1){ echo "failed"; exit();}
			
			$q1 = $this->db->query("
						CREATE TABLE `db_customer_coupons` (
					  `id` int(5) NOT NULL AUTO_INCREMENT,
					  `store_id` int(11) DEFAULT NULL,
					  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `description` text COLLATE utf8mb4_unicode_ci,
					  `value` double(20,2) DEFAULT NULL,
					  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `expire_date` date DEFAULT NULL,
					  `status` int(1) DEFAULT NULL,
					  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `created_date` date DEFAULT NULL,
					  `created_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `system_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `system_ip` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  PRIMARY KEY (`id`),
					  KEY `store_id` (`store_id`),
					  CONSTRAINT `db_customer_coupons_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `db_store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
					  CONSTRAINT `db_customer_coupons_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `db_store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
					) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

				");if(!$q1){ echo "failed"; exit();}
			
			$q1 = $this->db->query("ALTER TABLE `db_customer_coupons` ADD COLUMN `customer_id` INT(10) NULL, ADD FOREIGN KEY (`customer_id`) REFERENCES `db_customers`(`id`) ON UPDATE CASCADE ON DELETE CASCADE; ");if(!$q1){ echo "failed"; exit();}


			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'customerCouponAdd'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'customerCouponEdit'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'customerCouponDelete'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'customerCouponView'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `coupon_id` INT(10) NULL AFTER `quotation_id`, ADD FOREIGN KEY (`coupon_id`) REFERENCES `db_customer_coupons`(`id`) ON UPDATE CASCADE ON DELETE CASCADE");if(!$q1){ echo "failed"; exit();}
			//$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `coupon_code` VARCHAR(250) NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `coupon_amt` DOUBLE(20,2) NULL ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_customer_coupons` ADD COLUMN `coupon_id` INT(10) NULL AFTER `customer_id`, ADD FOREIGN KEY (`coupon_id`) REFERENCES `db_coupons`(`id`) ON UPDATE CASCADE ON DELETE CASCADE");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salesreturn` ADD COLUMN `coupon_id` INT NULL AFTER `return_bit`, ADD COLUMN `coupon_amt` DOUBLE(20,4) NULL AFTER `coupon_id`, ADD FOREIGN KEY (`coupon_id`) REFERENCES `db_customer_coupons`(`id`) ON UPDATE CASCADE ON DELETE CASCADE");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` CHANGE `coupon_amt` `coupon_amt` DOUBLE(20,2) DEFAULT 0 NULL; ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salesreturn` CHANGE `coupon_amt` `coupon_amt` DOUBLE(20,2) DEFAULT 0 NULL; ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` CHANGE `count_id` `count_id` INT(20) NULL COMMENT 'Use to create Sales Code'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_store` ADD COLUMN `invoice_terms` TEXT NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_sales` ADD COLUMN `invoice_terms` TEXT NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("CREATE TABLE `db_bankdetails`( `id` INT(5) NOT NULL AUTO_INCREMENT, `store_id` INT(5), `country_id` INT(5), `holder_name` VARCHAR(250), `bank_name` VARCHAR(250), `branch_name` VARCHAR(250), `code` VARCHAR(250) COMMENT 'IFSC or Bank Code', `account_type` VARCHAR(250), `account_number` VARCHAR(250), `other_details` TEXT, `description` TEXT, `status` INT(5), PRIMARY KEY (`id`), FOREIGN KEY (`store_id`) REFERENCES `db_store`(`id`) ON UPDATE CASCADE ); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("INSERT INTO `db_bankdetails` (`id`, `store_id`, `status`) VALUES ('1', '1', '1')");if(!$q1){ echo "failed"; exit();}


			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'return_items_report'); ");if(!$q1){ echo "failed"; exit();}


		}//end 2.5.2

		if($current_app_version=='2.5.2'){
			//Provide 2.6 updates oman ghost
			//WhatsApp 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.6' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salesitems` ADD COLUMN `purchase_price` DOUBLE(20,3) DEFAULT 0 NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_salesitemsreturn` ADD COLUMN `purchase_price` DOUBLE(20,3) DEFAULT 0 NULL");if(!$q1){ echo "failed"; exit();}

			if(!$this->update_purchase_price_of_sales_and_return()){
				echo "failed"; exit();
			}

			$q1 = $this->db->query("INSERT INTO `db_permissions` (`store_id`, `role_id`, `permissions`) VALUES ('1', '2', 'help_link'); ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_custadvance` CHANGE `amount` `amount` DOUBLE(20,4) NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_store` ADD COLUMN `previous_balance_bit` INT(1) DEFAULT 1 NULL COMMENT '1=Show, 0=Hide - Shows on sales invoice' AFTER `invoice_terms`; ");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_customers` SET sales_return_due = 0 WHERE store_id=1");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE `db_users` SET `status` = '1' WHERE `id` = '1';");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("ALTER TABLE `db_items` CHANGE `discount_type` `discount_type` VARCHAR (100) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Percentage' NULL,CHANGE `discount` `discount` DOUBLE (20, 2) DEFAULT 0 NULL");if(!$q1){ echo "failed"; exit();}
			$q1 = $this->db->query("UPDATE db_items SET discount_type='Percentage', discount = 0 WHERE discount_type IS NULL");if(!$q1){ echo "failed"; exit();}


		}//end 2.6

		if($current_app_version=='2.6'){
			//Provide 2.7 updates oman ghost
			//WhatsApp 
			$q1 = $this->db->query("UPDATE `db_sitesettings` SET `version` = '2.7' WHERE `id` = '1'");if(!$q1){ echo "failed"; exit();}
		}//end 2.7

		


	
		$this->db->trans_commit();
		redirect(base_url('login'),'refresh');
	}

	public function update_mrp_if_items(){

		$q2= $this->db->query("select * from db_items");
		
		if($q2->num_rows()>0){
			foreach($q2->result() as $res2){
				
					
					$q3 = $this->db->set("mrp", $res2->sales_price)
									->where("id",$res2->id)
									->update("db_items");

					if(!$q3){
						return false;
					}
				

			}
		}
		return true;
		
	}

	public function update_sales_invoice_numbers(){

		$q2= $this->db->query("select * from db_sales");
		
		if($q2->num_rows()>0){
			foreach($q2->result() as $res2){
				$sales_code = $res2->sales_code;
				$count_id = $res2->count_id;

				if(!empty($sales_code)){
					//Filter sales code
					preg_match_all('!\d+!', $sales_code, $matches);
					$array_count = count($matches[0]);
					$count_id = $matches[0][$array_count-1];

					$init_code = str_replace($count_id, '', $sales_code);
					
					$q3 = $this->db->set("init_code", $init_code)
									->set("count_id", $count_id)
									->where("id",$res2->id)
									->update("db_sales");

					if(!$q3){
						return false;
					}
				}//!empty	

			}
		}
		return true;
		
	}
	//Update in 2.5.3
	public function update_purchase_price_of_sales_and_return(){
		$q1 = $this->db->query("select * from `db_items`");
		if($q1->num_rows()>0){
			foreach($q1->result() as $res1){
				//SALES 
				$q2 = $this->db
								->set("purchase_price",$res1->purchase_price)
								->where("item_id",$res1->id)
								->update("db_salesitems");
				if(!$q2){
					return false;
				}

				//SALES RETURN
				$q3 = $this->db
								->set("purchase_price",$res1->purchase_price)
								->where("item_id",$res1->id)
								->update("db_salesitemsreturn");
				if(!$q3){
					return false;
				}				
			}
		}
		return true;
	}
}