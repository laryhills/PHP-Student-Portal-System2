<?php 
// session_start(); 
require_once('db_connect.php');
require_once('functions/functions.php');
?>


<!DOCTYPE>
<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Login</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<script src="js/solid.js" ></script>
    	<script src="js/fontawesome.js"></script>
    	<style>
    		body {
    			background-color: white;
    		}
    		
    	</style>

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
				
				<div class="col-sm-offset-4 col-sm-4">
					<br><br>
					<h1>Login</h1>
					
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>

							
							<!-- <form method="" action=""> -->

							<form class="loginStudent" id="loginStudent">
								<fieldset>
									<div class="login-error" id="eMsg" ></div>
									<div class="form-group col-sm-6 show-progress"></div>
									<div class="form-row">
										<div class="form-group col-sm-8" style="padding: 0;">	
											<label class="FieldInfo" for="student_reg_no">Student Registration Number:</label>
							<input style="text-transform: uppercase;" class="form-control" type="text" name="student_reg_no" id="student_reg_no" placeholder="Student Reg. No.">
										<div class="name-error error" ></div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-8" style="padding: 0;">	
											<label class="FieldInfo" for="student_password">Password:</label>
							<input type="password" class="form-control" name="student_password" id="student_password" placeholder="Password" >
										<div class="pwd-error error" ></div>
										</div>
									</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-10" style="padding: 0;">
											<input class="btn btn-success" type="submit" name="loginStudentBtn" value="Login">
					
										</div>
									</div>
								</fieldset>
							</form>

						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p><br>

						</div>
						
						
						<!-- <p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p> -->
					
				</div> <!-- Ending of Main Area -->

				<div class="container"><!--  For Modal -->
  
  

  <!-- The Modal -->
  <div class="modal fade bd-example-modal-lg" id="myModal" style="color: black;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header"  style="color: black;">
          <!-- <h4 class="modal-title" style="color: black;">Modal Heading</h4> -->
          <h2 style="font-size: 25px;"><u>Update Course</u></h2><br> 
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
	      	

 			<div class="fetched-data"> <!-- show data to modal -->
 				
 			</div>

        <!-- Modal footer -->
        <div class="modal-footer">
        	<!-- <button type="submit" class="btn btn-primary" id="btnEdit"><span class="fa fa-edit"></span> Update</button> -->
        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

				


			</div> <!-- Ending of Modal -->

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
		<script src="js/login.js"></script>
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>