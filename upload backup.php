<?php

require 'vendor/autoload.php';

// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "scan";
$table = "sample";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel
$sql = "SELECT nama, nomor_asset FROM $table";
$result = $conn->query($sql);

// Membuat objek PHPExcel
$excel = new PHPExcel();

// Membuat objek worksheet aktif
$sheet = $excel->getActiveSheet();

// Menuliskan judul kolom
$sheet->setCellValue('A1', 'Nama');
$sheet->setCellValue('B1', 'Nomor Asset');

// Baris untuk menulis data
$row = 2;

// Menuliskan data dari hasil query
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['nama']);
    $sheet->setCellValue('B' . $row, $row_data['nomor_asset']);
    $row++;
}

// Menyimpan file Excel
$filename = 'data_import.xlsx';
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save($filename);

echo "Data telah diimpor ke file Excel: $filename";

// Menutup koneksi
$conn->close();
?>
