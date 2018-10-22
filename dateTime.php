<?php
date_default_timezone_set("Africa/Lagos");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime1=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
echo $DateTime;
echo "<br>";
echo $DateTime1;



?>