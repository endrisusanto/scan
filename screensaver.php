


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
.dark-mode .modal-content {
  background-color: #313131;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #2d2d2d;
  width: 20%;
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

<h2><center><strong>PORTAL SIMPAN PINJAM TKDN SW</strong></center></h2>
  <?php
  include 'koneksi.php';
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
    function redirectToLoginPage() {
        window.location.href = "login.php";
    }

    document.addEventListener('touchstart', redirectToLoginPage);
    document.addEventListener('keydown', redirectToLoginPage);
    // document.addEventListener('mousedown', redirectToLoginPage);
</script>
</body>
</html>