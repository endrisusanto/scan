<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data View</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<style>
    
    /* Gaya untuk dark mode */
    .dark-mode {
        background-color: #222;
        color: #fff;
    }

    .dark-mode .card {
        background-color: #333;
        color: #5b5b5b;
    }
    .container-fluid {
    padding-right: 1%;
    padding-left: 1%;
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
    .dark-mode .dataTables_info {
        color: #fff;
    }
    .dark-mode .modal-title {
        color: #333;
    }
    .dark-mode label {
    display: inline-block;
    margin-bottom: .5rem;
    color: #fff;
    }

    .dark-mode .table th,
    .dark-mode .table td {
        background-color: #333;
        border-color: #555;
        color: #fff;
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

    /* Gaya untuk tombol dark mode */
    #dark-mode-toggle {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 9999;
    }

    .dashboard-form {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }
    
</style>
<body>
<div onclick="dashboard()" class="dashboard-form">
    <button id="dashboard" class="btn" title="Data Table Dashboard">
        <span class="fa fa-home"></span>
    </button>
</div>

<div class="container-fluid mt-5">
    <h2>DATABASE TKDN SW SAMPLE</h2>
    <table id="dataTable" class="table">
        <thead>
        <tr>
            <th>Nomor Asset</th>
            <th>PEMINJAM TERAKHIR</th>
            <th>Status</th>
            <th>Waktu Transaksi</th>
            <th>Model</th>
            <th>Serial</th>
            <th>Status Audit</th>
            <th>Tanggal Pengecekan</th>
            <th>PLM Holder</th>
            <th>QR CODE</th>
            <!-- <th>Action</th> -->
        </tr>
        </thead>
        <tbody>
        <?php
        // Mengatur zona waktu ke GMT +7
        date_default_timezone_set('Asia/Jakarta'); // Zona waktu untuk GMT +7
        $conn = mysqli_connect('localhost', 'root', '', 'scan');
        $query = "SELECT * FROM database_sample";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            // Kolom-kolom data
            echo "<td>" . $row['nomor_asset'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><a href='#' onclick=\"showModal('" . $row['nomor_asset'] . "')\">" . $row['timestamp'] . "</a></td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['sn'] . "</td>";
            echo "<td>" . $row['status_audit'] . "</td>";
            echo "<td><a href='#' onclick=\"showModal1('" . $row['nomor_asset'] . "')\">" . $row['latest_check'] . "</a></td>";
            echo "<td>" . $row['pic_sample'] . "</td>";
            echo "<td><img width='60px' src='" . $row['qr'] . "' alt='QR Code' class='qr-code'></td>";
            // echo "<td><a href='update.php?id=" . $row['id'] . "'>Update</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Modal untuk riwayat timestamp -->
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">Riwayat Flow Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tempat menampilkan riwayat timestamp -->
                <div id="timestampHistory"></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk riwayat timestamp -->
<div class="modal fade" id="historyModal1" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel1">Riwayat Flow Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tempat menampilkan riwayat timestamp -->
                <div id="timestampHistory1"></div>
            </div>
        </div>
    </div>
</div>
<button id="dark-mode-toggle" class="btn"><i class="fas fa-moon" title="Dark Mode"></i></button>
<button id="fullscreen-toggle" class="btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"
        title="FullScreen Mode"><i class="fas fa-expand"></i></button>

<!-- Memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Memuat Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Memuat DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "paging": true, // Aktifkan paginasi
            "ordering": true, // Aktifkan pengurutan
            "searching": true // Aktifkan pencarian
        });
    });
    function showModal(nomorAsset) {
        console.log('Nomor Asset yang diklik:', nomorAsset); // Periksa apakah nomor asset tercetak di konsol
        // Fetch request untuk mendapatkan data dari database sample berdasarkan nomor asset
        fetch('get_sample_data.php?nomor_asset=' + nomorAsset)
            .then(response => response.text())
            .then(data => {
                console.log('Response:', data); // Periksa respons dari server
                $('#timestampHistory').html(data);
                $('#historyModal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error); // Tampilkan error jika terjadi
            });
    }
    function showModal1(nomorAsset) {
        console.log('Nomor Asset yang diklik:', nomorAsset); // Periksa apakah nomor asset tercetak di konsol
        // Fetch request untuk mendapatkan data dari database sample berdasarkan nomor asset
        fetch('get_auditsample_data.php?nomor_asset=' + nomorAsset)
            .then(response => response.text())
            .then(data => {
                console.log('Response:', data); // Periksa respons dari server
                $('#timestampHistory1').html(data);
                $('#historyModal1').modal('show');
            })
            .catch(error => {
                console.error('Error:', error); // Tampilkan error jika terjadi
            });
    }
    function dashboard() {
        window.location.href = 'index.php';
    }
</script>
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
</body>
</html>