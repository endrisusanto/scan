<?php
session_start();

// Include QR Code library
include 'phpqrcode/qrlib.php';

// Database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'scan';
$table = 'users';

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Combine name and password
$qr_value = $email . '/' . $password;

// Generate QR code
$qr_filename = 'qr/' .$name. '_'.date("Ymd",time()) . '.png'; // Generate unique filename for QR code
QRcode::png($qr_value, $qr_filename); // Generate QR code and save as PNG

// SQL query to insert user data into the database
$sql = "INSERT INTO $table (name, email, password, qr) VALUES ('$name', '$email', '$hashed_password', '$qr_filename')";

if (mysqli_query($conn, $sql)) {
    // Registration successful, set session variables for auto login
    $_SESSION['email'] = $email;

    // Redirect to index.php
    header("Location: users.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
