6.manage_criminals.php

<?php
include('dbconnection.php');

// Add criminal
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $crime = $_POST['crime'];
  $arrested_date = $_POST['arrested_date'];

  $sql = "INSERT INTO criminals (name, crime, arrested_date) VALUES ('$name', '$crime', '$arrested_date')";
  if ($conn->query($sql) === TRUE) {
    header("Location: manage_criminals.php?msg=added");
    exit();
  } else {
    echo "Failed to add criminal: " . $conn->error;
  }
}

// Delete criminal
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM criminals WHERE id=$id");
  header("Location: manage_criminals.php?msg=deleted");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Criminals</title>
</head>
<body>
  <h2>Add Criminal</h2>
  <form method="post" action="">
    Name: <input type="text" name="name" required><br>
    Crime: <input type="text" name="crime" required><br>
    Arrested Date: <input type="date" name="arrested_date" required><br>
    <button type="submit" name="add">Add</button>
  </form>
 <a href="dashboard.php">Back to Dashboard</a>


  <h2>Criminal List</h2>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Crime</th>
      <th>Arrested Date</th>
      <th>Action</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM criminals");
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['crime']}</td>
        <td>{$row['arrested_date']}</td>
        <td><a href='manage_criminals.php?delete={$row['id']}' onclick='return confirm(\"Delete this criminal?\");'>Delete</a></td>
      </tr>";
    }

    ?>

  </table>
</body>
</html>
