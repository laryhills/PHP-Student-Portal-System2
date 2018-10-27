$(document).ready(function(){
	var old_password ="";
	var new_password = "";
	var old_password_regex =/^[a-zA-Z0-9$,&?!^%/@#*()-]{8,}$/;


	//=== Old Password Validation ===
	// $("#student_password1").focusout(function(){
	var oldPassValidation = function() {

			var stud_reg_no = $("#student_reg_no").val();
			var old_store = $.trim($("#student_password1").val());
			 if(old_password_regex.test(old_store)){
				$("#student_password1").addClass("border-green");
				$("#student_password1").removeClass("border-red");
	      // $(".old-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Valid</div');
	      $(".old-error").html("");
	      // old_password = old_store;
	      $.ajax({
          type:'POST',
          url:'ajax/studUpdate.php?update=check',
          dataType:'JSON',
          beforeSend: function(){
             $(".old-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
          },
           data:{'check_password': old_store,'student_reg_no': stud_reg_no},
          // data:{'check_password': old_store},
          success: function(suc){
            setTimeout(function(){
              if (suc['result'] == 'success') {
                $("#student_password1").addClass("border-green");
								$("#student_password1").removeClass("border-red");
	      			  $(".old-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Valid</div');
              old_password = old_store;
                }else if (suc['result'] == 'failed') {
                $(".old-error").html(suc['message']);
                $("#student_password1").addClass("border-red");
                $("#student_password1").removeClass("border-green");
                old_password = "";

              }
            },1000); 
          }
        })
	    }else{
	  		$(".old-error").html('<div class="text-danger"><i class="fa fa-times"></i> Invalid</div');
	  		$("#student_password1").addClass("border-red");
	  		$("#student_password1").removeClass("border-green");
	  		old_password ="";
		}
	}
	$('#student_password1')
    .keyup(oldPassValidation)
    .keypress(oldPassValidation)
    .focusout(oldPassValidation)
	//=== End of Old Password Validation ===
	//=== New Password Validation ===
	//$("#student_password2").focusout(function(){
	// $("#student_password2").on("keypress keyup keydown", function() {
	var newPassValidation = function() {

			var new_store = $.trim($("#student_password2").val());
			errors =[];
		if (new_store.length != "" && new_store.length < 8) {
      	errors.push("Password must be at least 8 characters !!!");
    	}
    	if (new_store.length != "" && new_store.search(/(?=.*[0-9])/) < 0) {
      errors.push("Password must contain at least one digit !!!");
   	  }
    	if (new_store.length != "" && new_store.search(/(?=.*[A-Z])/) < 0) {
    	  errors.push("Password must contain at least one uppercase !!!");
    	}
    	if (new_store.length != "" && new_store.search(/(?=.*[$,&?!^%/@#*])/) < 0) {
    	  errors.push("Password must contain at least one special character !!!");
    	}	
    	if (new_store.length == ""){
    		$(".new-error").html("");
      	$("#student_password2").removeClass("border-red");
      	$("#student_password2").removeClass("border-green");
      	new_password="";
    	}else
			if (errors.length > 0) {
      $(".new-error").html(errors[0]);
      $("#student_password2").addClass("border-red");
      $("#student_password2").removeClass("border-green");
      $("#tip").hide();
      new_password="";
    }else{
      $("#student_password2").addClass("border-green");
      $("#student_password2").removeClass("border-red");
      $(".new-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Your Password is Strong !!!</div');
     	$("#tip").hide();
     	new_password=new_store;
    }
	}
	$('#student_password2')
    .keyup(newPassValidation)
    .keypress(newPassValidation)
    .focusout(newPassValidation)
    //=== End of New Password Validation ===
		//=== Submit Form ===
	 $(document).on("submit", "form.updateStudent", function(event){
      event.preventDefault();
      var test_pwd = $.trim($("#student_password1").val());
      var stud_reg_no = $("#student_reg_no").val();
      if (test_pwd.length == "") {
        $(".old-error").html("Old Password is Required !!!");
        $("#student_password1").addClass("border-red");
        $("#student_password1").removeClass("border-green");
        old_password="";
      }
      if ((old_password.localeCompare(test_pwd) ) != 0) {
// localeCompare() method. The method returns 0 if both the strings are equal
//-1 if string 1 is sorted before string 2
//1 if string 2 is sorted before string 1.      	
         $(".old-error").html("Please Re-Type Password !!!");
         $("#student_password1").addClass("border-red");
         $("#student_password1").removeClass("border-green");
         $("#student_password1").val("");
      }
      if (new_password == "") {
         $(".new-error").html("New Password is Required !!!");
         $("#student_password").addClass("border-red");
         $("#student_password").removeClass("border-green");
         $("#tip").hide();
         // $("#msg").show();
      }
      if ((old_password.localeCompare(new_password) ) == 0) {
      	$("#eMsg").html("Please Choose a Different Password").show();
      }else{
      // if (old_password.length != "" && new_password.length != "") {
        $.ajax({
          type:'POST',
          url:'ajax/studUpdate.php?update=true',
          data:$("#updateStudent").serialize(),
          dataType:'JSON',
          success: function(result){
              if (result['outcome'] == 'success') {
              	 $("#eMsg").hide();
                $("#sMsg").html("Password Changed!!!").show();
             }

            },
           // success : function(data){
           //  $('.fetched-data').html(data);//Show fetched data from database
           //  }
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          }  
        })
      }
 
      return false;
  })//=== End of Submit Form ===
})