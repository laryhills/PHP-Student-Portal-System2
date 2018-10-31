$(document).ready(function(){
	var admin_loginid="";
	var admin_password="";
	var admin_loginid_regex=/^RCCG[ADMINadmin]{5}0[0-9]{1}$/;
  var admin_password_regex =/^[a-zA-Z0-9$,&?!^%/@#*()-]{10,}$/;

	//===Admin Login ID Validation===
  var AdminLoginIDValidation = function() {

		var store = $.trim($("#admin_loginid").val());
		if (store.length == "") {

			$(".name-error").html("Admin Login ID is Required !!!");
			$("#admin_loginid").addClass("border-red");
			$("#admin_loginid").removeClass("border-green");
			admin_loginid="";
		}else if(admin_loginid_regex.test(store)){
			$("#admin_loginid").addClass("border-green");
			$("#admin_loginid").removeClass("border-red");
			$(".name-error").html("");
				$.ajax({
          type:'POST',
          url:'ajax/adminLogin.php?login=check',
          dataType:'JSON',
          beforeSend: function(){
             $(".name-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
          },
          data:{'check_admin_loginid': store},
          success: function(suc){
            setTimeout(function(){
              if (suc['result'] == 'success') {
                $(".name-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Admin Login ID Found !!!</div');
                $("#admin_loginid").addClass("border-green");
                $("#admin_loginid").removeClass("border-red");
              admin_loginid = store;
                }else if (suc['result'] == 'failed') {
                $(".name-error").html(suc['message']);
                $("#admin_loginid").addClass("border-red");
                $("#admin_loginid").removeClass("border-green");
                admin_loginid="";
              }
            },1000); 
          }
        })
    }else{
  			$(".name-error").html("Admin Login ID is Invalid !!!");
  			$("#admin_loginid").addClass("border-red");
  			$("#admin_loginid").removeClass("border-green");
        admin_loginid="";
	}
}
$("#admin_loginid")
    .keyup(AdminLoginIDValidation)
    .keypress(AdminLoginIDValidation)
    .focusout(AdminLoginIDValidation)
//===End of Admin Login ID Validation===

	//===Password Validation===
var PasswordValidation = function() {
  errors1 =[];
    var store_pwd = $.trim($("#admin_password").val());
    

    if (store_pwd.length == "") {
      $("#admin_password").addClass("border-red");
      $("#admin_password").removeClass("border-green");
      $(".pwd-error").html("Password Is Required");
    }
    // if (store_pwd.length < 8) {
    //   errors1.push("Password is Too Short !!!");
    // }
    // if (store_pwd.search(/[a-z0-9$,&?!^%/@#*()-]/) < 0) {
    //   errors1.push("Password is Invalid !!!");
    // }
    
    // if (store_pwd.search(/(?=.*[A-Z])/) < 0) {
    //   errors1.push("Please check password again !!!");
    // }
    // if (errors1.length > 0) {
    //   $("#admin_password").addClass("border-red");
    //   $("#admin_password").removeClass("border-green");
    //   admin_password="";
    //   $(".pwd-error").html(errors1[0]);
    // }
    // else if (errors1.length = 0) {
    //   $("#admin_password").addClass("border-green");
    //   $("#admin_password").removeClass("border-red");
    //   $(".pwd-error").html("");
      
      // $(".pwd-error").html('<div class="text-success"><i class="fa fa-check-circle"></i> Your Password is Strong !!!</div');   
    //  admin_password=store_pwd;
    // }
    else
      $("#admin_password").addClass("border-green");
      $("#admin_password").removeClass("border-red");
      $(".pwd-error").html("");
      admin_password=store_pwd;
  }
  $("#admin_password")
    // .keyup(PasswordValidation)
    .keypress(PasswordValidation)
    .focusout(PasswordValidation)
    //===End of Password Validation===


    //===Submit Form Validation===
  $(document).on("submit", "form.loginAdmin", function(event){
      event.preventDefault();
      var test_pwd = $.trim($("#admin_password").val());
      if (admin_loginid.length == "") {
        $(".name-error").html("Admin Login ID is Required !!!");
        $("#admin_loginid").addClass("border-red");
        $("#admin_loginid").removeClass("border-green");
      }
      if (test_pwd.length == "") {
         $(".pwd-error").html("Password is Required !!!");
          $("#admin_password").addClass("border-red");
        $("#admin_password").removeClass("border-green");
      }
      //In the case User uses auto-fill password
      // if (admin_password.length != test_pwd.length && admin_loginid.length =="") {
     // else if ((admin_password.localeCompare(test_pwd )) != 0 && (admin_loginid.length =="" || admin_password.length=="")) {
        
     //     $(".pwd-error").html("Please Re-Type Password !!!");
     //     $("#admin_password").addClass("border-red");
     //     $("#admin_password").removeClass("border-green");
     //     $("#admin_password").val(" ");
     //  }
      else{
        admin_password = test_pwd;
        $("#admin_password").addClass("border-green");
         $("#admin_password").removeClass("border-red");
      }
      if (admin_loginid.length != "" && admin_password.length != "") {
        //Clears Previous Error Message
        $("#eMsg").hide();
        //Checks For Admin Through AJAX
        $.ajax({
          type:'POST',
          url:'ajax/adminLogin.php?login=true',
          data:$("#loginAdmin").serialize(),
          dataType:'JSON',
          beforeSend: function(){
            $(".show-progress").addClass("progress")
          },
          success: function(result){
            setTimeout(function(){
              if (result['outcome'] == 'success') {
                location = result.redirect;
            }else if (result['outcome'] == 'failed') {
              $("#eMsg").html('<i class="fa fa-times"></i> Login Not Successful /<br>Incorrect Password!!!').show();
              $(".show-progress").removeClass("progress")
            }else if (result['outcome'] == 'wrong') {
              $("#eMsg").html('<i class="fa fa-times"></i> Admin Not Authorized!!!').show();
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
