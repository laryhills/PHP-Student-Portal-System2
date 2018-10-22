
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
                        <!-- <th colspan="2">Action</th> -->
                        <th>Action</th>
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
                     <!-- <td>
                  <a href="admin_update_cand.php?edit=<?php echo $row['id']; ?>" class="edit_btn1" >Edit</a>
                </td> -->
	                <td>
	                  <a href="admin_del_cand.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
	                </td>
             	</tr>
             <?php

            	 }

             ?>
            	</tbody>
         
            </table>