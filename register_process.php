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

// Check if email already exists
$email_check_query = "SELECT * FROM $table WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // If email already exists
    header("Location: register.php?Email_already_exists");
} else { // If email does not exist, proceed with registration
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Combine name and password
    $qr_value = $email . $password;

    // Generate QR code
    $qr_filename = 'qr/' .$name. '_'.date("Ymd",time()) . '.png'; // Generate unique filename for QR code
    QRcode::png($qr_value, $qr_filename); // Generate QR code and save as PNG

    // SQL query to insert user data into the database
    $sql = "INSERT INTO $table (name, email, password, qr , level) VALUES ('$name', '$email', '$hashed_password', '$qr_filename', 'member')";

    if (mysqli_query($conn, $sql)) {
        // Registration successful, set session variables for auto login
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['level'] = $row['level']; // Save user's level in session
        // Redirect to index.php
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
