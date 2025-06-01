3.dashboard.php
 
<?php
// You can add session_start() and user authentication check here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Crime Record Management System</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #f39c12, #d35400);
      color: #fff;
      text-align: center;
    }

    .header {
      background-color: #2c3e50;
      padding: 20px;
      font-size: 28px;
      color: white;
    }

    .menu {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 30px;
      gap: 20px;
    }

    .menu a {
      background-color: #34495e;
      padding: 20px 30px;
      border-radius: 8px;
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      transition: 0.3s;
    }

    .menu a:hover {
      background-color: #1abc9c;
    }

    .footer {
      background-color: #2c3e50;
      padding: 15px;
      color: #ccc;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>859999.+
</head>
<body>

  <div class="header">
    🚓 Crime Record Management System - Dashboard
  </div>

  <div class="menu">
    <a href="add_crime.html">Add Crime</a>
    <a href="manage_criminals.php">Manage Criminals</a>
    <a href="assign_cases.php">Assign Cases</a>
    <a href="generate_reports.php">Generate Reports</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="footer">
    &copy; 2025 CRMS | Designed for Safety & Security
  </div>

</body>
</html>
