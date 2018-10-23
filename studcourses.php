<?php 
session_start();
require_once('db_connect.php');
require_once('functions/functions.php');
?>

<?php
$stud_reg_no=$_SESSION['username'];

if (isset($_POST['addCourseBtn'])) {

	$stud_course= $_POST['student_course'];

	$CourseCheck = "SELECT * FROM student_courses WHERE course_fk ='$stud_course'";
	$CourseCheckResult = mysqli_query($db_connect, $CourseCheck) or die(mysqli_error($db_connect));
	$rowcount1=mysqli_num_rows($CourseCheckResult);
	if($rowcount1>0){

		// echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Course Already Added!!!</div>";
		$_SESSION["ErrorMessage"]="Course Already Added!!!!!!";
            header('location:studcourses.php');
            exit;
	}else{

			$sql = "INSERT INTO student_courses (course_fk,student_fk) VALUES ('$stud_course','$stud_reg_no')";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Course Added!!!";
            header('location:studcourses.php');
            exit;
		}
	}

?>

<!DOCTYPE>


<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Courses</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<script src="js/solid.js" ></script>
    	<script src="js/fontawesome.js"></script>


	</head>
	<body>
		<div style="height: 5px; background: #1ab394;"></div>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<!-- <span class="sr-only">Toogle Navigation</span> -->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Logo -->
					<a class="navbar-brand" href="dashboard.php">
					<!-- <img style="margin-top: -12px;" src="" width=""; height=";"> -->
						SCHOOL LOGO
					</a>
				</div>

				<!-- Menu Items -->
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Portal</a></li>
						<li><a href="#">Latest News</a></li>
						<li><a href="#">Courses</a></li>
						<li ><a href="#">About Us</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
					<!-- <form action="dashboard.php" class="navbar-form navbar-right">
						<div class="form-group">
							<input class="form-control" type="text" name="search" placeholder="Search">
						</div>
						<button class="btn btn-default">
        <i class="fa fa-search"></i></button>
					</form> -->
			<!--		 <ul class="nav navbar-nav navbar-right">
					 	<br>
					 	<li style="color: white; align-content: center;"><?php echo $DateTime1; ?></li>
         <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> 
      </ul> -->
				</div>
				
			</div>
			
		</nav>
		<div class="line" style="height: 10px; background: #1ab394;"></div>
			
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<br><br>
					<ul id="side_menu" class="nav nav-pills nav-stacked">
						<li><a href="studpage.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li  class="active"><a href="studcourses.php"><span class="glyphicon glyphicon-book"> </span> My Courses</a></li>
						<li>
                        <a href="studtest.php"><span class="fa fa-edit"></span> Take Tests</a>
                    	</li>
						<li>
                        <a href="studupdate.php"><span class="fa fa-edit"></span> Edit Profile</a>
                    	</li>
						<li><a href="studpay.php"><span class="glyphicon glyphicon-credit-card"> </span> Payments</a></li>
						<li><a href="logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>
						
					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h2>&nbsp;Update Profile</h2>
						<div>
							
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>
					
						<div>
								

							
							<form method="post" action="studcourses.php">
								<fieldset>
									
									
									<div class="form-row">
										<div class="form-group col-sm-7">
											<label class="FieldInfo" for="student_course">Course:</label>
											<select class="form-control" name="student_course" id="student_course" required>				  
	<?php 

		 $option = "SELECT CONCAT(`course_code`,'-',`course_title`,' (',`course_credit`,' credits',')') AS Course,`course_code` FROM `courses`";
			        $optionresult= mysqli_query($db_connect, $option) or die(mysqli_error($db_connect));

			            while ($row=mysqli_fetch_array($optionresult)) {
			            	?>
				       		<option value="<?php echo $row['course_code']; ?>">
				        	<?php echo $row['Course'];?></option>
				            
				            <?php
				             }
				            ?>


  												</select>

										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<input class="btn btn-success" type="submit" name="addCourseBtn" value="Add Course">
					
										</div>
	
									</div>
									

								</fieldset>
							</form>

						</div>
						<div class="table-responsive">

	<?php 
		
        $ViewQuery = "SELECT course_fk,course_code,course_title,course_credit,dept_code,fac_code FROM `student_courses`,courses,department WHERE `student_fk` = '$stud_reg_no' AND course_fk=course_code AND course_dept_fk=dept_code";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
        $serial=0;
    ?>
			<table class="table table-hover">
				<thead>
                	<tr>
                        <th>S/No</th>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Dept.</th>
                        <th>Faculty</th>
                        <th>Credits</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  	<?php
            
		                while ($row=mysqli_fetch_array($ViewQueryResult)) {

		                    $course_code1 = ($row['course_code']);
		                   	$course_title1 = ($row['course_title']);
		                    $course_dept1 = ($row['dept_code']);
		                    $course_fac1 = ($row['fac_code']);
		                    $course_credit1 = $row['course_credit'];
		                    $serial++;
		                    
                  	?>
              	<tr>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $course_code1; ?></td>
                    <td><?php echo $course_title1; ?></td>
                    <td><?php echo $course_dept1; ?></td>
                    <td><?php echo $course_fac1; ?></td>
                    <td><?php echo $course_credit1; ?></td>
                  <td>
                  <a href="stud_del_course.php?del=<?php echo $row['course_fk']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to remove this course?');" ><button type="button" class="btn btn-danger">Delete</button></a>

                </td>
	               
             	</tr>
             <?php

            	 }

             ?>
            	</tbody>
         
            </table>

						</div>


						
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div> <!-- Ending of Main Area -->

				
		</div> <!-- Ending of Container-Row -->
		</div> <!-- Ending of Container-Fluid -->
		<div class="footer">
	    	<div class="container">
		    	<div class="row">

		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">Copyright &copy; 2018 School Name. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div> <!-- Ending of Footer -->



	   
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>