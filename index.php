<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .card {
      margin-bottom: 20px;
    }

    /* Gaya untuk dark mode */
    .dark-mode {
        background-color: #222;
        color: #fff;
    }

    .dark-mode .card {
        background-color: #333;
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
        border-color: #555;
    }

    .dark-mode .table th {
        background-color: #444;
    }

    /* Gaya untuk mengubah tombol saat dihover di dark mode */
    .dark-mode .btn:hover {
        background-color: #555;
        border-color: #555;
        color: #fff;
    }
  </style>
</head>
<body>

<div class="container mt-3">

  <h2>Data</h2>
  <a href="input.php" class="btn btn-primary mb-3">Tambah Data</a>
  <?php
  include 'koneksi.php';

  // Proses delete
  if(isset($_GET['delete_id'])) {
      $delete_id = $_GET['delete_id'];
      $sql_delete = "DELETE FROM sample WHERE id = $delete_id";
      if ($conn->query($sql_delete) === TRUE) {
          echo "<div class='alert alert-success' role='alert'>Data berhasil dihapus</div>";
          echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 5000);</script>";
      } else {
          echo "<div class='alert alert-danger' role='alert'>Error deleting record: " . $conn->error . "</div>";
          echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 5000);</script>";
      }
  }
  ?>
</div>
<div class="container mt-3">
  <div class="row">
    <?php
    $sql = "SELECT * FROM sample";
    $result = $conn->query($sql);

    $asset_data = array(); // Array untuk menyimpan data nomor asset yang telah dikelompokkan

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nama = $row['nama'];
            $nomor_asset = $row['nomor_asset'];
            $id = $row['id'];
            
            // Jika nomor asset dengan nama yang sama sudah ada dalam array, tambahkan nomor asset ke tabel yang sudah ada
            if(array_key_exists($nama, $asset_data)) {
                $asset_data[$nama] .= "<tr><td>$nomor_asset</td><td><a href='edit.php?id=$id' class='btn btn-primary'>Edit</a> <a href='index.php?delete_id=$id' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a></td></tr>";
            } else { // Jika nomor asset dengan nama yang sama belum ada dalam array, buat tabel baru
                $asset_data[$nama] = "<table class='table'><thead><tr><th>Nomor Asset</th><th>Action</th></tr></thead><tbody><tr><td>$nomor_asset</td><td><a href='edit.php?id=$id' class='btn btn-primary'>Edit</a> <a href='index.php?delete_id=$id' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a></td></tr>";
            }
        }
        
        // Tampilkan card dengan tabel-tabel yang sudah dikelompokkan
        foreach($asset_data as $nama => $table) {
            echo "<div class='col-md-4'><div class='card'><div class='card-header'>$nama</div><div class='card-body'>$table</tbody></table></div><div class='card-footer'>SEDANG DIPINJAM</div></div></div>";
        }
    } else {
        echo "<div class='col'><div class='alert alert-info' role='alert'>Tidak ada data</div></div>";
    }

    $conn->close();
    ?>
  </div>
</div>

<button id="dark-mode-toggle" class="btn btn-primary">Dark Mode</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    // Fungsi untuk mengubah gaya tombol dark mode sesuai dengan status dark mode
    function updateDarkModeButton(isDarkMode) {
        if (isDarkMode) {
            darkModeToggle.classList.remove('btn-outline-light', 'text-dark');
            darkModeToggle.classList.add('btn-outline-dark');
        } else {
            darkModeToggle.classList.remove('btn-outline-dark');
            darkModeToggle.classList.add('btn-outline-light', 'text-dark');
        }
    }

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

</body>
</html>
