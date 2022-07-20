/* items modal start*/
$(".add_item").click(function(e){
	var base_url=$("#base_url").val().trim();
    //Initially flag set true
    var flag=true;
    function check_field(id){
	  if(!$("#"+id).val().trim() ) //Also check Others????
	    {

	        $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
	        $('#'+id).css({'background-color' : '#E8E2E9'});
	        flag= false;
	    }
	    else
	    {
	         $('#'+id+'_msg').fadeOut(200).hide();
	         $('#'+id).css({'background-color' : '#FFFFFF'});    //White color
	    }
	}
    //Validate Input box or selection box should not be blank or empty
	check_field("m_item_name");
	check_field("m_category_id");
	check_field("m_unit_id");
	check_field("m_price");
	check_field("m_tax_id");
	check_field("m_purchase_price");
	check_field("m_tax_type");
	check_field("m_sales_price");
	
	
    if(flag==false)
    {
		toastr["warning"]("You have Missed Something to Fillup!");
		return;
    }
  
    var this_id=this.id;
			if(confirm("Are you Sure ?")){
				e.preventDefault();
				data = new FormData($('#item-form')[0]);//form name
				/*Check XSS Code*/
				if(!xss_validation(data)){ return false; }
				
				$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
				$("#"+this_id).attr('disabled',true);  //Enable Save or Update button
				$.ajax({
				type: 'POST',
				url: base_url+'items/addItemFromModal',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result){
      				//alert(result);//return;
      				//var data = jQuery.parseJSON(result);
					if(result=="success")
					{   
						$('#item-modal').modal('toggle');
					   	var newOption = '<option value='+data.id+' selected>'+data.item_name+'</option>';
					    $('#item_id').append(newOption).trigger('change');
					    //$("#amount").val(data.advance);
					     $('#item-form')[0].reset();
					     toastr["success"]("New item Added!!");
					    success.currentTime = 0;
						success.play();
					}
					else if(result=="failed")
					{
					   toastr["error"]("Sorry! Failed to save Record.Try again!");
					   failed.currentTime = 0;
						failed.play();
					}
					else
					{
					   toastr["error"](result);
					   failed.currentTime = 0;
						failed.play();
					}
					$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
					$(".overlay").remove();

			   }
			   });
		} //confirmation sure
		

		//e.preventDefault
});
/* items modal end */

//CALCULATED PURCHASE PRICE
function calculate_purchase_price(){
	var price = (isNaN(parseFloat($("#m_price").val().trim()))) ? 0 :parseFloat($("#m_price").val().trim()); 
	var tax = (isNaN(parseFloat($('option:selected', "#m_tax_id").attr('data-tax')))) ? 0 :parseFloat($('option:selected', "#m_tax_id").attr('data-tax')); 
	tax = parseFloat(tax);

	var tax_type = $("#m_tax_type").val();
	var purchase_price =parseFloat(0);
		price =parseFloat(price);

	if(tax_type=='Inclusive'){
			purchase_price =price;
	}
	else{
		purchase_price = (price + (price*tax)/parseFloat(100));
	}
	//$("#purchase_price").val( (price + (price*tax)/parseFloat(100)).toFixed(decimals));
	
	$("#m_purchase_price").val(purchase_price.toFixed(2));
	//calculate_item_sales_price();

	//$("#purchase_price").val( (price + (price*tax)/parseFloat(100)).toFixed(2));
	//calculate_item_sales_price();
}
$("#m_price").keyup(function(event) {
	calculate_purchase_price();
});
$("#m_tax_id").change(function(event) {
	calculate_purchase_price();
});

