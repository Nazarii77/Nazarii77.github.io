<?php

// Including database connections
require_once 'connect.php'; 
// mysqli query to fetch all data from database

$query = "SELECT DISTINCT main_company.company_name , main_company.company_earnings,
(main_company.company_earnings+
			  (SELECT SUM(company_earnings) 
			  FROM child_company 
			  WHERE main_company.id=child_company.owner 
			  group by owner  having count(*) > 1)
)
 AS all_earnings
FROM  main_company LEFT JOIN  child_company 
ON child_company.owner=main_company.id;";   




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