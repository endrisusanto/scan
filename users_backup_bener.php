<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

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

// Fetch user data from the database
$sql = "SELECT name, email, qr FROM $table";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .logout-btn {
            margin-top: 20px;
        }
        .qr-code {
            max-width: 200px; /* Sesuaikan dengan kebutuhan Anda */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Data</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>QR Code</th> <!-- Tambahkan kolom untuk QR Code -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row_data = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row_data['name']; ?></td>
                        <td><?php echo $row_data['email']; ?></td>
                        <td><img width="100px" src="<?php echo $row_data['qr']; ?>" alt="QR Code" class="qr-code"></td> <!-- Tambahkan baris untuk menampilkan QR Code -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form action="logout.php" method="post" class="logout-btn">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <script>
        // Function to parse QR code value
        function parseQRCodeValue(value) {
            // Replace this with your actual logout logic
            var currentUserEmail = "<?php echo explode('@', $_SESSION['email'])[1]; ?>";
            if (value.includes(currentUserEmail)) {
                window.location.href = 'logout.php';
            }
        }

        // Function to check QR code after 5 seconds
        setTimeout(function() {
            checkQRCode();
        }, 5000);

        // Function to check if the QR code value is received
        function checkQRCode() {
            // Replace this with your actual QR scanning logic
            var scannedQRValue = prompt("SCAN QR CODE USER UNTUK LOGOUT");
            if (scannedQRValue != null) {
                parseQRCodeValue(scannedQRValue);
            }
        }
    </script>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
