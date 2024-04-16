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
    $output = ''; // Output variable to accumulate HTML
    $update_queries = []; // Array to store update queries

    // Process each row
    while ($row = $result->fetch_assoc()) {
        // Generate QR code for each nomor_asset value
        $qr_value = $row["nomor_asset"];
        $qr_filename = "qr/qr_" . $qr_value . ".png"; // Output filename for QR code
        QRcode::png($qr_value, $qr_filename); // Generate QR code and save to file

        // Accumulate output for displaying later
        $output .= "QR code generated for: $qr_value<br>";
        $output .= "<img src='$qr_filename' alt='QR Code for $qr_value'><br><br>";
        
        // Prepare update query
        $update_queries[] = "UPDATE $table SET qr = '$qr_filename' WHERE nomor_asset = '$qr_value'";
    }

    // Display the accumulated output
    // echo $output;

    // Execute all update queries at once
    foreach ($update_queries as $update_sql) {
        if ($conn->query($update_sql) !== TRUE) {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }
    
    header("Location: view.php");
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
