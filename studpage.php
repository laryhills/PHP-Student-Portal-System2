<?php 
session_start();
require_once('db_connect.php');
require_once('functions/functions.php');
require_once('dateTime.php');
	


if(!$_SESSION['username']){
	$_SESSION["ErrorMessage"]="Access Denied, Login Required!!!";
	header('location:index.php');
	exit;
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
		<title>Dashboard</title>
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
						<li class="active"><a href="studpage.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li><a href="studcourses.php"><span class="glyphicon glyphicon-book"> </span> My Courses</a></li>
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
					<div class="table-responsive">
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>


	<?php 
		$stud_reg_no=$_SESSION['username'];
        $ViewQuery = "SELECT CONCAT (f_name,' ',m_name,' ',l_name) AS Name, student_reg_no,level,dept_title,fac_title,password,comment FROM students,department WHERE `student_reg_no` = '$stud_reg_no' AND dept_fk=dept_code";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
       
    ?>			
			<table class="table table-hover table-striped" style="width: 70%;" >
				<thead>
                	<h2>Student Info</h2>
                </thead>
                <tbody style="font-size: 1.2em;">
                  

                  	<?php
            
		                while ($row=mysqli_fetch_array($ViewQueryResult)) {

		                    $name = ($row['Name']);
		                    $stud_dept = ($row['dept_title']);
		                    $stud_fac = ($row['fac_title']);
		                    $stud_level = $row['level'];
		                    $pwd=$row['password'];
		                    $com=$row['comment'];

		                }

		                if (strcmp($pwd,$com) == 0 ){

		                // if (($row['password']) == ($row['comment'])) {

		                	// <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
		                	echo "<div class=\"alert alert-danger\">Please Change Your Password</div>";
		                }
		                
                  	?>
              	<tr>

			<tr><td >Name :</td><td><?php echo $name; ?></td></tr>
			<tr><td>Student Reg No :</td><td><?php echo $stud_reg_no; ?></td></tr>
			<tr><td>Level :</td><td><?php echo $stud_level; ?></td></tr>
			<tr><td>Department :</td><td><?php echo $stud_dept; ?></td></tr>
			<tr><td>Faculty :</td><td><?php echo $stud_fac; ?></td></tr>
                    
             	</tr>
            
            	</tbody>
         
            </table>

						</div>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
				</div> <!-- Ending of Main Area -->

				


			</div> <!-- Ending of Row -->

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