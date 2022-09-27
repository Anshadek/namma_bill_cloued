<!DOCTYPE html>
<html>
<head>
<title><?=$page_title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=base_url('theme/css/print-coupon.css')?>">  
</head>
<body>
<?php 
    $CI =& get_instance();
    $store_rec = get_store_details();
    $store_logo=(!empty($store_rec->store_logo)) ? base_url($store_rec->store_logo) : base_url(store_demo_logo());
    $coupon_details = get_customer_coupon_details($coupon_id);  
    $coupon_master = get_coupon_master_details($coupon_details->coupon_id);
    $coupon_value = ($coupon_details->type=='Percentage') ? $coupon_details->value .'%' : $CI->currency($coupon_details->value);
    
?>
<div class="coupon">
  <div class="container">
    <h3><?= $this->session->userdata('store_name'); ?></h3>
  </div>
  <img src="<?=$store_logo?>" alt="Avatar" style="width:100%; height: 150px">
  <div class="container" style="background-color:white">
    <h2><b><?=$coupon_value?> OFF ON YOUR EACH PURCHASE</b></h2> 
    <p><?= nl2br($coupon_master->description) ?></p>
  </div>
  <div class="container">
    <p>Use Promo Code: <span class="promo"><?=$coupon_details->code?></span></p>
    <p class="expire">Expires: <?=show_date($coupon_details->expire_date)?></p>
  </div>

  <img src="<?= base_url('barcode/get_barcode/'.$coupon_details->code);?>" alt="Avatar" style="width:100%; height: 150px">

  <!-- <div style="display:inline-block;vertical-align:middle;line-height:16px !important;"> 
    <img class="center-block" style=" width: 100%; opacity: 1.0" src="<?= base_url('barcode/get_barcode/'.$coupon_details->code);?>"> -->
  </div>
</div>

</body>
</html> 
