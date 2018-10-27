<?php 
session_start();
require_once('../db_connect.php');
require_once('../functions/functions.php');
?>

<?php

if (isset($_POST['addCourseBtn'])) {

	$course_title=mysqli_real_escape_string($db_connect, ucwords($_POST['course_title']));
	$course_code=mysqli_real_escape_string($db_connect, strtoupper($_POST['course_code'])); 
	$course_credit=mysqli_real_escape_string($db_connect, $_POST['course_credit']); 
	$course_dept=mysqli_real_escape_string($db_connect, $_POST['course_dept']); 

	
	// if(empty($course_name) || empty($course_code)){

	// 	$_SESSION["ErrorMessage"]="All fields must be field";
 	//        header('location:addcourses.php');
 	//        exit;
	// }
	
	if (strlen($course_code) <> 6) {

		$_SESSION["ErrorMessage"]="Course Code Must be Six Characters";
        header('location:courses.php');
        exit;

	}elseif(!(preg_match("/^[A-Z]{3}[0-9]{3}$/",$course_code))) {

			$_SESSION["ErrorMessage"]="Course Code Wrong";
        	header('location:courses.php');
        	exit;
	
	}elseif ($course_credit < 2 || $course_credit > 6) {

		$_SESSION["ErrorMessage"]="Course Credit Is Invalid";
        header('location:courses.php');
        exit;
	}else{

			$sql = "INSERT INTO courses (course_title,course_code,course_dept_fk,course_credit) VALUES ('$course_title','$course_code','$course_dept','$course_credit')";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Course Added!!!";
            header('location:courses.php');
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
						<li class="active"><a href="courses.php"><span class="glyphicon glyphicon-book"> </span> Courses</a></li>
						<!-- <li><a href="#"><span class="glyphicon glyphicon-print"> </span> Print Result</a></li> -->
						<li>
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
						<li><a href="../logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>
						<!-- <li><a href="courses.php">Courses</a></li>
						<li><a href="result.php">Check Result</a></li>
						<li><a href="payment.php">Payment</a></li>
						<li><a href="logout.php">Logout</a></li> -->

					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h1>Admin Manage Courses</h1>
					
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>

							
							<form method="post" action="courses.php">
								<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-8">	
											<label class="FieldInfo" for="course_title">Course Title:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="course_title" id="course_title" placeholder="Course Title" required>
										</div>
										<div class="form-group col-sm-2">	
											<label class="FieldInfo" for="course_code">Course Code:</label>
							<input style="text-transform: uppercase;" class="form-control" type="text" name="course_code" id="course_code" placeholder="Course Code"maxlength="6"  required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-6">
											<label class="FieldInfo" for="course_dept">Course Department/Faculty:</label>
											<select class="form-control" name="course_dept" id="course_dept" required>				  
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
							<input class="form-control" type="number" name="course_credit" id="course_credit" placeholder="Course Credit Load"maxlength="1"  required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-10">
											<input class="btn btn-success btn-block" type="submit" name="addCourseBtn" value="Add New Course">
					
										</div>
	
									</div>
									

								</fieldset>
							</form>

						</div>
						<div class="table-responsive">

	<?php 

        $ViewQuery = "SELECT * FROM `courses`,department WHERE `course_dept_fk` = dept_code";
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
                        <th colspan="2">Action</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                  
                  	<?php
            
		                while ($row=mysqli_fetch_array($ViewQueryResult)) {

		                    $course_code1 = ($row['course_code']);
		                   	$course_title1 = ($row['course_title']);
		                    $course_dept1 = ($row['course_dept_fk']);
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-userid="<?php echo $row['course_id']; ?>" >Edit</button>
                  </td>
                  <td>
                  <a href="del_course.php?del=<?php echo $row['course_id']; ?>" class="del_btn"><button type="button" class="btn btn-danger">Delete</button></a>

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



	    <script type="text/javascript">

	    
	 //    //triggered when modal is about to be shown
		// $('#myModal').on('show.bs.modal', function(e) {

  //  		 //get data-id attribute of the clicked element
  //   	var userid = $(e.relatedTarget).data('userid');

  //   	//populate the textbox
  //   	$(e.currentTarget).find('input[name="user_id"]').val(userid);
		// });	


		$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('userid');
        $.ajax({
            type : 'post', //Use post to send data
            url : 'fetch_record.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database to div class fetched-data
            }
        });
     });
});

		$(document).ready(function(){
	    $("#myBtn").click(function(){
	        $("#myModal").modal();
		    });
		});

		


		</script>
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>