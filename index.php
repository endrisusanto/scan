<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'scan');

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nomor_asset = $_POST['nomor_asset'];

    // Mendapatkan data sebelum update
    $query = "SELECT * FROM database_sample WHERE nomor_asset='$nomor_asset'";
    $result = mysqli_query($conn, $query);
    $dataBeforeUpdate = mysqli_fetch_assoc($result);
    $model = $dataBeforeUpdate['model']; // Tambahkan variabel model


    // Jika nama sama dengan sebelumnya
    if ($name == $dataBeforeUpdate['name']) {
        // Jika status sebelumnya "pinjam", set status baru menjadi "kembali"
        if ($dataBeforeUpdate['status'] == 'PINJAM') {
          $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
            $newStatus = 'KEMBALI';
            echo "<div class='alert alert-success' role='alert'>SAMPLE ".$model." BERHASIL DIKEMBALIKAN</div>";
            echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
    // Update data di tabel utama
    $query = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status='$newStatus', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
    mysqli_query($conn, $query);

    // Simpan riwayat timestamp ke dalam tabel sample
    $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status, model, timestamp) VALUES ('$name', '$nomor_asset', '$newStatus', '$model', '$timestamp')"; // Perbarui query INSERT
    mysqli_query($conn, $insertQuery);
        } else {
          $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
            $newStatus = 'PINJAM';
            echo "<div class='alert alert-danger' role='alert'>SAMPLE: ".$model." | HANDLER: ".$name."</div>";
            echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
    // Update data di tabel utama
    $query = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status='$newStatus', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
    mysqli_query($conn, $query);

    // Simpan riwayat timestamp ke dalam tabel sample
    $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status, model, timestamp) VALUES ('$name', '$nomor_asset', '$newStatus', '$model', '$timestamp')"; // Perbarui query INSERT
    mysqli_query($conn, $insertQuery);
        }
    } else {
      $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
        // Jika nama berbeda dengan sebelumnya, gunakan status yang di-post dari form
        // $newStatus = $status;
        $newStatus = 'PINJAM';
        echo "<div class='alert alert-danger' role='alert'>SAMPLE: ".$model." | HANDLER: ".$name."</div>";
        echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
    // Update data di tabel utama
    $query = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status='$newStatus', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
    mysqli_query($conn, $query);

    // Simpan riwayat timestamp ke dalam tabel sample
    $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status, model, timestamp) VALUES ('$name', '$nomor_asset', '$newStatus', '$model', '$timestamp')"; // Perbarui query INSERT
    mysqli_query($conn, $insertQuery);
    }


    // Menyimpan riwayat timestamp ke dalam 1 kolom database
    // $history = array($timestamp, $name);
    // $historyImploded = implode(',', $history);


		   
	 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  

    <!-- Tambahkan Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
  <style>
.alert {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    padding: 60px;
    width:100%;
    text-align:center;
    border-radius: 5px;
    animation: floatAlert 10s ease-out forwards;
    font-size: 64px;
}

@keyframes floatAlert {
    0% {
        opacity: 1;
        transform: translate(-50%, -50%) translateY(-30px);
    }
    100% {
        opacity: 0;
        transform: translate(-50%, -50%) translateY(-60px);
    }
}

    .card {
      margin-bottom: 20px;
    }
    .card-body {
    max-height: 250px;
    overflow-y: auto;
    }
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

    .dark-mode .card {
        background-color: #333;
        color: #5b5b5b;
    }
    .dark-mode .card-footer {
        background-color: #5b5b5b;
        color: #fff;
    }

    .dark-mode .btn {
        background-color: #444;
        border-color: #444;
        color: #fff;
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
    

    /* Gaya untuk mengubah tombol saat dihover di dark mode */
    .dark-mode .btn:hover {
        background-color: #555;
        border-color: #555;
        color: #fff;
    }

    .modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}
.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 20%;
}
.dark-mode .modal-content {
  background-color: #313131;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #2d2d2d;
  width: 20%;
}
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
#assetForm {
    position: fixed;
    top: 50px; /* Sesuaikan dengan jarak atas yang diinginkan */
    left: 20px; /* Sesuaikan dengan jarak kiri yang diinginkan */
}
.container-fluid {
    padding-right: 5%;
    padding-left: 12%;
}
.users-form {
        position: fixed;
        top: 20px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
        right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
        z-index: 1000; /* Pastikan form ada di atas konten lain */
}
.export-form {
        position: fixed;
        top: 65px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
        right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
        z-index: 1000; /* Pastikan form ada di atas konten lain */
}
.upload-form {
        position: fixed;
        top: 100px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
        right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
        z-index: 1000; /* Pastikan form ada di atas konten lain */
}
.dashboard-form {
        position: fixed;
        top: 140px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
        right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
        z-index: 1000; /* Pastikan form ada di atas konten lain */
}
/* CSS untuk posisi timer */
#timer-container {
  position: fixed;
  bottom: 2%;
  left: 50%;
  transform: translate(-50%, 0%);
  /* background-color: #f0f0f0; */
  padding: 2px 10px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

