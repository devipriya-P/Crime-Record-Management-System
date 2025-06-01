11.edit_assign_case.php

<?php
include('dbconnection.php');
session_start();

if (!isset($_GET['id'])) {
    header("Location: assign_cases.php");
    exit();
}

$id = $_GET['id'];

// Fetch the existing assignment
$stmt = $conn->prepare("SELECT * FROM assign_cases WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Assignment not found.");
}
$assignment = $result->fetch_assoc();
$stmt->close();

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $criminal_name = $_POST['criminal_name'];
    $case_name = $_POST['case_name'];
    $assigned_officer = $_POST['assigned_officer'];
    $assigned_date = $_POST['assigned_date'];

    $stmt = $conn->prepare("UPDATE assign_cases SET criminal_name=?, case_name=?, assigned_officer=?, assigned_date=? WHERE id=?");
    if (!$stmt) {
        die("Prepare error: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $criminal_name, $case_name, $assigned_officer, $assigned_date, $id);
    if ($stmt->execute()) {
        $message = "Assignment updated successfully!";
    } else {
        $message = "Failed to update assignment.";
    }
    $stmt->close();
    header("Location: assign_cases.php?msg=" . urlencode($message));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Assignment</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ecf0f1; padding: 20px; }
        .form-container {
            background: #fff; max-width: 500px; margin: auto;
            padding: 20px; border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #2980b9; color: white; border: none; padding: 10px; margin-top: 15px; cursor: pointer; border-radius: 5px; }
        button:hover { background: #1f6391; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Assignment</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="POST" action="">
            <label>Criminal Name:</label>
            <input type="text" name="criminal_name" value="<?= htmlspecialchars($assignment['criminal_name']) ?>" required>
            
            <label>Case Name:</label>
            <input type="text" name="case_name" value="<?= htmlspecialchars($assignment['case_name']) ?>" required>
            
            <label>Assigned Officer:</label>
            <input type="text" name="assigned_officer" value="<?= htmlspecialchars($assignment['assigned_officer']) ?>" required>
            
            <label>Assigned Date:</label>
            <input type="date" name="assigned_date" value="<?= htmlspecialchars($assignment['assigned_date']) ?>" required>
            
            <button type="submit">Update Assignment</button>
        </form>
    </div>
</body>
</html>

