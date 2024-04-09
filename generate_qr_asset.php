<?php
// Include QR code library
include 'phpqrcode/qrlib.php';

// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'scan';
$table = 'database_sample';

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT nomor_asset FROM $table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Generate QR code for each nomor_asset value
        $qr_value = $row["nomor_asset"];
        $qr_filename = "qr/qr_" . $qr_value . ".png"; // Output filename for QR code
        QRcode::png($qr_value, $qr_filename); // Generate QR code and save to file
        echo "QR code generated for: $qr_value<br>";
        echo "<img src='$qr_filename' alt='QR Code for $qr_value'><br><br>"; // Display QR code
        
        // Update database with QR code filename
        $update_sql = "UPDATE $table SET qr = '$qr_filename' WHERE nomor_asset = '$qr_value'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Record updated successfully<br><br>";
            header("Location: view.php");

        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
