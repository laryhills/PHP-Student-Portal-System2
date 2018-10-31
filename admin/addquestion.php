<?php 
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');
require_once('../functions/functions.php');

if(!$_SESSION['username']){
	$_SESSION["LoginErrorMessage"]="Access Denied, Login Required!!!";
	header('location:../admin.php');
	exit;
}
?>
<?php

$admin_loginid=$_SESSION['username'];

        $ViewQuery = "SELECT * FROM admin WHERE `admin_loginid` = '$admin_loginid'";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
        $count = mysqli_num_rows($ViewQueryResult);
        while ($row1=mysqli_fetch_array($ViewQueryResult)) {

		                    $admin_name = ($row1['Name']);
		                    $admin_status = ($row1['status']);
        }

        

?>

<?php

if (isset($_POST['addQuestionBtn'])) {

	$test_id=mysqli_real_escape_string($db_connect, ($_POST['test_id']));

	$ViewQuery2 = "SELECT test_name,course_fk,course_title FROM `tests`,courses WHERE course_fk=course_code && test_id='$test_id'";
		$ViewQueryResult2= mysqli_query($db_connect, $ViewQuery2) or die(mysqli_error($db_connect));
		$count = mysqli_num_rows($ViewQueryResult);
		while ($row1=mysqli_fetch_array($ViewQueryResult)) {

		      $test_msg = $row['test_name']." -- ".$row['course_title']." (".$row['course_fk'].")";
        }



	$test_que=mysqli_real_escape_string($db_connect, ucfirst($_POST['test_que']));
	$que_ans1=mysqli_real_escape_string($db_connect, ucfirst($_POST['que_ans1']));
	$que_ans2=mysqli_real_escape_string($db_connect, ucfirst($_POST['que_ans2']));
	$que_ans3=mysqli_real_escape_string($db_connect, ucfirst($_POST['que_ans3']));
	$que_ans4=mysqli_real_escape_string($db_connect, ucfirst($_POST['que_ans4']));
	$que_ans0=mysqli_real_escape_string($db_connect, ($_POST['que_ans0']));
	
			
	

	$sql = "INSERT INTO questions (test_fk,que_desc,ans1,ans2,ans3,ans4,true_ans,addedBy) VALUES ('$test_id','$test_que','$que_ans1','$que_ans2','$que_ans3','$que_ans4','$que_ans0','$admin_name')";
            $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

        $_SESSION["SuccessMessage"]="Question Added to ".$test_msg." Successful!!!";
        header('location:addquestion.php');
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
		<title>Add Questions</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/style.css">
		<script src="../js/solid.js" ></script>
    <script src="../js/fontawesome.js"></script>


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
					 <!-- <ul class="nav navbar-nav navbar-right">
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
						<li><a href="dashboard.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li><a href="courses.php"><span class="glyphicon glyphicon-book"> </span> Courses</a></li>
						<!-- <li><a href="#"><span class="glyphicon glyphicon-print"> </span> Print Result</a></li> -->
						<li >
            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Students &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="collapse nav nav-pills nav-stacked" id="studentSubmenu">
                    <li>
                        <a href="addstudent.php"><span class="fa fa-user-plus"></span> Add Student</a>
                    </li>
                    <li>
                        <a href="students.php"><span class="fa fa-users"></span> Manage Students</a>
                    </li>
                </ul>
            </li>
			<li>
            <a href="#tmaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> TMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="nav nav-pills nav-stacked" id="tmaSubmenu">
                    <li>
                        <a href="addtest.php"><span class="fa fa-plus"></span> Add Tests</a>
                    </li>
                    <li   class="active">
                        <a href="addquestion.php"><span class="fa fa-plus"></span> Add Q & A</a>
                    </li>
                </ul>
            </li>
             <?php
            if ($count == 1){
				
				// check if admin is allowed
				$logged_in_user = mysqli_fetch_assoc($ViewQueryResult);

					if ($logged_in_user['admin_type'] == 'master') {

			?>
					
					<li>
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Admins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="collapse nav nav-pills nav-stacked" id="adminSubmenu">
                    <li>
                        <a href="#"><span class="fa fa-user-plus"></span> Add Admin</a>
                    </li>
                    <li>
                        <a href="admins.php"><span class="fa fa-users"></span> Manage Admin</a>
                    </li>
                </ul>
            </li>
						

			<?php
					}
				}

            ?>

						<li><a href="logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>

					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h1>Admin Add Questions</h1>
					
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>

						<form method="post" action="addquestion.php">
								<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-8">
										<label class="FieldInfo" for="test_id">Test</label>
										<select class="form-control" name="test_id" id="test_id" required>				  
	<?php 

		 $option = "SELECT test_id,test_name,course_fk,course_title FROM `tests`,courses WHERE course_fk=course_code";
			        $optionresult= mysqli_query($db_connect, $option) or die(mysqli_error($db_connect));
			            while ($row=mysqli_fetch_array($optionresult)) {
	?>
				       		<option value="<?php echo $row['test_id']; ?>">
				        	<?php echo $row['test_name']." -- ".$row['course_title']." (".$row['course_fk'].")";?></option>
				            
	<?php
			           }
	?>


  											</select>

										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">
											<label class="FieldInfo" for="test_que">Question:</label>
											<textarea  class="form-control" id="test_que" name="test_que" rows="3"placeholder="Question" required></textarea>
										</div>	
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">	
											<label class="FieldInfo" for="que_ans1">Anwser 1:</label>
							<input  class="form-control" type="text" name="que_ans1" id="que_ans1" placeholder="Anwser 1" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">	
											<label class="FieldInfo" for="que_ans2">Anwser 2:</label>
							<input  class="form-control" type="text" name="que_ans2" id="que_ans2" placeholder="Anwser 2" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">	
											<label class="FieldInfo" for="que_ans3">Anwser 3:</label>
							<input  class="form-control" type="text" name="que_ans3" id="que_ans" placeholder="Answer 3" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">	
											<label class="FieldInfo" for="que_ans4">Anwser 4:</label>
							<input  class="form-control" type="text" name="que_ans4" id="que_ans4" placeholder="Anwser 4" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-9">	
											<label class="FieldInfo" for="que_ans0">Anwser 4:</label>
							<input  class="form-control" type="number" name="que_ans0" id="que_ans0" placeholder="Correct Answer" required>
							<small id="passwordHelpBlock" class="form-text text-muted">
  								Correct Answer show be an integer (Answer 1 = 1, Answer 2 = 2, Anwser 3 = 3 & Answer 4 = 4)
							</small>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-9">
											<input class="btn btn-success btn-block" type="submit" name="addQuestionBtn" value="Add Question">
					
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
						<p>&nbsp;</p>

							
							
						</div>
						


						

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



	   <script src="../js/addstudent.js"></script>
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>