MYSQL :

14.dbconnection.php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "crime_record_db";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
