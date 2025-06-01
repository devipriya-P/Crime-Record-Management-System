5.add_crime.php

<?php
include('dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crime_type = $_POST['crime_type'];
    $crime_date = $_POST['crime_date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO crimes (crime_type, crime_date, description) 
            VALUES ('$crime_type', '$crime_date', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo "Crime record added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