//CALCUALATED SALES PRICE
function calculate_item_sales_price(){
	//var purchase_price = (isNaN(parseFloat($("#price").val().trim()))) ? 0 :parseFloat($("#price").val().trim()); 
	var profit_margin = (isNaN(parseFloat($("#m_profit_margin").val().trim()))) ? 0 :parseFloat($("#m_profit_margin").val().trim()); 
	var tax_type = $("#m_tax_type").val();
	var sales_price =parseFloat(0);
	/*if(tax_type=='Inclusive'){
		sales_price = purchase_price + ((purchase_price*profit_margin)/parseFloat(100));
	}
	else{*/
		var price = (isNaN(parseFloat($("#m_price").val().trim()))) ? 0 :parseFloat($("#m_price").val().trim()); 
		sales_price = price + ((price*profit_margin)/parseFloat(100));
	//}
	$("#m_sales_price").val(sales_price.toFixed(2));
	calculate_item_profit_margin();
}
$("#m_tax_type").change(function(event) {
	calculate_purchase_price();
});
$("#m_profit_margin").change(function(event) {
	calculate_item_sales_price();
});
//END
//CALCULATE PROFIT MARGIN PERCENTAGE
function calculate_item_profit_margin(){
	var purchase_price = (isNaN(parseFloat($("#m_price").val().trim()))) ? 0 :parseFloat($("#m_price").val().trim()); 
	var sales_price = (isNaN(parseFloat($("#m_sales_price").val().trim()))) ? 0 :parseFloat($("#m_sales_price").val().trim()); 	
	var profit_margin = (sales_price-purchase_price);
	var profit_margin = (profit_margin/purchase_price)*parseFloat(100);
	$("#m_profit_margin").val(profit_margin.toFixed(0));
}
$("#m_sales_price").change(function(event) {
	calculate_item_profit_margin();
});
//END

//Item & Serivice modal click
$(".show_item_modal").on("click", function(){
	$('#item-or-service').modal('hide');
	setTimeout(function() {
    $('#item-modal').modal('show');
  }, 1000);
});
$(".show_service_modal").on("click", function(){
	$('#item-or-service').modal('hide');
		setTimeout(function() {
	    $('#service-modal').modal('show');
	  }, 1000);
});
$(".show_item_service").on("click", function(){
	//$('#item-or-service').modal('show');
	$('#item-modal').modal('show');
});
//end
/* items modal start*/
$(".add_service").click(function(e){
	alert("Add service");
	var base_url=$("#base_url").val().trim();
    //Initially flag set true
    var flag=true;
    function check_field(id){
	  if(!$("#"+id).val().trim() ) //Also check Others????
	    {

	        $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
	        $('#'+id).css({'background-color' : '#E8E2E9'});
	        flag= false;
	    }
	    else
	    {
	         $('#'+id+'_msg').fadeOut(200).hide();
	         $('#'+id).css({'background-color' : '#FFFFFF'});    //White color
	    }
	}
    //Validate Input box or selection box should not be blank or empty
	/*check_field("item_name");
	check_field("category_id");
	check_field("price");
	check_field("tax_id");
	check_field("tax_type");
	check_field("sales_price");*/
	
	
    if(flag==false)
    {
		toastr["warning"]("You have Missed Something to Fillup!");
		return;
    }
  
    var this_id=this.id;
			if(confirm("Are you Sure ?")){
				e.preventDefault();
				data = new FormData($('#service-form')[0]);//form name
				/*Check XSS Code*/
				if(!xss_validation(data)){ return false; }
				
				$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
				$("#"+this_id).attr('disabled',true);  //Enable Save or Update button
				$.ajax({
				type: 'POST',
				url: base_url+'services/newservices',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result){
      				//alert(result);//return;
      				//var data = jQuery.parseJSON(result);
					if(result=="success")
					{   
						$('#item-modal').modal('toggle');
					   	var newOption = '<option value='+data.id+' selected>'+data.item_name+'</option>';
					    $('#item_id').append(newOption).trigger('change');
					    //$("#amount").val(data.advance);
					     $('#item-form')[0].reset();
					     toastr["success"]("New Service Item Added!!");
					    success.currentTime = 0;
						success.play();
					}
					else if(result=="failed")
					{
					   toastr["error"]("Sorry! Failed to save Record.Try again!");
					   failed.currentTime = 0;
						failed.play();
					}
					else
					{
					   toastr["error"](result);
					   failed.currentTime = 0;
						failed.play();
					}
					$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
					$(".overlay").remove();

			   }
			   });
		} //confirmation sure
		

		//e.preventDefault
});
/* items modal end */



function calc_pur_price(){
	
}