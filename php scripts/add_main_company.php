<?php
//header("Access-Control-Allow-Origin: *");
//error_reporting(0);

// Including database connections
require_once 'connect.php'; 



function add($a,$b){

 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "companies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$query = "INSERT INTO main_company (company_name, company_earnings) VALUES( '$a' , '$b' );";


$result = mysqli_query($conn, $query);




return $a;


}






	/*   function test($data,$data2){
	        return $data;
	    }

		if(isset( $_POST['company_name'] ) && isset($_POST['company_earnings']   )	{
	        echo test($_POST['company_name'],$_POST['company_earnings']);
	    }

*/






?>