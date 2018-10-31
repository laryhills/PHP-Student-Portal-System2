<?php
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');




if($_POST['rowid']) {
    $test_id = $_POST['rowid']; //escape string

    // Run the Query
    $sql = "SELECT * FROM questions WHERE test_fk='$test_id'";
    $sqlresult =  mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
    $rowcount=mysqli_num_rows($sqlresult);
    $serial=0;
    // Fetch Records
    // echo $rowcount;

	
?>
    <!-- // Echo the data you want to show in modal -->
	<div class="table-responsive">
			<table class="table table-hover" style="font-size: 11px;">
				<thead>
                	<tr>
                        <th>S/No</th>
                        <th style="width:40%;">Question</th>
                        <th>Ans 1</th>
                        <th>Ans 2</th>
                        <th>Ans 3</th>
                        <th>Ans 4</th>
                        <th>Correct Answer</th>
                        <th>Added By</th>
                        <!-- <th colspan="2">Action</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
	<?php
     while ($row=mysqli_fetch_array($sqlresult)) {
        $que=$row['que_desc'];
        $ans1=($row['ans1']);
        $ans2=($row['ans2']);
        $ans3=($row['ans3']);
        $ans4=($row['ans4']);
        $ans0=($row['true_ans']);
		$addedBy=$row['addedBy'];
		 $serial++;
	?>
              	<tr>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $que; ?></td>
                    <td><?php echo $ans1; ?></td>
                    <td><?php echo $ans2; ?></td>
                    <td><?php echo $ans3; ?></td>
                    <td><?php echo $ans4; ?></td>
                    <td  style="text-align: center"><?php echo $ans0; ?></td>
                    <td><?php echo $addedBy; ?></td>

                    <!-- <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-userid="<?php echo $row['course_id']; ?>" >Edit</button>
                  </td> --><!-- td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-userid="<?php echo $row2['test_id']; ?>" >View</button>
                  </td>-->
                  <td> 
                  <a href="del_admin.php?que_del=<?php echo $row['que_id']; ?>" class="del_btn"><button type="button" class="btn btn-danger " style="font-size: 11px";>Delete</button></a>
                </td>
                
	               
             	</tr>
             <?php

            	 }

             ?>
            	</tbody>
         
            </table>

						</div>







<?php

 }
?>
