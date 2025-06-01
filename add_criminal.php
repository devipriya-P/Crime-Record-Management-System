7. add_criminal.php

<?php
include('dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $crime_type = mysqli_real_escape_string($conn, $_POST['crime_type']);
    $arrest_date = mysqli_real_escape_string($conn, $_POST['arrest_date']);

    // SQL query to insert data into the criminals table
    $sql = "INSERT INTO criminals (name, age, crime_type, arrest_date) 
            VALUES ('$name', '$age', '$crime_type', '$arrest_date')";

    if (mysqli_query($conn, $sql)) {
        echo "New criminal added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Redirect back to the manage criminals page
    header('Location: manage_criminals.php');

    exit();
}
?>

