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
    echo '<div onclick="reset()" class="reset-form">
        <button id="reset" class="btn" title="Reset Audit Sample">
          <span class="fa fa-recycle"></span>
        </button>
      </div>';
}
else{
    $pengguna = $_SESSION['name'];
    $sql = "SELECT * FROM users WHERE name='$pengguna'";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dapatkan nilai input dari form
    $inputEmail = $_POST['email'];

    // Periksa apakah nilai input sesuai dengan $_SESSION['email']
    if ($inputEmail === $_SESSION['email']) {
        // Arahkan pengguna ke halaman logout
        header('Location: logout.php');
        exit;
    } else {
        echo "Email tidak cocok. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  

    <!-- Tambahkan Font Awesome -->
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
#logout_form {
    position: relative;
    top: 5px; /* Sesuaikan dengan jarak atas yang diinginkan */
    left: 10px; /* Sesuaikan dengan jarak kiri yang diinginkan */
}

        .audit-form {
                position: fixed;
                top: 65px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
                right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
                z-index: 1000; /* Pastikan form ada di atas konten lain */
                padding:1px;
        }
        .qr-form {
                position: fixed;
                top: 110px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
                right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
                z-index: 1000; /* Pastikan form ada di atas konten lain */
                padding:1px;
        }
        .reset-form {
                position: fixed;
                top: 155px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
                right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
                z-index: 1000; /* Pastikan form ada di atas konten lain */
                padding:1px;
        }
.btn {
    background-color: #444; /* Warna latar belakang tombol */
    color: #fff; /* Warna teks tombol */
}

    </style>
</head>
<body>
    <form method="POST" action="" id="logout_form">
    <div class="form-group">
        <label for="email">SCAN QR USER TO LOGOUT</label><br>
        <input type="text" id="email" name="email" required>
        </div>
        <input hidden type="submit" value="Submit">
    </form>
    
<div onclick="dashboard()" class="dashboard-form">
<button id="dashboard" class="btn" title="Data Table Dashbord">
  <span class="fa fa-home"></span>
</button>
</div>
<div onclick="audit()" class="audit-form">
<button id="audit" class="btn" title="Audit Sample">
  <span class="fa fa-table"></span>
</button>
</div>

<div onclick="qr()" class="qr-form">
<button id="qr" class="btn" title="GENEREATE QR CODE NOMOR ASSET">
  <span class="fa fa-qrcode"></span>
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
document.addEventListener('DOMContentLoaded', function() {
    // Dapatkan elemen form
    const logoutForm = document.getElementById('logout_form');

    // Dapatkan elemen input dengan ID "email"
    const emailInput = document.getElementById('email');

    // Email sesi dari variabel PHP
    const sessionEmail = "<?php echo $_SESSION['email']; ?>";

    // Fungsi untuk memeriksa dan melakukan logout jika email cocok
    function checkEmailAndLogout() {
        // Ambil nilai email dari input
        let emailValue = emailInput.value;

        // Potong emailValue hingga ".com"
        let endIndex = emailValue.indexOf('.com') + 4; // ".com" memiliki panjang 4 karakter
        let emailPrefix = emailValue.slice(0, endIndex);

        // Bandingkan emailPrefix dengan sessionEmail
        if (emailPrefix === sessionEmail) {
            // Jika cocok, arahkan ke logout.php
            window.location.href = 'logout.php';
        }
    }

    // Tambahkan event listener ke form
    logoutForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default
        checkEmailAndLogout(); // Panggil fungsi pemeriksaan dan logout
    });
});


    </script>

    </div>
    <script>
function dashboard() {
    window.location.href = 'index.php';
}
</script>
<script>
function audit() {
    window.location.href = 'audit_sample.php';
}
function reset() {
    window.location.href = 'resetstatus_audit.php';
}
function qr() {
    window.location.href = 'generate_qr_asset.php';
}
</script>
</body>
</html>

<?php
mysqli_close($conn);
?>