#timer {
  font-size: 12px;
}
a {
    padding: 13px;
    color: #444;
    background-color: #fff;
    border-radius:4px;
}
.dark-mode a {
    padding: 13px;
    color: #ffffff;
    background-color: #444;
    border-radius:4px;
}
/* Animasi glow outline */
@keyframes glow {
  0% {
    box-shadow: 0 0 10px #ff0000; /* Merah */
  }
  50% {
    box-shadow: 0 0 20px #0dcaf0;
  }
  100% {
    box-shadow: 0 0 10px #ff0000;
  }
}

/* CSS untuk input text */
#nomor_asset {
  animation: glow 1s infinite alternate; /* Memanggil animasi glow */

}
  </style>
</head>
<body>
<div class="users-form">
<a href="users.php">
  <span class="fa fa-user-circle"></span></a>
</div>
<div class="export-form">
<a href="export_database.php">
  <span class="fa fa-download"></span></a>
</div>
<div class="upload-form">
<button id="uploadBtn" class="btn" title="Upload New Data Sample">
  <span class="fa fa-upload"></span>
</button>
</div>
<div onclick="dashboard()" class="dashboard-form">
<button id="dashboard" class="btn" title="Data Table Dashbord">
  <span class="fa fa-table"></span>
</button>
</div>
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">IMPORT NEW MODEL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- <span aria-hidden="true">&times;</span> -->
            </button>
        </div>
        <div class="modal-body">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="excelFile"></label>
                    <input type="file" class="form-control-file" id="excelFile" name="excelFile" accept=".xls,.xlsx">
                </div>
                <button  type="submit" class="btn btn-primary mt-2" name="submit">Upload</button>
            </form>
        </div>
    </div>
</div>
<h2><center><strong>KOPERASI SIMPAN PINJAM TKDN SW</strong></center></h2>

<div class="container mt-3">
<form action="" method="POST" id="assetForm">
    <div class="form-group">
        <label for="name">User Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']?>">
    </div>
    <div class="form-group">
        <label for="nomor_asset">Asset Number</label>
        <input type="text" class="form-control" id="nomor_asset" name="nomor_asset" onkeyup="convertToUppercase(this)">
    </div>
    <button hidden type="submit" class="btn btn-primary">Submit</button>
</form>

  <?php
  include 'koneksi.php';

  // Proses delete
  if(isset($_GET['delete_id'])) {
      $delete_id = $_GET['delete_id'];
      $sql_delete = "DELETE FROM sample WHERE id = $delete_id";
      if ($conn->query($sql_delete) === TRUE) {
          echo "<div class='alert alert-success' role='alert'>Data berhasil dihapus</div>";
          echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 600);</script>";
      } else {
          echo "<div class='alert alert-danger' role='alert'>Error deleting record: " . $conn->error . "</div>";
          echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 600);</script>";
      }
  }
  ?>
</div>
<div class="container-fluid mt-3">
<div class="row">
<?php
    $sql = "SELECT * FROM database_sample WHERE status = 'PINJAM'"; // Perbarui query SQL
    $result = $conn->query($sql);

    $asset_data = array(); // Array untuk menyimpan data nomor asset yang telah dikelompokkan

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nama = $row['name'];
            $nomor_asset = $row['nomor_asset'];
            $model = $row['model']; // Menambah kolom model
            $timestamp = $row['timestamp']; // Menambah kolom timestamp
            
            // Jika nomor asset dengan nama yang sama sudah ada dalam array, tambahkan nomor asset ke tabel yang sudah ada
            if(array_key_exists($nama, $asset_data)) {
                $asset_data[$nama] .= "<tr><td>$nomor_asset</td><td>$model</td><td>$timestamp</td></tr>";
            } else { // Jika nomor asset dengan nama yang sama belum ada dalam array, buat tabel baru
                $asset_data[$nama] = "<table class='table table-striped'><thead><tr><th>No. Asset</th><th>Model</th><th>Timestamp</th></tr></thead><tbody><tr><td>$nomor_asset</td><td>$model</td><td>$timestamp</td></tr>";
            }

        }
        
        // Tampilkan card dengan tabel-tabel yang sudah dikelompokkan
        foreach ($asset_data as $nama => $table) {
            // Buat DOMDocument untuk mem-parsing HTML
            $dom = new DOMDocument();
            // Lakukan parsing HTML dari tabel
            $dom->loadHTML($table);
            // Dapatkan jumlah elemen <tr> dalam tabel
            $total_rows = $dom->getElementsByTagName('tr')->length;

            // Kurangi satu dari jumlah baris yang dihitung
            $total_rows--;

            // Tambahkan jumlah baris data di card-footer
            echo "
            <div class='col-md-3'>
                <div class='card mb-3'>
                    <div class='card-header'>
                        <h3><strong><center>$nama</center></h3></strong>
                    </div>
                    <div class='card-body'>$table</tbody></table></div>
                    <div class='card-footer'>SEDANG PINJAM <span class='badge'>$total_rows</span></div>
                </div>
            </div>";
        }
    } else {
        echo "<div class='col'><div class='alert alert-info' role='alert'>Tidak ada data</div></div>";
    }

    $conn->close();
