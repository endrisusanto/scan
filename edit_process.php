<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nomor_asset = $_POST['nomor_asset'];

$sql = "UPDATE sample SET nama='$nama', nomor_asset='$nomor_asset' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diupdate";
    header("location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
