<?php 
session_start();
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
		<title>Manage Students</title>
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
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Admins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="nav nav-pills nav-stacked" id="adminSubmenu">
                    <li>
                        <a href="#"><span class="fa fa-user-plus"></span> Add Admin</a>
                    </li>
                    <li  class="active">
                        <a href="admins.php"><span class="fa fa-users"></span> Manage Admin</a>
                    </li>
                </ul>
            </li>
						<li><a href="#"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>

					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h1>Admin Manage Students</h1>
					
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>

							
							
						</div>
						<div class="table-responsive">

	<?php 

        $ViewQuery = "SELECT DISTINCT CONCAT(f_name,' ',m_name,' ',l_name) AS Name,level,dept_fk,comment,fac_code,student_reg_no FROM `students`,department WHERE `dept_fk` = dept_code AND user_type='admin'";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
        $serial=0;
    ?>
                	
							
			<table class="table table-hover">
				<thead>
                	<tr>
                        <th>S/No</th>
                        <th>Student Reg. No.</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Department</th>
                        <th>Level</th>
                        <th>Comment</th>
                        <!-- <th colspan="2">Action</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  	<?php
            
		                while ($row=mysqli_fetch_array($ViewQueryResult)) {

		                    $stud_name = ($row['Name']);
		                   	$stud_level = ($row['level']);
		                    $stud_dept = ($row['dept_fk']);
		                    $stud_fac = ($row['fac_code']);
		                    $stud_comm = ($row['comment']);
		                    $stud_reg=$row['student_reg_no'];

		                    $serial++;
		                    
                  	?>
              	<tr>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $stud_reg; ?></td>
                    <td><?php echo $stud_name; ?></td>
                    <td><?php echo $stud_level; ?></td>
                    <td><?php echo $stud_dept; ?></td>
                    <td><?php echo $stud_fac; ?></td>
                    <td><?php echo $stud_comm; ?></td>
                    <!-- <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-userid="<?php echo $row['student_reg_no']; ?>" >Edit</button>
                  </td> -->	
                  <td> 
                  <a href="del_student.php?del=<?php echo $row['student_reg_no']; ?>" class="del_btn"><button type="button" class="btn btn-danger">Delete</button></a>

                </td>
	               
             	</tr>
             <?php

            	 }

             ?>
            	</tbody>
         
            </table>
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
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						</div>


						
						
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



		$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('userid');
        $.ajax({
            type : 'post',
            url : 'fetch_record_admin.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
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