?>


  </div>
</div>
<button  id="dark-mode-toggle" class="btn"><i class="fas fa-moon" title="Dark Mode"></i></button>
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


<button id="fullscreen-toggle" class="btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;" title="FullScreen Mode"><i class="fas fa-expand"></i></button>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
<script>
document.getElementById("uploadBtn").addEventListener("click", function() {
  document.getElementById("uploadModal").style.display = "block";
});

document.getElementsByClassName("close")[0].addEventListener("click", function() {
  document.getElementById("uploadModal").style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target == document.getElementById("uploadModal")) {
    document.getElementById("uploadModal").style.display = "none";
  }
});

</script>
<script>
  // Fungsi untuk menghasilkan warna acak dalam format hex dari palet warna soft
  function randomSoftColor() {
  var softColors = ['#F0EAD6', '#D0E0E3', '#E6E6FA', '#FFDAB9', '#B0C4DE', '#FFE4E1', '#FFB6C1', '#87CEFA', '#F08080', '#20B2AA', '#9370DB', '#FFA07A']; // Daftar warna soft termasuk 10 warna tambahan
  return softColors[Math.floor(Math.random() * softColors.length)];
}


  // Mengambil semua elemen dengan kelas 'card-header'
  var cardHeaders = document.querySelectorAll('.card-header');

  // Loop melalui setiap elemen dan atur background color dengan warna acak soft
  cardHeaders.forEach(function(header) {
    header.style.backgroundColor = randomSoftColor();
  });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var inputField = document.getElementById("nomor_asset");

        // Fungsi untuk fokus otomatis pada input field
        inputField.focus();

        // Fungsi untuk kembali fokus ke input field setelah klik diluar area
        document.addEventListener("click", function(event) {
            setTimeout(function() {
                if (!inputField.contains(event.target)) {
                    inputField.focus();
                }
            }, 100);
        });

        // Fungsi untuk mengirim form jika input field berisi "AS" di awal dan diikuti dengan 7 karakter
        document.getElementById("assetForm").addEventListener("submit", function(event) {
            var inputValue = inputField.value.trim();
            if (inputValue.substring(0, 2).toUpperCase() === "AS" && inputValue.length === 7) {
                // Jika kondisi terpenuhi, form akan di-submit secara otomatis
                return true;
            } else {
                // Jika kondisi tidak terpenuhi, form tidak akan di-submit
                event.preventDefault();
                alert("Input tidak valid. Pastikan input dimulai dengan 'AS' dan memiliki total 7 karakter.");
            }
        });
    });
</script>
<script>
function dashboard() {
    window.location.href = 'view.php';
}
</script>
<script>
function convertToUppercase(input) {
  input.value = input.value.toUpperCase();
}
</script>
<div id="timer-container">
  <div id="timer">timer</div>
</div>

<script>
// Waktu awal dalam detik
let timeLeft = 300; // 1 menit

// Mendapatkan elemen timer
const timerElement = document.getElementById('timer');

// Fungsi untuk memperbarui tampilan timer
function updateTimer() {
  const minutes = Math.floor(timeLeft / 60);
  let seconds = timeLeft % 60;

  // Tambahkan nol di depan jika detik kurang dari 10
  if (seconds < 10) {
    seconds = '0' + seconds;
  }

  // Perbarui tampilan timer
  timerElement.innerHTML = 'Session akan berakhir dalam: '+ minutes + ':' + seconds;
}

// Fungsi untuk mengurangi waktu
function countdown() {
  timeLeft--;

  // Perbarui tampilan timer
  updateTimer();

  // Jika waktu habis
  if (timeLeft <= 0) {
    // Redirect ke logout.php
    window.location.href = 'logout.php';
  }
}

// Mulai hitung mundur setiap detik
const timerInterval = setInterval(countdown, 1000);

// Memastikan tampilan timer terupdate pertama kali
updateTimer();
</script>
</body>
</html>