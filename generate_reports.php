12.generate_reports.php

<?php
include 'dbconnection.php';

// Fetch assigned cases
$sql = "SELECT * FROM assign_cases";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assigned Cases Report</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #000; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        a { display: block; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Assigned Cases Report</h2>

    <table>
        <tr>
            <th>Case ID</th>
            <th>Case Name</th>
            <th>Criminal Name</th>
            <th>Assigned Officer</th>
            <th>Assigned Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['case_name']; ?></td>
            <td><?php echo $row['criminal_name']; ?></td>
            <td><?php echo $row['assigned_officer']; ?></td>
            <td><?php echo $row['assigned_date']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>

