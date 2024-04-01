<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "scan";
$table = "sample";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$nomor_asset = $_POST['nomor_asset'];

// Masukkan data ke database
$sql = "INSERT INTO $table (nomor_asset) VALUES ('$nomor_asset')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
