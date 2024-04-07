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
if ($_SESSION['level']=='super user'){
    $sql = "SELECT * FROM users WHERE 1";
    $result = mysqli_query($conn, $sql);
}
else{
    $pengguna = $_SESSION['name'];
    $sql = "SELECT * FROM users WHERE name='$pengguna'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

            /* Gaya untuk dark mode */
    .dark-mode {
        background-color: #222;
        color: #fff;
    }
/* Gaya untuk tombol dark mode */
#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
}
    .dark-mode .table {
        background-color: #333;
        color: #fff;
    }

    .dark-mode .table th,
    .dark-mode .table td {
        background-color: #333;
        border-color: #555;
        color: #fff;
        padding: 4px;
        padding-top: 10px;
    }

    .dark-mode .table th {
        background-color: #444;
        color:#ffffff;
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
        .dashboard-form {
        position: fixed;
        top: 20px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
        right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
        z-index: 1000; /* Pastikan form ada di atas konten lain */
}
.btn {
    background-color: #444; /* Warna latar belakang tombol */
    color: #fff; /* Warna teks tombol */
}

    </style>
</head>
<body>
<div onclick="dashboard()" class="dashboard-form">
<button id="dashboard" class="btn" title="Data Table Dashbord">
  <span class="fa fa-home"></span>
</button>
</div>
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

    <button id="dark-mode-toggle" class="btn"><i class="fas fa-moon" title="Dark Mode"></i></button>
    <button id="fullscreen-toggle" class="btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"
        title="FullScreen Mode"><i class="fas fa-expand"></i></button>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        const isDarkMode = body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        updateDarkModeButton(isDarkMode);
    });

    // Cek apakah dark mode telah diaktifkan sebelumnya
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    body.classList.toggle('dark-mode', isDarkMode);
    updateDarkModeButton(isDarkMode);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fullscreenToggle = document.getElementById('fullscreen-toggle');

    // Fungsi untuk meminta mode fullscreen
    function toggleFullScreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    fullscreenToggle.addEventListener('click', toggleFullScreen);
    
});
</script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var inputField1 = document.getElementById('email');
    var inputField2 = document.getElementById('password');
    
    inputField1.focus(); // Focus on the first input field
    
    // Event listener to check if the value of inputField1 ends with ".com" and focus on inputField2
    inputField1.addEventListener('input', function() {
        if (inputField1.value.endsWith('.com')) {
            inputField2.focus(); // Focus on the second input field
        }
    });

    // Event listener to handle clicks outside the input fields
    document.addEventListener('click', function(event) {
        if (event.target !== inputField1 && event.target !== inputField2) {
            // If clicked outside both input fields
            inputField1.focus(); // Focus back on the first input field
        }
    });
});
</script>
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
    <script>
function dashboard() {
    window.location.href = 'index.php';
}
</script>
</body>
</html>

<?php
mysqli_close($conn);
?>
