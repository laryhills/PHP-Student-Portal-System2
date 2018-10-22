<?php
session_start();
require_once('db_connect.php');




if($_POST['rowid']) {
    $course_id = $_POST['rowid']; //escape string

    // Run the Query
    $sql = "SELECT * FROM courses WHERE course_id='$course_id'";
    $sqlresult =  mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
    $rowcount=mysqli_num_rows($sqlresult);
    // Fetch Records
    // echo $rowcount;

     while ($row=mysqli_fetch_array($sqlresult)) {

     	$course_title = ($row['course_title']);
     	$course_code =$row['course_code'];
        $course_credit = ($row['course_credit']);
        $course_dept=$row['course_dept_fk'];
        $course_id = $row['course_id'];
}
?>

    <!-- // Echo the data you want to show in modal -->
	 <form method="post" action="update_course.php">
								<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="course_title">Course Title:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="course_title" id="course_title" placeholder="Course Title" value="<?php echo $course_title; ?>" required>
										</div>
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="course_code">Course Code:</label>
							<input style="text-transform: uppercase;" class="form-control" type="text" name="course_code" id="course_code" placeholder="Course Code" value="<?php echo $course_code; ?>" maxlength="6"  required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-6">
											<label class="FieldInfo" for="course_dept">Course Department/Faculty:</label>
											<select class="form-control" name="course_dept" id="course_dept" required>	
											<?php 

		 $option2 = "SELECT DISTINCT CONCAT(`dept_title`,'/',`fac_title`) AS DeptFac,`dept_code` FROM `department`,courses WHERE dept_code='$course_dept'";
			        $optionresult2= mysqli_query($db_connect, $option2) or die(mysqli_error($db_connect));

			            while ($row2=mysqli_fetch_array($optionresult2)) {
			            	?>
				       		<option value="<?php echo $row2['dept_code']; ?>">
				        	<?php echo $row2['DeptFac'];?></option>
				            
				            <?php
				             }
				            ?>		  
	<?php 

		 $option = "SELECT CONCAT(`dept_title`,'/',`fac_title`) AS DeptFac,`dept_code` FROM `department`";
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
											<label class="FieldInfo" for="course_credit">Course Credit Load:</label>
							<input class="form-control" type="number" name="course_credit" id="course_credit" placeholder="Course Credit Load" value="<?php echo $course_credit; ?>" maxlength="1"  required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-10">
											<input class="btn btn-success btn-block" type="submit" name="updateCourseBtn" value="Update Course">
					
										</div>
	
									</div>
									
										<input type="hidden" name="course_id" value="<?php echo $course_id;?>">
								</fieldset>
							</form>






<?php

 }
?>
