<?php 
session_start();

//Test for __CONFIG__ constant
if(!isset($_SESSION['TEST'])){
exit('Page/File requested not available <br> <a style="text-decoration:none;" href=studcourses.php> Student Homepage</a>');
}
require_once('conn/db_connect.php');
require_once('functions/functions.php');

// if(!$_SESSION['username']){
// 	$_SESSION["ErrorMessage"]="Access Denied, Login Required!!!";
// 	header('location:index.php');
// 	exit;
// }
?>

<?php

$stud_reg_no=$_SESSION['username'];
if (isset($_GET['test_id']) && isset($_GET['tma_no'])) {

	$_SESSION['tma_no'] = $_GET['tma_no'];
	$_SESSION['test_id'] = $_GET['test_id'];
	
	header('location:test.php');
}

if(!isset($_SESSION['tma_no']) || !isset($_SESSION['test_id']))
{	
	$_SESSION["ErrorMessage"]="Test Error!!!";
	header("location: index.php");
}else{
	// echo $_SESSION['tma_no'];
	// echo "<br>".$_SESSION['test_id'];
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
		<title>Take Tests</title>
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
						<li><a href="studcourses.php"><span class="glyphicon glyphicon-book"> </span> My Courses</a></li>
						<li class="active">
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
					<!-- <h1>Manage Courses</h1>
					-->
						<div> 
							<!-- notification message -->
								<!-- <?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();

									?> -->

							<div class="col-sm-12">
								<br><br><br>
								<!-- <h1 style="font-size: 8.9em">COMING SOON</h1> -->
								<div style="text-align: center; font-size: 20px;">
<?php
		$sess_id = session_id();
		$test_id=$_SESSION['test_id'];
		$tma_no=$_SESSION['tma_no'];
		$sql1=mysqli_query($db_connect, "SELECT * FROM questions WHERE test_fk='$test_id'") or die(mysqli_error());
		$sql4=mysqli_query($db_connect, "SELECT * FROM result WHERE student_reg_fk='$stud_reg_no' AND test_fk='$test_id'") or die(mysqli_error());
		$sql5=mysqli_query($db_connect, "SELECT * FROM tests WHERE test_id='$test_id' AND tma_id='$tma_no'") or die(mysqli_error());
		$row4= mysqli_fetch_row($sql4);	
		$rowcount4=mysqli_num_rows($sql4);
		if($rowcount4 > 0){
			echo "You have completed this test!!<br>";
			$TestDate=$row4[2];
			$Questionrow=mysqli_num_rows($sql1);
			$DateTime=date('d-M-Y',strtotime($TestDate));
			echo "You got ".$row4[3]." of ".$Questionrow." questions on ".$DateTime;

		}elseif (mysqli_num_rows($sql1) < 1){
			$row5= mysqli_fetch_row($sql5);

 			echo "<h2>No ".$row5[3]." for this ".$row5[1]." Yet </h2>";
		}
		else{
		
			// echo $rowcheck=mysqli_num_rows($sql1);
			if(!isset($_SESSION['ques']))
			{
				$_SESSION['ques']=0;
				$query1=mysqli_query($db_connect, "DELETE FROM answer_log WHERE sess_id='$sess_id'") or die(mysqli_error());
				$_SESSION['true_ans']=0;
				
			}else{	
				// if($_POST['submit']=='' && isset($ans))
					if (isset($_POST['submit']) && $_POST['submit'] == "Next Question" && isset($_POST['ans']))
					{
						$ans = $_POST['ans'];
						mysqli_data_seek($sql1,$_SESSION['ques']);
						$row= mysqli_fetch_row($sql1);
						$sql2=mysqli_query($db_connect, "INSERT INTO answer_log (sess_id, test_fk, que_desc, ans1,ans2,ans3,ans4,true_ans,your_ans) VALUES ('$sess_id', $test_id,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());

							if($ans==$row[7])
							{
										$_SESSION['true_ans']=$_SESSION['true_ans']+1;
							}
							$_SESSION['ques']=$_SESSION['ques']+1;
					}
					// else if($_POST['submit']=='Get Result' && isset($ans))
					elseif (isset($_POST['getResult']) && isset($_POST['ans']))
					{	
						$ans = $_POST['ans'];
						mysqli_data_seek($sql1,$_SESSION['ques']);
						$row= mysqli_fetch_row($sql1);	
						$sql2=mysqli_query($db_connect, "INSERT INTO answer_log(sess_id, test_fk, que_desc, ans1,ans2,ans3,ans4,true_ans,your_ans) VALUES ('$sess_id', $test_id,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());
						if($ans==$row[7])
						{
									$_SESSION['true_ans']=$_SESSION['true_ans']+1;
						}
						echo "<h1> Result</h1>";
						$_SESSION['ques']=$_SESSION['ques']+1;
						// echo "<Table align=center><tr class=tot><td>Total Question<td> $_SESSION['ques']";
						echo "You got ".$_SESSION['true_ans']." of ".$_SESSION['ques']." questions";
						// echo "<tr class=tans><td>True Answer<td>".$_SESSION['trueans'];
						// $w=$_SESSION['qn']-$_SESSION['true_ans'];
						// echo "<tr class=fans><td>Wrong Answer<td> ". $w;
						// echo "</table>";
						$DateTime=strftime("%Y-%m-%d %H:%M:%S",time());
						$true_ans=$_SESSION['true_ans'];
						$sql3=mysqli_query($db_connect,"INSERT INTO result (student_reg_fk,test_fk,test_date,score) values('$stud_reg_no',$test_id,'$DateTime','$true_ans')") or die(mysqli_error());
						// echo "<h1 align=center><a href=review.php> Review Question</a> </h1>";
						?>
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
						<?php
						unset($_SESSION['ques']);
						unset($_SESSION['tma_no']);
						unset($_SESSION['test_id']);
						unset($_SESSION['true_ans']);
						exit;
					}
		}	
			
			$sql1=mysqli_query($db_connect, "SELECT * FROM questions WHERE test_fk='$test_id'") or die(mysqli_error());
			if($_SESSION['ques'] > (mysqli_num_rows($sql1)-1))
			{
				unset($_SESSION['ques']);
				echo "<h1 class=head1>Some Error  Occured</h1>";
				// session_destroy();
				?>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
					Please <a href=studcourses.php> Start Again</a>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
				<?php
				
				exit;
			}
			mysqli_data_seek($sql1,$_SESSION['ques']);
			$row= mysqli_fetch_row($sql1);

			
			
	?>
	<form style="text-align: left;" name=test id="test" method=post action=test.php>
				<?php $n=$_SESSION['ques']+1; ?>
				<?php echo "Que ".  $n .": ".$row[2];?><br>
				<!-- <?php echo $_SESSION['ques']; ?> -->
				<!-- <?php echo "<br>".mysqli_num_rows($sql1) ?> -->

					<input type="radio" name="ans" value="1"> <?php echo $row[3]; ?><br>
					<input type="radio" name="ans" value="2"> <?php echo $row[4]; ?><br>
					<input type="radio" name="ans" value="3"> <?php echo $row[5]; ?><br>
					<input type="radio" name="ans" value="4"> <?php echo $row[6]; ?><br>
				<?php
				 if($_SESSION['ques']< mysqli_num_rows($sql1)-1){
					?>
					<input type="submit" name="submit" id="submit" value="Next Question">
			</form>
				<?php
				 }else{ ?>
				<input type="submit" name="getResult" id="getResult" value="Get Result">
		</form>
<?php
			 }
	}
		?>

								</div>

									
								</div>
								
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

				
		</div> <!-- Ending of Container-Row -->
		</div> <!-- Ending of Container-Fluid -->
		</div>	<div class="footer">
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