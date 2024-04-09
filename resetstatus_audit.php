<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'scan');

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan data dari permintaan POST
$latest_check = date('Y-m-d H:i:s'); // Timestamp saat ini
$name =  $_SESSION['name'];

// Update data di tabel utama
$status_audit = 'RESET'; // Ubah status_audit menjadi 'RESET'
$query = "UPDATE database_sample SET status_audit='$status_audit', latest_check='$latest_check'";
mysqli_query($conn, $query);

// Simpan riwayat timestamp ke dalam tabel sample
$insertQuery = "INSERT INTO audit_sample (name, pic_sample, nomor_asset, status_audit, model, tanggal_pengecekan) 
                SELECT '$name', pic_sample, nomor_asset, '$status_audit', model, '$latest_check' FROM database_sample";
mysqli_query($conn, $insertQuery);

// Update status_audit di semua data dalam tabel audit_sample menjadi 'RESET'
$updateStatusQuery = "UPDATE audit_sample SET status_audit='$status_audit'";
mysqli_query($conn, $updateStatusQuery);

header("Location: audit_sample.php"); // Redirect kembali ke halaman tampilan
exit();
?>
