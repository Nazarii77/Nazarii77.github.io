<?php
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


/*
$sql = "SELECT id, company_name, company_earnings FROM main_company";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["company_name"]. "    earnings: " . $row["company_earnings"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
*/

?>