8.delete_case.php

<?php
include('dbconnection.php');

// Check if ID is passed to delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the assigned case
    $sql = "DELETE FROM assign_cases WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: assign_cases.php?message=Case deleted successfully");
    } else {
        header("Location: assign_cases.php?message=Failed to delete case");
    }
} else {
    // Redirect if no ID is passed
    header("Location: assign_cases.php");
}

