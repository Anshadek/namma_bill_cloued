//appending customers based on warehouse_id

function get_warehouse_customers(datas){
			var warehouse_id = 0;
			var selected = $('#selected_warehouse').val();
			if (selected > 0){

			}else{
				selected = 0;
			}
			
			if (datas > 0){
				warehouse_id = datas;
			}else{
				warehouse_id = datas.value;
			}
			
			
			var base_url = $('#base_url').val();
			$.ajax({
				url: base_url+'customers/get_warehouse_customers_select_list',
				type: "post",
				data: {
					//store_id: $("#store_id").val(),
					warehouse_id : warehouse_id,
					selected : selected,
					
				},
				beforeSend: function() {
					$('.ajax-load').show();
				}
			}).done(function(data) {
				$('#customer_id').html(data);

			}).fail(function(jqXHR, ajaxOptions, thrownError) {
				alert('server not responding...');
			});
}

function get_warehouse_accounts(datas){
	var warehouse_id = 0;
	var selected = $('#selected_warehouse').val();
	if (datas > 0){
		warehouse_id = datas;
	}else{
		warehouse_id = datas.value;
	}
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Money_transfer/get_warehouse_accounts_select_list',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			selected : selected,
			warehouse_id: warehouse_id,
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#debit_account_id').html(data);
		$('#credit_account_id').html(data);
		

	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});
}

function get_warehouse_accounts_expense(datas){
	var warehouse_id = 0;
	var selected = $('#selected_warehouse').val();
	if (datas > 0){
		warehouse_id = datas;
	}else{
		warehouse_id = datas.value;
	}
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Money_transfer/get_warehouse_accounts_select_list',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			selected : selected,
			warehouse_id: warehouse_id,
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#account_id').html(data);
	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});


	
}
function get_warehouse_accounts_select_list(datas){
	var warehouse_id = 0;
	var selected = $('#selected_warehouse').val();
	if (datas > 0){
		warehouse_id = datas;
	}else{
		warehouse_id = datas.value;
	}
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Money_transfer/get_warehouse_accounts_select_list_for_create_account',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			selected : selected,
			warehouse_id: warehouse_id,
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#parent_id').html(data);
		//$('#credit_account_id').html(data);
		

	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});
}
function get_warehouse_expense_category(datas){
	var warehouse_id = 0;
	var selected = $('#selected_warehouse').val();
	if (datas > 0){
		warehouse_id = datas;
	}else{
		warehouse_id = datas.value;
	}
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'expense/get_warehouse_expense_category',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			selected : selected,
			warehouse_id: warehouse_id,
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#category_id').html(data);
		//$('#credit_account_id').html(data);
		

	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});
}
