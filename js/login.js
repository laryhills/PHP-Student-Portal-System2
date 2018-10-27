// var password = "MySuper4PassPhrase1";
// var pattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]+$/;
// if (pattern.test(password)) {
// 	alert("valid password")
// }else{
// 	alert("invalid password")
// }

$(document).ready(function(){
	var stud_reg_no="";
	var stud_password="";
	var stud_reg_no_regex=/^[A-Z]{6}((18[\d]{3})|[ADMINadmin]{5})?$/;
	var stud_password_regex =/^[a-zA-Z0-9]{8,}$/;

	//===Student Reg No Validation===
  var StudentRegNoValidation = function() {
	// $("#student_reg_no").focusout(function(){

		var store = $.trim($("#student_reg_no").val());
		if (store.length == "") {

			$(".name-error").html("Student Reg No is Required !!!");
			$("#student_reg_no").addClass("border-red");
			$("#student_reg_no").removeClass("border-green");
			stud_reg_no="";
		}else if(stud_reg_no_regex.test(store)){
			$("#student_reg_no").addClass("border-green");
			$("#student_reg_no").removeClass("border-red");
			$(".name-error").html("");
			// stud_reg_no=store;
				$.ajax({
          type:'POST',
          url:'ajax/login.php?login=check',
          dataType:'JSON',
          beforeSend: function(){
             $(".name-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
          },
          data:{'check_student': store},
          success: function(suc){
            setTimeout(function(){
              if (suc['result'] == 'success') {
                $(".name-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Student Record Found !!!</div');
                $("#student_reg_no").addClass("border-green");
                $("#student_reg_no").removeClass("border-red");
              stud_reg_no = store;
                }else if (suc['result'] == 'failed') {
                $(".name-error").html(suc['message']);
                $("#student_reg_no").addClass("border-red");
                $("#student_reg_no").removeClass("border-green");
                stud_reg_no="";
              }
            },2000); 
          }
        })
    }else{
  			$(".name-error").html("Student Reg No is Invalid !!!");
  			$("#student_reg_no").addClass("border-red");
  			$("#student_reg_no").removeClass("border-green");
  			stud_reg_no="";
	}
}
$("#student_reg_no")
    .keyup(StudentRegNoValidation)
    .keypress(StudentRegNoValidation)
    .focusout(StudentRegNoValidation)
//===End of Student Reg No Validation===

	//===Password Validation===
  var PasswordValidation = function() {
	// $("#student_password").focusout(function(){

		var store_pwd = $.trim($("#student_password").val());
    errors =[];
		if (store_pwd.length == "") {
      errors.push("Password is Required !!!");

			// $(".pwd-error").html("Password is Required !!!");
			// $("#student_password").addClass("border-red");
			// $("#student_password").removeClass("border-green");
			// stud_password="";
    }
    if (stud_reg_no_regex.test(store_pwd)) {
      errors.push("Password is Invalid !!!");
    }
    // if (store_pwd.search(/(?=.*[0-9])/) < 0) {
    //   errors.push("Password must contain at least one digit !!!");
    // }
    // if (store_pwd.search(/(?=.*[A-Z])/) < 0) {
    //   errors.push("Password must contain at least one uppercase !!!");
    // }
    // if (store_pwd.search(/(?=.*[$,&?!^%/@#*])/) < 0) {
    //   errors.push("Password must contain at least one special character !!!");
    // }

    if (errors.length > 0) {
      $(".pwd-error").html(errors[0]);
      $("#student_password").addClass("border-red");
      $("#student_password").removeClass("border-green");
      stud_password="";
    }else{
      $("#student_password").addClass("border-green");
      $("#student_password").removeClass("border-red");
      // $(".pwd-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Your Password is Strong !!!</div');   
     stud_password=store_pwd;
    }
  }
  $("#student_password")
    .keyup(PasswordValidation)
    .keypress(PasswordValidation)
    .focusout(PasswordValidation)
    //===End of Password Validation===

    //===Submit Form Validation===
  $(document).on("submit", "form.loginStudent", function(event){
      event.preventDefault();
      var test_pwd = $.trim($("#student_password").val());
      if (stud_reg_no.length == "") {
        $(".name-error").html("Student Reg No is Required !!!");
        $("#student_reg_no").addClass("border-red");
        $("#student_reg_no").removeClass("border-green");
        stud_reg_no="";
      }
      if (test_pwd.length == "") {
         $(".pwd-error").html("Password is Required !!!");
         $("#student_password").addClass("border-red");
         $("#student_password").removeClass("border-green");
      }
      //In the case User uses auto-fill password
      if (stud_password.length != test_pwd.length && stud_reg_no.length =="") {
         $(".pwd-error").html("Please Re-Type Password !!!");
         $("#student_password").addClass("border-red");
         $("#student_password").removeClass("border-green");
         $("#student_password").val("");
      }else{
        stud_password = test_pwd;
      }
      if (stud_reg_no.length != "" && stud_password.length != "") {
        //Clears Previous Error Message
        $("#eMsg").html('<i class="fa fa-times"></i> Student Not Registered!!!').hide();
        //Checks For Student Through AJAX
        $.ajax({
          type:'POST',
          url:'ajax/login.php?login=true',
          data:$("#loginStudent").serialize(),
          dataType:'JSON',
          beforeSend: function(){
            $(".show-progress").addClass("progress")
          },
          success: function(result){
            setTimeout(function(){
              if (result['outcome'] == 'success') {
                location = result.redirect;
            }else if (result['outcome'] == 'failed') {
              $("#eMsg").html('<i class="fa fa-times"></i> Student Not Registered!!!').show();
              $(".show-progress").removeClass("progress")
            }

            },2000)
            
            

          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          }  
        })
      }
 
      return false;
  }) //===End of Submit Form Validation===
  
})
