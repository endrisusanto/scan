<?php
session_start();

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
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if the email exists
$sql = "SELECT * FROM $table WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Email exists, fetch the hashed password
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, set session variables and redirect to index.php
        $_SESSION['email'] = $email;
        header("Location: users.php");
    } else {
        // Password is incorrect, redirect back to login.php
        header("Location: login.php");
    }
} else {
    // Email does not exist, redirect back to login.php
    header("Location: login.php");
}

mysqli_close($conn);
?>
