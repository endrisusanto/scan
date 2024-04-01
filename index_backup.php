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
</body>
<form id="logoutForm" action="logout.php" method="post" style="display: none;">
        <input type="hidden" id="logoutEmail" name="email">
        <input type="hidden" id="logoutPassword" name="password">
    </form>

    <script>
        // Function to handle QR code scanning
        function handleQRCodeScan(value) {
            // Split the value by slash character
            var parts = value.split('/');
            var email = parts[0];
            var password = parts[1];

            // Get the current email and password from the logged in session (if available)
            var currentUserEmail = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";
            var currentUserPassword = "<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>";

            // Compare scanned email and password with current logged in session
            if (email === currentUserEmail && password === currentUserPassword) {
                // If the scanned email and password match the current logged in session, submit the logout form
                document.getElementById('logoutEmail').value = email;
                document.getElementById('logoutPassword').value = password;
                document.getElementById('logoutForm').submit();
            } else {
                // Handle other actions or data from QR code scans
            }
        }

        // Function to check QR code value when the page loads
        function checkQRCode() {
            // Replace this with your actual QR scanning logic
            var scannedQRValue = prompt("Scan QR code");
            if (scannedQRValue != null) {
                handleQRCodeScan(scannedQRValue);
            }
        }

        // Call the function to check QR code when the page loads
        window.onload = checkQRCode;
    </script>
</html>

<?php
mysqli_close($conn);
?>
