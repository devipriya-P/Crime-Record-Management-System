2.Login.php
<?php
header('Content-Type: application/json');

// 1. Database connection
$servername = "localhost";
$username = "root";      // default XAMPP username
$password = "";          // default XAMPP password is blank
$dbname = "crime_record_db";  // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// 3. Get user input from POST
$user = $_POST['username'];
$pass = $_POST['password'];

// 4. Prevent SQL Injection
$user = mysqli_real_escape_string($conn, $user);
$pass = mysqli_real_escape_string($conn, $pass);

// 5. Query database
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

// 6. Validate result
if ($result->num_rows === 1) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
}
$conn->close();
?>
