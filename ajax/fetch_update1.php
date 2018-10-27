<?php
session_start();
require_once('../db_connect.php');




if($_POST['stud_reg_no']) {

    $student_reg_no = $_POST['stud_reg_no']; //escape string

    // Run the Query
   
    // Fetch Records
    // echo $rowcount;

    
?>

    <!-- // Echo the data you want to show in modal -->
    <div class="alert alert-success" id="sMsg" style="display: none;"></div>
		<div class="alert alert-danger" id="eMsg" style="display: none;"></div>
	 <form name="updatePassword" id="updatePassword">
								<fieldset>
									<div class="form-row">
											<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_password1">Old Password:</label>
							<input class="form-control" type="password" name="student_password1" id="student_password1" placeholder="Old Password"><div class="old-error error" ></div>
										</div>
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_password2">New Password:</label>
							<input class="form-control" type="password" name="student_password2" id="student_password2" placeholder="New Password">
							<div class="new-error error" ></div><div id="tip"><small id="passwordHelpBlock" class="form-text text-muted">
  								Password must be at least 8 characters long, include at least one uppercase and one special character.
							</small></div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<input class="btn btn-success btn-block" type="submit" name="updatePasswordBtn" id="updatePasswordBtn" value="Change Password">

					
										</div>
	
									</div>
										<input type="hidden" name="student_reg_no" id="student_reg_no" value="<?php echo $student_reg_no;?>">
								</fieldset>
							</form>
<script type="text/javascript" src="js/passwordupdate.js"></script>






<?php

 }
?>
