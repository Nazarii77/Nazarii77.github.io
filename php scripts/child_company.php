<?php

// Including database connections
require_once 'connect.php'; 
// mysqli query to fetch all data from database
$query = "SELECT * from child_company ";   /*ORDER BY emp_id ASC*/
$result = mysqli_query($conn, $query);
$arr = array();
if(mysqli_num_rows($result) != 0) {
	while($row = mysqli_fetch_assoc($result)) {
			$arr[] = $row;
	}
}
// Return json array containing data from the database
//echo "from main company php start :<br> <br>";
echo $json_info = json_encode($arr);
//echo " <br>  <br> from main company php end. <br> <br>";
?>