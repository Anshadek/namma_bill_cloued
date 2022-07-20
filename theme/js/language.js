//Change language
$(".language_id").on("change",function(){
	var base_url = $("#base_url").val();
	var language_id = $(this).val();
	//alert(language_id);
	window.location = base_url+"login/langauge/"+language_id;
});