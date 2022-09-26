//appending customers based on warehouse_id

function get_states(datas){
	
	
			var country = 0;
			var selected_state = $('#selected_state').val();
		
			if (datas != ""){
				country = datas;
			}else{
				country = $(datas).find("option:selected").text();
				
			}
			
			
			var base_url = $('#base_url').val();
			$.ajax({
				url: base_url+'state/get_state_select_list',
				type: "post",
				data: {
					//store_id: $("#store_id").val(),
					country : country,
					selected : selected_state,
					
					
				},
				beforeSend: function() {
					$('.ajax-load').show();
				}
			}).done(function(data) {
				$('#state').html(data);

			}).fail(function(jqXHR, ajaxOptions, thrownError) {
				alert('server not responding...');
			});
}

function get_shipping_states(datas){
	var country = 0;
	var selected = $('#selected_warehouse').val();
	if (selected > 0){

	}else{
		selected = 0;
	}
	
	if (datas > 0){
		country = datas;
	}else{
		country = $(datas).find("option:selected").text();
		
	}
	
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'state/get_state_select_list',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			country : country,
			
			
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#shipping_state').html(data);

	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});
}

function get_states_signup(datas){
	
	var country = 0;
	var selected = $('#selected_warehouse').val();
	if (selected > 0){

	}else{
		selected = 0;
	}
	
	if (datas > 0){
		country = datas;
	}else{
		country = $(datas).find("option:selected").text();
		
	}
	
	
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'sign_up/get_state_select_list',
		type: "post",
		data: {
			//store_id: $("#store_id").val(),
			country : country,
			
			
		},
		beforeSend: function() {
			$('.ajax-load').show();
		}
	}).done(function(data) {
		$('#state').html(data);

	}).fail(function(jqXHR, ajaxOptions, thrownError) {
		alert('server not responding...');
	});
}

