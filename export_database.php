<?php
// Inisialisasi session
session_start();

// Mengecek username pada session
if (!isset($_SESSION['name'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "scan");

// Query untuk mengambil data dari database
$query_mysql = mysqli_query($koneksi, "SELECT * FROM `database_sample` WHERE 1 ORDER BY `database_sample`.`id` DESC ");

// Menginisialisasi buffer output
ob_clean();

// Mengatur header Excel
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=export.xls");

// Membuat tabel HTML
echo "<table border='1'>
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
            </tr>
        </thead>
        <tbody>";

// Mendapatkan data dari hasil query
while ($data = mysqli_fetch_array($query_mysql)) {

    
    // Menambahkan baris tabel dengan data yang diambil
    echo "<tr>";
    echo "<td>" . $data['nomor_asset'] . "</td>";
    echo "<td>" . $data['name'] . "</td>";
    echo "<td>" . $data['status'] . "</td>";
    echo "<td>" . $data['timestamp'] . "</td>";
    echo "<td>" . $data['model'] . "</td>";
    echo "<td>" . $data['sn'] . "</td>";
    echo "<td>" . $data['status_audit'] . "</td>";
    echo "<td>" . $data['latest_check'] . "</td>";
    echo "<td>" . $data['pic_sample'] . "</td>";
	echo "</tr>";
}

echo "</tbody></table>";
?>
