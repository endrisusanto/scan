<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$nomor_asset = $_POST['nomor_asset'];

$sql = "INSERT INTO sample (nama, nomor_asset) VALUES ('$nama', '$nomor_asset')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan";
	header("location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
