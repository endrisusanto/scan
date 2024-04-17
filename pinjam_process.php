<?php
// Mengatur zona waktu ke GMT +7
date_default_timezone_set('Asia/Jakarta');

// Inisialisasi session
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'scan');

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

// Fungsi untuk memperbarui data di database_sample
function updateDatabase($conn, $name, $nomor_asset, $status_pinjam, $timestamp) {
    $stmt = $conn->prepare("UPDATE database_sample SET name=?, status_pinjam=?, timestamp=? WHERE nomor_asset=?");
    $stmt->bind_param('ssss', $name, $status_pinjam, $timestamp, $nomor_asset);
    $stmt->execute();
    $stmt->close();
}

// Fungsi untuk memasukkan riwayat ke flow_sample
function insertFlowSample($conn, $name, $nomor_asset, $status_pinjam, $model, $timestamp) {
    $stmt = $conn->prepare("INSERT INTO flow_sample (name, nomor_asset, status_pinjam, model, timestamp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $nomor_asset, $status_pinjam, $model, $timestamp);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['nomor_asset'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $nomor_asset = $conn->real_escape_string($_POST['nomor_asset']);
        
        // Mendapatkan data sebelumnya
        $stmt = $conn->prepare("SELECT * FROM database_sample WHERE nomor_asset = ?");
        $stmt->bind_param('s', $nomor_asset);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $dataBeforeUpdate = $result->fetch_assoc();
            $stmt->close();

            $model = $dataBeforeUpdate['model'] ?? null;
            $previous_name = $dataBeforeUpdate['name'] ?? null;
            $previous_status_pinjam = $dataBeforeUpdate['status_pinjam'] ?? null;

            $timestamp = date('Y-m-d H:i:s');

            if ($name === $previous_name) {
                if ($previous_status_pinjam === 'PINJAM') {
                    $_SESSION['alert_message'] = "KEMBALI";
                    $new_status_pinjam = 'KEMBALI';
                } else {
                    $_SESSION['alert_message'] = "PINJAM";
                    $new_status_pinjam = 'PINJAM';
                }
            } else {
                $_SESSION['alert_message'] = "BERGANTI";
                $new_status_pinjam = 'PINJAM';
            }

            // Perbarui data di database_sample
            updateDatabase($conn, $name, $nomor_asset, $new_status_pinjam, $timestamp);
            
            // Masukkan riwayat ke flow_sample
            insertFlowSample($conn, $name, $nomor_asset, $new_status_pinjam, $model, $timestamp);
        } else {
            $_SESSION['alert_message'] = "TIDAK_TERSEDIA";
        }

        // Pengalihan setelah memproses data
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['alert_message'] = "TIDAK_TERSEDIA";
        header("Location: index.php");
        exit();
    }
}

// Menutup koneksi
$conn->close();
?>
