<?php
session_start();
require_once('../db_connect.php');




if($_POST['rowid']) {
    $stud_reg_no = $_POST['rowid']; //escape string

    // Run the Query
    $sql = "SELECT * FROM students WHERE student_reg_no='$stud_reg_no'";
    $sqlresult =  mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
    $rowcount=mysqli_num_rows($sqlresult);
    // Fetch Records
    // echo $rowcount;

     while ($row=mysqli_fetch_array($sqlresult)) {
        $stud_reg=$row['student_reg_no'];
        $stud_fname=($row['f_name']);
		$stud_mname=$row['m_name']; 
		$stud_lname=$row['l_name']; 
		$stud_dept=$row['dept_fk'];
		$stud_level=$row['level'];
		$stud_password=$row['password'];


		// add two passwords for student
}
?>

    <!-- // Echo the data you want to show in modal -->
	 <form method="post" action="update_student.php">
								<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-7">	
											<label class="FieldInfo" for="student_reg_no">Student Registration Number:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_reg_no" id="student_reg_no" placeholder="Student Registration Number" value="<?php echo $stud_reg; ?>" readonly="0"><small id="passwordHelpBlock" class="form-text text-muted">
  								Cannot change student registration number after creation.
							</small>
										</div>
										<div class="form-group col-sm-5">	
											<label class="FieldInfo" for="student_password">Password:</label>
											<small id="passwordHelpBlock" class="form-text text-muted">
  								Old Password - <?php echo $stud_password; ?>
							</small>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_password" id="student_password" placeholder="Student Password" value="Password Will Be Reset On Update" readonly="0">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_fname">Student First Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_fname" id="student_fname" placeholder="Student First Name" value="<?php echo $stud_fname; ?>" required>
										</div>
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_mname">Student Middle Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_mname" id="student_mname" placeholder="Student Middle Name"  value="<?php echo $stud_mname; ?>">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_lname">Student Last Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_lname" id="student_lname" placeholder="Student Last Name" value="<?php echo $stud_lname; ?>" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-8">
											<label class="FieldInfo" for="student_dept">Department</label>
											<small id="passwordHelpBlock" class="form-text text-muted">
  								Old Departent - <?php echo $stud_dept; ?>
							</small>
											<select class="form-control" name="student_dept" id="student_dept" required>
								<!-- <?php

$option2 = "SELECT CONCAT(`dept_title`,'/',`fac_title`) AS DeptFac,`dept_fk` FROM `department`,students WHERE dept_fk=dept_code AND student_reg_no='$stud_reg_no'";
			        $optionresult2= mysqli_query($db_connect, $option2) or die(mysqli_error($db_connect));

			            while ($row2=mysqli_fetch_array($optionresult2)) {
			            	?>
				       		<option value="<?php echo $row2['dept_fk']; ?>">
				        	<?php echo $row2['DeptFac'];?></option>
				            
				            <?php
				             }
				            ?>		   -->
	<?php 
	 	
	 	$opt ="SELECT fac_code FROM department,students WHERE dept_fk=dept_code AND student_reg_no='$stud_reg'";
	 	$optresult=mysqli_query($db_connect, $opt) or die(mysqli_error($db_connect));

	 	while ($row3=mysqli_fetch_array($optresult)) {
			            	
				       		$fac_code=$row3['fac_code'];
				            
				             }
				            
		$option = "SELECT CONCAT(`dept_title`,'/',`fac_title`) AS DeptFac,`dept_code` FROM `department` WHERE fac_code='$fac_code'";
			    $optionresult= mysqli_query($db_connect, $option) or die(mysqli_error($db_connect));

			            while ($row=mysqli_fetch_array($optionresult)) {
			            	?>

				       		<option value="<?php echo $row['dept_code']; ?>">
				        	<?php echo $row['DeptFac'];?></option>
				            
				            <?php
				             }
				            ?>


  												</select>

										</div>
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="student_level">Level:</label>
											<small id="passwordHelpBlock" class="form-text text-muted">
  								Old Level - <?php echo $stud_level; ?>
							</small>
							<select class="form-control" name="student_level" id="student_level">

								<option value="100">100</option>
								<!-- <option value="200">200</option>
								<option value="300">300</option>
								<option value="400">400</option>
								<option value="500">500</option> -->
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<input class="btn btn-success btn-block" type="submit" name="updateStudentBtn" value="Update Student Record">
					
										</div>
	
									</div>
								</fieldset>
							</form>






<?php

 }
?>
