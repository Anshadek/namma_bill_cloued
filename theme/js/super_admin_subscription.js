/*Email validation code*/
function validateEmail(sEmail) {
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (filter.test(sEmail)) {
    return true;
  }
  else {
    return false;
  }
}
$('#save,#update').on("click", function (e) {
  var base_url = $("#base_url").val();
  //Initially flag set true
  var flag = true;

  function check_field(id) {
    if (!$("#" + id).val()) //Also check Others????
    {
      $('#' + id + '_msg').fadeIn(200).show().html('Required Field').addClass('required');
      // $('#'+id).css({'background-color' : '#E8E2E9'});
      flag = false;
    }
    else {
      $('#' + id + '_msg').fadeOut(200).hide();
      //$('#'+id).css({'background-color' : '#FFFFFF'});    //White color
    }
  }

  //STORE
  //check_field("store_code");if(flag==false){$("#tab_4_btn").trigger('click');}
  check_field("name");
	check_field("amount");
	check_field("validity");
	if ($('#is_unlimited').val() == 0){
	check_field("user_count");
	check_field("warehouse_count");
	}
	check_field("is_unlimited");
  if (flag == false) {
    toastr["warning"]("You have Missed Something to Fillup!")
    return;
  }
  var this_id = this.id;
  if (confirm("Do You Wants To Save Or Update Record ?")) {
    e.preventDefault();
    data = new FormData($('#subscription-form')[0]);//form name
    /*Check XSS Code*/
    if (!xss_validation(data)) { return false; }

    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $("#" + this_id).attr('disabled', true);  //Enable Save or Update button
    $.ajax({
      type: 'POST',
      url: base_url + 'super_admin/create_subscription',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        //alert(result);return;
        if (result == "success") {
          toastr["success"]("Record Updated Successfully!");
          window.location.replace(base_url+'super_admin/subscription');
        }
        else if (result == "failed") {
          toastr["error"]("Sorry! Failed to save Record.Try again!");
          //	return;
        }
        else {
         
          toastr["error"](result);
        }
        $("#" + this_id).attr('disabled', false);  //Enable Save or Update button
        $(".overlay").remove();
      }
    });
  }

  //e.preventDefault

});


//On Enter Move the cursor to desigtation Id
function shift_cursor(kevent, target) {

  if (kevent.keyCode == 13) {
    $("#" + target).focus();
  }

}


//Active-Inactive the status
function update_status(id, status) {
  var base_url = $("#base_url").val();
  $.post(base_url + "super_admin/subscription_status_update", { id: id, status: status }, function (result) {
    //alert(result);return;
    if (result == "success") {
      toastr["success"]("Record Updated Successfully!");
      success.currentTime = 0;
      success.play();
      if (status == 0) {
        status = "Inactive";
        var span_class = "label label-danger";
        $("#span_" + id).attr('onclick', 'update_status(' + id + ',1)');
      }
      else {
        status = "Active";
        var span_class = "label label-success";
        $("#span_" + id).attr('onclick', 'update_status(' + id + ',0)');
      }

      $("#span_" + id).attr('class', span_class);
      $("#span_" + id).html(status);

    }
    else if (result == "failed") {
      toastr["error"]("Failed to Update Status.Try again!");
      failed.currentTime = 0;
      failed.play();
    }
    else {
      toastr["error"]("Error! Something Went Wrong!");
      failed.currentTime = 0;
      failed.play();
    }
    return false;
  });
}

function update_primary_status(id,cat_id,status) {
  var base_url = $("#base_url").val();
  $.post(base_url + "super_admin/subscription_primary_status_update", { id: id,cat_id:cat_id }, function (result) {
    //alert(result);return;
    if (result == "success") {
      toastr["success"]("Record Updated Successfully!");
      success.currentTime = 0;
    	window.location.replace(base_url+'super_admin/subscription');

    }
    else if (result == "failed") {
      toastr["error"]("Failed to Update Status.Try again!");
      failed.currentTime = 0;
      failed.play();
    }
    else {
      toastr["error"]("Error! Something Went Wrong!");
      failed.currentTime = 0;
      failed.play();
    }
    return false;
  });
}

