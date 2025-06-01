10.delete_assign_cases.php
        
  <?php
include('dbconnection.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM assign_cases WHERE id=?");
    if (!$stmt) {
        die("Prepare error: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: assign_cases.php?msg=Assignment deleted successfully.");
    } else {
        header("Location: assign_cases.php?msg=Failed to delete assignment.");
    }
    $stmt->close();
    exit();
} else {
    header("Location: assign_cases.php");
    exit();
}
?>

