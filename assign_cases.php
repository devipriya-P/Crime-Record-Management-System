9.assign_cases.php

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crime_record_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new case assignment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assign_case'])) {
    $case_name = $_POST['case_name'];
    $criminal_name = $_POST['criminal_name'];
    $assigned_officer = $_POST['assigned_officer'];
    $assigned_date = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO assign_cases (case_name, criminal_name, assigned_officer, assigned_date) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $case_name, $criminal_name, $assigned_officer, $assigned_date);
        if ($stmt->execute()) {
            echo "<script>alert('Case assigned successfully!');</script>";
        } else {
            echo "Failed to assign case.";
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}

// Delete case assignment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM assign_cases WHERE id = $id");
    header("Location: assign_cases.php");
    exit();
}

// Fetch all criminals for dropdown
$criminals = [];
$criminal_result = $conn->query("SELECT name FROM criminals");
if ($criminal_result) {
    while ($row = $criminal_result->fetch_assoc()) {
        $criminals[] = $row['name'];
    }
}

// Fetch all assigned cases
$assigned_cases = [];
$result = $conn->query("SELECT * FROM assign_cases");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $assigned_cases[] = $row;
    }
} else {
    echo "Query failed: " . $conn->error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Cases</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: green;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            text-align: center;
        }
        table, th, td {
            border: 1px solid gray;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        td {
            padding: 8px;
        }
        .btn-danger {
            background: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
        }
        .btn-success {
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Assign Case to Criminal</h2>
    <form method="POST">
        <label>Case Name:</label>
        <input type="text" name="case_name" required>

        <label>Select Criminal:</label>
        <select name="criminal_name" required>
            <option value="">-- Select --</option>
            <?php foreach ($criminals as $name): ?>
                <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Assigned Officer:</label>
        <input type="text" name="assigned_officer" required>

        <button type="submit" name="assign_case" class="btn-success">Assign Case</button>
    </form>
</div>

<h2 style="text-align:center;">Assigned Cases</h2>
<table>
    <tr>
        <th>Case ID</th>
        <th>Case Name</th>
        <th>Criminal Name</th>
        <th>Assigned Officer</th>
        <th>Assigned At</th>
        <th>Action</th>
    </tr>

    <?php foreach ($assigned_cases as $case): ?>
    <tr>
        <td><?= $case['id'] ?></td>
        <td><?= htmlspecialchars($case['case_name']) ?></td>
        <td><?= htmlspecialchars($case['criminal_name']) ?></td>
        <td><?= htmlspecialchars($case['assigned_officer']) ?></td>
        <td><?= htmlspecialchars($case['assigned_date']) ?></td>
        <td><a href="?delete=<?= $case['id'] ?>" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
    </tr>

    <?php endforeach; ?>
</table>
 <a href="dashboard.php">Back to Dashboard</a>

</body>
</html>

